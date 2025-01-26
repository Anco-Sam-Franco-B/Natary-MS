<?php
    //============================ NATARY-MS LOGIN PAGE ============================//
    //============================                      ============================//

    session_start();
    if(isset($_SESSION['username'])){
        header("refresh:0 url=index.php");
    }
    include('./includes/configs/DBconfig.php');
    $page_title='LogIn | Document Management System';
    include('./includes/forms/LHeader.php');
?>

    <div class="form-box">
        <div class="form-header">
            <div class="logo fas fa-user-tie">
            </div>
            <h1>LogIn</h1>
        </div>
        <form action="" method="post">
            <div class="inputBox">
                <input type="text" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>">
                <i class="fas fab fa-user icon"></i>
            </div>

            <div class="inputBox">
                <input type="password" name="password" placeholder="Password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>">
                <i class="fas fab fa-lock icon"></i>
            </div>
            <div class="btn">
                <button name="NATARY-LOGIN"><i class="fas fa-sign-in-alt"></i>LogIn</button>
            </div>
            <div class="footer">
                <p>Document Management System</p>
            </div>
        </form>
    </div>

<?php
    if(isset($_POST['NATARY-LOGIN'])){
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        if($username && $password){
            $user=mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password'");
            if(mysqli_num_rows($user)>0){
                $_SESSION['username']=$username;
                echo"
                <script>
                    alert('Login Successfully....');
                </script>
            ";
                header("refresh:1 url=index.php");
            }
            else{
                echo"
                <script>
                    alert('Invalid username and password.');
                </script>
            ";
            }
        }
        else{
            echo"
                <script>
                    alert('All fields are required');
                </script>
            ";
        }
    }

    include('./includes/forms/LFooter.php')
?>