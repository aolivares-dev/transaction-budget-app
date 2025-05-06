# Preparando el proyecto

## Instalación de dependencias

Para instalar las dependencias del proyecto, ejecuta el siguiente comando en la raíz del proyecto:

```bash
    composer install --vvv
```

## Configuración del entorno

Copia el archivo `.env.example` y renómbralo a `.env`. Luego, edita el archivo `.env` para configurar las variables de entorno necesarias para tu aplicación. Asegúrate de configurar la conexión a la base de datos y otras variables según tus necesidades.

```bash
    cp .env.example .env
```

## Generación de la clave de aplicación

Para generar la clave de aplicación, ejecuta el siguiente comando:

```bash
    php artisan key:generate
```

## Migraciones y seeders

Para crear las tablas en la base de datos y poblarlas con datos iniciales, ejecuta los siguientes comandos:

```bash
    php artisan migrate --seed
```

## Servidor de desarrollo

Para iniciar el servidor de desarrollo, ejecuta el siguiente comando:

```bash
    php artisan serve
```

Esto iniciará el servidor en `http://localhost:8000` por defecto. Puedes acceder a tu aplicación en tu navegador web.

## Generación de documentación

Para generar la documentación de la API, puedes utilizar el siguiente comando:

```bash
    php artisan l5-swagger:generate
```

Esto generará la documentación de la API en el directorio `public/docs`. Puedes acceder a la documentación en `http://localhost:8000/docs`.


```bash
    php artisan make:migration add_column_name_to_table_name --table=table_name
```

