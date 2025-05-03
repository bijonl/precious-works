import { useBlockProps, RichText } from '@wordpress/block-editor';

const Save = (props) => {
    const { attributes } = props;
    const { textHeading, textContent, imageUrl, imageAlt, imageCaption } = attributes;

    return (
        <section {...useBlockProps.save()} className="two-col-img-text-section">
            <div className="two-col-container container">
                <div className="two-col-row row align-items-center">
                    <div className="text-col col-lg-5">
                        <h3 className="two-col-heading">{textHeading}</h3>
                        <RichText.Content
                            tagName="div"
                            className="text-muted"
                            value={textContent}
                        />
                    </div>
                    <div className="img-col col-lg-6 ms-auto">
                        {imageUrl && (
                            <figure>
                                <img
                                    src={imageUrl}
                                    alt={imageAlt || ""}
                                    role={imageAlt ? "presentation" : ""}
                                    className="img-fluid"
                                    loading="lazy"
                                />
                                {imageCaption && <figcaption>{imageCaption}</figcaption>}
                            </figure>
                        )}
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Save;
