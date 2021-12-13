# A Microservice (API Service) using Lumen (Latest version) and MySQL. Preference: use Repository Design Pattern

# Step to configure

    1. First clone this repository
    2. Start MySQL server & Create a MySQL database name "test"
    3. Create .env file to root directory and copy all from .env.example to .env
    4. Open terminal to this project directory
    5. Run some commands

# Commands

    composer install

    php artisan key:generate

    php artisan jwt:secret

    php artisan migrate

# Start Application by runing this command
    
    php artisan serve

# Background job
Please open another terminal to this directory and run
    
    php artisan queue:work


# Use Postman to test this application
You will get a file in this root directory named (JobPreparetion.postman_collection.json) import this file to postman and check APIs

    1. User login
    2. User registration
    3. User logout
    4. Import json data (MCQ questions)
    4. Get all MCQ question
    5. Get single MCQ question
    6. Delete a MCQ question and more.
