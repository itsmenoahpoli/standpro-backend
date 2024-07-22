## Learning Management System

---

Installation Guide

```bash
git clone https://github.com/itsmenoahpoli/lms-web-backend.git

cd lms-web-backend

composer install

cp .env.example .env # Open .env then set the mysql database credentials

php artisan key:generate

npm install

# Open two terminal/command line with the project's directory
# then run these command on each

# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

---

<small>Modules:</small>

Admin
-Login
-Manage Users
-Upload 3D Virtual Activities
-Adds instruction on virtual lab activities
Instructor
-Login
-Manage students
-generate lectures and quizzes
-assess student performances
-Track student progress
Students
-Login
-Read and Answer Lecture Quizzes
-Complete Laboratories
-View their own progress

---
