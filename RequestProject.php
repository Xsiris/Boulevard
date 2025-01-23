<?php
require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

if($_POST['submit']){
    $to = "info@creativeboulevard.com";
    $subject = "Project Request";
    $selectedProjects  = 'None';

    $services = $_POST['services'];
    $cleanServicesArray = array();
    if(isset($services) && is_array($services) && count($services) > 0){
        for($i = 0; $i < sizeof($services); $i++){
            if(empty($services[$i])){
                continue;
            }else{
                array_push($cleanServicesArray, $services[$i]);
            }
        }
        $selectedProjects = implode(', ', $cleanServicesArray);
    }

    $name = $_POST['name'];
    $email = $_POST['e-mail'];
    $phone = $_POST['phoneNumber'];
    $message = $_POST['message'];
    $organization = $_POST['organization'];
    $phone = $_POST['phoneNumber'];
    $url = $_POST['url'];
    $objective = $_POST['objective'];
    $budget = $_POST['budget'];
    $timeline = $_POST['timeline'];

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or exit('Error connecting to mysql database');
    $query = "INSERT INTO wp_blvdrequestdata(Status, Name, Email, Phone, Organization, url, Services, Date, Objective, Budget, Timeline) VALUES(0, '$name', '$email', '$phone', '$organization', '$url', '$selectedProjects', NOW(), '$objective', '$budget','$timeline')";
    mysqli_query($dbc, $query) or exit('Error querying database');
    mysqli_close($dbc);

    $message = '<html><body>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['e-mail']) . "</td></tr>";
    $message .= "<tr><td><strong>Organization:</strong> </td><td>" . strip_tags($_POST['organization']) . "</td></tr>";
    $message .= "<tr><td><strong>Phone number:</strong> </td><td>" . strip_tags($_POST['phoneNumber']) . "</td></tr>";
    $message .= "<tr><td><strong>Url:</strong> </td><td>" . strip_tags($_POST['url']) . "</td></tr>";
    $message .= "<tr><td><strong>Requested service(s):</strong> </td><td>" . $selectedProjects;
    $message .=  "</td></tr>";
    $message .= "<tr><td><strong>Marketing Objective:</strong> </td><td>" . strip_tags($_POST['objective']) . "</td></tr>";
    $message .= "<tr><td><strong>Budeget:</strong> </td><td>" . strip_tags($_POST['budget']) . "</td></tr>";
    $message .= "<tr><td><strong>Timeline:</strong> </td><td>" . strip_tags($_POST['timeline']) . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";

    // Always set content-type when sending HTML email
    $cleanText = strip_tags($_POST['e-mail']);
    $cleanText = str_replace("&rsquo;","'", $cleanText);
    $cleanEmail = preg_replace("/&#?[a-z0-9]{2,8};/i","", $cleanText);

    $headers .= "From: " . $cleanEmail . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    //mail($to, $subject, $message, $headers);
    wp_mail($to, $subject, $message, $headers);
}

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <style>
        #requestMenu{
            <?php
            if(GetRequestUseBackgroundColorCheckbox()){
                echo 'background-color: ' . GetRequestBackgroundColor() . ';';
            }else{
                echo 'background-image: url("' . GetRequestBackgroundImage() . '");';
            }
            ?>
        }
        .request-main-header{color: <?php echo GetRequestMainHeaderTextColor(); ?>;}
        .request-panel-name-header{color: <?php echo GetRequestPanelNameHeaderTextColor(); ?>;}
        #request-project-body input[type=text], #request-project-body input[type=email], #request-project-body input[type=tel], #request-project-body input[type=url], #request-project-body select, #request-project-body textarea{
            height: <?php echo GetRequestTextInputHeight(); ?>px !important;
            border-radius: <?php echo GetRequestTextInputBorderRadius(); ?>px;
            background-color: <?php echo GetRequestTextInputBackgroundColor(); ?>;
            box-shadow: 0px 0px 0px transparent !important;
            transition: box-shadow 0.15s ease-in-out 0s !important;
        }

        #request-project-body input[type=text]:focus, #request-project-body input[type=email]:focus, #request-project-body input[type=tel]:focus, #request-project-body input[type=url]:focus, #request-project-body select:focus, #request-project-body textarea:focus{
            box-shadow: 0 0 5px <?php echo GetRequestTextInputBoxShadowColor(); ?> !important;
        }
        #request-project-body p{color: <?php echo GetRequestParagraphTextColor(); ?>;}
        #request-project-body label{color: <?php echo GetRequestParagraphTextColor(); ?>;}

    </style>
    <body>
        <div id="request-project-body" class="container-fluid">
                <div class="row">
                    <div class="col-xs-6">
                        <h3 class="request-panel-name-header">Request a project</h3>
                    </div>
                    <div class="col-xs-6">
                        <div id="request-exitButton">
                            <h3> <a href="#" class="no-jump exit-sidr main-menu"> <img src="<?php echo GetGlobalSidePanelExitButton(); ?>" alt="exit"></a> </h3>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <h1 class="request-main-header">Partner with us.</h1>
                        <p>Do you have a project we can help you with? We're happy to provide a consultant at your convenience.<br/> Simply fill out the form below, and we'll be in touch as soon as possible</p>
                        <p>*Required</p>
                        <div id="request-thankyou"></div>
                    </div>
                </div>
                <form method="post" action="RequestProject.php" enctype="multipart/form-data" autocomplete="off"> 
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6">
                                <input id="request-name" type="text" class="form-control" placeholder="Name*"  name="name"/>
                            </div>
                            <div class="col-md-6">
                                <input id="request-organization" type="text" class="form-control" placeholder="Organization*" name="organization"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <input id="request-email" type="email" class="form-control" placeholder="e-mail*" name="e-mail"/>
                            </div>
                            <div class="col-md-6">
                                <input id="request-phone" type="tel" class="form-control" placeholder="Phone number *" name="phoneNumber"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="request-url" type="url" class="form-control" placeholder="URL" name="url"/>
                            </div>
                        </div>
                    
                        <p>What services are you interested in?</p>

                        <div>
                            <label class="checkbox-inline">
                               <input type="checkbox" id="empRec" value="Employee Recognition" onchange="ShowCheck(this);" name="services[]"/> Employee Recognition
                            </label>
                            
                            
                            <label class="checkbox-inline">
                                <input type="checkbox" id="golfTourn" value="Golf Tournament" onchange="ShowCheck(this);" name="services[]"/> Golf Tournament
                            </label>
                        </div>

                        <div>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="staffUni" value="Staff Uniforms" onchange="ShowCheck(this);" name="services[]"/> Staff Uniforms
                            </label>

                            <label class="checkbox-inline">
                                <input type="checkbox" id="holEvent" value="holiday Event" onchange="ShowCheck(this);" name="services[]"/> holiday Event
                            </label>
                        </div>

                        <div>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="tradeGive" value="Tradeshow Giveaways" onchange="ShowCheck(this);" name="services[]"/> Tradeshow Giveaways
                            </label>

                            <label class="checkbox-inline">
                                <input type="checkbox" id="recruit" value="Recruitment" onchange="ShowCheck(this);" name="services[]"/> Recruitment
                            </label>
                        </div>

                        <div>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="eventProg" value="Event Program" onchange="ShowCheck(this);" name="services[]"/> Event Program
                            </label>

                            <label class="checkbox-inline">
                                <input type="checkbox" id="wellPromo" value="Wellness Promotion" onchange="ShowCheck(this);" name="services[]"/> Wellness Promotion
                            </label>
                        </div>

                        <div>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="safeProg" value="Safety Program" onchange="ShowCheck(this);" name="services[]"/> Safety Program
                            </label>

                            <label class="checkbox-inline">
                                <input type="checkbox" id="teamBuild" value="Team Buidling" onchange="ShowCheck(this);" name="services[]"/> Team Buidling
                            </label>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea id="request-objective-msg" class="form-control" rows="3" placeholder="What is your marketing objective?" name="objective"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <p>What is your project's budget?</p>
                                <select id="request-budget" class="form-control" name="budget">
                                    <option>1,000 - 3,000</option>
                                    <option>3,000 - 10,000</option>
                                    <option>12,000 - 20,000</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <p>What is your project's timeline?</p>
                                <select id="request-timeline" class="form-control" name="timeline">
                                    <option>I need it now!</option>
                                    <option>2 weeks</option>
                                    <option>3-4 weeks</option>
                                    <option>3 months</option>
                                    <option>No rush</option>
                                </select>
                            </div>
                        </div>
                        <div id="request-thankyou-bottom"></div>
                        <div id="SubmitButtonDiv" onclick="SendProjectRequest();">
                            <!--<button id="submitButton" type="submit" name="submitButton"></button>
                            <span id="imageBottom"></span>-->
                            <span id="submit-top" style="background-image: url('<?php echo GetRequestSubmitButtonImage(); ?>')"></span>
                            <span id="submit-bottom" style="background-image: url('<?php echo GetRequestSubmitButtonImage(); ?>')"></span>
                        </div>
                        <p class="extraMargin"></p>
                    </div>
                    </form>
            </div>
        <script>
            $(document).ready(function () {
                $('#request-exitButton').sidr({
                    name: 'requestMenu',
                    side: 'right',
                    openType: 'custom'
                });
            });

            function ShowCheck(object) {
                if (object.checked) {
                    var label = object.parentNode;
                    $(label).css("background-position", "0px -48px");
                }
                else {
                    var label = object.parentNode;
                    $(label).css("background-position", "0px 0px");
                }
            }
        </script>
    </body>
</html>
