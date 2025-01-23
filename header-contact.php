<!DOCTYPE html>

<html class="full-height" lang="<?php language_attributes();?>">
    <head>
        <meta charset="<?php bloginfo('charset');?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php wp_title("|", TRUE, "right")?> <?php bloginfo("info");?></title>
        <meta name="description" content="<?php bloginfo('description');?>" />

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
            *   Contact page specific styles
            */
            #main-h1-header{color: <?php echo GetContactFirstSlideHeaderColor(); ?>; font-size: <?php echo GetContactMainHeaderFontSize(); ?>em;}
            #main-h2-header-1{color: <?php echo GetContactFirstSlideParagraphColor(); ?>; font-size: <?php echo GetContactSecondaryHeaderFontSize(); ?>em;}
            #main-h2-header-2{color: <?php echo GetContactFirstSlideParagraphColor(); ?>; font-size: <?php echo GetContactSecondaryHeaderFontSize(); ?>em;}
            #header-nav{background-color: <?php echo GetContactNavbarColor(); ?>;}
            body, .contact-content{background-color: <?php echo GetContactSecondSlideBackgroundColor(); ?>;}
            #contact{color: <?php echo GetContactSecondSlideContactHeaderColor(); ?>; font-size: <?php echo GetContactContactFollowUsFontSize(); ?>em;}
            .contact-hightlight{color: <?php echo GetContactSecondSlideGiveCallHeaderColor(); ?>;}
            #follow-us{color: <?php echo GetContactSecondSlideFollowUsHeaderColor(); ?>; font-size: <?php echo GetContactContactFollowUsFontSize(); ?>em;}
            #send-use-a-message{color: <?php echo GetContactSendMessageHeaderColor(); ?>; font-size: <?php echo GetContactSendAMessageFontSize(); ?>em;}
            .contact-p{color: <?php echo GetContactParagaphsColor(); ?>; font-size: <?php echo GetContactParagraphsFontSize(); ?>em;}
            footer{background-color: <?php echo GetContactFooterBackgroundColor(); ?>;}
            footer .contact-info p, footer .address-info p{color: <?php echo GetContactFooterTextColor(); ?>; font-size: <?php echo GetContactFooterTextFontSize(); ?>em;}
            .slide-fade-effect{background-color: <?php echo GetGlobalSlidFadeBackgroundColor(); ?>; }

            /*
            * Form submit message button
            */
            #submit-top-image{
                transition: opacity 0.5s ease;
                opacity: 1;
            }
            #submit-top-image:hover{
                opacity: 0;
                cursor: pointer;
            }

        </style>
    </head>
    <body class="full-height">

        <!--Header nav bar-->
        <div id="header-nav">
            <a href="<?php echo GetContactNavbarMastheadLinkDestintion(); ?>"><img class="visible-xs visible-sm fl headerMasthead" src="<?php echo GetGlobalMobileMasthead(); ?>" alt="masthead"/></a>
            <a href="<?php echo GetContactNavbarMastheadLinkDestintion(); ?>"><img class="visible-md visible-lg fl headerMasthead" src="<?php echo GetContactNavbarMasthead(); ?>" alt="masthead"/></a>
            <div id="navButtonFloat" class="fr button-extra-margin">
                <a id="headerMenuButton" href="#headerMenuButton"> <img src="<?php echo GetContactNavbarMenuButton(); ?>" alt="Nav">  </a>
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
