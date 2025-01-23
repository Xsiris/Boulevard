<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    $table = $_POST['table'];
    $id = $_POST['id'];
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or exit('Error connecting to mysql database');
    $query = "DELETE FROM $table WHERE id=$id";
    mysqli_query($dbc, $query) or exit('Error querying database (delete)');
    mysqli_close($dbc);
?>