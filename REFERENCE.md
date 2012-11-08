# TwigView Reference #

The following functions and filters are currently supported inside a Twig view:

## Filters ##

### slugify ###

Take a string and convert it to a URL friendly string.

Params:

- $separator: Defaults to &quot;-&quot;
- e.g. {{ "This is a long url"|slugify }}

## Functions ##

### config ###

Read a config value. Use the same format as Laravel.

Params:

- $conf: The config key to read
- $default: The default value when nothing is found
- e.g. {{ conf('application.key') }}

### email ###

Hide the email from bots.

Params:

- $email: The email address to hide
- e.g. {{ email('person@domain.com') }}

### image ###

Generate an image tag.

Params:

- $file: The file relative to your public directory
- $alt: The HTML alt attribute
- $params: Additional HTML attributes
- e.g. {{ image('img/sample.jpg', 'Sample Photo', 'width=120 & height=100 & title=something') }}

### link ###

Generate an link tag.

Params:

- $dest: The file relative to your public directory
- $title: The HTML title attribute
- $params: Additional HTML attributes
- e.g. {{ link('css/sample.css', 'Sample File', 'data-title=example') }}

### script ###

Generate an script tag.

Params:

- $file: The file relative to your public directory
- $params: Additional HTML attributes
- e.g. {{ script('js/sample.js', 'data-type=example & another=one') }}

### secure_link ###

Generate an anchor tag using HTTPS as the scheme.

Params:

- $dest: The URL
- $title: The HTML title attribute
- $params: Additional HTML attributes
- e.g. {{ secure_link('account/admin', 'View account', 'class=btn') }}

### secure_url_to ###

Generate a secure URL to a Route.

Params:

- $route: The Route
- $params: Additional HTML attributes
- e.g. {{ secure_url_to('account/admin', 'class=btn') }}

### style ###

Generate a link tag to reference a CSS file.

Params:

- $file: The file relative to your public directory
- $params: Additional HTML attributes
- e.g. {{ style('css/sample.css', 'foo=bar & data-type=something') }}

### tr ###

Translate a string using Laravel Lang object.

Params:

- $key: The language string key
- $subst: The string to substitute
- $lang: The language to use when translating (defaults to 'en')
- e.g. {{ tr('Hello :name. Today is :weather', 'name=World & weather=Cold') }}

### url_to ###

Generate a URL to an Action.

Params:

- $route: The Route to create the URL for
- $params: Additional HTML attributes
- e.g. {{ url_to('admin/account', 'class=btn & title=something') }}

### url_to_route ###

Generate a URL to a Route.

Params:

- $route: The Route
- $params: Additional HTML attributes
- e.g. {{ url_to_route('admin/account', 'class=btn & title=something') }}

### url_to_secure_route ###

Generate a URL to a route using the HTTPS scheme.

Params:

- $route: The Route
- $params: Additional HTML attributes
- e.g. {{ url_to_secure_route('admin/account', 'class=btn & title=something') }}

### val ###

An Input value using the Laravel\Input class.

Params:

- $name: The name of the Input key
- $default: The default value to use when the Input value is not found
- e.g. {{ val('username', 'Anonymous') }}

## Form Functions ##

The following form helpers are included to make sure that building forms in twig views is as painless as possible.

All functions take the same arguments as their `Laravel\Form` counterpart, you can find information on that at http://laravel.com/docs/views/forms, and in the form class API at http://laravel.com/api/class-Laravel.Form.html.

```twig
{#  Form::open() #}
{{ form_open }}

{# Form::open_secure() #}
{{ form_open_secure() }}

{# Form::open_for_files() #}
{{ form_open_for_files() }}

{# Form::open_secure_for_files #}
{{ form_open_secure_for_files() }}

{# Form::close() #}
{{ form_close() }}

{# Form::label() #}
{{ form_label() }}

{# Form::text() #}
{{ form_text() }}

{# Form::submit() #}
{{ form_submit() }}

{# Form::textarea() #}
{{ form_textarea() }}

{# Form::hidden() #}
{{ form_hidden() }}

{# Form::token() #}
{{ form_token() }}

{# Form::checkbox() #}
{{ form_checkbox() }}

{# Form::radio() #}
{{ form_radio() }}

{# Form::select #}
{{ form_select() }}
```
