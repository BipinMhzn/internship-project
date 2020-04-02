# Final Year Internship Project
## Dependencies
Make sure you have installed:
- Node
- Composer

## Steps
### 1. Clone the project
```
git clone git@github.com:BipinMhzn/internship-project.git
```

### 2. Install node modules for Frontend
``` 
npm install 
```

### 3. Install dependencies for Backend
``` 
composer install
```

### 4. Create database in MySQL
For example: **wyeshr**

### 5. Changes in .env file
Copy *.env.example* file and create *.env* file.
```
APP_KEY= {php artisan key:generate}

DB_DATABASE=db_name
DB_USERNAME=db_username
DB_PASSWORD=db_password

MAIL_USERNAME=mail_username
MAIL_PASSWORD=mail_password
```

### 6. Migrate database
``` 
php artisan migrate
```

### 7. Insert fake data
```
php artisan db:seed
```

### 8. Run the project
```
php artisan serve
```

## Documentation
[Final Internship Project Report](https://drive.google.com/file/d/1ZudBVoszvRyBIjzQjwxPCjmumh_1562i/view?usp=sharing)
