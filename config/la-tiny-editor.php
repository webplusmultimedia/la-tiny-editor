<?php

declare(strict_types=1);

// config for Webplusmultimedia/LaTinyEditor
return [
    'profiles' => [

        'default' => [
            'plugins' => 'codesample advlist autolink lists link image code media table quickbars',
            'toolbar' => 'undo redo' .
                ' | removeformat | blocks | bold italic underline  superscript subscript strikethrough' .
                ' | alignleft  aligncenter alignright alignjustify' .
                ' | bullist numlist blockquote outdent indent' .
                ' | link image table' .
                ' | code codesample',
        ],

        'mini' => [
            'plugins' => 'autolink link code',
            'toolbar' => 'undo redo | bold italic underline | link | removeformat code brbtn',
        ],

        'simple' => [
            'plugins' => 'autolink autoresize  link wordcount code',
            'toolbar' => 'undo redo | removeformat | bold italic underline | link | code',
        ],

        'template' => [
            'plugins' => 'autoresize template',
            'toolbar' => 'template',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    | You can add as many as you want of templates to use it in your application.
    |
    | https://www.tiny.cloud/docs/plugins/opensource/template/#templates
    |
    | ex: TinyEditor::make('content')->profiles('template')->templates('example')
    */

    'templates' => [

        'example' => [
            // content
            ['title' => 'Some title 1', 'description' => 'Some desc 1', 'content' => 'My content'],
            // url
            ['title' => 'Some title 2', 'description' => 'Some desc 2', 'url' => 'http://localhost'],
        ],

    ],
];
