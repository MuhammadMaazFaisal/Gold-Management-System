<?php
include 'layouts/session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "layouts/config.php";

// if(!isset($_SESSION['AA']))
// {
//   //User not logged in. Redirect them back to the error page.
//   header('Location: pages-403.php');
//   exit; 
// }

// $user_id = $_SESSION['user_id'];
// if(!isset($_SESSION['user_id']))
// {
// //User not logged in. Redirect them back to the login page.
// header('Location: login.php');
// exit; 
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

 
    $article_added_by = $_SESSION['id'];
   $article_code = $_POST["article_code"];


    $targetDir = "ArticleFiles/";
    $epubDir = "ArticleFiles/ArticleEpub/";
    $htmlDir = "ArticleFiles/ArticleHTML/";

    $epubFile = $_FILES['epubFile']['name'];
    $htmlFile = $_FILES['htmlFile']['name'];
    $targetepubFilePath = $epubDir . $epubFile;
    $targethtmlFilePath = $htmlDir . $htmlFile;
    $epubfileType = pathinfo($targetepubFilePath, PATHINFO_EXTENSION);
    $htmlfileType = pathinfo($targethtmlFilePath, PATHINFO_EXTENSION);
    $temp_epub_name = $_FILES['epubFile']['tmp_name'];
    $temp_html_name = $_FILES['htmlFile']['tmp_name'];

    if ($epubfileType == 'epub' || $epubfileType=='EPUB' || ( $htmlfileType == 'html' || $htmlfileType=='HTML')) 
    {
        $sqls = "SELECT * FROM Articles WHERE  ArticleCode = :article_code ";
        $stmts = $pdo->prepare($sqls);
        $stmts->bindValue(':article_code', $article_code);
        $stmts->execute();

      

     
        
       //echo $stmts->rowCount();
        // if($stmts->rowCount()>0)
        // {   
        //     $Message = "Already Exist";
        //    header("Location: PG-Dashboard-User.php?Message=".$Message);
        //    exit();
        // } 
        $row=$stmts->fetch();
        $ar_id=$row["ArticleID"];
        $journal_ID=$row["JournalID"];


            // check epub validation and uploading in epub folder
            if ($epubfileType == 'epub' || $epubfileType == 'EPUB') 
            {

                $date = date("dmY");
                $path_epubfilename_ext = $epubDir . "A" . $ar_id . "-" . "J" . $journal_ID . "-" . $date . "." . $epubfileType;
                //to stor in db
                $epubfile_name = "A" . $ar_id . "-" . "J" . $journal_ID . "-" . $date . "." . $epubfileType;
                $quantity = 1;

                $sql1= "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :article_id AND FileType= 'epub' ";
                $stmt1=$pdo->prepare($sql1);
                $stmt1->bindParam(":article_id",$ar_id);
                $stmt1->execute();
                $row=$stmt1->fetch();
                $epub_file=$row["FileType"]; 

                
        
                if(file_exists($row['FilePath'])  == 1) {
                    // epub exist
                   unlink($row['FilePath']); // deleting epub from folder

                   move_uploaded_file($temp_epub_name, $path_epubfilename_ext);

                   $update_query="UPDATE ArticlesFilesRecord set FilePath=:filePath , `FileName` =:nameFile WHERE ArticleID= :article_id AND FileType='epub'";
                   $stmt_update=$pdo->prepare($update_query);
                   $stmt_update->bindParam(":nameFile", $epubfile_name);
                   $stmt_update->bindParam(":filePath", $path_epubfilename_ext);
                   $stmt_update->bindParam(":article_id",$ar_id);
                   $stmt_update->execute();
                }

                else{
               
                move_uploaded_file($temp_epub_name, $path_epubfilename_ext);
                $epub_sql = "INSERT INTO ArticlesFilesRecord(FileType, Quantity, `FileName`, FilePath, ArticleID) 
                    VALUES (:file_type, :quantity, :nameFile, :filePath, :article_id)";
                $epub_stmt = $pdo->prepare($epub_sql);
                $epub_stmt->bindParam(":file_type", $epubfileType);
                $epub_stmt->bindParam(":quantity", $quantity);
                $epub_stmt->bindParam(":nameFile", $epubfile_name);
                $epub_stmt->bindParam(":filePath", $path_epubfilename_ext);
                $epub_stmt->bindParam(":article_id", $ar_id);
                $epub_stmt->execute();
            }
        }
            if ( $htmlfileType == 'html' || $htmlfileType == 'HTML') 
            {

                $date = date("dmY");
                $path_htmlfilename_ext = $htmlDir ."A" . $ar_id . "-" . "J" . $journal_ID . "-" . $date . "." . $htmlfileType;
                //to store in db
                $htmlfile_name = "A" . $ar_id . "-" . "J" . $journal_ID . "-" . $date . "." . $htmlfileType;
                $quantity = 1;

                $sql2= "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :article_id AND FileType= 'html' ";
                $stmt2=$pdo->prepare($sql2);
                $stmt2->bindParam(":article_id",$ar_id);
                $stmt2->execute();
                $row1=$stmt2->fetchAll();
                $html_file=$row1["FileType"];

                if(file_exists($row1['FilePath'])  == 1) {
                    // html exist
                   unlink($row1['FilePath']); // deleting html from folder


                   move_uploaded_file($temp_html_name, $path_htmlfilename_ext);

                   $update_query1="UPDATE ArticlesFilesRecord set FilePath=:filePath , `FileName` =:nameFile WHERE ArticleID= :article_id AND  ( FileType='html' OR FileType='HTML)'";
                   $stmt_update1=$pdo->prepare($update_query1);
                   $stmt_update1->bindParam(":nameFile", $htmlfile_name);
                   $stmt_update1->bindParam(":filePath", $path_htmlfilename_ext);
                   $stmt_update1->bindParam(":article_id",$ar_id);
                   $stmt_update1->execute();

                   
                }
        else{
                move_uploaded_file($temp_html_name, $path_htmlfilename_ext);
                $html_sql = "INSERT INTO ArticlesFilesRecord(FileType, Quantity, `FileName`, FilePath, ArticleID) 
                    VALUES (:file_type, :quantity, :nameFile, :filePath, :article_id)";
                $html_stmt = $pdo->prepare($html_sql);
                $html_stmt->bindParam(":file_type", $htmlfileType);
                $html_stmt->bindParam(":quantity", $quantity);
                $html_stmt->bindParam(":nameFile", $htmlfile_name);
                $html_stmt->bindParam(":filePath", $path_htmlfilename_ext);
                $html_stmt->bindParam(":article_id", $ar_id);
                $html_stmt->execute();
            }
            }


            header("Location: PG-Dashboard-User.php");
            exit();
        }
        
                
            
       
    }
// }

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>