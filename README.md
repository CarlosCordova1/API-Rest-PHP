# API-Rest-PHP
API rest con PHP y base de datos MariaDB

#Ejemplo de invocacion

* metodo GET
URL: http://carloscordova.com/developer/api-rest/?user
lista todo los usuarios agregados

http://carloscordova.com/developer/api-rest/?user&unique=1
lista un unico registro por id, donde unique es el id del registro

* Metodo POST 
URL: http://carloscordova.com/developer/api-rest/?user
recibe parametro POST llamado json , donde json tiene una cadena JSON como la siguiente

-  {"id":"1","nombre":"juan","apellido":"Cordova","ciudad":"cancun","pais":"mexico","genero":"H","action":"insert"}

-  todo los datos son requeridos para ser insertados, "antion" indica si se insertara un registro o si se actualizara "update"

Para insertar
-  action debe ser declarada con insert.
-  genero puede ser H de hombre ó M de mujer.
-  nombre debe ser un valor unico, lo la insercion sera denegada.

para hacer update
-  action debe ser declarada con update.
-  genero puede ser H de hombre ó M de mujer.
-  nombre debe ser un valor unico, lo la insercion sera denegada.
-  id es el identificador que se quiere actualizar.
- nombre,apellido,ciudad,pais,genero son los valores que se pueden actualizar

* Metodo DELETE
URL: http://carloscordova.com/developer/api-rest/?user&unique=1
elimina el indice donde unique es el id del registro a eliminar

#Ejemplo de respuestas
 * GET
 
 {
  "conect": true,
  "msg": "Connection ok",
  "data": [
    {
      "id": "1",
      "nombre": "Carlos",
      "apellido": "Cordova",
      "ciudad": "cancun",
      "pais": "mexico",
      "genero": "H",
      "useragente": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36",
      "remoteip": "187.150.19.187",
      "datein": "2020-05-16 13:03:52",
      "dateupdate": null,
      "datedelete": null
    }
  ]
}
* POST

- insert

{"conect":true,"msg":"New record  successfully","latest_id":3}

- Update

{"conect":true,"msg":" record update successfully"}

* DELETE

{"conect":true,"msg":" record delete successfully"}

* Codigos de respuestas

* 200 OK
* 201 Created
* 400 Bad Request
* 500 Internal Server Error

