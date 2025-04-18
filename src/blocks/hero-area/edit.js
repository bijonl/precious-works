import {
    useBlockProps,
    RichText,
    InspectorControls,
    URLInput, 
    URLInputButton
} from '@wordpress/block-editor';
import {
    PanelBody,
    TextControl,
} from '@wordpress/components';

const Edit = (props) => {
    const { attributes, setAttributes } = props;

    return (
        <>
            {/* Sidebar Controls */}
            <InspectorControls>
                <PanelBody title="Custom Settings">
                    <TextControl
                        label="Big Hero Text"
                        value={attributes.bigHeroText}
                        onChange={(value) => setAttributes({ bigHeroText: value })}
                    />
                    <TextControl
                        label="Small Hero Text"
                        value={attributes.smallerHeroText}
                        onChange={(value) => setAttributes({ smallerHeroText: value })}
                    />
                    <URLInputButton
                        label="Select Link"
                        url={attributes.buttonURL}
                        onChange={(url, post) => setAttributes({ buttonURL: url })}
                        style={{ maxWidth: '100%', width: '100%' }}
                    />
                    <TextControl
                        label="Button Text"
                        value={attributes.buttonText}
                        onChange={(value) => setAttributes({ buttonText: value })}
                    />
                </PanelBody>
            </InspectorControls>

            {/* Main Block Layout */}
            <section {...useBlockProps({ className: 'homepage-hero-section' })}>
                <div className="container homepage-hero-container">
                    <div className="homepage-hero-row row">
                        <div className="col-sm-12 homepage-hero-col text-center">
                            <RichText
                                tagName="h1"
                                className="text-primary mb-3"
                                value={attributes.bigHeroText}
                                onChange={(value) => setAttributes({ bigHeroText: value })}
                                placeholder="Enter heading..."
                            />
                            <RichText
                                tagName="p"
                                className="text-muted"
                                value={attributes.smallerHeroText}
                                onChange={(value) => setAttributes({ smallerHeroText: value })}
                                placeholder="Enter content..."
                                inlineToolbar
                            />
                            <div className="homepage-hero-button mt-4">
                                <URLInputButton
                                    url={attributes.buttonURL}
                                    onChange={(url) => setAttributes({ buttonURL: url })}
                                    label="Set Button URL"
                                />

                                <TextControl
                                    label="Button Text"
                                    value={attributes.buttonText}
                                    onChange={(value) => setAttributes({ buttonText: value })}
                                />

                                {attributes.buttonURL && (
                                    <a
                                        href={attributes.buttonURL}
                                        className="btn btn-primary mt-3"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        {attributes.buttonText || 'Click me'}
                                    </a>
                                )}
                            </div>


                        </div>
                    </div>
                </div>
            </section>
        </>
    );
};

export default Edit;
