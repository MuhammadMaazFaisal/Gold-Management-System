<?php
    include 'layouts/session.php'; 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require_once "layouts/config.php";
 
    if(ISSET($_REQUEST['file_id'])){
        $file = $_REQUEST['file_id'];
        $query = $pdo->prepare("SELECT * FROM `ArticlesFilesRecord` WHERE `ArticlesFilesRecordID`='$file'");
        $query->execute();
        $fetch = $query->fetch();
 
        header("Content-Disposition: attachment; filename=".$fetch['FileName']);
        header("Content-Type: application/octet-stream;");
        readfile($fetch['FilePath']);
    }
?>