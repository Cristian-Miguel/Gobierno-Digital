## Cristian Miguel Marin Barrera

## Instrucciones para despliegue

- Clonar el repositorio en la dirección que desee y ejecuta el comando en esa carpeta, si cuenta con XAMPP se recomendó ponerlo en la carpeta htdocs
    ```
        git clone https://github.com/Cristian-Miguel/Gobierno-Digital.git
    ```
- Redireccionar a la carpeta que se clonó del proyecto
- Ejecutar ``` composer install ``` para instalar los paquetes de vendor
- Ejecutar el comando ``` node install ``` para instalar los paquetes de node
- Copiamos el archivo .env.example para configurar la conexión de la base de datos de MySQL con el comando ``` cp .env.example .env ```
- Generamos una clave de la aplicación con el comando ``` php artisan key:generate ```
- Generamos la clave de JWT con el comando ``` php artisan jwt:secret ```
- Ejecutar el comando para migrar la base de datos ``` php artisan migrate ```
- Ejecutar el comando para agregar los datos de prueba para la base de datos ``` php artisan db:seed ```
- Como último paso prendemos el servidor de XAMPP para que la aplicación funcione

## Observaciones Generales

En el diagrama de base de datos en el archivo proporcionado tiene varios problemas que son los tipos de datos en las llaves foráneas, estas son nvarchar, pero como las llaves primarias de la tabla users y de roles tiene tipo de dato bigint se cambió a ese tipo de datos para que no generara conflicto con la base de datos MySQL. El siguiente dato que se cambió fue el description, ya que era de tipo dateTime, este se cambió por un string para poner una descripción escrita del rol.

Se agregó también el CRUD en los roles con los mismos principios de acceso de roles.

