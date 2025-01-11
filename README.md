# Drupal with XAMPP (Windows) 📑

This guide explains how to set up **Drupal** on **XAMPP** for Windows, move the project to `htdocs`, access the site, and troubleshoot common issues with PHP version and MariaDB version.

## Prerequisites
✔️ **XAMPP** installed on your Windows machine.
✔️ **Composer** installed globally for managing Drupal dependencies.

## Step 1: Create a New Drupal Site with Composer
- [ ] Open a **command prompt** or **PowerShell**.
- [ ] Navigate to your desired directory for the Drupal project, for example:
```
   cd C:\xampp\htdocs
```
- [ ] Create a new project
```
   composer create-project drupal/recommended-project african_ideas_site
```
- [ ] Navigate to the project: `cd african_ideas_site`

## Step 2: Move this project to xampp/htdocs and Access Drupal Site
> We can run the site at `http://localhost/african_ideas_site/web`
> This allows us to access the interactive installer

# Troubleshooting
> Issues I've run into include (1) incompatibility with PHP and MySQL versions for XAMPP (2) Composer configurations
## PHP Issue
> The error reads: `Your Composer dependencies require a PHP version '>= 8.3.0'. You are running 8.2.12.`
- [ ] Download the latest version of PHP
- [ ] Replace the php foler in `C:/xampp/php`, you can back it up first by renaming to `C:\xampp\php_old`
- [ ] Edit the `xampp/apache/conf/httpd-xampp.conf` so it points to the updated PHP

## MariaDB Issue
> The error reads: `The database server version 10.4.32-MariaDB is less than the minimum required version 10.6.`
- [ ] Download the latest MariaDB version (zip file, not installer)
- [ ] Replace the `C:\xampp\mysql` folder and backup the old one.
- [ ] Copy the `my.ini` file from the old `\mysql` folder to the new one `C:\xampp\bin\my.ini`
- [ ] Copy the `data` folder to the new `mysql` folder
- [ ] If the service crashes in XAMPP, then delete the following files
``` ib_logfile0, ib_logfile1, ib_logfile2, ibdata1``` from `C:\xampp\mysql\data`

# Create a Subtheme: Barrio and Bootstrap 5+
> Let's take a look at how to create a subtheme and leverage bootstrap for custom styles, components, etc.
- [ ] In the project file open a windows terminal and run: composer require drupal/bootstrap_barrio
- [ ] Create a folder 'custom' in path /web/themes/custom
- [ ] Open gitbash and run the commands:
```
export CUSTOM_BARRIO=custom_subtheme_name
cp -r ../contrib/bootstrap_barrio/subtheme $CUSTOM_BARRIO
cd $CUSTOM_BARRIO or run cd custom_subtheme_name
```
> Then run code to rename specific files
```
cd themes/custom
export CUSTOM_BARRIO=custom_barrio # change this to your custom theme_name
cp -r ../contrib/bootstrap_barrio/subtheme $CUSTOM_BARRIO
cd $CUSTOM_BARRIO
for file in *bootstrap_barrio_subtheme.*; do mv $file ${file//bootstrap_barrio_subtheme/$CUSTOM_BARRIO}; done
for file in config/*/*bootstrap_barrio_subtheme.*; do mv $file ${file//bootstrap_barrio_subtheme/$CUSTOM_BARRIO}; done
mv {_,}$CUSTOM_BARRIO.theme
mv {_,}$CUSTOM_BARRIO.layouts.yml
grep -Rl bootstrap_barrio_subtheme .|xargs sed -i '' -e "s/bootstrap_barrio_subtheme/$CUSTOM_BARRIO/"
```
- [ ] Now ensure all files have the prefix `custom_subtheme_name`
- [ ] In the `.info.yml` file ensure compatibility by changing `core: ...` to
```
#core:...
core_version_requirement: ^10 || ^11 //or the latest compatible versions.
```
- [ ] In the `.theme` file makes changes to the prefixes:
```
function custom_subtheme_name_form_system_theme_settings_alter(&$form, FormStateInterface $form_state) {
   $form['components']['navbar']['custom_subtheme_name_navbar_top_background']['#options'] = [
   .....
   $form['components']['navbar']['custom_subtheme_name_navbar_background']['#options'] = [
}

```
