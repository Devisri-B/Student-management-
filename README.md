# Student management

This project has PHP files that facilitate the management and querying of student data within a university directory. The project is intended to provide functionality for searching students by name, searching students by ID, and adding new students to the directory.

## Files
- stu-search-name.php: A PHP script for searching students by name within the database.
- Stu-search-id.php: A PHP script for searching students by ID within the database.
- newstudent.php (represented here as newstudent copy.php): A PHP script for adding new student entries, including the student's name, ID, department, and optionally, transfer credits.

## Usage
### Student Search by Name
Functionality: Allows users to search for students by entering a name (or partial name). The script returns matching student records in a table format, displaying the student ID, name, department, and total credits.

### Student Search by ID
Functionality: Enables users to search for a student using their ID. This script also returns relevant details such as student ID, name, department, and total credits.

### New Student Entry
Functionality: Provides a form for adding new students to the database. The user can input the student's name, ID, department, and optionally, total credits for transfer students.

## Database Requirements

The PHP scripts assume the following database structure for the student table:
```sql
CREATE TABLE student (
    id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(50),
    dept_name VARCHAR(50),
    tot_cred INT
);

CREATE TABLE department (
    dept_name VARCHAR(50) PRIMARY KEY
);
```
Make sure to update $servername, $username, $password, and $dbname variables in the PHP files with your database configuration.

## Contributing
Contributions are welcome. Please create a pull request or open an issue for suggestions or bug reports.
