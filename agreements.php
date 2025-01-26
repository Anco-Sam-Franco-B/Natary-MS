<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: login.php");
    }
    include('./includes/configs/DBconfig.php');
    $page_title='Agreements | Document Management System';
    include('./includes/pages/header.php');
?>

<div class="table">
                    <div class="table-header">
                        <h3><i class="fas fa-file-signature icon"></i> Agreements</h3>
                        <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                        <a href='confirmation.php?allAgree' title="Delete All Agreements"><i class="fas fa-trash"></i>Delete All</a>
                        </div>
                    </div>
                    <div class="table-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Buyer Name</th>
                                    <th>Seller Name</th>
                                    <th>UPI N&deg;</th>
                                    <!-- <th>Status</th> -->
                                    <th>Date</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $view=mysqli_query($con,'SELECT * FROM agreement WHERE agree_id ORDER BY update_at DESC');
                                
                                        if(mysqli_num_rows($view)>0){
                                            while($row=mysqli_fetch_assoc($view)){
                                ?>
                                <tr>
                                    <td><i class="fas fa-file-signature"></i></td>
                                    <td><?php echo $row['buyer_name'] ?></td>
                                    <td><?php echo $row['seller_name'] ?></td>
                                    <td><?php echo $row['upi'] ?></td>
                                    <td><?php echo $row['created_at'] ?></td>
                                    <td ><a href="readDoc.php?docid=<?php echo $row['doc_id'] ?>" title="Read Doc and Agreement or sign any Agreements" class="sign"><i class="fas fa-eye icon"></i>View</a></td>
                                    <td><a href="update.php?agreementid=<?php echo $row['agree_id'] ?>" title="Edit Doc" class="edit"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="confirmation.php?agreementid=<?php echo $row['agree_id'] ?>" title="Delete Agreement" class="remove"><i class="fas fa-trash"></i> Remove</a>
                                </td>
                                </tr>
                                <?php
                                            }
                                        }
                                        else{
                                    ?>
                                    <tr>
                                        <td colspan="6" style="text-align: center;">
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

<?php
    include('./includes/pages/footer.php');
?>