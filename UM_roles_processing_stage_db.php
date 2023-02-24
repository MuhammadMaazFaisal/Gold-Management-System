<?php

  include 'layouts/session.php';

  // Include config file
  require_once "layouts/config.php";
  
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 
  //error_reporting(E_ALL);
  //ini_set('display_errors', 1);
  
//   include 'include/db/db_connect.php';
  
//   $Role_id = $_SESSION['Role_id'];
  
//   if(!isset($_SESSION['Role_id']))
//   {
//     //Role not logged in. Redirect them back to the login page.
//     header('Location: login.php');
//     exit; 
//   }


  
if(!isset($_SESSION['ERPS']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    $Role_id=$_POST["id"];
    $processing_stage_input=$_POST['processing_stage'];

    $stmt = $pdo->prepare("SELECT ProcessingStages.ProcessingStageID, ProcessingStageName FROM ProcessingStages INNER JOIN RoleProcessingStages 
    ON ProcessingStages.ProcessingStageID = RoleProcessingStages.ProcessingStageID WHERE RoleProcessingStages.RoleID = '$Role_id'");
    $stmt->execute();
$row = $stmt->fetchAll();

   $processing_stage_values=[]; //to store already assigned roles
 foreach ($row as $output)
{ 
                                          
    $processing_stage_values[]= $output['ProcessingStageID'];

                           
                            
} 

//Insert Newly added roles

foreach($processing_stage_input as $input_val){
    if(!in_array($input_val, $processing_stage_values)){

        // echo $input_val."insert here";
        $ins_stmt = $pdo->prepare("INSERT INTO  RoleProcessingStages(ProcessingStageID, RoleID) 
        VALUES (:processing_stage_id, :Role_id)");
        $ins_stmt->bindValue(':processing_stage_id', $input_val);
        $ins_stmt->bindValue(':Role_id', $Role_id);
        $ins_stmt->execute();


    }


}
//Delete assigned roles

foreach($processing_stage_values as $processing_stage_row){
    if(!in_array($processing_stage_row, $processing_stage_input)){
        // echo $role_row."Delete this one";

        $sql="DELETE FROM RoleProcessingStages WHERE ProcessingStageID= $processing_stage_row AND RoleID= $Role_id";
  
        $stmt = $pdo->prepare($sql);
    
       $stmt->execute();


    }

}

header("Location: UM_roles.php");
exit();



    }
         


                


        




?>