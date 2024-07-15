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
    <title>home Page</title>   
</head>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php 
session_start(); 
?>
<body>
<nav class="navbar  bg-dark body-tertiary">
<a class="navbar-brand" href="#">
                  <h4 class="text-light ">PETS ADOPTION</h4>
                  <a class="" href="homepage.php">
                  <button class="btn btn-primary"><i class="fa fa-home fa-fw fa-2x" aria-hidden="true"></i></button></a>
</nav>
<div class="container">
        <div class="row ">
    <?php
    $shelter=$_SESSION['ID'];
        $conn=new mysqli('localhost','root','','pets_adoption');
          $sql = " SELECT *FROM accepted INNER JOIN requests on accepted.Requests_ID= requests.Requests_ID INNER JOIN animal on accepted.Animal_ID=animal.Animal_ID INNER JOIN shelter on requests.Shelter_ID=shelter.Shelter_ID where requests.Shelter_ID=$shelter";
          $res=mysqli_query($conn,$sql);
          if($res->num_rows>0){
          while( $record = mysqli_fetch_assoc($res) ) {

         //'$_SESSION['animal_id']=$record['Animal_ID'];   
        ?>
        <div class="col-md-3 mt-2">
        <form method="post">
    <div class="card bg-body-secondary " style="width: 20rem;">
        <img src="./img/<?php echo $record['Animal_Img']; ?>" class="card-img-top" alt="..." style="width: 20rem; height: 10rem;">
        <div class="card-body">
          <p class="card-text"><strong><?php echo $record['Animal_Name'];?></strong> </p>
          <p class="card-text">Breed:<?php echo $record['Animal_Breed'];?> </p>
          <p class="card-text">Gender:<?php echo $record['Animal_Gender'];?>  </p>
          <p class="card-text">Age:<?php echo $record['Animal_Age'];?>  </p>
          <input type="hidden" name="animal_id" value="<?php echo $record['Animal_ID'];?>">
          <input type="hidden" name="shelter_id" value="<?php echo $record['Shelter_ID'];?>">
        </div>
      </div>
          </form>
          </div>
      <?php }}else{ ?><center><h2 class=" py-5 mt-5 fixed-center text-50px">Not adopted any pets</h2></center><?php }?>
    </div>
  
</div>