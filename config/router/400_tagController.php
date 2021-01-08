<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "tag",
            "mount" => "tag",
            "handler" => "\Gufo\Tag\TagController",
        ],
    ]
];
