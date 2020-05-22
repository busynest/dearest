const { registerBlockType } = wp.blocks;

registerBlockType( 'sandbox/custom-cta', {
    title: 'Call to action',

    description: 'Block to generate custom CTA',

    icon: 'universal-access-alt',

    category: 'layout',
    
    // edit() {
    //     return <div style={ blockStyle }>Hello World, step 1 (from the editor).</div>;
    // },
    // save() {
    //     return <div style={ blockStyle }>Hello World, step 1 (from the frontend).</div>;
    // },
} );