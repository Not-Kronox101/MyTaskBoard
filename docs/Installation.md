Deploying *MyTaskBoard* on Raspberry Pi
============================================================

This guide explains how to set up and run the **MyTaskBoard** PHP + MariaDB web app on a Raspberry Pi running Raspberry Pi OS (or DietPi/Debian-based OS).

* * * * *

🛠️ Requirements
----------------

-   Raspberry Pi (any model with internet access)

-   Raspberry Pi OS (Lite or Desktop) or DietPi

-   Internet connection

-   A computer with SSH or physical access to the Pi

* * * * *

🧹 1. Install Dependencies
--------------------------

SSH into your Pi (or open Terminal directly), then run:

```
sudo apt update
sudo apt install apache2 mariadb-server php php-mysql 

```

Enable the web server and database on boot:

```
sudo systemctl enable apache2
sudo systemctl enable mariadb

```

Start them now:

```
sudo systemctl start apache2
sudo systemctl start mariadb

```

* * * * *

🛡️ 2. Set Up the Database
--------------------------

Login to MariaDB:

```
sudo mariadb

```

Then inside the MariaDB prompt:

```
CREATE DATABASE todoApp CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE USER 'root'@'localhost' IDENTIFIED BY 'fo39ajf3';
GRANT ALL PRIVILEGES ON todoApp.* TO 'root'@'localhost';
FLUSH PRIVILEGES;
EXIT;

```

> ⚠️ If `root@localhost` already exists, just run:
>
> ```
> ALTER USER 'root'@'localhost' IDENTIFIED BY 'fo39ajf3';
> FLUSH PRIVILEGES;
>
> ```

* * * * *

📂 3. Deploy the Project
------------------------
Clone the github repository:

```
git clone https://github.com/Not-Kronox101/MyTaskBoard

```

Move src directory into the web root:

```
mv MyTaskBoard/src/* /var/www/html

```

Remove the cloned repository:

```
rm -rf MyTaskBoard

```


* * * * *

📁 4. Import the Database Schema
--------------------------------

In the src/sql there is a database schema:

```
sudo mariadb -u root -p todoApp < /var/www/html/sql/create.sql

```

> Enter your password: `fo39ajf3`

* * * * *

🚀 5. Access Your App
---------------------

-   Find your Pi's IP: `hostname -I`

-   Open browser on any device in same network:

    ```
    http://<your-pi-ip>/

    ```

* * * * *

🔄 After Reboot
---------------

On each reboot, the web server and database auto-start. No need to re-import or reconfigure anything.

* * * * *

📌 Troubleshooting
------------------

-   **Connection failed** (SQL error): Check `db.php` has correct username/password.

-   **Forbidden or blank page**: Make sure files are in `/var/www/html/` and readable.

-   **SQL errors**: Double-check if the database and tables were created properly.