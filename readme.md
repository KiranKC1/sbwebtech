## POST CRUD WITH ACL AND HISTORY LOG

This project is a simple demonstration of how permission and roles can be generated using Laravel. This alos includes CRUD operation of posts alonsgside maintaining history log of each and every user on that particular module.

## Setting Up the project

After downloading the project and setting up the environment variables just run :

php artisan migrate

that should setup the migration files and then run

php artisan db:seed

This will fill up the database with dummy data. After that use any of the following usernames and password to login to system as User, Editor or an Admin.

To login as Admin enter these credentials
email : kiran@admin.com
password : 123456

To login as User enter these credentials
email : kiran@user.com
password : 123456

To login as Editor enter these credentials
email : kiran@editor.com
password : 123456



