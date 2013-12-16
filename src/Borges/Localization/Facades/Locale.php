<?php namespace Borges\Localization\Facades;

use Illuminate\Support\Facades\Facade;

class Locale extends Facade
{
    
    protected static function getFacadeAccessor() {
        return 'locale';
    }
    
}

