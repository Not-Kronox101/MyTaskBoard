# MyTaskBoard User Guide

Welcome to **MyTaskBoard**, a simple task management web app powered by PHP, MariaDB, and Raspberry Pi.

---

## Overview

MyTaskBoard allows you to:
- Log in securely
- Create tasks with descriptions
- View your task list
- Delete tasks when done
- Log out securely

---


## Logging In

1. Visit your Raspberry Pi’s IP address in a browser (e.g. `http://<your_pi_ip>`).
2. You’ll see a login screen.
3. Enter your **username** and **password**.

> Login information is stored in the `test_data.sql` file inside the `src/sql/` directory.  
> You can **view**, **change**, or **update** login credentials there before importing into the database.

![login_page](images/login.png)

---

## Main Features

### ➕ Add a Task

- After login, you’ll see a task input section.
- Enter a task description and submit it.
- The task will appear in the list below.

### View Tasks

- All your tasks are displayed below the input field in a simple list.

### Delete Tasks

- To delete a task, click the **Delete** button next to it.
- The task will be permanently removed from the database.

### Log Out

- Click the **red Logout** button at the bottom-right corner of the screen.
- This ends your session securely.

![main_page](images/tasks.png)
---
