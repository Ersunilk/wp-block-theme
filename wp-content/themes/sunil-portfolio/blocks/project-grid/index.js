import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
    PanelBody,
    TextControl,
    RangeControl,
    ColorPicker,
} from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {

    edit( { attributes, setAttributes } ) {

        const blockProps = useBlockProps();
        const { heading, subheading, postsCount, bgColor } = attributes;

        return (
            <>
                <InspectorControls>

                    <PanelBody title="Section Content" initialOpen={ true }>
                        <TextControl
                            label="Section Heading"
                            value={ heading }
                            onChange={ val => setAttributes({ heading: val }) }
                        />
                        <TextControl
                            label="Subheading"
                            value={ subheading }
                            onChange={ val => setAttributes({ subheading: val }) }
                        />
                        <RangeControl
                            label="Number of Projects"
                            value={ postsCount }
                            onChange={ val => setAttributes({ postsCount: val }) }
                            min={ 1 }
                            max={ 12 }
                        />
                    </PanelBody>

                    <PanelBody title="Design" initialOpen={ false }>
                        <p style={{ fontSize:'11px', fontWeight:600, marginBottom:'8px' }}>
                            Background Color
                        </p>
                        <ColorPicker
                            color={ bgColor }
                            onChange={ val => setAttributes({ bgColor: val }) }
                            enableAlpha={ false }
                        />
                    </PanelBody>

                </InspectorControls>

                {/* Editor Preview */}
                <div { ...blockProps }>
                    <div style={{
                        background:  bgColor,
                        padding:     '2rem',
                        border:      '2px dashed #e0e0e0',
                        fontFamily:  'sans-serif',
                        borderRadius:'4px',
                    }}>
                        <p style={{
                            fontSize:      '10px',
                            textTransform: 'uppercase',
                            letterSpacing: '0.15em',
                            color:         '#a1a1aa',
                            margin:        '0 0 0.5rem',
                            fontWeight:    700,
                        }}>
                            Project Grid Block
                        </p>
                        <h2 style={{
                            fontSize:      '2rem',
                            fontWeight:    900,
                            letterSpacing: '-0.05em',
                            margin:        '0 0 0.25rem',
                            textTransform: 'uppercase',
                        }}>
                            { heading }
                        </h2>
                        <p style={{ color: '#71717a', margin: '0 0 1rem' }}>
                            { subheading }
                        </p>
                        <div style={{
                            display:       'flex',
                            gap:           '1rem',
                            overflowX:     'hidden',
                        }}>
                            { [1, 2, 3].map( i => (
                                <div key={ i } style={{
                                    minWidth:   '200px',
                                    background: '#ffffff',
                                    border:     '1px solid #e4e4e7',
                                    padding:    '1rem',
                                    borderRadius:'2px',
                                }}>
                                    <div style={{
                                        height:     '80px',
                                        background: '#f4f4f5',
                                        marginBottom:'0.75rem',
                                    }}/>
                                    <div style={{ fontWeight:700, fontSize:'0.9rem', marginBottom:'0.25rem' }}>
                                        Project { i }
                                    </div>
                                    <div style={{ fontSize:'0.75rem', color:'#a1a1aa' }}>
                                        Tech Stack
                                    </div>
                                </div>
                            ) ) }
                        </div>
                        <p style={{
                            fontSize:   '11px',
                            color:      '#a1a1aa',
                            marginTop:  '1rem',
                            marginBottom: 0,
                        }}>
                            Showing { postsCount } projects from database.
                            Add projects: WordPress Admin → Projects → Add New
                        </p>
                    </div>
                    <p style={{
                        background: '#111',
                        color:      '#666',
                        fontSize:   '10px',
                        padding:    '0.4rem 1rem',
                        margin:     0,
                    }}>
                        ✏️ Edit heading and count in sidebar →
                    </p>
                </div>
            </>
        );
    },

} );
