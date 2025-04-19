import { useBlockProps } from '@wordpress/block-editor';

const Save = (props) => {
    const { attributes } = props;
    const { bigHeroText, smallerHeroText } = attributes;

    return (
        <section {...useBlockProps.save()} className="homepage-hero-section">
            <div className="container homepage-hero-container">
                <div className="homepage-hero-row row">
                    <div className="col-sm-9 mx-auto homepage-hero-col text-center">
                        <div className="homepage-hero-content-wrapper">
                            <div className="homepage-hero-content-text">
                                <h1>{bigHeroText}</h1>
                                <p>{smallerHeroText}</p>
                            </div>
                            <div className="hero-button-wrapper">
                                {attributes.buttonURL && (
                                    <a
                                    href={attributes.buttonURL}
                                    className="pw-solid-button"
                                    aria-label={
                                        attributes.buttonText
                                        ? `${attributes.buttonText} (link to ${attributes.buttonURL})`
                                        : `Go to ${attributes.buttonURL}`
                                    }
                                    >
                                    {attributes.buttonText || 'Click me'}
                                    </a>
                                )}
                                
                                {attributes.buttonTwoURL && (
                                    <a
                                    href={attributes.buttonTwoURL}
                                    className="outline-pw-button"
                                    aria-label={
                                        attributes.buttonTwoText
                                        ? `${attributes.buttonTwoText} (link to ${attributes.buttonTwoURL})`
                                        : `Go to ${attributes.buttonTwoURL}`
                                    }
                                    >
                                    {attributes.buttonTwoText || 'Click me'}
                                    </a>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Save;