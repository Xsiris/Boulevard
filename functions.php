<?php
    /*
    * Define Constants
    */
    ini_set("auto_detect_line_endings", true);
    define('THEMEROOT', get_stylesheet_directory_uri()); //Root directory
    define('THEMEROOTSTATIC', $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/Boulevard');
    define('WPTHEMEROOT', '/wp-content/themes/Boulevard');
    define('IMAGES', THEMEROOT . '/src/images');
    define('WPMEDIA', get_site_url() . '/wp-content/uploads'); // localhost:893?
    define('WPMEDIASTATIC', '/wp-content/uploads');
    define('WPMODAL', get_site_url() . '/modalhtml');
    define('WPMODALSTATIC', '/modalhtml');
    define('WPROOT', get_site_url());

    /*
    *   Database connection constants
    */

    /*Local host database credentials*/
    /*define('DB_HOST', '127.0.0.1');
    define('DB_USER' , 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'wp');*/

    /*Prelaunch.ninja database credentials*/
    // define('DB_HOST', '127.0.0.1');
    // define('DB_USER' , 'prelcftv_wp');
    // define('DB_PASSWORD', 'LoveBlvd1');
    // define('DB_NAME', 'prelcftv_wp');

    /*Path to media uploads*/
    //$uploads = wp_upload_dir();
    //define('UPLOADS', get_site_url() . '/wp-content/uploads');
    
    add_theme_support( 'post-thumbnails' );

    /**
     * Filter the except length to 20 characters.
     *
     * @param int $length Excerpt length.
     * @return int (Maybe) modified excerpt length.
     */
    function wpdocs_custom_excerpt_length( $length ) {
        return 20;
    }
    add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

    /*
    * Google analytics
    */
    add_action("wp_footer", "add_googleanalytics");
    function add_googleanalytics(){
        ?> UA-81500622-1 <?php
    }

    /*
    *Register menus
    */

    function register_my_menus()
    {
        register_nav_menus(array(
            'side-menu-pt-1' => __('Side Menu',  'boulevard-framework'),
            'side-menu-pt-2' => __('Side Menu Two',  'boulevard-framework'),
            'side-menu-pt-3' => __('Side Menu Three',  'boulevard-framework')
        ));
    }
    add_action('init', 'register_my_menus');

    /**
    *   Creates BLVD Data Management in the tools menu
    */
    function BoulevardThemeMenu(){
          add_management_page(
            'BLVD Data Management',
            'BLVD Data Management',
            'administrator',
            'blvd_data_management_settings',
            'BlvdDataManagementDisplay'
          );
    }

    function ConvertToTextOption($intVal){
        switch($intVal){
            case 0:
            return 'Todo';
            break;
            case 1:
            return 'In Progress';
            break;
            case 2:
            return 'Complete';
            break;
        }
    }

    function ConvertToColor($intVal){
        switch($intVal){
        case 0:
        return '#DBDBDB';
        break;
        case 1:
        return '#FFEE4C';
        break;
        case 2:
        return '#3CD62E';
        break;
        }
    }

    add_action('admin_menu', 'BoulevardThemeMenu');

    /**
    *   Renders the above menu page
    */
    function BlvdDataManagementDisplay(){ ?>
        <div class="wrap">
        <style>
            .th-border{
                border-left: 1px solid black;
                border-bottom: 1px solid black;
            }

            .th-border-right{
                border-right: 1px solid black;
            }

            td{
                text-align:center;
            }

            .left-text{
                text-align:left;
            }

            .scroll-x{
                overflow-x:scroll;

            }

            .full-width-height{
                position:absolute;
                height:75vh;
                width:99%;
            }

            .extra-width{
                width:125%;
            }

            .max-width{
                width:175%;
            }

            form{
                position:fixed;
                bottom: 5%
            }

            .no-display{
                display:none;
            }

            .deleteAnchor:hover{
                cursor:pointer;
            }

            table{
                border-spacing: 0px;
            }

            .no-entries{
                margin-top:5%;
                text-align:center;
            }
        </style>
            <?php
                $active_tab;
                if(isset($_GET['tab'])){
                    $active_tab = $_GET['tab'];
                }
                switch($active_tab){
                    case 'GeneralInquiries':
                        break;
                    case 'ProjectRequests':
                        break;
                    case 'CareerApplications':
                        break;
                    default:
                        $active_tab = 'GeneralInquiries';
                        break;
                }
            ?>
            <h2 class="nav-tab-wrapper">
                <a href="tools.php?page=blvd_data_management_settings&tab=GeneralInquiries" class="nav-tab <?php echo $active_tab == 'GeneralInquiries' ? 'nav-tab-active' : '' ?>">General Inquiries</a>
                <a href="tools.php?page=blvd_data_management_settings&tab=ProjectRequests" class="nav-tab <?php echo $active_tab == 'ProjectRequests' ? 'nav-tab-active' : '' ?>">Project Requests</a>
                <a href="tools.php?page=blvd_data_management_settings&tab=CareerApplications" class="nav-tab <?php echo $active_tab == 'CareerApplications' ? 'nav-tab-active' : '' ?>">Career Applications</a>
            </h2>
            <?php if($active_tab == "GeneralInquiries"){
                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or exit('Error connecting to mysql database');
                $query = "SELECT * FROM wp_blvdgeneraldata ORDER BY Date DESC";
                $data = mysqli_query($dbc, $query) or exit('Error querying database');
                mysqli_close($dbc);
            ?>
            <div class="scroll-x full-width-height">
                <table class="extra-width ">
                    <tbody>
                        <th class="th-border">Status</th>
                        <th class="th-border">Name</th>
                        <th class="th-border">Email</th>
                        <th class="th-border">Phone Number</th>
                        <th class="th-border">Message</th>
                        <th class="th-border">Date Received</th>
                        <th class="th-border">Mark as...</th>
                        <th class="th-border th-border-right"><i>Delete</i></th>
                    </tbody>
                    <?php
                     $generalDataHasRows = false;
                    while($row = mysqli_fetch_array($data)){
                     $generalDataHasRows = true;
                    ?>
                     <tr style="background-color:<?php echo ConvertToColor($row['Status']); ?>;">
                        <td><?php echo ConvertToTextOption($row['Status']); ?></td>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['Email'] ?></td>
                        <td><?php echo $row['Phone'] ?></td>
                        <td class="left-text"><?php echo $row['Message'] ?></td>
                        <td><?php echo $row['Date'] ?></td>
                        <td>
                            <a onclick="ChangeStatus('wp_blvdgeneraldata', <?php echo $row['id']; ?>, 0);" href="#">Todo<br/></a>
                            <a onclick="ChangeStatus('wp_blvdgeneraldata', <?php echo $row['id']; ?>, 1);" href="#">In Progress<br/></a>
                            <a onclick="ChangeStatus('wp_blvdgeneraldata', <?php echo $row['id']; ?>, 2);" href="#">Complete<br/></a>
                        </td>
                        <td><a class="deleteAnchor" onclick="DeleteEntry('wp_blvdgeneraldata', <?php echo $row['id']; ?>)">Delete</a></td>
                    </tr> <?php } ?>
                </table>
                <?php if(!$generalDataHasRows){ ?>
                    <p class="no-entries">
                        <b>There are no recent entries</b>
                    </p>
                <?php } ?>
            </div>
            <?php }else if($active_tab == "ProjectRequests"){
                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or exit('Error connecting to mysql database');
                $query = "SELECT * FROM wp_blvdrequestdata ORDER BY Date DESC";
                $data = mysqli_query($dbc, $query) or exit('Error querying database');
                mysqli_close($dbc);
            ?>
            <div class="scroll-x full-width-height">
                <table class="max-width">
                    <tbody>
                        <th class="th-border">Status</th>
                        <th class="th-border">Name</th>
                        <th class="th-border">Email</th>
                        <th class="th-border">Phone Number</th>
                        <th class="th-border">Organization</th>
                        <th class="th-border">URL</th>
                        <th class="th-border">Requested Services</th>
                        <th class="th-border">Marketing Objective</th>
                        <th class="th-border">Project Budget</th>
                        <th class="th-border">Project Time line</th>
                        <th class="th-border">Date Received</th>
                        <th class="th-border">Mark as...</th>
                        <th class="th-border th-border-right"><i>Delete</i></th>
                    </tbody>
                     <?php
                      $requestHasRows = false;
                     while($row = mysqli_fetch_array($data)){
                      $requestHasRows = true;
                     ?>
                        <tr style="background-color: <?php echo ConvertToColor($row['Status']); ?>;">
                        <td><?php echo ConvertToTextOption($row['Status']); ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Phone']; ?></td>
                        <td><?php echo $row['Organization']; ?></td>
                        <td><?php echo $row['url']; ?></td>
                        <td><?php echo $row['Services']; ?></td>
                        <td class="left-text"><?php echo $row['Objective']; ?></td>
                        <td><?php echo $row['Budget']; ?></td>
                        <td><?php echo $row['Timeline']; ?></td>
                        <td><?php echo $row['Date']; ?></td>
                        <td>
                            <a onclick="ChangeStatus('wp_blvdrequestdata', <?php echo $row['id']; ?>, 0);" href="#">Todo<br/></a>
                            <a onclick="ChangeStatus('wp_blvdrequestdata', <?php echo $row['id']; ?>, 1);" href="#">In Progress<br/></a>
                            <a onclick="ChangeStatus('wp_blvdrequestdata', <?php echo $row['id']; ?>, 2);" href="#">Complete<br/></a>
                        </td>
                        <td><a class="deleteAnchor" onclick="DeleteEntry('wp_blvdrequestdata', <?php echo $row['id']; ?>)">Delete</a></td>
                    </tr> <?php } ?>
                </table>
            <?php
            if(!$requestHasRows){ ?>
                    <p class="no-entries">
                        <b>There are no recent entries</b>
                    </p>
            <?php } ?>
            </div>
            <?php }else if($active_tab == "CareerApplications"){
                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or exit('Error connecting to mysql database');
                $query = "SELECT * FROM wp_blvdapplications ORDER BY Date DESC";
                $data = mysqli_query($dbc, $query) or exit('Error querying database');
                mysqli_close($dbc);
            ?>
            <div class="scroll-x full-width-height">
                <table class="extra-width">
                    <tbody>
                        <th class="th-border">Status</th>
                        <th class="th-border">Name</th>
                        <th class="th-border">Email</th>
                        <th class="th-border">Phone Number</th>
                        <th class="th-border">Message</th>
                        <th class="th-border">Resume</th>
                        <th class="th-border">Applied for</th>
                        <th class="th-border">Date</th>
                        <th class="th-border">Mark as...</th>
                        <th class="th-border th-border-right"><i>Delete</i></th>
                    </tbody>
                     <?php
                      $applicationsHasRows = false;
                     while($row = mysqli_fetch_array($data)){
                      $applicationsHasRows = true;
                     ?>
                    <tr style="background-color: <?php echo ConvertToColor($row['Status']); ?>;">
                        <td><?php echo ConvertToTextOption($row['Status']); ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Phone']; ?></td>
                        <td class="left-text"><?php echo $row['Message']; ?></td>
                        <td><a href="<?php echo $row['Resume']; ?>">Click here to download resume</a></td>
                        <td><?php echo $row['Position']; ?></td>
                        <td><?php echo $row['Date']; ?></td>
                        <td>
                            <a onclick="ChangeStatus('wp_blvdapplications', <?php echo $row['id']; ?>, 0);" href="#">Todo<br/></a>
                            <a onclick="ChangeStatus('wp_blvdapplications', <?php echo $row['id']; ?>, 1);" href="#">In Progress<br/></a>
                            <a onclick="ChangeStatus('wp_blvdapplications', <?php echo $row['id']; ?>, 2);" href="#">Complete<br/></a>
                        </td>
                        <td><a class="deleteAnchor" onclick="DeleteEntry('wp_blvdapplications', <?php echo $row['id']; ?>)">Delete</a></td>
                    </tr> <?php } ?>
                </table>
                <?php
                if(!$applicationsHasRows){ ?>
                    <p class="no-entries">
                        <b>There are no recent entries</b>
                    </p>
                <?php } ?>
            </div>
            <?php } ?>

            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <!-- Col Resizable plugin -->
            <script src="<?php echo THEMEROOT . '/src/js/colResizable-1.5.min.js' ?>"></script>
            <script>
                $("table").colResizable();
                function DeleteEntry(table, id){
                    if(confirm("Are you sure you want to delete this entry?")){
                        var formData = new FormData();
                        formData.append('table', table);
                        formData.append('id', id);
                        $.ajax({
                            url: "<?php echo THEMEROOT . '/delete.php'; ?>",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(res){
                                console.log("Successfully deleted entry");
                                location.reload();
                            }
                        });
                    }
                };
                function ChangeStatus(table, id, status){
                    var formData = new FormData();
                    formData.append('table', table);
                    formData.append('id', id);
                    formData.append('status', status);
                    $.ajax({
                        url: "<?php echo THEMEROOT . '/changestatus.php'; ?>",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res){
                            console.log("Successfully changed entry status");
                            location.reload();
                        }
                    });
                }
            </script>
        </div>
    <?php }

    /*
        Create Edit Project Images menu item in the tools menu
    */
    function BoulevardImageEditMenu(){
        add_management_page(
            'Edit Project Images',
            'Edit Project Images',
            'administrator',
            'blvd_edit_project_images_settings',
            'BlvdEditProjectImagesDisplay'
        );
    }

    add_action("admin_menu", "BoulevardImageEditMenu");

    function BlvdEditProjectImagesDisplay(){
        ?>
            <script src="//code.jquery.com/jquery-1.10.2.js"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <script src="src/sprintf/sprintf.js"></script>
            
            <style>
                .edit-image{width:150px; height:150px; position:inline; margin-right:0; padding-right:0; border-right:0;}
                #wpbody-content{margin-top:10px;}
                #sortable { list-style-type: none; margin: 0; padding: 0;}
                #sortable li{
                    display:inline-block; margin-right:0; padding-right:0; border-right:0;
                    margin: 3px 3px 3px 0; padding: 1px; float: left; font-size: 4em; text-align: center; 
                }
                #submit{
                    text-align:center;
                }
            </style>
            <script>
                
            function post(path, params, method) {
            method = method || "post"; // Set method to post by default if not specified.

            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for(var key in params) {
                if(params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                 }
            }

                document.body.appendChild(form);
                form.submit();
            }
                
              $(function() {
                $( "#sortable" ).sortable();
                $( "#sortable" ).disableSelection();
              });
            </script>
            <?php
                if(isset($_POST["msg"])){
                    echo "<p style='text-align:center; color:green'>" . $_POST["msg"] . "</p>";
                }
            ?>
            <ul class="ul-image-node" id="sortable">
            <!--Project images-->
            <?php
                $numRows = GetWorkNumberOfProjectImages();
                $totalNumImages = $numRows * 5; // Each rows has 5 images (or columns)
                for($count = 1; $count < $totalNumImages + 1; $count++){
                    ?>
                    <li><img class="edit-image ui-state-default" src="<?php echo WPMEDIA . '/' . $count . '.jpg' ?>" /></li>
                    <?php
                }
            ?>
                <?php //echo dirname(__FILE__); ?>
            </ul>
            <?php 
                submit_button("Save Changes"); 
                if(isset($_POST["msg"])){
                    echo "<p style='text-align:center; color:green'>" . $_POST["msg"] . "</p>";
                }
            ?>
            <script>
                var body = document.getElementById("wpbody");
                var images = document.getElementsByClassName("edit-image");
                for(var i = 0; i < images.length; i++){
                    images[i].style.height = images[i].style.width = ((body.clientWidth / 5) - 20) + "px"; // Minus 20 because of wordpress default margin + spacing between each image (another 20px)
                    console.log("Image Height: " + ((body.clientWidth / 5) - 20) + "px");
                }
                var submitBtn = document.getElementById("submit");
                submitBtn.style.marginLeft = (body.clientWidth / 2) - (submitBtn.clientWidth / 2) + "px";
                submitBtn.style.marginTop = "10px";
                var images = document.getElementsByClassName("edit-image");
                $("#submit").click(function(e){
                    var imgNodeList = document.getElementsByClassName("ul-image-node")[0].children;
                    var imgSrc = [];
                    for(var i = 0; i < imgNodeList.length; i++){
                        imgSrc.push(imgNodeList[i].children[0].getAttribute("src")); 
                    }
                    for(var i = 0; i < imgSrc.length; i++){
                        imgSrc[i] = "../../uploads/" + imgSrc[i].substr(imgSrc[i].lastIndexOf('/') + 1);
                    }
                    var imagePaths = JSON.stringify(imgSrc);
                    e.preventDefault();
                    $.ajax({type: "POST",
                    url: "<?php echo get_theme_root_uri(); ?>/Boulevard/UpdateImageOrder.php",
                    data: {images: imagePaths},
                    success:function(result){
                        //console.log("PHP POST SUCCESS");
                        var successMessage = document.createElement("p");
                        var currentdate = new Date(); 
                        var datetime = currentdate.getDate() + "/"
                                        + (currentdate.getMonth()+1)  + "/" 
                                        + currentdate.getFullYear() + " @ "  
                                        + currentdate.getHours() + ":"  
                                        + currentdate.getMinutes();
                        /*var text = document.createTextNode("Changes Saved: " + datetime);
                        successMessage.appendChild(text);
                        successMessage.style.color = "green";
                        successMessage.style.textAlign = "center";
                        document.getElementsByClassName("submit")[0].appendChild(successMessage);
                        $msg = "?msg=Changes&#32;Saved: " . datetime;*/
                        post("<?php echo $_SERVER["REQUEST_URI"] ?>", {msg: "Changes Saved: " + datetime}, "post");
                    }});
                });
                
            </script>
            
            <!--END Project images-->
        <?php
    }

    function BoulevardTeamImageEditMenu(){
        add_management_page(
            'Edit Team Images',
            'Edit Team Images',
            'administrator',
            'blvd_edit_team_images_settings',
            'BlvdEditTeamImagesDisplay'
        );
    }

    add_action("admin_menu", "BoulevardTeamImageEditMenu");

    function BlvdEditTeamImagesDisplay(){
        ?>
            <script src="//code.jquery.com/jquery-1.10.2.js"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <script src="src/sprintf/sprintf.js"></script>
            
            <style>
                .edit-image{width:150px; height:150px; position:inline; margin-right:0; padding-right:0; border-right:0;}
                #wpbody-content{margin-top:10px;}
                #sortable { list-style-type: none; margin: 0; padding: 0;}
                #sortable li{
                    display:inline-block; margin-right:0; padding-right:0; border-right:0;
                    margin: 3px 3px 3px 0; padding: 1px; float: left; font-size: 4em; text-align: center; 
                }
                #submit{
                    text-align:center;
                }
                
            </style>
            <script>
                
            function post(path, params, method) {
            method = method || "post"; // Set method to post by default if not specified.

            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for(var key in params) {
                if(params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                 }
            }

                document.body.appendChild(form);
                form.submit();
            }
                
              $(function() {
                $( "#sortable" ).sortable();
                $( "#sortable" ).disableSelection();
              });
            </script>
            <?php
                if(isset($_POST["msg"])){
                    echo "<p style='text-align:center; color:green'>" . $_POST["msg"] . "</p>";
                }
            ?>
            <ul class="ul-image-node" id="sortable">
            <!--Team images-->
            <?php
                $numRows = GetTeamNumberOfImageRows();
                $totalNumImages = $numRows * 5; // Each row has 5 images (or columns)
                for($count = 1; $count < $totalNumImages + 1; $count++){
                    $teamImage = '../wp-content/uploads/emp_' . $count . '.jpg';
                    if(file_exists($teamImage)){
                    ?>
                    <li><img class="edit-image ui-state-default" src="<?php echo WPMEDIA . '/emp_' . $count . '.jpg' ?>" /></li>
                    <?php
                    }
                }
            ?>
                <?php //echo dirname(__FILE__); ?>
            </ul>
            <?php 
                submit_button("Save Changes"); 
                if(isset($_POST["msg"])){
                    echo "<p style='text-align:center; color:green'>" . $_POST["msg"] . "</p>";
                }
            ?>
            <script>
                var body = document.getElementById("wpbody");
                var images = document.getElementsByClassName("edit-image");
                for(var i = 0; i < images.length; i++){
                    images[i].style.height = images[i].style.width = ((body.clientWidth / 3) - 20) + "px"; // Minus 20 because of wordpress default margin + spacing between each image (another 20px)
                    console.log("Image Height: " + ((body.clientWidth / 5) - 20) + "px");
                }
                var submitBtn = document.getElementById("submit");
                submitBtn.style.marginLeft = (body.clientWidth / 2) - (submitBtn.clientWidth / 2) + "px";
                submitBtn.style.marginTop = "10px";
                var images = document.getElementsByClassName("edit-image");
                $("#submit").click(function(e){
                    var imgNodeList = document.getElementsByClassName("ul-image-node")[0].children;
                    var imgSrc = [];
                    for(var i = 0; i < imgNodeList.length; i++){
                        imgSrc.push(imgNodeList[i].children[0].getAttribute("src")); 
                    }
                    for(var i = 0; i < imgSrc.length; i++){
                        imgSrc[i] = "../../uploads/" + imgSrc[i].substr(imgSrc[i].lastIndexOf('/') + 1);
                    }
                    var imagePaths = JSON.stringify(imgSrc);
                    console.log("Clicked");
                    e.preventDefault();
                    $.ajax({type: "POST",
                    url: "<?php echo get_theme_root_uri(); ?>/Boulevard/UpdateTeamImageOrder.php",
                    data: {images: imagePaths},
                    success:function(result){
                        //console.log("PHP POST SUCCESS");
                        var successMessage = document.createElement("p");
                        var currentdate = new Date(); 
                        var datetime = currentdate.getDate() + "/"
                                        + (currentdate.getMonth()+1)  + "/" 
                                        + currentdate.getFullYear() + " @ "  
                                        + currentdate.getHours() + ":"  
                                        + currentdate.getMinutes();
                        /*var text = document.createTextNode("Changes Saved: " + datetime);
                        successMessage.appendChild(text);
                        successMessage.style.color = "green";
                        successMessage.style.textAlign = "center";
                        document.getElementsByClassName("submit")[0].appendChild(successMessage);
                        $msg = "?msg=Changes&#32;Saved: " . datetime;*/
                        post("<?php echo $_SERVER["REQUEST_URI"] ?>", {msg: "Changes Saved: " + datetime}, "post");
                    }});
                });
                
            </script>
            
            <!--END Project images-->
        <?php
    }

    /**
    * Default options
    */
    /*function boulevard_theme_default_options(){
        $defaults = array(

        );
        return apply_filters('boulevard_theme_default_options', $defaults);
    }

    function BoulevardInitThemeOptions(){
        //If the theme options dont exist create them
        if(get_option('boulevard_theme_options') == false){
            add_option('boulevard_theme_options', apply_filters('boulevard_theme_default_options', boulevard_theme_default_options()));
        }

        //Register a section to hold fields
        add_settings_section(
            'general_settings_section',
            'Home page options',
            'BoulevardHomePageOptionsCB',
            'blvd_theme_settings'
        );

        add_settings_field(
            'test_id',
            'Test settings field',
            'TestFieldCallback',
            'blvd-theme-settings',
            'general_settings_section',
            array(
                __('Test message for field', 'boulevard_framework')
            )
        );
    }
    add_action('admin_init', 'BoulevardInitThemeOptions');
?>*/

