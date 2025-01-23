<?php
/*
Template Name: Team
*/

get_header('team');

?>

<body class="full-height">
     <!--Header nav bar-->
        <div id="header-nav">
            <a href="<?php echo GetTeamNavbarMastheadLinkDestination(); ?>"><img class="visible-xs visible-sm fl headerMasthead" src="<?php echo GetGlobalMobileMasthead(); ?>" alt="masthead"/></a>
            <a href="<?php echo GetTeamNavbarMastheadLinkDestination(); ?>"><img class="visible-md visible-lg fl headerMasthead" src="<?php echo GetTeamNavbarMasthead(); ?>" alt="masthead"/></a>
            <div id="navButtonFloat" class="fr button-extra-margin">
                <a id="headerMenuButton" href="#headerMenuButton"> <img src="<?php echo GetTeamNavbarMenuButton(); ?>" alt="Nav">  </a>
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
                        <a id="sideMenuButton" href="#sideMenu"> <img class="fr left-gutter" src="<?php echo GetTeamMenuButton(); ?>" alt="Open" /> </a>
                    </div>
                </div>
            </header>

        <!--</div>
        <div class="container-fluid full-height">-->
        <div class="row full-height">
            <div class="col-xs-12"> <!--full-height-->
                <div class="center-text absolute-vert-center">
                    <h1 class="blvd-text team-main-header">
                        We are not just good at our jobs.
                        <br/>
                        <br/>
                        We are also good people.
                    </h1>
                </div>
            </div>
        </div>
        <div class="row down-arrow" id="downArrowPos"> <div class="col-xs-12"> <a class="slide-down-arrow" onclick="MoveSlide();"> <img src="<?php echo GetOfficeDownArrow(); ?>" alt="DownArrow" /> </a> </div> </div>
        
        <div class="container-fluid team-content destinationSlide">

            <div id="slide2-headerdiv" class="row">
                <div class="col-xs-12"><h2 class="center-text h2-margin blvd-text-dark">MEET THE TEAM</h2></div>
            </div>

            <div class="row team-row">
                <?php
                    for($i = 0; $i < GetTeamNumberOfImageRows(); $i++){
                    $currRowCol = ($i * 3) + 1;
                        for($j = $currRowCol; $j < $currRowCol + 3; $j++){
                        $file = WPMEDIA . "/emp_" . $j . ".jpg";
                        $file_headers = @get_headers($file);
                        if($file_headers[0] == 'HTTP/1.1 404 Not Found' || $file_headers[0] == 'HTTP/1.0 404 Not Found'){
                        ?>
                            <div class="col-sm-6 col-md-4 team-member">
                                <a href="#empmodal_<?php echo $j?>"><img class="img-responsive" src="<?php echo WPMEDIA . '/NullImg.png'; ?>" alt="Head shot" /></a>
                                <a href="#empmodal_<?php echo $j?>"><h4 class="blvd-text-dark"><?php echo get_theme_mod('team_emplyoee_' . $j . 'name_control_setting'); ?></h4></a>
                                <p>
                                    <?php echo get_theme_mod('team_emplyoee_' . $j . 'position_control_setting'); ?>
                                    <br />
                                    <a href="mailto:<?php echo get_theme_mod('team_emplyoee_' . $j . 'email_control_setting'); ?>">
                                    <?php echo get_theme_mod('team_emplyoee_' . $j . 'email_control_setting'); ?></a>
                                </p>
                            </div>
                        <?php
                        }else{
                        ?>
                            <div class="col-sm-6 col-md-4 team-member">
                                <a href="#empmodal_<?php echo $j?>"><img class="img-responsive" src="<?php echo WPMEDIA . '/emp_' . $j . '.jpg' ?>" alt="Head shot" /></a>
                                <a href="#empmodal_<?php echo $j?>"><h4 class="blvd-text-dark"><?php echo get_theme_mod('team_emplyoee_' . $j . 'name_control_setting'); ?></h4></a>
                                <p>
                                    <?php echo get_theme_mod('team_emplyoee_' . $j . 'position_control_setting'); ?>
                                    <br />
                                    <a href="mailto:<?php echo get_theme_mod('team_emplyoee_' . $j . 'email_control_setting'); ?>">
                                    <?php echo get_theme_mod('team_emplyoee_' . $j . 'email_control_setting'); ?></a>
                                </p>
                            </div>
                        <?php
                            $htmlContent = "<!--The rest of the missing html here is filled in via javascript!--> \n" .
                            "<div class=\"row\">\n" .
                            "\t<div style=\"margin-top: 15px;\" class=\"col-xs-12 col-sm-6 col-md-6\">\n" .
                            "\t\t<div style=\"width: 100%;\">\n" .
                            "\t\t\t<img src=\"" . WPMEDIA . '/emp_' . $j . '.jpg' . "\" alt=\"image\" style=\"width: 100%; padding-right: 12px;\" />\n" .
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
                            "</div>\n" .
                            "<div class=\"row\">\n" .
                            "\t<div style=\"position:absolute; top:5px; right:5px; cursor:pointer;\">\n" .
                            "\t<a href='mailto:" . get_theme_mod('team_emplyoee_' . $j . 'email_control_setting') . "'><span class='glyphicon glyphicon-envelope mail-icon' aria-hidden='true'></span></a>\n" .
                            "\t<a href='PASTE DESTINATION HERE' target='_blank'><span class='fa fa-twitter modal-twitter'></span></a> <!--//TWITTER-->\n" .
                            "\t<a href='PASTE DESTINATION HERE' target='_blank'><span class='fa fa-instagram modal-instagram'></span></a> <!--//INSTAGRAM-->\n" .
                            "\t<a href='PASTE DESTINATION HERE' target='_blank'><span class='fa fa-linkedin modal-linkedin'></span></a> <!--//LINKEDIN-->\n" .
                            "\t<a href='PASTE DESTINATION HERE' target='_blank'><span class='fa fa-pinterest modal-pinterest'></span></a> <!--//PINTEREST-->\n" .
                            "</div>\n" .
                            "</div>\n";
                            $fileValue;
                            if($j < 10){
                                $fileValue = 0 . (string)$j;
                            }else{
                                $fileValue = $j;
                            }
                            if(!file_exists(THEMEROOTSTATIC . '/ModalEmpl_' . $fileValue . '.php') || GetAdvancedSettingTeamAllowModalTextSeeding()){
                                $file = fopen(THEMEROOTSTATIC . '/ModalEmpl_' . $fileValue . '.php', 'w') or exit('Unable to open | create file');
                                fwrite($file, $htmlContent);
                                fclose($file);

                                #DEBUG echo 'File created_' . $j . 'at:' . THEMEROOTSTATIC . '/ModalEmpl_' . $fileValue . '.php';
                            }
                            }
                        }
                    }
                ?>
                <!--<div class="col-sm-6 col-md-4 team-member">
                        <a href="#modalWinston"><img class="img-responsive" src="<?php print IMAGES?>/team/Winston.jpg" alt="Winston" /></a>
                        <h4 class="blvd-text-dark">Winston Lo</h4>
                        <a href="mailto:winstonlo@creativeboulevard.com"> <p>winstonlo@creativeboulevard.com<br/>Owner</p> </a>
                </div>
                <div class="col-sm-6 col-md-4 team-member">
                        <a href="#modalSandy"><img class="img-responsive" src="<?php print IMAGES?>/team/Sandy.jpg" alt="Sandy" /></a>
                        <h4 class="blvd-text-dark">Sandra Coley</h4>
                        <a href="mailto:sawentworth@creativeboulevard.com" > <p>sawentworth@creativeboulevard.com<br/>Production/HR Manager</p> </a>
                </div>
                
                <div class="col-sm-6 col-md-4 team-member">
                        <a href="#modalMercedes"><img class="img-responsive" src="<?php print IMAGES?>/team/Mercedes.jpg" alt="Mercedes" /></a>
                        <h4 class="blvd-text-dark">Mercedes Coley</h4>
                        <a href="mailto:mercedescoley@creativeboulevard.com" > <p>mercedescoley@creativeboulevard.com<br/>Administrative Assistant</p> </a>
                </div>

                <div class="col-sm-6 col-md-4 team-member">
                        <a href="#modalEvija"><img class="img-responsive" src="<?php print IMAGES?>/team/Evija.jpg" alt="Evija" /></a>
                        <h4 class="blvd-text-dark">Evija Feiste</h4>
                        <a href="mailto:evijafeiste@creativeboulevard.com" ><p>evijafeiste@creativeboulevard.com<br/>Corporate Sales Executive</p> </a>
                </div>

                <div class="col-sm-6 col-md-4 team-member">
                        <a href="#modalCandy"><img class="img-responsive" src="<?php print IMAGES?>/team/Candy.jpg" alt="Candy" /></a>
                        <h4 class="blvd-text-dark">Candy Chui</h4>
                        <a href="mailto:candyChui@creativeboulevard.com" > <p>candyChui@creativeboulevard.com<br/>Accounting</p> </a>
                </div>

                 <div class="col-sm-6 col-md-4 team-member">
                        <a href="#modalNick"><img class="img-responsive" src="<?php print IMAGES?>/team/Nick.jpg" alt="Nick" /></a>
                        <h4 class="blvd-text-dark">Nick Harris</h4>
                        <a href="mailto:nickharris@creativeboulevard.com" > <p>nickharris@creativeboulevard.com<br/>Account Managaer</p> </a>
                </div>-->
            </div>

            <!--
            <div class="row team-row">  </div>
            <div class="row team-row">  </div>
            -->

            <div class="row tour-join">
                <div class="col-md-6">
                    <a href="<?php echo GetTeamBlvdOfficePage(); ?>">
                        <h2 class="workspace-overlay-text blvd-text our-workspace">Our workspace</h2>
                         <img class="img-responsive" src="<?php echo GetTeamWorkspaceImage(); ?>"  alt="tour"/> 
                    </a>
                </div>
                <div class="col-md-6">
                    <a id="join-team-link" href="#join-team-link"> 
                        <h2 class="join-overlay-text blvd-text join-us">Join the team</h2>
                        <img class="img-responsive" src="<?php echo GetTeamJoinTeamImage(); ?>" alt="join"/> 
                    </a>
                </div>
            </div>
        </div>

<?php get_footer('team');?>
