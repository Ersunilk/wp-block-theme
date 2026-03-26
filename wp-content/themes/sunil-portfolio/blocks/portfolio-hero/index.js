import { registerBlockType } from '@wordpress/blocks';
import {
    useBlockProps,
    InspectorControls,
    MediaUpload,
    MediaUploadCheck,
} from '@wordpress/block-editor';
import {
    PanelBody,
    TextControl,
    TextareaControl,
    Button,
} from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {

    edit( { attributes, setAttributes } ) {

        const blockProps = useBlockProps();
        const {
            tagline,
            heading1, heading2, heading3,
            paragraph,
            buttonText, buttonUrl,
            image1Id, image1Url,
            image2Id, image2Url,
            image3Id, image3Url,
        } = attributes;

        // Reusable image uploader component
        const ImageUploader = ({ label, urlKey, idKey, currentUrl }) => (
            <div style={{ marginBottom: '1rem' }}>
                <p style={{
                    fontSize:     '11px',
                    fontWeight:   600,
                    marginBottom: '8px',
                    color:        '#1e1e1e',
                }}>
                    { label }
                </p>
                { currentUrl && (
                    <img
                        src={ currentUrl }
                        alt={ label }
                        style={{
                            width:        '100%',
                            height:       '80px',
                            objectFit:    'cover',
                            marginBottom: '8px',
                            borderRadius: '4px',
                            filter:       'grayscale(100%)',
                        }}
                    />
                )}
                <MediaUploadCheck>
                    <MediaUpload
                        onSelect={ media => setAttributes({
                            [idKey]:  media.id,
                            [urlKey]: media.url,
                        }) }
                        allowedTypes={ ['image'] }
                        value={ attributes[idKey] }
                        render={ ({ open }) => (
                            <Button
                                variant="secondary"
                                onClick={ open }
                                style={{ width: '100%' }}
                            >
                                { currentUrl ? '↺ Change Image' : '+ Upload Image' }
                            </Button>
                        ) }
                    />
                </MediaUploadCheck>
                { currentUrl && (
                    <Button
                        isDestructive
                        variant="link"
                        onClick={ () => setAttributes({
                            [idKey]:  0,
                            [urlKey]: '',
                        }) }
                        style={{ marginTop: '4px', fontSize: '11px' }}
                    >
                        Remove image
                    </Button>
                )}
            </div>
        );

        return (
            <>
                <InspectorControls>

                    {/* Text Content */}
                    <PanelBody title="Text Content" initialOpen={ true }>
                        <TextControl
                            label="Tagline"
                            value={ tagline }
                            onChange={ val => setAttributes({ tagline: val }) }
                        />
                        <TextControl
                            label="Heading Line 1"
                            value={ heading1 }
                            onChange={ val => setAttributes({ heading1: val }) }
                        />
                        <TextControl
                            label="Heading Line 2 — italic serif"
                            value={ heading2 }
                            onChange={ val => setAttributes({ heading2: val }) }
                        />
                        <TextControl
                            label="Heading Line 3 — gradient"
                            value={ heading3 }
                            onChange={ val => setAttributes({ heading3: val }) }
                        />
                        <TextareaControl
                            label="Paragraph"
                            value={ paragraph }
                            onChange={ val => setAttributes({ paragraph: val }) }
                            rows={ 3 }
                        />
                        <TextControl
                            label="Button Text"
                            value={ buttonText }
                            onChange={ val => setAttributes({ buttonText: val }) }
                        />
                        <TextControl
                            label="Button URL"
                            value={ buttonUrl }
                            onChange={ val => setAttributes({ buttonUrl: val }) }
                        />
                    </PanelBody>

                    {/* Images */}
                    <PanelBody title="Images" initialOpen={ true }>
                        <ImageUploader
                            label="Image 1 — Large Left"
                            urlKey="image1Url"
                            idKey="image1Id"
                            currentUrl={ image1Url }
                        />
                        <ImageUploader
                            label="Image 2 — Top Right"
                            urlKey="image2Url"
                            idKey="image2Id"
                            currentUrl={ image2Url }
                        />
                        <ImageUploader
                            label="Image 3 — Bottom Right"
                            urlKey="image3Url"
                            idKey="image3Id"
                            currentUrl={ image3Url }
                        />
                    </PanelBody>

                </InspectorControls>

                {/* Editor Preview */}
                <div { ...blockProps }>
                    <div style={{
                        background:  '#f9f9f9',
                        padding:     '1.5rem',
                        border:      '2px dashed #e0e0e0',
                        display:     'flex',
                        gap:         '1.5rem',
                        fontFamily:  'sans-serif',
                        borderRadius:'4px',
                    }}>

                        {/* Image grid preview */}
                        <div style={{
                            width:               '40%',
                            display:             'grid',
                            gridTemplateColumns: '1fr 1fr',
                            gridTemplateRows:    '1fr 1fr',
                            gap:                 '0.5rem',
                            height:              '180px',
                            flexShrink:          0,
                        }}>
                            { [
                                { url: image1Url, row: '1 / 3', col: '1' },
                                { url: image2Url, row: 'auto',  col: 'auto' },
                                { url: image3Url, row: 'auto',  col: 'auto' },
                            ].map( ( img, i ) => (
                                <div key={ i } style={{
                                    gridRow:    img.row,
                                    gridColumn: img.col,
                                    background: '#e4e4e7',
                                    overflow:   'hidden',
                                    display:    'flex',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                }}>
                                    { img.url
                                        ? <img src={ img.url } style={{ width:'100%', height:'100%', objectFit:'cover', filter:'grayscale(100%)' }} />
                                        : <span style={{ fontSize:'10px', color:'#a1a1aa' }}>Image { i + 1 }</span>
                                    }
                                </div>
                            ) ) }
                        </div>

                        {/* Text preview */}
                        <div style={{ width: '60%', display:'flex', flexDirection:'column', justifyContent:'center' }}>
                            <p style={{
                                fontSize:      '9px',
                                textTransform: 'uppercase',
                                letterSpacing: '0.2em',
                                color:         '#a1a1aa',
                                margin:        '0 0 0.5rem',
                                fontWeight:    700,
                            }}>
                                { tagline }
                            </p>
                            <div style={{ margin: '0 0 0.75rem', lineHeight: 1 }}>
                                <div style={{ fontSize:'1.5rem', fontWeight:900, letterSpacing:'-0.05em' }}>
                                    { heading1 }
                                </div>
                                <div style={{ fontSize:'1.5rem', fontWeight:700, fontStyle:'italic' }}>
                                    { heading2 }
                                </div>
                                <div style={{
                                    fontSize:               '1.5rem',
                                    fontWeight:             900,
                                    background:             'linear-gradient(90deg,#F6A86E,#F86CA7)',
                                    WebkitBackgroundClip:   'text',
                                    WebkitTextFillColor:    'transparent',
                                }}>
                                    { heading3 }
                                </div>
                            </div>
                            <p style={{ fontSize:'0.75rem', color:'#71717a', margin:'0 0 0.75rem', lineHeight:1.5 }}>
                                { paragraph }
                            </p>
                            <span style={{
                                fontSize:      '9px',
                                fontWeight:    900,
                                textTransform: 'uppercase',
                                letterSpacing: '0.2em',
                            }}>
                                → { buttonText }
                            </span>
                        </div>

                    </div>
                    <p style={{
                        background: '#111',
                        color:      '#666',
                        fontSize:   '10px',
                        padding:    '0.4rem 1rem',
                        margin:     0,
                        fontFamily: 'sans-serif',
                    }}>
                        ✏️ Edit text and upload images in sidebar →
                    </p>
                </div>
            </>
        );
    },

} );