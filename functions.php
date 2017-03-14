<?php
define("MUSTACHE_THEME_TEXTDOMAIN", 'mustache-theme');


function loadScriptSite(){

    /*
     * get_template_directory_uri()
     * Получает URL текущей темы. Учитывает SSL. Не учитывает наличие дочерней темы. Не содержит закрывающий слэш.
     * https://wp-kama.ru/function/get_template_directory_uri
     */

    $version = false;


    wp_register_style(
        'Mustache-core', //$handle
        get_template_directory_uri().'/css/style.css', // $src
        array(), //$deps,
        $version // $ver
    );
    wp_register_style(
        'Mustache-mobile', //$handle
        get_template_directory_uri().'/css/mobile.css', // $src
        array(), //$deps,
        $version // $ver
    );
    wp_register_style(
        'StepByStep-custom', //$handle
        get_template_directory_uri().'/css/custom.css', // $src
        array(), //$deps,
        $version // $ver
    );

    wp_enqueue_style('Mustache-core');
//    wp_enqueue_style('Mustache-mobile');
    wp_enqueue_style('StepByStep-custom');

    wp_register_script(
        'Mustache-mobile', //$handle
        get_template_directory_uri().'/js/main.js', //$src
        array(
            'jquery'
        ), //$deps
        $version, //$ver
        true //$$in_footer
    );
    wp_enqueue_script('Mustache-mobile');
}
add_action( 'wp_enqueue_scripts', 'loadScriptSite');

/**
 * Включаем поддержку произвольных меню
 */
function registerNavMenu() {
    register_nav_menu( 'primary', __('Primary Menu', MUSTACHE_THEME_TEXTDOMAIN) );
}
add_action( 'after_setup_theme', 'registerNavMenu', 100 );

// Localization
function themeLocalization(){
    load_theme_textdomain(MUSTACHE_THEME_TEXTDOMAIN, get_template_directory() . '/languages/');
}
add_action('after_setup_theme', 'themeLocalization');


//post-formats
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
//post-thumbnails
add_theme_support( 'post-thumbnails' );

add_theme_support( 'custom-header', array(
    'video' => true,
) );

add_theme_support( 'automatic-feed-links' );


add_theme_support('custom-logo');


add_action('admin_menu', 'addAdminMenu');

function addAdminMenu(){

    $mainMenuPage = add_menu_page(
        _x(
            'Mustache theme',
            'admin menu page' ,
            MUSTACHE_THEME_TEXTDOMAIN
        ),
        _x(
            'Mustache theme',
            'admin menu page' ,
            MUSTACHE_THEME_TEXTDOMAIN
        ),
        'manage_options',
        MUSTACHE_THEME_TEXTDOMAIN,
        'renderMainMenu',
        get_template_directory_uri() .'/images/main-menu.png'
    );

    $subMenuPage = add_submenu_page(
        MUSTACHE_THEME_TEXTDOMAIN,
        _x(
            'Sub Mustache theme',
            'admin menu page' ,
            MUSTACHE_THEME_TEXTDOMAIN
        ),
        _x(
            'Sub Mustache theme',
            'admin menu page' ,
            MUSTACHE_THEME_TEXTDOMAIN
        ),
        'manage_options',
        'mustache_theme_control_sub_menu',
        'renderSubMenu'
        );



    $themeMenuPage = add_theme_page(
        __('Sub Mustache theme', MUSTACHE_THEME_TEXTDOMAIN),
        __('Sub Mustache theme', MUSTACHE_THEME_TEXTDOMAIN),
        'read',
        'mustache _sub_theme_menu',
        'renderThemeMenu'
    );
}

function renderMainMenu(){
    _e('Mustache theme page', MUSTACHE_THEME_TEXTDOMAIN);
}

function renderSubMenu(){
    _e('Sub Mustache theme page', MUSTACHE_THEME_TEXTDOMAIN);
}

function renderThemeMenu(){
    _e('Sub Mustache theme', MUSTACHE_THEME_TEXTDOMAIN);
}

function register_my_widgets(){
    register_sidebar( array(
        'name' => "Правая боковая панель сайта",
        'id' => 'left-sidebar',
        'description' => 'Эти виджеты будут показаны с левой колонке сайта',
        'before_title' => '<h1>',
        'after_title' => '</h1>'
    ) );
}
add_action( 'widgets_init', 'register_my_widgets' );

