import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {

    edit( { attributes, setAttributes } ) {

        const blockProps = useBlockProps();
        const {
            heading,
            headingHighlight,
            subtext,
            primaryLabel,
            primaryUrl,
            secondaryLabel,
            secondaryUrl,
            cvFile,
        } = attributes;

        // Build preview heading — wrap highlight in gradient style
        const headingBefore = headingHighlight
            ? heading.replace( headingHighlight, '' )
            : heading;

        return (
            <>
                {/* ── Sidebar Controls ─────────────────────────────────── */}
                <InspectorControls>

                    <PanelBody title="Heading" initialOpen={ true }>
                        <TextControl
                            label="Full Heading Text"
                            value={ heading }
                            onChange={ ( val ) => setAttributes( { heading: val } ) }
                        />
                        <TextControl
                            label="Highlight Word(s)"
                            help="This portion of the heading gets the gradient colour."
                            value={ headingHighlight }
                            onChange={ ( val ) => setAttributes( { headingHighlight: val } ) }
                        />
                        <TextareaControl
                            label="Subtext"
                            value={ subtext }
                            onChange={ ( val ) => setAttributes( { subtext: val } ) }
                        />
                    </PanelBody>

                    <PanelBody title="Primary Button" initialOpen={ false }>
                        <TextControl
                            label="Label"
                            value={ primaryLabel }
                            onChange={ ( val ) => setAttributes( { primaryLabel: val } ) }
                        />
                        <TextControl
                            label="URL"
                            value={ primaryUrl }
                            onChange={ ( val ) => setAttributes( { primaryUrl: val } ) }
                        />
                    </PanelBody>

                    <PanelBody title="Secondary Button / CV Download" initialOpen={ false }>
                        <TextControl
                            label="Label"
                            value={ secondaryLabel }
                            onChange={ ( val ) => setAttributes( { secondaryLabel: val } ) }
                        />

                        { /* CV file upload */ }
                        <p style={ { fontSize: '11px', color: '#757575', marginBottom: '0.5rem' } }>
                            Upload a CV/PDF file — overrides the URL below.
                        </p>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={ ( media ) => setAttributes( { cvFile: media.url } ) }
                                allowedTypes={ [ 'application/pdf' ] }
                                value={ cvFile }
                                render={ ( { open } ) => (
                                    <div style={ { display: 'flex', gap: '0.5rem', marginBottom: '0.75rem' } }>
                                        <Button
                                            onClick={ open }
                                            variant="secondary"
                                            style={ { flex: 1 } }
                                        >
                                            { cvFile ? 'Replace CV File' : 'Upload CV (PDF)' }
                                        </Button>
                                        { cvFile && (
                                            <Button
                                                onClick={ () => setAttributes( { cvFile: '' } ) }
                                                variant="tertiary"
                                                isDestructive
                                            >
                                                Remove
                                            </Button>
                                        ) }
                                    </div>
                                ) }
                            />
                        </MediaUploadCheck>
                        { cvFile && (
                            <p style={ { fontSize: '11px', color: '#1e7e34', marginBottom: '0.75rem' } }>
                                ✓ CV uploaded — button will trigger download.
                            </p>
                        ) }

                        <TextControl
                            label="Fallback URL"
                            help="Used only if no CV file is uploaded above."
                            value={ secondaryUrl }
                            onChange={ ( val ) => setAttributes( { secondaryUrl: val } ) }
                        />
                    </PanelBody>

                </InspectorControls>

                {/* ── Editor Preview ───────────────────────────────────── */}
                <div { ...blockProps }>
                    <div style={ {
                        background:    '#0f172a',
                        padding:       '4rem 3rem',
                        borderRadius:  '2rem',
                        textAlign:     'center',
                        position:      'relative',
                        overflow:      'hidden',
                        fontFamily:    'sans-serif',
                        color:         '#fff',
                    } }>

                        {/* Glow blobs — preview only */}
                        <div style={ {
                            position: 'absolute', bottom: '-6rem', right: '-6rem',
                            width: '16rem', height: '16rem',
                            background: 'rgba(249,115,22,0.15)',
                            borderRadius: '50%', filter: 'blur(60px)',
                        } } />
                        <div style={ {
                            position: 'absolute', top: '-6rem', left: '-6rem',
                            width: '16rem', height: '16rem',
                            background: 'rgba(248,108,167,0.15)',
                            borderRadius: '50%', filter: 'blur(60px)',
                        } } />

                        <div style={ { position: 'relative', zIndex: 1 } }>
                            <h2 style={ {
                                fontSize: '2.5rem', fontWeight: 900,
                                lineHeight: 1.1, marginBottom: '1rem',
                            } }>
                                { headingBefore }
                                <span style={ {
                                    background: 'linear-gradient(90deg,#F6A86E,#F86CA7)',
                                    WebkitBackgroundClip: 'text',
                                    WebkitTextFillColor: 'transparent',
                                } }>
                                    { headingHighlight }
                                </span>
                            </h2>

                            <p style={ { color: '#94a3b8', fontSize: '1rem', marginBottom: '1.5rem' } }>
                                { subtext }
                            </p>

                            <div style={ { display: 'flex', gap: '1rem', justifyContent: 'center', flexWrap: 'wrap' } }>
                                <span style={ {
                                    padding: '0.75rem 2rem',
                                    background: 'linear-gradient(90deg,#F6A86E,#F86CA7)',
                                    borderRadius: '9999px', fontWeight: 700, fontSize: '0.9rem',
                                    color: '#fff',
                                } }>
                                    { primaryLabel }
                                </span>
                                <span style={ {
                                    padding: '0.75rem 2rem',
                                    border: '1px solid #334155',
                                    borderRadius: '9999px', fontWeight: 700, fontSize: '0.9rem',
                                    color: '#fff',
                                } }>
                                    { secondaryLabel }
                                    { cvFile && ' ↓' }
                                </span>
                            </div>

                            { cvFile && (
                                <p style={ { color: '#64748b', fontSize: '0.75rem', marginTop: '1rem' } }>
                                    CV file attached — will download on click.
                                </p>
                            ) }
                        </div>

                    </div>
                </div>
            </>
        );
    },

    save() {
        return null;
    },

} );