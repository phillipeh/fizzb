# p_1

**p_1** is a Symfony API project that provides 2 API endpoints using JWT authentication. 
The project is fully containerized using Docker and Docker Compose. 
When you clone this repository, you will have a project root that contains everything, including:

- `install.sh` – A shell script to install dependencies (when docker installed in unix server), set up Composer and Symfony CLI, create the Symfony project, generate JWT credentials, run database migrations, and start Docker containers.
- `docker-compose.yml` – Defines two services: `app` (the PHP/Apache container) and `db` (the MySQL container).
- `Dockerfile` – Builds the PHP/Apache container with all required PHP extensions.
- `fbuzz-api/` – The Symfony project folder.
- `db-init/` – A directory containing SQL scripts for initializing the MySQL database. (optional for backup/recovery since task is already done by symfony by now)
- `.env` (and optionally `.env.local`) – Environment configuration files.

---

## Features

- **JWT Authentication:**  
  Uses [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle) to manage API login via the `/api/login` endpoint. The bundle handles login automatically when valid credentials are provided.

- **Protected API Endpoints:**  
  Endpoints (such as `/api/fizzbuzz`) are secured and require a valid JWT token in the `Authorization` header.

- **Database Integration:**  
  Uses Doctrine ORM to manage the `ApiUser` entity. The MySQL container automatically initializes the database with SQL scripts from the `db-init/` folder on first startup.

- **Containerized Environment:**  
  The application runs in Docker, with separate containers for PHP/Apache and MySQL.

---

## Prerequisites

- [Docker](https://docs.docker.com/get-docker/) installed
- [Docker Compose](https://docs.docker.com/compose/install/) installed

---

## Getting Started

### 1. Clone the Repository

Clone the repository to your local machine. Since **p_1** is the repository root, all files and directories are immediately available:

#bash
git clone https://github.com/philipeh/p_1.git
cd p_1


### 2. Create or update your .env.local file in the project root with your environment-specific settings. For example:

# .env.local
APP_ENV=dev
PROJECT_DIR=fbuzz-api
DATABASE_URL="mysql://<change me>:<change me>@db:3306/<change me>?serverVersion=8.0"
JWT_PASSPHRASE="<change me>"

### 3. (optional) run script on unix servers where docker is to be installed:

#bash
chmod +x install.sh
./install.sh

### 4. run Docker
#bash
cd p_1
docker-compose up --build -d



### 5. Using the API
JWT Authentication Flow
Login:

Send a POST request to /api/login with a JSON payload containing username and password. For example:
body:
{
  "username": "apiuser",
  "password": "secret"
}

On successful authentication, the LexikJWTAuthenticationBundle returns a JWT token:
Response:
{
  "token": "eyJhbGciOiJSUzI1NiIsImtpZCI6Ij...rest_of_token"
}

Send a POST request to /api/fizzbuzz with a JSON payload containing the parameter specified in the exercise. For example:
body:
{
  "int1": 6,
  "int2": 8,
  "limit": 100,
  "str1": "fizz",
  "str2": "buzz",
}
Response:
{
  "result": "1234...fizz...buzz......fizz...buzz......fizz...buzz......fizz...buzz......100"
}