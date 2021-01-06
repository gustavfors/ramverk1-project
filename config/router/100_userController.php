<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "user",
            "mount" => "user",
            "handler" => "\Gufo\User\UserController",
        ],
    ]
];
