<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: login.php");
    }
    include('./includes/configs/DBconfig.php');
    $page_title='DashBoard | Document Management System';
    include('./includes/pages/header.php');
    include('./DATACOUNT.php');
?>

    <div class="cards">

        <div class="card">
            <div class="card-header">
                <i class="fas fab fa-file-alt icon"></i>
                <h1>Documents</h1>
            </div>
            <div class="card-body">
                <h1><?php echo number_format($totalDoc) ?></h1>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-file-signature icon"></i>
                <h1>Agreements</h1>
            </div>
            <div class="card-body">
                <h1><?php echo number_format($totalAgree) ?></h1>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fab fa-check icon"></i>
                <h1>Completed Documents</h1>
            </div>
            <div class="card-body">
                <h1><?php echo number_format($totalDocSuccess) ?></h1>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-times icon"></i>
                <h1>Uncompleted Documents</h1>
            </div>
            <div class="card-body">
                <h1><?php echo number_format($totalDocPending) ?></h1>
            </div>
        </div>

    </div>

    <div class="recent">
            <div class="recent-header">
                <h2>Recently Acitivities <i class="fas fa-clock"></i></h2>
            </div>
            <div class="tables">
                <div class="table">
                    <div class="table-header">
                        <h3><i class="fas fab fa-file-alt icon"></i> Documents</h3>
                        <a href="documents.php"><i class="fas fa-eye"></i>More</a>
                    </div>
                    <div class="table-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $view=mysqli_query($con,'SELECT * FROM documents WHERE doc_id ORDER BY updated_at DESC LIMIT 6');
                                
                                        if(mysqli_num_rows($view)>0){
                                            while($row=mysqli_fetch_assoc($view)){
                                                // $_SESSION['doc_id']=$row['doc_id'];
                                                $size=$row['size'];
                                                $formatSize='';
                                                if($size >= 1048576) {
                                                     $formatSize=number_format($size / 1048576, 2) . ' MB';
                                                } elseif    ($size >= 1024) {
                                                     $formatSize=number_format($size / 1024, 2) . ' KB';
                                                } else {
                                                     $size . ' bytes';
                                                }

                                                //checking the doc status

                                                $status_view='';
                                                if($row['status']=='Pending'){
                                                    $status_view="
                                                        <div class='pending'>". $row['status'] ."</div>
                                                    ";
                                                }
                                                else if($row['status']=='Success'){
                                                    $status_view="
                                                         <div class='Success'>". $row['status'] ."</div>
                                                     ";
                                                }
                                                else{
                                                                                                        $status_view="
                                                         <div class='Failed'>". $row['status'] ."</div>
                                                     ";
                                                }
                                ?>
                                <tr>
                                <td><i class="fas fa-file-pdf"></i></td>
                                    <td><?php echo $row['doc_name'] ?></td>
                                    <td><?php echo $formatSize ?></td>
                                    <td><?php echo $status_view ?></td>
                                    <td><?php echo $row['created_at'] ?></td>
                                </tr>

                                <?php
                                            }
                                        }
                                        else{
                                    ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">
                                            <h3>There is no current Documents added.</h3>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="table">
                    <div class="table-header">
                        <h3><i class="fas fa-file-signature icon"></i> Agreements</h3>
                        <a href="agreements.php"><i class="fas fa-eye"></i>More</a>
                    </div>
                    <div class="table-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Buyer Name</th>
                                    <th>Seller Name</th>
                                    <th>UPI N&deg;</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                    $view=mysqli_query($con,'SELECT * FROM agreement WHERE agree_id ORDER BY update_at DESC LIMIT 6');
                                
                                        if(mysqli_num_rows($view)>0){
                                            while($row=mysqli_fetch_assoc($view)){
                            ?>
                                <tr>
                                <td><i class="fas fa-file-signature"></i></td>
                                    <td><?php echo $row['buyer_name'] ?></td>
                                    <td><?php echo $row['seller_name'] ?></td>
                                    <td><?php echo $row['upi'] ?></td>
                                    <td><?php echo $row['created_at'] ?></td>
                                </tr>
                                <?php
                                            }
                                        }
                                        else{
                                    ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">
                                            <h3>There is no current Agreements added.</h3>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

<?php
    include('./includes/pages/footer.php');
?>