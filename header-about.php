<!DOCTYPE html>

<html lang="<?php language_attributes();?>" class="full-height" style="overflow-x: hidden">
    <head>
        <meta charset="<?php bloginfo('charset')?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php wp_title('|', TRUE, 'right'); ?> <?php bloginfo('info'); ?></title>
        <meta name="description" content="<?bloginfo('description');?>" />

        <link rel="icon" href="<?php echo THEMEROOT . '/favicon.ico' ?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo THEMEROOT . '/favicon.ico' ?>" type="image/x-icon" />

        <!-- All compiled styles -->
        <link rel="stylesheet" href="<?php print THEMEROOT?>/public/css/styles.css" />

        <!--Sidr--> 
        <link rel="stylesheet" type="text/css" href="<?php print THEMEROOT?>/src/sidr/css/SidrStyle.css" /> 

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?php wp_head(); ?>
        <style>
            /*
            *   Header nav bar sprites
            */
            #header-nav #socialIcons li.facebook{background: url('<?php echo GetNavBarFacebookSprite(); ?>'); no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            #header-nav #socialIcons li.facebook a{background: url('<?php echo GetNavBarFacebookSprite(); ?>'); no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            #header-nav #socialIcons li.twitter{ background: url('<?php echo GetNavBarTwitterSprite(); ?>') no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            #header-nav #socialIcons li.twitter a{ background: url('<?php echo GetNavBarTwitterSprite(); ?>') no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            #header-nav #socialIcons li.pinterest{ background: url(<?php echo GetNavBarPinterestSprite(); ?>) no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            #header-nav #socialIcons li.pinterest a{ background: url(<?php echo GetNavBarPinterestSprite(); ?>) no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            #header-nav #socialIcons li.instagram{ background: url(<?php echo GetNavBarInstageam(); ?>) no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            #header-nav #socialIcons li.instagram a{ background: url(<?php echo GetNavBarInstageam(); ?>) no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}
            /*
            * Footer sprites
            */
            footer #socialIcons li.facebook{background: url('<?php echo GetFooterFacebookSprite(); ?>'); no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            footer #socialIcons li.facebook a{background: url('<?php echo GetFooterFacebookSprite(); ?>'); no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            footer #socialIcons li.twitter{background: url('<?php echo GetFooterTwitterSprite(); ?>'); no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            footer #socialIcons li.twitter a{background: url('<?php echo GetFooterTwitterSprite(); ?>'); no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            footer #socialIcons li.pinterest{background: url('<?php echo GetFooterPinterestSprite(); ?>'); no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            footer #socialIcons li.pinterest a{background: url('<?php echo GetFooterPinterestSprite(); ?>'); no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            footer #socialIcons li.instagram{background: url('<?php echo GetFooterInstageam(); ?>'); no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            footer #socialIcons li.instagram a{background: url('<?php echo GetFooterInstageam(); ?>'); no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}
            /*
            * Contact page sprites
            */
            .contact-us li.facebook{background: url('<?php echo GetContactPageFacebookSprite(); ?>'); no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            .contact-us li.facebook a{background: url('<?php echo GetContactPageFacebookSprite(); ?>'); no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            .contact-us li.twitter{background: url('<?php echo GetContactPageTwitterSprite(); ?>'); no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            .contact-us li.twitter a{background: url('<?php echo GetContactPageTwitterSprite(); ?>'); no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            .contact-us li.pinterest{background: url('<?php echo GetContactPagePinterestSprite(); ?>'); no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            .contact-us li.pinterest a{background: url('<?php echo GetContactPagePinterestSprite(); ?>'); no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            .contact-us li.instagram{background: url('<?php echo GetContactPageInstageam(); ?>'); no-repeat left top; background-size: 100%; background-position: 0px 0px; width: 25px;}
            .contact-us li.instagram a{background: url('<?php echo GetContactPageInstageam(); ?>'); no-repeat left top; background-size: 100%; color: transparent; line-height: 30px; background-position: 0px -66px; width: 25px; height: 25px; display: block;}

            /*
            * About page specific styles
            */

            .who-we-are-background{background-color: <?php echo get_theme_mod('about_slide1_text_backgroundcolor_control_setting'); ?>; opacity: <?php echo GetAboutFirstSlideTextBackgroundOpacity(); ?>;}
            .main-header-style{color: <?php echo get_theme_mod('about_side1_maintext_control_setting'); ?>; font-size: <?php echo GetAboutMainHeaderTextFontSize();?>em; }
            .text-blvd-white-hover{color: <?php echo get_theme_mod('about_request_text_color_control_setting'); ?>; font-size: <?php echo GetAboutRequestProjTextFontSize();?>em;}
            .text-blvd-white-hover:hover{color: <?php echo get_theme_mod('about_request_texthover_color_control_setting'); ?>;}
            .who-we-are-header{color: <?php echo get_theme_mod('about_slide1_blurbheader_color_control_setting'); ?>; font-size: <?php echo GetAboutWhoWeAreHeaderTextFontSize();?>em;}
            .wwa-p{color: <?php echo get_theme_mod('about_slide1_blurbparagraph_color_control_setting'); ?>; font-size: <?php echo GetAboutWhoWeAreParagraphTextFontSize();?>em;}
            .slide-splitter-empty{background-color: <?php echo get_theme_mod('about_page_splitter_control_setting'); ?>;}
            .wwd-h3{color: <?php echo get_theme_mod('about_slide2_header_color_control_setting'); ?>; font-size: <?php echo GetAboutWhatWeDoHeaderTextFontSize();?>em;}
            .wwd-p{color: <?php echo get_theme_mod('about_slide2_paragraph_color_control_setting'); ?>; font-size: <?php echo GetAboutWhatWeDoParagraphTextFont();?>em;}
            footer{background-color: <?php echo get_theme_mod('about_footer_backgroundcolor_control_setting'); ?>;}
            footer .contact-info p, footer .address-info p{color: <?php echo get_theme_mod('about_footertext_color_control_setting'); ?>; font-size: <?php echo GetAboutFooterTextFontSize();?>em;}
            .slide-fade-effect{background-color: <?php echo GetGlobalSlidFadeBackgroundColor(); ?>; }
        </style>

    </head>