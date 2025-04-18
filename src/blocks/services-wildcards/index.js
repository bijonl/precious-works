import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('precious-works/services-wildcards', {
    title: 'Services Wildcards',
    description: 'Wildcard Repeater for Services',
    category: 'precious-works',
    icon: 'columns',
    attributes: {
        wildcardSectionTitle: {
            type: 'string',
            default: 'Wildcard Section Title',
        },
        wildcards: {
            type: 'array',
            default: [],
            source: 'query',
            selector: '.wildcard-card',
            query: {
                cardTitle: {
                    type: 'string',
                    source: 'text',
                    selector: '.card-title',
                },
                cardIcon: {
                    type: 'string',
                    source: 'attribute',
                    selector: 'img',
                    attribute: 'src',
                },
                cardDescription: {
                    type: 'string',
                    source: 'text',
                    selector: '.card-description',
                },
            },
        },
    },

    edit: (props) => <Edit {...props} />,
    save: (props) => <Save {...props} />,
});
