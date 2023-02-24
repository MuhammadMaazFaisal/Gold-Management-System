<?php
include 'layouts/session.php'; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";
  
  // $user_id = $_SESSION['user_id'];
  
  // if(!isset($_SESSION['user_id']))
  // {
  //   //User not logged in. Redirect them back to the login page.
  //   header('Location: login.php');
  //   exit; 
  // }

  
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
       
        $oldpdffilename = trim($_POST["pdffilename"]);
        $oldwordfilename = trim($_POST["wordfilename"]);
        $pdfID = $_POST["pdfID"];
        $wordID = $_POST["wordID"];
        $oldpdfpath = trim($_POST["oldpdfpath"]);
        $oldwordpath = trim($_POST["oldwordpath"]);
        $articleid =$_POST["articleid"];
        



        $targetDir = "ArticleFiles/"; 
        $pdfDir = "ArticleFiles/ArticlePDFFiles/";
        $docDir = "ArticleFiles/ArticleWordFile/";

     
        $pdfFile =  $_FILES['pdfFile']['name'];
        $docFile =  $_FILES['wordFile']['name'];
        $targetPdfFilePath = $pdfDir . $pdfFile; 
        $targetWordFilePath = $docDir . $docFile;
        $pdffileType = pathinfo($targetPdfFilePath, PATHINFO_EXTENSION); 
        $wordfileType = pathinfo($targetWordFilePath, PATHINFO_EXTENSION); 
        $temp_pdf_name = $_FILES['pdfFile']['tmp_name'];
        $temp_word_name = $_FILES['wordFile']['tmp_name'];
       

        $j_sql = "SELECT * FROM Articles WHERE ArticleID = :articleid";
        $j_stmt = $pdo->prepare($j_sql);
        $j_stmt->bindParam(":articleid", $articleid);
        $j_stmt->execute();
        $j_result = $j_stmt->fetch();
        $journal_id = $j_result['JournalID'];

        


            //check pdf validation, deleting and updating in pdf folder
        if($pdffileType == 'pdf')
        {
            if(unlink($oldpdfpath))
            {
                




                $date=date("dmY");
                $path_pdffilename_ext = $pdfDir. "A" . $articleid. "-" . "J" .$journal_id."-".$date.".".$pdffileType;
                
                //to stor in db
                $pdffile_name= "A" . $articleid. "-" . "J" .$journal_id."-".$date.".".$pdffileType;
                $quantity = 1;

                move_uploaded_file($temp_pdf_name,$path_pdffilename_ext);
                $pdf_sql = "UPDATE ArticlesFilesRecord SET FileType = :file_type, Quantity = :quantity, FileName = :nameFile, FilePath = :filePath
                    WHERE ArticlesFilesRecordID = :pdfID";
                $pdf_stmt = $pdo->prepare($pdf_sql);
                $pdf_stmt->bindParam(":pdfID", $pdfID);
                $pdf_stmt->bindParam(":file_type", $pdffileType);
                $pdf_stmt->bindParam(":quantity", $quantity);
                $pdf_stmt->bindParam(":nameFile", $pdffile_name);
                $pdf_stmt->bindParam(":filePath", $path_pdffilename_ext);
            
                $pdf_stmt->execute();
            }
            

        }

        if($wordfileType == 'docx' || $wordfileType == 'doc')
        {
            if(unlink($oldwordpath))
            {
                $date=date("dmY");
                $path_wordfilename_ext = $docDir."A" . $articleid. "-" . "J" .$journal_id."-".$date.".".$wordfileType;
                
                //to stor in db
                $wordfile_name = "A" . $articleid. "-" . "J" .$journal_id."-".$date.".".$wordfileType;
                $quantity = 1;
                move_uploaded_file($temp_word_name,$path_wordfilename_ext);
                $word_sql = "UPDATE ArticlesFilesRecord SET FileType = :file_type, Quantity = :quantity, FileName = :nameFile, FilePath = :filePath
                    WHERE ArticlesFilesRecordID = :wordID";
                $word_stmt = $pdo->prepare($word_sql);
                $word_stmt->bindParam(":wordID", $wordID);
                $word_stmt->bindParam(":file_type", $wordfileType);
                $word_stmt->bindParam(":quantity", $quantity);
                $word_stmt->bindParam(":nameFile", $wordfile_name);
                $word_stmt->bindParam(":filePath", $path_wordfilename_ext);
            
                $word_stmt->execute();
            }
            
        }

        header("Location: Article_view.php");
        exit();

         
    }
    
?>