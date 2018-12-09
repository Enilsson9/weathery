<?php

namespace Edward\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class WeatherIpJsonController extends WeatherIpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $ipAddress;
    private $time;
    private $object;
    private $requester;


    /**
     * Display the view
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Check IP (JSON)";

        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->requester = $this->di->get("requester");

        $this->ipAddress = $request->getGet("ip");
        $this->time = $request->getGet("time");

        $currentIp = $this->ipAddress;
        $this->object = new WeatherIp();

        $currentIp = $this->object->validateIp($this->ipAddress);

        $accessKey  = '49a95e2b98f16776978bbf2d3097c542';
        $details = $this->requester->curlJson('http://api.ipstack.com/'.$currentIp.'?access_key='.$accessKey);

        $accessKey  = '29b7a65dbbc991295815b55e7a37f93b';
        $weather = [];
        $multiRequests = [];

        #future weather
        if ($this->time === "future") {
            for ($i=0; $i < 7; $i++) {
                $unixTime = time() + ($i * 24 * 60 * 60);
                $multiRequests[] = 'https://api.darksky.net/forecast/'.$accessKey .'/'.$details['latitude'].','.$details['longitude'].','.$unixTime.'?exclude=minutely,hourly,daily,flags';
            }
        }

        #previous weather
        if ($this->time === "past") {
            for ($i=0; $i < 30; $i++) {
                $unixTime = time() - ($i * 24 * 60 * 60);
                $multiRequests[] = 'https://api.darksky.net/forecast/'.$accessKey .'/'.$details['latitude'].','.$details['longitude'].','.$unixTime.'?exclude=minutely,hourly,daily,flags';
            }
        }


        $weather = $this->requester->multiRequest($multiRequests);

        foreach ($weather as $key => $value) {
            $weather[$key] = json_decode(stripslashes($value), true);
        }

        $data["details"] = $details;
        $data["weather"] = $weather;
        $data["currentIp"] = $currentIp;

        $page->add("anax/v2/weather/json", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
