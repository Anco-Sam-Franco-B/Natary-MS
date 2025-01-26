<?php
    if(isset($_GET['docid'])){
        echo'
            <script>
                const confirmDelete=confirm("Are you sure you want to delete this document?");
                if(confirmDelete){
                    window.location.href="delete.php?docid='.$_GET['docid'].'";
                }
                else{
                    window.location.href="documents.php";
                }
            </script>
        ';
    }
    else if(isset($_GET['agreementid'])){
        echo'
            <script>
                const confirmDelete=confirm("Are you sure you want to delete this agreement?");
                if(confirmDelete){
                    window.location.href="delete.php?agreementid='.$_GET['agreementid'].'";
                }
                else{
                    window.location.href="documents.php";
                }
            </script>
        ';
    }
    else if(isset($_GET['all'])){
        echo'
            <script>
                const confirmDelete=confirm("Are you sure you want to delete all documents and  agreements?");
                if(confirmDelete){
                    window.location.href="delete.php?all";
                }
                else{
                    window.location.href="documents.php";
                }
            </script>
        ';
    }
    else if(isset($_GET['allAgree'])){
        echo"
            <script>
                const confirmDelete=confirm('Are you sure you want to delete all agreements?');
                if(confirmDelete){
                    window.location.href='delete.php?allAgree';
                }
                else{
                    window.location.href='agreements.php';
                }
            </script>
        ";
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