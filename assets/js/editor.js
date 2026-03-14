(function() {
    tinymce.create('tinymce.plugins.ngarab', {
        init : function(ed, url) {
            ed.addButton('ngarab', {
                title : 'Insert (ng)Arab Shortcode',
                cmd : 'ngarab_insert_shortcode',
                image : url + '/../icon.svg',
                text: '(ng)Arab'
            });

            ed.addCommand('ngarab_insert_shortcode', function() {
                ed.windowManager.open({
                    title: 'Insert Arabic Text',
                    body: [
                        {
                            type: 'listbox',
                            name: 'font_family',
                            label: 'Select Font',
                            'values': [
                                {text: 'Default (from Settings)', value: ''},
                                {text: 'LPMQ Isep Misbah', value: 'lpmq'},
                                {text: 'Amiri', value: 'amiri'},
                                {text: 'Amiri Quran', value: 'amiri-quran'},
                                {text: 'Lateef', value: 'lateef'},
                                {text: 'Noto Nastaliq Urdu', value: 'noto-nastaliq'},
                                {text: 'Scheherazade New', value: 'scheherazade'}
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
                            label: 'Preview',
                            html: '<div id="ngarab-mce-preview" class="mce-ngarab-preview" style="font-family: \'LPMQ\', serif;">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</div>'
                        },
                        {
                            type: 'textbox',
                            name: 'arabic_text',
                            label: 'Arabic Text',
                            multiline: true,
                            minWidth: 400,
                            minHeight: 150
                        },
                        {
                            type: 'colorpicker',
                            name: 'text_color',
                            label: 'Arabic Color'
                        },
                        {
                            type: 'textbox',
                            name: 'trans_text',
                            label: 'Transliteration (Latin)'
                        },
                        {
                            type: 'textbox',
                            name: 'trj_text',
                            label: 'Translation (Arti)'
                        },
                        {
                            type: 'checkbox',
                            name: 'show_copy',
                            label: 'Show Copy Button',
                            text: 'Activate'
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
