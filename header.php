<!DOCTYPE html>
<html>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php wp_title('|', true, 'right'); ?>
        <?php bloginfo('name'); ?>
    </title>

    <?php wp_head(); ?>

</head>
<body class="home">

<div id="masthead">

    <div id="header" role="banner">

        <div class="container">
            <div class="row">

                <a href="index.html" class="logo">
                    <img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" alt="">
                </a>

                <?php

                $args = array(
                    'theme_location' => '',        // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
                    'menu'            => 'Test_Menu',              // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                    // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                    'container'       => 'nav',           // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                    'container_class' => '',              // (string) class контейнера (div тега)
                    'container_id'    => 'main-menu',              // (string) id контейнера (div тега)
                    'menu_class'      => 'horizontal-navigation',          // (string) class самого меню (ul тега)
                    'menu_id'         => '',              // (string) id самого меню (ul тега)
                    'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
                    'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                    'before'          => '',              // (string) Текст перед <a> каждой ссылки
                    'after'           => '',              // (string) Текст после </a> каждой ссылки
                    'link_before'     => '',              // (string) Текст перед анкором (текстом) ссылки
                    'link_after'      => '',              // (string) Текст после анкора (текста) ссылки
                    'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                    'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu

                );

                wp_nav_menu($args);


                function nav_replace_wpse_189788($item_output, $item) {
                       var_dump($item_output, $item);
                    if ('Profile' == $item->title) {
                        global $my_profile; // no idea what this does?
                        if (is_user_logged_in()) {
                            return '<div class="img" data-key="profile">'.get_avatar( get_current_user_id(), 64 ).'</div>';
                        }
                    }
                    return $item_output;
                }
                add_filter('walker_nav_menu_start_el','nav_replace_wpse_189788',10,2);

                ?>
                <?php get_search_form(); ?>
                <ul id="navigation">
                    <li class="selected">
                        <a href="index.html">home</a>
                    </li>
                    <li>
                        <a href="about.html">about</a>
                    </li>
                    <li>
                        <a href="gallery.html">gallery</a>
                    </li>
                    <li>
                        <a href="blog.html">blog</a>
                    </li>
                    <li>
                        <a href="contact.html">contact</a>
                    </li>
                </ul>

            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- #site-header -->
    <div id="page-title">

    </div> <!-- #page-title -->
    <div id="page-title">
        <div class="container" id="customiser">
            <div class="row">

                <h1 class="entry-title" itemprop="headline" id="mustache_my_settings">
                    <?php
                    echo get_theme_mod("mustache_my_settings");
                    ?>

                </h1>
                <p class="description" itemprop="description">tortor felis quam rutrum velit, pretium posuere placerat. Vitae ut nulla eget</p>

            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- #page-title -->

</div> <!-- #masthead -->