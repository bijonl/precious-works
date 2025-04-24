import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('precious-works/featured-projects', {
    title: 'Featured Projects Block',
    description: 'This will output selected projects onto the page.',
    category: 'precious-works',
    icon: 'columns',
    supports: {
        anchor: true, 
    },
    
    attributes: {
        featuredProjects: {
            type: 'array',
            default: [],
        },
        anchor: {
            type: 'string',
            default: '', // Ensure default is set here
        },
    },

    // React editor script is still handled here
    edit: (props) => <Edit {...props} />,
    save: (props) => <Save {...props} />,
});
