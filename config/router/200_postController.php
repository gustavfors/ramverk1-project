<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "post",
            "mount" => "post",
            "handler" => "\Gufo\Post\PostController",
        ],
    ]
];
