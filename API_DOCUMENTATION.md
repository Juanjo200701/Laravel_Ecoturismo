# Documentación de la API - EcoTurismo Backend

## Base URL
```
http://tu-dominio.com/api
```

## Autenticación
La API usa **Laravel Sanctum** para autenticación mediante tokens. Después de hacer login o registro, recibirás un token que debes incluir en el header de todas las peticiones protegidas:

```
Authorization: Bearer {token}
```

---

## Endpoints Públicos (Sin autenticación)

### 1. Registrar Usuario
```http
POST /api/register
```

**Body:**
```json
{
  "name": "usuario123",
  "email": "usuario@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response (201):**
```json
{
  "message": "Usuario registrado exitosamente",
  "user": {
    "id": 1,
    "name": "usuario123",
    "email": "usuario@example.com",
    "fecha_registro": "2025-01-15 10:30:00"
  },
  "token": "1|xxxxxxxxxxxxx"
}
```

### 2. Iniciar Sesión
```http
POST /api/login
```

**Body:**
```json
{
  "name": "usuario123",
  "password": "password123"
}
```

**Response (200):**
```json
{
  "message": "Inicio de sesión exitoso",
  "user": {
    "id": 1,
    "name": "usuario123",
    "email": "usuario@example.com"
  },
  "token": "1|xxxxxxxxxxxxx"
}
```

### 3. Obtener Todos los Lugares (Público)
```http
GET /api/places
```

**Response (200):**
```json
[
  {
    "id": 1,
    "name": "Parque del Café",
    "description": "Parque temático del café",
    "location": "Montenegro, Quindío",
    "image": "url_de_imagen.jpg",
    "created_at": "2025-01-15T10:00:00.000000Z",
    "updated_at": "2025-01-15T10:00:00.000000Z"
  }
]
```

### 4. Obtener un Lugar Específico (Público)
```http
GET /api/places/{id}
```

**Response (200):**
```json
{
  "id": 1,
  "name": "Parque del Café",
  "description": "Parque temático del café",
  "location": "Montenegro, Quindío",
  "image": "url_de_imagen.jpg",
  "reservations": [],
  "created_at": "2025-01-15T10:00:00.000000Z",
  "updated_at": "2025-01-15T10:00:00.000000Z"
}
```

---

## Endpoints Protegidos (Requieren autenticación)

### 5. Obtener Usuario Autenticado
```http
GET /api/user
Headers: Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "id": 1,
  "name": "usuario123",
  "email": "usuario@example.com",
  "fecha_registro": "2025-01-15 10:30:00",
  "reservations": []
}
```

### 6. Cerrar Sesión
```http
POST /api/logout
Headers: Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "message": "Sesión cerrada exitosamente"
}
```

### 7. Crear un Lugar
```http
POST /api/places
Headers: Authorization: Bearer {token}
```

**Body:**
```json
{
  "name": "Nuevo Lugar",
  "description": "Descripción del lugar",
  "location": "Ciudad, Departamento",
  "image": "url_de_imagen.jpg"
}
```

**Response (201):**
```json
{
  "id": 2,
  "name": "Nuevo Lugar",
  "description": "Descripción del lugar",
  "location": "Ciudad, Departamento",
  "image": "url_de_imagen.jpg",
  "created_at": "2025-01-15T10:00:00.000000Z",
  "updated_at": "2025-01-15T10:00:00.000000Z"
}
```

### 8. Actualizar un Lugar
```http
PUT /api/places/{id}
Headers: Authorization: Bearer {token}
```

**Body:**
```json
{
  "name": "Nombre Actualizado",
  "description": "Nueva descripción"
}
```

### 9. Eliminar un Lugar
```http
DELETE /api/places/{id}
Headers: Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "message": "Lugar eliminado correctamente"
}
```

### 10. Obtener Mis Reservas
```http
GET /api/reservations/my
Headers: Authorization: Bearer {token}
```

**Response (200):**
```json
[
  {
    "id": 1,
    "user_id": 1,
    "place_id": 1,
    "fecha": "2025-02-15",
    "personas": 2,
    "estado": "pendiente",
    "created_at": "2025-01-15T10:00:00.000000Z",
    "updated_at": "2025-01-15T10:00:00.000000Z",
    "place": {
      "id": 1,
      "name": "Parque del Café",
      "description": "...",
      "location": "..."
    },
    "usuario": {
      "id": 1,
      "name": "usuario123",
      "email": "usuario@example.com"
    }
  }
]
```

### 11. Obtener Todas las Reservas (del usuario autenticado)
```http
GET /api/reservations
Headers: Authorization: Bearer {token}
```

**Nota:** Solo devuelve las reservas del usuario autenticado.

### 12. Crear una Reserva
```http
POST /api/reservations
Headers: Authorization: Bearer {token}
```

**Body:**
```json
{
  "place_id": 1,
  "fecha": "2025-02-15",
  "personas": 2,
  "estado": "pendiente"
}
```

**Validaciones:**
- `place_id`: requerido, debe existir en la tabla places
- `fecha`: requerido, debe ser una fecha válida y no puede ser anterior a hoy
- `personas`: requerido, entero entre 1 y 50
- `estado`: opcional, valores permitidos: "pendiente", "confirmada", "cancelada" (por defecto: "pendiente")

**Response (201):**
```json
{
  "id": 1,
  "user_id": 1,
  "place_id": 1,
  "fecha": "2025-02-15",
  "personas": 2,
  "estado": "pendiente",
  "created_at": "2025-01-15T10:00:00.000000Z",
  "updated_at": "2025-01-15T10:00:00.000000Z",
  "place": { ... },
  "usuario": { ... }
}
```

### 13. Obtener una Reserva Específica
```http
GET /api/reservations/{id}
Headers: Authorization: Bearer {token}
```

**Nota:** Solo puedes ver tus propias reservas. Si intentas ver una reserva de otro usuario, recibirás un error 403.

### 14. Actualizar una Reserva
```http
PUT /api/reservations/{id}
Headers: Authorization: Bearer {token}
```

**Body:**
```json
{
  "fecha": "2025-02-20",
  "personas": 3,
  "estado": "confirmada"
}
```

**Nota:** Solo puedes actualizar tus propias reservas.

### 15. Eliminar una Reserva
```http
DELETE /api/reservations/{id}
Headers: Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "message": "Reserva eliminada correctamente"
}
```

**Nota:** Solo puedes eliminar tus propias reservas.

---

## Códigos de Estado HTTP

- `200` - OK (Éxito)
- `201` - Created (Recurso creado exitosamente)
- `204` - No Content (Eliminación exitosa)
- `400` - Bad Request (Error de validación)
- `401` - Unauthorized (No autenticado)
- `403` - Forbidden (No autorizado)
- `404` - Not Found (Recurso no encontrado)
- `422` - Unprocessable Entity (Error de validación)
- `500` - Internal Server Error (Error del servidor)

---

## Manejo de Errores

Todos los errores se devuelven en formato JSON:

```json
{
  "message": "Mensaje de error descriptivo",
  "errors": {
    "campo": ["Mensaje de error específico del campo"]
  }
}
```

**Ejemplo de error de validación (422):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name field is required."],
    "password": ["The password must be at least 6 characters."]
  }
}
```

