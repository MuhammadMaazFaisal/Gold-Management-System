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

 $date= $name=  $image= $details= $type= $quantity= $purity= $unpolish_weight= $polish_weight= $rate= $wastage= $tValues= $code ="";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
		$code = trim($_POST["code"]);
        $date = trim($_POST["date"]);
        $name= trim($_POST["name"]); 
        $details= trim($_POST["details"]);
		$type= trim($_POST["type"]);
		$quantity= trim($_POST["quantity"]);
		$purity= trim($_POST["purity"]);
		$unpolish_weight= trim($_POST["unpolish_weight"]);
		$polish_weight= trim($_POST["polish_weight"]);
		$rate= trim($_POST["rate"]);
		$wastage= trim($_POST["wastage"]);
		//$unpure_weight= trim($_POST["unpure_weight"]);
		//$pure_weight= trim($_POST["pure_weight"]);
		$tValues= trim($_POST["tValues"]);

    $added_by= $_SESSION['id'];

    

    // if($select_stmt->rowCount()>0){
      // "journal exist" ?>
      
   <?php //exit(); //} 
   
 



    $update_query = "UPDATE manufacturing_step SET code=:code, date=:date, name=:name, details=:details, type=:type, quantity=:quantity, purity =:purity, unpolish_weight=:unpolish_weight, polish_weight=:polish_weight, rate=:rate, wastage=:wastage, unpure_weight=:unpure_weight,pure_weight=:pure_weight,tValues=:tValues   WHERE id =$id";






    $update_stmt = $pdo->prepare($update_query);
    
      $update_stmt->bindParam(":code", $code);
		$update_stmt->bindParam(":date", $date);
		$update_stmt->bindParam(":name", $name);
		$update_stmt->bindParam(":details", $details);
		$update_stmt->bindParam(":type", $type);
		$update_stmt->bindParam(":quantity", $quantity);
		$update_stmt->bindParam(":purity", $purity);
		$update_stmt->bindParam(":unpolish_weight", $unpolish_weight);
		$update_stmt->bindParam(":polish_weight", $polish_weight);
		$update_stmt->bindParam(":rate", $rate);
		$update_stmt->bindParam(":wastage", $wastage);
		$update_stmt->bindParam(":unpure_weight", $unpure_weight);
		$update_stmt->bindParam(":pure_weight", $pure_weight);
		$update_stmt->bindParam(":tValues", $tValues);


    
      //$gold_received = $gold_received;
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