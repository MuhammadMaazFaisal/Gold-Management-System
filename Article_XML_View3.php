
<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';?>
<head>
  <title>XML: Display</title>
  <link rel="stylesheet" type="text/css" href="Codemirror/plugin/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="Codemirror/plugin/codemirror/addon/hint/show-hint.css">
  <script type="text/javascript" src="Codemirror/plugin/codemirror/lib/codemirror.js"></script>
  <script src="Codemirror/plugin/codemirror/addon/hint/show-hint.js"></script>
  <script src="Codemirror/plugin/codemirror/addon/hint/xml-hint.js"></script>
  <script src="Codemirror/plugin/codemirror/mode/xml/xml.js"></script>
  <meta charset="utf-8" />
  <?php include 'layouts/head.php'; ?>

  <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

  <!-- DataTables -->
  <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <!-- Responsive datatable examples -->
  <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


  <?php include 'layouts/head-style.php'; ?>



  <style>
    .CodeMirror {
      border: 1px solid #eee;
      height:660px;
     
    }
    .disabled-link{
      pointer-events: none;
    }
  </style>

</head>
 


<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
  <div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <article>
      <div class="main-content">

       <!-- ======= -->
        <div class="page-content">
                                <!-- start page title -->
          <div class="row">
            <div class="col-12">
              <div class="page-title-box d-flex align-items-center justify-content-space-between">
                <?php 
                 // $file_sql = "SELECT * FROM ArticlesFilesRecord WHERE FilePath = :filePath";
                  $file_sql = "SELECT
                  `ArticleCode`,
                  `ArticlesFilesRecord`.`FilePath` AS filePath,
                  `ArticlesFilesRecord`.`FileName`


              FROM
                  `Articles`,
                  `ArticlesFilesRecord`
              WHERE
                  `Articles`.`ArticleID` = `ArticlesFilesRecord`.`ArticleID` AND `ArticlesFilesRecord`.`ArticlesFilesRecordID` = :fileId";

                  $file_stmt = $pdo->prepare($file_sql);
                  $file_stmt->bindParam(":fileId", $_GET['file_id']);
                  $file_result = $file_stmt->execute();
                  $file_result = $file_stmt->fetch();
                ?>
                <h4 class="page-title mb-0 font-size-18">Article XML Source File Display</h4>
                <span class="badge bg-dark" style="font-size: 16px;  margin-left:20px;"><?php echo $file_result['ArticleCode'] ;?></span>
                <!-- <span class="alert alert-secondary" style="text-align: center;" role="alert">
                                    A simple secondary alert—check it out!
                                </span> -->
                  
              </div>
            </div>
                    <!-- end page title -->	

                    <!-- Start row -->
            <div class="row">
              <div class="col-lg-9">
                <div class="card">
                  <div class="card-body">
                          
                  
                
                      <?php 
                        $fileId = $_GET['file_id'];
                        $path=$file_result['filePath'];
                        
                          $myfile = fopen($path, "r") or die("Unable to open file!");
                        $text =  fread($myfile,filesize($path));
                        fclose($myfile);
                        
                      ?>
                      
                      <form class="custom-validation" enctype="multipart/form-data">
                        <textarea id="code" name="data"><?php echo $text;?></textarea>
                        <!-- <input type="hidden" name = "text" value = "zubair"> -->

                        <div class="mt-4">
                            <a type="submit" class="btn btn-primary w-md waves-effect">HTML Preview</a>
                            <a type="submit" class="btn btn-secondary waves-effect" href="#">Discover Figures</a>
                            <a type="submit" class="btn btn-secondary waves-effect" href="#">XML Cleaner</a><!-- remove garbage values -->
                            <a type="submit" class="btn btn-secondary waves-effect disabled-link" href="Article_view.php">XML Validate</a><!-- just dtd validate with check box versions -->
                            
                           
                            <a type="submit" class="btn btn-secondary waves-effect" href="#">Quality Check</a><!-- Jatz Article Check -->
                            <a type="submit"  class="btn btn-secondary waves-effect" href="#">Save</a> <!-- take snapshot !! break or continue -->
                            <a type="submit" class="btn btn-primary waves-effect" href="#">Complete</a>
                        </div>
                        <button type="button" id="btnRemove" onclick='click()'>replace</button>
                      </form>


                      
                      <script type="text/javascript">
           
        function click(){
          alert("FIND");
        }
        
      </script>



                      <script>
                      var dummy = {
                        attrs: {
                          color: ["red", "green", "blue", "purple", "white", "black", "yellow"],
                          size: ["large", "medium", "small"],
                          description: null
                        },
                        children: []
                      };

                      var tags = {
                        "!top": ["top"],
                        "!attrs": {
                          id: null,
                          class: ["A", "B", "C"]
                        },
                        top: {
                          attrs: {
                            lang: ["en", "de", "fr", "nl"],
                            freeform: null
                          },
                          children: ["animal", "plant"]
                        },
                        animal: {
                          attrs: {
                            name: null,
                            isduck: ["yes", "no"]
                          },
                          children: ["wings", "feet", "body", "head", "tail"]
                        },
                        plant: {
                          attrs: {name: null},
                          children: ["leaves", "stem", "flowers"]
                        },
                        wings: dummy, feet: dummy, body: dummy, head: dummy, tail: dummy,
                        leaves: dummy, stem: dummy, flowers: dummy
                      };

                      function completeAfter(cm, pred) {
                        var cur = cm.getCursor();
                        if (!pred || pred()) setTimeout(function() {
                          if (!cm.state.completionActive)
                            cm.showHint({completeSingle: false});
                        }, 100);
                        return CodeMirror.Pass;
                      }

                      function completeIfAfterLt(cm) {
                        return completeAfter(cm, function() {
                          var cur = cm.getCursor();
                          return cm.getRange(CodeMirror.Pos(cur.line, cur.ch - 1), cur) == "<";
                        });
                      }

                      function completeIfInTag(cm) {
                        return completeAfter(cm, function() {
                          var tok = cm.getTokenAt(cm.getCursor());
                          if (tok.type == "string" && (!/['"]/.test(tok.string.charAt(tok.string.length - 1)) || tok.string.length == 1)) return false;
                          var inner = CodeMirror.innerMode(cm.getMode(), tok.state).state;
                          return inner.tagName;
                        });
                      }

                      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
                        mode: "xml",
                        lineNumbers: true,
                        extraKeys: {
                          "'<'": completeAfter,
                          "'/'": completeIfAfterLt,
                          "' '": completeIfInTag,
                          "'='": completeIfInTag,
                          "Ctrl-Space": "autocomplete"
                        },
                        hintOptions: {schemaInfo: tags}
                      });
                      </script>



                      

                  </div>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                      <h4 class="page-title mb-0 font-size-18">Check List</h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-9">
                <div class="card">
                  <div class="card-body">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                      <h4 class="page-title mb-0 font-size-18">XML Preview</h4>
                    </div>
                  </div>
                </div>
              <div>
              

            </div>
          </div>
        </div>
      </div>
      <?php include 'layouts/right-sidebar.php'; ?>
      <!-- /Right-bar -->

      <!-- JAVASCRIPT -->
      <?php include 'layouts/vendor-scripts.php'; ?>

      <!-- Required datatable js -->
      <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
      <!-- Buttons examples -->
      <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
      <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
      <script src="assets/libs/jszip/jszip.min.js"></script>
      <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
      <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
      <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
      <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
      <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

      <!-- Responsive examples -->
      <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
      <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

      <!-- Datatable init js -->
      <script src="assets/js/pages/datatables.init.js"></script>




      <!-- apexcharts -->
      <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

      <!-- Plugins js-->
      <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
      <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

      <!-- dashboard init -->
      <script src="assets/js/pages/dashboard.init.js"></script>

      <!-- App js -->
      <script src="assets/js/app.js"></script>
    </article>

  
  </body>



</html>
