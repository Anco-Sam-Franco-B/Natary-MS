<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: login.php");
    }
    include('./includes/configs/DBconfig.php');
    $page_title='Documents | Document Management System';
    include('./includes/pages/header.php');
?>

<div class="table">
                    <div class="table-header">
                        <h3><i class="fas fab fa-file-alt icon"></i> Documents</h3>
                        <div class="search-input">
                            <input type="text" id="searchInput" placeholder="Search for document..">
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                        <a href='confirmation.php?all'><i class="fas fa-trash" title="Delete all Doc & Agrees"></i>Delete All</a>
                        <a href="new-doc.php"><i class="fas fa-plus" title="New Document"></i>New Doc</a>
                        </div>
                    </div>
                    <div class="table-body">
                        <table id="dataTable">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $view=mysqli_query($con,'SELECT * FROM documents WHERE doc_id ORDER BY updated_at DESC');
                                
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
                                ?>
                                                                <tr>
                                    <td><i class="fas fa-file-pdf"></i></td>
                                    <td><?php echo $row['doc_name'] ?></td>
                                    <td><?php echo $formatSize ?></td>
                                    <td><?php echo $status_view ?></td>
                                    <td><?php echo $row['created_at'] ?></td>
                                    <td><a href="readDoc.php?docid=<?php echo $row['doc_id'] ?>" title="Read Doc and Agreement or sign any Agreements" class="sign"><i class="fas fa-eye icon"></i>View</a></td>
                                    <td><a href="update.php?docid=<?php echo $row['doc_id'] ?>" title="Edit Doc" class="edit"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="confirmation.php?docid=<?php echo $row['doc_id'] ?>" title="Delete Doc" class="remove"><i class="fas fa-trash"></i> Remove</a></td>
                                </tr>
                                <?php
                                            }
                                        }
                                        else{
                                    ?>
                                    <tr>
                                        <td colspan="6" style="text-align: center;">
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

<?php
    include('./includes/pages/footer.php');
?>