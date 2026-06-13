# Booking System Plugin

Sistema de reservas desarrollado para WordPress utilizando arquitectura MVC, reglas de negocio configurables desde WordPress mediante ACF y almacenamiento en tablas personalizadas.

## Descripción

Este proyecto implementa un sistema de reservas para servicios profesionales, permitiendo:

- Creación de reservas.
- Cancelación de reservas.
- Validación de reglas de negocio.
- Cálculo de reembolsos.
- Administración de configuraciones desde WordPress.
- Exposición de funcionalidades mediante REST API.

La solución fue desarrollada siguiendo principios SOLID y separación de responsabilidades mediante una arquitectura MVC.

---

# Características

## Gestión de Reservas

- Crear reservas.
- Cancelar reservas.
- Consultar reservas por usuario.
- Validar disponibilidad de profesionales.
- Evitar reservas solapadas.

## Reglas de Negocio

Configurables desde WordPress:

- Zona horaria.
- Horario de atención.
- Tiempo mínimo de anticipación.
- Máximo de reservas activas por usuario.
- Días festivos.
- Políticas de reembolso.

## Reembolsos

### Cliente Estándar

| Anticipación | Reembolso |
|-------------|------------|
| >= 24 horas | 100% |
| >= 4 horas | 50% |
| < 4 horas | 0% |

### Cliente Premium

| Anticipación | Reembolso |
|-------------|------------|
| >= 4 horas | 100% |
| >= 1 hora | 50% |
| < 1 hora | 0% |

---

# Arquitectura

```text
booking-system/
│
├── app/
│   ├── Controllers/
│   ├── DTO/
│   ├── Database/
│   ├── Exceptions/
│   ├── Http/
│   ├── Repositories/
│   ├── Services/
│   ├── Validators/
│   └── Support/
│
├── resources/
│   └── acf-json/
│
├── storage/
│
├── vendor/
│
├── composer.json
└── booking-system.php