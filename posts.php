<?php session_start();?>
<?php
include("connection.php");
     if(isset($_FILES['feat_image'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        if($title != "" && $description !="" && $category != ""){
          $uploadok = 1;
          $file_name = $_FILES['feat_image']['name'];
          $file_size = $_FILES['feat_image']['size'];
          $file_tmp = $_FILES['feat_image']['tmp_name'];
          $file_type = $_FILES['feat_image']['type'];
          $target_dir = "assets/featuredimages";
          $target_file = $target_dir . basename($_FILES['feat_image']['name']);
          $check = getimageSize($_FILES['feat_image']['tmp_name']);


$file_ext = strtolower(@end(explode('.', $_FILES['feat_image']['name'])));



$extensions = array("jpeg", "jpg" ,"png" );
if(in_array($file_ext, $extensions) == false) {
  $msg = "please choose the image which has the extension as jpeg, jpg or png";
}
if(file_exists($target_file)){
  $msg = "Sorry! file already exist";

}
if($check == false){
  $msg = "File is not an image!";
}
if(empty($msg)== true){
  move_uploaded_file($file_tmp, "assets/featuredimages/" . $file_name);
  $url = $_SERVER['HTTP_REFERER'];
  $seg = explode('/' , $url);
  $path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
  $full_url = $path.'/'.'assets/featuredimages/'.$file_name;
  $id = $_SESSION['id'] ;
  echo $sql = "INSERT INTO posts(title, description, category, feat_image, usr_role) VALUES('$title', '$description', '$category' , '$full_url', '$id')";

  exit();
  $query = $conn->query($sql);
  if($query){
    header('Location:home.php');
  }
  else{
    $msg = "Failed to upload image!";



}

}



}
        else{
          $msg = "please Fill all the details";
        }
}

 ?>

   <?php include("inc/header.php");?>

   <div class="container">
<form class="form-horizontal" action="post.php" method="POST" enctype="multipart/form-data">
			  <fieldset>
			    <legend>Add Post</legend>
			    <div class="row">
            <div class="col-md-6">
            <div class="form-group">
			      <label for="Title" class="col-lg-3 col-form-label">Title</label>
			      <div class="col-lg-9">
			        <input type="text" name="title" class="form-control " placeholder="Title">
			      </div>
			    </div>
        </div>
      </div>




      <div class="row">
        <div class="col-md-6">
        <div class="form-group">
        <label for="Title" class="col-lg-3 col-form-label">Description</label>
        <div class="col-lg-9">
<textarea class="form-control" rows="5" cols="10" name="description" placeholder="Description"></textarea>
        </div>
      </div>
      </div>
      </div>



      <div class="row">
        <div class="col-md-6">
        <div class="form-group">
        <label for="category" class="col-lg-3 col-form-label">Category</label>
        <div class="col-lg-9">
<select name="category" class="form-control">
<option>Select</option>
<option value="Entertainment">Entertainment</option>
<option value="Technology">Technology</option>
<option value="Sports">Sports</option>
<option value="Politics">Politics</option>

</select>
    </div>
      </div>
      </div>
      </div>



          <div class="row">
            <div class="col-md-6">
    <div class="form-group">
            <label for="avatar" class="col-lg-3 col-form-label">Featured Image</label>
            <div class="col-lg-9">
              <input type="file" name="feat_image" class="form-control " placeholder="Featured Image">
            </div>
          </div>
        </div>
      </div>



<br><br>




          <div class="row">
            <div class="col-md-6">
        <div class="form-group">
          <div class="col-lg-10">
              <input type="submit" name="profile" value="Add Post" class="btn btn-primary ">
              <button type="reset"  class="btn btn-default ">Cancel</button>


            </div>
          </div>
        </div>
      </div>






          <div class="row">
        <div class="form-group">
          <div class="col-lg-6">
<?php if(isset($_POST['post'])): ?>
  <div class="alert alert-dismissable alert-warning">

    <p><?php echo $msg;?></p>
  </div>
<?php  endif ?>
</div>
</div>
</div>

</fieldset>
</form>
</div>
