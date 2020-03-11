# Settings Extension for Symphony CMS

-   Version: 0.1.0
-   Date: March 11 2020
-   [Release notes](https://github.com/pointybeard/settings/blob/master/CHANGELOG.md)
-   [GitHub repository](https://github.com/pointybeard/settings)

A [Symphony CMS Extension](https://www.getsymphony.com/) for storing and retrieving key/value settings in a simple and clean way.

## Installation

This is an extension for Symphony CMS. Add it to your `/extensions` folder in your Symphony CMS installation, run `composer update` to install required packages and then enable it though the interface.

### Requirements

This extension requires PHP 7.3 or greater.

This extension depends on the following Composer libraries:

-   [PHP Helpers](https://github.com/pointybeard/helpers)
-   [Symphony CMS: Section Builder](https://github.com/pointybeard/symphony-section-builder)
-   [Symphony CMS: Section Class Mapper](https://github.com/pointybeard/symphony-classmapper)

Run `composer update` on the `extension/settings` directory to install these.

## Usage

Here is an example of how to use this extension in your code.

### Saving Settings

There are 2 ways to save settings. By browsing to "System" > "Settings" in the admin and adding/editing/deleting settings or in code by using the Settings model.

```php
<?php

declare(strict_types=1);

use pointybeard\Symphony\Extensions\Settings\Models;

// Saving a new setting
(new Models\Settings)
    ->name("mysetting")
    ->value("one two three")
    ->group("myapp")
    ->save()
;
```

### Retriving Settings

The main use of this extension is going to be to recall settings when needed. There are 2 important methods to know about:

`Models\Setting::fetchByGroup()` and `Models\Setting::loadFromNameFilterByGroup()`

```php
<?php

declare(strict_types=1);

use pointybeard\Symphony\Extensions\Settings\Models;

// Retrieve a single setting using both it's name and group
$setting = Models\Setting::loadFromNameFilterByGroup("mysetting", "myapp");

// Retrieve an entire group of settings
$setting = Models\Setting::fetchByGroup("myapp");
```

The `fetchByGroup()` method returns an instance of `Settings\SettingsResultIterator` which includes an additional method you can use to find specific settings in a group of results.

```php
<?php

declare(strict_types=1);

use pointybeard\Symphony\Extensions\Settings\Models;

// Find a specific setting from a group of settings and return its value
$value = Models\Setting::fetchByGroup("myapp")->find("mysetting");
```

## Support

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/pointybeard/settings/issues),
or better yet, fork the library and submit a pull request.

## Contributing

We encourage you to contribute to this project. Please check out the [Contributing documentation](https://github.com/pointybeard/settings/blob/master/CONTRIBUTING.md) for guidelines about how to get involved.

## License

"Settings Extension for Symphony CMS" is released under the [MIT License](http://www.opensource.org/licenses/MIT).
