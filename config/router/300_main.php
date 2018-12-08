<?php
/**
 * These routes are for demonstration purpose, to show how routes and
 * handlers can be created.
 */
 return [
     "routes" => [
         [
             "info" => "Validera IP adresser",
             "mount" => "validate",
             "handler" => "\Edward\Validate\ValidateIpController",
         ],
         [
             "info" => "Validera IP adresser (JSON)",
             "mount" => "json",
             "handler" => "\Edward\Validate\ValidateIpJsonController",
         ],
         [
             "info" => "Weather IP",
             "mount" => "weather",
             "handler" => "\Edward\Weather\WeatherIpController",
         ],
         [
             "info" => "Weather IP (JSON)",
             "mount" => "api",
             "handler" => "\Edward\Weather\WeatherIpJsonController",
         ],
     ]
 ];
