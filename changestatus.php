<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    $table = $_POST['table'];
    $id = $_POST['id'];
    $status = $_POST['status'];
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or exit('Error connecting to mysql database');
    $query = "UPDATE $table SET Status=$status WHERE id=$id";
    mysqli_query($dbc, $query) or exit('Error querying database (delete)');
    mysqli_close($dbc);
?>