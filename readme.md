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
    -   Modulo de Administradores actualizado, ahora puedes:
        -   Dar de alta un administrador y seleccionar su rol.
        -   Activar o desactivar un administrador desde el index.
        -   Eliminar un administrador.
    -   Módulo de **Mi Perfil** agregado ➕:
        -   El administrador puede editar su información.
    -   Denegar o permitir acceso a ciertos módulos en función del rol asignado al administrador:
        -   **Super Administrador** tiene acceso a todas las funciones del sistema.
        -   **Administrador** No puede acceder al módulo de administradores ni tampoco al módulo de reportes.
    -   Ocultar o mostrar botones, enlaces o información en función del rol asignado al administrador.
    -   Se ha modificado la vista del error 303.
    -   Modulo de categorías agregado, ahora puedes:
        -   Dar de alta una categoría.
        -   Editar una categoría.
        -   Activar o desactivar una categoría desde el index.
        -   Eliminar una categoría.

-   1.0

    -   Módulo de productos agregado ➕.

-   1.2.0

    -   Modulo de productos actualizado 🔄:
        -   Dar de alta un producto sin agregar una categoría obligatoriamente.
        -   Activar o desactivar un producto desde el index.
        -   Eliminar un producto.
        -   Se ha modificado la interfaz para agregar,editar o eliminar imágenes.
    -   Se agrega una ruta **Store** para la interfaz de la tienda.
    -   Se filtran los productos y categorías a mostrar en la tienda por su estado inactivo.
    -   Agregado Middleware para usuarios inactivos.

-   1.2.1

    -   Se valida el SKU del producto como único ➕.
    -   Se añade modal para confirmar la eliminación del producto ➕.
    -   Se agrega titulo al thumbnail de imagen de producto ➕:
    -   Trabajando en galeria de imagenes rama luis
    -   Modulo de imagenes terminada, rama isidro

-   2.0.0

    -   Se agrega modulo de imágenes ➕.
    -   Modulo de productos actualizado 🔄:
        -   Elminado modal para dar de alta un producto.
        -   Se elimina el limite de imágenes por producto.
    -   El administrador puede cambiar su imagen de perfil ➕.
