import { useBlockProps } from '@wordpress/block-editor';

const Save = ({ attributes }) => {
    return (
        <section {...useBlockProps.save()} className="container">
            <div className="wildcard-container">
                {attributes.wildcardSectionTitle && (
                    <h2>{attributes.wildcardSectionTitle}</h2>
                )}
                <div className="wildcard-row row">
                    {attributes.wildcards.map((wildcard, index) => (
                        <div key={index} className="col-sm-6">
                            <div className="wildcard-card">
                                {wildcard.cardIcon && (
                                    <img
                                        src={wildcard.cardIcon}
                                        alt=""
                                        style={{ maxWidth: '80px', marginBottom: '0.5em' }}
                                    />
                                )}
                                <div className="card-title">{wildcard.cardTitle}</div>
                                <div className="card-description">{wildcard.cardDescription}</div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default Save;
