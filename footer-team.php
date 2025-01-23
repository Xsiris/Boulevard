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
                        <li class="twitter"> <a href="https://twitter.com/creativeblvd1" target="_blank"> F </a> </li>
                        <li class="pinterest"> <a href="http://www.pinterest.com/boulevardad/" target="_blank"> F </a> </li>
                        <li class="instagram"> <a href="http://instagram.com/creativeboulevard" target="_blank"> F </a> </li>
                    </ul>
                </div> <!--The letter used inside the <a> tag determines the width/height of the icon-->
            </div>
        </div>
      </div>

        <div class="container-fluid">
            
            <footer class="row">
                <div class="col-sm-4 contact-info">
                    <div class="fr-md">
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
                            <li class="twitter"> <a href="https://twitter.com/creativeblvd1" target="_blank"> F </a> </li>
                            <li class="pinterest"> <a href="http://www.pinterest.com/boulevardad/" target="_blank"> P </a> </li>
                            <li class="instagram"> <a href="http://instagram.com/creativeboulevard" target="_blank"> I </a> </li>
                        </ul>
                    </div>
                </div>
            </footer>

        </div>

        <!-- END Sidr navigation side bar -->
        <?php
            for($i = 0; $i < GetTeamNumberOfImageRows(); $i++){
                $currRowCol = ($i * 3) + 1;
                for($j = $currRowCol; $j < $currRowCol + 3; $j++){
                $fileValue;
                    if($j < 10){
                        $fileValue = 0 . (string)$j;
                }else{
                    $fileValue = $j;
                }
                ?>
                    <div class="remodal" data-remodal-id="empmodal_<?php echo $j ?>" data-remodal-options="externalSheet: <?php echo WPTHEMEROOT . '/' . 'ModalEmpl_' . $fileValue . '.php'?>, allowEmail: true, email: <?php echo GetTeamEmployeeEmail($j); ?>, image: <?php echo WPMEDIASTATIC . '/emp_' . $j?>.jpg"></div>
                <?php
                }
            }
        ?>
        <!--Remodal html-->
        <!--<div class="remodal" data-remodal-id="modalWinston" data-remodal-options="externalSheet: modalhtml/TeamTest.html, allowEmail: true, email: winstonlo@creativeboulevard.com, image: wp-content/uploads/Winston.jpg"></div>
        <div class="remodal" data-remodal-id="modalSandy" data-remodal-options="externalSheet: modalhtml/TeamTest.html, allowEmail: true, email: sawentworth@creativeboulevard.com, image: wp-content/uploads/Sandy.jpg"></div>
        <div class="remodal" data-remodal-id="modalEvija" data-remodal-options="externalSheet: modalhtml/TeamTest.html, allowEmail: true, email: evijafeiste@creativeboulevard.com, image: wp-content/uploads/Evija.jpg"></div>
        <div class="remodal" data-remodal-id="modalCandy" data-remodal-options="externalSheet: modalhtml/TeamTest.html, allowEmail: true, email: candyChui@creativeboulevard.com, image: wp-content/uploads/Candy.jpg"></div>
        <div class="remodal" data-remodal-id="modalMercedes" data-remodal-options="externalSheet: modalhtml/TeamTest.html, allowEmail: true, email: mercedescoley@creativeboulevard.com, image: wp-content/uploads/Mercedes.jpg"></div>
        <div class="remodal" data-remodal-id="modalNick" data-remodal-options="externalSheet: modalhtml/TeamTest.html, allowEmail: true, email: nickharris@creativeboulevard.com, image: wp-content/uploads/Nick.jpg"></div>-->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

         <!--Include and use Backstretch -->
        <script src="<?php print THEMEROOT?>/src/backstretch/jquery.backstretch.min.js"></script>
        <script> $("#header").backstretch(["<?php echo GetTeamBackground(); ?>"], { /*duration: 4000, fade: 750*/ }); </script>

        <!--Remodal window script-->
        <script src="<?php print THEMEROOT?>/src/remodal/js/jquery.remodal.js"></script>

        <!-- Include the Sidr JS -->
        <script src="<?php print THEMEROOT?>/src/sidr/js/jquery.sidr.min.js"></script> 

        <!--Boulevard specific scripts-->
        <script src="<?php print THEMEROOT?>/src/js/Boulevard-Base.js"></script>
        
        <?php wp_footer(); ?>
    </body>
</html>
