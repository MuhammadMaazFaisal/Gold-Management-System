<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/head.php'; ?> -->
<?php
include 'layouts/session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";

if (!isset($_SESSION['VCP'])) {
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit;
}

// $user_id = $_SESSION['user_id'];

// if(!isset($_SESSION['user_id']))
// {
//   //User not logged in. Redirect them back to the login page.
//   header('Location: login.php');
//   exit; 
// }
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['from'] == 'add' || ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['from'] == 'editPost')) {

  $ComplexityParameterName = trim($_POST["ComplexityParameterName"]) ?? '';
  $ComplexityParameterScore = trim($_POST["ComplexityParameterScore"]) ?? '';
  $ComplexityParameterStatus = trim($_POST["ComplexityParameterStatus"]) ?? '';
  $AddedBy = $_SESSION['id'] ?? '';


  if ($_GET['from'] == 'editPost') {

    $id = $_GET['id'];

    $insert_query = "UPDATE ComplexityParameters SET ComplexityParameterName =  :ComplexityParameterName, ComplexityParameterScore = :ComplexityParameterScore,  ComplexityParameterStatus = :ComplexityParameterStatus, AddedBy = :AddedBy WHERE ComplexityParameterID = $id";
  } elseif ($_GET['from'] == 'add') {

    $insert_query = "INSERT INTO ComplexityParameters(ComplexityParameterName, ComplexityParameterScore, ComplexityParameterStatus, AddedBy) VALUES ( :ComplexityParameterName, :ComplexityParameterScore, :ComplexityParameterStatus, :AddedBy)";
  }
  $insert = $pdo->prepare($insert_query);

  $insert->bindParam(":ComplexityParameterName", $paramComplexityParameterName);
  $insert->bindParam(":ComplexityParameterScore", $paramComplexityParameterScore);
  $insert->bindParam(":ComplexityParameterStatus", $paramComplexityParameterStatus);
  $insert->bindParam(":AddedBy", $paramAddedBy);

  $paramComplexityParameterName = $ComplexityParameterName;
  $paramComplexityParameterScore = $ComplexityParameterScore;
  $paramComplexityParameterStatus = $ComplexityParameterStatus;
  $paramAddedBy = $AddedBy;

  if ($insert->execute()) {
    header("Location: ComplexityParameters_view.php");
    exit();
  }
}

//For Delet

if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['from'] == 'delete') {
  $id = $_GET['id'];

  $record = "DELETE FROM ComplexityParameters WHERE ComplexityParameterID = $id";

  $queryRun = $pdo->prepare($record);

  if ($queryRun->execute()) {

    session_start();

    $_SESSION['msgDelete'] = 'Successfully Deleted';


    header("Location: ComplexityParameters_view.php");
    exit();
  }
}
?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>