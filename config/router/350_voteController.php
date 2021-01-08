<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "vote",
            "mount" => "vote",
            "handler" => "\Gufo\Vote\VoteController",
        ],
    ]
];
