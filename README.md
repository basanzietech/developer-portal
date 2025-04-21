# Developer Portal API

This repository provides a simple Laravel‑based Developer Portal where developers can:

1. **Register** and **Login**  
2. **Generate an API Key**  
3. **Manage their users** via a RESTful `/api/users` endpoint  
4. All user data is partitioned per developer and secured by your API key.

---

## Table of Contents

- [Prerequisites](#prerequisites)  
- [Installation & Setup](#installation--setup)  
- [Running the Application](#running-the-application)  
- [Developer Workflows](#developer-workflows)  
  - [Register & Login (Web)](#register--login-web)  
  - [Generate API Key](#generate-api-key)  
- [API Usage](#api-usage)  
  - [Authentication](#authentication)  
  - [Endpoints](#endpoints)  
    - [List Users](#list-users)  
    - [Create User](#create-user)  
    - [Retrieve User](#retrieve-user)  
    - [Update User](#update-user)  
    - [Delete User](#delete-user)  
- [Error Responses](#error-responses)  
- [Rate Limiting](#rate-limiting)  
- [Environment Variables](#environment-variables)  

---

## Prerequisites

- PHP 8.1+  
- Composer  
- SQLite (or MySQL/PostgreSQL in production)  
- Node.js & NPM (optional, if adding custom frontend)  
- Termux / Linux / macOS / Windows (WSL)

---

## Installation & Setup

1. **Clone the repo**  
   ```bash
   git clone https://github.com/basanzietech/developer‑portal.git
   cd developer‑portal
   ```

2. **Copy environment file**  
   ```bash
   cp .env.example .env
   ```

3. **Generate application key**  
   ```bash
   composer install
   php artisan key:generate
   ```

4. **Configure database** (default uses SQLite)  
   - In `.env`, set:
     ```
     DB_CONNECTION=sqlite
     DB_DATABASE=/full/path/to/developer-portal/database/database.sqlite
     CACHE_DRIVER=file
     SESSION_DRIVER=file
     ```
   - Create the SQLite file:
     ```bash
     mkdir database
     touch database/database.sqlite
     ```

5. **Run migrations**  
   ```bash
   php artisan migrate
   ```

---

## Running the Application

Start the built‑in server:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Visit your browser or API client at `http://127.0.0.1:8000`.

---

## Developer Workflows

### Register & Login (Web)

- **Register** at:  
  `GET  /register` → fill **Username**, **Email**, **Password**, **Confirm Password**  
- **Login** at:  
  `GET  /login` → enter **Email**, **Password**

After login, you’ll be redirected to your **Dashboard**.

### Generate API Key

On the Dashboard, click **Generate API Key**. Your unique 32‑character key will be displayed.

> **Keep this key secret!** All API calls require this header:
> ```
> X-API-KEY: YOUR_API_KEY
> ```

---

## API Usage

### Authentication

All requests to `/api/users` must include your API key:

```http
X-API-KEY: 2umXQVcNH9sRbqXZ1L8vRjACAmdOYAfR
```

Base URL:

```
http://127.0.0.1:8000/api/users
```

### Endpoints

#### List Users

```
GET /api/users
```

```bash
curl -X GET http://127.0.0.1:8000/api/users \
  -H "X-API-KEY: YOUR_API_KEY"
```

#### Create User

```
POST /api/users
Content-Type: application/json
```

Body (JSON):

```json
{
  "phone": "0712345678",
  "status": "active",
  "uid": "UNIQUE_ID_001",
  "remaining_days": 30,
  "email": "foo@bar.com",
  "password": "secret123",
  "username": "foo_user"
}
```

```bash
curl -X POST http://127.0.0.1:8000/api/users \
  -H "Content-Type: application/json" \
  -H "X-API-KEY: YOUR_API_KEY" \
  -d '{
    "phone":"0712345678",
    "status":"active",
    "uid":"UNIQUE_ID_001",
    "remaining_days":30,
    "email":"foo@bar.com",
    "password":"secret123",
    "username":"foo_user"
  }'
```

#### Retrieve User

```
GET /api/users/{id}
```

```bash
curl -X GET http://127.0.0.1:8000/api/users/5 \
  -H "X-API-KEY: YOUR_API_KEY"
```

#### Update User

```
PUT /api/users/{id}
Content-Type: application/json
```

Body (JSON):

```json
{
  "phone": "0711111111",
  "status": "inactive",
  "uid": "UNIQUE_ID_001",
  "remaining_days": 0,
  "email": "new@foo.com",
  "username": "foo_new"
}
```

```bash
curl -X PUT http://127.0.0.1:8000/api/users/5 \
  -H "Content-Type: application/json" \
  -H "X-API-KEY: YOUR_API_KEY" \
  -d '{ /* fields as above */ }'
```

#### Delete User

```
DELETE /api/users/{id}
```

```bash
curl -X DELETE http://127.0.0.1:8000/api/users/5 \
  -H "X-API-KEY: YOUR_API_KEY"
```

---

## Error Responses

- **401 Unauthorized**  
  Missing or invalid `X-API-KEY`.
- **404 Not Found**  
  Resource or route does not exist.
- **422 Unprocessable Entity**  
  Validation errors (missing or malformed fields).

---

## Rate Limiting

- Default: **60 requests / minute** per developer.
- Configured in `RouteServiceProvider` under the `api` rate limiter.

---

## Environment Variables

In your `.env` (production), ensure:

```dotenv
APP_NAME="Developer Portal"
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=...
DB_PORT=3306
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...

CACHE_DRIVER=file
SESSION_DRIVER=database

# Other services...
```

---

**Happy coding!** If you encounter any issues, please open an issue or contact the maintainer.