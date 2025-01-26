<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: login.php");
    }
    include('./includes/configs/DBconfig.php');
    $page_title='Update | Document Management System';
    include('./includes/pages/header.php');

    if(isset($_GET['docid'])){
        $id=$_GET['docid'];
        $view=mysqli_query($con,"SELECT * FROM documents WHERE doc_id='$id'");
        while($row=mysqli_fetch_assoc($view)){
?>

    <div class="form-box">
        <div class="form">
            <div class="form-header">
                <h1>Update Document</h1>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="doc_name" value="<?php echo $row['doc_name'] ?>" required>
                <input type="hidden" name="doc_id" value="<?php echo $id ?>">
                <div class="btn">
                    <button type="submit" name="update_doc">Update Document</button>
                </div>
            </form>
        </div>
    </div>

<?php
        }

        if(isset($_POST['update_doc'])){
            $doc_name=$_POST['doc_name'];
            $update=mysqli_query($con,"UPDATE documents SET doc_name='$doc_name' WHERE doc_id='$id'");
            if($update){
                echo"
                    <script>
                        alert('Document updated successfully');
                        window.location.href='documents.php';
                    </script>";
            }
            else{
                echo"
                    <script>
                        alert('Failed to update document');
                        window.location.href='documents.php';
                    </script>";
    
            }
        }

    }
    else if(isset($_GET['agreementid'])){
        $id=$_GET['agreementid'];
        $view=mysqli_query($con,"SELECT * FROM agreement WHERE agree_id='$id'");
        while($row=mysqli_fetch_assoc($view)){
?>
    
    <div class="form-box">
        <div class="form">
            <div class="form-header">
                <h1>Update Agreement</h1>
            </div>
            <form action="" method="POST">
                <input type="text" name="seller_name" value="<?php echo $row['seller_name'] ?>" required>
                <input type="text" name="buyer_name" value="<?php echo $row['buyer_name'] ?>" required>
                <input type="text" name="upi" value="<?php echo $row['upi'] ?>" required>
                <input type="hidden" name="agree_id" value="<?php echo $id ?>">
                <div class="btn">
                    <button type="submit" name="update_agreement">Update Agreement</button>
                </div>
            </form>
        </div>
    </div>
<?php
        }

        if(isset($_POST['update_agreement'])){
            $seller_name=$_POST['seller_name'];
            $buyer_name=$_POST['buyer_name'];
            $upi=$_POST['upi'];
            $update=mysqli_query($con,"UPDATE agreement SET seller_name='$seller_name', buyer_name='$buyer_name', upi='$upi' WHERE agree_id='$id'");
            if($update){
                echo"
                    <script>
                        alert('Agreement updated successfully');
                        window.location.href='agreements.php';
                    </script>";
            }
            else{
                echo"
                    <script>
                        alert('Failed to update agreement');
                        window.location.href='agreements.php';
                    </script>";
    
            }
        }
    }
   
    else{
        echo"
            <script>
                alert('Invalid request');
                window.location.href='index.php';
            </script>";
        }
    

    include('./includes/pages/footer.php');
?>