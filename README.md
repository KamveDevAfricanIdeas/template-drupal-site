# Drupal with XAMPP (Windows) 📑

This guide explains how to set up **Drupal** on **XAMPP** for Windows, move the project to `htdocs`, access the site, and troubleshoot common issues with PHP version and MariaDB version.

## Prerequisites
- **XAMPP** installed on your Windows machine.
- **Composer** installed globally for managing Drupal dependencies.

## Step 1: Create a New Drupal Site with Composer
1. Open a **command prompt** or **PowerShell**.
2. Navigate to your desired directory for the Drupal project, for example:
```
   cd C:\xampp\htdocs
```
3. Create a new project
```
   composer create-project drupal/recommended-project african_ideas_site
```
7. Navigate to the project: `cd african_ideas_site`

## Step 2: Move this project to xampp/htdocs
- We can run the site at `http://localhost/african_ideas_site`

## Step 3: Access Drupal Site and Configure
- We can now make changes and configure database settings to complete installation.
- Follow the installation guide

# Troubleshooting
- Issues I've run into include (1) incompatibility with PHP and MySQL versions for XAMPP (2) Composer configurations
## PHP Issue
- The error reads: `Your Composer dependencies require a PHP version '>= 8.3.0'. You are running 8.2.12.`
1. Download the latest version of PHP
2. Replace the php foler in `C:/xampp/php`, you can back it up first by renaming to `C:\xampp\php_old`
3. Edit the `xampp/apache/conf/httpd-xampp.conf` so it points to the updated PHP

## MariaDB Issue
- The error reads: `The database server version 10.4.32-MariaDB is less than the minimum required version 10.6.`
1. Download the latest MariaDB version (zip file, not installer)
2. Replace the `C:\xampp\mysql` folder and backup the old one.
3. Copy the `my.ini` file from the old `\mysql` folder to the new one `C:\xampp\bin\my.ini`
4. Copy the `data` folder to the new `mysql` folder
5. If the service crashes in XAMPP, then delete the following files
``` ib_logfile0, ib_logfile1, ib_logfile2, ibdata1``` from `C:\xampp\mysql\data`
