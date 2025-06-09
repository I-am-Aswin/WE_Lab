# 📄 E-Commerce Web Application – Final Report

## 📘 Abstract

The **E-Commerce Web Application** is a full-stack solution that simulates the core functionalities of an online shopping platform. It enables users to browse products, add them to a cart, place orders, and simulate payment transactions. The system is divided into two major components: a **Java-based backend RESTful API** and a **ReactJS-based frontend interface**, which communicate via well-defined endpoints.

### 🔍 Key Features
- **User Authentication**: Secure registration and login using JWT tokens.
- **Product Management**: View all products and fetch details of individual items.
- **Shopping Cart**: Add, view, and manage selected items before checkout.
- **Order Placement**: Convert cart items into an order with calculated total price.
- **Mock Payment Gateway**: Simulate successful or failed payments.
- **CORS Handling**: Ensures secure communication between frontend and backend.
- **Database Persistence**: PostgreSQL used for storing user, product, cart, and order data.

### 💡 Technology Stack

// table

### 🧱 System Overview

The application follows a **client-server architecture**, where:
- The **backend** exposes RESTful APIs that handle business logic, database operations, and authentication.
- The **frontend** consumes these APIs, provides a UI for users, and manages state locally (e.g., cart contents).
- Communication is secured using **JWT tokens**, ensuring only authenticated users can access protected routes.

Each part of the application was designed to be modular and scalable, allowing for easy extension in the future — such as integrating real payment gateways, adding admin dashboards, or enhancing security with HTTPS and CSRF protection.

---

## ⚙️ Backend Architecture & Endpoints

### 🧠 Backend Overview

The backend is implemented using **Java Servlets**, **Hibernate ORM**, and **PostgreSQL**, following a layered architecture pattern:

This structure promotes separation of concerns and makes the codebase easier to maintain and extend.

---

### 🛠️ Core Components

#### 1. **Hibernate ORM**
Used for mapping Java objects to database tables. Each entity class corresponds to a table in PostgreSQL:
- `User`, `Product`, `Cart`, `Order`, `OrderItem`

#### 2. **DAO Pattern**
Data Access Objects encapsulate all database interactions:
- `UserDAO`, `ProductDAO`, `CartDAO`, `OrderDAO`, `OrderItemDAO`

#### 3. **Servlet Controllers**
Handle incoming HTTP requests:
- `RegisterServlet`, `LoginServlet`, `ProductServlet`, `CartServlet`, `CheckoutServlet`, `OrderServlet`, `PaymentServlet`

#### 4. **Security**
- **JWT Token Generation & Validation**: Handled by `JwtUtil`.
- **Authentication Filter**: CORS filter allows trusted origins to access APIs securely.

#### 5. **Error Handling**
Custom error responses are returned for invalid inputs, unauthorized access, and internal server errors.

---

## 🚀 RESTful Endpoints

Below is a detailed list of all available endpoints, along with their methods and purposes:

// table

> ✅ All protected routes require a valid JWT token in the request header:
```
Authorization: Bearer <your_jwt_token>
```


### Primary Code Snippet


## Sample Servlet
```

@WebServlet("/products/*")
public class ProductServlet extends HttpServlet {
    private ProductDAO productDAO = new ProductDAO();
    private ObjectMapper mapper = new ObjectMapper();

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException {
        String pathInfo = request.getPathInfo();

        if (pathInfo == null || pathInfo.equals("/")) {
            List<Product> products = productDAO.getAllProducts();
            response.setContentType("application/json");
            response.getWriter().write(mapper.writeValueAsString(products));
        } else {
            Long id = Long.parseLong(pathInfo.substring(1)); // Remove leading '/'
            Product product = productDAO.getProductById(id);
            if (product != null) {
                response.setContentType("application/json");
                response.getWriter().write(mapper.writeValueAsString(product));
            } else {
                response.setStatus(HttpServletResponse.SC_NOT_FOUND);
                response.getWriter().write("{\"error\": \"Product not found\"}");
            }
        }
    }
}
```

## Sample Hibernate Connection

