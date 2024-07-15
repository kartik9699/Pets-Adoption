<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php 
session_start(); 
?>
<div class="container py-3">
       <div class="row"> 
  <?php
  $id=$_SESSION['ID']; 
  $conn =new mysqli('localhost','root','','pets_adoption');
  
   $name = $_POST['name'];
  
   $sql = "SELECT * FROM  animal inner join shelter WHERE (Animal_Name LIKE '$name%'or Animal_Type LIKE '$name%' or Animal_Breed LIKE '$name%') and animal.Shelter_ID=shelter.Shelter_ID and shelter.shelter_ID=$id";  
   $query = mysqli_query($conn,$sql);
   $data='';
     //display data in homepage
     while( $record = mysqli_fetch_assoc($query) )      
      $data.='<div class="col-lg mt-1">
      <form name="requests form"  method="post">
    
  <div class="card" id="showdata" style="width: 25rem;">  
  <div class="image">
      <img src="./img/'.$record['Animal_Img'].'" class="card-img-top" alt="..." style="width: 25rem; height: 15rem;">
      </div>
      <div class="card-body">
        <p>Name:'.$record['Animal_Name'].'
        <p>Breed:'.$record['Animal_Breed'].'
        <p>Gender:'.$record['Animal_Gender'].'&nbsp; Type:'.$record['Animal_Type'].'</p>
        <p>Age:'.$record['Animal_Age'].'&nbsp; Color:'.$record['Animal_Color'].' </p>
        <p>Health:'.$record['Animal_Health'].'  </p>
        <p>Description:'.$record['Animal_Description'].'  </p>
        <input type="hidden" name="animal_id" value="'.$record['Animal_ID'].'">
        <input type="hidden" name="shelter_id" value="'.$record['Shelter_ID'].'">
        <p class="phone"><i class="fa fa-phone " aria-hidden="true"></i>'.$record['Shelter_Contact'].' </p>
        <button type="button" id="Edit" name="edit" class="btn butt btn-info" data-bs-toggle="modal" data-bs-target="#editModal">EDIT INFO</button> <button type="submit" class="btn butt btn-danger" name="delete">Delete</button>
      </div>
        </div>
        </form> 
        </div>'  
        ?>
    <?php 
    echo $data
     ?>
     </div>
     </div>   
            

 
</body>
</html>
