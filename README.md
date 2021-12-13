# A Microservice (API Service) using Lumen (Latest version) and MySQL. Preference: use Repository Design Pattern

# Step to configure

    1. First clone this repository
    2. Start MySQL server & Create a MySQL database name "test"
    3. Create .env file to root directory and copy all from .env.example to .env
    4. Open terminal to this project directory
    5. Run some commands

# Commands
    1. composer install
    2. php artisan key:generate
    3. php artisan jwt:secret
    4. php artisan migrate

# Start Application by runing this command
    
    php artisan serve

# Background job
Please open another terminal to this directory and run
    
    php artisan queue:work
