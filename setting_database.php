<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/head.php'; ?> -->
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
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['from'] == 'add' || ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['from'] == 'editPost')){

    $stageRejectionTimeOut = trim($_POST["stageRejectionTimeOut"])??'';
    $inProcessThreshold = trim($_POST["inProcessThreshold"])??'';
    $positiveIndicatorScore = trim($_POST["positiveIndicatorScore"])??'';
    $negativeIndicatorScore = trim($_POST["negativeIndicatorScore"])??'';
    $addedBy = $_SESSION['id']??''; 
    
    if($_GET['from'] == 'editPost'){
      
      $id = $_GET['id'];

      $insert_query = "UPDATE SystemSettings SET StageRejectionTimeout =  :stageRejectionTimeOut, InProcessThreshold = :inProcessThreshold,  PositiveIndicatorScore = :positiveIndicatorScore, NegativeIndicatorScore = :negativeIndicatorScore, AddedBy = :addedBy WHERE SystemSettingID = $id";

    }elseif($_GET['from'] == 'add') {
      
      $insert_query ="INSERT INTO SystemSettings(StageRejectionTimeout, InProcessThreshold, PositiveIndicatorScore, NegativeIndicatorScore, AddedBy) VALUES ( :stageRejectionTimeOut, :inProcessThreshold, :positiveIndicatorScore, :negativeIndicatorScore, :addedBy)";
    }
    $insert = $pdo->prepare($insert_query);
    
    $insert->bindParam(":stageRejectionTimeOut", $paramStageRejectionTimeOut);
    $insert->bindParam(":inProcessThreshold", $paramInProcessThreshold);
    $insert->bindParam(":positiveIndicatorScore", $paramPositiveIndicatorScore);
    $insert->bindParam(":negativeIndicatorScore", $paramNegativeIndicatorScore);
    $insert->bindParam(":addedBy", $paramAddedBy);
    
    $paramStageRejectionTimeOut = $stageRejectionTimeOut;
    $paramInProcessThreshold = $inProcessThreshold;
    $paramPositiveIndicatorScore = $positiveIndicatorScore;
    $paramNegativeIndicatorScore = $negativeIndicatorScore;
    $paramAddedBy = $addedBy;

    if($insert->execute()){
        header("Location: setting_view.php");
        exit();
      }
  }

  //For Delet
  
  if($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['from'] == 'delete'){
    $id = $_GET['id'];
    
    $record = "DELETE FROM SystemSettings WHERE SystemSettingID = $id";
        
    $queryRun = $pdo->prepare($record);
    
    if($queryRun->execute()){
      
      session_start();

      $_SESSION['msgDelete'] = 'Successfully Deleted';
      

      header("Location: setting_view.php");
      exit();
    }
  }
?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>
