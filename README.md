# Descripción del proyecto

Este proyecto trata sobre la realización de una página web de una casa de apuestas de fútbol. 
Contará con los roles de clientes y administradores dentro de la base de datos. 

Los clientes son los que realizarán dichas apuestas en donde podrán apostar un total de 300€ en cada opción. 
Existen tres tipos de apuestas (quiniela, máximo goleador y resultado de partido) y 
se almacenan en una tabla de apuestas que el usuario podrá ver siempre y cuando no las elimine. 

En la base de datos existirá por defecto un administrador que podrá iniciar sesión y hacer acciones como eliminar clientes existentes, 
registrar nuevos administradores y ver la cantidad de administradores y clientes que existen hasta el momento.

## Carpetas del proyecto

El proyecto está dividido en siete carpetas:

 - admin: Contiene los archivos que son accesibles por el administrador.

 - cliente: Contiene los archivos que son accesibles por los clientes.
 
 - css: Diseño de la página web.

 - data: Contiene la base de datos que se va a implementar.

 - form: Contiene los archivos accesibles tanto por administradores como clientes. Estos 		  son el login, el registro y el cierre de sesión del usuario.

 - img: Contiene las imágenes usadas en la página web.

 - partes: En él se encuentran los archivos de configuración y de funciones de código necesarias para acceder a la base de datos y realizar cambios.

## Diseño

El diseño fue totalmente hecho a puro css sin la utilización de bootstrap y planteado como una página web en donde el usuario se registra, inicia sesión y realiza las acciones que puede hacer como usuario. 

El administrador hace lo mismo excepto que tiene otras funciones distintas a las del usuario. Por eso dispone de un menú completamente distinto al del cliente. 

El login dispone de un diseño simple con la utilización del color azul y blanco para los inputs y botones interactivos y el diseño general de la página.

## Problemas encontrados

Durante la realización del proyecto han habido incontables cantidades de errores que fueron resueltos. Obviamente, esto no descarta la razón de que no quede ninguno del que no me haya percatado. Aunque hay uno que surge de vez en cuando, y es a la hora de eliminar clientes de la tabla de usuarios. Hay veces que no elimina un usuario y hay veces que sí. He comprobado que recoge el primary key (dni) al eliminar el cliente y aún así se traba.

Más adelante, el problema más frecuente era a la hora de sobrescribir los datos del cliente en el apartado de edición del perfil. No supe deducir cuál fue el error en el código que no permitiera hacer esta acción, hasta que me fijé que había que cerrar la consulta con “ ’ ”.

El generador de equipos al azar no es completamente funcional. Simplemente está por decoración y por añadirle algo de diversidad al trabajo. Cada de vez que se recargue la página, este se volverá a generar al azar.

## Trabajo futuro y conclusiones


Este trabajo me ha hecho aprender bastante sobre la relación entre php y mysqli. En mi opinión es más cómodo y fácil usar mysqli que pdo. Para el trabajo futuro dividiré mejor el tiempo a la hora de hacer la parte de front-end y la del back-end. En este caso, diría que he dedicado un 80% a la parte del back-end y apenas me dio tiempo de dejar la página con un diseño considerable.