  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.php">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
<?php  

try {
  

  if( isset($_SESSION['logged'])){
?>
          <li class="nav-item">
            <a class="nav-link" href="">Welcome back , <?php echo $_SESSION['name']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" >
<form action="" method="post">
                  <?php 
                  $user = new User;
  
                  if( isset( $_POST['logged_out'])){
                    $user-> userLogout();
                    
                  }
                  ?>
                  <button tabindex="-1" class="" name="logged_out" style="border:none;"> Odjavi se</button>
                  </form></a>
          </li>

<?php 
if( isset($_SESSION['is_admin']) == 1 ){
?>
<li class="nav-item"><a  class="nav-link" href="dashboard.php">ADMIN</a></li>
<?php
}
?>






<?php
  }else {
?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>

<?php
  }
} catch ( PDOException $e) {
  echo $e -> getMessage();

}


?>




        </ul>
      </div>
    </div>
  </nav>