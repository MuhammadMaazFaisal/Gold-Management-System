
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

        <div class="row ">
            <div class="col-lg-8  mx-auto">
                <div class="card">
                    <div class="card-body">


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Add Gold Account Details</h4>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <form class="custom-validation" action="goldaccount_prev_db.php" method="post" enctype="multipart/form-data">

							<div class="form-group ">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" placeholder="Date">

                            </div>
                            <div class="form-group ">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>

                            </div>
                            <div class="form-group ">
                                <label>Gold Issued</label>
                                <textarea name="gold_issued" class="form-control"></textarea>

                            </div>
                           

                            <br>

                            <div class="form-group mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->
        <!-- End row -->

    