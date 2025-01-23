<!DOCTYPE html>

<html class="no-overflow-x full-height" lang="<?php language_attributes(); ?>" >
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php wp_title('|', TRUE, 'right'); ?> <?php bloginfo('info'); ?></title> <!--Name of page | name of blog-->
        <meta name="description" content="<?php bloginfo('description');?>" />
        <meta name="author" content="" />

        <link rel="icon" href="<?php echo THEMEROOT . '/favicon.ico' ?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo THEMEROOT . '/favicon.ico' ?>" type="image/x-icon" />

        <!-- All compiled styles -->
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>" />
        <!--Favincon-->
        <link rel="shortcut icon" href="<?php print IMAGES?>/favicon.ico" />

        <!--Sidr--> 
        <link rel="stylesheet" type="text/css" href="<?php print THEMEROOT?>/src/sidr/css/SidrStyle.css" /> 

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?php wp_head(); ?>
        <!-- Styles from customize page in wordpress dashboard -->
        <style>
            .text-blvd-white-hover{color:<?php echo get_theme_mod('requestLinkColor_control_setting'); ?>}
            #leftmostlink-wpsettings{color:<?php echo get_theme_mod('leftLinkColor_control_setting'); ?>}
            #rightmostlink-wpsettings{color:<?php echo get_theme_mod('rightLinkColor_control_setting'); ?>}
            #footer-fixed-bar{background-color:<?php echo get_theme_mod('footer_bar_control_setting'); ?>}

            /*
            *   Side panel submit button
            */
            #submit-top{background-image: url('<?php echo WPMEDIA . '/SubmitRequestRev.png' ?>');}
            #submit-bottom{background-image: url('<?php echo WPMEDIA . '/SubmitRequestRev.png' ?>');}

            /*
            *   Sidr social icon settings
            */
            #sidr-id-content #sidr-id-sidrFooter #sidr-id-socialIcons li.sidr-class-facebook{background: url('<?php echo GetSidePanelFacebook(); ?>') no-repeat top left; background-size: 65%;  line-height: 32px; background-position: 0px 1px; margin-right: -10px;}
            #sidr-id-content #sidr-id-sidrFooter #sidr-id-socialIcons li.sidr-class-facebook a{background: url('<?php echo GetSidePanelFacebook(); ?>') no-repeat center center; background-size: 65%;  color: transparent; background-position: 0px -33px;}

            #sidr-id-content #sidr-id-sidrFooter #sidr-id-socialIcons li.sidr-class-twitter{background: url('<?php echo GetSidePanelTwitter(); ?>') no-repeat top left; background-size: 65%;  line-height: 32px; background-position: 0px 1px; margin-right: -10px;}
            #sidr-id-content #sidr-id-sidrFooter #sidr-id-socialIcons li.sidr-class-twitter a{background: url('<?php echo GetSidePanelTwitter(); ?>') no-repeat center center; background-size: 65%;  color: transparent; background-position: 0px -33px;}

            #sidr-id-content #sidr-id-sidrFooter #sidr-id-socialIcons li.sidr-class-pinterest{background: url('<?php echo GetSidePanelPinterest(); ?>') no-repeat top left; background-size: 65%;  line-height: 32px; background-position: 0px 1px; margin-right: -10px;}
            #sidr-id-content #sidr-id-sidrFooter #sidr-id-socialIcons li.sidr-class-pinterest a{background: url('<?php echo GetSidePanelPinterest(); ?>') no-repeat center center; background-size: 65%;  color: transparent; background-position: 0px -33px;}

            #sidr-id-content #sidr-id-sidrFooter #sidr-id-socialIcons li.sidr-class-instagram{background: url('<?php echo GetSidePanelInstagram(); ?>') no-repeat top left; background-size: 65%;  line-height: 32px; background-position: 0px 1px; margin-right: -10px;}
            #sidr-id-content #sidr-id-sidrFooter #sidr-id-socialIcons li.sidr-class-instagram a{background: url('<?php echo GetSidePanelInstagram(); ?>') no-repeat center center; background-size: 65%;  color: transparent; background-position: 0px -33px;}
        </style>

    </head>
    <body class="prevent-sidr-gimp">
       <div class="wrapper full-height">
            <div id="header" class="container-fluid">
                    <div class="row">
                         <header>
                            <div class="col-xs-6 masthead">
                                <a href="<?php echo get_theme_mod('masthead_link') == '' ? home_url() : get_theme_mod('masthead_link'); ?>"> <img class="img-responsive" src="<?php echo (strlen(get_theme_mod('mastheadimage_control_setting')) == 0) ? WPMEDIA . '/BLVDMasthead.png' : get_theme_mod('mastheadimage_control_setting'); ?>" alt="<?php bloginfo('name');?> | <?php bloginfo('description');?>" /> </a>
                            </div>
                            <div class="col-xs-6 top-right-nav">
                                <a id="sideMenuButton" href="#sideMenu"> <img class="fr left-gutter img-responsive" src="<?php echo strlen(get_theme_mod('menubtn_control_setting')) == 0 ? WPMEDIA . '/MenuButton.png' : get_theme_mod('menubtn_control_setting'); ?>" alt="Open" /> </a>
                                <div class="fr hidden-xs">
                                    <a id="request-proj-menu" href="/#requestMenu" class="link-with-icon"> <span id="request-wpsettings" class="text-blvd-white-hover request-button-style">Request Project</span> <img class="go-icon" src="<?php echo (strlen(get_theme_mod('request_menubtn_control_setting')) == 0) ? WPMEDIA . '/ArrowGlyph.png' : get_theme_mod('request_menubtn_control_setting'); ?>" alt="Go"/> </a>
                                </div>
                            </div>
                        </header>
                    </div>
            </div>