# UOV INFO HUB

UOV INFO HUB is a web application that provides a platform for users to subscribe to different pages and view posts from those subscribed pages. The system has two user roles: regular users and super admins.

## Features

- **User Authentication:** Users need to log in to access the application. Super admins have a separate login portal.

- **News Feed:** Regular users can subscribe to various pages and view posts from those pages on the News Feed.

- **Subscription Management:** Users can manage their subscriptions by adding or removing pages.

- **Super Admin Dashboard:** Super admins have access to a dashboard where they can manage pages, add new pages, update existing page information, and delete pages.

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## Project Structure

- **assets/:** Contains images and other static assets.
- **style/:** Holds CSS files for styling.
- **script/:** PHP scripts for server-side functionality.
- **superAdmin/:** Super admin-specific pages and functionality.

## Setup

Follow the steps below to set up and run the UOV INFO HUB application:

### 1. Clone the Repository

```bash
git clone https://github.com/SGopinath89/CSC3132UoVinfoHub
```

### 2. Import the MySQL Database
- Create a new database named uovinfohubdb.
- Import the SQL file from database/uovinfohubdb.sql to set up the required tables.

### 3. Update Database Credentials
- Open the PHP files in the script/ directory and update the database connection credentials.

### 4. Host the Application
- Deploy the project on a web server or use a local server environment (e.g., XAMPP, WampServer).

### 5. Access the Application
- Open a web browser and navigate to the regular user login page: http://your-domain/login.php
- Super admins can access the login page at: http://your-domain/superAdmin-login.php
### 6. Usage
- Use the provided sample credentials for regular users or super admins.
- Explore the News Feed, manage subscriptions, and super admins can access the dashboard for page management.

## Contributors
 - **Ayesh MErenchige** - https://github.com/AyeshChanukaS

 