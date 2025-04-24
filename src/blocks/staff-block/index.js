import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('precious-works/staff-block', {
    title: 'Staff Block',
    description: 'This will output staff members onto the page.',
    category: 'precious-works',
    icon: 'columns',
     supports: {
        anchor: true, 
    },

    attributes: {
        staffMembers: {
            type: 'array',
            default: [],
        },
        anchor: {
            type: 'string',
            default: '', // Ensure default is set here
        },
        
    },

    edit: (props) => <Edit {...props} />,
    save: (props) => <Save {...props} />,
});
