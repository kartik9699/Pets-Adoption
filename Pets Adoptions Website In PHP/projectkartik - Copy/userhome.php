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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/maps/embed/v1/MAP_MODE?key=AIzaSyCZZa9WE4h-FVKXQTVgAdhyAsTa9VUb3AM&libraries=places"></script>
    <title>user Page</title>   
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
  <div class="container back"></div>
    <nav class="navbar  bg-dark body-tertiary fixed-top">
        <div class="container-fluid">
        
    <?php
   $conn =new mysqli('localhost','root','','pets_adoption');
   // Check connection
   $user_id=$_SESSION['userid'];
   
?>
<?php
$sql01="select * from accepted inner join requests on accepted.Requests_ID= requests.Requests_ID inner join animal on accepted.Animal_ID=animal.Animal_ID where accepted.User_ID=$user_id and accepted.Stat='Unseen' and requests.Shelter_ID=animal.Shelter_ID";
$result01=mysqli_query($conn,$sql01);

?>

<div class="list-group">
  
  

</div>
  </div>
</div>
               <div class="brand"> <a class="navbar-brand" href="#">
                  <h4 class="text-light ">PETS ADOPTION</h4>
</a></div><a class="list-group-item">
<div class="btn-group" role="group" aria-label="Basic example">
<form action="" method="post">
  <button type="submit" id="not" class="btn btn-outline-light lab" name="not"><i class="fa fa-check-circle " aria-hidden="true"></i>&nbsp;Adopt&nbsp;&nbsp;<span><?php 
  if($result01->num_rows>0){  
    $count_active = mysqli_num_rows($result01);
    echo $count_active;}else{}?></span> </button></form></a>
  <a class="list-group-item" href="Requested pets.php"><button type="button" class="btn btn-outline-light lab"><i class="fa fa-bell-o" aria-hidden="true"></i>&nbsp; Requested</button></a>
  <a class="list-group-item" href="userprofile.php">
<button type="button" id="ADD" name="user_edit" class="btn btn-outline-light lab" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp; Profile</button>
  </a></div>

<form class="d-flex" role="search">
      <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="name" id="getName">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
          </div>
          <div class="log"><a href="logout.php"><button type="button" class="btn btn-outline-primary"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Log Out</button></a></div>
      
        </div>
      </nav>
      <?php
      if($_SERVER['REQUEST_METHOD']=='POST'){ 
        if (isset($_POST['not'])) {
          header("Location: accepted.php"); 
          $sql7="UPDATE accepted SET Stat = 'Seen' WHERE accepted.User_ID=$user_id AND accepted.Stat = 'Unseen'";
          $res02=mysqli_query($conn,$sql7); 
          exit;
        }}
      ?>   
      <div class="pt-5 mt-5 mx-5">
      <a  href="dogs.php"><button class="btn btn-outline-warning rounded-pill"style="width:27rem" type="button">Dogs</button></a>
      <a  href="cats.php"><button class="btn btn-outline-warning rounded-pill" style="width:27rem" type="button">Cats</button></a>
      <a  href="others.php"><button class="btn btn-outline-warning rounded-pill" style="width:27rem" type="button">Others</button></a>  
  </div> 
  
   
      <div class="container py-3" id="showdata">
        <div class="row">
      <?php
      //display data in homepage
        
          $sql = "SELECT * FROM animal inner join shelter where animal.Shelter_ID=shelter.Shelter_ID and animal.Status='Not Accepted'";
          $res=mysqli_query($conn,$sql);
          if($res->num_rows>0){
          while( $record = mysqli_fetch_assoc($res) ) {
            
              
            
        ?>
        
        <div class="col-md-3 mt-1">
        <form name="requests form"  method="post">
      
    <div class="card" style="width: 20rem;">  
    <div class="image">
        <img src="./img/<?php echo $record['Animal_Img']; ?>" class="card-img-top" alt="..." style="width: 20rem; height: 10rem;">
        </div>
        <div class="card-body"style="height:15rem;" >
          <p class="name"><strong><?php echo $record['Animal_Name'];?></strong></p>
          <p class="gender">Gender:<?php echo $record['Animal_Gender'];?></p> 
          <p class="age">Age:<?php echo $record['Animal_Age'];?></p>
          <p  class="adress">Address:<?php echo $record['Shelter_Adress'];?> </p>
          <input type="hidden" name="" id="color" value="<?php echo $record['Animal_Color'];?>">
          <input type="hidden" name="" id="breed" value="<?php echo $record['Animal_Breed'];?>">
          <input type="hidden" name="" id="type" value="<?php echo $record['Animal_Type'];?>">
          <input type="hidden" name="" id="desc" value="<?php echo $record['Animal_Description'];?>">
          <input type="hidden" name="animal_id" value="<?php echo $record['Animal_ID'];?>">
          <input type="hidden" name="shelter_id" value="<?php echo $record['Shelter_ID'];?>"><input type="hidden" name="" id="contact" value="<?php echo $record['Shelter_Contact'];?>">
          <input type="hidden" id="shelter" value="<?php echo $record['Shelter_Name'];?>">
          <input type="hidden" id="img" value="<?php echo $record['Animal_Img'];?>">
          <button type="submit" class="btn butt btn-block" name="request">Adopt</button>
          <button type="button" id="<?php echo $record['Animal_ID'];?>" onclick="return viewdetails(<?php echo $record['Animal_ID'];?>)" class="btn butt btn-block"  name="view">view details</button>
          
        </div>
          </div>
          </form> 
          </div>    
      <?php } }
      else{ ?> <center><h2 class=" py-5 mt-5 fixed-center text-50px">No Animal For Adoption</h2></center><?php }?>
      </div>
      </div>  
      

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="width:25rem;">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    <img id="myImg" src="#" alt="Snow" style="width:25rem;height:15rem;">
      
      <p class="view_name">
      <div class="row">
        <div class="col-sm"><p class="view_gender"></p></div> <div class="col-sm"><p class="view_age"></p></div></div>
        
        <div class="row">
        <div class="col-sm"> <p class="view_color"></p></div><div class="col-sm"><p class="view_breed"></p></div>
          </div><div class="row"><div class="col-sm"> <p class="view_desc"></p></div><div class="col-sm "><p class="view_shelter"></p></div></div>
          <div class="row"><div class="col-sm"> <p class="view_address"></p></div><div class="col-sm "><p class="view_contact"> </div></div>   
    </div>
  </div>
