<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor\views;

use Illuminate\View\View;
use Webplusmultimedia\LaTinyEditor\Components\LaTinyEditor;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValidation;

class TinyEditor extends AbstractComponent
{
    use HasName;
    use HasValidation;

    public function __construct(
        LaTinyEditor $field,
        public ?string $name = null,
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'tiny-editor';
    }

    protected function setUp(Field $field): void
    {
        $this->field = $field;
        $this->name = $field->getName();
    }

    public function render(): View
    {
        return view('la-tiny-editor::' . $this->viewPath);
    }
}
