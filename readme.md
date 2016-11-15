# Dynamic Web Applications - P4

The fourth project for Dynamic Web Applications, a Fall 2016 course at the Harvard Extension School.

TaskMaster is a web application for managing projects and tracking tasks associated with those projects. The basic functionality of the application is to create teams of users, create projects with team members, create tasks associated with projects, and assign users on a team to those tasks.

## Using This Project

This project uses Composer for dependency management. PHP and Composer must be installed to use the project. When setting up the project for the first time, run the following commands:

```sh
composer install
php artisan migrate
```

The files in `public` should be served publicly using a PHP server.

## Test Data

The database can also be seeded with test data. The test data will consist of 5 test users, each with their own projects and as members of others' projects. Each project will be populated with dummy tasks that may or may not be assigned to team members. To do this, use the following command:

```sh
php artisan db:seed
```

The logins for each test user are as follows:

| Name | Email | Password |
| --- | --- | --- |
| Test User 1 | test1@test.com | test |
| Test User 2 | test2@test.com | test |
| Test User 3 | test3@test.com | test |
| Test User 4 | test4@test.com | test |
| Test User 5 | test5@test.com | test |

## Credit

The project uses the **Laravel** framework. It also uses **Faker** (included with Laravel) for generating lorem ipsum for the test data.

**FontAwesome** is used for all of the icons in the application's user interface.

## Links

Live URL: [http://p4.kylepixel.com/](http://p4.kylepixel.com/)

Screencast URL: [https://youtu.be/<id>](https://youtu.be/<id>)
