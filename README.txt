Book Review Application

This is a simple Book Review Web Application built using Laravel.
It demonstrates basic but important concepts of Laravel such as Authentication, CRUD operations, Routing, Middleware, Blade templates, Validation, and File Uploads.

Features

1. User Authentication
User Registration
User Login
User Logout
Password update option
Profile update with image upload

Uses Laravel’s built-in authentication system.

2. Books Management (CRUD)
The application allows users to:

Add new books
Edit book details
Delete books
View all books in a list
Show individual book details

This uses:
Resource Controller
Eloquent Model
Migration
Blade templates

3. Reviews System
Each book can have multiple reviews.
Users can:

Add a review
Edit their review
Delete their review

This uses:
One-to-Many Relationship (Book → Review)
Validation
Flash messages

4. User Profile
Users can:
View their profile
Edit profile details
Upload/change their profile photo

Concepts included:
File upload
Public storage
Form handling

5. UI & Blade Templates

The interface uses:
Blade templating
Layout file (layouts.app)
Sidebar included using Blade include
Blade loops, conditions, and components

6. Routing

Project uses:
Web routes
Named routes
Resource routes (e.g., BookController, ReviewController)
Profile-specific routes (profile.show, profile.edit, profile.update)

7. Database

The application uses:
Migrations for table creation
Eloquent ORM for database interaction

Relationships:
Book has many Reviews
User has many Reviews

8. Basic Laravel Concepts Used

Controllers
Models
Migrations
Blade templating
Middleware
Authentication scaffolding
Validation
File upload (image)
Pagination
Flash messages
