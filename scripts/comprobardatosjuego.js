function comprobardatosjuego(){
    var nom = document.formulario.nombre.value;
    var desa = document.formulario.desa.value;
    var puntu = document.formulario.puntu.value;
    var gen = document.formulario.gen.value;
    var anno = document.formulario.anno.value;
    var link = document.formulario.link.value;

    var mensaje = "Problemas con los datos: \n"
    var error = false;

    var y = /\D/g;
    if(nom.length==0){
    	error=true;
    	mensaje = mensaje.concat("Introduzca un nombre. \n")
    }else if(nom.length>50){
        error=true;
        mensaje = mensaje.concat("Introduzca un nombre más corto. \n")
    }
    
    if(desa.length==0){
    	error=true;
    	mensaje = mensaje.concat("Introduzca un desarrollador. \n")
    }else if(desa.length>50){
        error=true;
        mensaje = mensaje.concat("Introduzca un desarrollador más corto. \n")
    }
    
    if(y.test(puntu)||(puntu>10)||(puntu<0)||(puntu.length==0)){
        error=true
        mensaje = mensaje.concat("Introduzca una puntuación válida. \n")
    }

    var currentTime = new Date();
    var year = currentTime.getFullYear()
    if(y.test(anno)||(anno>year)||(anno<1971)||(anno.length==0)){
        error=true
        mensaje = mensaje.concat("Introduzca una año válido. \n")
    }
    
    if(link.length==0){
    	error=true;
    	mensaje = mensaje.concat("Introduzca un link. \n")
        }else if(link.length>100){
    	error=true;
    	mensaje = mensaje.concat("Link demasiado largo, usa un link shortener. \n")
    }


    if(error){
        window.alert(mensaje)
    }else{
        document.formulario.submit();
    }
}
