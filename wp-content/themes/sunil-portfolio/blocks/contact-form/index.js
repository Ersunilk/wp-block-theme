import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
    PanelBody,
    TextControl,
    TextareaControl,
    SelectControl,
    ColorPicker,
    __experimentalDivider as Divider,
} from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {

    edit( { attributes, setAttributes } ) {

        const blockProps = useBlockProps();
        const {
            heading,
            subheading,
            email,
            phone,
            location,
            buttonText,
            linkedinUrl,
            githubUrl,
            successMessage,
            // Typography
            fontFamily,
            headingFontSize,
            headingFontWeight,
            headingFontStyle,
            headingColor,
            subheadingFontSize,
            subheadingFontWeight,
            subheadingColor,
            labelColor,
            inputColor,
            sectionBg,
            formCardBg,
        } = attributes;

        // Resolved styles with fallbacks
        const rFontFamily        = fontFamily          || 'Inter, sans-serif';
        const rHeadingSize       = headingFontSize     || 'clamp(2.5rem, 8vw, 5rem)';
        const rHeadingWeight     = headingFontWeight   || '900';
        const rHeadingStyle      = headingFontStyle    || 'normal';
        const rHeadingColor      = headingColor        || '#0f172a';
        const rSubheadingSize    = subheadingFontSize  || '1.25rem';
        const rSubheadingWeight  = subheadingFontWeight || '300';
        const rSubheadingColor   = subheadingColor     || '#64748b';
        const rLabelColor        = labelColor          || '#94a3b8';
        const rInputColor        = inputColor          || '#0f172a';
        const rSectionBg         = sectionBg           || '#f8fafc';
        const rFormCardBg        = formCardBg          || '#ffffff';

        return (
            <>
                {/* ── Sidebar ───────────────────────────────────────── */}
                <InspectorControls>

                    <PanelBody title="Content" initialOpen={ true }>
                        <TextareaControl
                            label="Heading"
                            value={ heading }
                            onChange={ ( val ) => setAttributes( { heading: val } ) }
                            rows={ 2 }
                            help="Include 'extraordinary' for gradient effect"
                        />
                        <TextareaControl
                            label="Subheading"
                            value={ subheading }
                            onChange={ ( val ) => setAttributes( { subheading: val } ) }
                            rows={ 2 }
                        />
                        <TextControl
                            label="Button Text"
                            value={ buttonText }
                            onChange={ ( val ) => setAttributes( { buttonText: val } ) }
                        />
                        <TextControl
                            label="Success Message"
                            value={ successMessage }
                            onChange={ ( val ) => setAttributes( { successMessage: val } ) }
                        />
                    </PanelBody>

                    <PanelBody title="Contact Details" initialOpen={ false }>
                        <TextControl
                            label="Email"
                            value={ email }
                            onChange={ ( val ) => setAttributes( { email: val } ) }
                        />
                        <TextControl
                            label="Phone"
                            value={ phone }
                            onChange={ ( val ) => setAttributes( { phone: val } ) }
                        />
                        <TextControl
                            label="Location"
                            value={ location }
                            onChange={ ( val ) => setAttributes( { location: val } ) }
                        />
                    </PanelBody>

                    <PanelBody title="Social Links" initialOpen={ false }>
                        <TextControl
                            label="LinkedIn URL"
                            value={ linkedinUrl }
                            onChange={ ( val ) => setAttributes( { linkedinUrl: val } ) }
                        />
                        <TextControl
                            label="GitHub URL"
                            value={ githubUrl }
                            onChange={ ( val ) => setAttributes( { githubUrl: val } ) }
                        />
                    </PanelBody>

                    {/* Typography */}
                    <PanelBody title="Typography" initialOpen={ false }>

                        <SelectControl
                            label="Font Family"
                            value={ fontFamily || 'Inter, sans-serif' }
                            options={ [
                                { label: 'Inter',          value: 'Inter, sans-serif' },
                                { label: 'System UI',      value: 'system-ui, sans-serif' },
                                { label: 'Georgia',        value: 'Georgia, serif' },
                                { label: 'Playfair',       value: "'Playfair Display', serif" },
                                { label: 'Montserrat',     value: 'Montserrat, sans-serif' },
                                { label: 'Roboto',         value: 'Roboto, sans-serif' },
                            ] }
                            onChange={ ( val ) => setAttributes( { fontFamily: val } ) }
                        />

                        <Divider />
                        <p style={ { fontSize: '11px', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '0.1em', color: '#757575', margin: '0.5rem 0' } }>Heading</p>

                        <TextControl
                            label="Font Size"
                            value={ headingFontSize || '' }
                            placeholder="clamp(2.5rem, 8vw, 5rem)"
                            onChange={ ( val ) => setAttributes( { headingFontSize: val } ) }
                        />
                        <SelectControl
                            label="Font Weight"
                            value={ headingFontWeight || '900' }
                            options={ [
                                { label: 'Thin (100)',      value: '100' },
                                { label: 'Light (300)',     value: '300' },
                                { label: 'Regular (400)',   value: '400' },
                                { label: 'Medium (500)',    value: '500' },
                                { label: 'SemiBold (600)',  value: '600' },
                                { label: 'Bold (700)',      value: '700' },
                                { label: 'ExtraBold (800)', value: '800' },
                                { label: 'Black (900)',     value: '900' },
                            ] }
                            onChange={ ( val ) => setAttributes( { headingFontWeight: val } ) }
                        />
                        <SelectControl
                            label="Font Style"
                            value={ headingFontStyle || 'normal' }
                            options={ [
                                { label: 'Normal', value: 'normal' },
                                { label: 'Italic', value: 'italic' },
                            ] }
                            onChange={ ( val ) => setAttributes( { headingFontStyle: val } ) }
                        />
                        <p style={ { fontSize: '11px', color: '#757575', margin: '0.5rem 0 0.25rem' } }>Heading Colour</p>
                        <ColorPicker
                            color={ headingColor || '#0f172a' }
                            onChange={ ( val ) => setAttributes( { headingColor: val } ) }
                            enableAlpha
                        />

                        <Divider />
                        <p style={ { fontSize: '11px', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '0.1em', color: '#757575', margin: '0.5rem 0' } }>Subheading</p>

                        <TextControl
                            label="Font Size"
                            value={ subheadingFontSize || '' }
                            placeholder="1.25rem"
                            onChange={ ( val ) => setAttributes( { subheadingFontSize: val } ) }
                        />
                        <SelectControl
                            label="Font Weight"
                            value={ subheadingFontWeight || '300' }
                            options={ [
                                { label: 'Light (300)',   value: '300' },
                                { label: 'Regular (400)', value: '400' },
                                { label: 'Medium (500)',  value: '500' },
                                { label: 'Bold (700)',    value: '700' },
                            ] }
                            onChange={ ( val ) => setAttributes( { subheadingFontWeight: val } ) }
                        />
                        <p style={ { fontSize: '11px', color: '#757575', margin: '0.5rem 0 0.25rem' } }>Subheading Colour</p>
                        <ColorPicker
                            color={ subheadingColor || '#64748b' }
                            onChange={ ( val ) => setAttributes( { subheadingColor: val } ) }
                            enableAlpha
                        />

                        <Divider />
                        <p style={ { fontSize: '11px', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '0.1em', color: '#757575', margin: '0.5rem 0' } }>Form Fields</p>

                        <p style={ { fontSize: '11px', color: '#757575', margin: '0.5rem 0 0.25rem' } }>Label Colour</p>
                        <ColorPicker
                            color={ labelColor || '#94a3b8' }
                            onChange={ ( val ) => setAttributes( { labelColor: val } ) }
                            enableAlpha
                        />
                        <p style={ { fontSize: '11px', color: '#757575', margin: '0.5rem 0 0.25rem' } }>Input Text Colour</p>
                        <ColorPicker
                            color={ inputColor || '#0f172a' }
                            onChange={ ( val ) => setAttributes( { inputColor: val } ) }
                            enableAlpha
                        />

                    </PanelBody>

                    {/* Colours */}
                    <PanelBody title="Colours" initialOpen={ false }>
                        <p style={ { fontSize: '11px', color: '#757575', margin: '0.5rem 0 0.25rem' } }>Section Background</p>
                        <ColorPicker
                            color={ sectionBg || '#f8fafc' }
                            onChange={ ( val ) => setAttributes( { sectionBg: val } ) }
                            enableAlpha
                        />
                        <p style={ { fontSize: '11px', color: '#757575', margin: '0.5rem 0 0.25rem' } }>Form Card Background</p>
                        <ColorPicker
                            color={ formCardBg || '#ffffff' }
                            onChange={ ( val ) => setAttributes( { formCardBg: val } ) }
                            enableAlpha
                        />
                    </PanelBody>

                </InspectorControls>

                {/* ── Live Editor Preview ───────────────────────────── */}
                <div { ...blockProps }>
                    <div style={ {
                        background:   rSectionBg,
                        padding:      '3rem 2rem',
                        borderRadius: '8px',
                        fontFamily:   rFontFamily,
                    } }>

                        {/* Heading preview */}
                        <div style={ { maxWidth: '48rem', marginBottom: '2rem' } }>
                            <h2 style={ {
                                fontSize:   rHeadingSize,
                                fontWeight: rHeadingWeight,
                                fontStyle:  rHeadingStyle,
                                fontFamily: rFontFamily,
                                color:      rHeadingColor,
                                letterSpacing: '-0.05em',
                                lineHeight: 1,
                                margin:     '0 0 1rem',
                            } }>
                                { heading.includes( 'extraordinary' ) ? (
                                    <>
                                        { heading.replace( 'extraordinary', '' ) }
                                        <span style={ {
                                            background:           'linear-gradient(90deg,#F6A86E,#F86CA7)',
                                            WebkitBackgroundClip: 'text',
                                            WebkitTextFillColor:  'transparent',
                                        } }>extraordinary</span>
                                    </>
                                ) : heading }
                            </h2>
                            <p style={ {
                                fontSize:   rSubheadingSize,
                                fontWeight: rSubheadingWeight,
                                fontFamily: rFontFamily,
                                color:      rSubheadingColor,
                                margin:     0,
                                lineHeight: 1.7,
                            } }>
                                { subheading }
                            </p>
                        </div>

                        {/* Two col preview */}
                        <div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '2rem' } }>

                            {/* Form card */}
                            <div style={ {
                                background:   rFormCardBg,
                                padding:      '1.5rem',
                                borderRadius: '1rem',
                                border:       '1px solid #e2e8f0',
                            } }>
                                { [ 'Full Name', 'Email Address', 'Project Type', 'Message' ].map( ( field ) => (
                                    <div key={ field } style={ { marginBottom: '1rem' } }>
                                        <div style={ {
                                            fontSize:      '9px',
                                            fontWeight:    700,
                                            textTransform: 'uppercase',
                                            letterSpacing: '0.15em',
                                            color:         rLabelColor,
                                            marginBottom:  '4px',
                                            fontFamily:    rFontFamily,
                                        } }>{ field }</div>
                                        <div style={ {
                                            borderBottom: '2px solid #e2e8f0',
                                            paddingBottom: '8px',
                                            color:        rInputColor,
                                            fontSize:     '0.85rem',
                                            fontFamily:   rFontFamily,
                                        } }>
                                            { field === 'Message' ? 'Your message...' : `Enter ${ field.toLowerCase() }` }
                                        </div>
                                    </div>
                                ) ) }
                                <div style={ {
                                    background:   'linear-gradient(90deg,#F6A86E,#F86CA7)',
                                    padding:      '0.75rem',
                                    borderRadius: '0.5rem',
                                    color:        '#fff',
                                    fontWeight:   700,
                                    textAlign:    'center',
                                    fontSize:     '0.85rem',
                                    fontFamily:   rFontFamily,
                                } }>
                                    { buttonText }
                                </div>
                            </div>

                            {/* Info panel */}
                            <div style={ { padding: '1rem', fontFamily: rFontFamily } }>
                                <div style={ { marginBottom: '1.5rem' } }>
                                    <div style={ { fontSize: '9px', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '0.15em', color: '#F86CA7', marginBottom: '8px' } }>Contact</div>
                                    <div style={ { fontWeight: 500, color: rInputColor, marginBottom: '4px' } }>{ email }</div>
                                    <div style={ { color: rLabelColor, fontWeight: 500 } }>{ phone }</div>
                                </div>
                                <div>
                                    <div style={ { fontSize: '9px', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '0.15em', color: '#F86CA7', marginBottom: '8px' } }>Location</div>
                                    <div style={ { fontWeight: 500, color: rInputColor } }>{ location }</div>
                                </div>
                            </div>

                        </div>

                        <p style={ { fontSize: '10px', color: '#94a3b8', marginTop: '1rem', marginBottom: 0 } }>
                            ✏️ Edit content &amp; styles in the sidebar → Form submits via PHP to WordPress admin email
                        </p>
                    </div>
                </div>
            </>
        );
    },

    save() {
        return null;
    },

} );