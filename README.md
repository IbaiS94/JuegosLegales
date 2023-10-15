# Descripción

Esta entraga trata de crear un servicio web desplegado en docker usando PHP, HTML, CSS, JavaScript. Para la base de datos se utiliza MySQL con phpMyAdmin.

# Participantes

Luken Bilbao Rojo, Ibai Sologuestoa Aguirrebeitia, Unai Garcia

# Instrucciones para el despliegue

Para poder hacer funcionar el sistema web es necesario tener docker instalado, en el caso de no estarlo, se puede hacer con estos comandos:

```bash
$ sudo apt install docker
```
```bash
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

# Instrucciones para la base de datos

Una vez desplegado, hay que conectar la base de datos de SQL que tenemos:

1-Acceder a http://localhost:8890
2-Introducir el Usuario "juegosacceso" y la Contraseña "admin"
3-Entrar en "db", hacer click en importar y elegir el archivo juegos.sql que se encuentra en esta carpeta, si a la primera da error probar a importar una segunda.

Para acceder a la pagina web habra que buscar en un navegador la pagina http://localhost:8000

# Detener el servicio

Para detener el servicio "Ctrl + Z" y escribir:
```bash
$ docker-compose down
```
