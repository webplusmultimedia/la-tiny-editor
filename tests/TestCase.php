<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Webplusmultimedia\LaTinyEditor\LaTinyEditorServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

    }

    protected function getPackageProviders($app)
    {
        return [
            LaTinyEditorServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {

    }
}
