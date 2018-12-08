<?php

namespace Edward\Requester;

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
class Requester implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Curl URL and return JSON
     *
     * @return array
     */
    public function curlJson($url)
    {
        // Initialize CURL:
        $initization = curl_init($url);
        curl_setopt($initization, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($initization);
        curl_close($initization);

        // Decode JSON response:
        return json_decode($json, true);
    }
}
