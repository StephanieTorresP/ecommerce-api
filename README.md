# API de E-commerce con Laravel 12 + Stripe + Swagger

¡Hola! Este es el repositorio de mi tarea para el módulo de Backend. Desarrollé una API básica para una tienda en línea usando **Laravel 12** y **MySQL**. 

El proyecto maneja lo esencial de un e-commerce: registro de usuarios, catálogo de productos, carrito de compras y procesamiento de pagos reales (en modo prueba) utilizando el SDK oficial de **Stripe**. Además, configuré **Swagger** para que todos los endpoints se puedan probar de forma visual desde el navegador.

---

## ¿Cómo hacerlo funcionar en tu PC?

Si quieres clonar mi proyecto y probarlo localmente, sigue estos pasos:

1. **Clona este repositorio:**
   ```bash
   git clone <PEGA_AQUÍ_EL_ENLACE_DE_TU_GITHUB>
   cd ecommerce-api
   ```

2. **Instala los paquetes de PHP con Composer:**
   ```bash
   composer install
   ```

3. **Prepara el archivo de configuración:**
   - Copia el archivo `.env.example` y cámbiale el nombre a `.env`.
   - Entra a tu gestor de MySQL (XAMPP, Laragon, etc.) y crea una base de datos vacía llamada `ecommerce_db`.
   - Abre el archivo `.env` y asegúrate de poner el usuario y contraseña de tu MySQL local. También puse mis llaves de prueba de Stripe ahí.

4. **Genera la clave de seguridad de Laravel:**
   ```bash
   php artisan key:generate
   ```

5. **Crea las tablas y llena los productos de prueba:**
   Corrí las migraciones junto con el seeder para que no tengas que crear productos a mano:
   ```bash
   php artisan migrate --seed
   ```

6. **Compila la documentación de Swagger:**
   ```bash
   php artisan l5-swagger:generate
   ```

7. **Enciende el servidor local:**
   ```bash
   php artisan serve
   ```

---

## ¿Cómo probar los endpoints?

Cuando el servidor esté corriendo, abre tu navegador y entra a esta ruta:
🔗 **[http://127.0.0](http://127.0.0)**

Ahí verás la interfaz de Swagger UI que armé. Puedes interactuar con los botones:
- **Público:** Ver la lista de productos y detalles.
- **Con Token:** Primero regístrate en `/api/register`, copia el `access_token` que te devuelve, pégalo arriba en el botón **"Authorize"** escribiendo la palabra `Bearer ` antes del token, y ya podrás simular compras en `/api/orders` usando la tarjeta de prueba de Stripe (`tok_visa`).

## Herramientas que usé
- **Laravel 12** (Framework principal)
- **Laravel Sanctum** (Para proteger las rutas con tokens)
- **Stripe PHP SDK** (Para la pasarela de pagos con tarjeta)
- **L5 Swagger** (Para la interfaz interactiva de OpenAPI)
- **MySQL** (Base de datos relacional)

