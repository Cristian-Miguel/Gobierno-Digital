## Cristian Miguel Marin Barrera

## Instrucciones para despliegue

- Clonar el repositorio en la direccion que desee y ejecuta el comando en la direccion de esa carpeta.
    ```
        git clone https://github.com/Cristian-Miguel/Gobierno-Digital.git
    ```
- Redireccionar a la carpeta que se clono del proyecto
- Ejecutar ``` composer install ``` para instalar los paquetes de vendor
- Ejecutar el comando ``` node install ``` para instalar los paquetes de node
- Copiamos el archivo .env.example para configurar la conexion de la base de datos de mysql con el comando
    ``` 
        cp .env.example .env 
    ```
- Generamos una clave de la aplicacion con el comando ``` php artisan key:generate ```
- Generamos la clave de JWT con el comando ``` php artisan jwt:secret ```
- Ejecutar el comando para migrar la base de datos
    ``` 
        php artisan migrate
    ```
- Ejecutar el comando para agregar los datos de prueba para la base de datos
    ```
        php artisan db:seed
    ```
- Como ultimo paso prendemos el servidor de XAMPP para que la aplicacion funcione

## Observaciones Generales

En el diagrama de base de datos en el archivo proporcionado tiene varios problemas que son los tipos de datos en las llaves foraneas
estas son nvarchar, pero como las llaves primarias del users y de roles tiene tipo de dato bigint se cambio a ese tipo de datos para 
que no generara conflicto con la base de datos mysql. El siguiente dato que se cambio fue el description ya que era de tipo dateTime,
este se cambio por un string para poner una descripcion escrita del rol.

Se agrego tambien el CRUD en los roles con los mismos principios de acceso de roles.

