<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   
    <link rel="stylesheet" type="text/css" href="page.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <title>homePage</title>   
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
<?php 
  $id=$_SESSION['ID'];
  $conn =new mysqli('localhost','root','','pets_adoption');
   ?>
 <?php
// insert in aniaml database  

   if($_SERVER['REQUEST_METHOD']=='POST'){
   if (isset($_POST['sub'])) {
   $name=$_POST['name'];
   $type=$_POST['pets'];
   $breed=$_POST['breed'];
   $age=$_POST['age'];
   $color=$_POST['color'];
   $filename=$_FILES["choosefile"]["name"];
   $tempfile=$_FILES["choosefile"]["tmp_name"];
   $folder="img/".$filename;
   $descr=$_POST['descr'];
   $gender=$_POST['Gender'];
   
   $Email_query="select * from animal where Animal_Img='$filename'";
  $res=mysqli_query($conn,$Email_query);
  if (mysqli_num_rows($res)>0) {?>
     <div class="alert alert-warning alert-dismissible mt-5 fade show" role="alert">
     <span>Animal alredy register</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>  
 <?php }else{
   $sql="INSERT INTO animal (Animal_Name,Animal_Age,Animal_Breed,Animal_Color,Animal_Type,Animal_Description,Animal_Img,Animal_Gender,Shelter_ID,Status) VALUES ('$name','$age','$breed','$color','$type','$descr','$filename','$gender','$id','Not Accepted')";
   $result=mysqli_query($conn,$sql);
   move_uploaded_file($tempfile,$folder);
   
   ?>
   <div class="alert alert-success alert-dismissible mt-5 fade fixed-top show" role="alert">
   <Span> Added successfully  </Span> 
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
</div> <?php
 } }
 }?>

    <nav class="navbar bg-dark body-tertiary ">
        <div class="container-fluid"> 
                <a class="navbar-brand" href="#">                  
                  <h4 class="text-light">PETS ADOPTION</h4>
                </a>
                
                <?php
                
$sql01="select * from requests inner join shelter where requests.Shelter_ID=$id and Stat='Unseen' and requests.Shelter_ID=shelter.Shelter_ID ";
$result01=mysqli_query($conn,$sql01);
/**while($rows = mysqli_fetch_assoc($result01)){
  $count_active = mysqli_num_rows($result01);
}**/
?>
<div class="btn-group" role="group" aria-label="Basic example">
<form action="" method="post">
<a class="list-group-item" href="shelterrequest.php"><button type="submit" id="not" class="btn btn-outline-light lab"  name="not"><i class="fa fa-bell-o" aria-hidden="true"></i>&nbsp; Requested</button></a></i>&nbsp; Requested<span>
  <?php if($result01->num_rows>0){  
  $count_active = mysqli_num_rows($result01);
  echo $count_active;}else{} ?></span></button></a> 
</form>
  
  <a class="list-group-item" href="adopted.php"><button class="btn btn-outline-light lab"><i class="fa fa-check-circle " aria-hidden="true"></i>&nbsp;adopted</button> </a>
  <a class="list-group-item" href="profile.php"><button class="btn btn-outline-light lab"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp; Profile</button></a></div>
  <div class="addd">
                <button type="button" id="ADD" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-lg"></i>&nbsp;Add Animal</button>
      </div> 
      
      <div class="log"><a href="logout.php"><button type="button" class="btn btn-outline-primary"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</i></button></a></div>
        </div>
            
      </nav> 
               
    
      <?php
      if($_SERVER['REQUEST_METHOD']=='POST'){ 
        if (isset($_POST['not'])) {
          header("Location: shelterrequest.php"); 
          $sql7="UPDATE `requests` SET `Stat` = 'Seen' WHERE requests.Shelter_ID=$id and `requests`.`Stat` = 'Unseen'";
          $res02=mysqli_query($conn,$sql7); 
          
      
        }}
      ?>    
