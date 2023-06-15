<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Webplusmultimedia\LaTinyEditor\LaTinyEditor
 */
class LaTinyEditor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Webplusmultimedia\LaTinyEditor\LaTinyEditor::class;
    }
}
