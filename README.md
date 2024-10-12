Instrucciones para ejecutar el proyecto localmente

1. Clonar el repositorio:

git clone https://github.com/Ren19/CurrencyConverterBackend.git

2. Navegar al directorio del proyecto:

cd CurrencyConverterBackend

3. Copiar el archivo .env.example a .env y configurar las variables de entorno:

cp .env.example .env

4. Instalar las dependencias:

composer install

5. Generar la clave de la aplicación:

php artisan key:generate

6. Ejecutar las migraciones para configurar la base de datos:

php artisan migrate

7. Iniciar el servidor de desarrollo:

php artisan serve

8. Abrir http://127.0.0.1:8000 en tu navegador para ver el proyecto.

* Breve descripción de la arquitectura y decisiones técnicas

** Arquitectura: La aplicación backend está construida con Laravel, utilizando una arquitectura MVC (Model-View-Controller) para organizar el código de manera modular y eficiente.

** Controladores: Manejan la lógica de negocio y las rutas de la aplicación (AuthController, ConversionController, WebhookController, AuditLogController).

** Rutas: Definidas en routes/web.php y routes/api.php para manejar las solicitudes HTTP.

** Servicios: Los controladores se apoyan en servicios para manejar la lógica de autenticación y conversión, y para comunicarse con fuentes externas cuando sea necesario.

* Notas sobre medidas de seguridad y optimización
** Seguridad:
*** Utiliza autenticación mediante JWT para proteger las rutas API y asegurar que solo usuarios autenticados puedan acceder a ciertas funcionalidades.
*** Implementa validaciones de solicitudes en los controladores para asegurar la integridad y validez de los datos.

** Optimización:
*** Uso de migraciones y seeders para una fácil configuración de la base de datos.
*** Utilización de Eloquent ORM para un acceso eficiente a la base de datos.
*** Cacheado de configuraciones y limpieza de caché cuando es necesario para asegurar un rendimiento óptimo.

