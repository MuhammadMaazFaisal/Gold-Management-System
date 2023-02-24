<?php
include 'layouts/session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";

// $user_id = $_SESSION['user_id'];

// if(!isset($_SESSION['user_id']))
// {
//   //User not logged in. Redirect them back to the login page.
//   header('Location: login.php');
//   exit; 
// }
if(!isset($_SESSION['DA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
  





$id = trim($_POST["id"]);

$sql2 = "SELECT * FROM  ArticlesFilesRecord WHERE ArticleID = :articleid ";

$stmt2 = $pdo->prepare($sql2);
$stmt2->bindParam(":articleid", $id);
if ($stmt2->execute()) {

  $files = $stmt2->fetchAll();
  foreach ($files as $file) {
    unlink($file['FilePath']);
  }
}

// Delete from database

$sql = "DELETE FROM IssueArticles WHERE ArticleID = :articleid ; DELETE FROM ArticlesFilesRecord WHERE ArticleID = :articleid ;
      DELETE  FROM Articles WHERE ArticleID = :articleid";


$stmt = $pdo->prepare($sql);
$stmt->bindParam(":articleid", $id);
if ($stmt->execute()) {
  header("Location: Article_view.php");
  exit();
}
