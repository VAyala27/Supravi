-- LOGIN INFORMATION
-- Admin - email: admin@gmail.com, password: admin
-- User1 - email: Jane@gmail.com,  password: Password1

CREATE DATABASE Supravi;

CREATE TABLE categories_products (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  category_name varchar(100) NOT NULL,
  category_id int(11) NOT NULL
);
INSERT INTO categories_products (id, category_name, category_id) VALUES
(1, 'Women Dresses', 1),
(2, 'Women Tops', 2),
(3, 'Women Suits', 3),
(4, 'Women Sweaters', 4),
(5, 'Women Jackets', 5),
(6, 'Women Pants', 6),
(7, 'Women Skirts', 7),
(8, 'Men T-Shirts', 8),
(9, 'Men Suits', 9),
(10, 'Men Sweaters', 10),
(11, 'Men Jackets', 11),
(12, 'Men Pants', 12),
(13, 'Men Shorts', 13),
(14, 'Women Boots', 14),
(15, 'Women Heels', 15),
(16, 'Men Sneakers', 16),
(17, 'Women Watches', 17),
(18, 'Women Bags', 18),
(19, 'Men Watches', 19),
(20, 'Men Bags', 20);


CREATE TABLE orders (
  order_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id int(11) NOT NULL DEFAULT '0',
  status tinyint(4) NOT NULL DEFAULT '1',
  order_created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   KEY `user_id` (`user_id`),
   KEY `order_id` (`order_id`),
   KEY `status` (`status`),
   CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
);
INSERT INTO orders (order_id, user_id, status, order_created) VALUES
(1, 1, 1, '2020-06-02 03:20:03');


CREATE TABLE order_items (
  order_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_id int(11) NOT NULL,
  product_name varchar(100) NOT NULL,
  product_price double(10,2) NOT NULL,
  qty int(11) NOT NULL,
  KEY `order_id` (`order_id`,`product_id`),
  KEY `order_items_ibfk_2` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON UPDATE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
);
INSERT INTO order_items (order_id, product_id, product_name, product_price, qty) VALUES
(1, 42, 'Soft Touch Stretch Henley', 21.99, 3),
(1, 67, 'Logo Fleece Joggers', 24.99, 2),
(1, 88, 'Shox R4 Running Sneakers', 50.00, 1);


