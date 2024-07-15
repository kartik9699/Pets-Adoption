<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
<?php 
    $user_error=null;
    $user_success=null;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $address=$_POST['Address'];
    $mob=$_POST['phone'];
    $pass=$_POST['pass'];
    $conn =new mysqli('localhost','root','','pets_adoption');
    $Email_query="select * from shelter where Shelter_Email='$email'";
    $res=mysqli_query($conn,$Email_query);
    if (mysqli_num_rows($res)>0) {
        $user_error="<p>email already registered</p>";
}   
    else{
        $sql="insert into shelter(Shelter_Name,Shelter_Adress,Shelter_Email,Shelter_Contact,Shelter_Password) values('$name','$address','$email','$mob','$pass')";
        $result=mysqli_query($conn,$sql);
        header("Location: shelter login.php");
}
}
//require ('register.php'); ?>
  <div class="wrapper">
        <h3>SHELTER REGISTRATION</h3>

        <form name="myform" onsubmit="return myscript()" action=""   method="post">
            <div class="single-div">
                <input type="text" name="name" id="name" required="" />
                <label> Shelter Name: </label>
            </div>
            <div class="single-div">
                <input type="text" name="phone" id="phone" required="" />
                <label>Shelter Phone:</label>
                <br>
            </div>
            <div class="single-div">
                <input type="text" name="Address" required="" />
                <label> Shelter Address:</label>
            </div>
            <div class="single-div">
                <input type="text" id="email" name="email" required="" />
                <label>Shelter Email:</label> <br>
            </div>
            <div class="single-div">
                <input type="Password" id="pass" name="pass" required="" /> <label> Password:</label>
            </div>
            <div class="single-div">
                <input type="Password" id="repass" name="repass" required="" /> <label>Re-type password:</label><span id="error">
                    <?php echo $user_error;?>
                </span>
            </div>
            <div class="sub"><input type="submit" class="btn btn-dark"  name="submit">
            </div>
        </form>
    </div>
<script src="registraation.js"></script>
  </body>
</html>


      