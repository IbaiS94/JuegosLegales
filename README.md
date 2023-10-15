# Descripción

Esta entraga trata de crear un servicio web desplegado en docker usando PHP, HTML, CSS, JavaScript. Para la base de datos se utiliza MySQL con phpMyAdmin.

# Participantes

Luke Bilbao Rojo
Ibai Sologuestoa Aguirrebeitia
Unai Garcia

# Como desplegarlo

Para poder hacer funcionar el sistema web es necesario tener docker instalado, en el caso de no estarlo, se puede hacer con estos comandos:

```bash
$ sudo apt install docker
$ sudo apt install docker-compose
```

Una vez esté instalado hay que crear la imagen del contenedor:
```bash
$ docker buid -t="web" .
```

Para desplegar el sistema escrito en docker-compose.yml se utiliza este comando:
```bash
$ docker-compose up
```

Una vez desplegado, hay que conectar la base de datos de SQL que tenemos:

1-Acceder a http://localhost:8890
2-Introducir el Usuario "juegosacceso" y la Contraseña "admin"
3-Entrar en "db", hacer click en importar y elegir el archivo juegos.sql que se encuentra en esta carpeta.

Para acceder a la pagina web habra que buscar en un navegador la pagina http://localhost:8000

Para detener el servicio:
```bash
$ docker-compose down
```
