<?php
$images = json_decode($_POST["images"]);
$modalFiles = array();
for($i = 0; $i < count($images); $i++){
    rename($images[$i], dirname($images[$i]) . "/A" . ($i + 1) . ".jpg");
    array_push($modalFiles, (substr(basename($images[$i]), 0, -4)));
    //All ModalProj files to dummy names
    rename(dirname(__FILE__) . "/ModalProj_" . sprintf("%02d", $i + 1) . ".php", dirname(__FILE__) . "/ModalProj_A" . sprintf("%02d", $i + 1) . ".php");
    if(file_exists(dirname(__FILE__) . "/ModalProj_" . sprintf("%02d", $i + 1) . ".php")){
        unlink(dirname(__FILE__) . "/ModalProj_" . sprintf("%02d", $i + 1) . ".php");
    }
}
for($i = 0; $i < count($images); $i++){
    rename(dirname($images[$i]) . "/A" . ($i + 1) . ".jpg", dirname($images[$i]) . "/" . ($i + 1) . ".jpg");
    rename(dirname(__FILE__) . "/ModalProj_A" . sprintf("%02d", $modalFiles[$i]) . ".php", dirname(__FILE__) . "/ModalProj_" . sprintf("%02d", $i + 1) . ".php");
    $fileContents = file(dirname(__FILE__) . "/ModalProj_" . sprintf("%02d", $i + 1) . ".php");
    //$fileContents[4] = "\t\t\t<img src='http://www.creativeboulevard.com/wp-content/uploads/" . ($i + 1) . ".jpg' alt='image' style='width: 100%; padding-right: 12px;' /> </div>";
    for($j = 0; $j < count($fileContents); $j++){
        if(preg_replace('/\d+.jpg/', ($j + 1) . '.jpg', $fileContents[$j]) != null){
            $fileContents[$j] = preg_replace('/\d+.jpg/', ($i + 1) . '.jpg', $fileContents[$j]);
        }
    }
    $fileContents = implode("", $fileContents);
    $modalFile = new SplFileObject(dirname(__FILE__) . "/ModalProj_" . sprintf("%02d", $i + 1) . ".php", "w+");
    //$modalFile->seek(4);
    //$imageString = "\t\t\t<img src='http://localhost:8888/wp-content/uploads/" . ($i + 1) . ".jpg' alt='image' style='width: 100%; padding-right: 12px;' />";
    $modalFile->fwrite($fileContents);
    //Close the file object
    $modalFile = null;
}
?>