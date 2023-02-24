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

 $date= $name=  $details= $gold_Issued_weight= $purity= $pure_weight_issued= "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
		
        $date = trim($_POST["date"]);
        $name= trim($_POST["name"]); 
        $detail= trim($_POST["detail"]);
		$gold_Issued_weight= trim($_POST["gold_Issued_weight"]);
		$purity= trim($_POST["purity"]);
		$pure_weight_issued= trim($_POST["pure_weight_issued"]);
		

    $added_by= $_SESSION['id'];

    

    // if($select_stmt->rowCount()>0){
      // "journal exist" ?>
      
   <?php //exit(); //} 
   
 



    $update_query = "UPDATE gold_accont_step SET date=:date, name=:name, detail=:detail, gold_Issued_weight=:gold_Issued_weight, purity =:purity, pure_weight_issued=:pure_weight_issued WHERE id =$id";






    $update_stmt = $pdo->prepare($update_query);
    
     	$update_stmt->bindParam(":date", $date);
		$update_stmt->bindParam(":name", $name);
		$update_stmt->bindParam(":detail", $detail);
		$update_stmt->bindParam(":gold_Issued_weight", $gold_Issued_weight);
		$update_stmt->bindParam(":purity", $purity);
		
		$update_stmt->bindParam(":pure_weight_issued", $pure_weight_issued);
		
		


    
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