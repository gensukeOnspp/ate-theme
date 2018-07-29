<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- <meta http-equiv="Content-Type" content="text/html"> -->
        <title><?php wp_title( '' );  ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="Images" href="<?php echo get_template_directory_uri(); ?>">
        <!-- <link rel="stylesheet" href="normalize.css"> -->
        <!-- <link rel="stylesheet" href="css/main.css"> -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fix.css" type="text/css" />

        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
			<header>
			<?php wp_nav_menu( array ( 'theme_location' => 'top-navi' ,
											'container' => 'header')); ?>
			</header>
            <div class="dynamic_img"></div>
            <div class="header">
                <div class="logo"></div>
                <div class="hright">
                    <?php get_search_form(); ?>
                    <div class="tel">&#9742;011-623-2255</div>
                    <div class="reception_time">受付時間：月～金　１０：００～１７：００</div>
                </div>
            </div> <!-- .header -->
        </div> <!-- .header-container -->
