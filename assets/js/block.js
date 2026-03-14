(function() {
    const { registerBlockType } = wp.blocks;
    const { RichText, InspectorControls, PanelColorSettings } = wp.blockEditor;
    const { PanelBody, SelectControl, ToggleControl } = wp.components;
    const { __ } = wp.i18n;

    registerBlockType('ngarab/main', {
        title: '(ng)Arab',
        icon: 'translation',
        category: 'text',
        attributes: {
            content: { type: 'string', source: 'html', selector: '.arab' },
            font: { type: 'string', default: '' },
            color: { type: 'string', default: '' },
            trans: { type: 'string', default: '' },
            trj: { type: 'string', default: '' },
            showCopy: { type: 'boolean', default: false }
        },
        edit: function(props) {
            const { attributes: { content, font, color, trans, trj, showCopy }, setAttributes } = props;

            const fontOptions = [
                {label: __('Default', 'arabic'), value: ''},
                {label: __('LPMQ Isep Misbah', 'arabic'), value: 'lpmq'},
                {label: __('Amiri', 'arabic'), value: 'amiri'},
                {label: __('Amiri Quran', 'arabic'), value: 'amiri-quran'},
                {label: __('Lateef', 'arabic'), value: 'lateef'},
                {label: __('Noto Nastaliq Urdu', 'arabic'), value: 'noto-nastaliq'},
                {label: __('Scheherazade New', 'arabic'), value: 'scheherazade'}
            ];

            const fontStacks = {
                '': 'inherit',
                'lpmq': "'LPMQ', serif",
                'amiri': "'Amiri', serif",
                'amiri-quran': "'Amiri Quran', 'Amiri', serif",
                'lateef': "'Lateef', cursive",
                'noto-nastaliq': "'Noto Nastaliq Urdu', cursive",
                'scheherazade': "'Scheherazade New', serif"
            };

            return [
                wp.element.createElement(InspectorControls, { key: 'inspector' },
                    wp.element.createElement(PanelBody, { title: __('Typography', 'arabic') },
                        wp.element.createElement(SelectControl, {
                            label: __('Arabic Font', 'arabic'),
                            value: font,
                            options: fontOptions,
                            onChange: (val) => setAttributes({ font: val })
                        })
                    ),
                    wp.element.createElement(PanelColorSettings, {
                        title: __('Colors', 'arabic'),
                        colorSettings: [
                            {
                                value: color,
                                onChange: (val) => setAttributes({ color: val }),
                                label: __('Arabic Text Color', 'arabic')
                            }
                        ]
                    }),
                    wp.element.createElement(PanelBody, { title: __('Meta Settings', 'arabic') },
                        wp.element.createElement(RichText, {
                            tagName: 'div',
                            placeholder: __('Transliteration...', 'arabic'),
                            value: trans,
                            onChange: (val) => setAttributes({ trans: val }),
                            style: { fontStyle: 'italic', marginBottom: '10px' }
                        }),
                        wp.element.createElement(RichText, {
                            tagName: 'div',
                            placeholder: __('Translation (Terjemahan)...', 'arabic'),
                            value: trj,
                            onChange: (val) => setAttributes({ trj: val }),
                            style: { fontWeight: 'bold' }
                        }),
                        wp.element.createElement(ToggleControl, {
                            label: __('Show Copy Button', 'arabic'),
                            checked: showCopy,
                            onChange: (val) => setAttributes({ showCopy: val })
                        })
                    )
                ),
                wp.element.createElement('div', { className: 'ngarab-block-editor-wrap' },
                    wp.element.createElement(RichText, {
                        tagName: 'div',
                        className: 'arab',
                        style: { 
                            fontFamily: fontStacks[font], 
                            color: color,
                            textAlign: 'right',
                            fontSize: '24pt',
                            direction: 'rtl'
                        },
                        value: content,
                        onChange: (val) => setAttributes({ content: val }),
                        placeholder: __('أدخل النص العربي هنا...', 'arabic')
                    })
                )
            ];
        },
        save: function() {
            return null; // Render via PHP
        }
    });
})();
