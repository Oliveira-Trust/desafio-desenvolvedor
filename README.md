## Exchange API - Readme

This document serves as a guide for the Exchange API, a Laravel application designed to manage currency conversion.

### Features

* Convert from BRL to USD, EUR or ARS

### Technologies

* PHP 8.2 (Docker image)
* MySQL 8.0 (Docker image)
* Redis (Docker image)
* Laravel Framework

### Prerequisites

* Docker installed and running

### Setup

1. Checkout on this branch:

```bash
git checkout feat/lucas-coutinho
```

2. Build the Docker images and start the containers:

```bash
docker compose up -d
```

### Usage

**Dashboard:**

The dashboard is available at `http://localhost` (assuming the service is running on your local machine). This provides a detailed form to interact with the api on both Portuguese and English.

**API Documentation:**

The API documentation is available at `http://localhost/docs` (assuming the service is running on your local machine). This provides a detailed overview of the available endpoints, request parameters, and response formats.

**Currency conversion:**

```bash
curl -X POST http://localhost/api/currency-conversion -H "Content-Type: application/json" -d '{"target": "USD",  "conversion_value": 100000, "payment_method": "CREDIT_CARD"}'
```

### Additional Notes

* This API utilizes a Docker environment for ease of deployment and consistency.
