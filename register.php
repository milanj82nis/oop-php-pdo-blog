<?php
require_once 'include/db.inc.php';
require_once 'include/class_autoloder.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once 'partials/__head.php'; ?>
<style type="text/css">
  

  .my-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.my-form .row
{
    margin-left: 0;
    margin-right: 0;
}

.login-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.login-form .row
{
    margin-left: 0;
    margin-right: 0;
}
</style>

</head>

<body>

<?php require_once 'partials/__navigation.php'; ?>

<br><br>
<br><br>
<div class="container">
  

<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">

<?php 

try {

if( isset($_POST['register'])){

$name = trim(htmlspecialchars($_POST['name']));
$username = trim(htmlspecialchars($_POST['username']));
$email = trim(htmlspecialchars($_POST['email']));
$password = trim($_POST['password']);
$password_confirmation = trim($_POST['password_confirmation']);
$featured_image = trim($_POST['featured_image']);
$user = new User;
$user -> userRegistration( $name , $username , $email  , $password , $password_confirmation , $featured_image );

}// main isset

  
} catch ( PDOException $e) {
  echo $e -> getMessage();
}


?>

                            <form name="my-form"  action="register.php" method="post">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="full_name" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">Username</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_name" class="form-control" name="username">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Password </label>
                                    <div class="col-md-6">
                                        <input type="password" id="phone_number" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_address" class="col-md-4 col-form-label text-md-right">Repeat password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="present_address" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                                                    <div class="form-group row">
                                    <label for="featured_image" class="col-md-4 col-form-label text-md-right">Image</label>
                                    <div class="col-md-6">
                                        <input type="text" id="present_address" class="form-control" name="featured_image">
                                    </div>
                                </div>

                                          

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" name="register" class="btn btn-primary">
                                        Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

</div>
<br><br>
<br><br>





<?php require_once 'partials/__footer.php'; ?>



  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
