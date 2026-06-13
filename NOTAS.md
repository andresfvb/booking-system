# NOTAS DE DESARROLLO

## Uso de Inteligencia Artificial

Durante el desarrollo de esta prueba técnica utilicé herramientas de inteligencia artificial como apoyo al proceso de desarrollo, revisión y resolución de problemas.

Considero que la IA es una herramienta que acelera significativamente la productividad cuando se utiliza con criterio técnico, validando siempre los resultados obtenidos.

---

## Qué partes fueron desarrolladas con ayuda de IA

La IA fue utilizada para:

### Diseño Inicial de Arquitectura

Se utilizó para explorar alternativas de diseño y definir una arquitectura basada en:

* MVC
* Service Layer
* Repository Pattern
* DTO Pattern
* Validation Layer

La arquitectura final fue adaptada a las necesidades específicas de WordPress y de los requerimientos de la prueba.

---

### Estructuras Base

Se utilizó IA para acelerar la creación inicial de:

* DTOs
* Repositories
* Services
* Validators
* Controllers
* Migraciones

Esto permitió concentrar más tiempo en la lógica de negocio y menos en tareas repetitivas.

---

### Documentación

La documentación del proyecto (README y notas técnicas) fue redactada con apoyo de IA y posteriormente ajustada para reflejar fielmente las decisiones tomadas durante el desarrollo.

---

### Resolución de Problemas

La IA fue utilizada como herramienta de debugging para:

* Diagnosticar errores de WordPress.
* Revisar problemas relacionados con dbDelta.
* Resolver conflictos de namespaces y autoloading.
* Analizar problemas de zonas horarias.
* Validar reglas de negocio.

---

## Qué partes fueron ajustadas o reescritas manualmente

Las siguientes áreas requirieron intervención y ajustes manuales:

### Persistencia de Datos

Se realizaron ajustes manuales en:

* Diseño de tablas.
* Consultas SQL.
* Índices.
* Integración con WordPress Database API.

Especialmente debido a particularidades de `dbDelta()` y WordPress.

---

### Reglas de Negocio

Las validaciones fueron revisadas y ajustadas manualmente para garantizar el cumplimiento de los requisitos:

* Horarios de atención.
* Anticipación mínima.
* Límite de reservas activas.
* Solapamiento de reservas.
* Reembolsos.
* Festivos.

---

### Integración con ACF

La estructura inicial fue generada con apoyo de IA, pero la configuración final de grupos, campos y comportamiento fue ajustada manualmente para facilitar la administración desde WordPress.

---

### Corrección de Bugs

Durante el desarrollo aparecieron diversos problemas que fueron corregidos manualmente:

* Errores de namespaces.
* Errores de autoloading.
* Problemas con zonas horarias.
* Problemas de construcción de DTOs.
* Configuración de tablas e índices.
* Compatibilidad con WordPress.

---

## Qué haría diferente en un proyecto de producción

Con más tiempo incorporaría:

* PHPUnit.
* Testing de integración.
* Docker.
* GitHub Actions.
* Observabilidad y logging estructurado.
* JWT Authentication.
* Cobertura automatizada de pruebas.
* Integración con sistemas externos de calendario.
* Integración con pasarelas de pago.

---

## Reflexión Final

La IA fue utilizada como acelerador del proceso de desarrollo, no como sustituto del criterio técnico.

Todo el código incluido en la solución fue revisado, validado y ajustado manualmente cuando fue necesario. Las decisiones de arquitectura, estructura de datos, reglas de negocio y resolución de problemas fueron tomadas considerando los requerimientos de la prueba y las particularidades del ecosistema WordPress.
