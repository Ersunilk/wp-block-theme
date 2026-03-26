import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {

    edit( { attributes, setAttributes } ) {

        const blockProps = useBlockProps();
        const { heading, description } = attributes;

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Skills Grid Settings">
                        <TextControl
                            label="Section Heading"
                            value={ heading }
                            onChange={ ( val ) => setAttributes( { heading: val } ) }
                        />
                        <TextareaControl
                            label="Description"
                            value={ description }
                            onChange={ ( val ) => setAttributes( { description: val } ) }
                        />
                    </PanelBody>
                </InspectorControls>

                <div { ...blockProps }>
                    <div style={ {
                        background:    '#f9f9f9',
                        padding:       '2rem',
                        border:        '2px dashed #e0e0e0',
                        fontFamily:    'sans-serif',
                    } }>
                        <p style={ {
                            color:          '#999',
                            fontSize:       '11px',
                            textTransform:  'uppercase',
                            letterSpacing:  '0.2em',
                            marginBottom:   '0.5rem',
                        } }>
                            Skills Grid Block
                        </p>
                        <h2 style={ { fontSize: '2rem', fontWeight: 900, margin: '0 0 0.5rem' } }>
                            { heading }
                        </h2>
                        <p style={ { color: '#666' } }>{ description }</p>
                        <p style={ { color: '#888', fontSize: '0.85rem', marginTop: '1rem' } }>
                            Skills loaded from database.
                            Add skills in WordPress Admin → Skills
                        </p>
                    </div>
                </div>
            </>
        );
    },

    // Required for server-side rendered blocks — must return null
    save() {
        return null;
    },

    // Required for server-side rendered blocks — must return null
    save() {
        return null;
    },

} );