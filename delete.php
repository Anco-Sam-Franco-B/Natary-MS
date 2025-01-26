<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: login.php");
    }
    include('./includes/configs/DBconfig.php');
    if(isset($_GET['docid'])){
        $getDOCID=$_GET['docid'];
        $delete=mysqli_query($con,"DELETE FROM documents WHERE doc_id='$getDOCID'");
        $deleteAgreement=mysqli_query($con,"DELETE FROM agreement WHERE doc_id='$getDOCID'");
        if($delete && $deleteAgreement){
            echo"
                <script>
                    alert('Document deleted and it\'s Agreements successfully');
                    window.location.href='documents.php';
                </script>"; 
        }
        else{
            echo"
                <script>
                    alert('Failed to delete document and it\'s Agreements');
                    window.location.href='documents.php';
                </script>"; 
        }
    }
    else if(isset($_GET['agreementid'])){
        $getAgreeID=$_GET['agreementid'];
        $status='Pending';
        $Agreement=mysqli_query($con,"SELECT * FROM agreement WHERE agree_id='$getAgreeID'");
            $row = mysqli_fetch_assoc($Agreement);
            $ID = $row['doc_id'];
        $deleteAgreement=mysqli_query($con,"DELETE FROM agreement WHERE agree_id='$getAgreeID'");
        if($deleteAgreement){
            $updateStatus=mysqli_query($con,"UPDATE documents SET status='$status' WHERE doc_id='$ID'");
            if($updateStatus){
                echo"
                    <script>
                        alert('Agreement deleted and document status updated to Pending successfully');
                        window.location.href='agreements.php';
                    </script>"; 
            } else {
                echo"
                    <script>
                        alert('Agreement deleted but failed to update document status');
                        window.location.href='agreements.php';
                    </script>"; 
            }
        }
        else{
            echo"
                <script>
                    alert('Failed to delete Agreement');
                    window.location.href='agreements.php';
                </script>"; 
        }
    }
    else if(isset($_GET['all'])){
        $deleteALLDoc=mysqli_query($con,"TRUNCATE documents");
        $deleteAllAgree=mysqli_query($con, "TRUNCATE agreement");
        if($deleteALLDoc && $deleteAllAgree){
            echo"
                <script>
                    alert('All Documents and Agreements deleted successfully');
                    window.location.href='documents.php';
                </script>"; 
        }
        else{
            echo"
                <script>
                    alert('Failed to delete all documents and Agreements');
                    window.location.href='documents.php';
                </script>"; 
        }
    }
    else if(isset($_GET['allAgree'])){
        $deleteAllAgree=mysqli_query($con, "TRUNCATE agreement");
        $updateDocStatus=mysqli_query($con, "UPDATE documents SET status='Pending' WHERE status='Success'");
        if($deleteAllAgree && $updateDocStatus){
            echo"
                <script>
                    alert('All Agreements deleted successfully');
                    window.location.href='agreements.php';
                </script>"; 
        }
        else{
            echo"
                <script>
                    alert('Failed to delete all Agreements');
                    window.location.href='agreements.php';
                </script>"; 
        }
    }
    else{
        echo'
            <script>
                alert("Invalid request");
                window.location.href="index.php";
            </script>
        ';
    }
?>