function theme_queue_js(){
if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
  wp_enqueue_script( 'comment-reply' );
}
add_action('wp_print_scripts', 'theme_queue_js');

function blog_comment_section($comment, $args, $depth){
    ?>
        <div>
                <li id="comment-<?php echo get_comment_id(); ?>" class="comment byuser comment-author-<?php echo get_the_author(); ?> bypostauthor even thread-even depth-1">
				    <div id="div-comment-<?php echo get_comment_id(); ?>" class="comment-body">
                        <?php 
                        $author_bio_avatar_size = apply_filters( 'twentyfifteen_author_bio_avatar_size', 56 );
                        echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size ); 
                        ?>
                        <div style="position: relative; margin-left: 81px;" class="comment-author vcard">
                            <div style="display: inline-block; margin-bottom:10px" class="fn">
                                <h4 style="display:inline;"><?php echo get_the_author(); ?></h4> - <p style="display:inline;"><?php echo comment_time("F, j, Y"); ?> -  <?php echo comment_time(); ?></p>
                            </div> 		
                            <?php echo edit_comment_link("Edit Comment"); ?>	
                            <p style=""><?php echo get_comment_text(); ?></p>
                        </div>
                        <div class="reply">
                            <?php 
                                comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] )
                                    , $comment->comment_ID
                                    , $comment->comment_post_ID
                                );
                            ?>
                        </div>
                    </div>

    <?php
}

/*
*   Add a custom script to customize.php
*   This custom script removes any excess iframes that might be obstructing the desired iframe
*/

add_action('customize_controls_print_footer_scripts', 'BoulevardAddCustomizeScript');
function BoulevardAddCustomizeScript(){
    ?>
        <script type="text/javascript">
            var intervalId = setInterval(function(){
                var iframeParent = document.getElementById('customize-preview');
                if(iframeParent.childNodes.length > 1){
                    console.log('More than one iframe found, deleting...');
                    iframeParent.removeChild(iframeParent.childNodes[0]);
                }
            }, 3000);
        </script>
    <?php
}


