<?php
   include 'layouts/session.php';

   // Include config file
   require_once "layouts/config.php";
   
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
//   include 'include/db/db_connect.php';
  
//   $user_id = $_SESSION['user_id'];
  
//   if(!isset($_SESSION['user_id']))
//   {
//     //User not logged in. Redirect them back to the login page.
//     header('Location: login.php');
//     exit; 
//   }




if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    $user_id=$_POST["id"];
    $roles_input=$_POST['roles'];


$stmt = $pdo->prepare("SELECT tbl_role.role_id, role_prev_title 
FROM tbl_role INNER JOIN tbl_user_role ON tbl_role.role_id = tbl_user_role.role_id WHERE tbl_user_role.user_id = $user_id");
$stmt->execute();
$row = $stmt->fetchAll();

   $role_values=[]; //to store already assigned roles
 foreach ($row as $output)
{ 
                                          
    $role_values[]= $output['role_id'];

                           
                            
} 

//Insert Newly added roles

foreach($roles_input as $input_val){
    if(!in_array($input_val, $role_values)){

        // echo $input_val."insert here";
        $ins_stmt = $pdo->prepare("INSERT INTO  tbl_user_role (role_id, user_id) 
        VALUES (:role_id, :user_id)");
        $ins_stmt->bindValue(':role_id', $input_val);
        $ins_stmt->bindValue(':user_id', $user_id);
        $ins_stmt->execute();


    }


}
//Delete assigned roles

foreach($role_values as $role_row){
    if(!in_array($role_row, $roles_input)){
        echo $role_row."Delete this one";

        $sql="DELETE FROM tbl_user_role WHERE role_id= $role_row AND user_id= $user_id";
  
        $stmt = $pdo->prepare($sql);
    
       $stmt->execute();


    }

}

header("Location: role_and_activity.php");
exit();



    }
         


                


        




?>