<?php
add_action( 'tgmpa_register', 'cms_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
*/
function cms_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        
        array(
            'name'               => esc_html__('EF4 Framework','acumec'),
            'slug'               => 'ef4-framework',
            'source'             => 'ef4-framework-v2.1.0.zip',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('Classic Editor','acumec'),
            'slug'               => 'classic-editor',        
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('Visual Composer','acumec'),
            'slug'               => 'js_composer',
            'source'             => 'js_composer.zip',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('Custom Post Type UI','acumec'),
            'slug'               => 'custom-post-type-ui',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('Woocommerce','acumec'),
            'slug'               => 'woocommerce',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('Contact Form 7','acumec'),
            'slug'               => 'contact-form-7',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('Revolution Slider','acumec'),
            'slug'               => 'revslider',
            'source'             => 'revslider.zip',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('News Twitter','acumec'),
            'slug'               => 'news-twitter',
            'source'             => 'news-twitter.zip',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('Ef3 Import and Export','acumec'),
            'slug'               => 'ef3-import-and-export',
            'source'             => 'ef3-import-and-export.zip',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('Newsletter','acumec'),
            'slug'               => 'newsletter',
            'required'           => false,
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
    */
    $config = array(
        'default_path' => 'http://exptheme.com/plugins/',                      // Default absolute path to pre-packaged plugins.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.

    );

    tgmpa( $plugins, $config );

}