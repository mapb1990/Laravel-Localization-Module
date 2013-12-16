<?php

/**
 * Translate the given message.
 *
 * @param  string  $id
 * @param  array   $parameters
 * @param  string  $domain
 * @param  string  $locale
 * @return string
 */
function _t($id, $parameters = array(), $domain = 'messages', $locale = null)
{
    return app('translator')->trans($id, $parameters, $domain, $locale);
}

/**
 * Translates the given message based on a count.
 *
 * @param  string  $id
 * @param  int     $number
 * @param  array   $parameters
 * @param  string  $domain
 * @param  string  $locale
 * @return string
 */
function _c($id, $number, array $parameters = array(), $domain = 'messages', $locale = null)
{
    return app('translator')->transChoice($id, $number, $parameters, $domain, $locale);
}

/**
 * Format a number.
 * 
 * @param  float $number
 * @param  int $decimals
 * @return string Formated number
 */
function _number($number, $decimals = 2)
{
    return app('locale')->number($number, $decimals);
}

/**
 * Format a natural number.
 * 
 * @param  float $number
 * @return string Formated number
 */
function _int($number)
{
    return app('locale')->int($number);
}

/**
 * Format a date.
 * 
 * @param  Datetime|int $date   
 * @param  string $format long|short
 * @return string
 */
function _date($date, $format = 'long')
{
    return app('locale')->date($date, $format);
}

/**
 * Format a time.
 * 
 * @param  Datetime|int $time   
 * @param  string $format long|short
 * @return string
 */
function _time($time, $format = 'long')
{
    return app('locale')->time($time, $format);
}

/**
 * Format a datetime.
 * 
 * @param  Datetime|int $datetime   
 * @param  string $format long|short
 * @return string
 */
function _datetime($datetime, $format = 'long')
{
    return app('locale')->datetime($datetime, $format);
}
