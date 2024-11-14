# AuctionSoftwareTest

working video: Demo 
https://drive.google.com/drive/folders/10Kpe9Pyt4B9p-AqcZdNVsMf07MIx-8BW?usp=sharing



Auction Software Project
This project is a simple web application built for managing a list of projects with user authentication, sorting, and pagination features. The primary goal is to display a list of projects, with options for sorting by recent projects, category name, username, and project title, while utilizing a SQL database to handle the backend data. The front-end interface has been styled for a clean, modern look, with separate login and main page styling.

Features
1. User Authentication: A login page allows users to authenticate before accessing the main project list.
2. Project List Display: Projects are displayed in a table format with sortable columns.
3. Sorting Options: Users can sort projects by recent addition, category name, username, or project title.
4. Pagination: Pagination is implemented with 2 projects per page using jQuery to load the data dynamically without page refresh.
5. Responsive Design: The design adapts for better readability and usability on different devices.
6. CSS Styling: Separate CSS files for login and main pages, with custom styles for buttons, tables, and background.


Technologies Used
HTML5/CSS3: For structuring and styling the frontend.
JavaScript/jQuery: For front-end interactivity, sorting, and pagination.
PHP: Backend scripting for server-side operations and database connection.
MySQL: Database for storing user and project information.
Git: Version control for tracking project changes.

Database Structure
Tables
ilance_users: Contains user information.
Fields: user_id, username, password, salt, etc.
ilance_projects: Contains project details.
Fields: project_id, user_id (foreign key from ilance_users), project_title, date_added, etc.
ilance_categories: Contains category details.
Fields: cid, category_name, etc.

Relationships
ilance_users to ilance_projects (one-to-many): Each user can have multiple projects.
ilance_projects to ilance_categories (many-to-one): Each project can belong to one category.

Detailed Feature Explanation
User Authentication (login.html, login.php, logout.php)
The login.html page allows users to enter their username and password.
login.php handles authentication by verifying the credentials from the ilance_users table.
Passwords are stored using a salted MD5 hash, and login.php validates by rehashing the entered password with the stored salt.
logout.php clears the session and redirects users to the login page.
Project List with Sorting and Pagination (index.php, fetch_projects2.php)
index.php is the main page where logged-in users can view projects.
A select dropdown menu allows users to choose a sorting criterion (Recent, Category Name, Username, Project Title).
fetch_projects2.php fetches the sorted and paginated results based on the selected sort option and current page.

Sorting options are:
Recent Projects: Sorted by date_added (most recent first).
Order By Category Name ASC: Sorted by category name alphabetically.
Order By Username ASC: Sorted by the username alphabetically.
Order By Project Title ASC: Sorted by project title alphabetically.

Pagination is handled with a LIMIT of 2 rows per page, using AJAX to load new pages dynamically.
AJAX Sorting and Pagination (JavaScript/jQuery in index.php)
AJAX requests to fetch_projects2.php fetch the required data without refreshing the page.

The page updates the displayed projects based on the selected sorting option and page navigation.

The "Next" and "Previous" buttons allow for easy navigation between pages.

CSS Styling (style.css for login, index.css for main page)
style.css: Styles the login page, with a centered login card, a blurred background, and styled input fields and buttons.
index.css: Styles the main page with a table layout for displaying projects, a styled dropdown, and pagination buttons.

Background images and colors are adjusted for a professional look, with spacing and borders for a clean UI.


