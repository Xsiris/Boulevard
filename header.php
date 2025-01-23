<!DOCTYPE html>

<html class="full-height" lang="<?php language_attributes();?>">
    <head>
        <meta charset="<?php bloginfo('charset');?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php wp_title('|', TRUE, 'right'); ?> <?php bloginfo('info'); ?>></title>
        <meta name="description" content="<?php bloginfo('description');?>" />

        <link rel="icon" href="<?php echo THEMEROOT . '/favicon.ico' ?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo THEMEROOT . '/favicon.ico' ?>" type="image/x-icon" />

        <!-- All compiled styles -->
        <link rel="stylesheet" href="<?php print THEMEROOT?>/public/css/styles.css" />

        <!--Sidr--> 
        <link rel="stylesheet" type="text/css" href="<?php print THEMEROOT?>/src/sidr/css/SidrStyle.css" /> 

        <!--Remodal stylsheet-->
        <link rel="stylesheet" href="<?php print THEMEROOT?>/src/remodal/css/jquery.remodal.css">

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
            *   Projects page specific WP styles
            */
            .slide-1-h1 .blvd-text{color: <?php echo get_theme_mod('work_firstslide_headertext_color_control_setting'); ?>; font-size: <?php echo get_theme_mod('work_slide1_headerfontsize_control_setting');?>em;}
            #header-nav {background-color: <?php echo get_theme_mod('work_navbar_color_control_setting'); ?>;}
            .slide-splitter-content{background-color: <?php echo get_theme_mod('work_projectsplitter_control_setting'); ?>;}
            .destinationSlide, .destinationSlide #link{background-color: <?php echo get_theme_mod('work_projectimages_bg_cntrol_setting'); ?>;}
            .header-splitter{color: <?php echo get_theme_mod('work_projectsplitter_text_control_setting'); ?>; font-size: <?php echo get_theme_mod('work_projectsplitter_fontsize_control_setting');?>em;}
            .slide-splitter-empty{background-color: <?php echo get_theme_mod('work_footersplitter_control_setting'); ?>;}
            .partner-text-header{color: <?php echo get_theme_mod('work_partnerwithus_header_color_control_setting'); ?>; font-size: <?php echo get_theme_mod('work_partnerwithus_header_fontsize_control_setting');?>em;}
            .partner-text-p{color: <?php echo get_theme_mod('work_partnerwithus_paragraph_color_control_setting'); ?>; font-size: <?php echo get_theme_mod('work_partnerwithus_paragraphfontsize_sontrol_setting')?>em;}
            footer{background-color: <?php echo get_theme_mod('work_footerbg_color_control_setting'); ?>;}
            footer .contact-info p, footer .address-info p {color: <?php echo get_theme_mod('work_footertext_color_control_setting'); ?>; font-size: <?php echo get_theme_mod('work_footer__textfont_control_setting')?>em;}
            .slide-fade-effect{background-color: <?php echo GetGlobalSlidFadeBackgroundColor(); ?>; }

        </style>
    </head>
    <body class="prevent-sidr-gimp">
        <!--Header nav bar-->
        <div id="header-nav">
            <a href="<?php echo GetWorkNavbarMastaheadLinkDestination(); ?>"><img class="visible-xs visible-sm fl headerMasthead" src="<?php echo WPMEDIA . '/BlvdMobile.png'; ?>" alt="masthead"/></a>
            <a href="<?php echo GetWorkNavbarMastaheadLinkDestination(); ?>"><img class="visible-md visible-lg fl headerMasthead" src="<?php echo strlen(get_theme_mod('work_nav_masthead_control_setting')) == 0 ? WPMEDIA . '/BoulevardProjects.png' : get_theme_mod('work_nav_masthead_control_setting'); ?>" alt="masthead"/></a>
            <div id="navButtonFloat" class="fr button-extra-margin">
                <a id="headerMenuButton" href="#headerMenuButton"> <img src="<?php echo strlen(get_theme_mod('work_nav_menubtn_control_setting')) == 0 ? WPMEDIA . '/MenuButtonGrey.png' : get_theme_mod('work_nav_menubtn_control_setting'); ?>" alt="Nav">  </a>
            </div>
            <div id="socialIconFloat" class="visible-md visible-lg socialIcon-correct fr"> <!--Not visible on small devices for now-->
                <ul id="socialIcons" class="fr crct-wdth">
                    <li class="instagram fr"> <a href="<?php echo GetSocialIconLink4Destination(); ?>" target="_blank"> I </a> </li>
                    <li class="pinterest fr"> <a href="<?php echo GetSocialIconLink3Destination(); ?>" target="_blank"> P </a> </li>
                    <li class="twitter fr"> <a href="<?php echo GetSocialIconLink2Destination(); ?>" target="_blank"> F </a> </li>
                    <li class="facebook fr"> <a href="<?php echo GetSocialIconLink1Destination(); ?>" target="_blank"> Like </a> </li>
                </ul>                
            </div>
        </div>

        <div id="header" class="container-fluid full-height bs-background">       
                <div class="row">
                    <div class="col-xs-6">
                    <!-- <img class="img-responsive masthead" src="src/images/BLVDMasthead.png" alt="Boulevard" /> -->
                    </div>
                    <div class="col-xs-6 top-right-nav">
                        <a id="sideMenuButton" href="#sideMenu"> <img class="fr left-gutter" src="<?php echo strlen(get_theme_mod('work_menubtn_control_setting')) == 0 ? WPMEDIA . '/MenuButton.png' : get_theme_mod('work_menubtn_control_setting'); ?>" alt="Open" /> </a>
                    </div>
                </div> 
                       
        <!-- </div> -->
        <!-- <div class="container-fluid"> -->