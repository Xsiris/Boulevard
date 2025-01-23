<!--Remodal html-->
            <?php
            for($i = 0; $i < GetWorkNumberOfProjectImages(); $i++){
                for($j = ($i * 5) + 1; $j < ((($i * 5) +1) + 5); $j++){
                $fileValue;
                if($j < 10){
                    $fileValue = 0 . (string)$j;
                }else{
                    $fileValue = $j;
                }
                ?>
                    <div class="remodal" data-remodal-id="modal<?php echo $j ?>" data-remodal-options="externalSheet: <?php echo WPTHEMEROOT . '/' . 'ModalProj_' . $fileValue ?>.php, image: <?php echo WPMEDIASTATIC . '/' . $j?>.jpg"></div>
                <?php
                }
            }
            ?>
            <!--First row -->
            <!--<div class="remodal" data-remodal-id="modal1" data-remodal-options="externalSheet: <?php echo WPTHEMEROOT?>/ModalProj_1.php, image: <?php echo WPMEDIASTATIC?>1.jpg"></div>
            <div class="remodal" data-remodal-id="modal2" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/2.jpg"></div>
            <div class="remodal" data-remodal-id="modal3" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/3.jpg"></div>
            <div class="remodal" data-remodal-id="modal4" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/4.jpg"></div>
            <div class="remodal" data-remodal-id="modal5" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/5.jpg"></div>-->
            
            <!--Second row-->
            <!--<div class="remodal" data-remodal-id="modal6" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/6.jpg"></div>
            <div class="remodal" data-remodal-id="modal7" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/7.jpg"></div>
            <div class="remodal" data-remodal-id="modal8" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/8.jpg"></div>
            <div class="remodal" data-remodal-id="modal9" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/9.jpg"></div>
            <div class="remodal" data-remodal-id="modal10" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/10.jpg"></div>-->
            
            <!--Third row-->
            <!--<div class="remodal" data-remodal-id="modal1" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/11.jpg"></div>
            <div class="remodal" data-remodal-id="modal12" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/12.jpg"></div>
            <div class="remodal" data-remodal-id="modal13" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/13.jpg"></div>
            <div class="remodal" data-remodal-id="modal14" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/14.jpg"></div>
            <div class="remodal" data-remodal-id="modal15" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/15.jpg"></div>-->
            
            <!--Fourth row-->
            <!--<div class="remodal" data-remodal-id="modal6" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/17.jpg"></div>
            <div class="remodal" data-remodal-id="modal17" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/18.jpg"></div>
            <div class="remodal" data-remodal-id="modal18" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/19.jpg"></div>
            <div class="remodal" data-remodal-id="modal19" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/20.jpg"></div>
            <div class="remodal" data-remodal-id="modal20" data-remodal-options="externalSheet: <?php echo WPMODALSTATIC?>/ProjectTest.html, image: <?php echo WPMEDIASTATIC?>/21.jpg"></div>-->

        <!--Ajax-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <!--Include and use Backstretch -->
        <script src="<?php print THEMEROOT?>/src/backstretch/jquery.backstretch.min.js"></script>

        <!-- Include the Sidr JS -->
        <script src="<?php print THEMEROOT?>/src/sidr/js/jquery.sidr.min.js"></script> 

        <!--Remodal window script-->
        <script src="<?php print THEMEROOT?>/src/remodal/js/jquery.remodal.js"></script>

        <!--Boulevard specific scripts-->
        <script src="<?php print THEMEROOT?>/src/js/Boulevard-Base.js"></script>

        <script>
            <?php
                $images = array();
                if(!intval(get_theme_mod('work_bgimages_control_setting')) <= 0){
                    for($i = 1; $i <= intval(get_theme_mod('work_bgimages_control_setting')); $i++){
                    if(strlen(get_theme_mod('work_backstretch_img_' . $i)) != 0){
                        array_push($images, get_theme_mod('work_backstretch_img_' . $i));
                    }
                    switch($i){
                        case 1:
                        //if(strlen($images[$i]) == 0){array_push($images, '' . WPMEDIA . '/bg-3.jpg');}
                        break;
                        case 2:
                        //if(strlen($images[$i]) == 0){array_push($images, '' . WPMEDIA . '/bg-4.jpg');}
                        break;
                        default:
                        break;
                        }
                    }
                }else{
                    array_push($images, WPMEDIA . '/bg-3.jpg');
                    array_push($images, WPMEDIA . '/bg-4.jpg');
                }
            ?>

            $(".bs-background").backstretch([<?php for($i = 0; $i < count($images); $i++){if(strlen($images[$i]) > 0){echo $i == (count($images) - 1) ?  "'$images[$i]'" : "'$images[$i]', ";}}?>], { duration: <?php echo GetWorkBackstretchDuration(); ?>, fade: <?php echo GetWorkBackstretchFade(); ?>});
            $(".partner-withus").backstretch(['<?php echo strlen(get_theme_mod('work_footer_bgimg_control_setting')) == 0 ? WPMEDIA . '/PartnerWithUs.jpg' : get_theme_mod('work_footer_bgimg_control_setting'); ?>'], { /*duration: 4000, fade: 750*/ });
        </script>
        
        <?php wp_footer(); ?>
    </body>
</html>

