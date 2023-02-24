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



<?php include 'layouts/head-main.php'; ?>

<head>

      <title>Advanced Plugins | Minia - Admin & Dashboard Template</title>
      <?php include 'layouts/head.php'; ?>

      <!-- choices css -->
      <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

      <!-- color picker css -->
      <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/classic.min.css" /> <!-- 'classic' theme -->
      <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/monolith.min.css" /> <!-- 'monolith' theme -->
      <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css">
      <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
      <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/nano.min.css" /> <!-- 'nano' theme -->
      <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css">

      <!-- datepicker css -->
      <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">

      <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

<div class="main-content">

      <div class="page-content">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-12">
                              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Discover Figures</h4>
                              </div>
                        </div>
                  
                        <div class="col-xl-6">

                              
                                                            
                              <?php 
                              if(isset($_GET['file_id'])){
                                    $file_id = $_GET['file_id'];

                                    // select file file name and path
                                    $file_sql = "SELECT * FROM ArticlesFilesRecord WHERE ArticlesFilesRecordID = :fileIDd";
                                    $file_stmt = $pdo->prepare($file_sql);
                                    $file_stmt->bindParam(':fileIDd',$file_id);
                                    $file_result = $file_stmt->execute();
                                    $file_result = $file_stmt->fetch();

                                    //fetch path
                                    $file_name = $file_result['FileName'];
                                    $file_path = $file_result['FilePath'];
                              

                                    if (file_exists($file_path)) {
                                          $dom = new DOMDocument();
                                          $dom->load($file_path);
                                          $nodes = $dom->getElementsByTagName('fig');
                                          $k = 0;
                              ?>
                              <div class="card">
                                    <div class="card-header">
                                          <h4 class="card-title" style="display:inline; ">Figures</h4>
                                          <span class = "badge bg-dark" style= "font-size: 16px; margin-left:20px; margin-left:40px">Total Figures: <strong><?php echo $nodes->length;?></strong></span>
                                    </div>
                                    <div class="card-body">
                                          <div class="table-responsive">
                                                <form class="custom-validation" action="" method = "post"  enctype="multipart/form-data">
                                                      <table class="table align-middle mb-0">
                                                            <thead>
                                                                  <tr>
                                                                  
                                                                        <th>Fig Number</th>
                                                                        <th>Fig Name</th>
                                                                        <th>Upload</th>
                                                                  </tr>
                                                            </thead>
                                                            <tbody>
                                                                  <?php
                                                                        echo '<input type="hidden" name = "totalfigures" value = "'.$nodes->length.'">';
                                                                        foreach($nodes as $node)

                                                                        {     $figid = $node->getAttribute('id');
                                                                              // echo $figid;
                                                                              $findno = $node->getElementsByTagName("label")->item(0);
                                                                              $fig_numb =  $findno->nodeValue;
                                                                              // echo $fig_numb;
                                                                              $findname = $node->getElementsByTagName("graphic")->item(0);
                                                                              $fig_name =  $findname->getAttribute('xlink:href');
                                                                              //echo $fig_name;
                                                                              echo "<tr><th scope='row'>";
                                                                              echo $fig_numb;
                                                                              echo "</th><th>";
                                                                              echo '<input type="text" name = figurename[] value = '.$fig_name.' readonly >';
                                                                              echo "</th><th>";
                                                                              echo '<input type="file" name = figUpload[] accept = ".jpg" required>';
                                                                              echo "</th><tr>";
                                                                              

                                                                        }
                                                                  }
                                                            }
                                                            ?>
                                                            </tbody>
                                                      </table>
                                                      <input type="submit" class="btn btn-sm btn-primary mt-3 mb-2" name="figureUpload" value="Discover Figures">
                                                      <div class="alert alert-success alert-dismissible fade show" id="successFigures" style = "width:240px; display:none;" role="alert">
                                                            <i class="mdi mdi-check-all me-2"></i>
                                                            Figures Uploaded
                                                       </div>
                                                       <div class="alert alert-danger alert-dismissible fade show" id="errorFigures" style = "width:240px; display:none;" role="alert">
                                                            <i class="mdi mdi-check-all me-2"></i>
                                                            Please Upload Again
                                                       </div>
                                                </form>
                                          </div>
                                    </div>
                                    <!-- end card body -->
                              </div>
                                    <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-xl-6">
                              <?php 
                                    if (file_exists($file_path)) {
                                          $inlinedom = new DOMDocument();
                                          $inlinedom->load($file_path);
                                          $inlinenodes = $inlinedom->getElementsByTagName('inline-graphic');
                              ?>

                              <div class="card">
                                    <div class="card-header">
                                          <h4 class="card-title" style="display:inline;">Inline Figures</h4>
                                          <span class = "badge bg-dark" style= "font-size: 16px; margin-left:20px; margin-left:40px">Total Inline Figures: <strong><?php echo $inlinenodes->length;?></strong></span>
                                    </div>
                                    <div class="card-body">
                                          <div class="table-responsive">
                                                <form id = "dropzone-form" class="custom-validation" action="" method = "post"  enctype="multipart/form-data">
                                                    
                                                            <?php
                                                            $articleid = $file_result['ArticleID'];
                                                             echo '<input type="hidden" name = "ArticleID" value = "'.$articleid.'">';
                                                            echo '<input type="hidden" name = "totalinlinefigures" value = "'.$inlinenodes->length.'">';
                                                            foreach($inlinenodes as $node)

                                                            { $inlinefigid = $node->getAttribute('xlink:href');
                                                                  
                                                                  echo '<input type="hidden" name = inlinefigurename[] value = '.$inlinefigid.' readonly >';
                                                            // echo "inline. ".$inlinefigid;
                                                            }
                                                            ?>
                                                          
                                                            <div class="card-body">

                                                                  <div>
                                                                        <div class="dropzone dz-clickable" id="Dropzone" style = "cursor:pointer !important;"> 
                                                                        
                                                                              <div class="dz-message needsclick">
                                                                                    <div class="mb-3">
                                                                                    <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                                                                    </div>

                                                                                    <h5>Drop files here or click to upload.</h5>
                                                                              </div> 
                                                                  </div>

                                                                  <div class="text-center mt-4">
                                                                        <button type="button" id = "submit-dropzone" name = "dropzoneSubmit" class="btn btn-primary waves-effect waves-light">Dsicover Inline Figures</button>
                                                                  </div>
                                                            </div>
                                                                             
                                                                              
                                                                              <!-- <input type="file" name="uploadInlineFigures[]" multiple="multiple" accept = ".jpg" required> -->
                                                                       
                                                      <!-- <input type="submit" class="btn btn-sm btn-primary mt-3 mb-2" name="inlineUpload" value="Discover Inline Figures"> -->
                                                      <div class="alert alert-success alert-dismissible fade show" id="inlinesuccessFigures" style = "width:280px; display:none;" role="alert">
                                                            <i class="mdi mdi-check-all me-2"></i>
                                                            Inline Figures Uploaded
                                                      </div>
                                                       <div class="alert alert-danger alert-dismissible fade show" id="inlineerrorFigures" style = "width:260px; display:none;" role="alert">
                                                            <i class="mdi mdi-check-all me-2"></i>
                                                            Please Upload Again
                                                       </div>
                                                </form>
                                                <?php }?>
                                          </div>
                                    </div>
                              </div>
                              <!-- end card -->
                        </div> 
                        <!-- end col -->




                       

                  </div>

            </div> <!-- container-fluid -->
      </div>     
