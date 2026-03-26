import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
    PanelBody,
    TextControl,
    TextareaControl,
    ColorPicker,
    Button,
} from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {

    edit( { attributes, setAttributes } ) {

        const blockProps = useBlockProps();
        const {
            siteTitle,
            profileSummary,
            bgColor,
            textColor,
            hoverColor,
            navItems,
        } = attributes;

        const updateNavItem = ( index, field, value ) => {
            const updated = navItems.map( ( item, i ) =>
                i === index ? { ...item, [field]: value } : item
            );
            setAttributes({ navItems: updated });
        };

        const addNavItem = () => {
            setAttributes({
                navItems: [ ...navItems, { label: 'New Link', url: '#' } ]
            });
        };

        const removeNavItem = ( index ) => {
            setAttributes({
                navItems: navItems.filter( ( _, i ) => i !== index )
            });
        };

        return (
            <>
                <InspectorControls>

                    {/* Site Identity */}
                    <PanelBody title="Site Identity" initialOpen={ true }>
                        <TextControl
                            label="Logo Text"
                            value={ siteTitle }
                            onChange={ val => setAttributes({ siteTitle: val }) }
                        />
                    </PanelBody>

                    {/* Navigation Links */}
                    <PanelBody title="Navigation Links" initialOpen={ true }>
                        { navItems.map( ( item, index ) => (
                            <div key={ index } style={{
                                border:        '1px solid #e0e0e0',
                                borderRadius:  '4px',
                                padding:       '0.75rem',
                                marginBottom:  '0.75rem',
                                background:    '#fafafa',
                            }}>
                                <TextControl
                                    label="Label"
                                    value={ item.label }
                                    onChange={ val => updateNavItem( index, 'label', val ) }
                                />
                                <TextControl
                                    label="URL"
                                    value={ item.url }
                                    onChange={ val => updateNavItem( index, 'url', val ) }
                                />
                                <Button
                                    isDestructive
                                    variant="secondary"
                                    onClick={ () => removeNavItem( index ) }
                                >
                                    Remove
                                </Button>
                            </div>
                        ) ) }
                        <Button
                            variant="primary"
                            onClick={ addNavItem }
                        >
                            + Add Link
                        </Button>
                    </PanelBody>

                    {/* Profile Summary */}
                    <PanelBody title="Profile Summary" initialOpen={ false }>
                        <TextareaControl
                            label="Summary Text"
                            value={ profileSummary }
                            onChange={ val => setAttributes({ profileSummary: val }) }
                            rows={ 4 }
                        />
                    </PanelBody>

                    {/* Colors */}
                    <PanelBody title="Colors" initialOpen={ false }>
                        <p style={{ fontSize:'11px', fontWeight:600, marginBottom:'8px' }}>
                            Background Color
                        </p>
                        <ColorPicker
                            color={ bgColor }
                            onChange={ val => setAttributes({ bgColor: val }) }
                            enableAlpha={ false }
                        />
                        <p style={{ fontSize:'11px', fontWeight:600, margin:'16px 0 8px' }}>
                            Text Color
                        </p>
                        <ColorPicker
                            color={ textColor }
                            onChange={ val => setAttributes({ textColor: val }) }
                            enableAlpha={ false }
                        />
                        <p style={{ fontSize:'11px', fontWeight:600, margin:'16px 0 8px' }}>
                            Hover Color
                        </p>
                        <ColorPicker
                            color={ hoverColor }
                            onChange={ val => setAttributes({ hoverColor: val }) }
                            enableAlpha={ false }
                        />
                    </PanelBody>

                </InspectorControls>

                {/* Editor Preview */}
                <div { ...blockProps }>
                    <div style={{
                        background:     bgColor,
                        padding:        '1.5rem 2rem',
                        display:        'flex',
                        justifyContent: 'space-between',
                        alignItems:     'center',
                        fontFamily:     'sans-serif',
                    }}>
                        <span style={{
                            color:         textColor,
                            fontWeight:    900,
                            fontSize:      '1.25rem',
                            letterSpacing: '-0.05em',
                        }}>
                            { siteTitle }
                        </span>
                        <div style={{ display:'flex', gap:'1.5rem' }}>
                            { navItems.map( ( item, i ) => (
                                <span key={ i } style={{
                                    color:         textColor,
                                    fontSize:      '0.75rem',
                                    fontWeight:    700,
                                    textTransform: 'uppercase',
                                    letterSpacing: '0.1em',
                                }}>
                                    { item.label }
                                </span>
                            ) ) }
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
                        ✏️ Edit logo, links, summary and colors in sidebar →
                    </p>
                </div>
            </>
        );
    },

} );