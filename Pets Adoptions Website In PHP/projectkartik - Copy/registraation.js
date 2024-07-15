
function myscript() {
    var name=document.myform.name.value;  
    var password=document.myform.pass.value;
    var pass1=document.myform.repass.value;
    var mobile=document.myform.phone.value;  
   // var RegEx = [A-Za-z]{,3};
    var x=document.myform.email.value;  
    var atposition=x.indexOf("@");  
    var dotposition=x.lastIndexOf("."); 
    if (name==null || name==""){  
      var con=document.getElementById("error");
      con.innerHTML=("Name can't be blank");  
      return false;}
   else if(name==NaN){
    var con=document.getElementById("error");
      con.innerHTML=("Name can't be blank");  
      return false;
   }
    
    else if(mobile.length!=10){ 
      var con=document.getElementById("error");
      con.innerHTML=("invalid number");  
        return false;  
      }
      else if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
        var con=document.getElementById("error");
        con.innerHTML=("invalid email");
          return false;  
      }     
    else if(password.length<6){  
      var con=document.getElementById("error");
      con.innerHTML=("Password must be at least 6 characters long.");  
      return false;  
      }
    else if(password != pass1){  
      var con=document.getElementById("error");
      con.innerHTML=("Password must be same");  
      return false;  
    }
   

    else { return true; }
        
    }  
