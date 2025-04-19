import apiFetch from '@wordpress/api-fetch';
import { useState, useEffect } from '@wordpress/element';
import {
    useBlockProps,
    InspectorControls,
} from '@wordpress/block-editor';
import {
    PanelBody,
} from '@wordpress/components';

const Edit = (props) => {
    const { attributes, setAttributes } = props;
    const [testimonialList, setTestimonialList] = useState(null); 
    const [selectedTestimonials, setSelectedTestimonialList] = useState([]); 

   function toggleSelectedQuotes(quoteID) {
        const updatedList = selectedTestimonials.includes(quoteID)
            ? selectedTestimonials.filter((id) => id !== quoteID)
            : [...selectedTestimonials, quoteID];

        setSelectedTestimonialList(updatedList);
        setAttributes({ testimonials: updatedList });
    }

    useEffect(() => {
        if (attributes.testimonials) {
            setSelectedTestimonialList(attributes.testimonials);
        }
    }, []);

    const selectedQuoteDetails = testimonialList ? testimonialList.filter((project) => selectedTestimonials.includes(project.id)) : [];
    
    
    useEffect( () => {
        apiFetch( { path: '/wp/v2/testimonials' } ).then(
            ( result ) => {
                setTestimonialList( result );
            },
            ( error ) => {
                console.error('Error fetching staff data:', error);
                setTestimonialList([]); // Or set some error state to display an error message
            }
        );
    }, [] ); 



    return (
    <>
        <InspectorControls>
            <PanelBody title="Testimonials">
                <p>All Testimonials</p>
                {testimonialList ? 
                    testimonialList.map((quote) => (
                        <button
                            key={quote.id}
                            onClick={() => toggleSelectedQuotes(quote.id)}>
                            {quote.title.rendered}
                        </button>
                    ))
                
                : 
                    <p>No Testimonials Found</p>
                
                }

                <hr />

                 <p>Selected Testimonials</p>
                {selectedQuoteDetails ? 
                    selectedQuoteDetails.map((quote) => (
                        <button
                            key={quote.id}
                            onClick={() => toggleSelectedQuotes(quote.id)}>
                            {quote.title.rendered}
                        </button>
                    ))
                
                : 
                    <p>No Testimonials Selected</p>
                
                }
            </PanelBody>
        </InspectorControls>
        <>
             {selectedQuoteDetails ? 
                    selectedQuoteDetails.map((quote) => (
                        <div>
                            {quote.title.rendered}<br />
                            {quote.quote_attribute}
                        </div>
                    ))
                
                : 
                    <p>No Testimonials Selected</p>
                
            }
        </>
    </>



    )




}

export default Edit;