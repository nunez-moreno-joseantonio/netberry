# Proyecto Netberry

Es una aplicación que gestiona tareas, añadiendo y eliminando. Aplicacion basada en Laravel 8.6

### Prerequisitos

- PHP vresion 7.3 o superior
- Composer
- Apache
- MySQL
- Laravel installer

### Instación

Se recomienda el programa **_Xampp_** que es un paquete que instala una versión actualizada de PHP y servidor Apache y un servidor MySQL.

Una vez clonado el proyecto en local dentro de la carpeta **htdocs** de nuestra instalación de **xampp**, entramos dentro de la carpeta de nuestro proyecto y abrimos una consola y ejecutamos


```
composer install
```

Una vez finalizado se muestra hace una copia del archivo **.env.example** y lo renombramos con el nombre **.env**. Editamos este y configuramos la base de datos con los siguientes parametros

```MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Se inicia posteriormente el servicio de **_Apache_** y **_MySQL_** de nuestro **xampp**.

Una vez realizada la configuración a la base de datos realizamos migraciones y datos de muestra. Para ello ejecutamos en la consola los siguientes comandos
```
php artisan migrate
```
```
php artisan db:seed
```

Abrimos nuestro navegador y nos vamos a la carpeta de nuestro proyecto, y dentro de esta a nuestra carpeta **public** y mostrará la página de inicio

## Utilizado como documentación

* [Laravel](https://laravel.com/docs/8.x) - Web de documentacion del framework utilizado

## Authors

* **_José Antonio Núñez Moreno_**

## License

Este proyecto esta bajo la licencia de libre distribución.



