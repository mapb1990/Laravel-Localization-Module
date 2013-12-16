<?php namespace Borges\Localization;

use Illuminate\Translation\Translator as SystemTranslator;
use Illuminate\Translation\LoaderInterface;

class Translator extends SystemTranslator {

    /**
     * System default language.
     * 
     * @var string
     */
    protected $systemDefault;
    
    /**
     * Create a new translator instance.
     *
     * @param \Illuminate\Translation\LoaderInterface  $loader
     * @param string  $locale
     * @param string $inheritLocale
     * @param string $systemDefault
     * @return void
     */
    public function __construct(LoaderInterface $loader, $locale, $systemDefault = false)
    {
        parent::__construct($loader, $locale);

        $this->systemDefault = $systemDefault;
    }

    /**
     * Get the translation for the given key.
     *
     * @param  string  $key
     * @param  array   $replace
     * @param  string  $locale
     * @return string
     */
    public function get($key, array $replace = array(), $locale = null)
    {
        list($namespace, $group, $item) = $this->parseKey($key);

        // Here we will get the locale that should be used for the language line. If one
        // was not passed, we will use the default locales which was given to us when
        // the translator was instantiated. Then, we can load the lines and return.
        $locale = $locale ?: $this->getLocale();

        $this->load($namespace, $group, $locale);

        $line = $this->getLine(
            $namespace, $group, $locale, $item, $replace
        );

        // If the line doesn't exist, we will return back the translation of inherit 
        // language or the translation of system language. If no lines exists we will 
        // return back the key which was requested as that will be quick to spot 
        // in the UI if language keys are wrong or missing from the application's 
        // language files. Otherwise we can return the line.
        if (is_null($line) and $inherit = app('locale')->hasInherit($locale)) {
            return $this->get($key, $replace, $inherit);
        } elseif(is_null($line) and $this->systemDefault and $this->systemDefault !== $locale) {
            return $this->get($key, $replace, $this->systemDefault);
        } elseif (is_null($line)) {
            return $key;
        }

        return $line;
    }
}
