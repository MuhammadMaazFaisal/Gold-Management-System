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


 // $role= $role_tenure= $role_code="";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    
	$date = trim($_POST["date"]);
    $name = trim($_POST["name"]);
    $amount = trim($_POST["amount"]);

  
   $insert_query ="INSERT INTO cashaccount(date, name,amount, AddedBy)


   VALUES (:date, :name, :amount, :added_by)";


      $insert_stmt = $pdo->prepare($insert_query);

        $insert_stmt->bindParam(":date", $date);
        $insert_stmt->bindParam(":name", $name);
		$insert_stmt->bindParam(":amount", $amount);
        $insert_stmt->bindParam(":added_by", $_SESSION['username']);


     echo "hi";
    if($insert_stmt->execute())
    {
      header("Location: view_cash_details.php");
      exit();
    }
       
         



}
?>