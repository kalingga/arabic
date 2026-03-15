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
                {label: __('Default', 'ngarab'), value: ''},
                {label: __('LPMQ Isep Misbah', 'ngarab'), value: 'lpmq'},
                {label: __('Amiri', 'ngarab'), value: 'amiri'},
                {label: __('Amiri Quran', 'ngarab'), value: 'amiri-quran'},
                {label: __('Lateef', 'ngarab'), value: 'lateef'},
                {label: __('Noto Nastaliq Urdu', 'ngarab'), value: 'noto-nastaliq'},
                {label: __('Scheherazade New', 'ngarab'), value: 'scheherazade'}
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
                    wp.element.createElement(PanelBody, { title: __('Typography', 'ngarab') },
                        wp.element.createElement(SelectControl, {
                            label: __('Arabic Font', 'ngarab'),
                            value: font,
                            options: fontOptions,
                            onChange: (val) => setAttributes({ font: val })
                        })
                    ),
                    wp.element.createElement(PanelColorSettings, {
                        title: __('Colors', 'ngarab'),
                        colorSettings: [
                            {
                                value: color,
                                onChange: (val) => setAttributes({ color: val }),
                                label: __('Arabic Text Color', 'ngarab')
                            }
                        ]
                    }),
                    wp.element.createElement(PanelBody, { title: __('Meta Settings', 'ngarab') },
                        wp.element.createElement(RichText, {
                            tagName: 'div',
                            placeholder: __('Transliteration...', 'ngarab'),
                            value: trans,
                            onChange: (val) => setAttributes({ trans: val }),
                            style: { fontStyle: 'italic', marginBottom: '10px' }
                        }),
                        wp.element.createElement(RichText, {
                            tagName: 'div',
                            placeholder: __('Translation (Terjemahan)...', 'ngarab'),
                            value: trj,
                            onChange: (val) => setAttributes({ trj: val }),
                            style: { fontWeight: 'bold' }
                        }),
                        wp.element.createElement(ToggleControl, {
                            label: __('Show Copy Button', 'ngarab'),
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
                        placeholder: __('أدخل النص العربي هنا...', 'ngarab')
                    })
                )
            ];
        },
        save: function() {
            return null; // Render via PHP
        }
    });
})();
