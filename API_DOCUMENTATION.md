# Documentación de la API - Risaralda EcoTurismo

## Base URL
```
http://localhost:8000/api
```

## Autenticación

La API utiliza Laravel Sanctum para autenticación mediante tokens Bearer.

### Headers requeridos para rutas protegidas:
```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

---

## Endpoints Públicos

### 1. Registro de Usuario
**POST** `/api/register`

**Body:**
```json
{
  "name": "usuario123",
  "email": "usuario@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Respuesta exitosa (201):**
```json
{
  "message": "Usuario registrado exitosamente",
  "user": {
    "id": 1,
    "name": "usuario123",
    "email": "usuario@example.com",
    "fecha_registro": "2025-01-01T00:00:00.000000Z",
    "is_admin": false
  },
  "token": "1|xxxxxxxxxxxx",
  "token_type": "Bearer",
  "expires_in": 2592000
}
```

### 2. Login
**POST** `/api/login`

**Body:**
```json
{
  "name": "usuario123",
  "password": "password123"
}
```
O con email:
```json
{
  "email": "usuario@example.com",
  "password": "password123"
}
```

**Respuesta exitosa (200):**
```json
{
  "message": "Inicio de sesión exitoso",
  "user": { ... },
  "token": "1|xxxxxxxxxxxx",
  "token_type": "Bearer",
  "expires_in": 2592000
}
```

### 3. Obtener Todos los Lugares
**GET** `/api/places`

**Query Parameters:**
- `category_id` (opcional): Filtrar por categoría
- `search` (opcional): Buscar por nombre o descripción

**Respuesta:**
```json
[
  {
    "id": 1,
    "name": "Parque Natural",
    "description": "...",
    "location": "...",
    "image": "...",
    "average_rating": 4.5,
    "reviews_count": 10,
    "categories": [...]
  }
]
```

### 4. Obtener un Lugar Específico
**GET** `/api/places/{id}`

**Respuesta:**
```json
{
  "place": { ... },
  "average_rating": 4.5,
  "reviews_count": 10
}
```

### 5. Obtener Todas las Categorías
**GET** `/api/categories`

### 6. Obtener una Categoría
**GET** `/api/categories/{id}`

### 7. Obtener Reseñas de un Lugar
**GET** `/api/places/{placeId}/reviews`

### 8. Enviar Mensaje de Contacto
**POST** `/api/messages`

**Body:**
```json
{
  "name": "Juan Pérez",
  "email": "juan@example.com",
  "subject": "Consulta",
  "message": "Mensaje de contacto"
}
```

---

## Endpoints Protegidos (requieren token)

### Autenticación

#### Verificar Token
**GET** `/api/verify-token`

#### Obtener Usuario Actual
**GET** `/api/user`

#### Cerrar Sesión
**POST** `/api/logout`

#### Cerrar Todas las Sesiones
**POST** `/api/logout-all`

### Perfil de Usuario

#### Obtener Perfil
**GET** `/api/profile`

#### Actualizar Perfil
**PUT** `/api/profile`

**Body:**
```json
{
  "name": "nuevo_nombre",
  "email": "nuevo@email.com"
}
```

#### Cambiar Contraseña
**PUT** `/api/profile/password`

**Body:**
```json
{
  "current_password": "password_actual",
  "new_password": "nueva_password",
  "new_password_confirmation": "nueva_password"
}
```

### Reservas

#### Obtener Mis Reservas
**GET** `/api/reservations/my`

#### Obtener Todas las Reservas (Admin)
**GET** `/api/reservations`

#### Crear Reserva
**POST** `/api/reservations`

**Body:**
```json
{
  "place_id": 1,
  "fecha_visita": "2025-12-25",
  "hora_visita": "14:00",
  "personas": 2,
  "telefono_contacto": "3001234567",
  "comentarios": "Comentarios adicionales",
  "precio_total": 50000
}
```

#### Obtener una Reserva
**GET** `/api/reservations/{id}`

#### Actualizar Reserva
**PUT** `/api/reservations/{id}`

#### Eliminar Reserva
**DELETE** `/api/reservations/{id}`

### Reseñas

#### Crear Reseña
**POST** `/api/reviews`

**Body:**
```json
{
  "place_id": 1,
  "rating": 5,
  "comment": "Excelente lugar"
}
```

#### Eliminar Reseña
**DELETE** `/api/reviews/{id}`

### Favoritos

#### Obtener Mis Favoritos
**GET** `/api/favorites`

#### Agregar a Favoritos
**POST** `/api/favorites`

**Body:**
```json
{
  "place_id": 1
}
```

#### Eliminar de Favoritos
**DELETE** `/api/favorites/{placeId}`

### Lugares (Admin)

#### Crear Lugar
**POST** `/api/places` (Requiere admin)

**Body:**
```json
{
  "name": "Nuevo Lugar",
  "description": "...",
  "location": "...",
  "image": "...",
  "categories": [1, 2]
}
```

#### Actualizar Lugar
**PUT** `/api/places/{id}` (Requiere admin)

#### Eliminar Lugar
**DELETE** `/api/places/{id}` (Requiere admin)

### Categorías (Admin)

#### Crear Categoría
**POST** `/api/categories` (Requiere admin)

**Body:**
```json
{
  "name": "Aventura",
  "description": "...",
  "icon": "🏔️"
}
```

#### Actualizar Categoría
**PUT** `/api/categories/{id}` (Requiere admin)

#### Eliminar Categoría
**DELETE** `/api/categories/{id}` (Requiere admin)

### Pagos (Boceto)

#### Obtener Mis Pagos
**GET** `/api/payments`

#### Crear Pago
**POST** `/api/payments`

**Body:**
```json
{
  "reservation_id": 1,
  "amount": 50000,
  "payment_method": "transferencia"
}
```

---

## Códigos de Estado HTTP

- `200` - Éxito
- `201` - Creado exitosamente
- `401` - No autenticado
- `403` - No autorizado (requiere permisos)
- `404` - No encontrado
- `422` - Error de validación
- `500` - Error del servidor

---

## Errores de Validación

Cuando hay errores de validación, la respuesta será:

```json
{
  "message": "Los datos proporcionados no son válidos.",
  "errors": {
    "campo": ["Mensaje de error"]
  }
}
```

---

## Notas Importantes

1. Todos los tokens expiran después de 30 días
2. Las rutas de admin requieren que el usuario tenga `is_admin: true`
3. Las fechas deben estar en formato ISO 8601 (YYYY-MM-DD)
4. Las horas deben estar en formato 24 horas (HH:mm)
5. El sistema de pagos es un BOCETO y no está completamente funcional
