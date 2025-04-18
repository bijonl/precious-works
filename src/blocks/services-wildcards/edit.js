import {
    useBlockProps,
    InspectorControls,
    MediaUpload,
    MediaUploadCheck,
} from '@wordpress/block-editor';
import {
    Fragment
} from '@wordpress/element';
import {
    PanelBody,
    TextControl,
    TextareaControl,
    Button,
    IconButton
} from '@wordpress/components';

const Edit = (props) => {
    const { attributes, setAttributes } = props;

    const handleAddWildcard = () => {
        const wildcards = [ ...attributes.wildcards ];
        wildcards.push({
            cardTitle: '',
            cardIcon: '',
            cardDescription: '',
        });
        setAttributes({ wildcards });
    };

    const handleRemoveWildcards = (index) => {
        const wildcards = [ ...attributes.wildcards ];
        wildcards.splice(index, 1);
        setAttributes({ wildcards });
    };

    const updateWildcard = (index, field, value) => {
        const wildcards = [ ...attributes.wildcards ];
        wildcards[index][field] = value;
        setAttributes({ wildcards });
    };


    const wildCardFields = attributes.wildcards.map((wildcard, index) => (
        <div key={index} style={{ marginBottom: '1em' }}>
            <TextControl
                placeholder="Insert Card Title"
                value={wildcard.cardTitle}
                onChange={(value) => updateWildcard(index, 'cardTitle', value)}
            />
            <TextareaControl
                placeholder="Insert Card Description"
                value={wildcard.cardDescription}
                onChange={(value) => updateWildcard(index, 'cardDescription', value)}
            />
            <MediaUpload
                onSelect={(media) =>
                    updateWildcard(index, 'cardIcon', media.url)
                }
                allowedTypes={['image']}
                render={({ open }) => (
                    <>
                        {wildcard.cardIcon && (
                            <img
                                src={wildcard.cardIcon}
                                alt=""
                                style={{ maxWidth: '100px', display: 'block', marginBottom: '0.5em' }}
                            />
                        )}
                        <Button onClick={open} isSecondary>
                            {wildcard.cardIcon ? 'Replace Image' : 'Select Image'}
                        </Button>
                    </>
                )}
            />
            <IconButton
                icon="no-alt"
                label="Delete wildcard"
                onClick={() => handleRemoveWildcards(index)}
                className="components-button is-link is-destructive"
            />
        </div>
    ));


    return (
        <Fragment>
            <InspectorControls>
                <PanelBody title="Wildcards">
                    <TextControl
                        placeholder="Wilcard Section Title"
                        value={attributes.wildcardSectionTitle}
                        onChange={(value) => setAttributes({ wildcardSectionTitle: value })}

                    />
                    {wildCardFields}
                    <Button isSecondary onClick={handleAddWildcard}>
                        Add Wildcard
                    </Button>
                </PanelBody>
            </InspectorControls>
                <section {...useBlockProps()} className="wildcard-section">
                    <div class="container wildcard-container">
                        <h2>{attributes.wildcardSectionTitle}</h2>
                            <div className="wildcard-row row">
                                {attributes.wildcards.map((wildcard, index) => (
                                    <div key={index} className="col-sm-6">
                                        <div className="single-wildcard-row">
                                            {wildcard.cardIcon && (
                                                <img
                                                    src={wildcard.cardIcon}
                                                    alt=""
                                                    style={{ maxWidth: '80px', marginBottom: '0.5em' }}
                                                />
                                            )}
                                            <h4>{wildcard.cardTitle}</h4>
                                            <p>{wildcard.cardDescription}</p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                    </div>
                </section>
        </Fragment>
    );

};

export default Edit;
