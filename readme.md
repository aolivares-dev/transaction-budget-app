# 1. Instalar dependencias
```bash 
  composer install
```
# 2. Crear el archivo de configuracion
```bash
    cp .env.example .env
```
# 3. Generar la clave de la aplicacion
```bash
    php artisan key:generate
```
# 4. Crear la base de datos
```bash
    php artisan migrate
```
# 5. Cargar datos de prueba
```bash
    php artisan db:seed
```
# 6. Iniciar el servidor
```bash
    php artisan serve
```

