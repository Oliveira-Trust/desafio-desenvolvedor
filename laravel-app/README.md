# Financial Data Processing API

A Laravel-based REST API for uploading, processing, and querying financial instrument data. This application provides a complete workflow for uploading financial data files (CSV/Excel), processing them asynchronously, storing the data in MongoDB with optimized indexes, and providing API endpoints for searching and retrieving the data with authentication and caching.

## Features

- **File Upload & Processing:**
  - Upload financial data files (CSV/Excel)
  - Asynchronous processing using Laravel queue system
  - Duplicate file detection with hash verification

- **Data Storage:**
  - MySQL for storing upload metadata
  - MongoDB for storing financial instrument data with optimized indexes
  - Efficient storage and retrieval of large datasets

- **API Endpoints:**
  - Authentication with Laravel Sanctum (register/login/logout)
  - File upload with validation
  - Upload history with filtering and pagination
  - Data search with filtering and pagination

- **Performance Optimizations:**
  - Redis caching for data search queries
  - Cache invalidation when new files are processed
  - Asynchronous processing for large files
  - Optimized MongoDB indexing

## Tech Stack

- **Backend:** Laravel 9.x / PHP 8.2
- **Databases:**
  - MySQL (for user and upload metadata)
  - MongoDB (for financial data)
- **Caching:** Redis
- **Queue Processing:** Laravel Queue with Database Driver
- **Authentication:** Laravel Sanctum
- **Docker:** PHP 8.2, MySQL 8.0, MongoDB 5.0, Redis 6.2

## Prerequisites

- Docker and Docker Compose
- Git

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/username/financial-data-api.git
   cd financial-data-api
   ```

2. Start the Docker environment:
   ```bash
   docker-compose up -d
   ```

3. Install dependencies:
   ```bash
   docker-compose exec app composer install
   ```

4. Copy the environment configuration:
   ```bash
   cp .env.example .env
   ```

5. Generate an application key:
   ```bash
   docker-compose exec app php artisan key:generate
   ```

6. Run migrations:
   ```bash
   docker-compose exec app php artisan migrate
   ```

7. Set up MongoDB indexes:
   ```bash
   docker-compose exec app php artisan db:mongo:setup-indexes
   ```

## Usage

### API Documentation

API documentation is available via Swagger UI at:
```
http://localhost/api/documentation
```

### API Endpoints

#### Authentication

- **POST /api/register** - Register a new user
- **POST /api/login** - Login and get access token
- **POST /api/logout** - Logout and revoke token
- **GET /api/user** - Get authenticated user information

#### File Upload

- **POST /api/v1/upload** - Upload financial data file
- **GET /api/v1/uploads** - Get upload history
- **GET /api/v1/uploads/{id}** - Get specific upload details

#### Data Search

- **GET /api/v1/data** - Search financial data with optional filters:
  - `TckrSymb` - Filter by ticker symbol
  - `RptDt` - Filter by report date
  - `page` - Page number for pagination
  - `per_page` - Number of items per page

### Example Requests

#### Register a User

```bash
curl -X POST http://localhost/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john.doe@example.com","password":"securepassword"}'
```

#### Login

```bash
curl -X POST http://localhost/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john.doe@example.com","password":"securepassword"}'
```

#### Upload a File

```bash
curl -X POST http://localhost/api/v1/upload \
  -H "Authorization: Bearer {your_token}" \
  -F "file=@/path/to/your/file.csv"
```

#### Search Data

```bash
curl -X GET "http://localhost/api/v1/data?TckrSymb=AAPL&page=1&per_page=50" \
  -H "Authorization: Bearer {your_token}"
```

## Running Tests

```bash
# Run all tests
docker-compose exec app php artisan test

# Run specific test suite
docker-compose exec app php artisan test --testsuite=Feature

# Run performance tests (these are skipped by default)
docker-compose exec app RUN_PERFORMANCE_TESTS=1 php artisan test --group=performance
```

## Development

### Code Style

This project follows PSR-12 coding standards. You can check and fix the code style using Laravel Pint:

```bash
docker-compose exec app ./vendor/bin/pint
```

### Static Analysis

You can run static analysis using PHPStan:

```bash
docker-compose exec app ./vendor/bin/phpstan analyse
```

## License

This project is licensed under the MIT License - see the LICENSE file for details.
