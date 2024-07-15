  function login() {
    var x=document.myform.email.value;  
    var atposition=x.indexOf("@");  
    var dotposition=x.lastIndexOf(".");
    var password = document.myform.password.value;
    if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
      document.getElementById("mail").innerHTML=("invalid email");
        return false;  
    }
    else if (password.length < 6) {
      document.getElementById("pas").innerHTML=("Password must be at least 6 characters long."); 
        return false;    
  }
    else{
        return true;
    }
}