(function() {
    const { __ } = wp.i18n;

    tinymce.create('tinymce.plugins.ngarab', {
        init : function(ed, url) {
            ed.addButton('ngarab', {
                title : __('Insert (ng)Arab Shortcode', 'ngarab'),
                cmd : 'ngarab_insert_shortcode',
                image : url + '/../icon.svg',
                text: '(ng)Arab'
            });

            ed.addCommand('ngarab_insert_shortcode', function() {
                ed.windowManager.open({
                    title: __('Insert Arabic Text', 'ngarab'),
                    body: [
                        {
                            type: 'listbox',
                            name: 'font_family',
                            label: __('Select Font', 'ngarab'),
                            'values': [
                                {text: __('Default (from Settings)', 'ngarab'), value: ''},
                                {text: __('LPMQ Isep Misbah', 'ngarab'), value: 'lpmq'},
                                {text: __('Amiri', 'ngarab'), value: 'amiri'},
                                {text: __('Amiri Quran', 'ngarab'), value: 'amiri-quran'},
                                {text: __('Lateef', 'ngarab'), value: 'lateef'},
                                {text: __('Noto Nastaliq Urdu', 'ngarab'), value: 'noto-nastaliq'},
                                {text: __('Scheherazade New', 'ngarab'), value: 'scheherazade'}
                            ],
                            onselect: function(e) {
                                var fontStacks = {
                                    'lpmq': "'LPMQ', serif",
                                    'amiri': "'Amiri', serif",
                                    'amiri-quran': "'Amiri Quran', 'Amiri', serif",
                                    'lateef': "'Lateef', cursive",
                                    'noto-nastaliq': "'Noto Nastaliq Urdu', cursive",
                                    'scheherazade': "'Scheherazade New', serif"
                                };
                                var fontValue = this.value();
                                var previewEl = document.getElementById('ngarab-mce-preview');
                                if (previewEl) {
                                    var family = fontStacks[fontValue] || fontStacks['scheherazade'];
                                    previewEl.style.setProperty('font-family', family, 'important');
                                }
                            }
                        },
                        {
                            type: 'container',
                            label: __('Preview', 'ngarab'),
                            html: '<div id="ngarab-mce-preview" class="mce-ngarab-preview" style="font-family: \'Scheherazade New\', serif; direction: rtl; text-align: right; width: 100%;">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</div>'
                        },
                        {
                            type: 'textbox',
                            name: 'arabic_text',
                            label: __('Arabic Text', 'ngarab'),
                            multiline: true,
                            minWidth: 400,
                            minHeight: 150,
                            classes: 'ngarab-rtl-textarea'
                        },
                        {
                            type: 'colorpicker',
                            name: 'text_color',
                            label: __('Arabic Color', 'ngarab')
                        },
                        {
                            type: 'textbox',
                            name: 'trans_text',
                            label: __('Transliteration (Latin)', 'ngarab')
                        },
                        {
                            type: 'textbox',
                            name: 'trj_text',
                            label: __('Translation (Arti)', 'ngarab')
                        },
                        {
                            type: 'listbox',
                            name: 'text_align',
                            label: __('Text Align', 'ngarab'),
                            'values': [
                                {text: __('Right', 'ngarab'), value: 'right'},
                                {text: __('Center', 'ngarab'), value: 'center'},
                                {text: __('Left', 'ngarab'), value: 'left'}
                            ],
                            onselect: function(e) {
                                var align = this.value();
                                var previewEl = document.getElementById('ngarab-mce-preview');
                                if (previewEl) {
                                    previewEl.style.setProperty('text-align', align, 'important');
                                }
                            }
                        },
                        {
                            type: 'checkbox',
                            name: 'show_copy',
                            label: __('Show Copy Button', 'ngarab'),
                            text: __('Activate', 'ngarab')
                        },
                        {
                            type: 'checkbox',
                            name: 'convert_num',
                            label: __('Convert Numbers', 'ngarab'),
                            text: __('Standard (0-9) to Arabic (٠-٩)', 'ngarab'),
                            value: true
                        }
                    ],
                    onOpen: function() {
                        // Aggressively force RTL on the Arabic textarea
                        setTimeout(function() {
                            var textareas = document.querySelectorAll('.mce-ngarab-rtl-textarea textarea, textarea.mce-ngarab-rtl-textarea');
                            textareas.forEach(function(textarea) {
                                textarea.style.setProperty('direction', 'rtl', 'important');
                                textarea.style.setProperty('text-align', 'right', 'important');
                                textarea.style.setProperty('unicode-bidi', 'plaintext', 'important');
                                textarea.style.setProperty('font-size', '22px', 'important');
                                textarea.style.setProperty('font-family', '"LPMQ", "Amiri", serif', 'important');
                            });
                        }, 100);
                    },
                    onsubmit: function(e) {
                        var arabic_text = e.data.arabic_text;
                        var font = e.data.font_family;
                        var color = e.data.text_color;
                        var trans = e.data.trans_text;
                        var trj = e.data.trj_text;
                        var align = e.data.text_align;
                        var copy = e.data.show_copy ? 'yes' : '';

                        var attrs = '';
                        if (font) attrs += ' font="' + font + '"';
                        if (color) attrs += ' color="' + color + '"';
                        if (align && align !== 'right') attrs += ' align="' + align + '"';
                        if (trans) attrs += ' trans="' + trans + '"';
                        if (trj) attrs += ' trj="' + trj + '"';
                        if (copy) attrs += ' copy="' + copy + '"';

                        if (e.data.convert_num) attrs += ' convert_num="1"';
                        else attrs += ' convert_num="0"';

                        if (arabic_text.length > 0) {
                            ed.insertContent('[ngarab' + attrs + ']' + arabic_text + '[/ngarab]');
                        }
                    }
                });
            });
        },
    });
    tinymce.PluginManager.add('ngarab', tinymce.plugins.ngarab);
})();
