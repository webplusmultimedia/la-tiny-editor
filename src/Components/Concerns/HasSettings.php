<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor\Components\Concerns;

trait HasSettings
{
    protected array $settings = [
        'plugins' => null,
        'toolBar' => null,
        'height' => 400,
        'is_forced_root_block' => false,
    ];

    public function getSettings(): array
    {
        return [
            'plugins' => $this->getPlugIns(),
            'toolBar' => $this->getToolBar(),
            'height' => $this->getHeight(),
            'is_forced_root_block' => $this->isForcedRootBlock(),
        ];
    }

    protected function isForcedRootBlock(): bool
    {
        return 'mini' === $this->profile;
    }

    public function mini(): static
    {
        $this->profile = 'mini';

        return $this;
    }

    public function profile(string $profile = 'default'): static
    {
        $this->profile = $profile;

        return $this;
    }

    protected function getToolBar(): string
    {
        if ( ! $toolBar = config('la-tiny-editor.profiles.' . $this->profile . '.toolbar')) {
            return config('la-tiny-editor.profiles.default.toolbar');
        }

        return $toolBar;
    }

    protected function getPlugIns(): string
    {
        if ( ! $plugins = config('la-tiny-editor.profiles.' . $this->profile . '.plugins')) {
            return config('la-tiny-editor.profiles.default.plugins');
        }

        return $plugins;
    }

    protected function getHeight(): int
    {
        if ('default' === $this->profile) {
            return 400;
        }

        return 200;
    }
}
