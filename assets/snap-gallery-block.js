const {PlainText, InspectorControls, useBlockProps} = wp.blockEditor;
const {SelectControl} = wp.components;
const ServerSideRender = wp.serverSideRender;
const el = wp.element.createElement;

wp.blocks.registerBlockType('snap-video-gallery/gallery', {
    title: 'Snap Video Gallery',
    icon: 'playlist-video',

    attributes: {
        columns: {
            type: 'integer',
            default: 2
        },
    },

    edit({attributes, setAttributes, isSelected, className}) {
        return [
            el(InspectorControls, {key: 'controls'},
                el(SelectControl, {
                    label: "Columns",
                    value: attributes.columns,
                    options: [
                        {label: '2 Columns', value: 2},
                        {label: '3 Columns', value: 3},
                    ],
                    onChange: columns => {
                        setAttributes({columns: Number(columns)});
                    },
                })
            ),

            el('div', useBlockProps(),
                el(ServerSideRender, {
                    block: 'snap-video-gallery/gallery',
                    attributes: {columns: attributes.columns}
                }),
            )
        ];
    },

    save({attributes}) {
        return el('div', {}, `[snap-video-gallery columns="${attributes.columns}"]`);
    }
});