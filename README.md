# Description

This is a Simple To-do list Application
The basic functionality is to ADD, UPDATE, DELETE, SETCOMPLETED an Item From The list.
For a user to see/manage his list, he has to be logged in the system.

# Installation

This APP was created with Yii Framework version 1.1.12
In Order to Install it on your Server
 - Create a database using the todo.sql in /protected/data
 - Edit /protected/config/main.php to set username/password for the db user
 - Download and extract yii framework in your web directory
 - Edit index.php to set Yii Framework's path

# Files I Created
- protected/components/UserIdentity.php
- protected/components/globals/globals.php
- controllers/SiteController.php
- models/ListItems.php
- models/Members.php
- views/items/_form.php
- views/items/_view.php
- views/items/create.php
- views/items/index.php
- views/items/update.php
