# Sistema de Inventario - [Equibra](https://www.equibra.com)

## Descripción

Sistema de Inventario y E-commerce desarrollado con Laravel

## Autores

Isidro Martínez
[@IsidroMar95](https://github.com/IsidroMar95)
Luis Pastén
[@luispastendev](https://github.com/luispastendev)

## Historial de versiones

-   0.1
    -   Despliegue Inicial ⚡
-   0.2
    -   Módulo de Altas de Administradores
    -   Login
    -   Reestablecer Password
-   0.3

    -   Ahora al dar de alta un administrador los datos de acceso se envían mediante email.
    -   Indica por email el rol que se le ha asignado al administrador.
    -   Se notifica que debe cambiar la contraseña.
    -   Módulo de Administradores actualizado, ahora puedes:
        -   Dar de alta un administrador y seleccionar su rol.
        -   Activar o desactivar un administrador desde el index.
        -   Eliminar un administrador.
    -   ➕ Módulo de **Mi Perfil** agregado:
        -   El administrador puede editar su información.
    -   Denegar o permitir acceso a ciertos módulos en función del rol asignado al administrador:
        -   **Super Administrador** tiene acceso a todas las funciones del sistema.
        -   **Administrador** No puede acceder al módulo de administradores ni tampoco al módulo de reportes.
    -   Ocultar o mostrar botones, enlaces o información en función del rol asignado al administrador.
    -   Se ha modificado la vista del error 303.
    -   Módulo de categorías agregado, ahora puedes:
        -   Dar de alta una categoría.
        -   Editar una categoría.
        -   Activar o desactivar una categoría desde el index.
        -   Eliminar una categoría.

-   1.0

    -   Módulo de productos agregado ➕.

-   1.2.0

    -   Módulo de productos actualizado 🔄:
        -   Dar de alta un producto sin agregar una categoría obligatoriamente.
        -   Activar o desactivar un producto desde el index.
        -   Eliminar un producto.
        -   Se ha modificado la interfaz para agregar,editar o eliminar imágenes.
    -   Se agrega una ruta **Store** para la interfaz de la tienda.
    -   Se filtran los productos y categorías a mostrar en la tienda por su estado inactivo.
    -   Agregado Middleware para usuarios inactivos.

-   1.2.1

    -   ➕ Se valida el SKU del producto como único.
    -   ➕ Se añade modal para confirmar la eliminación del producto.
    -   ➕ Se agrega titulo al thumbnail de imagen de producto.
    -   Trabajando en galeria de imagenes rama luis
    -   Módulo de imagenes terminada, rama isidro

-   2.0.0

    -   ➕ Se agrega módulo de imágenes.
    -   🔄 Módulo de productos actualizado:
        -   Elminado modal para dar de alta un producto.
        -   Se elimina el limite de imágenes por producto.
    -   ➕ El administrador puede cambiar su imagen de perfil.

-   2.1.1
    -   🔄 UI/UX actualizado, se rediseñaron los botones, badges, alertas y modales.
    -   🔄 Interfaz actualizada cuando un módulo no tiene registros.
    -   🔄 Interfaz actualizada en el perfil del administrador.
    -   🔄 Tablas de registros (index) de cada módulo actualizadas:
        -   Ahora usan ajax y se procesan del lado del servidor mejorando la velocidad y carga del sistema.
        -   Se arregla la parte responsive y ahora se pueden visualizar en pantallas pequeñas.
    -   🔄 Módulo de imágenes actualizado:
        -   Corregido gap entre imagenes en pantallas mayores a 1920x1080.
        -   Al editar detalles de una imagen el modal se cierra automaticamente.
    -   ➕ Se agrega axios (Ajax) en todos los módulos .
    -   ➕ Se agrega una animación de cargando en espera del response en el request (submit) de formularios y el botón se deshabilita.
    -   ➕ Se crea un avatar con las iniciales de un nuevo usuario nuevo al darlo de alta.
    -   ➕ Se agregan charts (estaticos) en el dashboard .
    -   Se agrega una restricción sobre el control del stock a los usuarios que no son SuperAdministradores (Adminisradores).
