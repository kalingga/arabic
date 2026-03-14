(function() {
    const { registerBlockType } = wp.blocks;
    const { RichText, InspectorControls, PanelColorSettings } = wp.blockEditor;
    const { PanelBody, SelectControl, ToggleControl } = wp.components;

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
                {label: 'Default', value: ''},
                {label: 'LPMQ Isep Misbah', value: 'lpmq'},
                {label: 'Amiri', value: 'amiri'},
                {label: 'Amiri Quran', value: 'amiri-quran'},
                {label: 'Lateef', value: 'lateef'},
                {label: 'Noto Nastaliq Urdu', value: 'noto-nastaliq'},
                {label: 'Scheherazade New', value: 'scheherazade'}
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
                    wp.element.createElement(PanelBody, { title: 'Typography' },
                        wp.element.createElement(SelectControl, {
                            label: 'Arabic Font',
                            value: font,
                            options: fontOptions,
                            onChange: (val) => setAttributes({ font: val })
                        })
                    ),
                    wp.element.createElement(PanelColorSettings, {
                        title: 'Colors',
                        colorSettings: [
                            {
                                value: color,
                                onChange: (val) => setAttributes({ color: val }),
                                label: 'Arabic Text Color'
                            }
                        ]
                    }),
                    wp.element.createElement(PanelBody, { title: 'Meta Settings' },
                        wp.element.createElement(RichText, {
                            tagName: 'div',
                            placeholder: 'Transliteration...',
                            value: trans,
                            onChange: (val) => setAttributes({ trans: val }),
                            style: { fontStyle: 'italic', marginBottom: '10px' }
                        }),
                        wp.element.createElement(RichText, {
                            tagName: 'div',
                            placeholder: 'Translation (Terjemahan)...',
                            value: trj,
                            onChange: (val) => setAttributes({ trj: val }),
                            style: { fontWeight: 'bold' }
                        }),
                        wp.element.createElement(ToggleControl, {
                            label: 'Show Copy Button',
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
                        placeholder: 'أدخل النص العربي هنا...'
                    })
                )
            ];
        },
        save: function() {
            return null; // Render via PHP
        }
    });
})();
