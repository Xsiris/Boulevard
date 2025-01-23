<?php
/*
Template Name: Projects
*/
?>

<?php get_header(); ?>

<div class="row full-height">
    <div class="slide-fade-effect"></div>
        <div class="row full-height">
            <div class="col-xs-12"> <!--full-height-->
                <div class="center-text absolute-vert-center">
                    <h1 class="blvd-text team-main-header">
                        Look at our creative work
                            <br>
                            <br>
                        Branded merchandise designed by BOULEVARD
                    </h1>
                </div>
            </div>
        </div>
        <div class="row down-arrow" id="downArrowPos">
            <div class="col-xs-12">
                <a class="slide-down-arrow" onclick="MoveSlide();">
                    <img src="<?php echo GetOfficeDownArrow(); ?>" alt="DownArrow">
                </a>
            </div>
        </div>
    </div>
</div>
    </div>
        <div class="container-fluid full-height destinationSlide remodal-bg">
            <div class="row slide-splitter-content">
                <div class="col-sx-12">
                    <h2 class="blvd-text-dark header-splitter">Projects</h2>
                </div>
            </div>

            <!--Project images-->
            <?php
            $numberOfRows = GetWorkNumberOfProjectImages();
            $numberOfColumns = 5;
            for($currRow = 0; $currRow < $numberOfRows; $currRow++){
                echo '<div class="row no-gutter" id="link">';
                for($currColumn = ($currRow * $numberOfColumns) + 1; $currColumn < (($currRow * $numberOfColumns) + 1) + $numberOfColumns; $currColumn++){
                    $file = WPMEDIA . "/$currColumn.jpg";
                    $file_headers = @get_headers($file);
                    if($file_headers[0] === 'HTTP/1.1 404 Not Found' || $file_headers[0] == 'HTTP/1.0 404 Not Found'){
                    ?>
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-5ths <?php echo CalculateVisibility($currRow, $currColumn, $numberOfColumns); ?>">
                            <a class="cursor-hover-none">
                                <img class="img-responsive resize decZ-index" src="<?php echo WPMEDIA . '/NullImg.png'; ?>" alt="Project Image" />
                            </a>
                        </div>
                    <?php
                    }else{
                    ?>
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-5ths <?php echo CalculateVisibility($currRow, $currColumn, $numberOfColumns); ?>">
                            <a class="image" href="#modal<?php echo $currColumn; ?>">
                            <div class="border"></div>
                                <img class="img-responsive resize decZ-index proj-image" src="<?php echo WPMEDIA . '/' . $currColumn . '.jpg' ?>" alt="Project Image" />
                            </a>
                        </div>
                    <?php
                        /*$textFileContent = file('C:\xampp\xammp\htdocs\WP\wp-content\uploads\proj_1.txt');*/
                        $htmlContent = "<!--The rest of the missing html here is filled in via javascript!--> \n" .
                        "<div class=\"row\">\n" .
                        "\t<div style=\"margin-top: 15px;\" class=\"col-xs-12 col-sm-6 col-md-6\">\n" .
                        "\t\t<div style=\"width: 100%;\">\n" .
                        "\t\t\t<img src=\"" . WPMEDIA . '/' . $currColumn . '.jpg' . "\" alt=\"image\" style=\"width: 100%; padding-right: 12px;\" />\n" .
                        "\t\t</div>\n" .
                        "\t</div>\n" .
                        "\t<div class=\"col-xs-12 col-sm-6 col-md-6\">\n" .
                        "\t\t<h1 style=\"font-family: 'Myriad Pro Regular';\">Header</h1>\n" .
                        "\t\t<div style=\"width:100%; word-wrap:break-word;\" class=\"col-xs-12 col-sm-6 col-md-6\">\n" .
                        "\t\t\t<p style=\"font-family: 'Myriad Pro Regular'; text-align:left;\">\n" .
                        "\t\t\t\t Body content \n" .
                        "\t\t\t</p>\n" .
                        "\t\t</div>\n" .
                        "\t</div>\n" .
                        "</div>\n" .
                        "</div>\n" .
                        "</div>\n";
                        $fileValue;
                        if($currColumn < 10){
                            $fileValue = 0 . (string)$currColumn;
                        }else{
                            $fileValue = $currColumn;
                        }
                        if(!file_exists(THEMEROOTSTATIC . '/ModalProj_' . $fileValue . '.php') || GetAdvancedSettingProjectAllowModalTextSeeding()){
                            $file = fopen(THEMEROOTSTATIC . '/ModalProj_' . $fileValue . '.php', 'w') or exit('Unable to open | create file');
                            fwrite($file, $htmlContent);
                            fclose($file);
                        }
                    }
                }
                echo '</div>';
            }
            ?>
            <!--END Project images-->

            <div class="row slide-splitter-empty">
                <div class="col-xs-12"></div>
            </div>

            <div class="row partner-withus">
                <div class="col-xs-12 col-md-4 col-md-offset-8">
                    <h4 class="blvd-text partner-text-header">Partner with us</h4>
                    <p class="blvd-text partner-text-p">Do you have a project we can help you with?</p>
                    <a href="#project-request-forward" id="project-request-forward" class="display-md"><img src="<?php echo strlen(get_theme_mod('work_footer_fowardbtn_control_setting')) == 0 ? WPMEDIA . '/Forward.png' : get_theme_mod('work_footer_fowardbtn_control_setting'); ?>" alt="Forward" /></a>
                </div>
            </div>

            <footer class="row">
                <div class="col-sm-4 contact-info">
                    <div class="fr-md fr-landscape">
                        <p>Call 604-277-5886</p>
                        <p>info@creativeboulevard.com</p>
                    </div>
                </div>
                <div class="col-sm-5 address-info">
                    <div class="text-center-md">
                        <p>Boulevard Advertising</p>
                        <p>188-11860 Hammersmith Way</p>
                        <p>Richmond, BC V7A 5G1</p>
                    </div>
                </div>
                <div class="col-sm-3 social-info">
                    <div id="iconContainer">
                        <ul id="socialIcons">
                            <li class="facebook"> <a href="https://www.facebook.com/creativeboulevard" target="_blank"> Like </a> </li>
                            <li class="twitter"> <a href="https://twitter.com/BoulevardAd" target="_blank"> F </a> </li>
                            <li class="pinterest"> <a href="http://www.pinterest.com/boulevardad/" target="_blank"> P </a> </li>
                            <li class="instagram"> <a href="http://instagram.com/creativeboulevard" target="_blank"> I </a> </li>
                        </ul>
                    </div>
                </div>
            </footer>
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

                    <li class="splitterMargin"> <img src="<?php print WPMEDIA . '/MenuSplitter.png' ?>" alt="splitter"/> </li>
                </ul> 
                <div id="sidrFooter">
                    <ul id="socialIcons">
                        <li class="facebook"> <a href="https://www.facebook.com/creativeboulevard" target="_blank"> F </a> </li> <!--The letter used inside the <a> tag determines the width/height of the icon-->
                        <li class="twitter"> <a href="https://twitter.com/BoulevardAd" target="_blank"> F </a> </li>
                        <li class="pinterest"> <a href="http://www.pinterest.com/boulevardad/" target="_blank"> F </a> </li>
                        <li class="instagram"> <a href="http://instagram.com/creativeboulevard" target="_blank"> F </a> </li>
                    </ul>
                </div>
            </div>
        </div>
      </div>

        <!-- END Sidr navigation side bar -->

<?php get_footer('projects'); ?>