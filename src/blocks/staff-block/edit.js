import apiFetch from '@wordpress/api-fetch';
import { useState, useEffect } from '@wordpress/element';
import {
    useBlockProps,
    InspectorControls,
} from '@wordpress/block-editor';
import {
    PanelBody,
    TextControl,
} from '@wordpress/components';

const Edit = (props) => {
    const { attributes, setAttributes } = props;
    const [staffList, setStaffList] = useState(null);
    const [selectedStaff, setSelectedStaff] = useState([]);

    const toggleSelectionStaff = (staffId) => {
        setSelectedStaff((prevSelected) => {
            const newSelected = prevSelected.includes(staffId)
                ? prevSelected.filter((id) => id !== staffId)
                : [...prevSelected, staffId];

            // Update the staffMembers attribute with the selected staff IDs
            setAttributes({
                staffMembers: newSelected,
            });

            return newSelected;
        });
    };
    
    // Filter out the selected staff titles
    const selectedStaffDetails = staffList
        ? staffList.filter((staff) => selectedStaff.includes(staff.id))
        : [];

    useEffect(() => {
        apiFetch({ path: '/wp/v2/staff' }).then(
            (result) => {
                setStaffList(result);
            },
            (error) => {
                console.error('Error fetching staff data:', error);
                setStaffList([]); // Or set some error state to display an error message
            }
        );
    }, []);

    return (
        <>
            <InspectorControls>
                <PanelBody title="Staff" initialOpen={true}>
                    <p>Staff List:</p>
                    { !staffList ? (
                        <p>Loading...</p>
                    ) : (
                        staffList.map((staff) => (
                            <button
                                key={staff.id}
                                onClick={() => toggleSelectionStaff(staff.id)} 
                                style={{
                                    display: 'block',
                                    marginBottom: '4px',
                                    backgroundColor: selectedStaff.includes(staff.id)
                                        ? 'lightgreen'
                                        : 'transparent',
                                    border: '1px solid #ccc',
                                    padding: '4px',
                                    cursor: 'pointer',
                                }}
                            >
                                {staff.title.rendered}
                            </button>
                        ))
                    )}
                    {/* Displaying the selected staff */}
                    <p>Selected Staff:</p>
                    {selectedStaffDetails.length > 0 ? (
                        selectedStaffDetails.map((staff) => (
                            <button
                                key={staff.id}
                                onClick={() => toggleSelectionStaff(staff.id)}
                                style={{
                                    display: 'block',
                                    marginBottom: '4px',
                                    backgroundColor: 'lightcoral',
                                    border: '1px solid #ccc',
                                    padding: '4px',
                                    cursor: 'pointer',
                                }}
                            >
                                {staff.title.rendered}
                            </button>
                        ))
                    ) : (
                        <p>No staff selected</p>
                    )}
                </PanelBody>
            </InspectorControls>

            <div>
                Staff
            </div>
        </>
    );
};

export default Edit;
