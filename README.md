# 🛍️ StyleLoop – Single Vendor E-Commerce Platform

A full-stack e-commerce application designed to handle end-to-end online shopping workflows, including product browsing, cart management, order processing, and centralized administrative control.

---

## 🚀 Overview

**StyleLoop** is a single-vendor e-commerce system where customers can seamlessly explore products, manage their cart, and place orders, while the admin manages the entire platform including inventory, categories, orders, and transactions.

The system is built with a focus on **clean architecture**, **efficient database design**, and **real-world deployment practices**.

---

## ✨ Features

### 👤 Customer

* Browse products by categories
* View detailed product information
* Add/remove items from cart
* Place orders and track order history
* Manage user profile

### 🛠️ Admin

* Dashboard for platform overview
* Manage products (Add, Update, Delete)
* Manage categories
* Manage customers
* Manage orders and delivery status
* Track transactions

---

## 🏗️ System Architecture

The application follows a structured **MVC architecture** using Laravel:

* **Frontend:** Blade templating (server-rendered UI)
* **Backend:** Laravel (business logic & request handling)
* **Database:** MySQL (relational schema)
* **ORM:** Eloquent ORM

### 🔄 Data Flow

Customer → Frontend → Backend → Database → Admin

### 💳 Payment Flow

Customer → Admin (Direct Payment Handling)

---

## ⚙️ Tech Stack

* **Backend:** Laravel
* **Frontend:** Blade
* **Database:** MySQL
* **ORM:** Eloquent
* **Server Environment:** cPanel-based hosting

---

## 🧠 Key Concepts Implemented

* MVC Architecture (Laravel)
* Relational Database Design
* Cart & Order Lifecycle Management
* Role-based System (Customer & Admin)
* Centralized Admin Control System
* Query Optimization for Product Filtering

---

## ⚡ Technical Highlights

* Designed normalized database schema for consistency
* Implemented structured order lifecycle system
* Optimized product listing and filtering queries
* Built reusable backend logic using Laravel controllers and models

---

## 🚀 Deployment

The application was deployed on a **cPanel-based hosting environment (InfinityFree)** with full manual configuration:

* Laravel application deployed manually
* MySQL database configured using phpMyAdmin
* Environment and server setup handled independently
* Integrated backend with hosting infrastructure

---

## 📂 Project Structure (Simplified)

```
app/
├── Models/
├── Http/
│   ├── Controllers/
│   └── Middleware/
resources/
├── views/ (Blade templates)
routes/
├── web.php
database/
├── migrations/
```
 

---

## 🎯 What This Project Demonstrates

* Ability to build a complete e-commerce system from scratch
* Strong understanding of backend architecture and workflows
* Experience with real-world deployment using shared hosting
* Efficient handling of database relationships and queries
 
---

## 👨‍💻 Author

Mukesh Kumar

Portfolio: https://mukeshkumar.vercel.app

---
 