</div>
        <!-- End row -->
        

<?php 
      // submit figures button
      if(isset($_POST['figureUpload'])){
            
            
            $totalFigures = $_POST['totalfigures'];

            $figUploadarray = $_FILES['figUpload']['name'];
            $filesNameInArray = array();

            //Push all upload file names in array
            foreach($figUploadarray as $al){
                  
                  array_push($filesNameInArray, $al);
                  
            }
            $count = 0;

            // Inner join journal, Articles, Article processing, ArticlefilesRecord
            $articleProcessingsqla = "SELECT 
                  ArticleProcessing.ArticleProcessingID AS ArticleProcessingID,
                  ArticlesFilesRecord.FilePath AS FilePath,
                  ArticlesFilesRecord.FileName AS FileName,
                  Articles.ArticleCode AS ArticleCode,
                  Journals.JournalCode AS JournalCode
                  FROM `UserAssignedArticles` 
                        INNER JOIN ArticleProcessing ON ArticleProcessing.UserAssignedArticleID = UserAssignedArticles.UserAssignedArticleID 
                        INNER JOIN Articles ON Articles.ArticleID = UserAssignedArticles.ArticleID 
                        INNER JOIN ArticlesFilesRecord ON Articles.ArticleID = ArticlesFilesRecord.ArticleID
                        INNER JOIN Journals ON Articles.JournalID = Journals.JournalID
                  WHERE UserAssignedArticles.Status = 'InProgress' AND UserAssignedArticles.ProcessingStageID = :PSIDxmlval 
                  AND UserAssignedArticles.UserID = :userID AND Articles.ArticleID = :articleID AND ArticlesFilesRecord.FileType = 'XML Valid'";

            $articleProcessingstmt = $pdo->prepare($articleProcessingsqla);
            $articleProcessingstmt->bindParam(':PSIDxmlval',$PSIDxmlvalid);
            $articleProcessingstmt->bindParam(':userID',$UserId);
            $articleProcessingstmt->bindParam(':articleID',$articleid);

            // if query is execute declare values
            if($articleProcessingstmt->execute()){
            $articleProcessingrow = $articleProcessingstmt->fetch();
            $articleProcessingId = $articleProcessingrow['ArticleProcessingID'];
            $XmlVAlidationPath = $articleProcessingrow['FilePath'];
            $ArticleCode = $articleProcessingrow['ArticleCode'];
            $JournalCode = $articleProcessingrow['JournalCode'];
            }

            // check files exist in articles figures folder
            foreach($filesNameInArray as $array){
                  $patharray = "article-archive/published-articles/".$JournalCode."/".$ArticleCode."/XML-compilation"."/".$array;
                //$patharray = "ArticleFiles/ArticleFigures/Figures/".$array;
                //echo " path: ".$patharray;
                if(file_exists($patharray)){
                  $count++;
                }
                
            }
           // if not in folder insert in database 
           if($count == 0){
                  // execute loop acc to total figures
                  for($i=0; $i<$totalFigures; $i++){
                        $figurename = $_POST['figurename'][$i];
                        $figUpload = $_FILES['figUpload']['name'][$i];
                        $temp_file_name = $_FILES['figUpload']['tmp_name'][$i];
                        echo "figurename: ".$figurename. "<br>";
                        // echo "temp file ".$temp_file_name;
                        
                        $FigUploadType = pathinfo($figUpload, PATHINFO_EXTENSION);
                        $FigUploadName = pathinfo($figUpload, PATHINFO_FILENAME);
                        // echo "File type".$FigUploadType;
                        // echo "FigUploadName: ".$FigUploadName;
                        //$figDir = "ArticleFiles/ArticleFigures/Figures/";
                        
                        $FigUploadPath = "article-archive/published-articles/".$JournalCode."/".$ArticleCode."/XML-compilation"."/".$figUpload;
                        // echo "path: ".$FigUploadPath;

                        //check upload image is correcr ot not
                        if($FigUploadName === $figurename){

                              // fetch article processing id using inner join
                              
                              
                              // inset data in ArticleFigureRecord 
                              $insertFigure_sql = "INSERT INTO `ArticleFigureRecord`(`FigurePath`, `FigureName`, `ArticleProcessingID`) 
                              VALUES (:figureuploadpath, :figurename, :articeprocessingid)";
                              $insertFigure_stmt = $pdo->prepare($insertFigure_sql);
                              $insertFigure_stmt->bindParam(':figureuploadpath',$FigUploadPath);
                              $insertFigure_stmt->bindParam(':figurename',$figUpload);
                              $insertFigure_stmt->bindParam(':articeprocessingid',$articleProcessingId);

                        

                              if($insertFigure_stmt->execute()){
                                    move_uploaded_file($temp_file_name, $FigUploadPath);
                                    //header("Refresh:0");
                                    echo "<script language='javascript'>
                                    document.getElementById('successFigures').style.display = 'block';
                                    </script>
                                    ";
                              }else{
                                    echo "<script language='javascript'>
                                    document.getElementById('errorFigures').style.display = 'block';
                                    </script>
                                    ";
                              }
                        }
                  }
           }else{
            // if  in folder display error
            echo "<script language='javascript'>
                              document.getElementById('errorFigures').style.display = 'block';
                              document.getElementById('errorFigures').innerHTML = 'Figures Already exist.';
                              </script>
                              ";
            die();
           }

            
            

                        
      }
