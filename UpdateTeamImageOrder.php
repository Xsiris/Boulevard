<?php
$images = json_decode($_POST["images"]);
$modalFiles = array();
for($i = 0; $i < count($images); $i++){
    rename($images[$i], dirname($images[$i]) . "/A" . ($i + 1) . ".jpg");
    array_push($modalFiles, (substr(basename($images[$i]), -5, 1)));
    //All ModalProj files to dummy names
    rename(dirname(__FILE__) . "/ModalEmpl_" . sprintf("%02d", $i + 1) . ".php", dirname(__FILE__) . "/ModalEmpl_A" . sprintf("%02d", $i + 1) . ".php");
    if(file_exists(dirname(__FILE__) . "/ModalEmpl_" . sprintf("%02d", $i + 1) . ".php")){
        unlink(dirname(__FILE__) . "/ModalEmpl_" . sprintf("%02d", $i + 1) . ".php");
    }
}
for($i = 0; $i < count($images); $i++){
    rename(dirname($images[$i]) . "/A" . ($i + 1) . ".jpg", dirname($images[$i]) . "/emp_" . ($i + 1) . ".jpg");
    rename(dirname(__FILE__) . "/ModalEmpl_A" . sprintf("%02d", $modalFiles[$i]) . ".php", dirname(__FILE__) . "/ModalEmpl_" . sprintf("%02d", $i + 1) . ".php");
    
    $fileContents = file(dirname(__FILE__) . "/ModalEmpl_" . sprintf("%02d", $i + 1) . ".php");
    //$fileContents[4] = "\t\t\t<img src='http://www.creativeboulevard.com/wp-content/uploads/emp_" . ($i + 1) . ".jpg' alt='image' style='width: 100%; padding-right: 12px;' />";
    for($j = 0; $j < count($fileContents); $j++){
        if(preg_replace('/\d+.jpg/', ($j + 1) . '.jpg', $fileContents[$j]) != null){
            $fileContents[$j] = preg_replace('/\d+.jpg/', ($i + 1) . '.jpg', $fileContents[$j]);
        }
    }
    $fileContents = implode("", $fileContents);
    $modalFile = new SplFileObject(dirname(__FILE__) . "/ModalEmpl_" . sprintf("%02d", $i + 1) . ".php", "w+");
    //$modalFile->seek(4);
    //$imageString = "\t\t\t<img src='http://localhost:8888/wp-content/uploads/" . ($i + 1) . ".jpg' alt='image' style='width: 100%; padding-right: 12px;' />";
    $modalFile->fwrite($fileContents);
    //Close the file object
    $modalFile = null;
}

define('WP_USE_THEMES', false);
require('../../../wp-load.php');
$empName = array();
$empPosition = array();
$empEmail = array();
for($i = 1; $i < count($images) + 1; $i++){
    //Change team member info - name, position, email
    
    //Store temp version of the first info entries
    $tempName = get_theme_mod("team_emplyoee_" . substr($images[$i - 1], -5, 1) . "name_control_setting");
    $tempPosition = get_theme_mod("team_emplyoee_" . substr($images[$i - 1], -5, 1) . "position_control_setting");
    $tempEmail = get_theme_mod("team_emplyoee_" . substr($images[$i - 1], -5, 1) . "email_control_setting");
    
    array_push($empName, $tempName);
    array_push($empPosition, $tempPosition);
    array_push($empEmail, $tempEmail);
}
for($i = 1; $i < count($images) + 1; $i++){
    set_theme_mod("team_emplyoee_" . $i . "name_control_setting", $empName[$i - 1]);
    set_theme_mod("team_emplyoee_" . $i . "position_control_setting", $empPosition[$i - 1]);
    set_theme_mod("team_emplyoee_" . $i . "email_control_setting", $empEmail[$i - 1]);
}

?>

