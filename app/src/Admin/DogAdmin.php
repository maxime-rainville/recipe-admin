<?php

use SilverStripe\Admin\ModelAdmin;

/**
 * Simple ModelAdmin to manage dogs and breeds.
 */
class DogAdmin extends ModelAdmin {

    private static $managed_models = [
        Dog::class,
        Breed::class
    ];

    private static $menu_title = 'Manage Dogs';

    private static $url_segment = 'dogs';

    private static $menu_priority = 1;

}