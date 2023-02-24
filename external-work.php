<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';?>
<?php if (!isset($_SESSION['Super Admin']) && !isset($_SESSION['XMLC'])) {
     header('Location: pages-403.php');
     exit; 
} ?>

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
<style>
    .img-fluid, .img-thumbnail {
        max-width: 20%;
    }
</style>
<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Step # 01</h4>
                            </div>
                            <div class="card-body p-4">
                                <form method="POST" action="external-work-db.php?from=stepOne" enctype="multipart/form-data">    
                                <div class="row">
                                    <div class="col-xs-6">

                                    </div>
                                    <div class="col-xs-6 d-flex justify-content-center">   
                                        <img class="img-thumbnail rounded" id="preview" src="#" alt="your image" />
                                    </div>
                                </div>    
                                <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input class="form-control" type="text" value="" id="name" name="name" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="image" class="form-label" required>Image</label>
                                            <input class="form-control" type="file" value="" id="image" name="image" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="code" class="form-label">Code</label>
                                            <input class="form-control" type="text" value="" id="code" name="code" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="type" class="form-label">Type</label>
                                            <input class="form-control" type="text" value="" id="type" name="type" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input class="form-control" type="number" value="" id="quantity" name="quantity" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">P-Value</label>
                                            <select class="form-select" name="p-value" id="pValue" required>
                                                <option selected disabled value="">Select</option>
                                                <option value="0.75" data-id="0.75">22</option>
                                                <option value="0.875" data-id="0.875">26</option>
                                                <option value="0.916" data-id="0.916">28</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="upEmail" class="form-label">Up-Email</label>
                                            <input class="form-control" type="number" value="" id="upEmail" name="upEmail" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="pEmail" class="form-label">P-Email</label>
                                            <input class="form-control" type="number" value="" id="pEmail" name="pEmail" required>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="rFlow" class="form-label">R-Flow</label>
                                            <input class="form-control" type="number" value="" id="rFlow" name="rFlow" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="wtgValue" class="form-label">WTG-Value</label>
                                            <input class="form-control" type="number" value="" id="wtgValue" name="wtgValue" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="tValues" class="form-label">T-Values</label>
                                            <input class="form-control" type="number" value="" id="tValues" name="tValues" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-label" required>Date</label>
                                            <input class="form-control" type="date" value="" name="date" id="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-end mt-1">
                                            <input type="submit" class="btn btn-success" value="Save">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Step # 02</h4>
                            </div>
                            <div class="card-body p-4">
                                <form method="POST" action="/external-work-db.php?from=stepTwo">    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Code</label>
                                            <select class="form-select" name="stepTwoCode" id="stepTwoCode" required>
                                                <option selected value="">Select</option>
                                                <?php 
                                                    $getQuery = "SELECT * FROM `externalWorkStepOne` WHERE `status` = 'Active'";
                                                    $queryStatement = $pdo->prepare($getQuery);
                                                    if($queryStatement->execute()){
                                                        $getRows = $queryStatement->fetchAll();
                                                        foreach ($getRows as $key => $value) {
                                                            echo "<option value='".$value['code']."'>".$value['code']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input class="form-control" type="text" id="stepTwoName" name="name" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="difference" class="form-label">Difference</label>
                                            <input class="form-control" type="number" value="" id="stepTwoDifference" name="difference" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="poWas" class="form-label">Po-Was</label>
                                            <input class="form-control" type="number" value="" id="poWas" name="poWas" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="psEmail" class="form-label">Ps-Email</label>
                                            <input class="form-control" type="number" value="" id="psEmail" name="psEmail" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="date" class="form-label">Date</label>
                                            <input class="form-control" type="date" value="" id="date" name="date" required>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-end mt-1">
                                            <input type="submit" class="btn btn-success" value="Save">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
        <script>
        $(document).ready(function() {
            $('#preview').css("display", "none");
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
    image.onchange = evt => {
    const [file] = image.files
        if (file) {
            preview.src = URL.createObjectURL(file);
            $('#preview').css("display", "block");
        }
    }
</script>
<script>
    $(document).on('keyup', '#rFlow', function(e){
        e.preventDefault();
        var constantValue = 96;
        var rFlowValue = parseInt($(this).val());
        var upEmail = parseInt($(document).find('#upEmail').val());
        var pValues = [];
        $.each($("#pValue option:selected"), function(){            
            pValues.push($(this).val());
        });
        var sPValue = pValues[0];
        
        if(isNaN(upEmail)){
            alert('Please Insert The Up Email Value');
            $(document).find('#rFlow').val('');
            return false;
        }else{
            

            var wtgValue = (upEmail * rFlowValue / constantValue);
            
            $(document).find('#wtgValue').val(wtgValue);
            
            var tValues = (upEmail + wtgValue * sPValue);
            
            $(document).find('#tValues').val(tValues);
            
            console.log(wtgValue+','+tValues);
        }
    });
</script>
<script>
    $(document).on('change', '#stepTwoCode', function(e){
        e.preventDefault();
            $.ajax({
            url: "external-work-db.php?ajax=getData",
            method: "POST",
            data: {
                code: $(this).val()
            },
            success: function (response) {
                var data = JSON.parse(response);
                var name = data[0].name;
                var upEmail = parseInt(data[0].upEmail, 10);
                var pemail = parseInt(data[0].pEmail, 10);
                var constantValue =  96;
                var difference = (upEmail-pemail);
                var poWas = (upEmail / 1);
                poWas = (poWas / constantValue);
                var psEmail = (difference - poWas);

                $(document).find('#stepTwoName').val(name);
                $(document).find('#stepTwoDifference').val(difference);
                $(document).find('#poWas').val(poWas);
                $(document).find('#psEmail').val(psEmail);
                console.log('difference:'+difference+',poWas:'+poWas+',psEmail:'+psEmail);


            },
            error: function (xhr, status) {
                alert("Sorry, there was a problem!");
            },
            complete: function (xhr, status) {
                //$('#showresults').slideDown('slow')
            }
        })
    });
</script>
</body>

</html>