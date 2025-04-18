import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('precious-works/featured-projects', {
    title: 'Featured Projects Block',
    description: 'This will output selected projects onto the page.',
    category: 'precious-works',
    icon: 'columns',
    
    attributes: {
        featuredProjects: {
            type: 'array',
            default: [],
        },
    },

    // React editor script is still handled here
    edit: (props) => <Edit {...props} />,
    save: (props) => <Save {...props} />,
});
