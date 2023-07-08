# Laravel API Task

This is a Laravel API project that implements various features and functionalities as outlined in the task requirements.

## Task Description

The task involves creating a Laravel API project with the following features:

1. Authentication using Sanctum
2. User registration and login endpoints
3. Tags API resource with CRUD operations
4. Posts API resource with CRUD operations, including soft deletion
5. Pinned posts appear first for every user
6. Scheduled job to force-delete softly-deleted posts older than 30 days
7. Scheduled job to make an HTTP request every six hours and log the response

## Requirements

- PHP 7.4 or higher
- Composer
- MySQL database

## Installation

1. Clone the repository:

```
git clone <[repository_url](https://github.com/Abdalllah-Saied/ATW_task)>
```

2. Install dependencies:

```
composer install
```

3. Create a copy of the `.env.example` file and rename it to `.env`. Update the database configuration in the `.env` file with your MySQL credentials.

4. Generate an application key:

```
php artisan key:generate
```

5. Run the database migrations:

```
php artisan migrate
```

6. (Optional) Seed the database with sample data:

```
php artisan db:seed
```

## Usage

1. Start the development server:

```
php artisan serve
```

2. The API is now accessible at `http://localhost:8000/api`.

## API Endpoints

- **Register User** (POST) - `/api/register`
- **Login User** (POST) - `/api/login`
- **Get User Data** (GET) - `/api/user`
- **Get All Tags** (GET) - `/api/tags`
- **Create Tag** (POST) - `/api/tags`
- **Get Single Tag** (GET) - `/api/tags/{id}`
- **Update Tag** (PUT/PATCH) - `/api/tags/{id}`
- **Delete Tag** (DELETE) - `/api/tags/{id}`
- **Get User Posts** (GET) - `/api/posts`
- **Create Post** (POST) - `/api/posts`
- **Get Single Post** (GET) - `/api/posts/{id}`
- **Update Post** (PUT/PATCH) - `/api/posts/{id}`
- **Soft Delete Post** (DELETE) - `/api/posts/{id}`
- **Get Deleted Posts** (GET) - `/api/posts/deleted`
- **Restore Deleted Post** (PATCH) - `/api/posts/{id}/restore`
- **Get Statistics** (GET) - `/api/stats`

Refer to the API documentation for detailed information on request formats and responses.

## Task Scheduling

The project includes two scheduled jobs:

- **DeleteSoftDeletedPostsJob**: This job runs daily and force-deletes all softly-deleted posts that are older than 30 days.

- **MakeHttpRequestJob**: This job runs every six hours and makes an HTTP request to `https://randomuser.me/api/`. It logs the response object.
