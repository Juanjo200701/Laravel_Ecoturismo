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
    "fecha_registro": "2025-01-15 10:30:00",
    "is_admin": false
  },
  "token": "1|xxxxxxxxxxxxx",
  "token_type": "Bearer",
  "expires_in": 2592000
}
```

**Validaciones:**
- `name`: Requerido, mínimo 3 caracteres, máximo 255, único, solo letras, números y guiones bajos
- `email`: Opcional, debe ser un email válido, único si se proporciona
- `password`: Requerido, mínimo 6 caracteres, debe coincidir con `password_confirmation`

### 2. Iniciar Sesión
```http
POST /api/login
```

**Body (con nombre de usuario):**
```json
{
  "name": "usuario123",
  "password": "password123"
}
```

**Body (con email):**
```json
{
  "email": "usuario@example.com",
  "password": "password123"
}
```

**Nota:** Puedes usar `name` o `email` para iniciar sesión. Solo necesitas proporcionar uno de los dos.

**Response (200):**
```json
{
  "message": "Inicio de sesión exitoso",
  "user": {
    "id": 1,
    "name": "usuario123",
    "email": "usuario@example.com",
    "fecha_registro": "2025-01-15 10:30:00",
    "is_admin": false
  },
  "token": "1|xxxxxxxxxxxxx",
  "token_type": "Bearer",
  "expires_in": 2592000
}
```

**Errores posibles:**
- `422`: Error de validación (faltan campos o formato incorrecto)
- `422`: Credenciales incorrectas

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
  "user": {
    "id": 1,
    "name": "usuario123",
    "email": "usuario@example.com",
    "fecha_registro": "2025-01-15 10:30:00",
    "is_admin": true,
    "reservations_count": 2
  },
  "reservations": [
    {
      "id": 1,
      "place_id": 1,
      "fecha": "2025-02-15",
      "personas": 2,
      "estado": "pendiente"
    }
  ]
}
```

### 6. Verificar Token Válido
```http
GET /api/verify-token
Headers: Authorization: Bearer {token}
```

**Response (200) - Token válido:**
```json
{
  "valid": true,
  "user": {
    "id": 1,
    "name": "usuario123",
    "email": "usuario@example.com",
    "is_admin": false
  },
  "message": "Token válido"
}
```

**Response (401) - Token inválido:**
```json
{
  "valid": false,
  "message": "Token inválido o expirado"
}
```

### 7. Cerrar Sesión (Token Actual)
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

**Nota:** Solo revoca el token actual que se está usando.

### 8. Cerrar Todas las Sesiones
```http
POST /api/logout-all
Headers: Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "message": "Todas las sesiones han sido cerradas exitosamente"
}
```

**Nota:** Revoca todos los tokens del usuario (útil para cerrar sesión en todos los dispositivos).

### 9. Crear un Lugar *(solo administradores)*
```http
POST /api/places
Headers: Authorization: Bearer {token}
```

**Requiere** que el usuario autenticado tenga `is_admin = true`.

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

### 10. Actualizar un Lugar *(solo administradores)*
```http
PUT /api/places/{id}
Headers: Authorization: Bearer {token}
```

**Requiere** que el usuario autenticado tenga `is_admin = true`.

**Body:**
```json
{
  "name": "Nombre Actualizado",
  "description": "Nueva descripción"
}
```

### 11. Eliminar un Lugar *(solo administradores)*
```http
DELETE /api/places/{id}
Headers: Authorization: Bearer {token}
```

**Requiere** que el usuario autenticado tenga `is_admin = true`.

**Response (200):**
```json
{
  "message": "Lugar eliminado correctamente"
}
```

### 12. Obtener Mis Reservas
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

### 13. Obtener Todas las Reservas (del usuario autenticado)
```http
GET /api/reservations
Headers: Authorization: Bearer {token}
```

**Nota:** Solo devuelve las reservas del usuario autenticado.

### 14. Crear una Reserva
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

### 15. Obtener una Reserva Específica
```http
GET /api/reservations/{id}
Headers: Authorization: Bearer {token}
```

**Nota:** Solo puedes ver tus propias reservas. Si intentas ver una reserva de otro usuario, recibirás un error 403.

### 16. Actualizar una Reserva
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

### 17. Eliminar una Reserva
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

1. **Seguridad:** Todas las rutas protegidas requieren el token de autenticación en el header `Authorization: Bearer {token}`.
2. **Tokens:** 
   - Los tokens expiran después de 30 días
   - Al hacer login, se revocan los tokens anteriores del mismo nombre
   - Puedes usar `/api/logout` para cerrar la sesión actual
   - Puedes usar `/api/logout-all` para cerrar todas las sesiones
   - Usa `/api/verify-token` para verificar si un token es válido
3. **Login:** Puedes iniciar sesión usando `name` o `email` (solo necesitas uno de los dos).
4. **Reservas:** Los usuarios solo pueden ver, modificar y eliminar sus propias reservas.
5. **Lugares:** La lectura de lugares es pública, pero crear/actualizar/eliminar requiere autenticación.
6. **Validaciones:** 
   - Todas las fechas de reserva deben ser futuras (no se pueden hacer reservas en el pasado)
   - El nombre de usuario solo puede contener letras, números y guiones bajos
   - La contraseña debe tener al menos 6 caracteres
7. **Roles:** Las operaciones de creación/actualización/eliminación de lugares solo están disponibles para usuarios con `is_admin = true`.

---

## Roles y permisos

- `is_admin = false` (por defecto): puede autenticarse, consultar lugares públicos y gestionar únicamente sus reservas.
- `is_admin = true`: además de lo anterior, puede crear, actualizar y eliminar registros en `places` desde los endpoints protegidos.
- Puedes promover un usuario a administrador editando la columna `is_admin` (por ejemplo desde la base de datos o con un seeder).

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

