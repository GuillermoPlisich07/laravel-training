<?php
namespace App\Helpers;

class Helpers
{
    public static function getVersion(){
        return '1.0';
    }

    public static function getNombre($name){
        return 'Hola '.$name;
    }
}