<?php
/**
 * Configuration file for database service.
 */

return [
    // Services to add to the container.
    "services" => [
        "db" => [
            "shared" => true,
            "callback" => function () {
                $db = \Gufo\Sqlite\Sqlite::connect();
                return $db;
            }
        ],
    ],
];
