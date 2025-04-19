import {
    useBlockProps,
    RichText,
    InspectorControls,
    MediaUpload,
    MediaUploadCheck,
} from '@wordpress/block-editor';
import {
    PanelBody,
    TextControl,
    Button,
    BaseControl,
} from '@wordpress/components';

const Edit = (props) => {
    const { attributes, setAttributes } = props;
    const { imageUrl, imageId, imageAlt, textHeading, textContent } = attributes;

    const onSelectImage = (media) => {
        setAttributes({
            imageUrl: media.url,
            imageId: media.id,
            imageAlt: media.alt || media.title || '',
        });
    };

    return (
        <>
            <InspectorControls>
                <PanelBody title="Custom Settings">
                    <TextControl
                        label="Text Heading"
                        value={textHeading}
                        onChange={(value) => setAttributes({ textHeading: value })}
                    />
                </PanelBody>
                <PanelBody title="Image Settings">
                    <MediaUploadCheck>
                        <MediaUpload
                            onSelect={onSelectImage}
                            allowedTypes={['image']}
                            value={imageId}
                            render={({ open }) => (
                                <Button onClick={open} isPrimary>
                                    {imageUrl ? 'Change Image' : 'Select Image'}
                                </Button>
                            )}
                        />
                    </MediaUploadCheck>

                    {imageUrl && (
                        <BaseControl>
                            <img
                                src={imageUrl}
                                alt={imageAlt || ''}
                                style={{ width: '100%', height: 'auto' }}
                            />
                            <Button
                                onClick={() => setAttributes({ imageUrl: '', imageId: undefined, imageAlt: '' })}
                                isDestructive
                                style={{ marginTop: '5px' }}
                            >
                                Remove Image
                            </Button>
                        </BaseControl>
                    )}
                </PanelBody>
            </InspectorControls>

            <div {...useBlockProps({ className: 'container my-4' })}>
                <div className="row">
                    <div className="col-sm-6 mb-4">
                        <RichText
                            tagName="h2"
                            className="two-col-heading"
                            value={textHeading}
                            onChange={(value) => setAttributes({ textHeading: value })}
                            placeholder="Enter heading..."
                        />

                        <RichText
                            tagName="div"
                            className="text-muted" // matches save.js exactly
                            multiline="p"
                            value={textContent}
                            onChange={(value) => setAttributes({ textContent: value })}
                            placeholder="Start typing your content..."
                        />
                    </div>

                    <div className="col-sm-6">
                        {imageUrl ? (
                            <div className="d-flex flex-column align-items-start">
                                <img
                                    src={imageUrl}
                                    alt={imageAlt || ''}
                                    className="img-fluid mb-2"
                                />
                                <Button
                                    onClick={() =>
                                        setAttributes({ imageUrl: '', imageId: undefined, imageAlt: '' })
                                    }
                                    isDestructive
                                >
                                    Remove Image
                                </Button>
                            </div>
                        ) : (
                            <MediaUploadCheck>
                                <MediaUpload
                                    onSelect={onSelectImage}
                                    allowedTypes={['image']}
                                    value={imageId}
                                    render={({ open }) => (
                                        <Button onClick={open} isPrimary>
                                            Upload Image
                                        </Button>
                                    )}
                                />
                            </MediaUploadCheck>
                        )}
                    </div>
                </div>
            </div>
        </>
    );
};

export default Edit;
