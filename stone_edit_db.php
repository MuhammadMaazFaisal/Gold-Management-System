<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";


if(!isset($_SESSION['ESA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}

// Define variables and initialize with empty values
$date= $name= $detail= $Issued_weight= $zircon= $stonetype= $stone_weight= $total= $Received_weight= $Stone_received= $Qty= $Wastage= $Total_valu= $Payable= "";

		

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
    
      $date = trim($_POST["date"]);
	  	$name= trim($_POST["name"]); 
        $detail= trim($_POST["detail"]);
		$Issued_weight= trim($_POST["Issued_weight"]);
		$zircon= trim($_POST["zircon"]);
		$stonetype= trim($_POST["stonetype"]);
		$stone_weight= trim($_POST["stone_weight"]);
		$total= trim($_POST["total"]);
		$Received_weight= trim($_POST["Received_weight"]);
		$Stone_received= trim($_POST["Stone_received"]);
		$Qty= trim($_POST["Qty"]);
		$Wastage= trim($_POST["Wastage"]);
		$Total_valu= trim($_POST["Total_valu"]);
		$Payable= trim($_POST["Payable"]);
		

    $added_by= $_SESSION['id'];

    

    // if($select_stmt->rowCount()>0){
      // "journal exist" ?>
      <!-- <form action="Journal_add.php" method="post">
        <input hidden type="text" name="msg" value="Journal Already Exist">
        <input hidden type="submit"  name="submit" id="submitform" >
      </form>
      <script>
      
      $("#submitform").trigger( "click" );
      </script> -->
   <?php //exit(); //} 
   
 



    $update_query = "UPDATE stone_setter_step SET date=:date,name=:name, detail=:detail, Issued_weight=:Issued_weight, zircon=:zircon, stonetype=:stonetype, stone_weight=:stone_weight, total=:total , Received_weight=:Received_weight , Stone_received=:Stone_received , Qty=:Qty , Wastage=:Wastage, Total_valu=:Total_valu, Payable=:Payable  WHERE Ssid  =$id";






    $update_stmt = $pdo->prepare($update_query);
    // $update_stmt->bindParam(":system_activities_name", $param_system_activities_name);
    //   $update_stmt->bindParam(":system_activities_code", $param_system_activities_code);
      $update_stmt->bindParam(":date", $date);
	  $update_stmt->bindParam(":name", $name);
	  $update_stmt->bindParam(":detail", $detail);
	  $update_stmt->bindParam(":Issued_weight", $Issued_weight);
	  $update_stmt->bindParam(":zircon", $zircon);
	  $update_stmt->bindParam(":stonetype", $stonetype);
	  $update_stmt->bindParam(":stone_weight", $stone_weight);
	  $update_stmt->bindParam(":total", $total);
	  $update_stmt->bindParam(":Received_weight", $Received_weight);
	  $update_stmt->bindParam(":Stone_received", $Stone_received);
	  $update_stmt->bindParam(":Qty", $Qty);
	  $update_stmt->bindParam(":Wastage", $Wastage);
	  $update_stmt->bindParam(":Total_valu", $Total_valu);
	  $update_stmt->bindParam(":Payable", $Payable);
	  

    //   $update_stmt->bindParam(":added_by", $param_added_by);
      


      //  $param_system_activities_name= $system_activities_name;
      // $param_system_activities_code = $system_activities_code ;
     // $gold_received = $gold_received;
    //   $param_added_by = $added_by;

   
  if($update_stmt->execute())
  {
    header("Location: view_manufecturing.php");
    exit();
  }
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>