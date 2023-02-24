<?php
  ob_start();
   session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";
  
  // $user_id = $_SESSION['user_id'];
  
  if(!isset($_SESSION['Super Admin']))
  {
    //User not logged in. Redirect them back to the login page.
    header('Location: pages-403.php');
    exit; 
  }


  $role= $role_tenure= $role_code="";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    

    $role = trim($_POST["role_prev_title"]);
    $role_desc = trim($_POST["role_prev_desc"]);

  
   $insert_query ="INSERT INTO Roles(RoleName, RoleDescription, AddedBy)


   VALUES (:role_prev_title, :role_prev_desc, :added_by)";


      $insert_stmt = $pdo->prepare($insert_query);

        $insert_stmt->bindParam(":role_prev_title", $role);
        $insert_stmt->bindParam(":role_prev_desc", $role_desc);
        $insert_stmt->bindParam(":added_by", $_SESSION['username']);


     echo "hi";
    if($insert_stmt->execute())
    {
      header("Location: UM_auth-add-roles.php");
      exit();
    }
       
         



}
?>