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
    const [ projectList, setProjectList ] = useState( null );
    const [selectedProjects, setSelectedProjects] = useState([]);

    function toggleSelectedProjects(projectID) {
        setSelectedProjects((prevSelected) => { 
            if(selectedProjects.includes(projectID)) {
                return prevSelected.filter((id) => id !== projectID); 
            } 
            return [...prevSelected, projectID];
        }); 
        
    }; 

    // Filter out the selected staff titles
    const selectedProjectDetails = projectList ? projectList.filter((project) => selectedProjects.includes(project.id)) : [];

    useEffect( () => {
        apiFetch( { path: '/wp/v2/projects' } ).then(
            ( result ) => {
                setProjectList( result );
            },
            ( error ) => {
                console.error('Error fetching staff data:', error);
                setProjectList([]); // Or set some error state to display an error message
            }
        );
    }, [] ); 

   return (
        <>
            <InspectorControls>
                <PanelBody title="Projects" initialOpen={true}>
                    <p><strong>All Projects:</strong></p>
                    {projectList ? (
                        projectList.map((project) => (
                            <button
                                key={project.id}
                                onClick={() => toggleSelectedProjects(project.id)}
                                style={{
                                    display: 'block',
                                    marginBottom: '4px',
                                    backgroundColor: selectedProjects.includes(project.id)
                                        ? 'lightgreen'
                                        : 'transparent',
                                    border: '1px solid #ccc',
                                    padding: '4px',
                                    cursor: 'pointer',
                                }}
                            >
                                {project.title.rendered}
                            </button>
                        ))
                    ) : (
                        <p>Loading...</p>
                    )}

                    <hr />

                    <p><strong>Selected Projects:</strong></p>
                    {selectedProjectDetails.length > 0 ? (
                        selectedProjectDetails.map((project) => (
                            <button
                                key={project.id}
                                onClick={() => toggleSelectedProjects(project.id)}
                                style={{
                                    display: 'block',
                                    marginBottom: '4px',
                                    backgroundColor: 'lightcoral',
                                    border: '1px solid #ccc',
                                    padding: '4px',
                                    cursor: 'pointer',
                                }}
                            >
                                {project.title.rendered}
                            </button>
                        ))
                    ) : (
                        <p>None selected...</p>
                    )}
                </PanelBody>
            </InspectorControls>

            <section className="featured-projects-section" {...useBlockProps()}>
                <div class="featured-projects-container container">
                    <div class="featured-projects-row row">
                    {selectedProjectDetails.length > 0 ? (
                        selectedProjectDetails.map((project) => (
                        
                            <div class="col-sm-6 single-project">
                                <h4>
                                    {project.title.rendered}
                                </h4>
                                <div dangerouslySetInnerHTML={{ __html: project.content.rendered }} />
                            </div>
                     
                        ))
                    ) : (
                        <p>None selected...</p>
                    )}
                    </div>
                </div>
            </section>
            
        
        </>
    );

}

export default Edit;
