Welcome to the **Admin Guide** for MyTaskBoard --- a lightweight task manager app built with PHP, MariaDB, and hosted on a Raspberry Pi.

This guide will help you **configure** and **maintain** the application effectively.

---

## Configuration

### 1. File Structure

The project should follow this structure:
```
project-root/

├── src/
├── index.php
├── login.php
├── logout.php
├── add_task.php
├── delete_task.php
├── complete_task.php
├── db.php
└── sql/
  ├──  create.sql
  └── test_data.sql

```

---

### 2. Database Setup

**Create the Database** (if not already done):

```
sudo mariadb -u root -p < src/sql/create.sql

```

Insert Test Data / Default Users:

```
sudo mariadb -u root -p todoApp < src/sql/test_data.sql

```

**Verify the database**:

Log in to MariaDB:

```
sudo mariadb -u root -p

```
Then check:

```
USE todoApp;

SHOW TABLES;

SELECT * FROM users;

```

### 3. Web Server Configuration

Ensure Apache web server is installed.

Set document root to the src/ or public_html/ folder.

PHP must be installed (php, php-mysql, etc.).

Restart the web server after deployment:

```
sudo systemctl restart apache2   # Or nginx/php-fpm depending on setup

```

### 4. Database Credentials

Check or update src/db.php:

```
$host = 'localhost';

$db   = 'todoApp';

$user = 'root'; // Replace with a less privileged user if needed

$pass = 'yourpassword';

$charset = 'utf8mb4';

```

## Maintenance

Regular Tasks

Monitor logs:

    Apache/PHP: /var/log/apache2/error.log

    MariaDB: /var/log/mysql/error.log

Backup database regularly:

```
mysqldump -u root -p todoApp > backup.sql

```

Clear old tasks if needed:

```
DELETE FROM tasks WHERE done = 1;

```

Update PHP/DB packages via apt:

```
sudo apt update && sudo apt upgrade

```

## Testing Changes

Test changes on a development Pi or virtual machine.

Use dummy users and tasks from test_data.sql.




## Deployment Checklist

- Database initialized

- Test users created

- Web server running

- db.php configured

- Firewall allows HTTP access (port 80/443)