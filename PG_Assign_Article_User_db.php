<?php

include 'layouts/session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";



$ps_id = $ar_id = $ast_id = $user_id = $added_by = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ps_id = trim($_POST["ps_id"]);
  $ar_id = trim($_POST["ar_id"]);
  $ast_id = trim($_POST["ast_id"]);
  $user_id = trim($_POST["user_id"]);


  $insert_query = "INSERT INTO UserAssignedArticles(UserID, ProcessingStageID, ArticleID ,AssignmentTypeID  ) VALUES (:user_id, :ps_id, :ar_id, :ast_id)";
  $insert_stmt = $pdo->prepare($insert_query);
  $insert_stmt->bindParam(":ps_id", $param_ps_id);
  $insert_stmt->bindParam(":ar_id", $param_ar_id);
  $insert_stmt->bindParam(":ast_id", $param_ast_id);
  $insert_stmt->bindParam(":user_id", $param_user_id);

  $param_ps_id = $ps_id;
  $param_ar_id = $ar_id;
  $param_ast_id = $ast_id;
  $param_user_id = $user_id;
  $insert_stmt->execute();


  if (!isset($_POST['userID'])) {
    header("Location: PG-Dashboard-User.php");
    exit();
  } else {
    if (!isset($_GET['ajax']) && $ps_id == 2) {
      header("Location: Inera-user-dashboard.php");
      exit();
    } else if ($ps_id == 3) {
      header("Location: Xml-valid-user-dashboard.php");
      exit();
    } else if ($ps_id == 1) {
      header("Location: Assign-Dashboard-Article.php");
      exit();
    } else if (isset($_GET['ajax']) && $_GET['ajax'] == 'assignSection') {
      exit;
    }
  }
}

?>
<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>