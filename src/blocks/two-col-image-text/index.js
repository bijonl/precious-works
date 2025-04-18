import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('precious-works/two-col-image-text', {
    title: 'Two Column Image/Text',
    description: 'A two column block with image and text',
    category: 'precious-works',
    icon: 'columns',

    attributes: {
        textHeading: {
            type: 'string',
            default: 'Default text here',
        },
        textContent: {
            type: 'string',
            default: 'Text Content Here',
            source: 'html',
            selector: 'h2',
        },
        imageUrl: {
            type: 'string',
            default: '',
        },
        imageId: {
            type: 'number',
        },
    },

    edit: (props) => <Edit {...props} />,
    save: (props) => <Save {...props} />,
});
