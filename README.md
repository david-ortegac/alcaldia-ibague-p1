# Nombre del Proyecto

Prueba perfil 1. Convocatoria “Talentos en programación"

## Tabla de Contenidos

- [Nombre del Proyecto](#nombre-del-proyecto)
  - [Tabla de Contenidos](#tabla-de-contenidos)
  - [Requisitos del Sistema](#requisitos-del-sistema)
  - [Instalación](#instalación)
  - [Modelos y Tipos de Datos](#modelos-y-tipos-de-datos)
    - [Modelo User](#modelo-user)
    - [Departmets](#departmets)
    - [Employees](#employees)
  - [Rutas y Controladores](#rutas-y-controladores)
  - [Tests](#tests)

## Requisitos del Sistema

- **PHP**: Versión de PHP 8.2.
- **Laravel**: Versión de Laravel 11.
- **Base de datos**: Oracle xe 11g.

## Instalación

1. Clonar el repositorio:
    ```sh
    git clone https://github.com/david-ortegac/alcaldia-ibague-p1.git
    ```
2. Instalar dependencias:
    ```sh
    composer install
    ```
3. Configurar el archivo `.env`:
    ```sh
    cp .env.example .env
    ```
4. Generar la clave de la aplicación:
    ```sh
    php artisan key:generate
    ```
5. Conexiones de base de datos:
    ```
    Agregar parametros de conexión a la base de datos.
    ```
6. Ejecutar migraciones de base de datos:
    ```sh
    php artisan migrate
    ```

## Modelos y Tipos de Datos

### Modelo User

- **name**: String
- **email**: String
- **password**: String (Hash)

### Departmets

- **name**: String
- **chief_manager**: FK users
- **created_by**: FK users
- **modified_by**: FK users

### Employees

- **user_id**: FK users
- **department_id**: FK departments
- **role**: String
- **status**: boolean
- **created_by**: FK users
- **modified_by**: FK users

## Rutas y Controladores

- **Ruta /profile**: Encargada de administrar el usuario autenticado, protegida por autenticación
  - **Controlador y Método**: get/($id), put/path

- **Ruta /departments**: Encargada de administrar las dependencias, protegida por autenticación
  - **Controlador y Método**: get, get/($id), put/path, post, delete

- **Ruta /employees**: Encargada de administrar los empleados, protegida por autenticación
  - **Controlador y Método**: get, get/($id), put/path, post, delete

## Tests

Para ejecutar las pruebas:
```sh
php artisan test
