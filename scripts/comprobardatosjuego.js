function comprobardatosjuego(){
    //var nom = document.formulario.nombre.value;
    //var desa = document.formulario.desa.value;
    var puntu = document.formulario.puntu.value;
    //var gen = document.formulario.gen.value;
    var anno = document.formulario.anno.value;
    //var link = document.formulario.link.value;

    var mensaje = "Problemas con los datos: \n"
    var error = false;

    var y = /\D/g;
    
    if(y.test(puntu)||(puntu>10)||(puntu<0)){
        error=true
        mensaje = mensaje.concat("Introduzca una puntuación válida. \n")
    }

    var currentTime = new Date();
    var year = currentTime.getFullYear()
    if(y.test(anno)||(anno>year)||(anno<1971)){
        error=true
        mensaje = mensaje.concat("Introduzca una año válido. \n")
    }


    if(error){
        //window.alert(anno.match(y))
        window.alert(mensaje)
    }else{
        document.registro.submit();
        //window.alert("mola")//debug
    }
}
