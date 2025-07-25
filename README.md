# Think Together

**Think Together** is a Community Knowledge Sharing Platform. It’s a user-friendly web application where anyone can share solutions to problems, innovative ideas, personal achievements, helpful tips, and more. The platform encourages interaction by allowing users to engage through comments, upvotes, and downvotes.

## Core Features

### User Registration and Authentication

- **Sign Up / Login:** Users can register, login, and manage their profiles.  
- **Roles and Permissions:** Basic roles like "User" and "Admin" for moderation.

### Post Creation and Management

- **Post Management:** Users can create, edit, and delete posts with optional links or code snippets.  
- **Post Categories:** Categorize posts with tags or categories.

### User Interaction

- **Upvote / Downvote:** Users can vote on posts.  
- **Comments:** Users can comment on posts for discussions and feedback.

### Search and Filter Options

- **Search Bar:** Search posts by tags.  
- **Filters:** Filter posts by categories or popularity.

### Profile Management

- **User Dashboard:** View your posts, comments, and reactions history.

## Development Approach

This project uses an **API-driven architecture**:

- Backend provides RESTful APIs for data handling.  
- Frontend consumes these APIs to present dynamic content.

## Tech Stack

- **Backend:** PHP / Laravel  
- **API Tools:** Laravel RESTful APIs, JWT-Auth (authentication), Postman (API testing)  
- **Database:** MySQL  
- **Version Control:** Git & GitHub

---

## Installation & Setup

```bash
# Clone the repository
git clone https://github.com/HadySafa/ThinkTogether-Backend.git
cd ThinkTogether-Backend

# Create a new MySQL database (e.g., think_together)

# Copy environment configuration file
cp .env.example .env

# Edit the .env file and update the database credentials
# DB_DATABASE=your_database_name
# DB_USERNAME=your_database_user
# DB_PASSWORD=your_database_password

# Install PHP dependencies
composer install

# Generate Laravel application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Generate JWT secret key
php artisan jwt:secret
