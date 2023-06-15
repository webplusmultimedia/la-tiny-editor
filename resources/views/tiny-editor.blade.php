@php use Webplusmultimedia\LaTinyEditor\Components\LaTinyEditor;
    /** @var LaTinyEditor $field */
        $field = $getConfig();
        $id = $field->getId();
        $errorMessage =  $getErrorMessage($errors);

@endphp
@if($field->isHidden())

        <x-little-anonyme::form-components.fields.partials.hidden-field
            {{ $attributes->except(['field'])->merge([
                       'wire:model' . $field->getWireModifier() => $field->getWireName(),
                       'id' => $id,
                       'type' => 'hidden',
                       ])
            }}
        />
@else
    <x-dynamic-component :component="$field->getWrapperView()"
                         :id="$field->getWrapperId()"
                         {{ $attributes->class('')->merge(['class'=> $field->getColSpan()]) }}
                         x-data="{ errors : $wire.__instance.errors}"
    >
        <x-dynamic-component :component="$field->getViewComponentForLabel()"
                             :id="$id" class="form-label"
                             :label="$field->getLabel()"
                             :showRequired="$field->isRequired()"
        />
        <div>
            <div
                x-data="tinimce({
                    state : $wire.entangle(@js($field->getWireName())){{ $field->getWireModifier() }},
                    settings : @js($field->getSettings())
                })"
                x-cloak
                wire:ignore>
                <textarea x-ref="tinytextarea"></textarea>

            </div>
            <x-dynamic-component :component="$field->getViewComponentForHelperText()" :caption="$field->getHelperText()"/>
            <x-dynamic-component :component="$field->getViewComponentForErrorMessage()" :message="$errorMessage"/>
        </div>

    </x-dynamic-component>
@endif
@pushonce('scripts')
    <script src="{{ asset('vendor/la-tiny-editor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tinimce', ({state, settings}) => ({
                init() {
                    if (window.tinymce !== undefined)
                        tinymce.init({
                            target: this.$refs.tinytextarea,
                            plugins: settings.plugins,
                            max_height: settings.height,
                            statusbar: false,
                            paste_as_text: true,
                            branding: false,
                            image_advtab: false,
                            //images_upload_url: '/administration/media/upload',
                            images_upload_credentials: true,
                            images_upload_base_path: '/media/',
                            relative_urls: false,
                            image_uploadtab: false,
                            forced_root_block: settings.is_forced_root_block ? 'div' : null,
                            entity_encoding: 'raw',
                            menubar: false,
                            skin: 'oxide',
                            toolbar: settings.toolBar,
                            file_picker_callback: function (cb, value, meta) {
                                let popup = window.open('/administration/media/popup', '_blank', 'fullscreen=1,location=0,menubar=0,status=0,toolbar=0,titlebar=0,scrollbars=0');
                                if (popup) {
                                    window['onMediaFileSelected'] = function (url) {
                                        let location = window.location.origin,
                                            img_url = url.replace(location, '')
                                        cb(img_url, {alt: 'Test'})
                                        popup.close();
                                        return url;
                                    };
                                    popup.opener = window;
                                }

                                return false;
                            },
                            setup: (editor) => {
                                if(!window.tinySettingsCopy) {
                                    window.tinySettingsCopy = [];
                                }
                                window.tinySettingsCopy.push(editor.settings);

                                const $this = this

                                editor.on('blur', function (e) {
                                    $this.state = editor.getContent()
                                })

                                editor.on('init', function (e) {
                                    if ($this.state != null) {
                                        editor.setContent($this.state)
                                    }
                                })

                                function putCursorToEnd() {
                                    editor.selection.select(editor.getBody(), true);
                                    editor.selection.collapse(false);
                                }

                                this.$watch('state', function (newstate) {
                                    if (editor.container && newstate !== editor.getContent()) {
                                        editor.resetContent(newstate || '')
                                        putCursorToEnd();
                                    }
                                });
                            }
                        })
                    this.initValue = true
                },
                state: state,
                initValue: false,
            }))
        })
    </script>
@endpushonce
