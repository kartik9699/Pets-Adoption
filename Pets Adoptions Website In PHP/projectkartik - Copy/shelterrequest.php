<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="page.css">
    <title>ShelterrequestPage</title>   
</head>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php session_start(); 
?>
<body>
<nav class="navbar  bg-dark body-tertiary">
<a class="navbar-brand" href="#">
                  <h4 class="text-light ">PETS ADOPTION</h4>
                  <a  href="homepage.php">
                  <button class="btn btn-primary"><i class="fa fa-home fa-fw fa-2x" aria-hidden="true"></i></button></a>
</nav>
<div class="container">
        <div class="row">
    <?php
     $id=$_SESSION['ID'];
        $conn2=new mysqli('localhost','root','','pets_adoption');
          $sql = " SELECT *FROM requests INNER JOIN shelter on requests.Shelter_ID= shelter.Shelter_ID INNER JOIN user on requests.User_ID=user.User_ID INNER JOIN animal on requests.Animal_ID=animal.Animal_ID where shelter.Shelter_ID=$id";
          $res=mysqli_query($conn2,$sql);
          if($res->num_rows>0){
          while( $record = mysqli_fetch_assoc($res) ) {
         //'$_SESSION['animal_id']=$record['Animal_ID'];   
        ?>
        <div class="col-md-3 mt-2">
        <form method="post">
    <div class="card bg-body-secondary" style="width: 20rem;">
        <img src="./img/<?php echo $record['Animal_Img']; ?>" class="card-img-top" alt="..." style="width: 20rem; height: 10rem;">
        <div class="card-body">
          <p><strong><?php echo $record['Animal_Name'];?></strong>  </p>
          <p>Name:<?php echo $record['User_name'];?>  </p>
          <p>Gender:<?php echo $record['Animal_Gender'];?>  </p>
          <p>Age:<?php echo $record['Animal_Age'];?>  </p>
          <input type="hidden" name="animal_id" value="<?php echo $record['Animal_ID'];?>">
          <input type="hidden" name="shelter_id" value="<?php echo $record['Shelter_ID'];?>">
          <input type="hidden" name="request_id" value="<?php echo $record['Requests_ID'];?>">
          <input type="hidden" name="user_id" value="<?php echo $record['User_ID'];?>">
          <p>Address:<?php echo $record['User_Address'];?> </p>
          <button type="submit" class="butt" name="accept" >Accept</button>
          <button type="submit" class="butt" name="decline" >Decline</button>
        </div>
      </div>
    </form>    
      </div>
      <?php }
   
    }else{?><center><h2 class=" py-5 mt-5 fixed-center text-50px">No requests</h2></center><?php }?>
      </div>
      </div>
      <?php 
$conn3=new mysqli('localhost','root','','pets_adoption');
if($_SERVER['REQUEST_METHOD']=='POST'){ 
  if (isset($_POST['accept'])) {
    $request=$_POST['request_id'];
    $animal_ID1=$_POST['animal_id'];
    $shelter_ID1=$_POST['shelter_id'];
    $userid6=$_POST['user_id'];
    $req="select * from accepted where Animal_ID = '$animal_ID1' and User_ID='$userid6'";
    $req1=mysqli_query($conn3,$req);
    if($req1->num_rows>0){
      ?><div class="alert alert-warning alert-dismissible mt-5 fade fixed-top show" role="alert">
      <span>Your Already Accepted for this anmial</span>
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div><?php }else{
  $sql3="INSERT INTO accepted  ( Requests_ID,Animal_ID,Stat,User_ID,Shelter_ID) VALUES ('$request','$animal_ID1','Unseen','$userid6',$shelter_ID1)";
    $res3=mysqli_query($conn3,$sql3);
    $sql290=$sql10="UPDATE `animal` SET `Status` = 'Accepted' WHERE `animal`.`Animal_ID` = $animal_ID1";
    $res290=mysqli_query($conn3,$sql290);
  
    ?>
    <div class="alert alert-success alert-dismissible mt-5 fade fixed-top show" role="alert">
    <Span> request accept successfully  </Span> 
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
</div> <?php

  }
      }}
?>
 <?php 
     if($_SERVER['REQUEST_METHOD']=='POST'){ 
      if (isset($_POST['decline'])) {   
        $req_id=$_POST['request_id'];   
        $sql4 = "DELETE FROM requests WHERE Requests_ID='$req_id'";  
        $result4 =mysqli_query($conn2,$sql4);
          }}?>
   </body>
</html>