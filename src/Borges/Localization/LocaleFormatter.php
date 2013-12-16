<?php namespace Borges\Localization;

use Carbon\Carbon;

class LocaleFormatter {

    /**
     * Locale configurations.
     * 
     * @var Array
     */
    protected $configs;

    /**
     * The default locale being used.
     * 
     * @var string
     */
    protected $locale;

    /**
     * Create a new locator formatter instance.
     * 
     * @param Array $configs
     */
    public function __construct(Array $configs)
    {
        $this->configs = $configs;
        $this->locale = $configs['language_code'];
    }

    /**
     * Format a number.
     * 
     * @param  float $number
     * @param  int $decimals
     * @return string Formated number
     */
    public function number($number, $decimals = 2)
    {
        return number_format($number, $decimals, $this->getConfig('dec_point'), $this->getConfig('thousands_sep'));
    }

    /**
     * Format a natural number.
     * 
     * @param  float $number
     * @return string Formated number
     */
    public function int($number)
    {
        return $this->number($number, 0, $this->getConfig('dec_point'), $this->getConfig('thousands_sep'));
    }

    /**
     * Format a date.
     * 
     * @param  Datetime|int $date   
     * @param  string $format long|short
     * @return string
     */
    public function date($date, $format = 'long')
    {
        if ($date instanceof Carbon) {
            return $date->formatLocalized($format == 'long' ? $this->getConfig('date_longformat') : $this->getConfig('date_format'));
        }

        if(is_int($date)) {
            return strftime($format == 'long' ? $this->getConfig('date_longformat') : $this->getConfig('date_format'), $date);
        }

        throw new \Exception("Invalid date");
    }

    /**
     * Format a time.
     * 
     * @param  Datetime|int $time   
     * @param  string $format long|short
     * @return string
     */
    public function time($time, $format = 'long')
    {
        if ($time instanceof Carbon) {
            return $time->formatLocalized($format == 'long' ? $this->getConfig('time_longformat') : $this->getConfig('time_format'));
        }

        if(is_int($time)) {
            return strftime($format == 'long' ? $this->getConfig('time_longformat') : $this->getConfig('time_format'), $time);
        }

        throw new \Exception("Invalid time");
    }

    /**
     * Format a datetime.
     * 
     * @param  Datetime|int $datetime   
     * @param  string $format long|short
     * 
     * @return string
     */
    public function datetime($datetime, $format = 'long')
    {
        if ($datetime instanceof Carbon) {
            return $datetime->formatLocalized($format == 'long' ? $this->getConfig('datetime_longformat') : $this->getConfig('datetime_format'));
        }

        if(is_int($datetime)) {
            return strftime($format == 'long' ? $this->getConfig('datetime_longformat') : $this->getConfig('datetime_format'), $datetime);
        }

        throw new \Exception("Invalid datetime");
    }

    /**
     * Update formatter configurations.
     * 
     * @param  Array $configs
     * @return void
     */
    public function updateFormater($configs)
    {
        $this->configs = $configs;
        $this->locale = $configs['language_code'];
    }

    /**
     * Get a locator configuration.
     * 
     * @param  string $key
     * @param  Array $configs
     * @return mixed
     */
    public function getConfig($key, $configs = null)
    {
        $configs = $configs ?: $this->getConfigs();

        if (array_key_exists($key, $configs) and !empty($configs[$key])) {
            return $configs[$key];
        } elseif ($inherit = app('locale')->hasInherit($this->locale)) {
            return $this->getConfig($key, app('locale')->getLocaleConfigs($inherit));
        }

        return null;
    }

    /**
     * Return locator configurations.
     * 
     * @return Array
     */
    public function getConfigs()
    {
        return $this->configs;
    }
}
