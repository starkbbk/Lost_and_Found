# Deploying Lost and Found to Render

This guide outlines the steps to deploy the Lost and Found application to [Render](https://render.com).

## Prerequisites

1.  **GitHub Account**: This code must be pushed to a repository on your GitHub.
2.  **Render Account**: Sign up at [render.com](https://render.com).
3.  **MySQL Database**: Since Render's free tier doesn't include MySQL, we recommend [Aiven](https://aiven.io) (Free Tier).

---

## Step 1: Set up the Database

1.  Go to [Aiven Console](https://console.aiven.io/) and sign up.
2.  Create a new **MySQL** service (select the Free Plan).
3.  Once running, copy the **Service URI** or the individual details (Host, Port, User, Password).
4.  Use a tool like **DBeaver**, **HeidiSQL**, or **MySQL Workbench** to connect to your new Aiven database.
5.  Open the file `database/lfis_db.sql` from this project.
6.  Run the SQL script in your database tool to create the tables.

---

## Step 2: Deploy to Render

1.  Push your latest code to GitHub (including `render.yaml` and `Dockerfile`).
2.  Log in to the **Render Dashboard**.
3.  Click **New +** and select **Blueprint**.
4.  Connect your GitHub repository.
5.  Render will detect the `render.yaml` file.
6.  It will ask you to fill in the **Environment Variables**:
    *   `APP_URL`: The URL Render assigns you (e.g., `https://lost-and-found.onrender.com`). You can initially set this to `https://placeholder` and update it after the first deploy.
    *   `DB_HOST`: Your Aiven Hostname (e.g., `mysql-service-account.aivencloud.com`).
    *   `DB_USERNAME`: Your Aiven Username (usually `avnadmin`).
    *   `DB_PASSWORD`: Your Aiven Password.
    *   `DB_DATABASE`: The database name (usually `defaultdb` on Aiven).

7.  Click **Apply**. Render will build the Docker image and deploy your site.

---

## Troubleshooting

*   **Database Connection Error**: Double-check your `DB_HOST` and `DB_PASSWORD`. Ensure Aiven allows connections (it usually allows 0.0.0.0/0 by default on free tier, but check settings).
*   **Images Disappearing**: On the free tier, the file system is ephemeral. Images uploaded will disappear if the app restarts. To fix this, integrate an object storage service like Cloudinary or AWS S3 in the code.
