<!DOCTYPE html>
<html lang="en">
<head>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
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
                  <a class="" href="userhome.php">
                  <button class="btn btn-primary"><i class="fa fa-home fa-fw fa-2x" aria-hidden="true"></i></button></a>
</nav>
<div class="container" id="showdata">
        <div class="row">
      <?php
      //display data in homepage
      $conn =new mysqli('localhost','root','','pets_adoption');
          $sql = "SELECT *FROM animal inner join shelter where animal.Shelter_ID=shelter.Shelter_ID and Animal_Type='others' and animal.Status='Not Accepted'";
          $res=mysqli_query($conn,$sql);
          if($res->num_rows>0){
          while( $record = mysqli_fetch_assoc($res) ) {
            
              
            
        ?>
        
        <div class="col-lg-4 mt-2">
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
          <button type="submit" class="butt btn" name="request">Adopt</button>
          <button type="button" id="<?php echo $record['Animal_ID'];?>" onclick="return viewdetails(<?php echo $record['Animal_ID'];?>)" class="butt btn"  name="view">view details</button>
          
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
      <div class="row">
      <p class="view_name">
        <div class="col-sm"><p class="view_gender"></p></div> <div class="col-sm"><p class="view_age"></p></div></div>
        <p class="view_desc"></p>
        <div class="row">
        <div class="col-sm"> <p class="view_color"></p></div><div class="col-sm"><p class="view_breed"></p></div>
          </div><div class="row"><div class="col-sm"> <p class="view_address"></p></div><div class="col-sm "><p class="view_shelter"></p></div></div>
        <p class="view_contact">    
      
   
    </div>
  </div>
</div>
 
      <?php 
if($_SERVER['REQUEST_METHOD']=='POST'){ 

  if (isset($_POST['request']))
  $animal_id=$_POST['animal_id'];
$shelter_id=$_POST['shelter_id'];
$user_id=$_SESSION['userid'];
  $req="select * from requests where Animal_ID = '$animal_id' and User_ID='$user_id' ";
    $req1=mysqli_query($conn,$req);
   {if($req1->num_rows>0){
    ?><div class="alert alert-warning alert-dismissible mt-5 fade fixed-top show" role="alert">
    <span>Your Already Request for this anmial</span>
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>  <?php exit;
 }
  else{
    
    $sql3="INSERT INTO requests ( Shelter_ID, Animal_ID, User_ID) VALUES ('$shelter_id', '$animal_id', '$user_id')";
    $res3=mysqli_query($conn,$sql3);
    ?>
    <div class="alert alert-success alert-dismissible mt-5 fade fixed-top show" role="alert">
    <Span> Requsted successfully  </Span> 
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
</div> <?php
        }}}
?>
<script>
function viewdetails(id){
     var id=id;
     var name=$("#"+id).parent(".card-body").children(".name").text();
     var type =$("#"+id).parent(".card-body").children("#type").val();
     var img =$('#'+id).parent('.card-body').children('#img').val();
     var gender=$("#"+id).parent(".card-body").children(".gender").text();
     var breed=$("#"+id).parent(".card-body").children("#breed").val();
     var color=$("#"+id).parent(".card-body").children("#color").val();
     var age=$("#"+id).parent(".card-body").children(".age").text();
     var desc=$("#"+id).parent(".card-body").children("#desc").val();
     var adress=$("#"+id).parent(".card-body").children(".adress").text();
     var contact=$("#"+id).parent(".card-body").children("#contact").val();
     var shelter=$("#"+id).parent(".card-body").children("#shelter").val();
     $('#myImg').attr('src','./img/'+img);
     //$("#update_choosefile").val('file',img);
     //$('input:file[name=update_choosefile]').val(img);
     $(".view_name").text("name:"+name);
     $(".view_age").text(age);
     $(".view_desc").text("desc:"+desc);
     $(".view_gender").text(gender);
     $(".view_address").text(adress);
     $(".view_breed").text("breed:"+breed);
     $(".view_contact").text("contact:"+contact);
     $(".view_color").text("color:"+color);
     $(".view_shelter").text("shelter_name:"+shelter);
     $(".bd-example-modal-lg").modal("toggle");  
  }
  </script>
          </body>
          </html>
         