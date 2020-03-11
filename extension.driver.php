<?php

declare(strict_types=1);

if (!file_exists(__DIR__.'/vendor/autoload.php')) {
    throw new Exception(sprintf(
        'Could not find composer autoload file %s. Did you run `composer update` in %s?',
        __DIR__.'/vendor/autoload.php',
        __DIR__
    ));
}

require_once __DIR__.'/vendor/autoload.php';

use pointybeard\Symphony\Extensions\Settings;
use pointybeard\Symphony\SectionBuilder;
use pointybeard\Symphony\SectionBuilder\Models\Section;

// Check if the class already exists before declaring it again.
if (!class_exists('\\Extension_Settings')) {
    class Extension_Settings extends Extension
    {
        public static function init()
        {
        }

        public function enable()
        {
            return $this->install();
        }

        public function uninstall()
        {
        }

        public function install()
        {
            if (!(Section::loadFromHandle('settings') instanceof Section)) {
                SectionBuilder\Import::fromJsonFile(__DIR__.'/src/Install/sections.json', SectionBuilder\Import::FLAG_SKIP_ORDERING);
            }

            return true;
        }
    }
}
