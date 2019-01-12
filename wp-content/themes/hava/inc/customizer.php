<?php

// Add list of social icons
function hava_social_icons()
{
    $socicons = array(
        'twitter' => __('Twitter', 'hava'),
        'facebook' => __('Facebook', 'hava'),
        'google-plus-square' => __('Google Plus', 'hava'),
        'instagram' => __('Instagram', 'hava'),
        'linkedin' => __('Linkedin', 'hava'),
        'pinterest' => __('Pinterest', 'hava'),
        'youtube' => __('Youtube', 'hava'),
        'vimeo' => __('Vimeo', 'hava'),
        'periscope' => __('Periscope', 'hava'),
        'goodreads' => __('Goodreads', 'hava'),
        'kickstarter' => __('Kickstarter', 'hava'),
        'flickr' => __('Flickr', 'hava'),
        '500px' => __('500px', 'hava'),
        'behance' => __('Behance', 'hava'),
        'github' => __('Github', 'hava'),
        'tumblr' => __('Tumblr', 'hava'),
    );
    return $socicons;
}


function hava_sanitize_select($input, $setting)
{

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options
    $choices = $setting->manager->get_control($setting->id)->choices;

    //return input if valid or return default option
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

// Register customizer settings for social icons
function hava_register_icons($wp_customize)
{
    $socicons = hava_social_icons();

    // Add Header Icons section to customizer panel
    $wp_customize->add_section('hava_icons_header', array(
        'title'      => __('Header Social Icons', 'hava'),
        'description' => __('Please select one of the social media and enter its URL below...', 'hava'),
    ));

    // Add Footer Icons section to customizer panel
    $wp_customize->add_section('hava_icons_footer', array(
        'title'      => __('Footer Social Icons', 'hava'),
        'description' => __('Please select one of the social media and enter its URL below...', 'hava'),
    ));

    // Register Header Social Icon controls and settings
    for ($headicon = 1; $headicon <= 3; $headicon++) {
        $wp_customize->add_setting("type_$headicon", array(
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'hava_sanitize_select',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control("type_$headicon", array(
            'label'    => __("Select social media", 'hava'),
            'section'  => 'hava_icons_header',
            'type'     => 'select',
            'choices'  => $socicons,
        ));

        $wp_customize->add_setting("url_$headicon", array(
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control("url_$headicon", array(
            'section' => 'hava_icons_header',
            'type' => 'url',
            'input_attrs' => array(
                'placeholder' => __('Enter URL here...', 'hava'),
            ),
        ));
    }

    // Register Footer Social Icon controls and settings
    for ($footicon = 1; $footicon <= 5; $footicon++) {
        $wp_customize->add_setting("type_footer_$footicon", array(
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'hava_sanitize_select',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control("type_footer_$footicon", array(
            'label'    => __("Select social media", 'hava'),
            'section'  => 'hava_icons_footer',
            'type'     => 'select',
            'choices'  => $socicons,
        ));

        $wp_customize->add_setting("url_footer_$footicon", array(
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control("url_footer_$footicon", array(
            'section' => 'hava_icons_footer',
            'type' => 'url',
            'input_attrs' => array(
                'placeholder' => __('Enter URL here...', 'hava'),
            ),
        ));
    }
}

add_action('customize_register', 'hava_register_icons');

function hava_default_thumbnail($wp_customize) {

    $wp_customize->add_section('defthumb', array(
        "title" => 'Default Post Thumbnail',
        "description" => __('Set default post thumbnail', 'hava')
    ));

    $wp_customize->add_setting('default_thumbnail', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control($wp_customize, 'default_thumbnail', array(
    'label' => __('Default Post Thumbnail', 'hava'),
    'section' => 'defthumb',
    'settings' => 'default_thumbnail',
    ))
    );
}

add_action('customize_register', 'hava_default_thumbnail');

// Register customizer settings for footer and copyright text
function hava_reg_footer_text($wp_customize)
{
    $wp_customize->add_section('hava_footer_text', array(
        'title' => __('Footer Text', 'hava'),
    ));

    $wp_customize->add_setting("footer_text", array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control("footer_text", array(
        'label' => __('Footer text', 'hava'),
        'section' => 'hava_footer_text',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting("copyright_text", array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ('Crafted by Huseyn A. Proudly powered by WordPress'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control("copyright_text", array(
        'label' => __('Copyright text', 'hava'),
        'section' => 'hava_footer_text',
        'type' => 'text',
    ));
}

add_action('customize_register', 'hava_reg_footer_text');

// Output social icons
function hava_header_icon()
{
    for ($x=1; $x <= 3; $x++) {
        $url = esc_url(get_theme_mod("url_$x"));
        $type = esc_html(get_theme_mod("type_$x"));

        if (strlen($url) > 0) {
            ?>
            <a href="<?php echo esc_url($url); ?>">
                <i id="i" class="fab fa-<?php echo esc_attr($type); ?>"></i>
            </a>
            <?php
        }
    }
}

function hava_footer_icon()
{
    for ($x=1; $x <= 5; $x++) {
        $urlfooter = esc_url(get_theme_mod("url_footer_$x"));
        $typefooter = esc_html(get_theme_mod("type_footer_$x"));

        if (strlen($urlfooter) > 0) {
            ?>
            <a href="<?php echo esc_url($urlfooter); ?>">
                <i id="si" class="fab fa-<?php echo esc_attr($typefooter); ?>"></i>
            </a>
            <?php
        }
    }
}
