
# Basic CRUD site with Unit Tests

Built on Laravel 10 and PHP. Basic starter template. Contributors are welcome!

Here are some steps for getting started. Please note that these steps are with the assumption that you have a database server/service installed and running.

    1. Download and unzip the REPO
    2. Spin up your sql server and create a new database.
    3. Copy the .env.example to .env
    4. Enter your database details in the .env file
    5. Cd in to the unzipped folder. Alternatively, you can open a terminal in the folder.
    6. Run 'php artisan migrate'
    7. Run 'php artisan serve'
    8. Run 'php artisan test'
    9. You should now be able to access your site on 127.0.0.1:8000

!!!Important Note!!! Everytime you run the unit tests they WILL wipe your database. Please be very careful with this.

The Basic CRUD is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
