<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor;

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
}
