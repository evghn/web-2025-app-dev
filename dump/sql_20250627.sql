SET TIME ZONE '+00:00';

--
-- Database: shop_db
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE orders (
  order_id SERIAL PRIMARY KEY,
  user_id INTEGER,
  order_date TIMESTAMP NOT NULL,
  total_amount DECIMAL(10,2) NOT NULL
);

--
-- Data for table `orders`
--

INSERT INTO orders (order_id, user_id, order_date, total_amount) VALUES
(1, 1, '2025-02-17 02:33:06', 1499.98),
(2, 2, '2025-02-17 02:33:06', 299.99),
(3, 1, '2025-02-17 02:33:06', 589.98),
(4, 1, '2023-10-01 10:30:00', 55.00),
(5, 2, '2023-10-02 12:45:00', 30.00),
(6, 1, '2023-10-03 09:00:00', 70.00),
(7, 3, '2023-10-04 14:30:00', 25.00),
(8, 1, '2023-10-01 10:30:00', 55.00),
(9, 5, '2023-10-02 12:45:00', 500030.00),
(10, 6, '2023-10-03 09:00:00', 70.00),
(11, 7, '2023-10-04 14:30:00', 25.00);

-- Reset the sequence after manual inserts
SELECT setval('orders_order_id_seq', (SELECT MAX(order_id) FROM orders));

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE order_items (
  order_item_id SERIAL PRIMARY KEY,
  order_id INTEGER,
  product_id INTEGER,
  quantity INTEGER NOT NULL
);

--
-- Data for table `order_items`
--

INSERT INTO order_items (order_item_id, order_id, product_id, quantity) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 2, 3, 1),
(4, 3, 2, 1),
(5, 3, 4, 1),
(6, 1, 1, 2),
(7, 1, 2, 1),
(8, 2, 3, 1),
(9, 3, 1, 1),
(10, 3, 2, 1),
(11, 3, 5, 5),
(12, 4, 4, 1),
(13, 1, 1, 2),
(14, 1, 2, 1),
(15, 2, 3, 1),
(16, 3, 1, 1),
(17, 3, 2, 1),
(18, 3, 5, 5),
(19, 4, 4, 1);

-- Reset the sequence after manual inserts
SELECT setval('order_items_order_item_id_seq', (SELECT MAX(order_item_id) FROM order_items));

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE products (
  product_id SERIAL PRIMARY KEY,
  product_name VARCHAR(100) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  stock INTEGER NOT NULL
);

--
-- Data for table `products`
--

INSERT INTO products (product_id, product_name, price, stock) VALUES
(1, 'Laptop', 999.99, 10),
(2, 'Smartphone', 499.99, 25),
(3, 'Tablet', 299.99, 15),
(4, 'Headphones', 89.99, 50),
(5, 'Товар A', 10.00, 100),
(6, 'Товар B', 20.00, 50),
(7, 'Товар C', 15.00, 75),
(8, 'Товар D', 30.00, 25),
(9, 'Товар E', 5.00, 200),
(10, 'Товар A', 10.00, 100),
(11, 'Товар B', 20.00, 50),
(12, 'Товар C', 15.00, 75),
(13, 'Товар D', 30.00, 25),
(14, 'Товар E', 5.00, 200);

-- Reset the sequence after manual inserts
SELECT setval('products_product_id_seq', (SELECT MAX(product_id) FROM products));

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE users (
  user_id SERIAL PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL
);

--
-- Data for table `users`
--

INSERT INTO users (user_id, username, email, password) VALUES
(1, 'JohnDoe', 'john@example.com', 'password123'),
(2, 'JaneSmith', 'jane@example.com', 'password456'),
(3, 'AliceJohnson', 'alice@example.com', 'password789'),
(4, 'BobBrown', 'bob@example.com', 'password321'),
(5, 'user1', 'user1@example.com', 'password1'),
(6, 'user2', 'user2@example.com', 'password2'),
(7, 'user3', 'user3@example.com', 'password3'),
(8, 'user_22', 'user@email', '123'),
(9, 'user_4', 'user@email', '123'),
(10, 'user_4', 'user@email', '123'),
(11, 'qerqre', 'q@q.q', 'q@q.q'),
(12, 'qerqre', 'q@q.q', 'q@q.q'),
(13, 'qerqre', 'q@q.q', 'q@q.q'),
(17, 'qerqre', 'q@q.q', 'q@q.q'),
(18, 'qerqre', 'q@q.q', 'q@q.q'),
(19, 'qerqre', 'q@q.q', 'q@q.q'),
(20, 'qerqre', 'q@q.q', 'q@q.q'),
(21, 'qerqre', 'q@q.q', 'q@q.q'),
(22, 'qerqre', 'q@q.q', 'q@q.q');

-- Reset the sequence after manual inserts
SELECT setval('users_user_id_seq', (SELECT MAX(user_id) FROM users));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE orders ADD CONSTRAINT orders_user_id_fk FOREIGN KEY (user_id) REFERENCES users (user_id);

--
-- Indexes for table `order_items`
--
ALTER TABLE order_items ADD CONSTRAINT order_items_order_id_fk FOREIGN KEY (order_id) REFERENCES orders (order_id);
ALTER TABLE order_items ADD CONSTRAINT order_items_product_id_fk FOREIGN KEY (product_id) REFERENCES products (product_id);