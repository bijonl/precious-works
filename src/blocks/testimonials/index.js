import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('precious-works/testimonials', {
    title: 'Testimonials',
    description: 'This will output testimonials.',
    category: 'precious-works',
    icon: 'columns',

    attributes: {
        testimonials: {
            type: 'array',
            default: [],
        },
    },

    edit: (props) => <Edit {...props} />,
    save: (props) => <Save {...props} />,
});
