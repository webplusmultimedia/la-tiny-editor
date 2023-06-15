<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor\Components;

use Webplusmultimedia\LaTinyEditor\Components\Concerns\HasSettings;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

class LaTinyEditor extends Field
{
    use HasSettings;

    protected string $type = 'tinymce';

    protected string $view = 'tiny-editor';

    protected string $profile = 'default';

    public function getFieldView(): string
    {
        return "la-views::{$this->view}";
    }
}
