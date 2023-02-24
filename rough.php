 <!-- Start code for QA: Assigned Article tables -->
 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">QA: Assigned Articles</h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Article Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv as $row_xmlc) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php

                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                     <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                                                    ?></td>
                                                <td><a href="QA_Accept.php?psid=<?php echo $PSIDQA; ?>&arid=<?php echo $row_xmlc["ArticleID"]; ?>&astid=1" class="btn btn-info">Accept</a>
                                                    <a href="QA_Reject.php?psid=<?php echo $PSIDQA; ?>&arid=<?php echo $row_xmlc["ArticleID"]; ?>&astid=1" class="btn  btn-danger">Reject</a>
                                                    <!-- <a href="#" class="btn btn-info">Revoke</a> -->
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <!-- End code for tables -->

                <!-- Start code for QA: Accepted Articles tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">QA: Accepted Articles</h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable3" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Article Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv1 as $row_xmlc1) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc1["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc1["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc1["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc1['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc1['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc1['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND
                                                    (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc1["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc1["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                                                    ?></td>
                                                <td><a href="QA_Hold.php?psid=<?php echo $PSIDQA; ?>&arid=<?php echo $row_xmlc1["ArticleID"]; ?>&astid=1" class="btn btn-primary">Hold</a>
                                                    <a href="QA_Complete.php?psid=<?php echo $PSIDQA; ?>&arid=<?php echo $row_xmlc1["ArticleID"]; ?>&astid=1" class="btn  btn-info">Complete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <!-- End code for tables -->


                <!-- Start code for QA: Articles On Hold tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">QA: Articles On Hold</h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable4" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Article Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv2 as $row_xmlc2) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc2["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc2["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc2["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc2['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc2['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc2['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc2["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc2["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc2["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc2["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc2["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc2["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";

                                                    ?></td>
                                                <td><a href="QA_UnHold.php?psid=<?php echo $PSIDQA; ?>&arid=<?php echo $row_xmlc2["ArticleID"]; ?>&astid=1" class="btn btn-info">Unhold</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <!-- End code for tables -->

                <!-- Start code for QA: Completed Articles tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">QA: Completed Articles</h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable5" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Article Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv3 as $row_xmlc3) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc3["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc3["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc3["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc3['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc3['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc3['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc3["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc3["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc3["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc3["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc3["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc3["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                                                    ?></td>
                                                <!-- <td><a href="Assign_Article_.php?psid=<?php echo $PSIDQA; ?>&arid=<?php echo $row_xmlc3["ArticleID"]; ?>&astid=1" class="btn btn-success">Submit</a>
                                                     <a href="#" class="btn btn-info">Revoke</a> 
                                                </td> -->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <!-- End code for tables -->

                <!-- Start code for QA: Rejected Article tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">QA: Rejected Articles</h4> <!-- By QA Stage -->
                            </div>
                            <div class="card-body">

                                <table id="datatable6" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Article Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv4 as $row_xmlc4) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc4["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc4["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc4["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc4['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc4['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc4['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc4["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc4["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc4["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc4["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc4["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc4["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                                                    ?></td>
                                                <td><a href="QA_Assign_Article_User.php?psid=<?php echo $PSIDQA; ?>&arid=<?php echo $row_xmlc4["ArticleID"]; ?>&astid=1" class="btn btn-info">Assign</a>
                                                    <!-- <a href="#" class="btn btn-info">Revoke</a> -->
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->