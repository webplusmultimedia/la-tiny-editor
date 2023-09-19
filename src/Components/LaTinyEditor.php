<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor\Components;

use Webplusmultimedia\LaTinyEditor\Components\Concerns\HasSettings;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasTranslation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

class LaTinyEditor extends Field
{
    use HasSettings;
    use HasTranslation;

    protected string $type = 'tinymce';

    protected string $view = 'tiny-editor';

    protected string $profile = 'default';

    protected string $language = 'fr_FR';

    public function getView(): string
    {
        return 'la-tiny-editor::' . $this->view;
    }

    public function getFieldView(): string
    {
        return "la-views::{$this->view}";
    }

    public function setUp(): void
    {
        if ($this->HasTranslated()) {
            $this->name = $this->name . '-translations';
            $this->setTranslateName($this->getStatePath());
            $this->addRules('array');

            $this->afterStateHydrated(static function (string|null|array $state, LaTinyEditor $component): void {
                if (blank($state)) {
                    //Initialize $state for spatie/laravel-translatable
                    $state = data_get($component->livewire, 'data.translations.' . str($component->name)->beforeLast('-translations')->toString());
                    if ( ! $state) {
                        $state = [];
                        foreach (Form::getTranslatedLangues() as $langue) {
                            $state[$langue] = '';
                        }
                    } else {
                        foreach (Form::getTranslatedLangues() as $langue) {
                            if ( ! isset($state[$langue])) {
                                $state[$langue] = ''; // Define missing translation
                            }
                        }
                    }
                    $component->state($state);

                }
            });

            $this->afterStateDehydratedUsing(static function (?array $state, LaTinyEditor $component): array {
                if (null === $state) {
                    $state = data_get($component->livewire, 'data.translations.' . str($component->name)->beforeLast('-translations')->toString());
                }

                return $state;
            });
        }
    }
}
