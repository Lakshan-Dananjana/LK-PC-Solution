# LK-PC Solution Web Application

![Project Screenshot](image/LK%20PC%20Solution.png)

## Table of Contents
1. [Description](#description)
2. [Features](#features)
3. [Screenshots](#screenshots)
4. [Installation](#installation)
5. [Usage](#usage)
6. [API Endpoints](#api-endpoints)
7. [Contribution Guidelines](#contribution-guidelines)
8. [License](#license)
9. [Author](#author)

## Description
LK-PC Solution is an advanced e-commerce platform for selling computer-related items. It offers a seamless shopping experience for users, along with robust admin controls for managing products and orders.

## Features
- User authentication (registration, login, password recovery)
- Product listing and categorization with search functionality
- Shopping cart and checkout system
- Secure payment integration (e.g., PayPal, Stripe)
- Admin dashboard for managing products and orders
- Order tracking and notifications
- Mobile-friendly responsive design

## Screenshots
_Add relevant screenshots of the application here._

## Installation

### Prerequisites
- PHP (>=7.4 recommended)
- MySQL Database
- Apache Server (XAMPP, WAMP, or LAMP recommended)

### Setup Guide
1. Clone or download this repository:
   ```sh
   git clone https://github.com/Lakshan-Dananjana/LK-PC-Solution.git
   cd LK-PC-Solution
   ```
2. Copy the project files to your web server's root directory.
3. Import the `project.sql` file into your MySQL database.
4. Configure database connection settings in `config.php`.
5. Start your server and access the application via `http://localhost/your-project-folder/`.

## Usage
- **User:** Sign up or log in to explore the store.
- Browse and search for products.
- Add items to the cart and proceed to checkout.
- Track past orders and order details.
- Admins can manage inventory, orders, and users.

## API Endpoints
### Product Endpoints
```http
GET    /api/products            # Retrieve all products
GET /product/{id}            Get details of a single product
POST /product                Add a new product
PUT /product/{id}            Update product details
DELETE /product/{id}         Remove a product
```

## Contribution Guidelines
- Fork the repository and create a new branch.
- Follow coding standards and best practices.
- Test your code before submitting a pull request.
- Provide detailed commit messages.

## License
This project is open-source and available under the [MIT License](LICENSE.md).

## Author
Developed by **Lakshan Dananjana**. If you have any questions or feedback, feel free to reach out.