```
public class HibernateUtil {
    @Getter
    private static final SessionFactory sessionFactory = buildSessionFactory();

    private static SessionFactory buildSessionFactory() {
        StandardServiceRegistry registry = new StandardServiceRegistryBuilder()
                .configure()
                .build();
        try {
            return new MetadataSources(registry).buildMetadata().buildSessionFactory();
        } catch (Exception ex) {
            StandardServiceRegistryBuilder.destroy(registry);
            throw new ExceptionInInitializerError(ex);
        }
    }

}
```



## **Frontend:**

### **Technology Stack Used:**


//table

---

### **Architecture Overview:**

#### Key Design Decisions:
- **Component-Based Architecture**: Promotes reusability and separation of concerns.
- **State Management**: Local state used within components; global auth state managed via localStorage.
- **API Integration**: Centralized API client (`apiClient.js`) handles all communication with the backend.
- **Protected Routes**: Authenticated users are determined using `localStorage.getItem('token')`.
- **Responsive Design**: DaisyUI and Tailwind classes ensure the UI works across devices.

---

## **Pages and Features Created:**

### 1. **Home Page**
- **Purpose:** Landing page for unauthenticated users.
- **Features:**
  - Hero section with welcoming message.
  - Call-to-action button to browse products.
- **Design Elements:**
  - Full-screen hero with centered text.
  - DaisyUI buttons for interaction.

---

### 2. **Register Page**
- **Purpose:** Allow new users to register.
- **Features:**
  - Input fields for username, email, password.
  - Form validation.
  - Redirects to login on success.
- **Backend Endpoint Used:** `POST /register`
- **Error Handling:**
  - Displays alert if username/email already exists or input is invalid.

---

### 3. **Login Page**
- **Purpose:** Authenticate existing users.
- **Features:**
  - Username/password input fields.
  - Stores JWT token upon successful login.
  - Redirects to home after login.
- **Backend Endpoint Used:** `POST /login`
- **Security:**
  - Token stored securely in localStorage.
  - Protected routes only accessible when token is present.

---

### 4. **Products Page**
- **Purpose:** Display all available products.
- **Features:**
  - Grid layout showing multiple products.
  - Product cards with name, image, price, and view details button.
- **Backend Endpoint Used:** `GET /products`
- **UX Enhancements:**
  - Responsive grid layout using Tailwind's `grid-cols` classes.
  - Hover effects and DaisyUI card styling.

---

### 5. **Product Detail Page**
- **Purpose:** Show detailed information about a specific product.
- **Features:**
  - Product name, description, price, and quantity selector.
  - Add to cart button.
- **Backend Endpoint Used:** `GET /products/{id}`
- **User Interaction:**
  - Users can select quantity before adding to cart.
  - Uses `POST /cart` endpoint to add item.

---

### 6. **Cart Page**
- **Purpose:** Allow users to manage items in their cart.
- **Features:**
  - List of added products with quantity controls.
  - Update quantity or remove items.
  - Auto-calculated total price.
  - Proceed to checkout button.
- **Backend Endpoints Used:**
  - `GET /cart`: To fetch current cart items.
  - `POST /cart`: To update quantities.
  - `DELETE /cart/{productId}`: To remove an item.
- **UX Improvements:**
  - Clean list layout with inline actions.
  - Total price summary at bottom.

---

### 7. **Checkout Page**
- **Purpose:** Confirm order placement.
- **Features:**
  - Triggers order creation.
  - Displays generated order ID.
- **Backend Endpoint Used:** `POST /checkout`
- **Post-checkout Flow:**
  - Redirects to payment page after order is placed.

---

### 8. **Orders Page**
- **Purpose:** Display past orders for logged-in user.
- **Features:**
  - List of orders with order ID, date, and total amount.
- **Backend Endpoint Used:** `GET /orders`
- **Data Display:**
  - Orders listed in chronological order.
  - Simple yet informative list cards.

---


### Primary Code Snippet

```
function App() {
  return (
    <Router>
      <Header />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/products" element={<Products />} />
        <Route path="/products/:id" element={<ProductDetail />} />
        <Route path="/cart" element={<Cart />} />
        <Route path="/checkout" element={<Checkout />} />
        <Route path="/orders" element={<Orders />} />
        <Route path="/register" element={<Register />} />
        <Route path="/login" element={<Login />} />
      </Routes>
    </Router>
  );
}
```
