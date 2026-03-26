import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
    PanelBody,
    TextControl,
    ToggleControl,
    ColorPicker,
    SelectControl,
} from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {

    edit( { attributes, setAttributes } ) {

        const blockProps = useBlockProps();
        const {
            copyrightText,
            linkedinUrl,
            githubUrl,
            dribbbleUrl,
            showLinkedin,
            showGithub,
            showDribbble,
            bgColor,
            textColor,
            linkColor,
            fontSize,
        } = attributes;

        return (
            <>
                <InspectorControls>

                    {/* Content Panel */}
                    <PanelBody title="Content" initialOpen={ true }>
                        <TextControl
                            label="Copyright Text"
                            value={ copyrightText }
                            onChange={ val => setAttributes({ copyrightText: val }) }
                        />
                    </PanelBody>

                    {/* Social Links Panel */}
                    <PanelBody title="Social Links" initialOpen={ true }>
                        <ToggleControl
                            label="Show LinkedIn"
                            checked={ showLinkedin }
                            onChange={ val => setAttributes({ showLinkedin: val }) }
                        />
                        { showLinkedin && (
                            <TextControl
                                label="LinkedIn URL"
                                value={ linkedinUrl }
                                onChange={ val => setAttributes({ linkedinUrl: val }) }
                            />
                        ) }

                        <ToggleControl
                            label="Show GitHub"
                            checked={ showGithub }
                            onChange={ val => setAttributes({ showGithub: val }) }
                        />
                        { showGithub && (
                            <TextControl
                                label="GitHub URL"
                                value={ githubUrl }
                                onChange={ val => setAttributes({ githubUrl: val }) }
                            />
                        ) }

                        <ToggleControl
                            label="Show Dribbble"
                            checked={ showDribbble }
                            onChange={ val => setAttributes({ showDribbble: val }) }
                        />
                        { showDribbble && (
                            <TextControl
                                label="Dribbble URL"
                                value={ dribbbleUrl }
                                onChange={ val => setAttributes({ dribbbleUrl: val }) }
                            />
                        ) }
                    </PanelBody>

                    {/* Design Panel */}
                    <PanelBody title="Design" initialOpen={ false }>

                        <p style={{ fontSize: '11px', fontWeight: 600, marginBottom: '8px' }}>
                            Background Color
                        </p>
                        <ColorPicker
                            color={ bgColor }
                            onChange={ val => setAttributes({ bgColor: val }) }
                            enableAlpha={ false }
                        />

                        <p style={{ fontSize: '11px', fontWeight: 600, marginBottom: '8px', marginTop: '16px' }}>
                            Text Color
                        </p>
                        <ColorPicker
                            color={ textColor }
                            onChange={ val => setAttributes({ textColor: val }) }
                            enableAlpha={ false }
                        />

                        <p style={{ fontSize: '11px', fontWeight: 600, marginBottom: '8px', marginTop: '16px' }}>
                            Link Hover Color
                        </p>
                        <ColorPicker
                            color={ linkColor }
                            onChange={ val => setAttributes({ linkColor: val }) }
                            enableAlpha={ false }
                        />

                        <SelectControl
                            label="Font Size"
                            value={ fontSize }
                            options={ [
                                { label: 'Extra Small (10px)', value: '0.625rem' },
                                { label: 'Small (12px)',       value: '0.75rem'  },
                                { label: 'Medium (14px)',      value: '0.875rem' },
                                { label: 'Normal (16px)',      value: '1rem'     },
                            ] }
                            onChange={ val => setAttributes({ fontSize: val }) }
                        />

                    </PanelBody>

                </InspectorControls>

                {/* Editor Preview */}
                <div { ...blockProps }>
                    <div style={{
                        background:     bgColor,
                        color:          textColor,
                        padding:        '2rem',
                        display:        'flex',
                        justifyContent: 'space-between',
                        alignItems:     'center',
                        fontSize:       fontSize,
                        textTransform:  'uppercase',
                        letterSpacing:  '0.1em',
                        fontFamily:     'sans-serif',
                        flexWrap:       'wrap',
                        gap:            '1rem',
                    }}>
                        <span>{ copyrightText }</span>
                        <div style={{ display: 'flex', gap: '1.5rem' }}>
                            { showLinkedin && (
                                <span style={{ color: linkColor }}>LinkedIn</span>
                            )}
                            { showGithub && (
                                <span style={{ color: linkColor }}>GitHub</span>
                            )}
                            { showDribbble && (
                                <span style={{ color: linkColor }}>Dribbble</span>
                            )}
                        </div>
                    </div>
                    <p style={{
                        background:  '#111',
                        color:       '#666',
                        fontSize:    '10px',
                        padding:     '0.4rem 1rem',
                        margin:      0,
                        fontFamily:  'sans-serif',
                    }}>
                        ✏️ Edit content and colors in the sidebar →
                    </p>
                </div>
            </>
        );
    },

} );