CREATE TABLE products (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_img varchar(255) NOT NULL,
  product_name varchar(100) NOT NULL,
  product_price double(10,2) NOT NULL,
  category_id int(11) NOT NULL
);
INSERT INTO products (id, product_img, product_name, product_price, category_id) VALUES
(1, 'img/dress-1.jpeg', 'Karl Lagerfeld Floral-Print Wrap Dress', 70.99, 1),
(2, 'img/dress-2.jpeg', 'Floral-Print Shift Dress', 40.00, 1),
(3, 'img/dress-3.jpeg', 'Sequined & Chiffon Gown', 69.00, 1),
(4, 'img/dress-4.jpeg', 'Cotton Off-The-Shoulder Dress', 40.00, 1),
(5, 'img/dress-5.jpeg', 'Satin Gown', 145.00, 1),
(6, 'img/womens_tops1.jpeg', 'Colorblocked Asymmetrical Top', 24.99, 2),
(7, 'img/womens_tops2.jpeg', 'I.N.C. Side-Tie Top', 19.99, 2),
(8, 'img/womens_tops3.jpeg', 'Plaid Utility Shirt', 20.99, 2),
(9, 'img/womens_tops4.jpeg', 'Shiny Plaid Flutter-Sleeve Top', 22.99, 2),
(10, 'img/womens_tops5.jpeg', 'Metallic-Stripe Blouse', 25.99, 2),
(11, 'img/womens_tops6.jpeg', 'Printed Mesh Tiered Shirt', 27.99, 2),
(12, 'img/women_suit1.jpeg', '3-Button Tweed Jacket With Belt And Straight-Leg Dress Pants', 150.00, 3),
(13, 'img/women_suit2.jpeg', 'Tweed Button Blazer And Belted Pencil Skirt', 100.00, 3),
(14, 'img/women_suit3.jpeg', '3-4 Sleeve Skirt Suit', 99.99, 3),
(15, 'img/women_suit4.jpeg', 'Contrast-Trim Blazer, Knot-Neck Top & Slim-Fit Pants', 125.00, 3),
(16, 'img/women_suit5.jpeg', 'Stand Collar Blazer, Printed Shell Blouse & Button-Detail Pants', 100.00, 3),
(17, 'img/women_sweater1.jpeg', 'Chevron Pointelle Cardigan', 59.50, 4),
(18, 'img/women_sweater2.jpeg', 'Striped Sweater', 30.00, 4),
(19, 'img/women_sweater3.jpeg', 'INC Ribbed Pullover Sweater', 45.50, 4),
(20, 'img/women_sweater4.jpeg', 'Cold-Shoulder Sweater', 40.00, 4),
(21, 'img/women_sweater5.jpeg', 'Button Sleeve Shrug', 49.00, 4),
(22, 'img/women_jacket1.jpeg', 'Leather Moto Jacket', 250.00, 5),
(23, 'img/women_jacket2.jpeg', 'INC Knit & Denim Hoodie Jacket', 60.00, 5),
(24, 'img/women_jacket3.jpeg', 'Twill Jacket', 50.00, 5),
(25, 'img/women_jacket4.jpeg', 'Hooded Faux-Fur-Trim Anorak Jacket', 99.99, 5),
(26, 'img/women_jacket5.jpeg', 'Belted Double-Breasted Hooded Trench Coat', 120.00, 5),
(27, 'img/womens_bottoms1.jpeg', 'Tummy-Control Skinny Pants', 24.99, 6),
(28, 'img/womens_bottoms2.jpeg', 'INC Petite Skinny Tummy Control Jeans', 29.99, 6),
(29, 'img/womens_bottoms3.jpeg', 'Tummy-Control Straight-leg Pants', 25.99, 6),
(30, 'img/womens_bottoms4.jpeg', 'Fleece-Lined Joggers', 19.99, 6),
(31, 'img/womens_bottoms5.jpeg', 'Cambridge Tummy-Control Pants', 22.99, 6),
(32, 'img/womens_bottoms6.jpeg', 'Logo Joggers', 28.99, 6),
(33, 'img/womens_bottoms7.jpg', 'Tummy Control Trouser', 26.99, 6),
(34, 'img/womens_bottoms8.jpeg', 'Effortless Easy Pant', 21.99, 6),
(35, 'img/skirt1.jpeg', 'Scuba Pencil Skirt', 49.50, 7),
(36, 'img/skirt2.jpeg', 'Ponte-Knit Midi Skirt', 69.00, 7),
(37, 'img/skirt3.jpeg', 'Pleated Ruffled Skort', 45.50, 7),
(38, 'img/skirt4.jpeg', 'Sequined Skirt', 89.50, 7),
(39, 'img/skirt5.jpeg', 'Tiered Smocked Skirt', 24.99, 7),
(40, 'img/mens_shirt1.jpg', 'Flannel Shirt', 19.99, 8),
(41, 'img/mens_shirt2.jpeg', 'Tech™ Short Sleeve', 20.00, 8),
(42, 'img/mens_shirt3.jpeg', 'Soft Touch Stretch Henley', 21.99, 8),
(43, 'img/mens_shirt4.jpeg', 'Ivy Logo T-Shirt', 20.99, 8),
(44, 'img/mens_shirt5.jpeg', 'Drexel Strip Polo Shirt', 22.99, 8),
(45, 'img/mens_shirt7.jpeg', 'Classic-Fit Ivy Polo', 20.99, 8),
(46, 'img/mens_shirt6.jpeg', 'Hemenway Regular-Fit Stripe Shirt', 25.99, 8),
(47, 'img/men_suit1.jpeg', 'Classic-Fit Solid Ultraflex Suit Separates', 125.00, 9),
(48, 'img/men_suit2.jpeg', 'Stretch Performance Solid Slim-Fit Suit Separates', 129.99, 9),
(49, 'img/men_suit3.jpeg', 'Solid Ultraflex Classic-Fit Suit Separates', 125.00, 9),
(50, 'img/men_suit4.jpeg', 'Unlisted Solid Stretch Slim-Fit Suit', 130.00, 9),
(51, 'img/men_suit5.jpeg', 'Slim-Fit Gray/Brown Plaid Suit Separates', 120.00, 9),
(52, 'img/men_hoodie1.jpeg', 'Signature Fleece Hoodie', 40.00, 10),
(53, 'img/men_hoodie2.jpeg', 'Powerblend Fleece Hoodie', 35.99, 10),
(54, 'img/men_hoodie3.jpeg', 'Mesh Hoodie', 32.99, 10),
(55, 'img/men_sweater1.jpeg', 'Pima Cable Quarter-Zip Sweater', 30.00, 10),
(56, 'img/men_sweater2.jpeg', 'Quarter Zip Merino Wool Blend Sweater', 35.99, 10),
(57, 'img/men_jacket1.jpeg', 'Michael Kors Perforated Faux-Leather Moto Jacket', 112.50, 11),
(58, 'img/men_jacket2.jpeg', 'Two Pocket Hooded Trucker Jacket', 112.50, 11),
(59, 'img/men_jacket4.jpeg', 'Luke Wool-Blend Classic-Fit Peacoat', 125.00, 11),
(60, 'img/men_jacket3.jpeg', 'Long Snorkel Coat', 175.00, 11),
(61, 'img/men_jacket5.jpeg', 'Bateman Jacket', 90.00, 11),
(62, 'img/mens_bottoms2.jpeg', 'Lux Cottons Slim Fit Pants Tee', 32.99, 12),
(63, 'img/mens_bottoms3.jpeg', 'Microtwill Ultraflex Dress Pants', 25.99, 12),
(64, 'img/mens_bottoms4.jpeg', '100% Wool Double-Reverse Dress Pants', 25.99, 12),
(65, 'img/mens_bottoms1.jpeg', 'Skinny-Fit Suit Pants', 30.99, 12),
(66, 'img/mens_bottoms6.jpeg', 'Classic-Fit Jogger Pants', 28.99, 12),
(67, 'img/mens_bottoms8_midnight.jpg', 'Logo Fleece Joggers', 24.99, 12),
(68, 'img/mens_bottoms7.jpeg', 'Jean-Cut Supreme Flex Pants', 25.99, 12),
(69, 'img/mens_bottoms5.jpeg', 'Classic-Fit Stretch Deck Pants', 20.99, 12),
(70, 'img/shorts1.jpeg', 'Classic Flight Cargo 14\" Shorts', 45.99, 13),
(71, 'img/shorts2.jpeg', 'MVP Collections Big & Tall Print Drawstring Shorts', 50.00, 13),
(72, 'img/shorts4.jpeg', 'Relaxed Fit Camouflage Cotton Cargo Shorts', 45.99, 13),
(73, 'img/shorts3.jpeg', 'Fleece Shorts', 45.00, 13),
(74, 'img/shorts5.jpeg', 'TH Flex Stretch 9\" Shorts', 45.99, 13),
(75, 'img/women_boots1.jpeg', 'Joan of Arctic Wedge II Waterproof Chelsea Booties', 45.99, 14),
(76, 'img/women_boots2.jpeg', 'Waterproof 6\" Premium Boots', 50.00, 14),
(77, 'img/women_boots3.jpeg', 'Explorer Joan Waterproof Booties', 45.99, 14),
(78, 'img/women_boots4.jpeg', 'Jayne Waterproof Fleece-Lined Cuffed Boots', 50.00, 14),
(79, 'img/women_boots5.jpeg', 'Out N About Bootie Slippers', 45.99, 14),
(80, 'img/women_heels1.jpeg', 'Danya Dress Sandals\r\n', 45.99, 15),
(81, 'img/women_heels4.jpeg', 'Dorothy Flex Pumps', 50.00, 15),
(82, 'img/women_heels5.jpeg', 'Dori Kitten Heel Pumps', 45.99, 15),
(83, 'img/women_heels3.jpeg', 'Verrda 2 Embellished Platform Dress Sandals', 50.00, 15),
(84, 'img/women_heels2.jpeg', 'INC Carma Pointed Toe Studded Kitten Heel Pumps', 45.99, 15),
(85, 'img/men_sneakers1.jpeg', 'Air Max Excee Running Sneakers', 70.00, 16),
(86, 'img/men_sneakers2.jpeg', '009 Casual Sneakers', 45.00, 16),
(87, 'img/men_sneakers3.jpeg', 'X_PLR Casual Sneakers', 45.99, 16),
(88, 'img/men_sneakers4.jpeg', 'Shox R4 Running Sneakers', 50.00, 16),
(89, 'img/men_sneakers5.jpg', 'Jordan Jumpman 2020', 65.99, 16),
(90, 'img/womens_watches1.jpeg', 'Crystal Stainless Steel Bracelet Watch 32mm', 24.99, 17),
(91, 'img/womens_watches2.jpeg', 'Rose Gold-Tone Bracelet Watch', 24.99, 17),
(92, 'img/womens_watches5.jpeg', 'Jesse Stainless Steel Bracelet Watch 34mm', 45.99, 17),
(93, 'img/womens_watches3.jpeg', 'Evil Eye Gold-Tone Watch', 59.99, 17),
(94, 'img/womens_watches4.jpeg', 'Mini Leather Strap Watch', 59.99, 17),
(95, 'img/womens_bag1_brown.jpeg', 'Camille Satchel', 35.99, 18),
(96, 'img/womens_bags2.jpeg', 'Marybelle Satchel', 40.99, 18),
(97, 'img/womens_bags3.jpeg', 'Marybelle Signature Satchel', 39.99, 18),
(98, 'img/womens_bags4.jpeg', 'Jessie Large Flap Leather Shoulder Bag', 30.99, 18),
(99, 'img/mens_watches1.jpeg', 'The Minimalist Brown Leather Strap Watch 44mm', 24.99, 19),
(100, 'img/mens_watches2.jpeg', 'Chronograph Chief Black Watch', 59.99, 19),
(101, 'img/mens_watches3.jpeg', 'Chronograph Stainless Steel Watch', 59.99, 19),
(102, 'img/mens_watches4.jpeg', 'Automatic Stainless Steel Watch', 24.99, 19),
(103, 'img/mens_bags1.jpeg', 'Slingpack', 60.99, 20),
(104, 'img/mens_bags2.jpeg', 'Expandable Waist Pack', 59.99, 20),
(105, 'img/mens_bags3.jpeg', 'Hoops Elite Pro Backpack', 59.99, 20),
(106, 'img/mens_bags4.jpeg', 'Alexander Backpack', 30.99, 20);


CREATE TABLE payment (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id int(11) NOT NULL,
  total_amount double(10,2) NOT NULL
);
INSERT INTO payment (id, user_id, total_amount) VALUES
(1, 2, 170.95);

CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstname varchar(25) NOT NULL,
  lastname varchar(25) NOT NULL,
  email varchar(25) NOT NULL,
  phone varchar(25) DEFAULT NULL,
  address varchar(100) DEFAULT NULL,
  password varchar(255) NOT NULL,
  usertype int(11) NOT NULL DEFAULT '1'
);

INSERT INTO users (id, firstname, lastname, email, phone, address, password, usertype) VALUES
(0, 'Mike', 'Senoir', 'admin@gmail', NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', 0),
(1, 'Jane', 'Doe', 'Jane@gmail.com', NULL, NULL, '2ac9cb7dc02b3c0083eb70898e549b63', 1);
