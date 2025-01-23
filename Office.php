<?php
/*
Template Name: Office
*/

get_header('office');
?>


<body class="full-height">
        <!--Header nav bar-->
        <div id="header-nav">
            <a href="<?php echo GetOfficeNavbarMastheadLink(); ?>"><img class="visible-xs visible-sm fl headerMasthead" src="<?php echo GetGlobalMobileMasthead(); ?>" alt="masthead"/></a>
            <a href="<?php echo GetOfficeNavbarMastheadLink(); ?>"><img class="visible-md visible-lg fl headerMasthead" src="<?php echo GetOfficeNavbarMasthead(); ?>" alt="masthead"/></a>
            <div id="navButtonFloat" class="fr button-extra-margin">
                <a id="headerMenuButton" href="#headerMenuButton"> <img src="<?php echo GetOfficeNavbarMenu(); ?>" alt="Nav">  </a>
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

        <div id="header" class="container-fluid full-height">
            <div class="slide-fade-effect"></div>
            <header>
                <div class="row">
                    <div class="col-xs-6">
                        <!-- <img class="img-responsive" src="src/images/BLVDMasthead.png" alt="Boulevard" /> -->
                    </div>
                    <div class="col-xs-6 top-right-nav">
                        <a id="sideMenuButton" href="#sideMenu"> <img class="fr left-gutter" src="<?php echo GetOfficeMenuButton(); ?>" alt="Open" /> </a>
                    </div>
                </div>
            </header>
            <div class="row full-height">
                <div class="col-xs-12"> <!--full-height-->
                    <h1 class="center-text absolute-vert-center blvd-text office-main-heading">You must do what you love</h1>
                </div>
            </div>
            <div class="row down-arrow" id="downArrowPos"> <div class="col-xs-12"> <a class="slide-down-arrow" onclick="MoveSlide();"> <img src="<?php echo GetOfficeDownArrow(); ?>" alt="DownArrow" /> </a> </div> </div>
        </div>

        <div class="container-fluid img-slide-height full-height destinationSlide">
            <div class="row" style="background-image: url('<?php echo GetOfficeImage1(); ?>'); background-position: 0 0; background-size: 100% 100%;">
                <div class="col-xs-12"> <!--<img src="#" alt="Image" />--> </div>
            </div>
            <div class="row" style="background-image: url('<?php echo GetOfficeImage2(); ?>'); background-position: 0 0; background-size: 100% 100%;">
                <div class="col-xs-12"> <!--<img src="#" alt="Image" />--> </div>
            </div>
            <div class="row" style="background-image: url('<?php echo GetOfficeImage3(); ?>'); background-position: 0 0; background-size: 100% 100%;">
                <div class="col-xs-12"> <!--<img src="#" alt="Image" />--> </div>
            </div>
            <div class="row" style="background-image: url('<?php echo GetOfficeImage4(); ?>'); background-position: 0 0; background-size: 100% 100%;">
                <div class="col-xs-12"> <!--<img src="#" alt="Image" />--> </div>
            </div>
            <div class="row" style="background-image: url('<?php echo GetOfficeImage5(); ?>'); background-position: 0 0; background-size: 100% 100%;">
                <div class="col-xs-12"> <!--<img src="#" alt="Image" />--> </div>
            </div>
            <div class="row" style="background-image: url('<?php echo GetOfficeImage6(); ?>'); background-position: 0 0; background-size: 100% 100%;">
                <div class="col-xs-12"> <!--<img src="#" alt="Image" />--> </div>
            </div>
            <div class="row" style="background-image: url('<?php echo GetOfficeImage7(); ?>'); background-position: 0 0; background-size: 100% 100%;">
                <div class="col-xs-12"> <!--<img src="#" alt="Image" />--> </div>
            </div>

<?php get_footer('office');?>