function true_remove_default_widget() {
    unregister_widget('WP_Widget_Archives'); // Архивы
    unregister_widget('WP_Widget_Calendar'); // Календарь
    /*unregister_widget('WP_Widget_Categories'); // Рубрики
    unregister_widget('WP_Widget_Meta'); // Мета
    unregister_widget('WP_Widget_Pages'); // Страницы
    unregister_widget('WP_Widget_Recent_Comments'); // Свежие комментарии
    unregister_widget('WP_Widget_Recent_Posts'); // Свежие записи
    unregister_widget('WP_Widget_RSS'); // RSS
    unregister_widget('WP_Widget_Search'); // Поиск
    unregister_widget('WP_Widget_Tag_Cloud'); // Облако меток
    unregister_widget('WP_Widget_Text'); // Текст
    unregister_widget('WP_Nav_Menu_Widget'); // Произвольное меню*/
}

add_action( 'widgets_init', 'true_remove_default_widget', 20 );

require get_template_directory().'/widgets/MustacheWidget.php';
add_action('widgets_init', create_function('', 'return register_widget("widgets\MustacheWidget");'));

add_action('customize_register','my_customize_register');
function my_customize_register( $wp_customize ) {
    // Section
    $wp_customize->add_section('mustache_section', array(
        'title' => __('My section title', MUSTACHE_THEME_TEXTDOMAIN),
        'priority' => 30,
        'description' => __('My section description', MUSTACHE_THEME_TEXTDOMAIN),
    ));

    // Setting
    $wp_customize->add_setting("mustache_my_settings", array(
        "default" => "Mustache text test test",
        "transport" => "postMessage",
    ));

    // Control
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "mustache_my_settings",
        array(
            "label" => __("Title", MUSTACHE_THEME_TEXTDOMAIN),
            "section" => "mustache_section",
            "settings" => "mustache_my_settings",
            "type" => "textarea",
        )
    ));

    // Setting
    $wp_customize->add_setting("mustache_my_test_settings", array(
        "default" => "",
        "transport" => "postMessage",
    ));

    // Control
    $wp_customize->add_control( 'step_by_step_my_test_settings', array(
        'label'       => __("Label", MUSTACHE_THEME_TEXTDOMAIN),
        'section'     => 'mustache_section',
        'type'        => 'input',
        'description' =>  __("Description", MUSTACHE_THEME_TEXTDOMAIN)
    ) );

    // Setting
    $wp_customize->add_setting("mustache_my_img_settings", array(
        "default" => "",
        "transport" => "postMessage",
    ));

    // Control
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'mustache_my_img_settings',
            array(
                'label'      => __( 'Upload a logo', MUSTACHE_THEME_TEXTDOMAIN),
                'section'    => 'mustache_section',
                'settings'   => 'mustache_my_settings',
                //'context'    => 'your_setting_context'
            )
        )
    );


    // Setting
    $wp_customize->add_setting("mustache_my_upload_settings", array(
        "default" => "",
        "transport" => "postMessage",
    ));

    // Control
    $wp_customize->add_control(
        new WP_Customize_Upload_Control(
            $wp_customize,
            'mustache_my_upload_settings',
            array(
                'label'      => __( 'Upload', MUSTACHE_THEME_TEXTDOMAIN),
                'section'    => 'mustache_section',
                'settings'   => 'mustache_my_upload_settings'
            )
        )
    );

    // Setting
    $wp_customize->add_setting("mustache_my_color_settings", array(
        "default" => "",
        "transport" => "postMessage",
    ));

    // Control
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'mustache_my_color_settings',
            array(
                'label'      => __( 'Color', MUSTACHE_THEME_TEXTDOMAIN),
                'section'    => 'mustache_section',
                'settings'   => 'mustache_my_color_settings'
            )
        )
    );
}

add_action( 'customize_preview_init', 'my_customizer_script' );
function my_customizer_script() {
    wp_enqueue_script(
        'my-customizer-script',
        get_template_directory_uri().'/js/my-customizer-script.js', //$src,
        array( 'jquery', 'customize-preview' )
    );
}
