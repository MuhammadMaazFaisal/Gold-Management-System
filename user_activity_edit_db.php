<?php

  include 'layouts/session.php';

  // Include config file
  require_once "layouts/config.php";
  
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 
  //error_reporting(E_ALL);
  //ini_set('display_errors', 1);
  
//   include 'include/db/db_connect.php';
  
//   $user_id = $_SESSION['user_id'];
  
//   if(!isset($_SESSION['user_id']))
//   {
//     //User not logged in. Redirect them back to the login page.
//     header('Location: login.php');
//     exit; 
//   }

if(!isset($_SESSION['EUSA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
  




if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    $user_id=$_POST["id"];
    $activities_input=$_POST['activities'];

    $stmt = $pdo->prepare("SELECT SystemActivities.SystemActivityID, SystemActivityName FROM SystemActivities INNER JOIN UserSystemActivities 
    ON SystemActivities.SystemActivityID = UserSystemActivities.SystemActivityID WHERE UserSystemActivities.UserID = $user_id");
    $stmt->execute();
$row = $stmt->fetchAll();

   $activity_values=[]; //to store already assigned roles
 foreach ($row as $output)
{ 
                                          
    $activity_values[]= $output['SystemActivityID'];

                           
                            
} 

//Insert Newly added roles

foreach($activities_input as $input_val){
    if(!in_array($input_val, $activity_values)){

        // echo $input_val."insert here";
        $ins_stmt = $pdo->prepare("INSERT INTO  UserSystemActivities(SystemActivityID, UserID) 
        VALUES (:activity_id, :user_id)");
        $ins_stmt->bindValue(':activity_id', $input_val);
        $ins_stmt->bindValue(':user_id', $user_id);
        $ins_stmt->execute();


    }


}
//Delete assigned roles

foreach($activity_values as $activity_row){
    if(!in_array($activity_row, $activities_input)){
        // echo $role_row."Delete this one";

        $sql="DELETE FROM UserSystemActivities WHERE SystemActivityID= $activity_row AND UserID= $user_id";
  
        $stmt = $pdo->prepare($sql);
    
       $stmt->execute();


    }

}

header("Location: UM_users.php");
exit();



    }
         


                


        




?>