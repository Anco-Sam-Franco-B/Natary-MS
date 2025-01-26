<?php
    include('./includes/configs/DBconfig.php');

    $countDoc=mysqli_query($con, "SELECT COUNT(*) as totalDoc FROM documents");
    $readDoc=mysqli_fetch_assoc($countDoc);
    $totalDoc=$readDoc['totalDoc'];

    $countDocPending=mysqli_query($con, "SELECT COUNT(*) as totalDocPending FROM documents WHERE status='Pending'");
    $readDocPending=mysqli_fetch_assoc($countDocPending);
    $totalDocPending=$readDocPending['totalDocPending'];

    $countDocSuccess=mysqli_query($con, "SELECT COUNT(*) as totalDocSuccess FROM documents WHERE status='Success'");
    $readDocSuccess=mysqli_fetch_assoc($countDocSuccess);
    $totalDocSuccess=$readDocSuccess['totalDocSuccess'];

    $countAgree=mysqli_query($con, "SELECT COUNT(*) as totalAgree FROM agreement");
    $readAgree=mysqli_fetch_assoc($countAgree);
    $totalAgree=$readAgree['totalAgree'];
?>