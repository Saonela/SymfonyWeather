<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.10.27
 * Time: 00.04
 */

namespace WeatherBundle;
//require('vendor/autoload.php');

use Symfony\Component\Debug\Exception\ContextErrorException;

class Weather
{
    function getTemperature()
    {
        $temperature = $this->openWeatherAPI();
        if($temperature == "-")
            $temperature = $this->wundergroundAPI();

        return $temperature;
    }

    private function openWeatherAPI()
    {
        try {
        $str = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Vilnius&units=metric&appid=bd82977b86bf27fb59a04b61b657fb6f');
        $json = json_decode($str);
        $temperature = $json->main->temp;

        } catch (ContextErrorException $e) {
            $temperature = "-";
        }

        return $temperature;
    }

    private function wundergroundAPI ()
    {
        try {
            $str = file_get_contents('http://api.wunderground.com/api/32ec9d148686f04a/conditions/q/LT/Vilnius.json');
            $json = json_decode($str);
            $temperature = $json->current_observation->temp_c;

        } catch (ContextErrorException $e) {
            $temperature = "-";
        }

        return $temperature;
    }
}