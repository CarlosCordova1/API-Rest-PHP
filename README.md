# API-Rest-PHP
API rest con PHP y base de datos MariaDB

Ejemplo de invocacion

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


