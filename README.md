# Think Together

**Think Together** is a Community Knowledge Sharing Platform. It’s a user-friendly web application where anyone can share solutions to problems, innovative ideas, personal achievements, helpful tips, and more. The platform encourages interaction by allowing users to engage through comments, upvotes, and downvotes.


## Core Features

### User Registration and Authentication

- **Sign Up/Login:** Allow users to register, login, and manage their profiles.  
- **Roles and Permissions:** Basic roles like "User" and "Admin" to help moderate the platform.

### Post Creation and Management

- **Post Management:** Users can Edit, Delete, and Submit new posts with an option to attach links or code snippets.  
- **Post Categories:** Enable users to categorize their posts under categories or tags.

### User Interaction

- **Upvote/Downvote:** Users can upvote or downvote posts.  
- **Comments:** Allow users to leave comments on posts for additional insights, questions, or discussions.

### Search and Filter Options

- **Search Bar:** Let users search posts by tags.  
- **Filters:** Filter posts by categories or popularity (e.g., most upvoted).

### Profile Management

- **User Dashboard:** A profile section where users can view their posts, comments, and reactions history.



## Development Approach

**This project uses an API-driven architecture**:

- The backend serves RESTful APIs, providing endpoints for data interaction.  
- The frontend communicates with the backend APIs to fetch, display, and manipulate data dynamically.

## Tech Stack

- **Backend:** PHP/Laravel  
- **API Tools:** Laravel RESTful APIs, JWT-Auth (for authentication), Postman (for testing)  
- **Database:** MySQL  
- **Version Control:** Git and GitHub

## Installation

- Clone the repository

```bash
git clone https://github.com/HadySafa/ThinkTogether-Backend.git
cd ThinkTogether-Backend
```

- Create a new MySQL database (e.g. think-together)

- Copy environment file

``` bash 
cp .env.example .env
```

- Edit the .env file to update your database credentials

``` bash
DB_DATABASE=<your_database_name>
```


- Install PHP dependencies
``` bash
composer install
```

-Generate Laravel application key

``` bash
php artisan key:generate```

- Run database migrations

``` bash
php artisan migrate
```


- Generate JWT secret key

``` bash
php artisan jwt:secret```


## Note

The frontend part of this project is in a separate repository. Make sure to [check it out here](https://github.com/HadySafa/ThinkTogether-Frontend) for the complete application.

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



