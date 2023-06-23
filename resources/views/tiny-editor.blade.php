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
                         @class(['col-span-full'])
                         x-data="{ errors : $wire.__instance.errors}"
    >
        <x-dynamic-component :component="$field->getViewComponentForLabel()"
                             :id="$id" class="form-label"
                             :label="$field->getLabel()"
                             :showRequired="$field->isRequired()"
        />
        <div>
            <div
                x-data="{
                    state : $wire.entangle(@js($field->getWireName())){{ $field->getWireModifier() }},
                    initialized: false,
                    settings : @js($field->getSettings()),
                    name : @js($field->getWireName())
                }"
                x-init="(()=>{
                    window[name] = {
                                target: $refs.tinymce,
                                language : settings.lang,
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
                               /* file_picker_callback: function (cb, value, meta) {
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
                                },*/
                                setup: (editor) => {
                                    if(!window.tinySettingsCopy) {
                                        window.tinySettingsCopy = [];
                                    }
                                    window.tinySettingsCopy.push(editor.options);

                                    editor.options.register('name_init',{ processor : 'string', default : '' })
                                    editor.options.set('name_init',name)

                                    editor.on('change', function (e) {
                                        state = editor.getContent()
                                    })

                                    editor.on('init', function (e) {
                                        if (state != null) {
                                            editor.setContent(state)
                                        }
                                    })

                                    function putCursorToEnd() {
                                        editor.selection.select(editor.getBody(), true);
                                        editor.selection.collapse(false);
                                    }

                                    $watch('state', function (newstate) {
                                        if (editor.container && newstate !== editor.getContent()) {
                                            editor.resetContent(newstate || '')
                                            putCursorToEnd();
                                        }
                                    });
                                }
                            };
                    window.addEventListener('DOMContentLoaded', () => initTinymce());
                    $nextTick(() => initTinymce());
                    const initTinymce = ()=>{
                        if (window.tinymce !== undefined && initialized === false){
                            tinymce.init(window[name]);
                             initialized = true;
                       }
                    }
                    /*if (!window.tinyMceInitialized) {
                        window.tinyMceInitialized = true;
                        $nextTick(() => {
                            Livewire.hook('element.removed', (el, component) => {
                                if (el.nodeName === 'INPUT' && el.getAttribute('x-ref') === 'tinymce') {

                                    tinymce.get(el.id)?.remove();
                                }
                            });
                        });
                    }*/
                })()"
                style="min-height: {{ $field->getSettings()['height'] }}px"
                x-cloak
                wire:ignore>
                @unless($field->isDisabled())
                    <input type="hidden" x-ref="tinymce" id="input-{{ $id }}"/>
                @else
                    <div class="w-full rounded-lg border border-gray-300 bg-white p-4 text-sm opacity-70 shadow-sm transition duration-75 "
                         x-html="state"
                    >
                    </div>
                @endunless

            </div>
            <x-dynamic-component :component="$field->getViewComponentForHelperText()" :caption="$field->getHelperText()"/>
            <x-dynamic-component :component="$field->getViewComponentForErrorMessage()" :message="$errorMessage"/>
        </div>

    </x-dynamic-component>
@endif
@pushonce('scripts')
    <script src="{{ asset('vendor/la-tiny-editor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sortableClass = [
                'filament-forms-builder-component',
                'filament-forms-repeater-component',
            ];

            Livewire.hook('element.updated', (el, component) => {
                if (!window.tinySettingsCopy) {
                    return;
                }
                const isModalOpen = document.body.classList.contains('tox-dialog__disable-scroll');

                if (!isModalOpen /*&& sortableClass.some(i => el.classList.contains(i))*/) {
                    removeEditors();
                }
            })

            const removeEditors = debounce(() => {
                window.tinySettingsCopy.forEach(i => {
                    tinymce.execCommand('mceRemoveEditor', true, i.get('id'))
                    setTimeout(() => {
                        tinymce.init(window[i.get('name_init')])
                    }, 2)
                });
            }, 50);

            const reinitializeEditors = debounce(() => {
                window.tinySettingsCopy.forEach(settings => tinymce.init(settings))
            });

            function debounce(callback, timeout = 100) {
                let timer;
                return (...args) => {
                    clearTimeout(timer);
                    timer = setTimeout(() => {
                        callback.apply(this, args);
                        //console.log({args})
                    }, timeout);
                };
            }
        })
    </script>
@endpushonce
