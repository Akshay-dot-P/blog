<?php

require_once "controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($conn, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<?php
$id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$query = "SELECT * FROM profile WHERE id = '$id'";
$result = mysqli_query($conn, $query) or die('error');
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    $avatar = $row['avatar'];
    $profession = $row['profession'];
  }

}



 include("inc/header.php"); ?>
<div class="container">
  <?php include("inc/footer.php");?>
  <?php
  $url = $_SERVER['PHP_SELF'];
$seg = explode('/', $url);
$path = "http://127.0.0.1".$seg[0].'/'.$seg[1];
$full_url = $path.'/'.'img'.'/'.'avatar.png';

   ?>
   <h1 style="text-align: center;">Welcome <?php echo $fetch_info['name'] ?></p>
<div class="row">
  <div class="col-lg-12">
    <p style="text-align: center;">
      <img src=<?php echo $full_url;?> style="width: 200px;height: 200px;
      border-radius: 50%"/>
    </p>
  </div>
</div>
