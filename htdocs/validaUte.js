function validarUte(){
    var num=document.addUte.foneUte.value; 
    if (isNaN(num)){  
        document.getElementById("numloc").innerHTML="Favor fornecer um telefone composto apenas por numeros e de até 9 caracteres";  
        alert("Favor fornecer um telefone composto apenas por numeros e de até 9 caracteres");
        return;  
      }
}