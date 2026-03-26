(function() {
    const { registerBlockType } = wp.blocks;
    const { RichText, InspectorControls, PanelColorSettings } = wp.blockEditor;
    const { PanelBody, SelectControl, ToggleControl, BaseControl } = wp.components;
    const { Fragment, createElement } = wp.element;
    const { __ } = wp.i18n;

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

    registerBlockType('ngarab/ngarab-block', {
        title: __( '(ng)Arab', 'ngarab' ),
        icon: createElement('svg', { width: 20, height: 20, viewBox: '0 0 153 171' },
            createElement('path', { fill: 'currentColor', d: 'M70.3,34.2c8.9-3.6,19.6-1.7,26.8,4.8c9.7,8.7,18.6,18.2,27.1,27.9c4.9,5.5,8.5,12.7,7.4,20.3 c-1.2,8.1-5.3,15.8-10.8,21.8c0.5,0.9,1.1,1.7,1.1,2.8c-1.1,0.3-1.9-0.5-2.8-0.9c-2.5,3.8-6.1,6.8-9,10.3 c-6.2,7.5-13,14.9-22.2,18.6c-9.3,3.8-20,1.6-28.5-3.2c-10.4-6-17.8-15.5-25.4-24.5c-5.5-6.7-9.7-15.2-8.6-24.1 c1.2-10.5,7.8-19.2,13.9-27.4C47.7,49.8,57.4,39.2,70.3,34.2 M81.7,47.9C76,50.6,70.8,55,67.5,60.5c-2.4,4.2-4.4,9.3-2.8,14.1 c1.3,3.5,5.1,4.8,8.4,5.4c-9.6,8.1-19.8,17.2-22.8,29.9c-1.6,5.3,0.9,12.3,6.6,13.9c5.5,1.3,9-4.5,14.1-4.9 c5.5-0.4,11.2-0.7,16.5-2.6c3.5-1.3,7.7-2.7,9.1-6.5c-2.7-0.1-5.2,1.1-7.8,1.8c-5.8,1.5-11.9,2.2-17.9,1.4 c-3.5-0.6-7.3-2.3-8.6-5.9c-1.6-4.6,0.4-9.6,3.4-13.2c5.5-6.6,13-11.1,19.8-16.2c4.5-3.5,9.3-6.6,13.6-10.3 c2.3-1.9,3.9-4.7,3.9-7.8c-4.1,0.8-7.2,4-10.6,6.2c-4.8,3.4-10.9,5.6-16.7,4.2c-2.7-0.6-5.4-2.9-5-5.9c0.7-4.9,5.9-9.4,10.9-8 c2.4,1,2.4,3.8,3.3,5.9c3.2-2.4,6.7-5.7,7.1-9.9C91.6,47.1,85.5,46.2,81.7,47.9 M99.6,108.7c1.9-1.1,3.9-2.4,4.6-4.6 C102.2,105.1,99.8,106.2,99.6,108.7 M65.8,125.3c4.3,0.6,9.6-0.4,12.5-3.9C73.8,121.2,68.5,121,65.8,125.3z' })
        ),
        category: 'text',
        attributes: {
            arabText: { type: 'string', default: '' },
            font: { type: 'string', default: '' },
            color: { type: 'string', default: '' },
            trans: { type: 'string', default: '' },
            trj: { type: 'string', default: '' },
            showCopy: { type: 'boolean', default: false }
        },
        edit: function(props) {
            const { attributes: { arabText, font, color, trans, trj, showCopy }, setAttributes } = props;

            return createElement(Fragment, null, [
                createElement(InspectorControls, { key: 'inspector' },
                    createElement(PanelBody, { title: __('Typography', 'ngarab') },
                        createElement(SelectControl, {
                            label: __('Arabic Font', 'ngarab'),
                            value: font,
                            options: fontOptions,
                            onChange: (val) => setAttributes({ font: val })
                        })
                    ),
                    createElement(PanelColorSettings, {
                        title: __('Colors', 'ngarab'),
                        colorSettings: [
                            {
                                value: color,
                                onChange: (val) => setAttributes({ color: val }),
                                label: __('Arabic Text Color', 'ngarab')
                            }
                        ]
                    }),
                    createElement(PanelBody, { title: __('Meta Settings', 'ngarab') },
                        createElement(BaseControl, { label: __('Transliteration', 'ngarab') },
                            createElement(RichText, {
                                tagName: 'div',
                                placeholder: __('Enter transliteration...', 'ngarab'),
                                value: trans,
                                onChange: (val) => setAttributes({ trans: val }),
                                style: { fontStyle: 'italic', marginBottom: '10px', padding: '10px', backgroundColor: '#fcfcfc', border: '1px solid #ddd', borderRadius: '4px' }
                            })
                        ),
                        createElement(BaseControl, { label: __('Translation (Terjemahan)', 'ngarab') },
                            createElement(RichText, {
                                tagName: 'div',
                                placeholder: __('Enter translation...', 'ngarab'),
                                value: trj,
                                onChange: (val) => setAttributes({ trj: val }),
                                style: { fontWeight: 'bold', padding: '10px', backgroundColor: '#fcfcfc', border: '1px solid #ddd', borderRadius: '4px' }
                            })
                        ),
                        createElement(ToggleControl, {
                            label: __('Show Copy Button', 'ngarab'),
                            checked: showCopy,
                            onChange: (val) => setAttributes({ showCopy: val })
                        })
                    )
                ),
                createElement('div', { 
                    key: 'content',
                    className: 'ngarab-block-editor-wrap',
                    style: {
                        padding: '10px',
                        border: '1px dashed #ddd',
                        minHeight: '50px',
                        backgroundColor: '#f9f9f9'
                    }
                },
                    createElement(RichText, {
                        tagName: 'div',
                        className: 'arab',
                        style: {
                            '--ng-arab-font-family': fontStacks[font] || 'inherit',
                            '--ng-arab-color': color || 'inherit',
                            fontFamily: fontStacks[font] || 'inherit',
                            color: color || 'inherit',
                            textAlign: 'right',
                            fontSize: '24pt',
                            direction: 'rtl',
                            margin: '0',
                        },
                        value: arabText,
                        onChange: (val) => setAttributes({ arabText: val }),
                        placeholder: __('أدخل النص العربي هنا...', 'ngarab'),
                        keepPlaceholderOnFocus: true
                    }),
                    createElement('div', { 
                        className: 'arab-meta',
                        style: {
                            marginTop: '10px',
                            borderTop: '1px solid #eee',
                            paddingTop: '10px',
                            textAlign: 'left',
                            direction: 'ltr'
                        }
                    }, [
                        createElement(RichText, { 
                            tagName: 'div',
                            className: 'arab-trans',
                            style: { fontStyle: 'italic', color: '#666', fontSize: '14px', marginBottom: '5px' },
                            value: trans,
                            onChange: (val) => setAttributes({ trans: val }),
                            placeholder: __('Enter transliteration here...', 'ngarab')
                        }),
                        createElement(RichText, { 
                            tagName: 'div',
                            className: 'arab-trj',
                            style: { fontWeight: 'bold', color: '#333', fontSize: '15px' },
                            value: trj,
                            onChange: (val) => setAttributes({ trj: val }),
                            placeholder: __('Enter translation here...', 'ngarab')
                        })
                    ])
                )
            ]);
        },
        save: function() {
            return null; // Render via PHP
        }
    });

    // Legacy support for the old block name 'ngarab/main'
    registerBlockType('ngarab/main', {
        title: __( '(ng)Arab (Legacy)', 'ngarab' ),
        icon: 'translation',
        category: 'text',
        parent: ['core/post-content'], // Hide from general inserter but keep for existing
        supports: {
            inserter: false // Hide from the inserter
        },
        attributes: {
            arabText: { type: 'string', default: '' },
            font: { type: 'string', default: '' },
            color: { type: 'string', default: '' },
            trans: { type: 'string', default: '' },
            trj: { type: 'string', default: '' },
            showCopy: { type: 'boolean', default: false }
        },
        edit: function(props) {
            return createElement('div', { 
                style: { 
                    padding: '20px', 
                    border: '1px solid #ffb900', 
                    backgroundColor: '#fff8e5',
                    borderRadius: '8px',
                    textAlign: 'center'
                } 
            }, [
                createElement('p', { style: { margin: '10px 0', fontWeight: 'bold' } }, __('Legacy (ng)Arab Block Detected', 'ngarab')),
                createElement('p', { style: { margin: '0 0 15px 0', fontSize: '13px' } }, __('This block uses an outdated ID. Please delete this and re-add the new (ng)Arab block.', 'ngarab')),
                createElement('div', { style: { opacity: 0.5, fontStyle: 'italic' } }, props.attributes.arabText)
            ]);
        },
        save: function() { return null; }
    });
})();