<!-- Modal -->    
      <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="exampleModalLabel">ADD ANIMAL DETAILS</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="myform" action="homepage.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal Name:</label>
            <input type="text" class="form-control" id="name" name="name" required  >
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal type:</label>
            <label for="" class="col-form-label">Dog:</label>
            <input type="radio"  id="dog" name="pets" value="dog">
            <label for="" class="col-form-label">Cat:</label>
            <input type="radio"  id="cat" name="pets" value="cat">
            <label for="" class="col-form-label">others:</label>
            <input type="radio"  id="others" name="pets" value="others">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal breed:</label>
            <input type="text" class="form-control" id="breed" name="breed" required >
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal age:</label>
            <input  type="text" class="form-control" name="age" id="age">
          </div>
          
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal color:</label>
            <input type="text" class="form-control" id="color" name="color">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal Image:</label>
            <input type="file" class="form-control" id="choosefile" name="choosefile" required >
          </div>        
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">description:</label>
            <input type="text" class="form-control" id="descr" name="descr"  required >
          </div>
          <label for="recipient-name" class="col-form-label">Gender:</label>
          <div class="row"><div class="col"><label for="">Male:</label>
          <input type="radio"  id="Male" name="Gender" value="Male"></div>
          <div class="col"><label for="">
          <label for="">Female:</label>
          <input type="radio"   id="Female" name="Gender" value="Female" >
        </div></div>
          
          
          
          <button type="submit" class="btn btn-primary form-control" id="sub" name="sub">ADD</button>
        </form>
      </div>
      
    </div>
  </div>
</div>

<div class="container" id="showdata">
        <div class="row">
<?php 
//display data in homepage
    $conn=new mysqli('localhost','root','','pets_adoption');
    $shelterid=$_SESSION['ID'];
    $sql03="SELECT * FROM shelter JOIN animal ON animal.Shelter_ID = shelter.Shelter_ID WHERE animal.Shelter_ID = $shelterid;";
    $res3=mysqli_query($conn,$sql03);
    if($res3->num_rows>0){
    			while( $record = mysqli_fetch_assoc($res3) ) {          
  ?> 
  <div class="col-md-3 mt-2"> 
  <form action="homepage.php" name="requestsform" method="post">
    <div class="card dis bg-body-secondary" style="width:20rem;">   
    <div class="image">
        <img src="./img/<?php echo $record['Animal_Img']; ?>" class="img card-img-top" alt="..." style="width: 20rem; height: 10rem;">
        </div>
        <div class="card-body">
          <p class="name"><strong><?php echo $record['Animal_Name'];?></strong></p>
          <p class="breed"><?php echo $record['Animal_Breed'];?></p>
          <p class="gender"><?php echo $record['Animal_Gender'];?></p>
          <p class="age"><?php echo $record['Animal_Age'];?></p>
          <input type="hidden" name="" id="color" value="<?php echo $record['Animal_Color'];?>">
          <input type="hidden" name="" id="type" value="<?php echo $record['Animal_Type'];?>">
          <input type="hidden" name="" id="desc" value="<?php echo $record['Animal_Description'];?>">
          <input type="hidden"  id="animali" name="animali" value="<?php echo $record['Animal_ID']; ?>">
          <input type="hidden"  id="imag" name="" value="<?php echo $record['Animal_Img']; ?>">
          <button type="button" id="<?php echo $record['Animal_ID']; ?>" name="edit" class="edit btn butt" onclick="return getinfo(<?php echo $record['Animal_ID'];?>)" > EDIT INFO </button>
           <button type="submit" onclick="return confirm('are you sure')" class="btn butt btn-danger" name="delete">Delete</button>
        </div>  
      </div>
      </form>
      </div>
      <?php } }else
      { ?> <center><h2 class=" py-5 mt-5 fixed-center text-50px">Not added any pets</h2></center> <?php }?>
      </div>
    </div>
<?php 
      //display data in homepage
          $conn2=new mysqli('localhost','root','','pets_adoption');
          $sql02 = " SELECT *FROM animal INNER JOIN shelter where animal.Animal_ID=animal.Animal_ID";
          $res2=mysqli_query($conn2,$sql02);
          $record = mysqli_fetch_assoc($res2);
          ?>          
<div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="editModalLabel">EDIT ANIMAL DETAILS</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="myform" action="homepage.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal Name:</label>
            <input type="text" class="form-control" id="update_name" name="name">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal type:</label>
            <label for="" class="col-form-label">Dog:</label>
            <input type="radio"  id="update_pets" name="update_pets" value="dog">
            <label for="" class="col-form-label">Cat:</label>
            <input type="radio"  id="update_pets" name="update_pets" value="cat">
            <label for="" class="col-form-label">others:</label>
            <input type="radio"  id="update_pets" name="update_pets" value="others">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal breed:</label>
            <input type="text" class="form-control" id="update_breed" name="breed">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal age:</label>
            <input type="text" class="form-control" id="update_age" name="age">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal color:</label>
            <input type="text" class="form-control" id="update_color" name="color">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Animal Image:</label>
            <input type="file" class="form-control" id="update_choosefile" name="update_choosefile">
          </div>        
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">description:</label>
            <input type="text" class="form-control" id="update_desc" name="descr">
          </div>
          <div class="mb-3">
          <label for="" class="col-form-label">Gender:</label>
          <label for="" class="">Male:</label>
          <input type="radio"  id="Gender1" name="Gender1"value="Male"  >
          <label for="" class="">Female:</label>
          <input type="radio"  id="Gender1" name="Gender1" value="Female" >
          </div>
          <input type="hidden" id="hide_user_id" name="hide_user_id">
          <button type="submit" class="btn btn-primary form-control" id="id" name="Editanimal" >Edit</button>
        </form>
    </div>
  </div>
