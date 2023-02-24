
<!doctype html>

<?php include '../layouts/session.php'; ?>
<?php include '../layouts/head-main.php'; ?>


<head>

    <title>Advanced Plugins | Minia - Admin & Dashboard Template</title>
    
    <script type="text/javascript" src="plugin/codemirror/lib/codemirror.js"></script>
    <script src="plugin/codemirror/addon/hint/show-hint.js"></script>
    <script src="plugin/codemirror/addon/hint/xml-hint.js"></script>
    <script src="plugin/codemirror/mode/xml/xml.js"></script>
    <?php include '../layouts/head.php'; ?>
    <!-- choices css -->
    <link href="../assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

    <!-- color picker css -->
    <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/classic.min.css" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/monolith.min.css" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/nano.min.css" /> <!-- 'nano' theme -->

    <!-- datepicker css -->
    <link rel="stylesheet" href="../assets/libs/flatpickr/flatpickr.min.css">
    
    <?php include '../layouts/head-style.php'; ?>

</head>

<?php include '../layouts/body.php'; ?>


<div class="main-content">

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include '../layouts/menu.php'; ?>

    
    <!-- end main content-->
    

</div>
<!-- END layout-wrapper -->














<!-- Right Sidebar -->
<?php include '../layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include '../layouts/vendor-scripts.php'; ?>

<!-- choices js -->
<script src="../assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- color picker js -->
<script src="../assets/libs/@simonwep/pickr/pickr.min.js"></script>
<script src="../assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

<!-- datepicker js -->
<script src="../assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- init js -->
<script src="../assets/js/pages/form-advanced.init.js"></script>

<script src="../assets/js/app.js"></script>

</body>

</html>