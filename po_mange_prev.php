
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
                                    <h4 class="mb-sm-0 font-size-18">Create New Purchase Order</h4>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <form class="custom-validation" action="goldaccount_prev_db.php" method="post" enctype="multipart/form-data">

							<div class="form-group ">
                                <label>Supplier</label>
                                <select required="" name="name"  required class="form-control form-select">
																			<option value="">Select supplier</option>
																			<?php 
																			$getQuery = "SELECT * FROM `supplier_list`";
																			$queryStatement = $pdo->prepare($getQuery);
																			if($queryStatement->execute()){
																				$getRows = $queryStatement->fetchAll();
																				foreach ($getRows as $key => $value) {
																					echo "<option value='".$value['id']."'>".$value['name']."</option>";
																				}
																			}
																		?>
																		</select>

                            </div>
                            <div class="form-group ">
                                <label>Item</label>
                                <select required="" name="type" class="form-control form-select">
																					<option value="">Select Item</option>
																					<option value="Stone ">Stone</option>
																					<option value="Dull">Dull</option>
																					<option value="Meena">Meena</option>
																					<option value="Ruby">Ruby</option>
																					<option value="Green">Green</option>
																					<option value="Sapphire">Sapphire</option>
																					<option value="Topas">Topas</option>
																					<option value="Turmaline">Turmaline</option>
																					<option value="Lekar">Lekar</option>
																					<option value="Cubic Baquets">Cubic Baquets</option>
																					<option value="Korean Baquets">Korean Baquets</option>
																					<option value="Color Stones">Color Stones</option>
																					<option value="Blue">Blue</option>
																					<option value="Pearl">Pearl</option>
																					<option value="Packet">Packet</option>
																					
																				</select>

                            </div>
                            <div class="form-group ">
                                <label>Unit</label>
                                <input name="unit" class="form-control" />

                            </div>
                            <div class="form-group ">
                                <label>Qty</label>
                                <input name="qty" class="form-control" />

                            </div>
                            <div class="form-group ">
                                <label>Cost</label>
                                <input name="cost" class="form-control" />

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

    