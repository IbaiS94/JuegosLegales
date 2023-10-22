function comprobardatos(){
    var nom = document.registro.nombre.value;
    var ape = document.registro.apellido.value;
    var dni = document.registro.dni.value;
    var tel = document.registro.telefono.value;
    var fecha = document.registro.fechanac.value;
    var email = document.registro.email.value;
    
    //mas documentacion sobre regex: https://www.w3schools.com/jsref/jsref_obj_regexp.asp

    var mensaje = "Problemas con el registro: \n"
    var error = false;

    var x = /[abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ]+/; //solo permite estos caracteres (minimo 1)
    if(!x.test(nom)){
        mensaje = mensaje.concat("El nombre solo puede contener letras. \n")//Se van listando los problemas en el mensaje final
        error = true;
    }

    var x = /[abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ]+/; //solo permite estos caracteres (minimo 1)
    if(!x.test(ape)){
        mensaje = mensaje.concat("El apellido solo puede contener letras. \n")
        error = true;
    }

    var x = /\d{8}-[A-Z]{1}/;//secuencia de 8 digitos seguido de un guión y una letra mayúscula, las barras contienen la regex
    if(!x.test(dni)||(dni.length != 10)){ //el control de longitud hace que no se puedan introducir mas o menos caracteres de los esperados
        mensaje = mensaje.concat("El formato del DNI debe ser 12345678-A. \n")
        error = true;
    }else{
        num = dni.slice(0,8);
        resto = num%23;
        switch(resto){
            case 0:
                letra = "T"
                break;
            case 1:
                letra = "R"
                break;
            case 2:
                letra = "W"
                break;
            case 3:
                letra = "A"
                break;
            case 4:
                letra = "G"
                break;
            case 5:
                letra = "M"
                break;
            case 6:
                letra = "Y"
                break;
            case 7:
                letra = "F"
                break;
            case 8:
                letra = "P"
                break;
            case 9:
                letra = "D"
                break;
            case 10:
                letra = "X"
                break;
            case 11:
                letra = "B"
                break;
            case 12:
                letra = "N"
                break;
            case 13:
                letra = "J"
                break;
            case 14:
                letra = "Z"
                break;
            case 15:
                letra = "S"
                break;
            case 16:
                letra = "Q"
                break;
            case 17:
                letra = "V"
                break;
            case 18:
                letra = "H"
                break;
            case 19:
                letra = "L"
                break;
            case 20:
                letra = "C"
                break;
            case 21:
                letra = "K"
                break;
            case 22:
                letra = "E"
                break;
        }
        if(!(letra===(dni.slice(9,10)))){
            mensaje = mensaje.concat("El DNI debe ser válido. \n")
            error = true;
        }
    }

    var x = /\d{9}/; //encuentra una secuencia de 9 digitos 
    if(!x.test(tel)||(tel.length != 9)){
        mensaje = mensaje.concat("El formato del teléfono debe ser 123456789. \n")
        error = true;
    }
    var currentTime = new Date();
    var year = currentTime.getFullYear()
    var x = /\d{4}-\d{2}-\d{2}/; //encuentra una secuencia de 2 digitos, guion, secuencia de dos digitos, guieon y secuencia de 4 digitos
    if(((!x.test(fecha))||(fecha.length != 10))||(fecha.slice(0,4)>=year)){//empezara a dar fallos dentro de 8000 años (cuando la fecha de nacimiento 01-01-10000 tenga sentido)
        mensaje = mensaje.concat("El formato de la fecha de nacimiento debe ser 0001-01-01 y debe ser una fecha válida. \n")
        error = true;
    }

    var x = /[abcdefghijklmnñopqrstuvwxyz0123456789.]@/;//(gmail.com|hotmail.com|yahoo.com|mailo.com|outlook.com|proton.me|protonmail.com))/;
    if(!x.test(email)||email.match(/\s/)){
        mensaje = mensaje.concat("El email debe ser del formato ejemplo@email.com. \n"); //y pertenecer a un proveedor conocido. \n")
        error = true;
    }

    if(error){
        window.alert(mensaje)
    }else{
        document.registro.submit();
       // window.alert("mola")//debug
    }
}
