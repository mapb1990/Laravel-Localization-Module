<?php namespace Borges\Localization;

use Illuminate\Config\Repository;

class Locale
{
    /**
     * @var \Borges\Localization\Translator
     */
    protected $translator;

    /**
     * @var \Borges\Localization\LocaleFormatter
     */
    protected $formatter;

    /**
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * The default locale being used.
     * 
     * @var string
     */
    protected $locale;

    /**
     * Create a new locator instance.
     * 
     * @param Translator $translator
     * @param Repository $config
     * @param string     $locale
     */
    public function __construct(Translator $translator, Repository $config, $locale)
    {
        $this->translator = $translator;
        $this->locale = $locale;
        $this->config = $config;

        $this->translator->setLocale($this->getDefaultLocale());

        $this->formatter = new LocaleFormatter($this->getLocaleConfigs($locale));
    }

    /**
     * Set the default locale.
     *
     * @param  string  $locale
     * @return void
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        // update formatter
        $this->formatter->updateFormater($this->getLocaleConfigs($locale));
    }

    /**
     * Return locales configs.
     * 
     * @return Array
     */
    public function getLocales()
    {
        return $this->config->get('localization::locales');
    }

    /**
     * Return system available locales.
     * 
     * @return Array
     */
    public function getAvailableLocales()
    {
        return $this->config->get('localization::availableLocales');
    }

    /**
     * Return browser language.
     *  
     * @param  boolean $available Test if language is available
     * @return string
     */
    public function getBrowserLanguage($available = true) {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);

        if (in_array($lang, $this->getAvailableLocales())) {
            return $lang;
        } elseif (in_array(substr($lang, 0, 2), $this->getAvailableLocales())) {
            return substr($lang, 0, 2);
        }

        return false;
    }

    /**
     * Return system defaul language. First test user language, next the session
     * language, next browser language, and last get system default language.
     * 
     * @return string
     */
    public function getDefaultLocale()
    {
        if(is_callable($this->config->get('localization::useUserLanguage'))
                and in_array($this->config->get('localization::useUserLanguage'), $this->getAvailableLocales())) {
            return $this->config->get('localization::useUserLanguage');
        } elseif($this->config->get('localization::useSessionLanguage') 
                and app('session')->has('locale') and in_array(app('session')->get('locale'), $this->getAvailableLocales())) {
            return app('session')->get('locale');
        } elseif ($this->config->get('localization::useBrowserLanguage') and $browser = $this->getBrowserLanguage()) {
            return $browser;
        }

        return $this->config->get('localization::locale');
    }

    /**
     * Test if locale is inherit.
     * 
     * @param  string  $locale
     * @return boolean
     */
    public function hasInherit($locale)
    {
        if(array_key_exists('inherit', $this->getLocales()[$locale])) {
            return $this->getLocales()[$locale]['inherit'];
        }

        return false;
    }

    /**
     * Return locale configurations.
     * 
     * @param  string $locale
     * @return Array
     */
    public function getLocaleConfigs($locale)
    {
        return $this->getLocales()[$locale];
    }

    /**
     * Call methods dynamically.
     */
    public function __call($name, $arguments)
    {
        if(method_exists($this->formatter, $name)) {
            return call_user_func_array(array($this->formatter, $name), $arguments);
        }

        return call_user_func_array(array($this, $name), $arguments);
    }

}

