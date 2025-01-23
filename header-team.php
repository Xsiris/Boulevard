<!DOCTYPE html>

<html class="full-height" lang="<?php language_attributes();?>">
    <head>
        <meta charset="<?php bloginfo('charset');?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php wp_title("|", TRUE, "right")?> <?php bloginfo('info')?></title>
        <meta name="description" content="<?php bloginfo('description');?>" />

        <link rel="icon" href="<?php echo THEMEROOT . '/favicon.ico' ?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo THEMEROOT . '/favicon.ico' ?>" type="image/x-icon" />

        <!-- All compiled styles -->
        <link rel="stylesheet" href="<?php print THEMEROOT?>/public/css/styles.css" />

        <!--Sidr--> 
        <link rel="stylesheet" type="text/css" href="<?php print THEMEROOT?>/src/sidr/css/SidrStyle.css" /> 

        <!--Remodal stylsheet-->
        <link rel="stylesheet" href="<?php print THEMEROOT?>/src/remodal/css/jquery.remodal.css">

        <!-- Font Awsome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
            *   Team specific styles
            */
            .team-main-header{color: <?php echo get_theme_mod('team_firstslide_text_color_control_setting'); ?>; font-size: <?php echo GetTeamFirstSlideHeaderFonstSize(); ?>em;}
            #header-nav{background-color: <?php echo get_theme_mod('team_navbar_color_control_setting'); ?>}
            .h2-margin{color: <?php echo get_theme_mod('team_secondslide_header_text_color_control_setting');  ?>}
            #slide2-headerdiv, .team-row{background-color: <?php echo get_theme_mod('team_secondslide_background_color_control_setting'); ?>}
            .team-member h4{color: <?php echo get_theme_mod('team_employee_name_textcolor_control_setting'); ?>; font-size:<?php echo GetTeamEmployeeNameFontSize(); ?>em;}
            .team-member a p{color: <?php echo GetTeamEmployeeEmailColor(); ?>; font-size:<?php echo GetTeamEmployeeEmailFontSize(); ?>em;}
            .team-member a p:hover{color: <?php echo GetTeamEmployeeEmailHoverColor(); ?>}
            .tour-join{background-color: <?php echo get_theme_mod('team_workspace_join_area_background_color'); ?>}
            .workspace-overlay-text{color: <?php echo GetTeamWorkspaceColor(); ?>; font-size:<?php echo GetTeamWorkspaceFontSize(); ?>em;}
            .join-overlay-text{color: <?php echo GetTeamJoinTeamColor(); ?>;  font-size:<?php echo GetTeamJoinTeamFontSize(); ?>em;}
            footer{background-color: <?php echo get_theme_mod('team_footer_background_color'); ?>}
            footer .contact-info p, footer .address-info p{color: <?php echo get_theme_mod('team_footer_text_color_control_setting'); ?>; font-size:<?php echo GetTeamFooterTextFontSize(); ?>em;}
            .slide-fade-effect{background-color: <?php echo GetGlobalSlidFadeBackgroundColor(); ?>; }

        </style>

    </head>