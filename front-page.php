<?php get_header('index'); ?>

<div class="absolute-vert-center">
                <div class="container">
                    <div class="row">
                    <div class="col-xs-12">
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12"> <img class="center-block img-responsive" src="<?php echo get_theme_mod('slogan_image_control_setting') == '' ? WPMEDIA . "/PromotingYou.png" : get_theme_mod('slogan_image_control_setting'); ?>" alt="Promoting you creatively" /> </div>
                        </div>
                        <div class="row link-margin">
                                        <div class="col-md-6">
                                            <div class="fr-md center-block-mobile-only"> 
                                                <a id="see-work-icon" href="<?php echo get_theme_mod('rightLinkDestination_control_setting') == '' ? GetIndexOurWorkPage() : get_theme_mod('rightLinkDestination_control_setting')?>" class="link-with-icon">
                                                    <span id="leftmostlink-wpsettings" class="text-blvd-white boulevard-font"><?php echo get_theme_mod('leftLinkText_control_setting') == '' ? 'SEE OUR WORK' : get_theme_mod('leftLinkText_control_setting'); ?></span> <img class="go-icon" src="<?php echo (strlen(get_theme_mod('leftmost_menubtn_control_setting')) == 0) ? WPMEDIA . '/ArrowGlyph.png' : get_theme_mod('leftmost_menubtn_control_setting'); ?>" alt="go"/>
                                                </a> 
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="fl-md center-block-mobile-only">
                                                <a id="about-btn"" href="<?php echo get_theme_mod('leftLinkDestination_control_setting') == '' ? GetIndexAboutPage() : get_theme_mod('leftLinkDestination_control_setting')?>" class="link-with-icon"> <span id="rightmostlink-wpsettings" class="text-blvd-white boulevard-font"><?php echo get_theme_mod('rightLinkText_control_setting') == '' ? 'ABOUT BOULEVARD' : get_theme_mod('rightLinkText_control_setting'); ?></span> <img class="go-icon" src="<?php echo (strlen(get_theme_mod('right_menubtn_control_setting')) == 0) ? WPMEDIA . '/ArrowGlyph.png' : get_theme_mod('right_menubtn_control_setting'); ?>" alt="go"/> </a>
                                            </div>
                                        </div>

                        </div>
                     </div>
                </div>
                        </div>
                    </div>
           </div>
           <div id="footer-fixed-bar"></div>
        </div>

<!--SIDR NAVIGATION SIDE BAR -->
        
        <div class="hide-sidr-html" id="navigation">
          <div id="sidrWrapper">
              <div id="exitButton">
                    <a href="#" class="no-jump exit-sidr main-menu"> <img src="<?php echo GetGlobalSidePanelExitButton(); ?>" alt="exit"> </a>
              </div>
            <div id="content">
                <ul id="mainMenu">

                    <?php
                        wp_nav_menu(array('theme_location' => 'side-menu-pt-1'));
                    ?>

                    <li class="splitterMargin"> <img src="<?php print WPMEDIA . '/MenuSplitter.png' ?>" alt="splitter"/> </li>

                    <?php
                        wp_nav_menu(array('theme_location' => 'side-menu-pt-2'));
                    ?>

                    <li class="splitterMargin"> <img src="<?php print WPMEDIA . '/MenuSplitter.png' ?>" alt="splitter"/> </li>

                    <?php
                        wp_nav_menu(array('theme_location' => 'side-menu-pt-3'));
                    ?>

                    <li class="careers-display-md"><a href="#careersMenu" id="careersMenuButton"> Join Us </a></li>
                    <li><a href="#requestMenu" id="requestMenuButton"> Request Project </a></li>
                    <li><a href="http://boulevardadvertising.promocan.com/" target="_blank"> Product Search </a></li>

                    <li class="splitterMargin-bottom"> <img src="<?php print WPMEDIA . '/MenuSplitter.png' ?>" alt="splitter"/> </li>

                </ul> 
                <div id="sidrFooter">
                    <ul id="socialIcons">
                        <li class="facebook"> <a href="<?php echo GetSocialIconLink1Destination(); ?>" target="_blank"> F </a> </li> <!--The letter used inside the <a> tag determines the width/height of the icon-->
                        <li class="twitter"> <a href="<?php echo GetSocialIconLink2Destination(); ?>" target="_blank"> F </a> </li>
                        <li class="pinterest"> <a href="<?php echo GetSocialIconLink3Destination(); ?>" target="_blank"> F </a> </li>
                        <li class="instagram"> <a href="<?php echo GetSocialIconLink4Destination(); ?>" target="_blank"> F </a> </li>
                    </ul>
                </div>
            </div>
        </div>
      </div>

<?php get_footer('index'); ?>

