<?php
/*
Template Name: Contact
*/

require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

if($_POST['submit']){

    $name = $_POST['name'];
    $email = $_POST['e-mail'];
    $phone = $_POST['phoneNumber'];
    $message = $_POST['message'];
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or exit('Error connecting to mysql database');
    $query = "INSERT INTO wp_blvdgeneraldata(Status, Name, Email, Phone, Message, Date) VALUES(0, '$name', '$email', '$phone', '$message', NOW())";
    mysqli_query($dbc, $query) or exit('Error querying database');
    mysqli_close($dbc);

    $to = 'info@creativeboulevard.com';
    $subject = 'General Inquiry';

    $message = '<html><body>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['e-mail']) . "</td></tr>";
    $message .= "<tr><td><strong>Organization:</strong> </td><td>" . strip_tags($_POST['phoneNumber']) . "</td></tr>";
    $message .= "<tr><td><strong>Phone number:</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
    $message .= "</body></html>";

    $cleanText = strip_tags($_POST['e-mail']);
    $cleanText = str_replace("&rsquo;","'", $cleanText);
    $cleanEmail = preg_replace("/&#?[a-z0-9]{2,8};/i","", $cleanText);

    $headers .= "From: " . $cleanEmail . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    //Always set content type (and header in general) when sending emails
    wp_mail($to, $subject, $message, $headers);
}

get_header('contact');

?>

<div id="header" class="container-fluid full-height">
    <div class="slide-fade-effect"></div>
            <header>
                <div class="row">
                    <div class="col-xs-6">
                        <!-- <img class="img-responsive" src="src/images/BLVDMasthead.png" alt="Boulevard" /> -->
                    </div>
                    <div class="col-xs-6 top-right-nav">
                        <a id="sideMenuButton" href="#sideMenu"> <img class="fr left-gutter" src="<?php echo GetContactFirstSlideMenuButton(); ?>" alt="Open" /> </a>
                    </div>
                </div>
            </header>
    <div class="center-text absolute-vert-center">
            <h1 class="blvd-text team-main-header" style="text-align:left;">
            Talk to us
            <br>
            <br>
            Whether your interested in being a new client,
            <br>
            or just a friend, we'd love to hear from you
            <br>
            <br>
            Please contact us anytime using the form below
            </h1>
        </div>
        </div>
        <div id="downArrowPos" class="row down-arrow">
                    <div class="col-xs-12">
                        <a onclick="MoveSlide();" class="slide-down-arrow">
                            <img alt="DownArrow" src="<?php echo GetOfficeDownArrow(); ?>">
                        </a>
                    </div>
                </div>

        <div class="container contact-content destinationSlide">
            <div class="row contact-form-margin">
                <div class="col-md-6 contact-us">
                    <h4 id="contact" class="contact-h4">CONTACT</h4>
                    <p class="contact-p">BOULEVARD Advertising<br/>
                    188-11860 Hammersmith Way<br/>
                    Richmond BC, V7A 5G1 </p>      
                    <p class="contact-p"><span class="contact-hightlight">Give us a call:</span> 604-277-5886</p>
                    <p class="contact-p">info@creativeboulevard.com</p>
                    <h4 id="follow-us" class="contact-h4">FOLLOW US</h4>
                    <div id="iconContainer">
                        <ul id="socialIcons" class="ul-no-margin-top">
                            <li class="facebook no-margin-left"> <a href="https://www.facebook.com/creativeboulevard" target="_blank"> Like </a> </li>
                            <li class="twitter"> <a href="https://twitter.com/BoulevardAd" target="_blank"> F </a> </li>
                            <li class="pinterest"> <a href="http://www.pinterest.com/boulevardad/" target="_blank"> P </a> </li>
                            <li class="instagram"> <a href="http://instagram.com/creativeboulevard" target="_blank"> I </a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 id="send-use-a-message" class="contact-h4">SEND US A MESSAGE <span>*Required</span></h4>
                    <div id="contact-thankyou"></div>
                    <form role="form" method="post" action="Test.php" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group">
                            <input id="contact-name" type="text" class="form-control" id="name" placeholder="Your name*" name="name">
                        </div>
                        <div class="form-group">
                            <input id="contact-email" type="email" class="form-control" id="e-mail" placeholder="Your e-mail*" name="e-mail">
                        </div>
                        <div class="form-group">
                            <input id="contact-phone" type="tel" class="form-control" id="phoneNumber" placeholder="phone number*" name="phoneNumber">
                        </div>
                        <div class="form-group">
                            <textarea id="contact-message" placeholder="Your message" name="message"></textarea>
                        </div>
                        <div id="contactSubmitButtonDiv" onclick="SendContactMessage();">
                            <!--<button id="contactSubmitButton" type="submit" name="submitButton"></button>
                            <span id="contactImageBottom"></span>-->
                            <span id="submit-top-image" style="position:absolute; width:175px; height:54px; background-image:url('<?php echo GetContactSubmitButtonImage(); ?>'); background-position:0 0; z-index:1;"></span>
                            <span style="position:absolute; width:175px; height:54px; background-image:url('<?php echo GetContactSubmitButtonImage(); ?>'); background-position:0 54px; z-index:0;"></span>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

        <div class="container-fluid maps-height-md">
            <div class="row full-height">
                <div class="col-xs-12 full-height">
                    <div id="googleMaps" class="full-height">
                        <iframe width="100%" height="100%" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBUfoVqqM8kI9xryZd1vxDXSgO7lAu3IHE&q=Boulevard+advertising+Hammersmith+Way"></iframe>
                    </div>
		        </div>
            </div>
        </div>

<?php get_footer('contact');?>