</div>
<script>
  var Adress='adress';
  $(document).ready(function(){
    var autocomplete;
    autocomplete= new google.maps.places.Autocomplete((document.getElementById(adress)),{
      types:['geocode'],});
    });
</script>
<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){ 
  if (isset($_POST['request'])) {
    $animal_id=$_POST['animal_id'];
    $shelter_id=$_POST['shelter_id'];
    $user_id2=$_SESSION['userid'];
    $req="select * from requests where Animal_ID = '$animal_id' and User_ID='$user_id2'";
    $req1=mysqli_query($conn,$req);
    if($req1->num_rows>0){
      ?><div class="alert alert-warning alert-dismissible mt-5 fade fixed-top show" role="alert">
      <span>Your Already Request for this anmial</span>
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   
 </div>  <?php 
   }
    else{
      $sql3="INSERT INTO requests ( Shelter_ID, Animal_ID, User_ID,Stat) VALUES ('$shelter_id', '$animal_id', '$user_id2','Unseen')";
    $res3=mysqli_query($conn,$sql3);
    ?>
    <div class="alert alert-success alert-dismissible mt-5 fade fixed-top show" role="alert">
    <Span> Requsted successfully  </Span> 
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
</div> <?php
    
    }
      }}
?>
<script>
function viewdetails(id){
     var id=id;
     var name=$("#"+id).parent(".card-body").children(".name").text();
     var type =$("#"+id).parent(".card-body").children("#type").val();
     var img =$('#'+id).parent('.card-body').children('#imag').val();
     var gender=$("#"+id).parent(".card-body").children(".gender").text();
     var breed=$("#"+id).parent(".card-body").children("#breed").val();
     var color=$("#"+id).parent(".card-body").children("#color").val();
     var age=$("#"+id).parent(".card-body").children(".age").text();
     var desc=$("#"+id).parent(".card-body").children("#desc").val();
     var adress=$("#"+id).parent(".card-body").children(".adress").text();
     var contact=$("#"+id).parent(".card-body").children("#contact").val();
     var shelter=$("#"+id).parent(".card-body").children("#shelter").val();
     var img=$("#"+id).parent(".card-body").children("#img").val();
     $(".view_name").text("name:"+name);
     $(".view_age").text(age);
     $(".view_desc").text("desc:"+desc);
     $(".view_gender").text(gender);
     $(".view_address").text(adress);
     $(".view_breed").text("breed:"+breed);
     $(".view_contact").text("contact:"+contact);
     $(".view_color").text("color:"+color);
     $(".view_shelter").text("shelter_name:"+shelter);
     $('#myImg').attr('src','./img/'+img);
     $(".bd-example-modal-lg").modal("toggle");  
  }
  </script>
<script>
  $(document).ready(function(){
   $('#getName').on("keyup", function(){
     var getName = $(this).val();
     $.ajax({
       method:'POST',
       url:'search.php',
       data:{name:getName},
       success:function(response)
       {
            $("#showdata").html(response);
       } 
     });
   });
  });
</script>

</body>
</html>