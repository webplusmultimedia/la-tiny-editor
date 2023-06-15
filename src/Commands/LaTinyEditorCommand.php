<?php

declare(strict_types=1);

namespace Webplusmultimedia\LaTinyEditor\Commands;

use Illuminate\Console\Command;

class LaTinyEditorCommand extends Command
{
    public $signature = 'la-tiny-editor';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
