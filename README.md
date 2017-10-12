# Yii 1.x work
**This work is** interface to manage Users and Companies and view a Report (TransferLogs)

## Work used

 - PHP `7.1` version
 - MySQL `5.7` version
 - Faker `for random data generated`
 - Bootstrap 3 `for UI`
 - JQuery `3.2.1` version
 - Blendid `4.3` for minify my .css and .js file (write at ES6)

## Install STEP 1

```
$ composer update

After install you must create database name - `yii`

```
## Warning
```
If used Linux/MacOS need change mode for directories

chmod -R 755 /web/assets
chmod -R 777 /runtime

```

## Install STEP 2

```
upload _SQL/yii.sql file
```

### Directory Structure

```
components          contains Widgets and Helper
    views/          contains Views file to Widgets
config              contains configurations files
controllers         contains controllers 
                        ** MainController - it's my Base Controller
                        ** ApiController  - controller for update and create data in database
                        ** SiteController - cosist two methods Index page and Error page
html                directory for Yarn
    config/               configurations files for Yarn and Blendid
    node_modules/         (ignored)
    public/               contains compiled .js and .css files 
    src/                  contains my original .js and .scss files
        javascript/       **in file index.js writen all javascript (define JQuery, Toastr noty etc.)**
        stylesheets/      includes scss files for Toastr, Bootsrap etc.
migrations          contains migrations file for database table
models              contains models file for database and work with CActiveRecords
runtime             log (ignored)
vendor              vendor folder contains (Yii 1.x and Faker)
views               Views file for Controllers
web                 the entry script and Web resources
```

## About

Work contains Index page where you must see 3 tabs: Users, Companies, Abusers.

Tabs Users and Companies has differents buttons Add/Edit/Delete. Add/Edit call to form in modal window,
Delete drop current item from database and page

All function contains in html/src/javascript/index.js and **compiled/minify** to web/js/app.js