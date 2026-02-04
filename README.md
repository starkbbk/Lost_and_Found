# Lost and Found

The **Lost and Found** system is a web-based application designed to help manage and recover lost items. It consists of two main modules: a Public facing site for users to view and report items, and a Management site for administrators.

## Features

### Management (Admin Side)
- **Dashboard**: Overview of system status.
- **Category Management**: Create, update, and delete item categories.
- **Item Management**: Manage lost and found items.
- **User Management**: Manage system users (Admins/Staff).
- **Inquiries**: View and manage messages from the public.
- **System Settings**: Update site information, logo, and content.

### Public Site
- **Home Page**: Welcome page with latest information.
- **Lost and Found List**: Browse and search for reported items.
- **Report/Post Item**: Users can submit items they have found.
- **Contact Us**: Send inquiries to the administration.

## Installation and Setup

### Prerequisites
- PHP >= 7.0
- MySQL Database
- Web Server (Apache/Nginx or PHP built-in server)

### Setup Steps

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/starkbbk/Lost_and_Found.git
    cd Lost_and_Found
    ```

2.  **Database Configuration**
    - Create a new MySQL database named `lfis_db`.
    - Import the provided SQL file: `database/lfis_db.sql` into your new database.

3.  **Application Configuration**
    - Open `initialize.php` and verify the database credentials and `base_url`.
    - By default, it is configured for `root` user with no password and `http://localhost:8080/`.
    ```php
    if(!defined('base_url')) define('base_url','http://localhost:8080/');
    if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
    if(!defined('DB_USERNAME')) define('DB_USERNAME',"root");
    if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"");
    if(!defined('DB_NAME')) define('DB_NAME',"lfis_db");
    ```

4.  **Running the Application**

    **Option A: Using PHP Built-in Server**
    ```bash
    php -S localhost:8080
    ```
    Access the site at [http://localhost:8080](http://localhost:8080).

    **Option B: Using XAMPP/WAMP**
    - Copy the project folder to your `htdocs` or `www` directory.
    - Update `base_url` in `initialize.php` to match your local path (e.g., `http://localhost/Lost_and_Found/`).
    - Access via your browser.

## Credentials
- **Admin Login**: Access at `/admin`
- Default Admin credentials (if using sample data):
    - Username: `admin`
    - Password: `admin123` (or check database for default users)