?>





        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

<!-- END layout-wrapper -->

<!-- ..................................... -->



<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- choices js -->
<script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- color picker js -->
<script src="assets/libs/@simonwep/pickr/pickr.min.js"></script>
<script src="assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

<!-- datepicker js -->
<script src="assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- init js -->
<script src="assets/js/pages/form-advanced.init.js"></script>
<script src="assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/pace-js/pace.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>


<script src="assets/js/app.js"></script>


<script>
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#Dropzone", {
    url: "upload.php",
    method: "POST",
    paramName: "file",
    autoProcessQueue : false,
    acceptedFiles: ".jpg, .jpeg",
   
    uploadMultiple: true,
    parallelUploads: 100, // use it with uploadMultiple
    createImageThumbnails: true,
    thumbnailWidth: 120,
    thumbnailHeight: 120,
    addRemoveLinks: true,
    timeout: 180000,
    dictRemoveFileConfirmation: "Are you Sure?", // ask before removing file
    // Language Strings
    //dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
    dictInvalidFileType: "Invalid File Type",
    dictCancelUpload: "Cancel",
    dictRemoveFile: "Remove",
    //dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
    dictDefaultMessage: "Drop files here to upload",
   
   
   
});

myDropzone.on("addedfile", function(file) {
    //console.log(file);
});

myDropzone.on("removedfile", function(file) {
    // console.log(file);
});

// Add mmore data to send along with the file as POST data. (optional)
myDropzone.on("sending", function(file, xhr, formData) {
    formData.append("dropzone", "1"); // $_POST["dropzone"]
});

myDropzone.on("error", function(file, response) {
    console.log(response);
});

// on success
myDropzone.on("successmultiple", function(file, response) {
    // get response from successful ajax request
    console.log(response);
    // submit the form after images upload
    // (if u want yo submit rest of the inputs in the form)
    document.getElementById("dropzone-form").submit();
});



// button trigger for processingQueue
var submitDropzone = document.getElementById("submit-dropzone");
submitDropzone.addEventListener("click", function(e) {
    // Make sure that the form isn't actually being sent.
    e.preventDefault();
    e.stopPropagation();

    if (myDropzone.files != "") {
        // console.log(myDropzone.files);
        myDropzone.processQueue();
    } else {
	// if no file submit the form    
        document.getElementById("dropzone-form").submit();
    }

});

</script>

</body>

</html>