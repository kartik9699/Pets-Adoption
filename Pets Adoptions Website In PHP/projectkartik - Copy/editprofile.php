<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="Profile.css">
    <title>editprofile Page</title>   
</head>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php session_start(); 
?>
<body>
<nav class="navbar  bg-dark body-tertiary ">
<a class="navbar-brand" href="#">
                  <h4 class="text-light ">PETS ADOPTION</h4>
                  <a class="" href="userhome.php">
                  <button class="btn btn-primary"><i class="fa fa-home fa-fw fa-2x" aria-hidden="true"></i></button></a>
</nav>


      
      <?php
$sid2=$_SESSION['userid'];
  $conn5=new mysqli('localhost','root','','pets_adoption');
          $sql5 = " SELECT *FROM user WHERE User_ID='$sid2'";
          $res5=mysqli_query($conn5,$sql5);
          $rec2 = mysqli_fetch_assoc($res5);?>
          <div class="container mt-3">
        <form name="myform" onsubmit="return myscript()" method="post">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $rec2['User_name'];?>" required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $rec2['User_Email'];?> " required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">phone no:</label>
            <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $rec2['User_Mobile_No'];?>" required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <input type="text" class="form-control" id="adress" name="adress" value="<?php echo $rec2['User_Address'];?>" required="">
          </div>
          <button type="submit" class="btn btn-primary form-control" id="sub" name="shelteredits">update</button>
        </form>
        <span id="error"></span>
      </div>
<?php
$conn =new mysqli('localhost','root','','pets_adoption');
if($_SERVER['REQUEST_METHOD']=='POST'){ 
  if (isset($_POST['shelteredits'])) {
$username=$_POST['name'];
$useremail=$_POST['email'];
$id2=$_SESSION['userid'];
$userphone=$_POST['phone'];
$useradress=$_POST['adress'];
$sql10="UPDATE `user` SET `User_Name` = '$username',`User_Address` = '$useradress', `User_Email` = '$useremail', `User_Mobile_No` = '$userphone' WHERE `user`.`User_ID` = $id2";
    $res4=mysqli_query($conn,$sql10);
    header("Location: editprofile.php");
    exit;
      }}
?>


<script src="registraation.js"></script> 
</body>

</html>