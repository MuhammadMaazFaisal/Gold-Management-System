<?php 
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";
$PSIDxmlvalid=3;
$UserId = $_SESSION['id'];
// if(!isset($_SESSION['AA']))
// {
//   //User not logged in. Redirect them back to the error page.
//   header('Location: pages-403.php');
//   exit; 
// }

?>

<?php 

      // submit inline figures button
      if(isset($_POST['dropzoneSubmit'])){
            $articleid = $file_result['ArticleID'];
            $TotalInlineFigures = $_POST['totalinlinefigures'];

                        
         
            for($i=0; $i<$TotalInlineFigures; $i++){
                  $inlinefigurename = $_POST['inlinefigurename'][$i];
                  $inlinefigUpload = $_FILES['file']['name'][$i];
                  $temp_inlinefile_name = $_FILES['file']['tmp_name'][$i];
                  // echo "figurename: ".$inlinefigurename. "<br>";
                  // echo "temp file ".$temp_file_name;
                  
                  $InlineFigUploadType = pathinfo($inlinefigUpload, PATHINFO_EXTENSION);
                  $InlineFigUploadName = pathinfo($inlinefigUpload, PATHINFO_FILENAME);
                  // echo "File type".$FigUploadType;
                  // echo "FigUploadName: ".$FigUploadName;
                  $InlineFigUploadPath = "ArticleFiles/ArticleFigures/InlineFigures/".$inlinefigUpload;
                  // echo "path: ".$FigUploadPath;

                  //check upload image is correcr ot not
                  if($InlineFigUploadName === $inlinefigurename){

                        // fetch article processing id using inner join
                        $articleProcessingsqla = "SELECT 
                        ArticleProcessing.ArticleProcessingID AS ArticleProcessingID
                        FROM `UserAssignedArticles` 
                              INNER JOIN ArticleProcessing ON ArticleProcessing.UserAssignedArticleID = UserAssignedArticles.UserAssignedArticleID 
                              INNER JOIN Articles ON Articles.ArticleID = UserAssignedArticles.ArticleID 
                        WHERE UserAssignedArticles.Status = 'InProgress' AND UserAssignedArticles.ProcessingStageID = :PSIDxmlval 
                        AND UserAssignedArticles.UserID = :userID AND Articles.ArticleID = :articleID";
                        $articleProcessingstmt = $pdo->prepare($articleProcessingsqla);
                        $articleProcessingstmt->bindParam(':PSIDxmlval',$PSIDxmlvalid);
                        $articleProcessingstmt->bindParam(':userID',$UserId);
                        $articleProcessingstmt->bindParam(':articleID',$articleid);
                        // if query is execute declare articeProcessing id value
                        if($articleProcessingstmt->execute()){
                        $articleProcessingrow = $articleProcessingstmt->fetch();
                        $articleProcessingId = $articleProcessingrow['ArticleProcessingID'];
                        }
                        
                        // inset data in ArticleFigureRecord 
                        $insertFigure_sql = "INSERT INTO `ArticleFigureRecord`(`FigurePath`, `FigureName`, `ArticleProcessingID`) 
                        VALUES (:figureuploadpath, :figurename, :articeprocessingid)";
                        $insertFigure_stmt = $pdo->prepare($insertFigure_sql);
                        $insertFigure_stmt->bindParam(':figureuploadpath',$InlineFigUploadPath);
                        $insertFigure_stmt->bindParam(':figurename',$inlinefigUpload);
                        $insertFigure_stmt->bindParam(':articeprocessingid',$articleProcessingId);

                     

                        if($insertFigure_stmt->execute()){
                              move_uploaded_file($temp_inlinefile_name, $InlineFigUploadPath);
                              echo "<script language='javascript'>
                              document.getElementById('inlinesuccessFigures').style.display = 'block';
                              </script>
                              ";
                        }else{
                              echo "<script language='javascript'>
                              document.getElementById('inlineerrorFigures').style.display = 'block';
                              </script>
                              ";
                        }
                  }
            }
      }
      

?>
