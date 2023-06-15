<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaTinyEditorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('la-tiny-editor')
            ->hasConfigFile()
            ->hasAssets()
            ->hasViews();
    }

    public function bootingPackage(): void
    {
        Blade::componentNamespace('Webplusmultimedia\\LaTinyEditor\\views', 'la-views');
    }
}
