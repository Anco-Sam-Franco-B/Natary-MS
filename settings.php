<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: login.php");
    }
    include('./includes/configs/DBconfig.php');
    $page_title='Settings | Document Management System';
    include('./includes/pages/header.php');
?>

    <div class="settings">
        <div class="settings-header">
            <h3><i class="fas fab fa-cogs icon"></i> Settings</h3>
        </div>
        <div class="settings-body">
            <?php
                $system=mysqli_query($con, "SELECT * FROM settings");
                while($row=mysqli_fetch_assoc($system)){
            ?>
            <div class="settings-content">
                    <h4>Change System Name</h4>
                    <form action="" method="POST">
                        <input type="text" name="systemName" placeholder="System Name" value="<?php echo $row['title'] ?>" required>
                        <div class="btn">
                        <button type="submit" name="changeName">Change Name</button>
                        </div>
                    </form>
            </div>
            <?php
                }
            ?>
            <div class="settings-content">
                <h4>Change Password</h4>
                <form action="" method="POST">
                    <input type="password" name="oldPassword" placeholder="Old Password" required>
                    <input type="password" name="newPassword" placeholder="New Password" required>
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                    <div class="btn">
                    <button type="submit" name="changePassword">Change Password</button>
                    </div>
                </form>
            </div>
    </div>

<?php

    if(isset($_POST['changeName'])){
        $systemName=$_POST['systemName'];
        $update=mysqli_query($con,"UPDATE settings SET title='$systemName' WHERE id=1");
        if($update){
            echo "<script>
            window.location.href='settings.php';
            alert('System Name Updated Successfully');
            </script>";
        }
        else{
            echo "<script>alert('System Name Update Failed')</script>";
        }
    }

    if(isset($_POST['changePassword'])){
        $oldPassword=$_POST['oldPassword'];
        $newPassword=$_POST['newPassword'];
        $confirmPassword=$_POST['confirmPassword'];

        $oldPassword=md5($oldPassword);
        $newPassword=md5($newPassword);
        $confirmPassword=md5($confirmPassword);

        $check=mysqli_query($con,"SELECT * FROM users WHERE password='$oldPassword'");
        if(mysqli_num_rows($check)>0){
            if($newPassword==$confirmPassword){
                $update=mysqli_query($con,"UPDATE users SET password='$newPassword' WHERE password='$oldPassword'");
                if($update){
                    echo "<script>alert('Password Updated Successfully')</script>";
                }
                else{
                    echo "<script>alert('Password Update Failed')</script>";
                }
            }
            else{
                echo "<script>alert('New Password and Confirm Password does not match')</script>";
            }
        }
        else{
            echo "<script>alert('Old Password is incorrect')</script>";
        }
    }

    include('./includes/pages/footer.php');
?>