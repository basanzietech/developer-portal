# Developer Portal API

A simple Laravel project for managing API keys and per‑developer users, with a friendly landing page and JSON‑only API endpoints.

**GitHub:** [basanzietech/developer-portal](https://github.com/basanzietech/developer-portal)

---

## Features

- **Landing page** (`/`) with navigation links and API usage guide  
- **Developer** registration, login, logout (Blade views)  
- **Dashboard** showing API key & **total users** count  
- **API** endpoints under `/api/users`, secured via `X-API-KEY` header  
- **User login** endpoint: `POST /api/users/login`  
- Unique `phone` & `email` per developer (scoped)  
- Proper HTTP status codes & JSON messages  
- Rate limiting: **60 requests/min** (configurable)

---

## Getting Started

### 1. Clone & Install

```bash
git clone https://github.com/basanzietech/developer-portal.git
cd developer-portal
composer install
cp .env.example .env
php artisan key:generate
```

### 2. Configure Database (SQLite)

```bash
touch database/database.sqlite
```

In your `.env`:

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=/full/path/to/developer-portal/database/database.sqlite

CACHE_DRIVER=file
SESSION_DRIVER=file

APP_URL=http://127.0.0.1:8000
APP_ENV=local
APP_DEBUG=true
```

### 3. Run Migrations

```bash
php artisan migrate
```

### 4. Serve the App

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Visit `http://127.0.0.1:8000/` in your browser.

---

## Web Workflow

### Landing Page (`/`)

- Shows project name, nav links (Login/Register or Dashboard)  
- Quick guide to API usage and example `curl` command  

### Register & Login

- **Register**: `GET /register` → choose username, email, password  
- **Login**: `GET /login` → enter email & password  

Upon login you’re redirected to **Dashboard**.

### Dashboard (`/dashboard`)

- Displays your **API Key** (generate a new one if needed)  
- Shows **Total users** count under your account  
- Link to **Logout**

---

## API Usage

All API requests to `/api/users*` must include your API key:

```
X-API-KEY: your_32_character_api_key
```

### Endpoints

| Method | URL                   | Description                             |
|--------|-----------------------|-----------------------------------------|
| GET    | `/api/users`          | List all your users                     |
| GET    | `/api/users/{id}`     | Retrieve a single user                  |
| POST   | `/api/users`          | Create a new user                       |
| PUT    | `/api/users/{id}`     | Update an existing user                 |
| DELETE | `/api/users/{id}`     | Delete a user (404 JSON if not found)   |
| POST   | `/api/users/login`    | Authenticate a user (returns JSON)      |

### Example: List Users

```bash
curl -X GET http://127.0.0.1:8000/api/users \
  -H "X-API-KEY: your_32_character_api_key"
```

### Example: Create User

```bash
curl -X POST http://127.0.0.1:8000/api/users \
  -H "X-API-KEY: your_32_character_api_key" \
  -d "phone=0712345678&status=active&uid=ABC123&remaining_days=30&email=user@example.com&password=secret&username=user1"
```

### Authentication (User Login)

```bash
curl -X POST http://127.0.0.1:8000/api/users/login \
  -H "X-API-KEY: your_32_character_api_key" \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"secret"}'
```

---

## JSON Response Format

- **Success** (e.g. create, update):

  ```json
  {
    "message": "User created successfully.",
    "data": { /* user object */ }
  }
  ```

- **List / Show**:

  ```json
  {
    "message": "Users retrieved successfully.",
    "data": [ /* array of users */ ]
  }
  ```

- **Login success**:

  ```json
  {
    "message": "Login successful.",
    "data": { /* user object */ }
  }
  ```

- **Errors**:

  - **401 Unauthorized**  
    ```json
    { "message": "Invalid API Key" }
    ```
  - **404 Not Found**  
    ```json
    { "message": "User not found." }
    ```
  - **422 Unprocessable Entity** (validation failures)

---

## Environment Variables

In production, adjust in `.env`:

```dotenv
APP_ENV=production
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
```

---

© 2025 **basanzietech**  
```