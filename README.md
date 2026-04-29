# 🚗 Car Rental Booking System

A full-featured Car Rental Booking System built with **Laravel 12**, **Laravel Breeze**, and **Tailwind CSS**.

This system allows users to book cars and admins to manage bookings, cars, and users through a secure admin panel.
## ➡️ [LIVE DEMO](https://independent-cyan-giraffe.148-163-121-30.cpanel.site)
---
##### ADMINS
- superadmin@gmail.com || superadmin
- admin@gmail.com || superadmin

##### USERS
- daren@yahoo.com || testuser
- marc@yahoo.com || testuser
- david@yahoo.com || testuser
---

## 📌 Features

### 👤 User Features
- User registration & login (Laravel Breeze)
- Book a car with start & end date
- View all personal bookings in dashboard
- Booking status tracking:
  - Pending
  - Approved
  - Rejected
  - Cancelled
- Cancel booking (only if pending)
- Booking summary statistics
- Prevent double booking (date conflict validation)

---

### 👑 Admin Features
- Secure admin login
- Role-based access (`is_admin = 1`)
- Admin dashboard with:
  - Total bookings
  - Pending bookings
  - Approved bookings
  - Total users
  - Total cars
- View all bookings
- Approve booking
- Reject booking
- View all users
- View and manage cars

---

## 🧠 System Flow

### 🔹 Booking Process
1. User selects car
2. User submits booking
3. Booking status = `pending`
4. Admin reviews request
5. Admin approves or rejects
6. User sees updated status in dashboard

---

### 🔹 Double Booking Prevention

The system prevents overlapping bookings by checking:

- Existing approved bookings for the same car
- Overlapping date ranges
- Conflict validation before saving

---

## 🛠 Tech Stack

- PHP 8.2+
- Laravel 12
- Laravel Breeze (Authentication)
- Tailwind CSS
- MySQL
- Vite

---

## 🗂 Project Structure
```
app/
├── Http/
│ ├── Controllers/
│ │ ├── BookingController.php
│ │ ├── AdminController.php
│ │ ├── AdminBookingController.php
│ │ └── UserDashboardController.php
│ └── Middleware/
│ └── AdminMiddleware.php
├── Models/
│ ├── User.php
│ ├── Car.php
│ └── Booking.php

resources/views/
├── admin/
├── mainlayouts/
├── dashboard.blade.php
```
##📊 Dashboard Overview
- User Dashboard
- View bookings
- Cancel pending booking
- Booking statistics
- Admin Dashboard
- Manage all bookings
- Approve / Reject requests
- View system statistics
  
##🚀 Future Improvements
- Email notifications
- Booking calendar view
- Real-time notifications
- Payment integration
- Car availability calendar
- Advanced search & filtering
- API version
