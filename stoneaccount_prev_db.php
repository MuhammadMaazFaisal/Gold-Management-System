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



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    
	$date = trim($_POST["date"]);
    $name = trim($_POST["name"]);
    $received = trim($_POST["received"]);
	 $paid = trim($_POST["paid"]);
	 $ssabarcode = trim($_POST["ssabarcode"]);

  
   $insert_query ="INSERT INTO stone_setter_account(date, name,received,paid,ssabarcode, AddedBy)


   VALUES (:date, :name, :received, :paid,:ssabarcode, :added_by)";


      $insert_stmt = $pdo->prepare($insert_query);

        $insert_stmt->bindParam(":date", $date);
        $insert_stmt->bindParam(":name", $name);
		$insert_stmt->bindParam(":received", $received);
		$insert_stmt->bindParam(":paid", $paid);
		$insert_stmt->bindParam(":ssabarcode", $ssabarcode);
        $insert_stmt->bindParam(":added_by", $_SESSION['username']);


    if($insert_stmt->execute())
    {
      header("Location: stone_account.php");
      exit();
    }
       
         



}
?>