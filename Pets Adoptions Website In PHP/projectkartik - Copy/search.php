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
  $conn =new mysqli('localhost','root','','pets_adoption');
  
   $name = $_POST['name'];
  
   $sql = "SELECT * FROM animal inner join shelter WHERE (Animal_Name LIKE '$name%'or Animal_Type LIKE '$name%' or Animal_Breed LIKE '$name%' or Animal_Gender LIKE '$name%') and animal.Shelter_ID=shelter.Shelter_ID and animal.Status='Not Accepted'";  
   $query = mysqli_query($conn,$sql);
   $data='';
   ?>
     <div class="container py-3">
       <div class="row">  
     <?php
     //display data in homepage
     
     while( $record = mysqli_fetch_assoc($query) )      
      $data.='<div class="col-md-3 mt-1">
      <form name="requests form"  method="post">
    
  <div class="card" id="showdata" style="width: 20rem;">  
  <div class="image">
      <img src="./img/'.$record['Animal_Img'].'" class="card-img-top" alt="..." style="width: 20rem; height: 10rem;">
      </div>
      <div class="card-body" style="height: 15rem;">
        <p class="name"><strong>'.$record['Animal_Name'].'</strong></p> 
        <p class="gender">Gender:'.$record['Animal_Gender'].'</p>
        <p class="age">Age:'.$record['Animal_Age'].' </p>
        <p class="adress">Address:'.$record['Shelter_Adress'].' </p>
        <input type="hidden" name="animal_id" value="'.$record['Animal_ID'].'">
        <input type="hidden" name="shelter_id" value="'.$record['Shelter_ID'].'">
        <input type="hidden" name="" id="color" value="'.$record['Animal_Color'].'">
        <input type="hidden" name="" id="breed" value="'.$record['Animal_Breed'].'">
        <input type="hidden" name="" id="type" value="'.$record['Animal_Type'].'">
        <input type="hidden" name="" id="desc" value="'.$record['Animal_Description'].'">
        <input type="hidden" name="" id="contact" value="'.$record['Shelter_Contact'].'">
        <input type="hidden" id="shelter" value="'.$record['Shelter_Name'].'">
        <button type="submit" class="butt btn-block" name="request">Adopt</button>
        <button type="button" id="'.$record['Animal_ID'].'" onclick="return viewdetails('.$record['Animal_ID'].')" class="butt btn-block"  name="view">view details</button>
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
     <div class="modal fade bd-example-modal-lg modal-dialog-centered" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="width:25rem;">
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
   
 </div>  <?php exit;
   }
    else{
      $sql3="INSERT INTO requests ( Shelter_ID, Animal_ID, User_ID,Stat) VALUES ('$shelter_id', '$animal_id', '$user_id2','Unseen')";
    $res3=mysqli_query($conn,$sql3);
    header("Location: userhome.php");
    exit;
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
     $('#myImg').attr('src','./img/'+img);
     $(".bd-example-modal-lg").modal("toggle");  
  }
  </script>      

 
</body>
</html>
