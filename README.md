Here's a comprehensive `README.md` file for your Docker email collector project:

# Email Collector with Docker

A simple PHP/MySQL application for collecting email addresses, running in Docker containers.

## Prerequisites
- Docker Engine (v20.10+)
- Docker Compose (v2.0+)

## Setup Instructions

### 1. Clone the repository
```bash
git clone [your-repository-url]
cd [your-project-directory]
```

### 2. Start the containers
```bash
docker-compose up -d
```

### 3. Create the database table
Run this command to set up the required table:
```bash
docker-compose exec db mysql -u root -p -e "
  USE email_collector;
  CREATE TABLE IF NOT EXISTS emails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );"
```
When prompted for password, enter: `rootpassword`

### 4. Access the application
- Web interface: http://localhost:8080
- View collected emails: http://localhost:8080/view_emails.php

## Project Structure
```
.
├── docker-compose.yml
├── Dockerfile
├── nginx/
│   └── default.conf
├── index.php
├── mails.php
├── test.php
├── styles.css
├── waiting-for-db.php
└── README.md
```

## Container Details
| Service    | Ports      | Credentials             |
|------------|------------|-------------------------|
| Nginx      | 8080:80    | -                       |
| PHP-FPM    | 9000       | -                       |
| MySQL      | 3307:3306  | User: root<br>Password: rootpassword |

## Common Commands

### Start/Stop Containers
```bash
docker-compose up -d      # Start
docker-compose down       # Stop (keep volumes)
docker-compose down -v    # Stop and remove volumes
```

### View Logs
```bash
docker-compose logs -f    # All services
docker-compose logs db    # Just MySQL
```

### Access Database
```bash
docker-compose exec db mysql -u root -p email_collector
```

### Backup Database
```bash
docker-compose exec db sh -c 'exec mysqldump -uroot -p"$MYSQL_ROOT_PASSWORD" email_collector' > backup.sql
```

## Troubleshooting

### Connection Issues
If PHP can't connect to MySQL:
1. Verify MySQL is running:
   ```bash
   docker-compose ps
   ```
2. Check MySQL logs:
   ```bash
   docker-compose logs db
   ```

### Reset Everything
```bash
docker-compose down -v
docker-compose up -d
```

## License
[MIT License](LICENSE)
