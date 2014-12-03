## Gdpro Mailer

### Introduction

Gdpro Mailer is a module manage smtp connection, message, mailer. It permit to
add messages in a queue and to execute the job later through command line.


### Changelog

[doc/CHANGELOG.md](doc/CHANGELOG.md)


### Requirements

Please see the [composer.json](composer.json) file.


### Installation

Run the following `composer` command:

```console
$ composer require "gdpro/gdpro-mailer:~1.0"
```

Alternately, manually add the following to your `composer.json`, in
the `require` section:

```javascript
"require": {
    "gdpro/gdpro-mailer": "~1.0"
}
```

And then run `composer update` to ensure the module is installed.

Finally, add the module name to your project's `config/application.config.php`
under the `modules` key:

```php
return array(
    /* ... */
    'modules' => array(
        /* ... */
        'GdproMailer',
    ),
    /* ... */
);
```
