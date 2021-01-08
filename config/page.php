<?php
/**
 * Configuration file for page which can create and put together web pages
 * from a collection of views. Through configuration you can add the
 * standard parts of the page, such as header, navbar, footer, stylesheets,
 * javascripts and more.
 */
return [
    // This layout view is the base for rendering the page, it decides on where
    // all the other views are rendered.
    "layout" => [
        "region" => "layout",
        "template" => "layout/plain",
        "data" => [
            "baseTitle" => " | ramverk1",
            "bodyClass" => null,
            "favicon" => "favicon.ico",
            "htmlClass" => null,
            "lang" => "sv",
            "stylesheets" => [
                "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css",
                "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css",
                "css/custom.css"
            ],
            "javascripts" => [
                // "js/responsive-menu.js",
               "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            ],
        ],
    ],

    // These views are always loaded into the collection of views.
    "views" => [
        [
            "region" => "header-col-1",
            "template" => "anax/v2/header/site_logo",
            "data" => [
                "class" => "large",
                "siteLogo"      => "image/theme/leaf_256x256.png",
                "siteLogoAlt"   => "Löv",
            ],
        ],
        [
            "region" => "header-col-1",
            "template" => "anax/v2/header/site_logo_text",
            "data" => [
                "homeLink"      => "",
                "siteLogoText"  => "ramverk1",
                "siteLogoTextIcon" => "image/theme/leaf_40x40.png",
                "siteLogoTextIconAlt" => "Löv-bild",
            ],
        ],
        [
            "region" => "header-col-2",
            "template" => "anax/v2/navbar/navbar_submenus",
            "data" => [
                "navbarConfig" => require __DIR__ . "/navbar/header.php",
            ],
        ],
        [
            "region" => "header-col-3",
            "template" => "anax/v2/navbar/responsive_submenus",
            "data" => [
                "navbarConfig" => require __DIR__ . "/navbar/responsive.php",
            ],
        ],
        [
            "region" => "footer",
            "template" => "anax/v2/columns/multiple_columns",
            "data" => [
                "class"  => "footer-column",
                "columns" => [
                    [
                        "template" => "anax/v2/block/default",
                        "contentRoute" => "block/footer-col-1",
                    ],
                    [
                        "template" => "anax/v2/block/default",
                        "contentRoute" => "block/footer-col-2",
                    ],
                    [
                        "template" => "anax/v2/block/default",
                        "contentRoute" => "block/footer-col-3",
                    ]
                ]
            ],
            "sort" => 1
        ],
        [
            "region" => "footer",
            "template" => "anax/v2/block/default",
            "data" => [
                "class"  => "site-footer",
                "contentRoute" => "block/footer",
            ],
            "sort" => 2
        ],
    ],
];
