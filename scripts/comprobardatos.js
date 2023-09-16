function comprobardatos(){
    var nom = document.registro.nombre.value;
    var ape = document.registro.apellido.value;
    var dni = document.registro.dni.value;
    var tel = document.registro.telefono.value;
    var email = document.registro.email.value;

    var mensaje = "Problemas con el registro: "
    var error = false;

    var x = /\d/;
    if(!x.test(nom)){
        mensaje = mensaje.concat(mensaje, "<br>El nombre no puede contener números.")
        error = true;
    }
    var x = /\d/;
    if(!x.test(ape)){
        mensaje = mensaje.concat(mensaje, "<br>El apellido no puede contener números.")
        error = true
    }
    var x = /\d{8}-[A-Z]{1}/;//secuencia de 8 digitos seguido de un guión y una letra mayúscula, las barras contienen la regex
    if(!x.test(dni)){
        mensaje = mensaje.concat("<br>El formato del DNI debe ser 12345678-A")
        error = true;
    }
    var x = /\d{9}/;
    if(!x.test(tel)){
        mensaje = mensaje.concat("<br>El formato del teléfono debe ser 123456789")
        error = true;
    }
    var x = /[^_()"']@(gmail.com|hotmail.com|yahoo.com|mailo.com|outlook.com)/;
    if(!x.test(email)){
        mensaje = mensaje.concat("<br>El email debe ser del formato ejemplo@email.com y debe ser de un proveedor conocido.")
        error = true;
    }

    if(error){
        window.alert(mensaje)
    }else{
        document.registro.submit();
    }
}