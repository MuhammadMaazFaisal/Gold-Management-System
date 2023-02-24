<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';?>

<head>
    <title><?php echo $language["Dashboard"]; ?> Assign Articles | XML Workflow</title>

    <?php include 'layouts/head.php'; ?>

    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

     <!-- DataTables -->
     <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


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

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">XML Compilation Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">XML Workflow</a></li>
                                    <li class="breadcrumb-item active">XML Compilation</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!--- Start Code for Small Boxes on top -->
                <div class="row">
                    <?php
                        $PSIDxmlconv=2;
                        $assignmentTypeId = 1;
                        $PSIDxmlvalid=3;
                        $PSIDQA=4;
                        $PSIDartpkg=5;
                        $PSIDartdl=6;
                    ?>
                    <div class="col-xl-3 col-md-6 " id="AssignArticles">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">UnAssign Articles</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value unAssignedWidget" data-target="">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-danger text-danger">-29 Articles</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col-->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Assign Articles</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value assignWidget" data-target="">0</span> </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success"><?php echo $TotalArticles >= 1 ? '+'.$TotalArticles-5 .' Articles':'0 Articles';?> </span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-1 lh-1 d-block text-truncate">Accepted Articles</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value acceptedWidget" data-target="">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">+28 Articles</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Holded Articles</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value holdedWidget" data-target="">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">+95 Articles</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row-->



                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Complete Artcles</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value completedWidget" data-target="">0</span> </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">+20</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Rejected By QA Stage</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value rejectedWidget" data-target="">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart5" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-danger text-danger">-29 Articles</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col-->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Accepted by QA Stage</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="432">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">+28 Articles</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Articles</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"><span class="counter-value" data-target="557">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">+29 Articles</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row-->

                <!-- END code for Small Boxes on top -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title" >Un Assign Articles: XML Compilation</h4> 
                            </div>
                            <div class="card-body">
                                <table id="datatable1" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Journal/Issue/Vol/Year/</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="unAssignSection">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- Start code for XML Conversion tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title" >Assign Articles: XML Compilation</h4> 
                            </div>
                            <div class="card-body">
                                <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Journal/Issue/Vol/Year/</th>
                                            <th>Word/PDF Files</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selfAssignSection">
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->


                   <!-- End code for XML Conversion tables -->
                                     <!-- Start code for XML Validation tables -->
                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Accepted Articles: XML Compilation</h4> 
                            </div>
                            <div class="card-body">

                                <table id="datatable3" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Journal/Issue/Vol/Year/</th>
                                            <th>Word/PDF Files</th>
                                            <th>XML Files</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selfAcceptSection"></tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                   <!-- End code for XML Validation tables -->
                    <!-- Start code for QA tables -->
                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title" >Articles On Hold: XML Compilation</h4> 
                            </div>
                            <div class="card-body">

                                <table id="datatable4" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ArticleCode</th>
                                            <th>ArticleTitle</th>
                                            <th>AddedBy</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>Assign</td>
                                        </tr>
                                         
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                   <!-- End code for QA tables -->

                   <!-- Start code for Articles Available For Packaging tables -->
                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title" >Complete Articles: XML Compilation</h4> 
                            </div>
                            <div class="card-body">

                                <table id="datatable5" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ArticleCode</th>
                                            <th>ArticleTitle</th>
                                            <th>AddedBy</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>Assign</td>
                                        </tr>
                                         
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                   <!-- End code for Articles Available For Packaging tables -->
                    <!-- Start code for Articles Available For Delivery tables -->
                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title" >Article Rejected By XML Quality Assurance</h4> 
                            </div>
                            <div class="card-body">

                                <table id="datatable6" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ArticleCode</th>
                                            <th>ArticleTitle</th>
                                            <th>AddedBy</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>Assign</td>
                                        </tr>
                                         
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                   <!-- End code for Articles Available For Delivery tables -->



            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

