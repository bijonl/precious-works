import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('precious-works/two-col-image-text', {
    title: 'Two Column Image/Text',
    description: 'A two column block with image and text',
    category: 'precious-works',
    icon: 'columns',
    supports: {
        anchor: true, 
    },
    attributes: {
        textHeading: {
            type: 'string',
            default: 'Default text here',
        },
        textContent: {
            type: 'string',
            source: 'html',
            selector: '.text-muted', // matches save.js now
        },
        imageUrl: {
            type: 'string',
            default: '',
        },
        imageId: {
            type: 'number',
        },
        imageAlt: {
            type: 'string',
            default: '',
        },
    },

    edit: (props) => <Edit {...props} />,
    save: (props) => <Save {...props} />,
});
