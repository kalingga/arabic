(function() {
    const { __ } = wp.i18n;

    tinymce.create('tinymce.plugins.ngarab', {
        init : function(ed, url) {
            ed.addButton('ngarab', {
                title : __('Insert (ng)Arab Shortcode', 'arabic'),
                cmd : 'ngarab_insert_shortcode',
                image : url + '/../icon.svg',
                text: '(ng)Arab'
            });

            ed.addCommand('ngarab_insert_shortcode', function() {
                ed.windowManager.open({
                    title: __('Insert Arabic Text', 'arabic'),
                    body: [
                        {
                            type: 'listbox',
                            name: 'font_family',
                            label: __('Select Font', 'arabic'),
                            'values': [
                                {text: __('Default (from Settings)', 'arabic'), value: ''},
                                {text: __('LPMQ Isep Misbah', 'arabic'), value: 'lpmq'},
                                {text: __('Amiri', 'arabic'), value: 'amiri'},
                                {text: __('Amiri Quran', 'arabic'), value: 'amiri-quran'},
                                {text: __('Lateef', 'arabic'), value: 'lateef'},
                                {text: __('Noto Nastaliq Urdu', 'arabic'), value: 'noto-nastaliq'},
                                {text: __('Scheherazade New', 'arabic'), value: 'scheherazade'}
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
                                    var family = fontStacks[fontValue] || fontStacks['lpmq'];
                                    previewEl.style.setProperty('font-family', family, 'important');
                                }
                            }
                        },
                        {
                            type: 'container',
                            label: __('Preview', 'arabic'),
                            html: '<div id="ngarab-mce-preview" class="mce-ngarab-preview" style="font-family: \'LPMQ\', serif;">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</div>'
                        },
                        {
                            type: 'textbox',
                            name: 'arabic_text',
                            label: __('Arabic Text', 'arabic'),
                            multiline: true,
                            minWidth: 400,
                            minHeight: 150
                        },
                        {
                            type: 'colorpicker',
                            name: 'text_color',
                            label: __('Arabic Color', 'arabic')
                        },
                        {
                            type: 'textbox',
                            name: 'trans_text',
                            label: __('Transliteration (Latin)', 'arabic')
                        },
                        {
                            type: 'textbox',
                            name: 'trj_text',
                            label: __('Translation (Arti)', 'arabic')
                        },
                        {
                            type: 'checkbox',
                            name: 'show_copy',
                            label: __('Show Copy Button', 'arabic'),
                            text: __('Activate', 'arabic')
                        }
                    ],
                    onsubmit: function(e) {
                        var arabic_text = e.data.arabic_text;
                        var font = e.data.font_family;
                        var color = e.data.text_color;
                        var trans = e.data.trans_text;
                        var trj = e.data.trj_text;
                        var copy = e.data.show_copy ? 'yes' : '';

                        var attrs = '';
                        if (font) attrs += ' font="' + font + '"';
                        if (color) attrs += ' color="' + color + '"';
                        if (trans) attrs += ' trans="' + trans + '"';
                        if (trj) attrs += ' trj="' + trj + '"';
                        if (copy) attrs += ' copy="' + copy + '"';

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
