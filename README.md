# 🛒 Sistema CRUD con Laravel y AdminLTE

Proyecto final que implementa operaciones CRUD para gestión de categorías, productos, clientes y compras, utilizando Laravel como backend y AdminLTE para la interfaz.

## 📋 Requisitos Previos
- **PHP 8.1+**
- **Composer** (Gestor de paquetes PHP)
- **Node.js 18+** y **npm** (Para compilar assets)
- **Base de datos** (MySQL, PostgreSQL o SQLite)
- **Git** (Control de versiones)

## 🚀 Instalación y Configuración

### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/proyecto-crud-compras.git
cd proyecto-crud-compras

/ Instalar dependencias PHP

composer install

Configurar entorno
cp .env.example .env

Editar .env con tus credenciales de base de datos:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=usuario
DB_PASSWORD=contraseña


Generar clave de aplicación
php artisan key:generate

Ejecutar migraciones y seeders
php artisan migrate --seed

Instalar dependencias JavaScript y compilar assets
npm install
npm run build

Configurar enlace de almacenamiento
php artisan storage:link

Ejecutar la Aplicación
Iniciar el servidor de desarrollo:

php artisan serve

Acceder al sistema en tu navegador:
http://localhost:8000
