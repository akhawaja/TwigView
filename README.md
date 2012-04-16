# TwigView - Laravel View Replacement #

TwigView replaces the default Laravel View class with the 
[Twig Template Engine](http://twig.sensiolabs.org/).

## Installation ##

1. Download the Source
1. Register the Bundle with Laravel
1. Replace the View alias (optional)

### Download the Source ###

Download a copy of the source from [Github](https://github.com/akhawaja/TwigView).

### Register the Bundle with Laravel ###

In the *application/bundles.php* file, register the TwigView bundle

```php
'twigview' => array(
    'location' => 'twigview', 'autoloads' => array(
        'map' => array(
            'TwigView\\View' => '(:bundle)/view.php',
        )
    )
)
```

### Replace the View alias (optional) ###

In the *application/config/application.php* file, replace the alias with the following:

```php
'aliases' => array(
    ...
    'View' => 'TwigView\\View',
);
```

If you leave the alias as-is, you can still call \TwigView\View in your controllers.

## Usage ##

All your views must have the *.twig* file extension. You can use the TwigView\View object in the same 
manner as the Laravel\View object. Just keep in mind that you are using Twig syntax inside your views.

## License ##

Copyright (c) 2012 Amir Khawaja

This software is provided 'as-is', without any express or implied warranty. In no event will the 
author be held liable for any damages arising from the use of this software.

Permission is granted to anyone to use this software for any purpose, including commercial 
applications, and to alter it and redistribute it freely, subject to the following restrictions:

- The origin of this software must not be misrepresented; you must not claim that you wrote the original software. 
If you use this software in a product, an acknowledgment in the product documentation would be appreciated 
but is not required.
- Altered source versions must be plainly marked as such, and must not be misrepresented as being the original software.
- This notice may not be removed or altered from any source distribution.

## Thanks ##

A special thank you to @michaelenger of [mustacheview](https://github.com/michaelenger/mustacheview) for the 
inspiration.