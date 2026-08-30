# API de E-commerce con Laravel 12, Stripe y Swagger

Proyecto backend de tienda en línea con Laravel 12 y MySQL, que incluye gestión de usuarios, catálogo, órdenes y pagos de prueba con Stripe, documentado con Swagger UI.

## Instalacion y ejecucion

Sigue estos pasos en la terminal:

1. Clona el repositorio y entra a la carpeta:
   git clone https://github.com/StephanieTorresP/ecommerce-api.git
   cd ecommerce-api

2. Instala dependencias:
   composer install

3. Configura el entorno:
   - Copia `.env.example` a `.env`.
   - Crea la base de datos MySQL `ecommerce_db` y configura tus credenciales y llaves de Stripe en `.env`.

4. Genera la clave y ejecuta migraciones con datos iniciales:
   php artisan key:generate
   php artisan migrate --seed

5. Genera la documentación y arranca el servidor:
   php artisan l5-swagger:generate
   php artisan serve

## Como probar

Accede a `http://127.0.0` para usar Swagger UI y probar los endpoints públicos o autenticados con Bearer token.

## Tecnologias
- Laravel 12, Sanctum, MySQL
- Stripe PHP SDK
- L5 Swagger
