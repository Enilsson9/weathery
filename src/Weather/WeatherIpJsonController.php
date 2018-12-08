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

    private $ipAddress;
    private $object;
    private $requester;
    private $date;

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
        $this->date = $request->getGet("date");

        $today = date('Y-m-d');
        $oneMonthAgo = gmdate("Y-m-d", time() - (30 * 24 * 60 * 60));
        $oneWeekLater = gmdate("Y-m-d", time() + (7 * 24 * 60 * 60));

        $currentIp = $this->ipAddress;
        $this->object = new WeatherIp();

        $currentIp = $this->object->validateIp($this->ipAddress);

        $accessKey  = '49a95e2b98f16776978bbf2d3097c542';
        $details = $this->requester->curlJson('http://api.ipstack.com/'.$currentIp.'?access_key='.$accessKey);

        $accessKey  = '6ff1debe5cff84d291f5345bd079fd90';
        $unixDate = strtotime($this->date);
        #get weather
        $weather = $this->requester->curlJson('https://api.darksky.net/forecast/'.$accessKey .'/'.$details['latitude'].','.$details['longitude'].','.$unixDate.'?exclude=minutely,hourly,daily,flags');

        if ($this->date < $oneMonthAgo || $this->date > $oneWeekLater) {
            $weather = null;
        }

        $data["details"] = $details;
        $data["weather"] = $weather;
        $data["currentIp"] = $currentIp;

        $data["today"] = $today;
        $data["oneMonthAgo"] = $oneMonthAgo;
        $data["oneWeekLater"] = $oneWeekLater;
        $data["chosenDate"] = $this->date;

        $page->add("anax/v2/weather/json", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
