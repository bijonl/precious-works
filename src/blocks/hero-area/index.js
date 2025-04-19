import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('precious-works/hero-area', {
    title: 'Hero Area',
    description: 'This will serve as the hero area for the page.',
    category: 'precious-works',
    icon: 'columns',

    attributes: {
        bigHeroText: {
            type: 'string',
            default: 'Big Heading',
        },
        smallerHeroText: {
            type: 'string',
            default: 'Small Heading',
        },
        buttonURL: {
            type: 'string',
        },
        buttonText: {
            type: 'string',
        },
        buttonTwoURL: {
            type: 'string',
        },
        buttonTwoText: {
            type: 'string',
        },
    },

    edit: (props) => <Edit {...props} />,
    save: (props) => <Save {...props} />,
});
