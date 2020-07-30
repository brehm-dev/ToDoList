# ToDoList

This application is a reference for my work with Laravel in backend and Vue in frontend.

To get the application running you need docker-compose.
I have set up docker so that the server runs in a private network and can be reached at `http://10.17.70.50`.

You can change this to your liking.
Of course you still have to create an .env file and enter the database credentials, because Laravel needs that to work.

* * *
### admin account
To create an admin account, I wrote a Laravel command which you execute via `php artisan generate:admin <email> <password>` and then log in with your browser.