**Ejemplo de error de autorización (403):**
```json
{
  "message": "No autorizado"
}
```

---

## Relaciones de Modelos

### Usuario (Usuarios)
- `reservations` - HasMany: Todas las reservas del usuario

### Lugar (Place)
- `reservations` - HasMany: Todas las reservas del lugar

### Reserva (Reservation)
- `usuario` - BelongsTo: El usuario que hizo la reserva
- `place` - BelongsTo: El lugar reservado

Cuando obtengas reservas, puedes incluir estas relaciones automáticamente usando `with()` en las consultas.

---

## Notas Importantes

1. **Seguridad:** Todas las rutas protegidas requieren el token de autenticación en el header.
2. **Reservas:** Los usuarios solo pueden ver, modificar y eliminar sus propias reservas.
3. **Lugares:** La lectura de lugares es pública, pero crear/actualizar/eliminar requiere autenticación.
4. **Validaciones:** Todas las fechas de reserva deben ser futuras (no se pueden hacer reservas en el pasado).
5. **Tokens:** Los tokens no expiran automáticamente. El usuario debe hacer logout para invalidarlos.

---

## Ejemplo de Uso con Fetch (JavaScript)

```javascript
// Login
const loginResponse = await fetch('http://tu-dominio.com/api/login', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    name: 'usuario123',
    password: 'password123'
  })
});

const { token, user } = await loginResponse.json();

// Guardar el token (ej: localStorage)
localStorage.setItem('token', token);

// Hacer petición autenticada
const placesResponse = await fetch('http://tu-dominio.com/api/places', {
  headers: {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json',
  }
});

const places = await placesResponse.json();
```

---

## Próximos Pasos Sugeridos

1. Implementar roles de usuario (admin, usuario normal)
2. Agregar paginación a las listas
3. Implementar búsqueda y filtros
4. Agregar sistema de comentarios/reseñas
5. Implementar notificaciones
6. Agregar subida de imágenes
7. Implementar sistema de favoritos

