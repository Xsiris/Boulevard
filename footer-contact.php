<div class="container-fluid">
            <footer class="row">
                <div class="col-md-4 contact-info">
                    <div class="fr-md">
                        <p>Call 604-277-5886</p>
                        <p>info@creativeboulevard.com</p>
                    </div>
                </div>
                <div class="col-md-4 address-info">
                    <div class="text-center-md">
                        <p>Boulevard Advertising</p>
                        <p>188-11860 Hammersmith Way</p>
                        <p>Richmond, BC V7A 5G1</p>
                    </div>
                </div>
                <div class="col-md-4 social-info">
                    <div id="iconContainer">
                        <ul id="socialIcons">
                            <li class="facebook"> <a href="https://www.facebook.com/creativeboulevard" target="_blank"> Like </a> </li>
                            <li class="twitter"> <a href="https://twitter.com/creativeblvd1" target="_blank"> F </a> </li>
                            <li class="pinterest"> <a href="http://www.pinterest.com/boulevardad/" target="_blank"> P </a> </li>
                            <li class="instagram"> <a href="http://instagram.com/creativeboulevard" target="_blank"> I </a> </li>
                        </ul>
                    </div>
                </div>
                </footer>
                </div>
        </div>

        <!--Sidr navigation side bar -->

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
                <!--Social media icons--> 
                <div id="sidrFooter">
                    <ul id="socialIcons">
                        <li class="facebook"> <a href="https://www.facebook.com/creativeboulevard" target="_blank"> F </a> </li> 
                        <li class="twitter"> <a href="https://https://twitter.com/creativeblvd1" target="_blank"> F </a> </li>
                        <li class="pinterest"> <a href="http://www.pinterest.com/boulevardad/" target="_blank"> F </a> </li>
                        <li class="instagram"> <a href="http://instagram.com/creativeboulevard" target="_blank"> F </a> </li>
                    </ul>
                </div><!--The letter used inside the <a> tag determines the width/height of the icon-->
            </div>
        </div>
      </div>

        <!-- END Sidr navigation side bar -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <!--Include and use Backstretch -->
        <script src="<?php print THEMEROOT?>/src/backstretch/jquery.backstretch.min.js"></script>
        <script> $("#header").backstretch(["<?php echo GetContactFirstSlideBackground(); ?>"], { /*duration: 4000, fade: 750*/ }); </script>

        <!-- Include the Sidr JS -->
        <script src="<?php print THEMEROOT?>/src/sidr/js/jquery.sidr.min.js"></script> 
        
        <!--Boulevard specific scripts-->
        <script src="<?php print THEMEROOT?>/src/js/Boulevard-Base.js"></script>
        
        <?php wp_footer(); ?>
    </body>
</html>