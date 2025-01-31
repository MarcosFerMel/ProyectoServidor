# Altos de la Sierra - Sistema de Gestión de Reservas

Este es un sistema de gestión de reservas para la casa rural "Altos de la Sierra". La aplicación permite a los administradores gestionar las habitaciones, temporadas, reservas y usuarios de la casa rural de manera eficiente.

## 🚀 Características Principales

- **Gestión de Habitaciones:** Crear, editar, eliminar y ver habitaciones disponibles.
- **Gestión de Reservas:** Crear, editar, eliminar y ver reservas realizadas por los clientes.
- **Gestión de Temporadas:** Definir temporadas (alta, baja) y sus multiplicadores de precio.
- **Gestión de Usuarios:** Crear y administrar cuentas de usuario, incluyendo roles (administrador, usuario).
- **Autenticación y Seguridad:** Registro e inicio de sesión de usuarios, roles y permisos básicos.

## 📦 Tecnologías Utilizadas

- **Laravel 11.40.0:** Framework PHP para el desarrollo de aplicaciones web.
- **Livewire:** Componente de Laravel para construir interfaces interactivas sin salir de Blade.
- **Jetstream:** Sistema de autenticación y administración de usuarios integrado en Laravel.
- **MySQL:** Base de datos para almacenar la información de habitaciones, reservas, temporadas y usuarios.
- **Tailwind CSS:** Framework CSS para diseñar la interfaz de usuario.

## ⚙️ Configuración del Proyecto

### 1. Clonar el Repositorio

```bash
git clone https://github.com/tu_usuario/altos-de-la-sierra.git
cd altos-de-la-sierra
```


🛠️ Estructura del Proyecto

    app/Models: Modelos de Eloquent para Room, Reservation, Season, y User.
    app/Livewire: Componentes Livewire para gestionar cada sección (habitaciones, reservas, temporadas, usuarios).
    resources/views/livewire: Vistas para cada componente de Livewire.
    resources/views/layouts: Layout principal de la aplicación, basado en Jetstream.
    routes/web.php: Rutas principales de la aplicación, incluyendo las rutas de Livewire.

📋 Uso de la Aplicación
🔑 Autenticación

    La aplicación incluye autenticación de usuarios. Regístrate o inicia sesión para acceder al dashboard de administración.
    Los administradores pueden gestionar todas las secciones: habitaciones, reservas, temporadas y usuarios.

🏠 Gestión de Habitaciones

    Ver una lista de todas las habitaciones.
    Crear, editar y eliminar habitaciones.
    Asignar temporadas a las habitaciones para ajustar precios.

📅 Gestión de Reservas

    Ver y gestionar todas las reservas realizadas por los clientes.
    Crear nuevas reservas, así como actualizar o cancelar reservas existentes.

📅 Gestión de Temporadas

    Crear y definir temporadas de alta y baja.
    Especificar multiplicadores de precio que afectan el costo de las habitaciones según la temporada.

👤 Gestión de Usuarios

    Crear, editar y eliminar usuarios.
    Asignar roles de usuario (administrador o usuario estándar).