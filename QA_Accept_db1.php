<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', true);

require_once "layouts/config.php";

// if(!isset($_SESSION['EI']))
// {
//   //User not logged in. Redirect them back to the error page.
//   header('Location: pages-403.php');
//   exit; 
// }
  
// Define variables and initialize with empty values

$ps_id=$ar_id=$ast_id=$user_id=$user_assigned_article_id= "";



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     
  $id= trim($_POST["id"]);
  
  $ps_id = trim($_POST["ps_id"]);
  $ar_id = trim($_POST["ar_id"]);
  $ast_id = trim($_POST["ast_id"]);
  $activeUserId = $_SESSION['id'];
  // $user_assigned_article_id =  trim($_POST["user_id"]);


   




  $update_query = "UPDATE UserAssignedArticles SET  Status = 'InProgress' WHERE ArticleID =$ar_id AND ProcessingStageID=$ps_id ";
  $update_stmt = $pdo->prepare($update_query);
  $update_stmt->execute();




  if($ps_id == 2)
  {
    header("Location: Inera-user-dashboard.php");
    exit();
  }


  // For Xml Compilation
  else if($ps_id == 3)
  {
    $file_sql = "SELECT * FROM ArticlesFilesRecord 
    WHERE (ArticleID = :articleID AND FileType = 'XML Converted')";

    $file_stmt = $pdo->prepare($file_sql);
    $file_stmt->bindParam(":articleID", $ar_id);
    $file_result = $file_stmt->execute();
    $file_result = $file_stmt->fetch();

    $fileId = $file_result['ArticlesFilesRecordID'];
    $fileName = $file_result['FileName'];
    $filePath = $file_result['FilePath'];
        
    $article_Id = $file_result['ArticleID'];
    $quantity = 1;

    $article_select_sql = "SELECT 
    Articles.ArticleCode AS ArticleCode,
    Journals.JournalCode AS JournalCode

    FROM `Articles` 
        INNER JOIN Journals ON Journals.JournalID = Articles.JournalID  
    WHERE Articles.ArticleID  = :articleID AND Articles.ArticleProcessingType = 'published'";

    $article_select_stmt = $pdo->prepare($article_select_sql);
    $article_select_stmt->bindParam(":articleID", $article_Id);
    $article_select_result = $article_select_stmt->execute();
    $article_select_result = $article_select_stmt->fetch();

    $ArticleCODE = $article_select_result['ArticleCode'];
    $JournalCODE = $article_select_result['JournalCode'];

    $folderName = "XML-compilation";

    $XMLCompilationFileName = str_replace("conversion","compilation",$fileName);

    $DestinationFilePath = "article-archive/published-articles/".$JournalCODE."/".$ArticleCODE."/".$folderName;

    $XMLCompilationFilePath = $DestinationFilePath."/".$XMLCompilationFileName;
   
  

    if (!file_exists($DestinationFilePath)) 
    {

      mkdir($DestinationFilePath, 0777, true);
      chmod($DestinationFilePath, 0777);
      if( !copy($filePath, $XMLCompilationFilePath) ) {  
        echo "File can't be copied! \n";  
    }  
    else {  
      $insert_sql = "INSERT INTO ArticlesFilesRecord(FileType, Quantity, FileName, FilePath, ArticleID) 
      VALUES (:file_type, :quantity, :nameFile, :filePath, :article_id)";
      $insert_stmt = $pdo->prepare($insert_sql);
      $insert_stmt->bindValue(":file_type", 'XML Valid');
      $insert_stmt->bindValue(":quantity", $quantity);
      $insert_stmt->bindValue(":nameFile", $XMLCompilationFileName);
      $insert_stmt->bindValue(":filePath", $XMLCompilationFilePath);
      $insert_stmt->bindValue(":article_id", $article_Id);
      $insert_stmt->execute();
      die();
  
      $getUserAssignedArticleIdQuery = "SELECT UserAssignedArticles.UserAssignedArticleID AS 'UserAssignedArticleId' FROM UserAssignedArticles WHERE ArticleID = :articleID AND UserID = :activeUserId AND Status = 'InProgress' AND ProcessingStageID = :processstageid";
              
      $getUserAssignedArticleIdStatement = $pdo->prepare($getUserAssignedArticleIdQuery);
      $processingid = 3;
      $getUserAssignedArticleIdStatement->bindParam(":articleID", $article_Id);
      $getUserAssignedArticleIdStatement->bindParam(":activeUserId", $activeUserId);
      $getUserAssignedArticleIdStatement->bindParam(":processstageid", $processingid);

      $articleProcessingIndicator = +1;
      $articleProcessingStatus = 'InProgress';
      if($getUserAssignedArticleIdStatement->execute()){
              
          $UserAssignedArticleID = $getUserAssignedArticleIdStatement->fetch();
          $UserAssignedArticleID = $UserAssignedArticleID['UserAssignedArticleId'];
      }

      $insert_query ="INSERT INTO ArticleProcessing(ArticleProcessingIndicator, ArticleProcessingStatus, UserAssignedArticleID)
      VALUES (:articleProcessingIndicator, :articleProcessingStatus, :userAssignedArticleID)";

              // prepare statement
      $insertStatement = $pdo->prepare($insert_query);

      // bind params
      $insertStatement->bindParam(':articleProcessingIndicator', $articleProcessingIndicator);
      $insertStatement->bindParam(':articleProcessingStatus', $articleProcessingStatus);
      $insertStatement->bindParam(':userAssignedArticleID', $UserAssignedArticleID);
      
      if($insertStatement->execute()){
          header("Location: Xml-valid-user-dashboard1.php");
          exit();
      }
    }  
      
    }

    
  }
  else if($ps_id == 4){
    header("Location: QA-Dashboard-User.php");
    exit();
  }
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>