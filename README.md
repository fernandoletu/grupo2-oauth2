# Grupo 2
## Diplomatura en desarrollo seguro de aplicaciones - UNSTA
Implementación de OAuth2 en API REST

Lenguaje PHP - Framework Lumen 8

Requerimientos
-   php 8
-   Composer
-   MySql

Antes de seguir:
Renombrar el archivo ".env.example" a ".env" y modificar datos de acceso
a la BD acorde a tu pc. Tiene que existir una BD "cursos".

---

## Ejecución

- composer install
- php artisan migrate
- php artisan db:seed
- php artisan passport:install
- php artisan passport:client --password
  (Aquí presionar Enter, luego ingresar 0 cuando lo solicite para la tabla 'users')
- php -S localhost:8000 -t public

El penúltimo generará un client_id y un client_secret que se usa mas adelante (copiarlos).
El último paso ejecuta el servidor para iniciarlo.

## Endpoints
Todos los endpoints creados están indicados debajo y también en el archivo:
grupo2-oauth2-2021-12-13-postman_collection.json

Para generar un token para gestionar los cursos, enviar una peticion al siguiente endpoint:

---

Method=POST
URL=http://localhost:8000/oauth/token

Params (form data)=
grant_type:password
client_id:X
client_secret:X
password:1234
username:prueba@prueba.prueba

---

Luego usar "access_token" de la respuesta del servidor
como Bearer Token para los siguientes endpoints:

GET

http://localhost:8000/course/getAll

GET

http://localhost:8000/course/getData (params: id)

POST

http://localhost:8000/course/create (params: nombre, descripcion)

PUT

http://localhost:8000/course/update (params: id, nombre, descripcion)

DELETE

http://localhost:8000/course/delete (params: id)
