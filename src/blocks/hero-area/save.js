import { useBlockProps } from '@wordpress/block-editor';

const Save = (props) => {
    const { attributes } = props;
    const { bigHeroText, smallerHeroText } = attributes;

    return (
        <section {...useBlockProps.save()} className="homepage-hero-section">
            <div className="container homepage-hero-container">
                <div className="homepage-hero-row row">
                    <div className="col-sm-12 homepage-hero-col text-center">
                        <h1>{bigHeroText}</h1>
                        <p>{smallerHeroText}</p>
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
        </section>
    );
};

export default Save;