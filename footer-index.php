<!-- END SIDR NAVIGATION SIDR BAR -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!--jQuery Mobile-->
        <!--<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <!--Include and use Backstretch -->
        <script src="<?php print THEMEROOT?>/src/backstretch/jquery.backstretch.min.js"></script>
        <script>
                //Request Button
                function RequestProjectLinkOver () {
                        var img = this.getElementsByTagName("img")[0]; // Get child img element of the object that triggered the event (using the 'this' keyword)
                        img.setAttribute("src", "<?php echo strlen(get_theme_mod('request_hover_menubtn_control_setting')) == 0 ? WPMEDIA . '/ArrowGlyphWhite.png' : get_theme_mod('request_hover_menubtn_control_setting'); ?>");
                };
                function RequestProjectLinkOut () {
                        var img = this.getElementsByTagName("img")[0]; // Get child img element of the object that triggered the event (using the 'this' keyword)
                        img.setAttribute("src", "<?php echo strlen(get_theme_mod('request_menubtn_control_setting')) == 0 ? WPMEDIA . '/ArrowGlyph.png' : get_theme_mod('request_menubtn_control_setting'); ?>");
                };

                //Left most link
                function LeftMostLinkOver () {
                        var img = this.getElementsByTagName("img")[0]; // Get child img element of the object that triggered the event (using the 'this' keyword)
                        img.setAttribute("src", "<?php echo strlen(get_theme_mod('leftmost_hover_menubtn_control_setting')) == 0 ? WPMEDIA . '/ArrowGlyphWhite.png' : get_theme_mod('leftmost_hover_menubtn_control_setting'); ?>");
                };
                function LeftMostLinkOut () {
                        var img = this.getElementsByTagName("img")[0]; // Get child img element of the object that triggered the event (using the 'this' keyword)
                        img.setAttribute("src", "<?php echo strlen(get_theme_mod('leftmost_menubtn_control_setting')) == 0 ? WPMEDIA . '/ArrowGlyph.png' : get_theme_mod('leftmost_menubtn_control_setting'); ?>");
                };

                //Right most link
                function RightMostLinkOver () {
                        var img = this.getElementsByTagName("img")[0]; // Get child img element of the object that triggered the event (using the 'this' keyword)
                        img.setAttribute("src", "<?php echo strlen(get_theme_mod('rightmost_hover_menubtn_control_setting')) == 0 ? WPMEDIA . '/ArrowGlyphWhite.png' : get_theme_mod('rightmost_hover_menubtn_control_setting'); ?>");
                };
                function RightMostLinkOut () {
                        var img = this.getElementsByTagName("img")[0]; // Get child img element of the object that triggered the event (using the 'this' keyword)
                        img.setAttribute("src", "<?php echo strlen(get_theme_mod('rightmost_menubtn_control_setting')) == 0 ? WPMEDIA . '/ArrowGlyph.png' : get_theme_mod('rightmost_menubtn_control_setting'); ?>");
                };
                /*
                *       Assign onover and onout event handlers and invoke onout events on each to display the correct image on initial page load
                */
                var requestProjLink = document.getElementById('request-proj-menu');
                var leftMostLink = document.getElementById('see-work-icon');
                var rightMostLink = document.getElementById('about-btn');
                requestProjLink.onmouseover = RequestProjectLinkOver;
                requestProjLink.onmouseout = RequestProjectLinkOut;
                requestProjLink.onmouseout.apply(requestProjLink);
                leftMostLink.onmouseover = LeftMostLinkOver;
                leftMostLink.onmouseout = LeftMostLinkOut;
                leftMostLink.onmouseout.apply(leftMostLink);
                rightMostLink.onmouseover = RightMostLinkOver;
                rightMostLink.onmouseout = RightMostLinkOut;
                rightMostLink.onmouseout.apply(rightMostLink);
                <?php
                        $images = array();
                        if(!intval(get_theme_mod('number_bgimages_control_setting') <= 0)){
                                for($i = 1; $i <= intval(get_theme_mod('number_bgimages_control_setting')); $i++){
                                if(strlen(get_theme_mod('backstretch_img_' . $i)) != 0){
                                        array_push($images, get_theme_mod('backstretch_img_' . $i));
                                }
                                        switch($i){
                                                case 1:
                                                //if(strlen($images[$i]) == 0){array_push($images, '' . WPMEDIA . '/bg-1.jpg');}
                                                break;
                                                case 2:
                                                //if(strlen($images[$i]) == 0){array_push($images, '' . WPMEDIA . '/bg-2.jpg');}
                                                break;
                                                default:
                                                break;
                                        }
                                }
                        }else{
                                array_push($images, WPMEDIA . '/bg-1.jpg');
                                array_push($images, WPMEDIA . '/bg-2.jpg');
                        }
                ?>
                //$(".wrapper").backstretch(["<?php print IMAGES?>/background/bg-1.jpg", "<?php print IMAGES?>/background/bg-2.jpg"], { duration: 4000, fade: 750 }); /* duration: 4000 | fade: 750 */
                $(".wrapper").backstretch([<?php for($i = 0; $i < count($images); $i++){if(strlen($images[$i]) > 0){echo $i == (count($images) - 1) ?  "'$images[$i]'" : "'$images[$i]', ";}}?>], { duration: <?php echo GetIndexBackstretchDuration(); ?>, fade: <?php echo GetIndexBackstretchFade(); ?> });
        </script>

        <!-- Include the Sidr JS -->
        <script src="<?php print THEMEROOT?>/src/sidr/js/jquery.sidr.min.js"></script>
        
        <!--Boulevard specific scripts-->
        <script src="<?php print THEMEROOT?>/src/js/Boulevard-Base.js"></script> 

        <?php wp_footer(); ?>
    </body>
</html>