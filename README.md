# Booking System Plugin

## Descripción

Sistema de reservas desarrollado para WordPress utilizando arquitectura MVC, tablas personalizadas y reglas de negocio configurables desde WordPress mediante ACF.

La solución implementa la lógica necesaria para la creación, consulta y cancelación de reservas, validando restricciones de negocio como horarios de atención, anticipación mínima, límites de reservas activas, festivos y políticas de reembolso.

---

# Cómo ejecutar el proyecto

## Requisitos

* PHP 8.1+
* WordPress 6+
* MySQL 8+
* Composer
* ACF Pro

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/andresfvb/booking-system.git
```

---

### 2. Instalar dependencias

```bash
composer install
```

---

### 3. Copiar el plugin

Ubicar el proyecto dentro de:

```text
wp-content/plugins/
```

---

### 4. Activar ACF Pro

Instalar y activar:

```text
Advanced Custom Fields Pro
```

---

### 5. Activar el plugin

Desde:

```text
WordPress → Plugins
```

Activar:

```text
Booking System
```

Durante la activación se ejecutan:

* Creación de tablas.
* Carga de configuración inicial.
* Seed de servicios.

---

### 6. Configurar reglas del sistema

Desde:

```text
Booking System → Configuración
```

Configurar:

* Zona horaria
* Horario de apertura
* Horario de cierre
* Anticipación mínima
* Máximo de reservas activas
* Reglas de reembolso
* Festivos

---

# Arquitectura

El proyecto fue desarrollado siguiendo una arquitectura MVC.

```text
booking-system/
│
├── app/
│   ├── Controllers/
│   ├── DTO/
│   ├── Database/
│   ├── Exceptions/
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
```

---

# Decisiones Técnicas

## Arquitectura MVC

Se eligió MVC para separar responsabilidades entre:

* Controladores
* Servicios
* Acceso a datos
* Validaciones

Esto facilita mantenimiento, escalabilidad y pruebas.

---

## Uso de Tablas Personalizadas

Se utilizaron tablas propias en lugar de Custom Post Types.

### Motivos

* Mejor rendimiento.
* Consultas más eficientes.
* Control total de índices.
* Datos transaccionales separados de WordPress.

Tablas implementadas:

```text
wp_booking_services
wp_booking_reservations
```

---

## Uso de ACF

ACF se utilizó exclusivamente como interfaz administrativa para gestionar reglas de negocio.

### Motivos

* Facilidad de administración.
* Modificación de reglas sin despliegues.
* Flexibilidad para usuarios no técnicos.

---

## Repository Pattern

Se implementó una capa Repository para desacoplar la lógica de negocio del acceso a base de datos.

Beneficios:

* Código mantenible.
* Consultas centralizadas.
* Facilita futuras migraciones.

---

## DTO Pattern

Se utilizaron Data Transfer Objects para transportar información entre capas.

Beneficios:

* Mayor claridad.
* Validación temprana.
* Menor acoplamiento.

---

# Reglas de Negocio Implementadas

## Horario de atención

No se permiten reservas fuera del horario configurado.

---

## Anticipación mínima

La reserva debe realizarse con una cantidad mínima de horas configurada previamente.

---

## Máximo de reservas activas

Un usuario no puede superar el límite configurado de reservas activas.

---

## Festivos

No se permiten reservas en fechas marcadas como festivas.

---

## Solapamiento

Un profesional no puede tener reservas superpuestas.

---

## Reembolsos

### Cliente Estándar

| Anticipación | Reembolso |
| ------------ | --------- |
| >= 24 horas  | 100%      |
| >= 4 horas   | 50%       |
| < 4 horas    | 0%        |

### Cliente Premium

| Anticipación | Reembolso |
| ------------ | --------- |
| >= 4 horas   | 100%      |
| >= 1 hora    | 50%       |
| < 1 hora     | 0%        |

---

# API REST

Base URL:

```text
/wp-json/booking/v1
```

---

## Crear reserva

### Endpoint

```http
POST /reservations
```

### Request

```json
{
  "user_id": 1,
  "service_id": 1,
  "professional_id": 1,
  "start_datetime": "2026-06-15 16:00:00"
}
```

---

## Cancelar reserva

### Endpoint

```http
POST /reservations/{id}/cancel
```

---

## Consultar reservas de usuario

### Endpoint

```http
GET /users/{id}/reservations
```

---

# Base de Datos

## booking_services

| Campo            |
| ---------------- |
| id               |
| name             |
| duration_minutes |
| price            |
| non_refundable   |
| created_at       |
| updated_at       |

---

## booking_reservations

| Campo           |
| --------------- |
| id              |
| user_id         |
| service_id      |
| professional_id |
| start_datetime  |
| end_datetime    |
| status          |
| amount          |
| refund_amount   |
| created_at      |
| updated_at      |

---

# Supuestos Tomados

Durante el desarrollo se asumió que:

1. Los usuarios ya existen dentro de WordPress.
2. Los profesionales son identificados mediante un ID.
3. Los servicios son administrados internamente.
4. Existe una única sede.
5. Existe una única zona horaria configurable.
6. Los pagos son simulados.
7. No existe integración con sistemas externos de calendario.

---

# Funcionalidades Dejadas por Fuera

Por alcance y tiempo se decidió no implementar:

## Autenticación

* JWT
* OAuth
* Application Passwords

Motivo:

La prueba se enfoca en la lógica de negocio.

---

## Testing Automatizado

* PHPUnit
* Integration Tests

Motivo:

Se priorizó la implementación funcional.

---

## Frontend

No se desarrolló una interfaz gráfica de reservas.

Motivo:

La prueba se centra en API y backend.

---

## Pagos

No se implementaron pasarelas de pago.

Motivo:

Fuera del alcance solicitado.

---

## Notificaciones

No se implementaron:

* Correos electrónicos
* SMS
* WhatsApp

Motivo:

No formaban parte de los requerimientos.

---

# Qué Haría Diferente con Más Tiempo

## Calidad

* PHPUnit
* Tests de integración
* Cobertura de reglas de negocio

---

## Seguridad

* JWT Authentication
* Roles y permisos
* Rate limiting

---

## DevOps

* Docker
* GitHub Actions
* Versionado de migraciones

---

## Funcionalidad

* Calendario visual
* Gestión avanzada de disponibilidad
* Múltiples sedes
* Google Calendar
* Outlook Calendar
* Notificaciones automáticas
* Integración con pagos

---

# Uso de Inteligencia Artificial

Durante el desarrollo se utilizaron herramientas de IA para:

* Diseño de arquitectura.
* Generación de estructuras iniciales.
* Revisión de código.
* Resolución de errores.
* Optimización de componentes.

Todo el código generado fue revisado, validado y adaptado manualmente antes de incorporarse al proyecto.

---

# Autor

**Andrés Vásquez**

Desarrollador WordPress / PHP
