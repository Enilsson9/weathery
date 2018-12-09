<?php
/**
 * These routes are for demonstration purpose, to show how routes and
 * handlers can be created.
 */
 return [
     "routes" => [
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
