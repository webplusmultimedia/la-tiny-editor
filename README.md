# Tiny MCE Editor 6.4.2 for Little Admin

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webplusmultimedia/la-tiny-editor.svg?style=flat-square)](https://packagist.org/packages/webplusmultimedia/la-tiny-editor)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/webplusmultimedia/la-tiny-editor/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/webplusmultimedia/la-tiny-editor/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/webplusmultimedia/la-tiny-editor/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/webplusmultimedia/la-tiny-editor/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/webplusmultimedia/la-tiny-editor.svg?style=flat-square)](https://packagist.org/packages/webplusmultimedia/la-tiny-editor)

TinyMce plugin for Little Admin.
[![S-lection-004.png](https://i.postimg.cc/PJGwsYt3/S-lection-004.png)](https://postimg.cc/dkB1G7Zr)
## Support us

Coming soon

## Installation

You can install the package via composer:

```bash
composer require webplusmultimedia/la-tiny-editor
```

Publish the assets:

```bash
php artisan vendor:publish --tag=la-tiny-editor-assets
```

Publish the config file with:

```bash
php artisan vendor:publish --tag="la-tiny-editor-config"
```

Then, add some profile to use with tinyMce:

```php
return [
    'profile' => [
    ...
        'myconf' => [
                'plugins' => 'autolink link code',
                'toolbar' => 'undo redo | bold italic underline | link | removeformat code brbtn',
            ],
    ...     
    ]
];
```

 
## Usage

In the resource file of little Admin 

```php
public static function getFormSchema(Form $form): Form
    {
        return $form
            ->schema([
                LaTinyEditor::make('extrait')
                    ->nullable()
                    ->profile('myconf')
                    ->required(),
                LaTinyEditor::make('texte')
                    ->nullable()
                    ->helperText('Texte d\'apprentissage')->required(),
            ]);
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Webplusm](https://github.com/webplusmultimedia)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
