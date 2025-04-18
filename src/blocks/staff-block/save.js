import { useBlockProps } from '@wordpress/block-editor';

const Save = ({attributes}) => {
   
    return (
        <section className="staff-section" {...useBlockProps.save()} >
            <div className="staff-section-container container">
                <div className="staff-section-title-row row">
                    <div className="staff-section-title-col col-sm-8 mx-auto">
                        <h2>Staff</h2>
                        <p>Staff Section Description</p>
                    </div>
                </div>
                {attributes.staffMembers.map((staff) => (
                    <div className="staff-section-content-row row">
                        <div className="single-staff-member-col col-sm-3">
                            Staff Member
                        </div>
                    </div>
                ))}
                
            </div>
        </section>
    )
    
};

export default Save;