</div></div>

      <?php 
     if($_SERVER['REQUEST_METHOD']=='POST'){ 
      if (isset($_POST['delete'])) {   
        $ani_id=$_POST['animali'];   
        $sql4 = "DELETE FROM accepted WHERE Animal_ID='$ani_id'";
        $sql3 = "DELETE FROM requests WHERE Animal_ID='$ani_id'";
        $sql2 = "DELETE FROM animal WHERE Animal_ID='$ani_id'";
        $result3 =mysqli_query($conn,$sql3);
        $result4 =mysqli_query($conn,$sql4);
        $result2 =mysqli_query($conn,$sql2);
       
        
          }}
?>

<?php 
 // insert in aniaml database 
   if($_SERVER['REQUEST_METHOD']=='POST'){
   if (isset($_POST['Editanimal'])) {
   $name=$_POST['name'];
   $type=$_POST['update_pets'];
   $breed=$_POST['breed'];
   $age=$_POST['age'];
   $color=$_POST['color'];
  
   $filename=$_FILES["update_choosefile"]["name"];
   $tempfile=$_FILES["update_choosefile"]["tmp_name"];
   $folder="img/".$filename;
  
   $descr=$_POST['descr']; 
   $animal_id=$_POST['hide_user_id'];
   $gender=$_POST['Gender1'];
   $id=$_SESSION['ID']; 
   $sql6="UPDATE `animal` SET `Animal_Name` = '$name', `Animal_Age` = '$age', `Animal_Breed` = '$breed',`Animal_Color` = '$color', `Animal_Type` = '$type', `Animal_Description` = '$descr',  `Animal_Img` = '$filename',`Animal_Gender`='$gender' where `animal`.`Animal_ID`=$animal_id";
   $result=mysqli_query($conn,$sql6);
   move_uploaded_file($tempfile,$folder);
   ?>
   <div class="alert alert-success alert-dismissible mt-5 fade fixed-top show" role="alert">
   <Span> details edited successfully  </Span> 
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
</div> <?php
   
 } }
 ?> 
 <script>
   
function getinfo(id){
     var id=id;
     var name=$("#"+id).parent(".card-body").children(".name").text();
     var type =$("#"+id).parent(".card-body").children("#type").val();
     var img =$('#'+id).parent('.card-body').children('#imag').val();
     var gender=$("#"+id).parent(".card-body").children(".gender").text();
     var breed=$("#"+id).parent(".card-body").children(".breed").text();
     var color=$("#"+id).parent(".card-body").children("#color").val();
     var age=$("#"+id).parent(".card-body").children(".age").text();
     var desc=$("#"+id).parent(".card-body").children("#desc").val();
     var img=$("#"+id).parent(".card-body").children("#img").val();
     $("#hide_user_id").val(id);
     
     $("#update_choosefile").attr('src','./img/'+img);
     //$('input:file[name=update_choosefile]').val(img);
     $("#update_name").val(name);
     $("#update_age").val(age);
     $("#update_desc").val(desc);
     $("#update_gender").val(gender);
     $("input[name=update_pets][value="+ type +"]").prop('checked',true);
     $("#update_breed").val(breed);
     $("#update_color").val(color);
     $("input[name=Gender1][value="+ gender +"]").prop('checked',true);
     $('#update_choosefile').attr('src',img);
     $("#editModal").modal("toggle");  
  }
    
  </script>
  
 <!-- <script>
  $(document).ready(function(){
   $('#getName').on("keyup", function(){
     var getName = $(this).val();
     $.ajax({
       method:'POST',
       url:'sheltersearch.php',
       data:{name:getName},
       success:function(response)
       {
            $("#showdata").html(response);
       } 
     });
   });
  });</script>  -->
  
</body>
</html>