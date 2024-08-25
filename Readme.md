¡Bienvenidos al proyecto salud_turno!

➜ Para iniciar el proyecto, deberán clonar el repositorio y utilizar el mismo contenedor Docker.

➜ Para clonar el repositorio, deben acceder a GitHub y agregar su clave SSH.

➜Pasos para configurar la conexión SSH:

Abrir una terminal y ejecutar los siguientes comandos:
 ➜ cd .ssh
 ➜ ls -a
 ➜ ssh cat id_rsa.pub

Copiar todo el código y pegarlo en las configuraciones de GitHub:
➜ setting 
➜ SSH
➜ New SSH

Para levantar el proyecto, deberán crear un directorio llamado Desarrollo, y dentro clonar git@github.com/App5.git.

Crear en la raíz del directorio el archivo .env enviado por email.

Ejecuten el comando: 
➜ docker-compose up -d --build 
