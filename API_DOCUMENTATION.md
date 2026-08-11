# HR Management System - API Documentation

Base URL: `http://localhost:8000/api`

## Authentication
All API endpoints except `/login` require a Bearer token in the `Authorization` header. You can obtain this token by authenticating with the `/login` endpoint.

**Header Format:**
```
Authorization: Bearer <your-token>
Accept: application/json
```

---

### Login
Authenticate a user and get a Sanctum access token.
- **Method**: `POST`
- **Endpoint**: `/login`
- **Request Body**:
  ```json
  {
      "email": "admin@example.com",
      "password": "password"
  }
  ```
- **Success Response (200 OK)**:
  ```json
  {
      "user": {
          "id": 1,
          "name": "Admin HR",
          "email": "admin@example.com"
      },
      "token": "1|abc123def456ghi789..."
  }
  ```

---

### Logout
Revoke the current access token.
- **Method**: `POST`
- **Endpoint**: `/logout`
- **Headers**: `Authorization: Bearer <token>`
- **Success Response (200 OK)**:
  ```json
  {
      "message": "Logged out successfully"
  }
  ```

---

## Departments

### List Departments
- **Method**: `GET`
- **Endpoint**: `/departments`
- **Headers**: `Authorization: Bearer <token>`
- **Success Response (200 OK)**:
  ```json
  {
      "data": [
          {
              "id": 1,
              "name": "IT",
              "description": "Information Technology Department",
              "employees_count": 5,
              "created_at": "2026-08-10T11:00:00.000000Z",
              "updated_at": "2026-08-10T11:00:00.000000Z"
          }
      ]
  }
  ```

### Create Department
- **Method**: `POST`
- **Endpoint**: `/departments`
- **Headers**: `Authorization: Bearer <token>`
- **Request Body**:
  ```json
  {
      "name": "Marketing",
      "description": "Marketing and Advertising"
  }
  ```

### Get Department
- **Method**: `GET`
- **Endpoint**: `/departments/{id}`
- **Headers**: `Authorization: Bearer <token>`

### Update Department
- **Method**: `PUT` or `PATCH`
- **Endpoint**: `/departments/{id}`
- **Headers**: `Authorization: Bearer <token>`
- **Request Body**:
  ```json
  {
      "name": "Digital Marketing"
  }
  ```

### Delete Department
- **Method**: `DELETE`
- **Endpoint**: `/departments/{id}`
- **Headers**: `Authorization: Bearer <token>`

---

## Employees

### List Employees
- **Method**: `GET`
- **Endpoint**: `/employees`
- **Headers**: `Authorization: Bearer <token>`
- **Query Parameters**:
  - `page` (optional): Page number for pagination
  - `search` (optional): Search by name, email, or department
- **Success Response (200 OK)**:
  ```json
  {
      "data": [
          {
              "id": 1,
              "full_name": "John Doe",
              "email": "john@example.com",
              "phone": "1234567890",
              "department_id": 1,
              "department": {
                  "id": 1,
                  "name": "IT"
              },
              "designation": "Software Engineer",
              "salary": "75000.00",
              "joining_date": "2026-01-15",
              "profile_image_url": "http://localhost:8000/storage/employees/image.jpg",
              "cv_document_url": null,
              "status": "active"
          }
      ],
      "links": { ... },
      "meta": { ... }
  }
  ```

### Create Employee
- **Method**: `POST`
- **Endpoint**: `/employees`
- **Headers**: 
  - `Authorization: Bearer <token>`
  - `Content-Type: multipart/form-data` (if uploading files)
- **Request Body (FormData)**:
  - `full_name`: string (required)
  - `email`: string (required, unique)
  - `phone`: string (optional)
  - `department_id`: integer (required)
  - `designation`: string (required)
  - `salary`: numeric (optional)
  - `joining_date`: date (required, YYYY-MM-DD)
  - `status`: string ('active' or 'inactive', required)
  - `profile_image`: file (image, optional, max 2MB)
  - `cv_document`: file (pdf, optional, max 5MB)

### Get Employee
- **Method**: `GET`
- **Endpoint**: `/employees/{id}`
- **Headers**: `Authorization: Bearer <token>`

### Update Employee
- **Method**: `POST` (Use `_method=PUT` in FormData if uploading files)
- **Endpoint**: `/employees/{id}`
- **Headers**: `Authorization: Bearer <token>`
- **Request Body**: Same as Create

### Delete Employee
- **Method**: `DELETE`
- **Endpoint**: `/employees/{id}`
- **Headers**: `Authorization: Bearer <token>`

