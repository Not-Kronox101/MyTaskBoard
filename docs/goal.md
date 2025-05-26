# Team: Sake

**Members:**
- 413855593 加藤大地  
- 410855281 安藤輝翔  
- 413855171 李婕亞  
- 413855114 耶律楚材  

---

## Project Title: MyTaskBoard

### High-Level Functionalities

1. **Task Creation**  
   Users can add new tasks to their to-do list. Each task will have a description.

2. **Task Listing**  
   Users can view a list of their current tasks.

3. **Task Completion**  
   Users can mark tasks as completed. Completed tasks might be displayed differently or moved to a separate section.

4. **Task Deletion**  
   Users can remove tasks from their list.

---

## Two Example Scenarios (User-System Interactions)

### Scenario 1: Adding a New Task

- **User:** Sarah, a student who wants to keep track of her assignments.  
- **Goal:** Add a new task to her to-do list: _"Finish the first draft of the history essay."_

**Interaction Flow:**
1. Sarah navigates to the main page of **MyTaskBoard** in her web browser.
2. She sees a form with a text input field and a button labeled **"Add Task"**.
3. She types `"Finish the first draft of the history essay"` into the text field and clicks the button.

**System Processing:**
- The browser sends an HTTP POST request to the Raspberry Pi server with the task description.
- **PHP Logic:**
  - Sanitize the input.
  - Prepare an SQL `INSERT` statement to add the task (with status `"pending"` and timestamp) to the **MariaDB** database.
  - Execute the SQL `INSERT`.
- **Database Operations:**
  - MariaDB inserts a new row into the `tasks` table with the provided details.
- **System Response:**
  - The PHP script generates and sends an updated task list back to Sarah’s browser.

**Technical Requirements:**
- **PHP Logic:** Handle form submission, sanitize input, run `INSERT` query, and update the HTML.
- **Database:** Insert a new task record into the `tasks` table.

---

### Scenario 2: Marking a Task as Complete

- **User:** David, a software developer using **MyTaskBoard** for his daily tasks.  
- **Goal:** Mark the task _"Implement user authentication"_ as complete.

**Interaction Flow:**
1. David is viewing his task list in the browser.
2. Next to _"Implement user authentication"_, there's a checkbox or a **"Complete"** button.
3. David clicks to mark the task as complete.

**System Processing:**
- The browser sends an HTTP GET or POST request to the server with the task’s unique ID.
- **PHP Logic:**
  - Retrieve the task ID from the request.
  - Prepare an SQL `UPDATE` statement to set the task status to `"completed"`.
  - Execute the SQL `UPDATE`.
- **Database Operations:**
  - MariaDB updates the corresponding task record.
- **System Response:**
  - The PHP script sends an updated view back to David’s browser, showing the task as completed or in a separate section.

**Technical Requirements:**
- **PHP Logic:** Handle button click, run `UPDATE` query, and refresh the view.
- **Database:** Update the status field of the task record.