!--</script>-->
<script type="text/javascript">
        $(document).ready(function() {
            $('#test23').click(function(){

                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("ajax_ebm_details_journalwise.php", {
                        term: inputVal
                    }).done(function(data) {

                        // Display the returned data in browser

                        resultDropdown.html(data);


                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function() {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();

                var journalID = document.getElementById("journal_id").value;

                $.ajax({
                        url: "ajax_ebm_details_journalwise.php",
                        method: "POST",
                        data: {
                            journalID:journalID
                        }
                        


                    }).done(function(data){
            $("#response").html(data);});


            });

        });
    </script>


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


<script>

$(document).ready(function() {
    
    $('#datatable1').DataTable();
    $('#datatable2').DataTable();
    $('#datatable3').DataTable();
    $('#datatable4').DataTable();
    $('#datatable5').DataTable();
    $('#datatable6').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'colvis']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    $(".dataTables_length select").addClass('form-select form-select-sm');
});
</script>

<script>
        function unAssignArticles() {
        $.ajax({
            url: "ajax_file_for_xml_val.php",
            method: "POST",
            data: {
                ajax: 'forUnAssignArticles'
            },
            success: function (response) {
                $('#unAssignSection').append().html(response);
            },
            error: function (xhr, status) {
                alert("Sorry, there was a problem!");
            },
           
        });
    }
    function assignArticles() {
        $.ajax({
            url: "ajax_file_for_xml_val.php",
            method: "POST",
            data: {
                ajax: 'forAssignArticles',
            },
            success: function (response) {
                $('#selfAssignSection').append().html(response);
            },
            error: function (xhr, status) {
                alert("Sorry, there was a problem!");
            },
           
        });
    }
    function acceptArticles() {
        $.ajax({
            url: "ajax_file_for_xml_val.php",
            method: "POST",
            data: {
                ajax: 'forAcceptArticles',
            },
            success: function (response) {
                $('#selfAcceptSection').append().html(response);
            },
            error: function (xhr, status) {
                alert("Sorry, there was a problem!");
            },
            
        });
    }
    function widgetFunction() {
        var status = ['Assigned','InProgress','Holded','Completed','Reassigned'];

        $.ajax({
            url: "ajax_file_for_xml_val.php?widgets=forWidgets",
            method: "POST",
            data: {for: status},
            success: function (widgetCount) {
                var widgetEncodedCounts = JSON.parse(widgetCount);
                var unAssignedCount = parseInt(widgetEncodedCounts[0].unAssignCount);
                var assignedCount = parseInt(widgetEncodedCounts[1].Assigned);
                var inProgressCount = parseInt(widgetEncodedCounts[2].InProgress);
                var holdedCount = parseInt(widgetEncodedCounts[3].Holded);
                var completedCount = parseInt(widgetEncodedCounts[4].Completed);
                var reassignedCount = parseInt(widgetEncodedCounts[5].Reassigned);

                $(document).find('.unAssignedWidget').attr('data-target',unAssignedCount);
                
                $(document).find('.assignWidget').attr('data-target',assignedCount);

                $(document).find('.acceptedWidget').attr('data-target',inProgressCount);

                $(document).find('.holdedWidget').attr('data-target',holdedCount);

                $(document).find('.completedWidget').attr('data-target',completedCount);

                $(document).find('.rejectedWidget').attr('data-target', reassignedCount);
                
                console.log(widgetEncodedCounts);
            },
            error: function (xhr, status) {
                alert("Sorry, there was a problem!");
            },
            complete: function (xhr, status) {

            }
        });
    }
</script>

<script>
$(document).ready(function() {
    widgetFunction();
    unAssignArticles();
    assignArticles();
    acceptArticles();

});

$(document).on('click','.selfAssignArticle',function(){
    var ps_id = $(this).parent().find('input[name="ps_id"]').val();
    var ar_id = $(this).parent().find('input[name="ar_id"]').val();
    var ast_id = $(this).parent().find('input[name="ast_id"]').val();
    var user_id = $(this).parent().find('input[name="user_id"]').val();
    var from = 'selfAssign';

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to assign this article to your self!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, assign to me!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonClass: 'btn btn-danger ms-2 mt-2',
        buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: "Assign_Article_User_db.php?ajax=assignSection",
                        method: "POST",
                        data: {
                            ps_id: ps_id,
                            ar_id: ar_id,
                            ast_id: ast_id,
                            user_id: user_id,
                        },
                        success: function (data) {
                            widgetFunction();
                            unAssignArticles();
                            assignArticles();
                        },
                        error: function (xhr, status) {
                            alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                        }
                    });
                }
            });
});
$(document).on('click','.selfAcceptArticle',function(){
    var ps_id = $(this).parent().find('input[name="ps_id"]').val();
    var ar_id = $(this).parent().find('input[name="ar_id"]').val();
    var ast_id = $(this).parent().find('input[name="ast_id"]').val();
    var user_id = $(this).parent().find('input[name="user_id"]').val();
    var from = 'selfAccept';

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to accept this article to your self!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonClass: 'btn btn-danger ms-2 mt-2',
        buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: "QA_Accept_db1.php?ajax=acceptSection",
                        method: "POST",
                        data: {
                            ps_id: ps_id,
                            ar_id: ar_id,
                            ast_id: ast_id,
                            user_id: user_id,
                        },
                        success: function (data) {
                            widgetFunction();
                            assignArticles();
                            acceptArticles();
                        },
                        error: function (xhr, status) {
                            alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                        }
                    });
                }
            });
});
</script>

</body>

</html>