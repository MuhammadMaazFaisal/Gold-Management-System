<?php
include 'layouts/session.php'; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";

  if(!isset($_SESSION['EA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
  
  // $user_id = $_SESSION['user_id'];
  
  // if(!isset($_SESSION['user_id']))
  // {
  //   //User not logged in. Redirect them back to the login page.
  //   header('Location: login.php');
  //   exit; 
  // }

  
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        $article_id= trim($_POST["articleid"]);
        $article_year = trim($_POST["article-year"]);
        $article_issue = trim($_POST["article-issue"]);
        $article_volume = trim($_POST["article-volume"]);
        $article_title = trim($_POST["article-title"]);
        $article_author = trim($_POST["article-author"]);
        $article_doi = trim($_POST["article-doi"]);
        $elocator = trim($_POST["elocator"]);
        
        $article_abstract = trim($_POST["article-abstract"]);
        $first_page = trim($_POST["first-page"]);
        $last_page = trim($_POST["last-page"]);
        $article_type = trim($_POST["article-type"]);
        $article_keyword = trim($_POST["article-keyword"]);
        $journal_ID = $_POST["journal-name"];
        $article_added_by = $_SESSION['id'];
        // $pdfID = $_POST["pdfID"];
        // $wordID = $_POST["wordID"];



        // $targetDir = "ArticleFiles/"; 
        // $pdfDir = "ArticleFiles/ArticlePDFFiles/";
        // $docDir = "ArticleFiles/ArticleWordFile/";

     
        // $pdfFile =  $_FILES['pdfFile']['name'];
        // $docFile =  $_FILES['wordFile']['name'];
        // $targetPdfFilePath = $pdfDir . $pdfFile; 
        // $targetWordFilePath = $docDir . $docFile;
        // $pdffileType = pathinfo($targetPdfFilePath, PATHINFO_EXTENSION); 
        // $wordfileType = pathinfo($targetWordFilePath, PATHINFO_EXTENSION); 
        // $temp_pdf_name = $_FILES['pdfFile']['tmp_name'];
        // $temp_word_name = $_FILES['wordFile']['tmp_name'];
       
        

        // if($pdffileType == 'pdf'  && $wordfileType == 'docx')
        // {
            //      update ARTICLES Query
             
             $update_query = "UPDATE Articles SET ArticleTitle = :article_title, ArticleAuthors = :article_author, ArticleKeywords = :article_keyword, ArticleDOI =:article_doi,
             ArticleType = :article_type, ArticleLastPage = :last_page, ArticleFirstPage = :first_page, Elocator = :elocator, ArticleIssue = :article_issue,
             ArticleVolume = :article_volume, ArticleYear = :article_year, ArticleAbstract = :article_abstract, AddedBy = :added_by
             WHERE ArticleID = :article_id";

            $update_stmt = $pdo->prepare($update_query);
            $update_stmt->bindParam(":article_id", $article_id);
            $update_stmt->bindParam(":article_title", $article_title);
            $update_stmt->bindParam(":article_author", $article_author);
            $update_stmt->bindParam(":article_keyword", $article_keyword);
            $update_stmt->bindParam(":article_doi", $article_doi);
            $update_stmt->bindParam(":article_type", $article_type);
            $update_stmt->bindParam(":last_page", $last_page);
            $update_stmt->bindParam(":first_page", $first_page);
            $update_stmt->bindParam(":elocator", $elocator);
            $update_stmt->bindParam(":article_issue", $article_issue);
            $update_stmt->bindParam(":article_volume", $article_volume);
            $update_stmt->bindParam(":article_year", $article_year);
            $update_stmt->bindParam(":article_abstract", $article_abstract);
           
            $update_stmt->bindParam(":added_by", $article_added_by);
            if($update_stmt->execute())
            {
                $ID = $pdo->lastInsertId();
            

                // echo $ID;


                //   check pdf validation and uploading in pdf folder
                // if($pdffileType == 'pdf')
                // {

                //     $date=date("Ymd");
                //     $path_pdffilename_ext = $pdfDir.$article_id."-".$journal_ID."-".$date.".".$pdffileType;
                    
                //     //to stor in db
                //     $pdffile_name= $article_id."-".$journal_ID."-".$date.".".$pdffileType;
                //     $quantity = 1;

                //     move_uploaded_file($temp_pdf_name,$path_pdffilename_ext);
                //     $pdf_sql = "UPDATE ArticlesFilesRecord SET FileType = :file_type, Quantity = :quantity, FileName = :nameFile, FilePath = :filePath
                //         WHERE ArticlesFilesRecordID = $pdfID";
                //     $pdf_stmt = $pdo->prepare($pdf_sql);
                //     $pdf_stmt->bindParam(":file_type", $pdffileType);
                //     $pdf_stmt->bindParam(":quantity", $quantity);
                //     $pdf_stmt->bindParam(":nameFile", $pdffile_name);
                //     $pdf_stmt->bindParam(":filePath", $path_pdffilename_ext);
                
                //     $pdf_stmt->execute();

                // }

                // if($wordfileType == 'docx')
                // {

                //     $date=date("Ymd");
                //     $path_wordfilename_ext = $docDir.$article_id."-".$journal_ID."-".$date.".".$wordfileType;
                    
                //     //to stor in db
                //     $wordfile_name = $article_id."-".$journal_ID."-".$date.".".$wordfileType;
                //     $quantity = 1;
                //     move_uploaded_file($temp_word_name,$path_wordfilename_ext);
                //     $word_sql = "UPDATE ArticlesFilesRecord SET FileType = :file_type, Quantity = :quantity, FileName = :nameFile, FilePath = :filePath
                //         WHERE ArticlesFilesRecordID = $wordID";
                //     $word_stmt = $pdo->prepare($word_sql);
                //     $word_stmt->bindParam(":file_type", $wordfileType);
                //     $word_stmt->bindParam(":quantity", $quantity);
                //     $word_stmt->bindParam(":nameFile", $wordfile_name);
                //     $word_stmt->bindParam(":filePath", $path_wordfilename_ext);
                
                //     $word_stmt->execute();

                // }

                header("Location: Article_view.php");
                exit();
            }

            

          
           
         
    }



        

  
       
      
         

  
  
    
?>