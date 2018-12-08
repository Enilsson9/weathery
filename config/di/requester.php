<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "requester" => [
            "shared" => true,
            //"callback" => "\Anax\Response\Response",
            "callback" => function () {
                $obj = new \Edward\Requester\Requester();

                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];
