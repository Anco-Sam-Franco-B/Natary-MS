<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: login.php");
    }
    include('./includes/configs/DBconfig.php');
    $page_title='New Doc | Document Management System';
    include('./includes/pages/header.php');
?>

    <div class="form-box">
        <div class="form">
            <div class="form-header">
                <h1>New Doc</h1>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="doc_name" placeholder="Document Name" required>
                <label for="file">
                    <input type="file" name="pdf_file" id='file' accept="application/pdf" required>
                    Browser Document
                </label>
                <div class="btn">
                    <button name="save">Save & Upload</button>
                </div>
            </form>
        </div>
    </div>
<?php
                
                if(isset($_POST['save'])){
                    $msg='';
                    $fileName=$_FILES['pdf_file']['name'];
                    $fileTmp_name=$_FILES['pdf_file']['tmp_name'];
                    $fileType=$_FILES['pdf_file']['type'];
                    $fileError=$_FILES['pdf_file']['error'];
                    $fileSize=$_FILES['pdf_file']['size'];
                    $doc_name=$_POST['doc_name'];
                    $status='Pending';
                    
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowed = array('pdf');

                    if(in_array($fileExt, $allowed)){
                        if($fileError === 0){
                            if ($fileSize >= 1024 && $fileSize <= 104857600){
                                $fileNewName = uniqid($doc_name, true) . "." . $fileExt;
                                $fileDestination = 'DOC_uploads/' . $fileNewName;
                                mysqli_query($con,"INSERT INTO documents VALUES(NULL , '$doc_name', '$fileName', '$fileSize', '$fileDestination', '$status', NOW(), NOW())");
                                if(move_uploaded_file($fileTmp_name, $fileDestination)){
                                   $msg='
                                        <div class="msg success">
                                            <div class="msg-header">
                                                <h1>Message</h1>
                                            </div>
                                            <div class="msg-body">
                                                <p>Document uploaded successfully!</p>
                                            </div>
                                        </div>
                                   ';
                                   echo $msg;
                                }
                                else{
                                    $msg='
                                        <div class="msg error">
                                            <div class="msg-header">
                                                <h1>Message</h1>
                                            </div>
                                            <div class="msg-body">
                                                <p>Error moving the uploaded file.</p>
                                            </div>
                                        </div>
                                   ';
                                   echo $msg;
                                }
                            }
                            else{
                                $msg='
                                    <div class="msg error">
                                        <div class="msg-header">
                                            <h1>Message</h1>
                                        </div>
                                        <div class="msg-body">
                                            <p>File size must be between 1KB and 100MB.</p>
                                        </div>
                                    </div>
                                ';
                                echo $msg;
                            }
                        }
                        else{
                            $msg='
                                <div class="msg error">
                                    <div class="msg-header">
                                        <h1>Message</h1>
                                    </div>
                                    <div class="msg-body">
                                        <p>Error uploading the file' . $fileError .'</p>
                                    </div>
                                </div>
                            ';
                            echo $msg;
                        }
                    }
                    else{
                        $msg='
                            <div class="msg error">
                                <div class="msg-header">
                                    <h1>Message</h1>
                                </div>
                                <div class="msg-body">
                                    <p>Invalid file format. Only PDF files are allowed.</p>
                                </div>
                            </div>
                        ';
                        echo $msg;
                    }
                }

    include('./includes/pages/footer.php');
?>