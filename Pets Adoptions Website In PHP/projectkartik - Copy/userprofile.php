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
    <title>userprofile Page</title>   
    <script src="registraation.js"></script>
</head>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php session_start(); 
?>
<body>
  <?php $sid2=$_SESSION['userid']; ?>
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
    ?>
          <div class="alert alert-success alert-dismissible mt-5 fade fixed-top show" role="alert">
          <Span> Details change successfully  </Span> 
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
      </div> <?php
      }}
?>
<?php
$user_con=null;
$user_success=null;
$user_error=null;
if($_SERVER['REQUEST_METHOD']=='POST'){
  if (isset($_POST['passwordedit'])) {
    $sid3=$_SESSION['userid'];
$currpass=$_POST['curpass'];
$newpass=$_POST['newpass'];
$conpass=$_POST['conpass'];
    $sql001="select * from user where User_ID= $sid3";
    $res=mysqli_query($conn,$sql001);
    if($res->num_rows>0){
        $data=$res->fetch_assoc();
        if($data['User_Password']===$currpass){
          if($newpass===$conpass){
          $sql002="UPDATE `user` SET User_Password='$newpass' WHERE `user`.`User_ID` = $sid3";
          $res4=mysqli_query($conn,$sql002);?>
          <div class="alert alert-success alert-dismissible mt-5 fade fixed-top show" >
          <Span>password changed successfully </Span> 
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
       </div> 
          <?php
          }
        
        else{  ?>
          <div class="alert alert-warning alert-dismissible mt-5 fade fixed-top show" role="alert">
          <Span>  password is not same </Span> 
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
          
      </div> <?php   
        }
    }else{ ?>
    <div class="alert alert-danger alert-dismissible mt-5 fade fixed-top show" >
          <Span>invalid current password  </Span> 
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div> <?php
     
    }}
}}
?>

      
      
  
<nav class="navbar  bg-dark body-tertiary ">
<a class="navbar-brand" href="#">
                  <h4 class="text-light ">PETS ADOPTION</h4>
                  <a class="" href="userhome.php">
                  <button class="btn btn-primary"><i class="fa fa-home fa-fw fa-2x" aria-hidden="true"></i></button></a>
</nav>


      
      <?php

  $conn5=new mysqli('localhost','root','','pets_adoption');
          $sql5 = " SELECT *FROM user WHERE User_ID='$sid2'";
          $res5=mysqli_query($conn5,$sql5);
          $rec2 = mysqli_fetch_assoc($res5);?>
          <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
<div class="col-xl-6 col-md-12">
                                                <div class="card user-card-full">
                                                    <div class="row m-l-0 m-r-0">
                                                        <div class="col-sm-4 bg-c-lite-green user-profile">
                                                            <div class="card-block text-center text-white">
                                                                <div class="m-b-25">
                                                                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                                                </div>
                                                                <h6 class="f-w-600"><?php echo $rec2['User_name'];?></h6>
                                                                <p><?php echo $rec2['User_Address'];?></p>
                                                                <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="card-block">
                                                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Email</p>
                                                                        <h6 class="text-muted f-w-400"><?php echo $rec2['User_Email'];?></h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Phone</p>
                                                                        <h6 class="text-muted f-w-400"><?php echo $rec2['User_Mobile_No'];?></h6>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Requested</p>
                                                                        <h6 class="text-muted f-w-400"> <?php
                
                $sql01="select * from requests inner join user where requests.User_ID=$sid2 and  requests.User_ID=user.User_ID";
                $result01=mysqli_query($conn5,$sql01);
                  
                    $count_active = mysqli_num_rows($result01);
                    echo $count_active; ?>
                </h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Adopted</p>
                                                                        <h6 class="text-muted f-w-400"> <?php
                
                                                                        $sql01="select * from accepted inner join user where accepted.User_ID=$sid2 and accepted.User_ID=user.User_ID";
                                                                        $result01=mysqli_query($conn5,$sql01);
                                                                          
                                                                            $count_active = mysqli_num_rows($result01);
                                                                            echo $count_active; ?></h6>
                                                                    </div>
                                                                </div>
                                                                <div class="">
      
          <button type="button" id="ADD" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#shelterModal"><i class="bi bi-plus-lg">edit details</i></button>
      
          <button type="button" id="ADD" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#PasswordModal"><i class="bi bi-plus-lg">Change Password</i></button>  </div> 
        </div>
                                                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             </div>
                                                </div>
                                            </div>
          
      </div> 
     <div class="modal fade" id="shelterModal" tabindex="-1" aria-labelledby="shelterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="shelterModalLabel">EDIT DETAILS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="myform" onsubmit="return myscript()" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $rec2['User_name'];?>" pattern="[A-Za-z\s]{3,}"  required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $rec2['User_Email'];?> " required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">phone no:</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $rec2['User_Mobile_No'];?>" pattern="[0-9]{10}" required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <input type="text" class="form-control" id="adress" name="adress" value="<?php echo $rec2['User_Address'];?>" required="">
          </div>
          <button type="submit" class="btn btn-primary form-control" id="sub" name="shelteredits">update</button>
        </form>
        <span id="error"></span>
      </div>
      
    </div>
  </div>
</div>
<div class="modal fade" id="PasswordModal" tabindex="-1" aria-labelledby="PasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="PasswordModalLabel">EDIT DETAILS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="myform" onsubmit="return myscript()" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Current Password:</label>
            <input type="text" class="form-control" id="curpass" name="curpass"  required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">New Password</label>
            <input type="text" class="form-control" id="newpass" name="newpass" required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Confirm Password</label>
            <input type="text" class="form-control" id="conpass" name="conpass"  required="">
          </div>
          
          <button type="submit" class="btn btn-primary form-control" id="sub" name="passwordedit">update</button>
        </form>
        <span id="error"></span>
      </div>
      
    </div>

</body>

</html>