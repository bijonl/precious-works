import { useBlockProps } from '@wordpress/block-editor';

const Save = (props) => {
    const { attributes } = props;
    const { textHeading, textContent, imageUrl } = attributes;

    return (
        <div {...useBlockProps.save()} className="container">
            <div className="row">
                <div className="col-sm-6">
                    <h2>{textHeading}</h2>
                    <p>{textContent}</p>
                </div>
                <div className="col-sm-6">
                    {imageUrl && <img src={imageUrl} alt="Block Image" className="img-fluid" />}
                </div>
            </div>
        </div>
    );
};

export default Save;