add_action('customize_register', 'BoulevardInitHomeCustomize');
function BoulevardInitHomeCustomize($wp_customize){
    /*
    *   Settings that affect multiple pages
    */
    $wp_customize->add_panel('global_panel', array(
        'title' => 'Globals',
        'description' => 'Settings that affect multiple pages',
        'priority' => 10
    ));

    $wp_customize->add_section('globals_mastheads_section', array(
        'title' => 'Mastheads',
        'panel' => 'global_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('globals_sidebar_exit_btn_section', array(
        'title' => 'Side panel exit button',
        'panel' => 'global_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('globals_navbar_socialsprites_section', array(
        'title' => 'Nav bar social icons',
        'panel' => 'global_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('globals_footer_socialsprites_section', array(
        'title' => 'Footer social icons',
        'panel' => 'global_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('globals_sidepanel_socialsprites_section', array(
        'title' => 'Side panel social icons',
        'panel' => 'global_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('globals_contactpage_socialsprites_section', array(
        'title' => 'Contact page social icons',
        'panel' => 'global_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('globals_socialicon_links_section', array(
        'title' => 'Social icon links',
        'panel' => 'global_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('globals_slide_fade_section', array(
        'title' => 'Slide fade color',
        'panel' => 'global_panel',
        'priority' => 10
    ));

    /*
    *   Globals
    */

    /*Mobile masthead*/

    $wp_customize->add_setting('globals_masthead_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('globals_mobile_masteahd_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'globals_masthead_control_setting', array(
        'label' => 'Masthead',
        'section' => 'globals_mastheads_section',
        'setting' => 'globals_masthead_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'globals_mobile_masteahd_control_setting', array(
        'label' => 'Mobile masthead',
        'section' => 'globals_mastheads_section',
        'setting' => 'globals_mobile_masteahd_control_setting'
    )));

    /*
    *   Sidr exit button
    */

    $wp_customize->add_setting('globals_sidepanel_exitbtn_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'globals_sidepanel_exitbtn_image_control_setting', array(
        'label' => 'Side panel exit button image',
        'section' => 'globals_sidebar_exit_btn_section',
        'setting' => 'globals_sidepanel_exitbtn_image_control_setting'
    )));

    /*
    *   Slide fade background color
    */

    $wp_customize->add_setting('globals_slide_fade_background_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'globals_slide_fade_background_color_control_setting', array(
        'label' => 'Slide background fade color',
        'section' => 'globals_slide_fade_section',
        'setting' => 'globals_slide_fade_background_color_control_setting'
    )));


    /*
    *   Navbar social sprites
    */

    $wp_customize->add_setting('global_navbar_facebook_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_navbar_twitter_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_navbar_pinterest_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_navbar_instagram_sprite_control_setting', array(
        'default' => ''
    ));

    /*
    *   Footer scoial sprites
    */

    $wp_customize->add_setting('global_footer_facebook_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_footer_twitter_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_footer_pinterest_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_footer_instagram_sprite_control_setting', array(
        'default' => ''
    ));

    /*
    *   Side panel social sprites
    */

    $wp_customize->add_setting('global_sidepanel_facebook_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_sidepanel_twitter_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_sidepanel_pinterest_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_sidepanel_instagram_sprite_control_setting', array(
        'default' => ''
    ));

    /*
    *   Contact page social sprites
    */

    $wp_customize->add_setting('global_contactpage_facebook_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_contactpage_twitter_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_contactpage_pinterest_sprite_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('global_contactpage_instagram_sprite_control_setting', array(
        'default' => ''
    ));

    /*
    *   Navbar social sprites
    */

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_navbar_facebook_sprite_control_setting', array(
        'label' => 'Sprite 1',
        'section' => 'globals_navbar_socialsprites_section',
        'setting' => 'global_navbar_facebook_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_navbar_twitter_sprite_control_setting', array(
        'label' => 'Sprite 2',
        'section' => 'globals_navbar_socialsprites_section',
        'setting' => 'global_navbar_twitter_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_navbar_pinterest_sprite_control_setting', array(
        'label' => 'Sprite 3',
        'section' => 'globals_navbar_socialsprites_section',
        'setting' => 'global_navbar_pinterest_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_navbar_instagram_sprite_control_setting', array(
        'label' => 'Sprite 4',
        'section' => 'globals_navbar_socialsprites_section',
        'setting' => 'global_navbar_instagram_sprite_control_setting'
    )));

    /*
    *   Footer social sprites
    */

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_footer_facebook_sprite_control_setting', array(
        'label' => 'Sprite 1',
        'section' => 'globals_footer_socialsprites_section',
        'setting' => 'global_footer_facebook_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_footer_twitter_sprite_control_setting', array(
        'label' => 'Sprite 2',
        'section' => 'globals_footer_socialsprites_section',
        'setting' => 'global_footer_twitter_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_footer_pinterest_sprite_control_setting', array(
        'label' => 'Sprite 3',
        'section' => 'globals_footer_socialsprites_section',
        'setting' => 'global_footer_pinterest_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_footer_instagram_sprite_control_setting', array(
        'label' => 'Sprite 4',
        'section' => 'globals_footer_socialsprites_section',
        'setting' => 'global_footer_instagram_sprite_control_setting'
    )));

    /*
    *   Side panel social sprites
    */

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_sidepanel_facebook_sprite_control_setting', array(
        'label' => 'Sprite 1',
        'section' => 'globals_sidepanel_socialsprites_section',
        'setting' => 'global_sidepanel_facebook_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_sidepanel_twitter_sprite_control_setting', array(
        'label' => 'Sprite 2',
        'section' => 'globals_sidepanel_socialsprites_section',
        'setting' => 'global_sidepanel_twitter_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_sidepanel_pinterest_sprite_control_setting', array(
        'label' => 'Sprite 3',
        'section' => 'globals_sidepanel_socialsprites_section',
        'setting' => 'global_sidepanel_pinterest_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_sidepanel_instagram_sprite_control_setting', array(
        'label' => 'Sprite 4',
        'section' => 'globals_sidepanel_socialsprites_section',
        'setting' => 'global_sidepanel_instagram_sprite_control_setting'
    )));

    /*
    *   Contact page social sprites
    */

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_contactpage_facebook_sprite_control_setting', array(
        'label' => 'Sprite 1',
        'section' => 'globals_contactpage_socialsprites_section',
        'setting' => 'global_contactpage_facebook_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_contactpage_twitter_sprite_control_setting', array(
        'label' => 'Sprite 2',
        'section' => 'globals_contactpage_socialsprites_section',
        'setting' => 'global_contactpage_twitter_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_contactpage_pinterest_sprite_control_setting', array(
        'label' => 'Sprite 3',
        'section' => 'globals_contactpage_socialsprites_section',
        'setting' => 'global_contactpage_pinterest_sprite_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'global_contactpage_instagram_sprite_control_setting', array(
        'label' => 'Sprite 4',
        'section' => 'globals_contactpage_socialsprites_section',
        'setting' => 'global_contactpage_instagram_sprite_control_setting'
    )));

    /*
    *   Social icon links
    */

    $wp_customize->add_setting('globals_socialicon_linkdest1_control_setting', array(
        'default' => 'https://www.facebook.com/creativeboulevard'
    ));

    $wp_customize->add_setting('globals_socialicon_linkdest2_control_setting', array(
        'default' => 'https://twitter.com/BoulevardAd'
    ));

    $wp_customize->add_setting('globals_socialicon_linkdest3_control_setting', array(
        'default' => 'https://www.pinterest.com/boulevardad/'
    ));

    $wp_customize->add_setting('globals_socialicon_linkdest4_control_setting', array(
        'default' => 'https://instagram.com/creativeboulevard/'
    ));

    $wp_customize->add_control('globals_socialicon_linkdest1_control_setting', array(
        'label' => 'First social icon link destination',
        'section' => 'globals_socialicon_links_section',
        'setting' => 'globals_socialicon_linkdest1_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('globals_socialicon_linkdest2_control_setting', array(
        'label' => 'Second social icon link destination',
        'section' => 'globals_socialicon_links_section',
        'setting' => 'globals_socialicon_linkdest2_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('globals_socialicon_linkdest3_control_setting', array(
        'label' => 'Third social icon link destination',
        'section' => 'globals_socialicon_links_section',
        'setting' => 'globals_socialicon_linkdest3_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('globals_socialicon_linkdest4_control_setting', array(
        'label' => 'Fourth social icon link destination',
        'section' => 'globals_socialicon_links_section',
        'setting' => 'globals_socialicon_linkdest4_control_setting',
        'type' => 'text'
    ));


    /**
    *  ***** SETTINGS FOR HOME PAGE ******************************************************************************
    */
    $wp_customize->add_panel('home_panel', array(
        'title' => 'Home',
        'description' => 'Home settings',
         'priority' => 10
    ));

    $wp_customize->add_section('home_panel_section', array(
        'title' => 'Links',
        'panel' => 'home_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('leftLinkText_control_setting', array(
        'default' => 'SEE OUR WORK'
    ));

    $wp_customize->add_setting('rightLinkText_control_setting', array(
        'default' => 'ABOUT BOULEVARD'
    ));

    $wp_customize->add_setting('leftLinkDestination_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('rightLinkDestination_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('masthead_link', array(
        'default' => ''
    ));

    $wp_customize->add_control('leftLinkText_control_setting', array(
        'label' => 'Left most link name',
        'section' => 'home_panel_section',
        'type' => 'text'
    ));

    $wp_customize->add_control('rightLinkText_control_setting', array(
        'label' => 'Right most link name',
        'section' => 'home_panel_section',
        'type' => 'text'
    ));

    $wp_customize->add_control('masthead_link', array(
        'label' => 'Masthead link destination',
        'section' => 'home_panel_section',
        'type' => 'text'
    ));

    $wp_customize->add_control('leftLinkDestination_control_setting', array(
           'label' => 'Left most link destination',
           'section' => 'home_panel_section',
           'type' => 'text'
    ));

    $wp_customize->add_control('rightLinkDestination_control_setting', array(
        'label' => 'Right most link destination',
        'section' => 'home_panel_section',
        'type' => 'text'
    ));

    /*
    * LINK COLOR DROP DOWN
    */

    $wp_customize->add_section('home_panel_linkColors_section', array(
        'title' => 'Link Colors',
        'priority' => 10,
        'panel' => 'home_panel'
    ));

    $wp_customize->add_setting('leftLinkColor_control_setting', array(
        'default' => '#FFFFFF'
    ));

    $wp_customize->add_setting('rightLinkColor_control_setting', array(
        'default' => '#FFFFFF'
    ));

    $wp_customize->add_setting('requestLinkColor_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'leftLinkColor_control_setting', array(
        'label' => 'Left most link color',
        'section' => 'home_panel_linkColors_section',
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rightLinkColor_control_setting', array(
        'label' => 'Right most link color',
        'section' => 'home_panel_linkColors_section',
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'requestLinkColor_control_setting', array(
        'label' => 'Request link color',
        'section' => 'home_panel_linkColors_section',
    )));

    /*
    * IMAGES DROP DOWN
    */

    $wp_customize->add_section('home_panel_images_section', array(
        'title' => 'Images',
        'panel' => 'home_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('mastheadimage_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('leftmost_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('rightmost_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('request_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('leftmost_hover_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('rightmost_hover_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('request_hover_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('slogan_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'mastheadimage_control_setting', array(
        'label' => 'Masthead image',
        'section' => 'home_panel_images_section',
        'setting' => 'mastheadimage_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'menubtn_control_setting', array(
        'label' => 'Menu button icon',
        'section' => 'home_panel_images_section',
        'setting' => 'menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leftmost_menubtn_control_setting', array(
        'label' => 'Left most link icon',
        'section' => 'home_panel_images_section',
        'setting' => 'leftmost_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leftmost_hover_menubtn_control_setting', array(
        'label' => 'Left most link hover icon',
        'section' => 'home_panel_images_section',
        'setting' => 'leftmost_hover_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rightmost_menubtn_control_setting', array(
        'label' => 'Right most link icon',
        'section' => 'home_panel_images_section',
        'setting' => 'rightmost_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rightmost_hover_menubtn_control_setting', array(
        'label' => 'Rightmost link hover icon',
        'section' => 'home_panel_images_section',
        'setting' => 'rightmost_hover_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'request_menubtn_control_setting', array(
        'label' => 'Request link icon',
        'section' => 'home_panel_images_section',
        'setting' => 'request_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'request_hover_menubtn_control_setting', array(
        'label' => 'Request link hover icon',
        'section' => 'home_panel_images_section',
        'setting' => 'request_hover_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'slogan_image_control_setting', array(
        'label' => 'Main slogan image',
        'section' => 'home_panel_images_section',
        'setting' => 'slogan_image_control_setting'
    )));

    /*
    *   Backstretch duration and fade settings
    */

    $wp_customize->add_section('home_panel_background_settings_section', array(
        'title' => 'Background settings',
        'panel' => 'home_panel',
        'priority' => '10'
    ));

    $wp_customize->add_setting('number_bgimages_control_setting', array(
        'default' => '3'
    ));

    $wp_customize->add_setting('backstretch_duration_control_setting', array(
        'default' => '4000'
    ));

    $wp_customize->add_setting('backstretch_fade_control_setting', array(
        'default' => '750'
    ));

    $wp_customize->add_control('number_bgimages_control_setting', array(
        'label' => 'Number of background images',
        'section' => 'home_panel_background_settings_section',
        'setting' => 'number_bgimages_control_setting',
        'type' => 'text'
    ));

    for($i = 1; $i <= intval(get_theme_mod('number_bgimages_control_setting')); $i++){
        $wp_customize->add_setting('backstretch_img_' . $i, array(
            'default' => ''
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'backstretch_img_' . $i, array(
            'label' => 'Background image ' . $i,
            'section' => 'home_panel_background_settings_section',
            'setting' => 'backstretch_img_' . $i
        )));
    }

    $wp_customize->add_control('backstretch_duration_control_setting', array(
        'label' => 'Background show duration (Default: 4000)',
        'section' => 'home_panel_background_settings_section',
        'setting' => 'backstretch_duration_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('backstretch_fade_control_setting', array(
        'label' => 'Background fade duration (Default: 750)',
        'section' => 'home_panel_background_settings_section',
        'setting' => 'backstretch_fade_control_setting',
        'type' => 'text'
    ));

    /*
    *   General settings
    */

    $wp_customize->add_section('home_panel_general_settings_section', array(
        'title' => 'General',
        'panel' => 'home_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('footer_bar_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bar_control_setting', array(
        'label' => 'Footer bar color',
        'section' => 'home_panel_general_settings_section',
        'setting' => 'footer_bar_control_setting',
    )));

    /**
    *   ***** SETTINGS FOR OUT WORK PAGE ******************************************************************************
    */
    $wp_customize->add_panel('work_panel', array(
        'title' => 'Our Work',
        'description' => 'Settings for the our work page',
        'priority' => 10
    ));

    /*
    *   Background settings
    */

    $wp_customize->add_section('work_panel_backstretch_settings_section', array(
        'title' => 'Background',
        'priority' => 10,
        'panel' => 'work_panel'
    ));

    $wp_customize->add_setting('work_bgimages_control_setting', array(
            'default' => '3'
    ));

    $wp_customize->add_setting('work_backstretch_duration_control_setting', array(
        'default' => '4000'
    ));

    $wp_customize->add_setting('work_backstretch_fade_control_setting', array(
        'default' => '750'
    ));

    $wp_customize->add_control('work_bgimages_control_setting', array(
        'label' => 'Number of background images',
        'section' => 'work_panel_backstretch_settings_section',
        'setting' => 'work_bgimages_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('work_backstretch_duration_control_setting', array(
        'label' => 'Background show duration (Default: 4000)',
        'section' => 'work_panel_backstretch_settings_section',
        'setting' => 'work_backstretch_duration_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('work_backstretch_fade_control_setting', array(
        'label' => 'Background fade duration (Default: 750)',
        'section' => 'work_panel_backstretch_settings_section',
        'setting' => 'work_backstretch_duration_control_setting',
        'type' => 'text'
    ));

    for($i = 1; $i <= intval(get_theme_mod('work_bgimages_control_setting')); $i++){
        $wp_customize->add_setting('work_backstretch_img_' . $i, array(
            'default' => ''
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_backstretch_img_' . $i, array(
            'label' => 'Background image ' . $i,
            'section' => 'work_panel_backstretch_settings_section',
            'setting' => 'backstretch_img_' . $i
        )));
    }

    /*
    *   Colors
    */
    $wp_customize->add_section('work_panel_pagecolors_settings_section', array(
        'title' => 'Colors',
        'panel' => 'work_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('work_firstslide_headertext_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('work_partnerwithus_header_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('work_partnerwithus_paragraph_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('work_footertext_color_control_setting', array(
        'default' => '#4b4f54'
    ));

    $wp_customize->add_setting('work_navbar_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('work_projectsplitter_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('work_projectsplitter_text_control_setting', array(
        'default' => '#4b4f54'
    ));

    $wp_customize->add_setting('work_footersplitter_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('work_footerbg_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('work_projectimages_bg_cntrol_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_firstslide_headertext_color_control_setting', array(
        'label' => 'First slide header text color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_firstslide_headertext_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_navbar_color_control_setting', array(
        'label' => 'Nav bar color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_navbar_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_projectsplitter_control_setting', array(
        'label' => 'Project splitter color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_projectsplitter_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_projectimages_bg_cntrol_setting', array(
        'label' => 'Project images background color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_projectimages_bg_cntrol_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_projectsplitter_text_control_setting', array(
        'label' => 'Project splitter text color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_projectsplitter_text_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_footersplitter_control_setting', array(
        'label' => 'Footer splitter color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_footersplitter_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_partnerwithus_header_color_control_setting', array(
        'label' => 'Partner with us header text color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_partnerwithus_header_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_partnerwithus_paragraph_color_control_setting', array(
        'label' => 'Partner with us paragraph color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_partnerwithus_paragraph_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_footerbg_color_control_setting', array(
        'label' => 'Footer background color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_footerbg_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'work_footertext_color_control_setting', array(
        'label' => 'Footer text color',
        'section' => 'work_panel_pagecolors_settings_section',
        'setting' => 'work_footertext_color_control_setting'
    )));

    /*
    *   Image settings
    */

    $wp_customize->add_section('work_panel_image_settings_section', array(
        'title' => 'Images',
        'panel' => 'work_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('work_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_downarrow_cosntrol_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_nav_masthead_control_setting', array(
        'default' => ''
    ));

    /*$wp_customize->add_setting('work_nav_social_facebook_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_nav_social_instagram_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_nav_social_pinterest_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_nav_social_twitter_control_setting', array(
        'default' => ''
    ));*/

    $wp_customize->add_setting('work_nav_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_footer_bgimg_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_footer_fowardbtn_control_setting', array(
        'default' => ''
    ));

    /*$wp_customize->add_setting('work_footer_social_facebook_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_footer_social_instagram_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_footer_social_pinterest_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_footer_social_twitter_control_setting', array(
        'default' => ''
    ));*/

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_menubtn_control_setting', array(
        'label' => 'Menu button image',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_downarrow_cosntrol_setting', array(
        'label' => 'Down arrow image',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_downarrow_cosntrol_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_nav_masthead_control_setting', array(
        'label' => 'Nav bar masthead image',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_nav_masthead_control_setting'
    )));

    /*$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_nav_social_facebook_control_setting', array(
        'label' => 'Nav bar facebook sprite',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_nav_social_facebook_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_nav_social_instagram_control_setting', array(
        'label' => 'Nav bar instagram sprite',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_nav_social_instagram_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_nav_social_pinterest_control_setting', array(
        'label' => 'Nav bar pinterest sprite',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_nav_social_pinterest_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_nav_social_twitter_control_setting', array(
        'label' => 'Nav bar twitter sprite',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_nav_social_twitter_control_setting'
    )));*/

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_nav_menubtn_control_setting', array(
        'label' => 'Nav bar menu button',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_nav_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_footer_bgimg_control_setting', array(
        'label' => 'Footer background image',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_footer_bgimg_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_footer_fowardbtn_control_setting', array(
        'label' => 'Footer forward/menu button image',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_footer_fowardbtn_control_setting'
    )));

    /*$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_footer_social_facebook_control_setting', array(
        'label' => 'Footer facebook sprite',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_footer_social_facebook_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_footer_social_instagram_control_setting', array(
        'label' => 'Footer instagram sprite',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_footer_social_instagram_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_footer_social_pinterest_control_setting', array(
        'label' => 'Footer pinterest sprite',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_footer_social_pinterest_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'work_footer_social_twitter_control_setting', array(
        'label' => 'Footer twitter sprite',
        'section' => 'work_panel_image_settings_section',
        'setting' => 'work_footer_social_twitter_control_setting'
    )));*/

    /*
    *   Links
    */

    $wp_customize->add_section('work_panel_links_section', array(
        'title' => 'Links',
        'panel' => 'work_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('work_navbar_masthead_link_destination_control_setting', array(
        'default' => 'Home'
    ));

    $wp_customize->add_control('work_navbar_masthead_link_destination_control_setting', array(
        'label' => 'Nav bar masthead link',
        'section' => 'work_panel_links_section',
        'setting' => 'work_navbar_masthead_link_destination_control_setting'
    ));

    /*
    *   Project images
    */

    $wp_customize->add_section('work_panel_projectimages_settings_section', array(
        'title' => 'Project images',
        'panel' => 'work_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('work_project_numberof_imagerows_control_setting', array(
        'default' => '10'
    ));

    $wp_customize->add_control('work_project_numberof_imagerows_control_setting', array(
        'label' => 'Number of rows',
        'section' => 'work_panel_projectimages_settings_section',
        'setting' => 'work_project_imagenumber_control_setting',
        'type' => 'text'
    ));



    /**
    *   Font size
    */

    $wp_customize->add_section('work_panel_font_settings_section', array(
        'title' => 'Text font',
        'panel' => 'work_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('work_slide1_headerfontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_projectsplitter_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_partnerwithus_header_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_partnerwithus_paragraphfontsize_sontrol_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('work_footer__textfont_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control('work_slide1_headerfontsize_control_setting', array(
        'label' => 'First slide header font size',
        'section' => 'work_panel_font_settings_section',
        'setting' => 'work_slide1_headerfontsize_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('work_projectsplitter_fontsize_control_setting', array(
        'label' => 'Project splitter font size',
        'section' => 'work_panel_font_settings_section',
        'setting' => 'work_projectsplitter_fontsize_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('work_partnerwithus_header_fontsize_control_setting', array(
        'label' => 'Partner with us header font size',
        'section' => 'work_panel_font_settings_section',
        'setting' => 'work_partnerwithus_header_fontsize_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('work_partnerwithus_paragraphfontsize_sontrol_setting', array(
        'label' => 'Partner with us paragraph font size',
        'section' => 'work_panel_font_settings_section',
        'setting' => 'work_partnerwithus_paragraphfontsize_sontrol_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('work_footer__textfont_control_setting', array(
        'label' => 'Footer text font size',
        'section' => 'work_panel_font_settings_section',
        'setting' => 'work_footer__textfont_control_setting',
        'type' => 'text'
    ));

    /**
    *   ***** SETTINGS FOR ABOUT PAGE ******************************************************************************
    */

    $wp_customize->add_panel('about_panel', array(
        'title' => 'About',
        'description' => 'Settings for the about page',
        'priority' => 10
    ));

    /*
    *   Background settings
    */

    $wp_customize->add_section('about_background_section', array(
        'title' => 'Background',
        'panel' => 'about_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('about_slide1_background_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_slide1_background_text_opacity_control_setting', array(
        'default' => 0.5
    ));

    $wp_customize->add_setting('about_slide2_background_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_slide1_background_control_setting', array(
        'label' => 'First slide background image',
        'section' => 'about_background_section',
        'setting' => 'about_slide1_background_control_setting'
    )));

    $wp_customize->add_control('about_slide1_background_text_opacity_control_setting', array(
        'label' => 'First slide text background opacity (Values between 0.0 - 1.0)',
        'section' => 'about_background_section',
        'setting' => 'about_slide1_background_text_opacity_control_setting'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_slide2_background_control_setting', array(
        'label' => 'Second slide background image',
        'section' => 'about_background_section',
        'setting' => 'about_slide2_background_control_setting'
    )));

    /*
    *   Colors
    */

    $wp_customize->add_section('about_colors_section', array(
        'title' => 'Colors',
        'panel' => 'about_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('about_request_text_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('about_request_texthover_color_control_setting', array(
        'default' => '#FFFFFF'
    ));

    $wp_customize->add_setting('about_side1_maintext_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('about_slide1_text_backgroundcolor_control_setting', array(
        'default' => '#E9E9E8'
    ));

    $wp_customize->add_setting('about_slide1_blurbheader_color_control_setting', array(
        'default' => '#9c9895'
    ));

    $wp_customize->add_setting('about_slide1_blurbparagraph_color_control_setting', array(
        'default' => '#4b4f54'
    ));

    $wp_customize->add_setting('about_page_splitter_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('about_slide2_header_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('about_slide2_paragraph_color_control_setting', array(
        'default' => '#9ea2a2'
    ));

    $wp_customize->add_setting('about_footer_backgroundcolor_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('about_footertext_color_control_setting', array(
        'default' => '#4b4f54'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_request_text_color_control_setting', array(
        'label' => 'Request project text color',
        'section' => 'about_colors_section',
        'setting' => 'about_request_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_request_texthover_color_control_setting', array(
        'label' => 'Request project text hover color',
        'section' => 'about_colors_section',
        'setting' => 'about_request_texthover_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_side1_maintext_control_setting', array(
        'label' => 'First slide main header color',
        'section' => 'about_colors_section',
        'setting' => 'about_side1_maintext_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_slide1_text_backgroundcolor_control_setting', array(
        'label' => 'First slide text background color',
        'section' => 'about_colors_section',
        'setting' => 'about_slide1_text_backgroundcolor_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_slide1_blurbheader_color_control_setting', array(
        'label' => 'First slide blurb header color',
        'section' => 'about_colors_section',
        'setting' => 'about_slide1_blurbheader_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_slide1_blurbparagraph_color_control_setting', array(
        'label' => 'First slide paragraph text color',
        'section' => 'about_colors_section',
        'setting' => 'about_slide1_blurbparagraph_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_page_splitter_control_setting', array(
        'label' => 'Slide splitter color',
        'section' => 'about_colors_section',
        'setting' => 'about_page_splitter_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_slide2_header_color_control_setting', array(
        'label' => 'Second slide header text color',
        'section' => 'about_colors_section',
        'setting' => 'about_slide2_header_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_slide2_paragraph_color_control_setting', array(
        'label' => 'Second slide paragraph text color',
        'section' => 'about_colors_section',
        'setting' => 'about_slide2_paragraph_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_footer_backgroundcolor_control_setting', array(
        'label' => 'Footer background color',
        'section' => 'about_colors_section',
        'setting' => 'about_footer_backgroundcolor_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_footertext_color_control_setting', array(
        'label' => 'Footer text color',
        'section' => 'about_colors_section',
        'setting' => 'about_footertext_color_control_setting'
    )));

    /*
    *   Fonts
    */

    $wp_customize->add_section('about_fonts_section', array(
        'title' => 'Font',
        'panel' => 'about_panel',
        'prioirty' => 10
    ));

    $wp_customize->add_setting('about_request_font_size_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_mainheader_font_size_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_whoweare_header_font_size_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_whoweare_paragraph_font_size_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_whatwedo_header_font_size_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_whatwedo_paragraph_font_size_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_footer_text_font_size_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control('about_request_font_size_control_setting', array(
        'label' => 'Request project text font size',
        'section' => 'about_fonts_section',
        'setting' => 'about_request_font_size_control_setting'
    ));

    $wp_customize->add_control('about_mainheader_font_size_control_setting', array(
        'label' => 'Main header text font size',
        'section' => 'about_fonts_section',
        'setting' => 'about_mainheader_font_size_control_setting'
    ));

    $wp_customize->add_control('about_whoweare_header_font_size_control_setting', array(
        'label' => 'Who we are header text font size',
        'section' => 'about_fonts_section',
        'setting' => 'about_whoweare_header_font_size_control_setting'
    ));

    $wp_customize->add_control('about_whoweare_paragraph_font_size_control_setting', array(
        'label' => 'Who we are paragraph text font size',
        'section' => 'about_fonts_section',
        'setting' => 'about_whoweare_paragraph_font_size_control_setting'
    ));

    $wp_customize->add_control('about_whatwedo_header_font_size_control_setting', array(
        'label' => 'What we do header text font size',
        'section' => 'about_fonts_section',
        'setting' => 'about_whatwedo_paragraph_font_size_control_setting'
    ));

    $wp_customize->add_control('about_whatwedo_paragraph_font_size_control_setting', array(
        'label' => 'What we do paragraph text font size',
        'section' => 'about_fonts_section',
        'setting' => 'about_whatwedo_paragraph_font_size_control_setting'
    ));

    $wp_customize->add_control('about_footer_text_font_size_control_setting', array(
        'label' => 'Footer text font size',
        'section' => 'about_fonts_section',
        'setting' => 'about_footer_text_font_size_control_setting'
    ));

    /*
    *   Images
    */

    $wp_customize->add_section('about_images_section', array(
        'title' => 'Images',
        'panel' => 'about_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('about_mastehead_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_request_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_menubtn_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_footersocial_facebook_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_footersocial_twitter_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('about_footersocial_pinterest_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_mastehead_image_control_setting', array(
        'label' => 'Masthead image',
        'section' => 'about_images_section',
        'setting' => 'about_mastehead_image_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_request_image_control_setting', array(
        'label' => 'Request project icon',
        'section' => 'about_images_section',
        'setting' => 'about_request_image_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_menubtn_image_control_setting', array(
        'label' => 'Menu button image',
        'section' => 'about_images_section',
        'setting' => 'about_menubtn_image_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_footersocial_facebook_control_setting', array(
        'label' => 'Footer facebook sprite',
        'section' => 'about_images_section',
        'setting' => 'about_footersocial_facebook_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_footersocial_twitter_control_setting', array(
        'label' => 'Footer twitter sprite',
        'section' => 'about_images_section',
        'setting' => 'about_footersocial_twitter_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_footersocial_pinterest_control_setting', array(
        'label' => 'Footer pinterest sprite',
        'section' => 'about_images_section',
        'setting' => 'about_footersocial_pinterest_control_setting'
    )));

    /*
    * Links
    */

    $wp_customize->add_section('about_links_section', array(
        'title' => 'Links',
        'panel' => 'about_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('about_masthead_link_destination_control_setting', array(
        'default' => 'Home'
    ));

    $wp_customize->add_control('about_masthead_link_destination_control_setting', array(
        'label' => 'Masthead link destination',
        'section' => 'about_links_section',
        'setting' => 'about_masthead_link_destination_control_setting'
    ));
    /**
    *   ***** SETTINGS FOR TEAM PAGE ******************************************************************************
    */
    $wp_customize->add_panel('team_panel', array(
        'title' => 'Team',
        'description' => 'Settings for the team page',
        'priority' => 10
    ));

    /*
    *   Background settings
    */

    $wp_customize->add_section('team_background_section', array(
        'title' => 'Background',
        'priority' => 10,
        'panel' => 'team_panel'
    ));

    $wp_customize->add_setting('team_slide1_backgroundimage_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'team_slide1_backgroundimage_control_setting', array(
        'label' => 'First slide background image',
        'section' => 'team_background_section',
        'setting' => 'team_slide1_backgroundimage_control_setting'
    )));

    /*
    *   Color settings
    */

    $wp_customize->add_section('team_colors_section', array(
        'title' => 'Colors',
        'panel' => 'team_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('team_firstslide_text_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('team_navbar_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('team_secondslide_header_text_color_control_setting', array(
        'default' => '#4b4f54'
    ));

    $wp_customize->add_setting('team_secondslide_background_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('team_employee_name_textcolor_control_setting', array(
        'default' => '#4b4f54'
    ));

    $wp_customize->add_setting('team_employee_email_textcolor_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_employee_email_hover_textcolor_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_workspace_textcolor_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('team_joinus_text_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('team_footer_text_color_control_setting', array(
        'default' => '#4b4f54'
    ));

    $wp_customize->add_setting('team_workspace_join_area_background_color', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('team_footer_background_color', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_firstslide_text_color_control_setting', array(
        'label' => 'First slide header text color',
        'section' => 'team_colors_section',
        'setting' => 'team_firstslide_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_navbar_color_control_setting', array(
        'label' => 'Navbar color',
        'section' => 'team_colors_section',
        'setting' => 'team_navbar_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_secondslide_header_text_color_control_setting', array(
        'label' => 'Second slide header text color',
        'section' => 'team_colors_section',
        'setting' => 'team_secondslide_header_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_secondslide_background_color_control_setting', array(
        'label' => 'Second slide background color',
        'section' => 'team_colors_section',
        'setting' => 'team_secondslide_background_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_employee_name_textcolor_control_setting', array(
        'label' => 'Employee name text color',
        'section' => 'team_colors_section',
        'setting' => 'team_employee_name_textcolor_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_employee_email_textcolor_control_setting', array(
        'label' => 'Employee email text color',
        'section' => 'team_colors_section',
        'setting' => 'team_employee_email_textcolor_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_employee_email_hover_textcolor_control_setting', array(
        'label' => 'Employee email hover text color',
        'section' => 'team_colors_section',
        'setting' => 'team_employee_email_hover_textcolor_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_workspace_textcolor_control_setting', array(
        'label' => 'Workspace text color',
        'section' => 'team_colors_section',
        'setting' => 'team_workspace_textcolor_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_joinus_text_color_control_setting', array(
        'label' => 'Join the team text color',
        'section' => 'team_colors_section',
        'setting' => 'team_joinus_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_footer_text_color_control_setting', array(
        'label' => 'Footer text color',
        'section' => 'team_colors_section',
        'setting' => 'team_footer_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_workspace_join_area_background_color', array(
        'label' => 'Workspace/Join background color',
        'section' => 'team_colors_section',
        'setting' => 'team_workspace_join_area_background_color'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'team_footer_background_color', array(
        'label' => 'Footer background color',
        'section' => 'team_colors_section',
        'setting' => 'team_footer_background_color'
    )));

    /*
    *   Font
    */
    $wp_customize->add_section('team_font_section', array(
        'title' => 'Font',
        'panel' => 'team_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('team_firstslide_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_employee_name_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_employee_email_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_workspace_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_joinus_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_footer_text_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control('team_firstslide_fontsize_control_setting', array(
        'label' => 'First slide header font size',
        'section' => 'team_font_section',
        'setting' => 'team_firstslide_fontsize_control_setting'
    ));

    $wp_customize->add_control('team_employee_name_fontsize_control_setting', array(
        'label' => 'Employee name font size',
        'section' => 'team_font_section',
        'setting' => 'team_employee_name_fontsize_control_setting'
    ));

    $wp_customize->add_control('team_employee_email_fontsize_control_setting', array(
        'label' => 'Employee email font size',
        'section' => 'team_font_section',
        'setting' => 'team_employee_email_fontsize_control_setting'
    ));

    $wp_customize->add_control('team_workspace_fontsize_control_setting', array(
        'label' => 'Our workspace font size',
        'section' => 'team_font_section',
        'setting' => 'team_workspace_fontsize_control_setting'
    ));

    $wp_customize->add_control('team_joinus_fontsize_control_setting', array(
        'label' => 'Join the team font size',
        'section' => 'team_font_section',
        'setting' => 'team_joinus_fontsize_control_setting'
    ));

    $wp_customize->add_control('team_footer_text_fontsize_control_setting', array(
        'label' => 'Footer text font size',
        'section' => 'team_font_section',
        'setting' => 'team_footer_text_fontsize_control_setting'
    ));

    /*
    *   Images
    */

    $wp_customize->add_section('team_images_section', array(
        'title' => 'Images',
        'panel' => 'team_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('team_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_downarrow_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_navbar_masthead_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_navbar_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_workspace_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('team_jointeam_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'team_menubtn_control_setting', array(
        'label' => 'Menu button image',
        'section' => 'team_images_section',
        'setting' => 'team_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'team_downarrow_control_setting', array(
        'label' => 'Down arrow image',
        'section' => 'team_images_section',
        'setting' => 'team_downarrow_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'team_navbar_masthead_control_setting', array(
        'label' => 'Nav bar masthead',
        'section' => 'team_images_section',
        'setting' => 'team_navbar_masthead_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'team_navbar_menubtn_control_setting', array(
        'label' => 'Nav bar menu button',
        'section' => 'team_images_section',
        'setting' => 'team_navbar_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'team_workspace_image_control_setting', array(
        'label' => 'Workspace image',
        'section' => 'team_images_section',
        'setting' => 'team_workspace_image_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'team_jointeam_image_control_setting', array(
        'label' => 'Join the team image',
        'section' => 'team_images_section',
        'setting' => 'team_jointeam_image_control_setting'
    )));

    /*
    *   Links
    */

    $wp_customize->add_section('team_links_section', array(
        'title' => 'Links',
        'panel' => 'team_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('team_navbar_masthead_link_destination_control_setting', array(
        'default' => 'Home'
    ));
    $wp_customize->add_control('team_navbar_masthead_link_destination_control_setting', array(
        'label' => 'Nav bar masthead link destination',
        'section' => 'team_links_section',
        'setting' => 'team_navbar_masthead_link_destination_control_setting'
    ));

    /*
    * Team images
    */

    $wp_customize->add_section('team_teamimages_section', array(
        'title' => 'Team images',
        'panel' => 'team_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('team_numberrows_control_setting', array(
        'default' => 2
    ));

    $wp_customize->add_control('team_numberrows_control_setting', array(
        'label' => 'Team images # of rows',
        'section' => 'team_teamimages_section',
        'setting' => 'team_numberrows_control_setting',
         'type' => 'text'
    ));

    /*Mulitplying by three because there are 3 items in a row, adding because we start $i at 1 we must add 1 in order to hit the last item*/
    for($i = 1; $i < (intval(get_theme_mod('team_numberrows_control_setting') * 3) + 1); $i++){
        $wp_customize->add_setting('team_emplyoee_' . $i . 'name_control_setting', array(
            'default' => ''
        ));

        $wp_customize->add_setting('team_emplyoee_' . $i . 'email_control_setting', array(
            'default' => ''
        ));

        $wp_customize->add_setting('team_emplyoee_' . $i . 'position_control_setting', array(
            'default' => ''
        ));

        $wp_customize->add_control('team_emplyoee_' . $i . 'name_control_setting', array(
            'label' => 'Employee ' . $i . ' name',
            'section' => 'team_teamimages_section',
            'setting' => 'team_emplyoee_' . $i . 'name',
            'type' => 'text'
         ));

        $wp_customize->add_control('team_emplyoee_' . $i . 'email_control_setting', array(
            'label' => 'Employee ' . $i . ' email',
            'section' => 'team_teamimages_section',
            'setting' => 'team_emplyoee_' . $i . 'email',
            'type' => 'text'
        ));

        $wp_customize->add_control('team_emplyoee_' . $i . 'position_control_setting', array(
            'label' => 'Employee ' . $i . ' position',
            'section' => 'team_teamimages_section',
            'setting' => 'team_emplyoee_' . $i . 'position',
            'type' => 'text'
        ));
    }
    /**
    *   ***** SETTINGS FOR OFFICE PAGE ******************************************************************************
    */
    $wp_customize->add_panel('office_panel', array(
        'title' => 'Office',
        'description' => 'Settings for the office page',
        'priority' => 10
    ));

    /*
    *   Background settings
    */

    $wp_customize->add_section('office_background_section', array(
        'title' => 'Background',
        'priority' => 10,
        'panel' => 'office_panel'
    ));

    $wp_customize->add_setting('office_numberbgimages_control_setting', array(
        'default' => 3
    ));

    $wp_customize->add_control('office_numberbgimages_control_setting', array(
        'label' => 'Number of office images',
        'section' => 'office_background_section',
        'setting' => 'office_numberbgimages_control_setting'
    ));

    for($i = 1; $i <= intval(get_theme_mod('office_numberbgimages_control_setting')); $i++){
        $wp_customize->add_setting('office_backstretch_img_' . $i, array(
            'default' => ''
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_backstretch_img_' . $i, array(
            'label' => 'Background image ' . $i,
            'section' => 'office_background_section',
            'setting' => 'office_backstretch_img_' . $i
        )));
    }

    /*$wp_customize->add_setting('office_firstslide_background_control_setting', array(
            'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_firstslide_background_control_setting', array(
        'label' => ''
    )));*/

    /*
    *   Color
    */
    $wp_customize->add_section('office_color_section', array(
        'title' => 'Colors',
        'panel' => 'office_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('office_firstslide_text_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('office_navbar_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('office_footer_background_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('office_footertext_color_control_setting', array(
        'default' => '#4b4f54'
    ));

    $wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'office_firstslide_text_color_control_setting', array(
        'label' => 'First slide header color',
        'section' => 'office_color_section',
        'setting' => 'office_firstslide_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'office_navbar_color_control_setting', array(
        'label' => 'Nav bar color',
        'section' => 'office_color_section',
        'setting' => 'office_navbar_color_control_setting'
    )));

    $wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'office_footer_background_color_control_setting', array(
        'label' => 'Footer background color',
        'section' => 'office_color_section',
        'setting' => 'office_footer_background_color_control_setting'
    )));

    $wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'office_footertext_color_control_setting', array(
        'label' => 'Footer text color',
        'section' => 'office_color_section',
        'setting' => 'office_footertext_color_control_setting'
    )));

    /*
    *   Font
    */
    $wp_customize->add_section('office_font_section', array(
        'title' => 'Font',
        'panel' => 'office_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('office_firstslide_font_size_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_footer_text_font_size_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control('office_firstslide_font_size_control_setting', array(
        'label' => 'First slide text size',
        'section' => 'office_font_section',
        'setting' => 'office_firstslide_font_size_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('office_footer_text_font_size_control_setting', array(
        'label' => 'Footer text size',
        'section' => 'office_font_section',
        'setting' => 'office_footer_text_font_size_control_setting',
        'type' => 'text'
    ));

    /*
    *   Images
    */

    $wp_customize->add_section('office_image_section', array(
        'title' => 'Images',
        'panel' => 'office_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('office_navbar_mastahead_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_navbar_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_menubtn_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_downarrow_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_image1_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_image2_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_image3_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_image4_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_image5_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_image6_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('office_image7_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_navbar_mastahead_control_setting', array(
        'label' => 'Navbar masthead image',
        'section' => 'office_image_section',
        'setting' => 'office_navbar_mastahead_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_navbar_menubtn_control_setting', array(
         'label' => 'Nav bar menu button image',
         'section' => 'office_image_section',
         'setting' => 'office_navbar_menubtn_control_setting'
     )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_menubtn_image_control_setting', array(
        'label' => 'First slide menu button image',
        'section' => 'office_image_section',
        'setting' => 'office_menubtn_image_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_downarrow_image_control_setting', array(
        'label' => 'First slide down arrow image',
        'section' => 'office_image_section',
        'setting' => 'office_downarrow_image_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_image1_control_setting', array(
        'label' => 'First office image',
        'section' => 'office_image_section',
        'setting' => 'office_image1_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_image2_control_setting', array(
        'label' => 'Second office image',
        'section' => 'office_image_section',
        'setting' => 'office_image2_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_image3_control_setting', array(
        'label' => 'Third office image',
        'section' => 'office_image_section',
        'setting' => 'office_image3_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_image4_control_setting', array(
        'label' => 'Fourth office image',
        'section' => 'office_image_section',
        'setting' => 'office_image4_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_image5_control_setting', array(
        'label' => 'Fifth office image',
        'section' => 'office_image_section',
        'setting' => 'office_image5_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_image6_control_setting', array(
        'label' => 'Sixth office image',
        'section' => 'office_image_section',
        'setting' => 'office_image6_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'office_image7_control_setting', array(
        'label' => 'Seventh office image',
        'section' => 'office_image_section',
        'setting' => 'office_image7_control_setting'
    )));

    /*
    *   Links
    */

    $wp_customize->add_section('office_link_section', array(
        'title' => 'Links',
        'panel' => 'office_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('office_navbar_masthead_link_destination_control_setting', array(
        'default' => 'Home'
    ));

    $wp_customize->add_control('office_navbar_masthead_link_destination_control_setting', array(
        'label' => 'Nav bar link destination',
        'section' => 'office_link_section',
        'setting' => 'office_navbar_masthead_link_destination_control_setting'
    ));

    /**
    *   ***** SETTINGS FOR CONTACT PAGE ******************************************************************************
    */
    $wp_customize->add_panel('contact_panel', array(
        'title' => 'Contact',
        'description' => 'Settings for the about page',
        'priority' => 10
    ));

    /*
    *   Background settings
    */

    $wp_customize->add_section('contact_background_section', array(
        'title' => 'Background',
        'priority' => 10,
        'panel' => 'contact_panel'
    ));

    $wp_customize->add_setting('contact_firstslide_background_image_control_setting', array(
            'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'contact_firstslide_background_image_control_setting', array(
        'label' => 'First slide background image',
        'section' => 'contact_background_section',
        'setting' => 'contact_firstslide_background_image_control_setting'
    )));

    /*
    *   Color
    */

    $wp_customize->add_section('contact_color_section', array(
        'title' => 'Color',
        'panel' => 'contact_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('contact_firstslide_header_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('contact_firstslide_paragraph_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('contact_navbar_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('contact_slide2_background_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('contact_slide2_left_contactheader_color_control_setting', array(
        'default' => '#9ea2a2'
    ));

    $wp_customize->add_setting('contact_slide2_left_givecall_color_control_setting', array(
        'default' => '#9ea2a2'
    ));

    $wp_customize->add_setting('contact_slide2_left_followus_color_control_setting', array(
        'default' => '#9ea2a2'
    ));

    $wp_customize->add_setting('contact_slide_left_sendamessage_color_control_setting', array(
        'default' => '#9ea2a2'
    ));

    $wp_customize->add_setting('contact_paragraph_color_control_setting', array(
        'default' => 'black'
    ));

    $wp_customize->add_setting('footer_background_color_control_setting', array(
        'default' => '#FAD000'
    ));

    $wp_customize->add_setting('footer_text_color_control_setting', array(
        'default' => '#4b4f54'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_firstslide_header_color_control_setting', array(
        'label' => 'First slide header text color',
        'section' => 'contact_color_section',
        'setting' => 'contact_firstslide_header_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_firstslide_paragraph_color_control_setting', array(
        'label' => 'First slide paragraph text color',
        'section' => 'contact_color_section',
        'setting' => 'contact_firstslide_paragraph_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_navbar_color_control_setting', array(
        'label' => 'Nav bar color',
        'section' => 'contact_color_section',
        'setting' => 'contact_navbar_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_slide2_background_color_control_setting', array(
        'label' => 'Second slide background color',
        'section' => 'contact_color_section',
        'setting' => 'contact_slide2_background_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_slide2_left_contactheader_color_control_setting', array(
        'label' => 'Second slide "contact" header text color',
        'section' => 'contact_color_section',
        'setting' => 'contact_slide2_left_contactheader_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_slide2_left_givecall_color_control_setting', array(
        'label' => 'Second slide "Give us a call" header text color',
        'section' => 'contact_color_section',
        'setting' => 'contact_slide2_left_givecall_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_slide2_left_followus_color_control_setting', array(
        'label' => 'Second slide "Follow us" header text color',
        'section' => 'contact_color_section',
        'setting' => 'contact_slide2_left_followus_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_slide_left_sendamessage_color_control_setting', array(
        'label' => 'Second slide "Send us a message" header text color',
        'section' => 'contact_color_section',
        'setting' => 'contact_slide_left_sendamessage_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_paragraph_color_control_setting', array(
        'label' => 'Second slide paragraph(s) color',
        'section' => 'contact_color_section',
        'setting' => 'contact_paragraph_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_background_color_control_setting', array(
        'label' => 'Footer background color',
        'section' => 'contact_color_section',
        'setting' => 'footer_background_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_text_color_control_setting', array(
        'label' => 'Footer text color',
        'section' => 'contact_color_section',
        'setting' => 'footer_text_color_control_setting'
    )));

    /*
    *   Fonts
    */

    $wp_customize->add_section('contact_font_section', array(
        'title' => 'Font',
        'panel' => 'contact_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('contact_mainheader_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('contact_firstslide_secondaryheader_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('contact_contact_followus_header_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('contact_sendus_amessage_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('contact_paragraphs_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('contact_footer_fontsize_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control('contact_mainheader_fontsize_control_setting', array(
        'label' => 'Main header font size',
        'section' => 'contact_font_section',
        'setting' => '',
        'text'
    ));

    $wp_customize->add_control('contact_firstslide_secondaryheader_fontsize_control_setting', array(
        'label' => 'Secondary header font size',
        'section' => 'contact_font_section',
        'setting' => 'contact_firstslide_secondaryheader_fontsize_control_setting',
        'text'
    ));

    $wp_customize->add_control('contact_contact_followus_header_fontsize_control_setting', array(
        'label' => '"Contact", "Follow us" header font sizes',
        'section' => 'contact_font_section',
        'setting' => 'contact_contact_followus_header_fontsize_control_setting',
        'text'
    ));

    $wp_customize->add_control('contact_sendus_amessage_fontsize_control_setting', array(
        'label' => '"Send us a message" header font size',
        'section' => 'contact_font_section',
        'setting' => 'contact_sendus_amessage_fontsize_control_setting',
        'text'
    ));

    $wp_customize->add_control('contact_paragraphs_fontsize_control_setting', array(
        'label' => 'Paragraph(s) font sizes',
        'section' => 'contact_font_section',
        'setting' => 'contact_paragraphs_fontsize_control_setting',
        'text'
    ));

    $wp_customize->add_control('contact_footer_fontsize_control_setting', array(
        'label' => 'Footer text font size',
        'section' => 'contact_font_section',
        'setting' => 'contact_footer_fontsize_control_setting',
        'text'
    ));

    /*
    *   Images
    */

    $wp_customize->add_section('contact_images_section', array(
        'title' => 'Images',
        'panel' => 'contact_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('contact_firstslide_menubtn_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('contact_downarrow_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('contact_navbar_masthead_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('contact_navbar_menubtn_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('contact_submit_btn_image_control_setting', array(
       'default' => ''
    ));


    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'contact_firstslide_menubtn_control_setting', array(
        'label' => 'First slide menu button image',
        'section' => 'contact_images_section',
        'setting' => 'contact_firstslide_menubtn_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'contact_downarrow_image_control_setting', array(
        'label' => 'First slide down arrow image',
        'section' => 'contact_images_section',
        'setting' => 'contact_downarrow_image_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'contact_navbar_masthead_control_setting', array(
        'label' => 'Nav bar masthead image',
        'section' => 'contact_images_section',
        'setting' => 'contact_navbar_masthead_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'contact_navbar_menubtn_image_control_setting', array(
        'label' => 'Nav bar menu button image',
        'section' => 'contact_images_section',
        'setting' => 'contact_navbar_menubtn_image_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'contact_submit_btn_image_control_setting', array(
        'label' => 'Submit button image',
        'section' => 'contact_images_section',
        'setting' => 'contact_submit_btn_image_control_setting'
    )));

    /*
    *   Links
    */

    $wp_customize->add_section('contact_links_section', array(
        'title' => 'Links',
        'panel' => 'contact_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('contact_navbar_masthead_link_destination_control_setting', array(
        'default' => 'Home'
    ));

    $wp_customize->add_control('contact_navbar_masthead_link_destination_control_setting', array(
        'label' => 'Nav bar masthead link destination',
        'section' => 'contact_links_section',
        'setting' => 'contact_navbar_masthead_link_destination_control_setting'
    ));

    /*
    *   Navigation side bar settings
    */

    $wp_customize->add_panel('sidepanel_navigation_panel', array(
        'title' => 'Side bar navigation',
        'description' => 'Setting for the main side bar navigation',
        'priority' => 10
    ));

    $wp_customize->add_section('sidepanel_navigation_background_settings_section', array(
        'title' => 'Background',
        'panel' => 'sidepanel_navigation_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('sidepanel_navigation_foreground_settings_section', array(
        'title' => 'Foreground',
        'panel' => 'sidepanel_navigation_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('sidepanel_navigation_background_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_navigation_use_background_color_checkbox_control_setting');

    $wp_customize->add_setting('sidepanel_navigation_background_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_navigation_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_navigation_text_color_hover_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_navigation_splitter_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sidepanel_navigation_background_image_control_setting', array(
        'label' => 'Background image',
        'section' => 'sidepanel_navigation_background_settings_section',
        'setting' => 'sidepanel_navigation_background_image_control_setting'
    )));

    $wp_customize->add_control('sidepanel_navigation_use_background_color_checkbox_control_setting', array(
        'label' => 'Use background color',
        'section' => 'sidepanel_navigation_background_settings_section',
        'setting' => 'sidepanel_navigation_use_background_color_checkbox_control_setting',
        'type' => 'checkbox'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_navigation_background_color_control_setting', array(
        'label' => 'Background color',
        'section' => 'sidepanel_navigation_background_settings_section',
        'setting' => 'sidepanel_navigation_background_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_navigation_text_color_control_setting', array(
        'label' => 'Text color',
        'section' => 'sidepanel_navigation_foreground_settings_section',
        'setting' => 'sidepanel_navigation_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_navigation_text_color_hover_control_setting', array(
        'label' => 'Text color hover',
        'section' => 'sidepanel_navigation_foreground_settings_section',
        'setting' => 'sidepanel_navigation_text_color_hover_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sidepanel_navigation_splitter_image_control_setting', array(
        'label' => 'Splitter images',
        'section' => 'sidepanel_navigation_foreground_settings_section',
        'setting' => 'sidepanel_navigation_splitter_image_control_setting'
    )));

    /*
    *   Join Us side panel settings
    */

    $wp_customize->add_panel('sidepanel_joinus_panel', array(
        'title' => 'Join Us side panel',
        'description' => 'Settings for the "Join Us" side panel',
        'priority' => 10
    ));

    $wp_customize->add_section('sidepanel_joinus_background_settings_section', array(
        'title' => 'Background',
        'panel' => 'sidepanel_joinus_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('sidepanel_joinus_form_settings_section', array(
        'title' => 'Form controls',
        'panel' => 'sidepanel_joinus_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('sidepanel_joinus_text_settings_section', array(
        'title' => 'Text',
        'panel' => 'sidepanel_joinus_panel',
        'priority' => 10
    ));

    $wp_customize->add_section('sidepanel_joinus_joblistings_settings_section', array(
        'title' => 'Job listings',
        'panel' => 'sidepanel_joinus_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('sidepanel_joinus_background_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_use_bg_color_checkbox_control_setting');

    $wp_customize->add_setting('sidepanel_joinus_background_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_panel_name_header_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_main_header_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_job_listing_header_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_job_listing_urgent_header_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_paragraph_section_header_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_paragraph_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_form_height_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_form_border_radius_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_form_background_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_form_boxshadow_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_joinus_number_of_job_listings_control_setting', array(
        'default' => '1'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sidepanel_joinus_background_image_control_setting', array(
        'label' => 'Background image',
        'section' => 'sidepanel_joinus_background_settings_section',
        'setting' => 'sidepanel_joinus_background_image_control_setting'
    )));

    $wp_customize->add_control('sidepanel_joinus_use_bg_color_checkbox_control_setting', array(
        'label' => 'Use background color',
        'section' => 'sidepanel_joinus_background_settings_section',
        'setting' => 'sidepanel_joinus_use_bg_color_checkbox_control_setting',
        'type' => 'checkbox'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_joinus_background_color_control_setting' ,array(
        'label' => 'Background color',
        'section' => 'sidepanel_joinus_background_settings_section',
        'setting' => 'sidepanel_joinus_background_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_joinus_panel_name_header_text_color_control_setting' ,array(
        'label' => 'Panel name header text color',
        'section' => 'sidepanel_joinus_text_settings_section',
        'setting' => 'sidepanel_joinus_panel_name_header_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_joinus_main_header_text_color_control_setting' ,array(
        'label' => 'Main header text color',
        'section' => 'sidepanel_joinus_text_settings_section',
        'setting' => 'sidepanel_joinus_main_header_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_joinus_job_listing_header_text_color_control_setting' ,array(
        'label' => 'Job listing header text color',
        'section' => 'sidepanel_joinus_text_settings_section',
        'setting' => 'sidepanel_joinus_job_listing_header_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_joinus_job_listing_urgent_header_text_color_control_setting' ,array(
        'label' => 'Job listing urgent header text color',
        'section' => 'sidepanel_joinus_text_settings_section',
        'setting' => 'sidepanel_joinus_job_listing_urgent_header_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_joinus_paragraph_section_header_text_color_control_setting' ,array(
        'label' => 'Paragraph sections header text color',
        'section' => 'sidepanel_joinus_text_settings_section',
        'setting' => 'sidepanel_joinus_paragraph_section_header_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_joinus_paragraph_text_color_control_setting' ,array(
        'label' => 'Paragraph text color',
        'section' => 'sidepanel_joinus_text_settings_section',
        'setting' => 'sidepanel_joinus_paragraph_text_color_control_setting'
    )));

    $wp_customize->add_control('sidepanel_joinus_form_height_control_setting', array(
        'label' => 'Text input height (px)',
        'section' => 'sidepanel_joinus_form_settings_section',
        'setting' => 'sidepanel_joinus_form_height_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control('sidepanel_joinus_form_border_radius_control_setting', array(
        'label' => 'Text input border radius (px)',
        'section' => 'sidepanel_joinus_form_settings_section',
        'setting' => 'sidepanel_joinus_form_border_radius_control_setting',
        'type' => 'text'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_joinus_form_background_color_control_setting', array(
        'label' => 'Text input background color',
        'section' => 'sidepanel_joinus_form_settings_section',
        'setting' => 'sidepanel_joinus_form_background_color_control_setting',
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_joinus_form_boxshadow_color_control_setting', array(
        'label' => 'Text input box shadow color',
        'section' => 'sidepanel_joinus_form_settings_section',
        'setting' => 'sidepanel_joinus_form_boxshadow_color_control_setting',
    )));

    $wp_customize->add_control('sidepanel_joinus_number_of_job_listings_control_setting', array(
        'label' => 'Number of job listings',
        'section' => 'sidepanel_joinus_joblistings_settings_section',
        'setting' => 'sidepanel_joinus_number_of_job_listings_control_setting',
        'type' => 'text'
    ));

    function JoinUsGetCareerListingName($index){
        if(strlen(get_theme_mod('sidepanel_joinus_joblisting_name_' . $index . '_control_setting')) == 0){
            return 'Career Title';
        }else{
            return get_theme_mod('sidepanel_joinus_joblisting_name_' . $index . '_control_setting');
        }
    }

    function JoinUsGetCareerListingIsUrgent($index){
        if(get_theme_mod('sidepanel_joinus_is_urgent_job_checkbox_' . $index . '_control_setting')){
            return  'urgent';
        }else{
            return  '';
        }
    }

    for($i = 1; $i <= intval(JoinUsGetNumberOfJobListings()); $i++){
        $wp_customize->add_setting('sidepanel_joinus_is_urgent_job_checkbox_' . $i . '_control_setting');

        $wp_customize->add_setting('sidepanel_joinus_joblisting_name_' . $i . '_control_setting', array(
            'default' => ''
        ));

        $wp_customize->add_control('sidepanel_joinus_is_urgent_job_checkbox_' . $i . '_control_setting', array(
            'label' => 'Urgent',
            'section' => 'sidepanel_joinus_joblistings_settings_section',
            'setting' => 'sidepanel_joinus_is_urgent_job_checkbox_' . $i . '_control_setting',
            'type' => 'checkbox'
        ));

        $wp_customize->add_control('sidepanel_joinus_joblisting_name_' . $i . '_control_setting', array(
            'label' => 'Job listing name ' . $i,
            'section' => 'sidepanel_joinus_joblistings_settings_section',
            'setting' => 'sidepanel_joinus_joblisting_name_' . $i . '_control_setting',
            'type' => 'text'
        ));

        if(!file_exists(THEMEROOTSTATIC . '/CareerListing_' . $i . '.php') || GetAdvancedSettingJoinUsAllowCareerListingTextSeeding()){
            $file = fopen(THEMEROOTSTATIC . '/CareerListing_' . $i . '.php', 'w') or exit('Unable to open | create file');

            $htmlContent = '<div>' . "\n" .
            "\t" . '<h2 class="click-toggle" id="' . JoinUsGetCareerListingName($i) . '" class="' . 'urgent' . '">' . JoinUsGetCareerListingName($i) . '</h2>' . "\n" .
            "\t" . '<div class="toggle">' . "\n" .
            "\t\t" . '<p>' . "\n" .
            "\t\t\t" . 'Who were looking for - Brief job description' . "\n" .
            "\t\t" . '</p>' . "\n" .
            "\t\t" . '<p><b>Responsibilities:</b><br /></p>' . "\n" .
            "\t\t\t" . '<ul class="jobRequirments">' . "\n" .
            "\t\t\t" . '<li>Responsibility 1</li>' . "\n" .
            "\t\t\t" . '<li>Responsibility 2</li>' . "\n" .
            "\t\t\t" . '<li>Responsibility 3</li>' . "\n" .
            "\t\t" . '</ul>' . "\n" .
            "\t\t" . '<p><b>Results/Accountabilities:</b><br /></p>' . "\n" .
            "\t\t" . '<ul>' . "\n" .
            "\t\t\t" . '<li>Employee job expectation 1</li>' . "\n" .
            "\t\t\t" . '<li>Employee job expectation 2</li>' . "\n" .
            "\t\t\t" . '<li>Employee job expectation 3</li>' . "\n" .
            "\t\t" . '</ul>' . "\n" .
            "\t\t" . '<p><b>Qualifications:</b><br /></p>' . "\n" .
            "\t\t" . '<ul>' . "\n" .
            "\t\t\t" . '<li>Qualification 1</li>' . "\n" .
            "\t\t\t" . '<li>Qualification 2</li>' . "\n" .
            "\t\t\t" . '<li>Qualification 3</li>' . "\n" .
            "\t\t" . '</ul>' . "\n" .
            "\t\t" . '<p><b>Benefits Package:</b><br /></p>' . "\n" .
            "\t\t" . '<ul>' . "\n" .
            "\t\t\t" . '<li>Medical Package: Dental, Vision, Life insurance</li>' . "\n" .
            "\t\t\t" . '<li>Will provide in house training and professional training (industry certification)</li>' . "\n" .
            "\t\t\t" . '<li>Full Commission Sales</li>' . "\n" .
            "\t\t" . '</ul>' . "\n" .
            "\t\t" . '<div class="thankyou" id="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '-thankyou-message" style="display: block !important;"><p>*Required</p></div>' . "\n" .
            "\t\t" . '<form method="post" action="JoinUs.php" enctype="multipart/form-data">' . "\n" .
            "\t\t\t" . '<div class="form-horizontal">' . "\n" .
            "\t\t\t\t" . '<div class="form-group">' . "\n" .
            "\t\t\t\t\t" . '<div class="col-xs-12">' . "\n" .
            "\t\t\t\t\t\t" . '<input type="text" class="form-control" id="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '-name" placeholder="Your name*" name="applicantName"/>' . "\n" .
            "\t\t\t\t\t" . '</div>' . "\n" .
            "\t\t\t\t" . '</div>' . "\n" .
            "\t\t\t\t" . '<div class="form-group">' . "\n" .
            "\t\t\t\t\t" . '<div class="col-md-6">' . "\n" .
            "\t\t\t\t\t\t" . '<input type="email" class="form-control" id="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '-email" placeholder="Your e-mail*" name="applicantE-mail"/>' . "\n" .
            "\t\t\t\t\t" . '</div>' . "\n" .
            "\t\t\t\t\t" . '<div class="col-md-6">' . "\n" .
            "\t\t\t\t\t\t" . '<input type="tel" class="form-control" id="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '-phone" placeholder="Your phone number*"  name="applicantPhoneNumber"/>' . "\n" .
            "\t\t\t\t\t" . '</div>' . "\n" .
            "\t\t\t\t" . '</div>' . "\n" .
            "\t\t\t\t" . '<div class="form-group">' . "\n" .
            "\t\t\t\t\t" . '<div class="col-xs-12">' . "\n" .
            "\t\t\t\t\t\t" . '<textarea class="form-control" rows="3" placeholder="Your message" id="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '-message" name="applicantMessage"></textarea>' . "\n" .
            "\t\t\t\t\t" . '</div>' . "\n" .
            "\t\t\t\t" . '</div>' . "\n" .
            "\t\t\t\t" . '<div class="form-group">' . "\n" .
            "\t\t\t\t\t" . '<div class="col-xs-12">' . "\n" .
            "\t\t\t\t\t\t" . '<input class="hidden-xs hidden-sm" type="file" id="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '-upload">' . "\n" .
            "\t\t\t\t\t\t" . '<input class="hidden-md hidden-lg" disabled type="file" id="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '-upload" value="Desktop only">' . "\n" .
            "\t\t\t\t\t\t" . '<p class="help-block visible-xs visible-sm">File uploads on desktop only</p>' . "\n" .
            "\t\t\t\t\t\t" . '<p class="help-block">Docx, Doc and PDF - 5mb max</p>' . "\n" .
            "\t\t\t\t\t\t" . '<input type="button" onclick="SendApplication(\'' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '\');" name="submitButton"  value="Apply"/>' . "\n" .
            "\t\t\t\t\t" . '</div>' . "\n" .
            "\t\t\t\t" . '</div>' . "\n" .
            "\t\t\t\t" . '<p>Thank you for considering boulevard for your career!</p>' . "\n" .
            "\t\t\t\t" . '<input style="display:none" id="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '-position" value="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '" name="JobTitle" readonly/>' . "\n" .
            "\t\t\t\t" . '<input style="display:none" id="' . str_replace(" ", "", JoinUsGetCareerListingName($i)) . '-honeypot" value="" name="honeypot"' . "\n" .
            "\t\t\t" . '</div>' . "\n" .
            "\t\t" . '</form>' . "\n" .
            "\t" . '</div>' . "\n" .
            '</div>' . "\n";

            fwrite($file, $htmlContent);
            fclose($file);
        }
    }

    /*
    *   Request Project side panel settings
    */

    $wp_customize->add_panel('sidepanel_requestproject_panel_settings_section', array(
        'title' => 'Request Project side panel',
        'description' => 'Settings for the "Request Project" side panel',
        'priority' => 10
    ));

    $wp_customize->add_section('sidepanel_requestproject_background_settings_section', array(
        'title' => 'Background',
        'panel' => 'sidepanel_requestproject_panel_settings_section',
        'priority' => 10
    ));

    $wp_customize->add_section('sidepanel_requestproject_form_controls_settings_section', array(
        'title' => 'Form controls',
        'panel' => 'sidepanel_requestproject_panel_settings_section',
        'priority' => 10
    ));

    $wp_customize->add_section('sidepanel_requestproject_text_settings_section', array(
        'title' => 'Text',
        'panel' => 'sidepanel_requestproject_panel_settings_section',
        'priority' => 10
    ));

    $wp_customize->add_setting('sidepanel_requestproject_background_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_requestproject_input_height_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_requestproject_border_radius_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_requestproject_text_input_background_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_requestproject_box_shadow_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_requestproject_panel_name_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_requestproject_main_header_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_requestproject_paragraph_text_color_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_setting('sidepanel_requestproject_background_color_control_setting', array(
        'default' => 'none'
    ));

    $wp_customize->add_setting('sidepanel_requestproject_use_bg_color_checkbox_control_setting');

    $wp_customize->add_setting('sidepanel_requestproject_submit_btn_image_control_setting', array(
        'default' => ''
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sidepanel_requestproject_background_control_setting', array(
        'label' => 'Background image',
        'section' => 'sidepanel_requestproject_background_settings_section',
        'setting' => 'sidepanel_requestproject_background_control_setting'
    )));

    $wp_customize->add_control('sidepanel_requestproject_use_bg_color_checkbox_control_setting', array(
        'label' => 'Use background color',
        'section' => 'sidepanel_requestproject_background_settings_section',
        'setting' => 'sidepanel_requestproject_use_bg_color_checkbox_control_setting',
        'type' => 'checkbox'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_requestproject_background_color_control_setting', array(
        'label' => 'Background Color',
        'section' => 'sidepanel_requestproject_background_settings_section',
        'setting' => 'sidepanel_requestproject_background_color_control_setting'
    )));

    $wp_customize->add_control('sidepanel_requestproject_input_height_control_setting', array(
        'label' => 'Text input height (px)',
        'section' => 'sidepanel_requestproject_form_controls_settings_section',
        'setting' => 'sidepanel_requestproject_input_height_control_setting'
    ));

    $wp_customize->add_control('sidepanel_requestproject_border_radius_control_setting', array(
        'label' => 'Text input border radius (px)',
        'section' => 'sidepanel_requestproject_form_controls_settings_section',
        'setting' => 'sidepanel_requestproject_border_radius_control_setting'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_requestproject_text_input_background_color_control_setting', array(
        'label' => 'Text input background color',
        'section' => 'sidepanel_requestproject_form_controls_settings_section',
        'setting' => 'sidepanel_requestproject_text_input_background_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_requestproject_box_shadow_color_control_setting', array(
        'label' => 'Text input box shadow color',
        'section' => 'sidepanel_requestproject_form_controls_settings_section',
        'setting' => 'sidepanel_requestproject_box_shadow_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_requestproject_panel_name_text_color_control_setting', array(
        'label' => 'Panel name header text color',
        'section' => 'sidepanel_requestproject_text_settings_section',
        'setting' => 'sidepanel_requestproject_panel_name_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_requestproject_main_header_text_color_control_setting', array(
        'label' => 'Main header text color',
        'section' => 'sidepanel_requestproject_text_settings_section',
        'setting' => 'sidepanel_requestproject_main_header_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidepanel_requestproject_paragraph_text_color_control_setting', array(
        'label' => 'Paragraph text color',
        'section' => 'sidepanel_requestproject_text_settings_section',
        'setting' => 'sidepanel_requestproject_paragraph_text_color_control_setting'
    )));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sidepanel_requestproject_submit_btn_image_control_setting', array(
        'label' => 'Submit button image',
        'section' => 'sidepanel_requestproject_form_controls_settings_section',
        'setting' => 'sidepanel_requestproject_submit_btn_image_control_setting'
    )));

    /*
    *   Advanced settings
    */
    $wp_customize->add_panel('advanced_panel', array(
        'title' => 'Advanced Settings',
        'description' => 'Advanced settings - Only use these if your know what you are doing.',
        'priority' => 10
    ));

    $wp_customize->add_section('advanced_settings_section', array(
        'title' => 'Settings',
        'panel' => 'advanced_panel',
        'priority' => 10
    ));

    /*
    * Project advanced settings
    */

    $wp_customize->add_setting('advanced_project_enable_modal_text_seeding_control_setting');

    $wp_customize->add_control('advanced_project_enable_modal_text_seeding_control_setting', array(
        'label' => 'Enable modal text seeding (Project page)',
        'section' => 'advanced_settings_section',
        'setting' => 'advanced_project_enable_modal_text_seeding_control_setting',
        'type' => 'checkbox'
    ));

    /*
    *   Team advanced settings
    */

    $wp_customize->add_setting('advanced_team_enable_modal_text_seeding_control_setting');

    $wp_customize->add_control('advanced_team_enable_modal_text_seeding_control_setting', array(
        'label' => 'Enable modal text seeding (Team page)',
        'section' => 'advanced_settings_section',
        'setting' => 'advanced_team_enable_modal_text_seeding_control_setting',
        'type' => 'checkbox'
    ));

    /*
    *   Join Us side panel
    */

    $wp_customize->add_setting('advanced_joinus_careerlisting_enable_text_seeding_control_setting');

    $wp_customize->add_control('advanced_joinus_careerlisting_enable_text_seeding_control_setting', array(
        'label' => 'Enable career listing seeding',
        'section' => 'advanced_settings_section',
        'setting' => 'advanced_joinus_careerlisting_enable_text_seeding_control_setting',
        'type' => 'checkbox'
    ));
}

/*
*   Getter functions for all settings
*/

/*
*   Globals
*/

function GetGlobalMasthead(){
    if(strlen(get_theme_mod('globals_masthead_control_setting')) == 0){
        return WPMEDIA . '/BLVDMasthead.png';
    }else{
        return get_theme_mod('globals_masthead_control_setting');
    }
}

function GetGlobalMobileMasthead(){
    if(strlen(get_theme_mod('globals_mobile_masteahd_control_setting')) == 0){
        return WPMEDIA . '/BlvdMobile.png';
    }else{
        return get_theme_mod('globals_mobile_masteahd_control_setting');
    }
}

function GetGlobalSidePanelExitButton(){
    if(strlen(get_theme_mod('globals_sidepanel_exitbtn_image_control_setting')) == 0){
        return WPMEDIA . '/SidrExit.png';
    }else{
        return get_theme_mod('globals_sidepanel_exitbtn_image_control_setting');
    }
}

function GetGlobalSlidFadeBackgroundColor(){
    if(strlen(get_theme_mod('globals_slide_fade_background_color_control_setting')) == 0){
        return '#FAD000';
    }else{
        return get_theme_mod('globals_slide_fade_background_color_control_setting');
    }
}

function GetNavBarFacebookSprite(){
    if(strlen(get_theme_mod('global_navbar_facebook_sprite_control_setting')) == 0){
        return WPMEDIA . '/Facebook.png';
    }else{
         return get_theme_mod('global_navbar_facebook_sprite_control_setting');
    }
}

function GetNavBarTwitterSprite(){
    if(strlen(get_theme_mod('global_navbar_twitter_sprite_control_setting')) == 0){
        return WPMEDIA . '/Twitter.png';
    }else{
        return get_theme_mod('global_navbar_twitter_sprite_control_setting');
    }
}

function GetNavBarPinterestSprite(){
    if(strlen(get_theme_mod('global_navbar_pinterest_sprite_control_setting')) == 0){
        return WPMEDIA . '/Pinte.png';
    }else{
        return get_theme_mod('global_navbar_pinterest_sprite_control_setting');
    }
}

function GetNavBarInstageam(){
    if(strlen(get_theme_mod('global_navbar_instagram_sprite_control_setting')) == 0){
        return WPMEDIA . '/Instagram.png';
    }else{
        return get_theme_mod('global_navbar_instagram_sprite_control_setting');
    }
}

/*
*   Get footer sprites
*/

function GetFooterFacebookSprite(){
    if(strlen(get_theme_mod('global_footer_facebook_sprite_control_setting')) == 0){
        return WPMEDIA . '/Facebook.png';
    }else{
        return get_theme_mod('global_footer_facebook_sprite_control_setting');
    }
}

function GetFooterTwitterSprite(){
    if(strlen(get_theme_mod('global_footer_twitter_sprite_control_setting')) == 0){
        return WPMEDIA . '/Twitter.png';
    }else{
        return get_theme_mod('global_footer_twitter_sprite_control_setting');
    }
}

function GetFooterPinterestSprite(){
    if(strlen(get_theme_mod('global_footer_pinterest_sprite_control_setting')) == 0){
        return WPMEDIA . '/Pinte.png';
    }else{
        return get_theme_mod('global_footer_pinterest_sprite_control_setting');
    }
}

function GetFooterInstageam(){
    if(strlen(get_theme_mod('global_footer_instagram_sprite_control_setting')) == 0){
        return WPMEDIA . '/Instagram.png';
    }else{
        return get_theme_mod('global_footer_instagram_sprite_control_setting');
    }
}

/*
*   Get contact page sprites
*/

function GetContactPageFacebookSprite(){
    if(strlen(get_theme_mod('global_contactpage_facebook_sprite_control_setting')) == 0){
         return WPMEDIA . '/Facebook.png';
    }else{
        return get_theme_mod('global_contactpage_facebook_sprite_control_setting');
    }
}

function GetContactPageTwitterSprite(){
    if(strlen(get_theme_mod('global_contactpage_twitter_sprite_control_setting')) == 0){
        return WPMEDIA . '/Twitter.png';
    }else{
        return get_theme_mod('global_contactpage_twitter_sprite_control_setting');
    }
}

function GetContactPagePinterestSprite(){
    if(strlen(get_theme_mod('global_contactpage_pinterest_sprite_control_setting')) == 0){
        return WPMEDIA . '/Pinte.png';
    }else{
        return get_theme_mod('global_contactpage_pinterest_sprite_control_setting');
    }
}

function GetContactPageInstageam(){
    if(strlen(get_theme_mod('global_contactpage_instagram_sprite_control_setting')) == 0){
        return WPMEDIA . '/Instagram.png';
    }else{
        return get_theme_mod('global_contactpage_instagram_sprite_control_setting');
    }
}

/*
*   Get sidr panel sprites
*/

function GetSidePanelFacebook(){
    if(strlen(get_theme_mod('global_sidepanel_facebook_sprite_control_setting')) == 0){
        return WPMEDIA . '/Facebook.png';
    }else{
        return get_theme_mod('global_sidepanel_facebook_sprite_control_setting');
    }
}

function GetSidePanelTwitter(){
    if(strlen(get_theme_mod('global_sidepanel_twitter_sprite_control_setting')) == 0){
        return WPMEDIA . '/Twitter.png';
    }else{
        return get_theme_mod('global_sidepanel_twitter_sprite_control_setting');
    }
}

function GetSidePanelPinterest(){
    if(strlen(get_theme_mod('global_sidepanel_pinterest_sprite_control_setting')) == 0){
        return WPMEDIA . '/Pinte.png';
    }else{
        return get_theme_mod('global_sidepanel_pinterest_sprite_control_setting');
    }
}

function GetSidePanelInstagram(){
    if(strlen(get_theme_mod('global_sidepanel_instagram_sprite_control_setting')) == 0){
        return WPMEDIA . '/Instagram.png';
    }else{
        return get_theme_mod('global_sidepanel_instagram_sprite_control_setting');
    }
}


/*
*   Get sprite link destinations
*/

function GetSocialIconLink1Destination(){
    if(strlen(get_theme_mod('globals_socialicon_linkdest1_control_setting'))== 0){
        return 'https://www.facebook.com/creativeboulevard';
    }else{
        return get_theme_mod('globals_socialicon_linkdest1_control_setting');
    }
}

function GetSocialIconLink2Destination(){
    if(strlen(get_theme_mod('globals_socialicon_linkdest2_control_setting')) == 0){
        return 'https://twitter.com/BoulevardAd';
    }else{
        return get_theme_mod('globals_socialicon_linkdest2_control_setting');
    }
}

function GetSocialIconLink3Destination(){
    if(strlen(get_theme_mod('globals_socialicon_linkdest3_control_setting')) == 0){
        return 'https://www.pinterest.com/boulevardad/';
    }else{
        return get_theme_mod('globals_socialicon_linkdest3_control_setting');
    }
}

function GetSocialIconLink4Destination(){
    if(strlen(get_theme_mod('globals_socialicon_linkdest4_control_setting')) == 0){
        return 'https://instagram.com/creativeboulevard/';
    }else{
        return get_theme_mod('globals_socialicon_linkdest4_control_setting');
    }
}

/*
*   Index getter function
*/

function GetIndexOurWorkPage(){
    $ourWorkPage = get_page_by_title('Our Work');
    return get_page_link($ourWorkPage->ID);
}

function GetIndexAboutPage(){
    $aboutPage = get_page_by_title('About');
    return get_page_link($aboutPage->ID);
}

/*
*   Index backstrech getters
*/

function GetIndexBackstretchDuration(){
    if(strlen(get_theme_mod('backstretch_duration_control_setting')) == 0){
        return 4000;
    }else{
        return get_theme_mod('backstretch_duration_control_setting');
    }
}

function GetIndexBackstretchFade(){
    if(strlen(get_theme_mod('backstretch_fade_control_setting')) == 0){
        return 750;
    }else{
        return get_theme_mod('backstretch_fade_control_setting');
    }
}

/*
*   Projects page getter functions
*/

function GetWorkNavbarMastaheadLinkDestination(){
    if(strlen(get_theme_mod('work_navbar_masthead_link_destination_control_setting')) == 0){
        return get_home_url();
    }else{
        return get_theme_mod('work_navbar_masthead_link_destination_control_setting');
    }
}

function GetWorkBackstretchDuration(){
    if(strlen(get_theme_mod('work_backstretch_duration_control_setting')) == 0){
        return 4000;
    }else{
        return get_theme_mod('work_backstretch_duration_control_setting');
    }
}

function GetWorkBackstretchFade(){
    if(strlen(get_theme_mod('work_backstretch_fade_control_setting')) == 0){
        return 750;
    }else{
        return get_theme_mod('work_backstretch_fade_control_setting');
    }
}

function GetWorkNumberOfProjectImages(){
    if(strlen(get_theme_mod('work_project_numberof_imagerows_control_setting')) == 0){
        return 10;
    }else{
        return get_theme_mod('work_project_numberof_imagerows_control_setting');
    }
}

/*
* Project page Misc functions
*/


/*Functions for showing/hiding archived images based on screen size*/
function CalculateVisibility($row, $col, $numCols){
    $position = ($col - ($row * $numCols));
    return SetVisibility($position);
}

function SetVisibility($position){
    switch($position){
        case 3:
        return " hidden-xs ";
        break;
        case 4:
        return " hidden-xs hidden-sm";
        break;
        case 5:
        return " hidden-xs hidden-sm hidden-md ";
        break;
    }
}

/*
*   About page getter functions
*/

function GetAboutFirstSlideBg(){
    if(strlen(get_theme_mod('about_slide1_background_control_setting')) == 0){
        return WPMEDIA . '/bg-1-about.jpg';
    }else{
        return get_theme_mod('about_slide1_background_control_setting');
    }
}

function GetAboutSecondSlideBg(){
    if(strlen(get_theme_mod('about_slide2_background_control_setting')) == 0){
        return WPMEDIA . '/bg-2.jpg';
    }else{
        return get_theme_mod('about_slide2_background_control_setting');
    }
}

function GetAboutRequestProjTextFontSize(){
    return get_theme_mod('about_request_font_size_control_setting');
}

function GetAboutMainHeaderTextFontSize(){
    return get_theme_mod('about_mainheader_font_size_control_setting');
}

function GetAboutFirstSlideTextBackgroundOpacity(){
    if(strlen(get_theme_mod('about_slide1_background_text_opacity_control_setting')) == 0){
        return 0.5;
    }
    else{
        return get_theme_mod('about_slide1_background_text_opacity_control_setting');
    }
}

function GetAboutWhoWeAreHeaderTextFontSize(){
    return get_theme_mod('about_whoweare_header_font_size_control_setting');
}

function GetAboutWhoWeAreParagraphTextFontSize(){
    return get_theme_mod('about_whoweare_paragraph_font_size_control_setting');
}

function GetAboutWhatWeDoHeaderTextFontSize(){
    return get_theme_mod('about_whatwedo_header_font_size_control_setting');
}

function GetAboutWhatWeDoParagraphTextFont(){
    return get_theme_mod('about_whatwedo_paragraph_font_size_control_setting');
}

function GetAboutFooterTextFontSize(){
    return get_theme_mod('about_footer_text_font_size_control_setting');
}

/*
*   Images
*/

function GetAboutMasthead(){
    if(strlen(get_theme_mod('about_mastehead_image_control_setting')) == 0){
        return WPMEDIA . '/BLVDMasthead.png';
    }else{
        return get_theme_mod('about_mastehead_image_control_setting');
    }
}

function GetAboutRequestProjIcon(){
    if(strlen(get_theme_mod('about_request_image_control_setting')) == 0){
        return WPMEDIA . '/ArrowGlyph.png';
    }else{
        return get_theme_mod('about_request_image_control_setting');
    }
}

function GetAboutMenuButton(){
    if(strlen(get_theme_mod('about_menubtn_image_control_setting')) == 0){
        return WPMEDIA . '/MenuButton.png';
    }else{
        return get_theme_mod('about_menubtn_image_control_setting');
    }
}

/*
* Links
*/

function GetAboutMastheadLinkDestination(){
    if(strlen(get_theme_mod('about_masthead_link_destination_control_setting')) == 0){
        return get_home_url();
    }else{
        return get_theme_mod('about_masthead_link_destination_control_setting');
    }
}

/*
*   Team settings
*/

function GetTeamBackground(){
    if(strlen(get_theme_mod('team_slide1_backgroundimage_control_setting')) == 0){
        return WPMEDIA . '/bg-5.jpg';
    }else{
        return get_theme_mod('team_slide1_backgroundimage_control_setting');
    }
}

/*
* Links
*/

function GetTeamNavbarMastheadLinkDestination(){
    if(strlen(get_theme_mod('team_navbar_masthead_link_destination_control_setting')) == 0){
        return get_home_url();
    }else{
        return get_theme_mod('team_navbar_masthead_link_destination_control_setting');
    }
}

/*
*   Images
*/

function GetTeamMenuButton(){
    if(strlen(get_theme_mod('team_menubtn_control_setting')) == 0){
        return WPMEDIA . '/MenuButton.png';
    }else{
        return get_theme_mod('team_menubtn_control_setting');
    }
}

function GetTeamDownArrow(){
    if(strlen(get_theme_mod('team_downarrow_control_setting')) == 0){
        return WPMEDIA . '/DownArrow.png';
    }else{
        return get_theme_mod('team_downarrow_control_setting');
    }
}

function GetTeamNavbarMasthead(){
    if(strlen(get_theme_mod('team_downarrow_control_setting')) == 0){
        return WPMEDIA . '/BoulevardTeam.png';
    }else{
        return get_theme_mod('team_downarrow_control_setting');
    }
}

function GetTeamNavbarMenuButton(){
    if(strlen(get_theme_mod('team_navbar_menubtn_control_setting')) == 0){
        return WPMEDIA . '/MenuButtonGrey.png';
    }else{
        return get_theme_mod('team_navbar_menubtn_control_setting');
    }
}

function GetTeamWorkspaceImage(){
    if(strlen(get_theme_mod('team_workspace_image_control_setting')) == 0){
        return 'http://www.creativeboulevard.com/wp-content/themes/Boulevard/src/images/team/tour.jpg'; //return WPMEDIA . '/tour.jpg';
    }else{
        return get_theme_mod('team_workspace_image_control_setting');
    }
}

function GetTeamJoinTeamImage(){
    if(strlen(get_theme_mod('team_jointeam_image_control_setting')) == 0){
        return 'http://www.creativeboulevard.com/wp-content/themes/Boulevard/src/images/team/join.jpg'; //return WPMEDIA . '/join.jpg';
    }else{
        return get_theme_mod('team_jointeam_image_control_setting');
    }
}

/*
*   Colors
*/

function GetTeamFirstSlideHeaderColor(){
    return get_theme_mod('team_firstslide_text_color_control_setting');
}


function GetTeamSecondSlideHeaderColor(){
    return get_theme_mod('team_secondslide_header_text_color_control_setting');
}

function GetTeamSecondSlideBgColor(){
    return get_theme_mod('team_secondslide_background_color_control_setting');
}

function GetTeamEmpoyeeNameColor(){
    return get_theme_mod('team_employee_name_textcolor_control_setting');
}

function GetTeamEmployeeEmail($empNumber){
    return get_theme_mod('team_emplyoee_' . $empNumber . 'email_control_setting');
}

function GetTeamEmployeeEmailColor(){
    return get_theme_mod('team_employee_email_textcolor_control_setting');
}

function GetTeamEmployeeEmailHoverColor(){
    return get_theme_mod('team_employee_email_hover_textcolor_control_setting');
}

function GetTeamWorkspaceColor(){
    return get_theme_mod('team_workspace_textcolor_control_setting');
}

function GetTeamJoinTeamColor(){
    return get_theme_mod('team_joinus_text_color_control_setting');
}

function GetTeamWorkspaceJoinBgColor(){
    return get_theme_mod('team_workspace_join_area_background_color');
}

function GetTeamFooterBgColor(){
    return get_theme_mod('team_footer_background_color');
}

function GetTeamFooterTextColor(){
    return get_theme_mod('team_footer_text_fontsize_control_setting');
}

/*
*   Font size
*/

function GetTeamFirstSlideHeaderFonstSize(){
    return get_theme_mod('team_firstslide_fontsize_control_setting');
}

function GetTeamEmployeeNameFontSize(){
    return get_theme_mod('team_employee_name_fontsize_control_setting');
}

function GetTeamEmployeeEmailFontSize(){
    return get_theme_mod('team_employee_email_fontsize_control_setting');
}

function GetTeamWorkspaceFontSize(){
    return get_theme_mod('team_workspace_fontsize_control_setting');
}

function GetTeamJoinTeamFontSize(){
    return get_theme_mod('team_joinus_fontsize_control_setting');
}

function GetTeamFooterTextFontSize(){
    return get_theme_mod('team_footer_text_fontsize_control_setting');
}

/*
*   Team Images
*/

function GetTeamNumberOfImageRows(){
   if(strlen(get_theme_mod('team_numberrows_control_setting')) == 0){
        return 2;
   }else{
        return get_theme_mod('team_numberrows_control_setting');
   }
}

/*
*   Team mic getter functions
*/

function GetTeamBlvdOfficePage(){
    $officePage = get_page_by_title('BLVD Office');
    return get_page_link($officePage->ID);
}

/*
*   Office page
*/

function GetOfficeNavbarMasthead(){
    if(strlen(get_theme_mod('office_navbar_mastahead_control_setting')) == 0){
        return WPMEDIA . '/BoulevardOffice.png';
    }else{
        return get_theme_mod('office_navbar_mastahead_control_setting');
    }
}

function GetOfficeNavbarMenu(){
    if(strlen(get_theme_mod('office_navbar_menubtn_control_setting')) == 0){
        return WPMEDIA . '/MenuButtonGrey.png';
    }else{
        return get_theme_mod('office_navbar_menubtn_control_setting');
    }
}

function GetOfficeMenuButton(){
    if(strlen(get_theme_mod('office_menubtn_image_control_setting')) == 0){
        return WPMEDIA . '/MenuButton.png';
    }else{
        return get_theme_mod('office_menubtn_image_control_setting');
    }
}

function GetOfficeDownArrow(){
    if(strlen(get_theme_mod('office_downarrow_image_control_setting')) == 0){
        return WPMEDIA . '/DownArrow.png';
    }else{
        return get_theme_mod('office_downarrow_image_control_setting');
    }
}

function GetOfficeImage1(){
    if(strlen(get_theme_mod('office_image1_control_setting')) == 0){
        return WPMEDIA . '/Office1.jpg';
    }else{
        return get_theme_mod('office_image1_control_setting');
    }
}

function GetOfficeImage2(){
    if(strlen(get_theme_mod('office_image2_control_setting')) == 0){
        return WPMEDIA . '/Office2.jpg';
    }else{
        return get_theme_mod('office_image2_control_setting');
    }
}

function GetOfficeImage3(){
    if(strlen(get_theme_mod('office_image3_control_setting')) == 0){
        return WPMEDIA . '/Office3.jpg';
    }else{
        return get_theme_mod('office_image3_control_setting');
    }
}

function GetOfficeImage4(){
    if(strlen(get_theme_mod('office_image4_control_setting')) == 0){
        return WPMEDIA . '/Office4.jpg';
    }else{
        return get_theme_mod('office_image4_control_setting');
    }
}

function GetOfficeImage5(){
    if(strlen(get_theme_mod('office_image5_control_setting')) == 0){
        return WPMEDIA . '/Office5.jpg';
    }else{
        return get_theme_mod('office_image5_control_setting');
    }
}

function GetOfficeImage6(){
    if(strlen(get_theme_mod('office_image6_control_setting')) == 0){
        return WPMEDIA . '/Office6.jpg';
    }else{
        return get_theme_mod('office_image6_control_setting');
    }
}

function GetOfficeImage7(){
    if(strlen(get_theme_mod('office_image7_control_setting')) == 0){
        return WPMEDIA . '/Office7.jpg';
    }else{
        return get_theme_mod('office_image7_control_setting');
    }
}

/*
*   Font
*/

function GetOfficeMainHeaderFont(){
    return get_theme_mod('office_firstslide_font_size_control_setting');
}

function GetOfficeFooterTextFont(){
    return get_theme_mod('office_footer_text_font_size_control_setting');
}

/*
*   Color
*/

function GetOfficeMainHeaderColor(){
    return get_theme_mod('office_firstslide_text_color_control_setting');
}

function GetOfficeNavBarColor(){
    return get_theme_mod('office_navbar_color_control_setting');
}

function GetOfficeFooterBackgroundColor(){
    return get_theme_mod('office_footer_background_color_control_setting');
}

function GetOfficeFooterTextColor(){
    return get_theme_mod('office_footertext_color_control_setting');
}

/*
*   Links
*/

function GetOfficeNavbarMastheadLink(){
    if(strlen(get_theme_mod('office_navbar_masthead_link_destination_control_setting')) == 0){
        return get_home_url();
    }else{
        return get_theme_mod('office_navbar_masthead_link_destination_control_setting');
    }
}

/*
*   Contact page settings
*/

function GetContactFirstSlideBackground(){
    if(strlen(get_theme_mod('contact_firstslide_background_image_control_setting')) == 0){
        return WPMEDIA . '/bg-8.jpg';
    }else{
        return get_theme_mod('contact_firstslide_background_image_control_setting');
    }
}

function GetContactFirstSlideMenuButton(){
    if(strlen(get_theme_mod('contact_firstslide_menubtn_control_setting')) == 0){
        return WPMEDIA . '/MenuButton.png';
    }else{
        return get_theme_mod('contact_firstslide_menubtn_control_setting');
    }
}

function GetContactFirstSlideDownArrow(){
    if(strlen(get_theme_mod('contact_downarrow_image_control_setting')) == 0){
        return WPMEDIA . '/DownArrow.png';
    }else{
        return get_theme_mod('contact_downarrow_image_control_setting');
    }
}

function GetContactNavbarMasthead(){
    if(strlen(get_theme_mod('contact_navbar_masthead_control_setting')) == 0){
        return WPMEDIA . '/BoulevardContact.png';
    }else{
        return get_theme_mod('contact_navbar_masthead_control_setting');
    }
}

function GetContactNavbarMenuButton(){
    if(strlen(get_theme_mod('contact_navbar_menubtn_image_control_setting')) == 0){
        return WPMEDIA . '/MenuButtonGrey.png';
    }else{
        return get_theme_mod('contact_navbar_menubtn_image_control_setting');
    }
}

/*
*   Color
*/

function GetContactFirstSlideHeaderColor(){
    return get_theme_mod('contact_firstslide_header_color_control_setting');
}

function GetContactFirstSlideParagraphColor(){
    return get_theme_mod('contact_firstslide_paragraph_color_control_setting');
}

function GetContactNavbarColor(){
    return get_theme_mod('contact_navbar_color_control_setting');
}

function GetContactSecondSlideBackgroundColor(){
    return get_theme_mod('contact_slide2_background_color_control_setting');
}

function GetContactSecondSlideContactHeaderColor(){
    return get_theme_mod('contact_slide2_left_contactheader_color_control_setting');
}

function GetContactSecondSlideGiveCallHeaderColor(){
    return get_theme_mod('contact_slide2_left_givecall_color_control_setting');
}

function GetContactSecondSlideFollowUsHeaderColor(){
    return get_theme_mod('contact_slide2_left_followus_color_control_setting');
}

function GetContactSendMessageHeaderColor(){
    return get_theme_mod('contact_slide_left_sendamessage_color_control_setting');
}

function GetContactParagaphsColor(){
    return get_theme_mod('contact_paragraph_color_control_setting');
}

function GetContactFooterBackgroundColor(){
    return get_theme_mod('footer_background_color_control_setting');
}

function GetContactFooterTextColor(){
    return get_theme_mod('footer_text_color_control_setting');
}

/*
*   Font
*/

function GetContactMainHeaderFontSize(){
    return get_theme_mod('contact_mainheader_fontsize_control_setting');
}

function GetContactSecondaryHeaderFontSize(){
    return get_theme_mod('contact_firstslide_secondaryheader_fontsize_control_setting');
}

function GetContactContactFollowUsFontSize(){
    return get_theme_mod('contact_contact_followus_header_fontsize_control_setting');
}

function GetContactSendAMessageFontSize(){
    return get_theme_mod('contact_sendus_amessage_fontsize_control_setting');
}

function GetContactParagraphsFontSize(){
    return get_theme_mod('contact_paragraphs_fontsize_control_setting');
}

function GetContactFooterTextFontSize(){
    return get_theme_mod('contact_footer_fontsize_control_setting');
}

/*
*   Links
*/

function GetContactNavbarMastheadLinkDestintion(){
    if(strlen(get_theme_mod('contact_navbar_masthead_link_destination_control_setting')) == 0){
        return get_home_url();
    }else{
        return get_theme_mod('contact_navbar_masthead_link_destination_control_setting');
    }
}

/*
*   Contact misc getters
*/

function GetContactSubmitButtonImage(){
    if(strlen(get_theme_mod('contact_submit_btn_image_control_setting')) == 0){
        return WPMEDIA . '/SubmitButton.png';
    }else{
        return get_theme_mod('contact_submit_btn_image_control_setting');
    }
}

/*
*   Side bar navigation getters
*/

function GetSidebarBackgroundImage(){
    return get_theme_mod('sidepanel_navigation_background_image_control_setting');
}

function GetSidebarUseBackgroundColorCheckbox(){
    return get_theme_mod('sidepanel_navigation_use_background_color_checkbox_control_setting');
}

function GetSidebarBackgroundColor(){
    return get_theme_mod('sidepanel_navigation_background_color_control_setting');
}

function GetSidebarTextColor(){
    return get_theme_mod('sidepanel_navigation_text_color_control_setting');
}

function GetSidebarTextColorHover(){
    return get_theme_mod('sidepanel_navigation_text_color_hover_control_setting');
}

function GetSidebarSplitterImage(){
    return get_theme_mod('sidepanel_navigation_splitter_image_control_setting');
}

/*
*   Join us panel getters
*/

function JoinUsGetBackgroundImage (){
    if(strlen(get_theme_mod('sidepanel_joinus_background_image_control_setting')) == 0){
        return '';
    }else{
        return get_theme_mod('sidepanel_joinus_background_image_control_setting');
    }
}

function JoinUsGetUseBgColorCheckbox(){
    return get_theme_mod('sidepanel_joinus_use_bg_color_checkbox_control_setting');
}

function JoinUsGetBackgroundColor(){
    if(strlen(get_theme_mod('sidepanel_joinus_background_color_control_setting')) == 0){
          return 'transparent';
    }else{
        return get_theme_mod('sidepanel_joinus_background_color_control_setting');
    }
}

function JoinUsGetPanelNameHeaderTextColor(){
    return get_theme_mod('sidepanel_joinus_panel_name_header_text_color_control_setting');
}

function JoinUsGetMainHeaderTextColor(){
    return get_theme_mod('sidepanel_joinus_main_header_text_color_control_setting');
}

function JoinUsGetParagraphSectionBoldHeaderTextColor(){
    return get_theme_mod('sidepanel_joinus_paragraph_section_header_text_color_control_setting');
}

function JoinUsGetParagraphTextColor(){
    return get_theme_mod('sidepanel_joinus_paragraph_text_color_control_setting');
}

function JoinUsGetTextInputHeight(){
    return get_theme_mod('sidepanel_joinus_form_height_control_setting');
}

function JoinUsGetFormInputBorderRadius(){
    return get_theme_mod('sidepanel_joinus_form_border_radius_control_setting');
}

function JoinUsGetFormInputBackgroundColor(){
    return get_theme_mod('sidepanel_joinus_form_background_color_control_setting');
}

function JoinUsGetFormInputBoxShadowColor(){
    return get_theme_mod('sidepanel_joinus_form_boxshadow_color_control_setting');
}

function JoinUsGetJobListingHeaderTextColor(){
    return get_theme_mod('sidepanel_joinus_job_listing_header_text_color_control_setting');
}

function JoinUsGetNumberOfJobListings(){
    if(strlen(get_theme_mod('sidepanel_joinus_number_of_job_listings_control_setting')) == 0){
        return 1;
    }else{
        return get_theme_mod('sidepanel_joinus_number_of_job_listings_control_setting');
    }
}

function JoinUsGetIsUrgentJobListing(){
    return get_theme_mod('sidepanel_joinus_is_urgent_job_checkbox_control_setting');
}

function JoinUsGetJobListingName(){
    return get_theme_mod('sidepanel_joinus_joblisting_name_control_setting');
}

/*
* Request project getters
*/

function GetRequestBackgroundImage(){
    if(strlen(get_theme_mod('sidepanel_requestproject_background_control_setting')) == 0){
        return '';
    }else{
        return get_theme_mod('sidepanel_requestproject_background_control_setting');
    }
}

function GetRequestTextInputHeight(){
    return get_theme_mod('sidepanel_requestproject_input_height_control_setting');
}

function GetRequestTextInputBorderRadius(){
    return get_theme_mod('sidepanel_requestproject_border_radius_control_setting');
}

function GetRequestTextInputBackgroundColor(){
    return get_theme_mod('sidepanel_requestproject_text_input_background_color_control_setting');
}

function GetRequestTextInputBoxShadowColor(){
    return get_theme_mod('sidepanel_requestproject_box_shadow_color_control_setting');
}

function GetRequestPanelNameHeaderTextColor(){
    return get_theme_mod('sidepanel_requestproject_panel_name_text_color_control_setting');
}

function GetRequestMainHeaderTextColor(){
    return get_theme_mod('sidepanel_requestproject_main_header_text_color_control_setting');
}

function GetRequestParagraphTextColor(){
    return get_theme_mod('sidepanel_requestproject_paragraph_text_color_control_setting');
}

function GetRequestBackgroundColor(){
    return get_theme_mod('sidepanel_requestproject_background_color_control_setting');
}

function GetRequestUseBackgroundColorCheckbox(){
    return get_theme_mod('sidepanel_requestproject_use_bg_color_checkbox_control_setting');
}

function GetRequestSubmitButtonImage(){
    if(strlen(get_theme_mod('sidepanel_requestproject_submit_btn_image_control_setting')) == 0){
        return WPMEDIA . '/SubmitRequest.png';
    }else{
        return get_theme_mod('sidepanel_requestproject_submit_btn_image_control_setting');
    }
}

/*
*   Advanced settings
*/

function GetAdvancedSettingProjectAllowModalTextSeeding(){
    return get_theme_mod('advanced_project_enable_modal_text_seeding_control_setting');
}

function GetAdvancedSettingTeamAllowModalTextSeeding(){
    return get_theme_mod('advanced_team_enable_modal_text_seeding_control_setting');
}

function GetAdvancedSettingJoinUsAllowCareerListingTextSeeding(){
    return get_theme_mod('advanced_joinus_careerlisting_enable_text_seeding_control_setting');
}