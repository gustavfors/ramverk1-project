<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "reply",
            "mount" => "reply",
            "handler" => "\Gufo\Reply\ReplyController",
        ],
    ]
];
