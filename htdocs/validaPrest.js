function validarPrest() {
    var email = document.addPrest.mailPrest.value;
    var num=document.addPrest.fonePrest.value; 
    atpos = email.indexOf("@");
    dotpos = email.lastIndexOf(".");
    
    if (atpos < 1 && dotpos<1) {
       alert("Favor forneça um endereço de email ao prestador");
       email.focus() ;
       return;
    }
   if (isNaN(num)){  
     document.getElementById("numloc").innerHTML="Favor fornecer um telefone composto apenas por numeros e de até 9 caracteres";  
     alert("Favor fornecer um telefone composto apenas por numeros e de até 9 caracteres");
     return;  
   }
 }

 