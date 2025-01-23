<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

if(isset($_POST['submitButton'])){
    /*
    *   Upload the applicants Resume
    */
    $target_dir = THEMEROOTSTATIC . "/applicants/";
    $target_file = $target_dir . time() . basename($_FILES["applicantResume"]["name"]); //NOTE: The time() simply prepends a time stamp to the file name for uniquness
    $uploadOk = 1;
    $appFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $honeypotValue = $_POST["honeypot"];

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<p>Sorry, file already exists.<p>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($appFileType != "pdf" && $appFileType != "doc" && $appFileType != "docx") {
        echo "<p>An error has occured, please make sure to use only PDF, DOC, DOCX files for your resume.<p>";
        $uploadOk = 0;
    }

    if(move_uploaded_file($_FILES['applicantResume']['tmp_name'], $target_file) && uploadOK) {
        //"The file ".  basename( $_FILES['applicantResume']['name'])." has been uploaded successfuly";
        echo 1; //Successful upload
    } else{
        //There was an error uploading the file, please try again later!
        echo 0; //Unsuccessful upload
    }


    $name = $_POST['applicantName'];
    $email = $_POST['applicantE-mail'];
    $phone = $_POST['applicantPhoneNumber'];
    $message = $_POST['applicantMessage'];
    $career = $_POST['JobTitle'];
    $resume = THEMEROOT . '/applicants/' . basename($target_file).PHP_EOL;
    $position = $_POST['JobTitle'];

    /*
    * Insert applicant information into database
    */

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or exit('Error connecting to mysql database');
    $query = "INSERT INTO wp_blvdapplications(Status, Name, Email, Phone, Message, Date, Resume, Position) VALUES(0, '$name', '$email', '$phone', '$message', NOW(), '$resume', '$position')";
    mysqli_query($dbc, $query) or exit('Error querying database');
    mysqli_close($dbc);

    /*
    *   Send an email notification to blvd
    */

    $to = "info@creativeboulevard.com";
    $subject = "Job Application";

    $message = '<html><body>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['applicantName']) . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['applicantE-mail']) . "</td></tr>";
    $message .= "<tr><td><strong>phoneNumber:</strong> </td><td>" . strip_tags($_POST['applicantPhoneNumber']) . "</td></tr>";
    $message .= "<tr><td><strong>message:</strong> </td><td>" . strip_tags($_POST['applicantMessage']) . "</td></tr>";
    $message .= "<tr><td><strong>Application:</strong> </td><td> <a href='" . WPROOT . "/wp-admin/tools.php?page=blvd_data_management_settings&tab=CareerApplications" . "'";
    $message .= "> Click here to manage submitted applications </a> </td></tr>";
    $message .= "<tr style='background: #eee;'><td><strong>Career applied for:</strong> </td><td>" . strip_tags($_POST['JobTitle']) . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";

    // Always set content-type when sending HTML email
    $cleanText = strip_tags($_POST['applicantE-mail']);
    $cleanText = str_replace("&rsquo;","'", $cleanText);
    $cleanEmail = preg_replace("/&#?[a-z0-9]{2,8};/i","", $cleanText);

    $headers .= "From: " . $cleanEmail . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    /*if($honeypotValue == ""){*/
        //mail($to,$subject,$message,$headers);
        wp_mail($to, $subject, $message, $headers);
    /*}*/
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <style>
            .panel-name-header{color: <?php echo JoinUsGetPanelNameHeaderTextColor(); ?>;}
            .panel-main-header{color: <?php echo JoinUsGetMainHeaderTextColor(); ?>;}
            #careers-body p, #careers-body li{color: <?php echo JoinUsGetParagraphTextColor(); ?>;}
            #careers-body p b{color: <?php echo JoinUsGetParagraphSectionBoldHeaderTextColor(); ?>;}
            /*#sales-rep-career{color: <?php echo JoinUsGetJobListingHeaderTextColor(); ?>;} JOB LISTING NAME*/
            #careers-body input[type=text], #careers-body input[type=email], #careers-body input[type=tel], #careers-body textarea{
                height: <?php echo JoinUsGetTextInputHeight(); ?>px !important;
                border-radius: <?php echo JoinUsGetFormInputBorderRadius(); ?>px;
                background-color: <?php echo JoinUsGetFormInputBackgroundColor(); ?>;
                box-shadow: 0px 0px 0px transparent !important;
                transition: box-shadow 0.15s ease-in-out 0s !important;
            }

            #careers-body form input[type=text]:focus, #careers-body input[type=email]:focus, #careers-body input[type=tel]:focus, #careers-body textarea:focus{
                box-shadow: 0 0 5px <?php echo JoinUsGetFormInputBoxShadowColor(); ?> !important;
            }
            #careersMenu{
                <?php
                 if(JoinUsGetUseBgColorCheckbox()){
                    echo 'background-color: ' . JoinUsGetBackgroundColor() . ';';
                 }else{
                    echo 'background-image: url("' . JoinUsGetBackgroundImage() . '");';
                 }
                ?>
            }
            .click-toggle{
                transition: color 0.5s
            }
            .click-toggle:hover{
                color:#FAD000;
            }
        </style>
    </head>
    <body>
        <div id="careers-body" class="container-fluid">
                <div class="row">
                    <div class="col-xs-6">
                            <h3 class="panel-name-header">CAREERS</h3>
                    </div>
                    <div class="col-xs-6">
                        <div id="join-us-exitButton">
                            <h3> <a href="#" class="no-jump exit-sidr main-menu"> <img src="<?php echo GetGlobalSidePanelExitButton(); ?>" alt="exit"> </a> </h3>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <h1 class="panel-main-header">Work with us.</h1>
                        <p>Are you interested in joining us? We're always looking for highly-skilled emplyees with positive attitudes to become part of the team. See below for a list of current openings, and feel free to send us your resume.</p>
                        <?php
                            for($i = 1; $i <= intval(JoinUsGetNumberOfJobListings()); $i++){
                                /*$file = fopen(THEMEROOTSTATIC . '/CareerListing_' . $i . '.php', 'w') or exit('Unable to open | create file');*/
                                $file = file_get_contents(THEMEROOTSTATIC . '/CareerListing_' . $i . '.php');
                                echo $file;
                                /*for($j = 0; $j < sizeof($file); $j++){
                                    echo $file[$j];
                                }*/
                            }
                        ?>
                    </div>
                </div>
            </div>
        <!--jQuery color plugin-->
        <script src=" <?php echo THEMEROOT . '/src/js/jQueryColor.js' ?>"></script>

        <script>
            $(document).ready(function () {
                $('#join-us-exitButton').sidr({
                    name: 'careersMenu',
                    side: 'right',
                    openType: 'custom'
                });

                var salesCareerOpen = false;
                function On() {
                    //$('.urgent').animate({ color: "#FAD000" }, 1000, function () { Off(); });
                }
                function Off() {
                    //$('.urgent').animate({ color: "#FFFFFF" }, 1000, function () { On(); }).stop(false, false);
                }
                function AlternateColors() {
                    On();
                }
                AlternateColors();

                //Initially close all blurbs
                $(".toggle").hide();

                var thankyouElements = document.getElementsByClassName('thankyou');
                                    for(var i = 0; i < thankyouElements.length; i++){
                                        thankyouElements[i].setAttribute('style', 'display: block !important');
                                    }
                                    });

                //Toggle show/hide when clicked
                $(".click-toggle").click(function (event) {
                    /*$(".toggle").toggle("slow", function(){ //Finished });*/
                    $(this).parent().find("div").toggle("slow", function(){
                        //Finished
                    });
                    $(this).parent().find("div").find("form").find("div").toggle("slow", function(){
                        //Finished
                    });
                    $(this).parent().find("div").find(".thankyou").toggle("slow", function(){
                        //Finished
                    });

                });
        </script>
    </body>
</html>

