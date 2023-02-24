<?php

  include 'layouts/session.php';

  // Include config file
  require_once "layouts/config.php";
  
 error_reporting(E_ALL);
 ini_set('display_errors', 1);


 if(!isset($_SESSION['EBIA']))
 {
   //User not logged in. Redirect them back to the error page.
   header('Location: pages-403.php');
   exit; 
 }
   
 
  //error_reporting(E_ALL);
  //ini_set('display_errors', 1);
  
//   include 'include/db/db_connect.php';
  
//   $Issue_id = $_SESSION['Issue_id'];
  
//   if(!isset($_SESSION['Issue_id']))
//   {
//     //Issue not logged in. Redirect them back to the login page.
//     header('Location: login.php');
//     exit; 
//   }


  




if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    $Issue_id=$_POST["id"];
    $article_code_input=[];
    if(isset($_POST['article_code'])){
        $article_code_input=$_POST['article_code'];
    }
   

    $stmt = $pdo->prepare("SELECT Articles.ArticleID, ArticleCode FROM Articles INNER JOIN IssueArticles 
    ON Articles.ArticleID = IssueArticles.ArticleID WHERE IssueArticles.IssueID = $Issue_id");
    $stmt->execute();
$row = $stmt->fetchAll();

   $article_values=[]; //to store already assigned roles
 foreach ($row as $output)
{ 
                                          
    $article_values[]= $output['ArticleID'];

                           
                            
} 

//Insert Newly added roles

foreach($article_code_input as $input_val){
    if(!in_array($input_val, $article_values)){

        // echo $input_val."insert here";
        $ins_stmt = $pdo->prepare("INSERT INTO  IssueArticles(ArticleID, IssueID) 
        VALUES (:article_id, :Issue_id)");
        $ins_stmt->bindValue(':article_id', $input_val);
        $ins_stmt->bindValue(':Issue_id', $Issue_id);
        $ins_stmt->execute();


    }


}
//Delete assigned roles

foreach($article_values as $article_row){
    if(!in_array($article_row, $article_code_input)){
        // echo $role_row."Delete this one";

        $sql="DELETE FROM IssueArticles WHERE ArticleID= $article_row AND IssueID= $Issue_id";
  
        $stmt = $pdo->prepare($sql);
    
       $stmt->execute();


    }

}

header("Location: Issue_Articles_bind.php");
exit();



    }
