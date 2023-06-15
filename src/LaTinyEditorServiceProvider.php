<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaTinyEditorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('la-tiny-editor')
            ->hasConfigFile()
            ->hasViews();
    }
}
