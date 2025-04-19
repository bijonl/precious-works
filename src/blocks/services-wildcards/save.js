import { useBlockProps } from '@wordpress/block-editor';

const Save = ({ attributes }) => {
    return (
        <section {...useBlockProps.save()} className="wildcard-section">
            <div className="wildcard-container container">
                <div className="wildcard-title-row row">
                    <div className="col-sm-6 title-col">
                        {attributes.wildcardSectionTitle && (
                            <h2>{attributes.wildcardSectionTitle}</h2>
                        )}

                        {attributes.wildcardSubtitle && (
                            <p>{attributes.wildcardSubtitle}</p>
                        )}
                    </div>
                    
                </div>
               
                <div className="wildcard-row row g-5">
                    {attributes.wildcards.map((wildcard, index) => (
                        <div
                            key={index}
                            className={`wildcard-col col-sm-6 ${index % 2 === 0 ? 'me-auto' : 'ms-auto'}`}
                        >
                            <div className="wildcard-card">
                                {wildcard.cardIcon && (
                                    <img
                                        src={wildcard.cardIcon}
                                        alt={wildcard.cardAlt || ''}
                                    />
                                )}
                                <div className="card-title"><h4>{wildcard.cardTitle}</h4></div>
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
