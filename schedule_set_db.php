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


  //$role= $role_tenure= $role_code="";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    

    $Product_name = trim($_POST["Product_name"]);
     $target_no = trim($_POST["target_no"]);
	
	

  
   $insert_query ="INSERT INTO sechedule_set(Product_name, target_no,added_by)


   VALUES (:Product_name, :target_no,:added_by)";


      $insert_stmt = $pdo->prepare($insert_query);

        $insert_stmt->bindParam(":Product_name", $Product_name);
        $insert_stmt->bindParam(":target_no", $target_no);
       $insert_stmt->bindParam(":added_by", $_SESSION['username']);


     echo "hi";
    if($insert_stmt->execute())
    {
      header("Location: production_page.php");
      exit();
    }
       
         



}
?>