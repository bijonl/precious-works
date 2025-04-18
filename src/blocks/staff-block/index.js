import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('precious-works/staff-block', {
    title: 'Staff Block',
    description: 'This will output staff members onto the page.',
    category: 'precious-works',
    icon: 'columns',

    attributes: {
        staffMembers: {
            type: 'array',
            default: [],
        },
        
    },

    edit: (props) => <Edit {...props} />,
    save: (props) => <Save {...props} />,
});
