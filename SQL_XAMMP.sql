--UPDATED SQL AFTER CREATING DB IN XAMMP
--DERIVED DIRECTLY FROM XAMMP

CREATE TABLE AUTHOR (
  Auth_ID char(7) NOT NULL,
  Auth_name varchar(70) NOT NULL,
  Nationality varchar(20) DEFAULT NULL,
  Biography varchar(500) DEFAULT NULL
) 


INSERT INTO AUTHOR (Auth_ID, Auth_name, Nationality, Biography) VALUES
('AUTH001', 'George Orwell', 'British', 'Author of 1984 and Animal Farm'),
('AUTH002', 'J.R.R. Tolkien', 'South African', 'Author of Lord of the Rings and The Hobbit'),
('AUTH003', 'Roald Dahl', 'British', 'Author of Matilda and Charlie and the Chocolate Factory'),
('AUTH004', 'Jane Austen', 'British', 'Author of Pride and Prejudice'),
('AUTH005', 'Stephen King', 'American', 'Author of IT'),
('AUTH006', 'George R. R. Martin', 'American', 'Author of A Game of Thrones'),
('AUTH007', 'Rick Riordan', 'American', 'Author of the Percy Jackson Series'),
('AUTH008', 'Mark Twain', 'American', 'Author of the Adventures of Huckleberry Finn');


CREATE TABLE BOOK (
  ISBN char(7) NOT NULL,
  Title varchar(200) NOT NULL,
  Price decimal(6,2) DEFAULT NULL,
  Stk_Quant int(11) DEFAULT NULL,
  Pub_Year decimal(4,0) DEFAULT NULL,
  Edtn int(11) DEFAULT NULL,
  Book_mgrID char(6) DEFAULT NULL,
  Cover_Image varchar(255) DEFAULT NULL
) 



INSERT INTO BOOK (ISBN, Title, Price, Stk_Quant, Pub_Year, Edtn, Book_mgrID, Cover_Image) VALUES
('ISBN001', '1984', 12.99, 113, 1949, 1, 'ADM001', 'https://covers.openlibrary.org/b/isbn/9780451524935-L.jpg'),
('ISBN002', 'The Hobbit', 13.99, 96, 1937, 1, 'ADM002', 'https://covers.openlibrary.org/b/isbn/9780547928227-L.jpg'),
('ISBN003', 'Matilda', 9.99, 36, 1988, 1, 'ADM003', 'https://covers.openlibrary.org/b/isbn/9780142410370-L.jpg'),
('ISBN004', 'Pride and Prejudice', 7.99, 89, 1813, 1, 'ADM004', 'https://covers.openlibrary.org/b/isbn/9780141439518-L.jpg'),
('ISBN005', 'IT', 15.99, 45, 1986, 1, 'ADM005', 'https://covers.openlibrary.org/b/isbn/9781501142970-L.jpg'),
('ISBN006', 'A Game of Thrones', 17.99, 52, 1996, 1, 'ADM002', 'https://covers.openlibrary.org/b/isbn/9780553103540-L.jpg'),
('ISBN007', 'Percy Jackson: The Lightning Thief', 10.99, 28, 2005, 1, 'ADM001', 'https://covers.openlibrary.org/b/isbn/9780786856299-L.jpg'),
('ISBN008', 'Adventures of Huckleberry Finn', 8.99, 68, 1884, 1, 'ADM004', 'https://covers.openlibrary.org/b/isbn/9780486280615-L.jpg');



CREATE TABLE CATEGORIZATION (
  Cgz_catID char(6) NOT NULL,
  Cgz_bookID char(7) NOT NULL
) 


INSERT INTO CATEGORIZATION (Cgz_catID, Cgz_bookID) VALUES
('CAT001', 'ISBN001'),
('CAT001', 'ISBN007'),
('CAT002', 'ISBN002'),
('CAT003', 'ISBN003'),
('CAT004', 'ISBN004'),
('CAT005', 'ISBN005'),
('CAT006', 'ISBN006'),
('CAT006', 'ISBN008');



CREATE TABLE CATEGORY_GENRE (
  Cat_ID char(6) NOT NULL,
  Cat_Name varchar(75) NOT NULL,
  Cat_mgrID char(6) DEFAULT NULL
) 



INSERT INTO CATEGORY_GENRE (Cat_ID, Cat_Name, Cat_mgrID) VALUES
('CAT001', 'Dystopian', 'ADM001'),
('CAT002', 'Fantasy', 'ADM002'),
('CAT003', 'Children', 'ADM003'),
('CAT004', 'Romance', 'ADM004'),
('CAT005', 'Horror', 'ADM005'),
('CAT006', 'Young Adult', 'ADM002');

CREATE TABLE CUSTOMER (
  Cust_ID char(7) NOT NULL,
  Cust_name varchar(70) NOT NULL,
  Cust_address varchar(200) DEFAULT NULL,
  Reg_Date date NOT NULL,
  Cust_phone_no char(10) DEFAULT NULL,
  Cust_pass varchar(255) DEFAULT NULL,
  User_ID varchar(50) DEFAULT NULL
) 

INSERT INTO CUSTOMER (Cust_ID, Cust_name, Cust_address, Reg_Date, Cust_phone_no, Cust_pass, User_ID) VALUES
('CUST001', 'Armani Knight', '123 Brook Street', '2024-04-30', '6013895859', NULL, NULL),
('CUST002', 'Catherine Martin', '281 West Street', '2024-07-09', '6012675837', NULL, NULL),
('CUST003', 'Emmett Odom', '61 Lake Avenue', '2025-01-30', '6082534089', NULL, NULL),
('CUST004', 'Simon Wells', '4329 Stones Lane', '2025-08-12', '2156705462', NULL, NULL),
('CUST005', 'Leslie Brooks', '86 Lily Street', '2025-11-03', '6012564751', NULL, NULL),
('CUST006', 'Elizabeth Smith', '321 Harvest Way', '2025-11-12', '6070934261', NULL, NULL),
('CUST007', 'Myra Banks', '5431 Apple Avenue', '2025-11-16', '6098389578', NULL, NULL),
('CUST008', 'John Doe', '123 Mulberry Street', '2025-12-06', '1234567890', '$2y$10$8QYqvNG1rsuoAgYgH/CMjeP8/T3M2uLtTXqGckwPBVCm.VqU6V8l2', 'JohnDoe123');



CREATE TABLE ORDER_ITEM (
  Item_ordID char(6) NOT NULL,
  Item_ID char(7) NOT NULL
)


INSERT INTO ORDER_ITEM (Item_ordID, Item_ID) VALUES
('ORD001', 'ISBN001'),
('ORD002', 'ISBN002'),
('ORD003', 'ISBN003'),
('ORD004', 'ISBN002'),
('ORD004', 'ISBN005'),
('ORD005', 'ISBN006'),
('ORD006', 'ISBN007'),
('ORD340', 'ISBN001'),
('ORD541', 'ISBN002'),
('ORD563', 'ISBN001'),
('ORD584', 'ISBN004'),
('ORD743', 'ISBN001'),
('ORD783', 'ISBN003');



CREATE TABLE PAYMENT_METHOD (
  M_payID char(6) NOT NULL,
  pay_Method varchar(30) NOT NULL,
  Card_no char(16) DEFAULT NULL
) 



INSERT INTO PAYMENT_METHOD (M_payID, pay_Method, Card_no) VALUES
('PAY001', 'Credit Card', '1234567890123456'),
('PAY002', 'Cash', NULL),
('PAY003', 'PayPal', '5645625727688368'),
('PAY004', 'Debit Card', '7893795979279717'),
('PAY005', 'Cash', NULL),
('PAY006', 'Apple Pay', '8909387279891900'),
('PAY007', 'Gift Card', '8375997992787456');



CREATE TABLE PAYMENT_REC (
  Pay_ID char(6) NOT NULL,
  Amount decimal(8,2) NOT NULL,
  Pay_Date date DEFAULT NULL,
  Related_ordID char(6) DEFAULT NULL
) 


INSERT INTO PAYMENT_REC (Pay_ID, Amount, Pay_Date, Related_ordID) VALUES
('PAY001', 12.99, '2025-11-01', 'ORD001'),
('PAY002', 13.99, '2025-11-02', 'ORD002'),
('PAY003', 15.99, '2025-11-03', 'ORD003'),
('PAY004', 17.99, '2025-11-04', 'ORD004'),
('PAY005', 9.99, '2025-11-05', 'ORD005'),
('PAY006', 17.99, '2025-11-06', 'ORD006'),
('PAY007', 10.99, '2025-11-12', 'ORD007');




CREATE TABLE REVIEW (
  ReviewerID char(7) NOT NULL,
  ReviewedID char(7) NOT NULL,
  Rating int(11) NOT NULL,
  Commentary varchar(200) DEFAULT NULL
) 



INSERT INTO REVIEW (ReviewerID, ReviewedID, Rating, Commentary) VALUES
('CUST001', 'ISBN001', 5, 'A classic dystopian masterpiece'),
('CUST002', 'ISBN002', 4, 'A world fantasy where hobbits reside'),
('CUST002', 'ISBN004', 4, 'Elegant and delightful novel'),
('CUST003', 'ISBN003', 5, 'An amusing story for children'),
('CUST003', 'ISBN007', 4, 'A great novel for beginners'),
('CUST005', 'ISBN005', 3, 'A horror story that will haunt your dreams'),
('CUST005', 'ISBN006', 5, 'One of my favorite reads'),
('CUST006', 'ISBN006', 4, 'Epic fantasy saga');


CREATE TABLE STORE_ADMIN (
  Admin_ID char(6) NOT NULL,
  Admin_name varchar(70) NOT NULL,
  Log_cred varchar(50) NOT NULL
)



INSERT INTO STORE_ADMIN (Admin_ID, Admin_name, Log_cred) VALUES
('ADM001', 'Theodore Franklin', 'Frank123001'),
('ADM002', 'Robert Tang', 'Tang456002'),
('ADM003', 'Maria Greer', 'Greer789003'),
('ADM004', 'Gabriel Gill', 'Gill1011004'),
('ADM005', 'Erin Burton', 'Burton1213005'),
('ADM006', 'Ali Khan', 'Khan1415006');


CREATE TABLE STORE_ORDER (
  Ord_ID char(6) NOT NULL,
  Ord_date date NOT NULL,
  Tot_amount decimal(8,2) NOT NULL,
  Ship_Status varchar(50) DEFAULT NULL,
  Related_payID char(6) DEFAULT NULL,
  Placer_ID char(7) DEFAULT NULL,
  Ord_mgrID char(6) DEFAULT NULL,
  Pay_ID varchar(10) DEFAULT NULL
) 



INSERT INTO STORE_ORDER (Ord_ID, Ord_date, Tot_amount, Ship_Status, Related_payID, Placer_ID, Ord_mgrID, Pay_ID) VALUES
('ORD001', '2025-11-01', 12.99, 'Shipped', 'PAY001', 'CUST001', 'ADM001', NULL),
('ORD002', '2025-11-02', 13.99, 'Processing', 'PAY002', 'CUST002', 'ADM002', NULL),
('ORD003', '2025-11-03', 15.99, 'Delivered', 'PAY003', 'CUST003', 'ADM002', NULL),
('ORD004', '2025-11-04', 17.99, 'Delivered', 'PAY004', 'CUST005', 'ADM003', NULL),
('ORD005', '2025-11-05', 9.99, 'Shipped', 'PAY005', 'CUST001', 'ADM002', NULL),
('ORD006', '2025-11-06', 17.99, 'Cancelled', 'PAY006', 'CUST002', 'ADM001', NULL),
('ORD007', '2025-11-12', 10.99, 'Processing', 'PAY007', 'CUST007', 'ADM002', NULL),



CREATE TABLE WRITES (
  Work_ID char(7) NOT NULL,
  Writer_ID char(7) NOT NULL
) 


INSERT INTO WRITES (Work_ID, Writer_ID) VALUES
('ISBN001', 'AUTH001'),
('ISBN002', 'AUTH002'),
('ISBN003', 'AUTH003'),
('ISBN004', 'AUTH004'),
('ISBN005', 'AUTH005'),
('ISBN007', 'AUTH006'),
('ISBN007', 'AUTH007'),
('ISBN008', 'AUTH008');


ALTER TABLE AUTHOR
  ADD PRIMARY KEY (Auth_ID);


ALTER TABLE BOOK
  ADD PRIMARY KEY (ISBN),
  ADD KEY Book_mgrID (Book_mgrID);


ALTER TABLE CATEGORIZATION
  ADD PRIMARY KEY (Cgz_catID,Cgz_bookID),
  ADD KEY Cgz_bookID (Cgz_bookID);


ALTER TABLE CATEGORY_GENRE
  ADD PRIMARY KEY (Cat_ID),
  ADD KEY Cat_mgrID (Cat_mgrID);


ALTER TABLE CUSTOMER
  ADD PRIMARY KEY (Cust_ID),
  ADD UNIQUE KEY User_ID (User_ID);


ALTER TABLE ORDER_ITEM
  ADD PRIMARY KEY (Item_ordID,Item_ID),
  ADD KEY Item_ID (Item_ID);


ALTER TABLE PAYMENT_METHOD
  ADD PRIMARY KEY (M_payID,pay_Method);


ALTER TABLE PAYMENT_REC
  ADD PRIMARY KEY (Pay_ID),
  ADD KEY Related_ordID (Related_ordID);


ALTER TABLE REVIEW
  ADD PRIMARY KEY (ReviewerID,ReviewedID),
  ADD KEY ReviewedID (ReviewedID);


ALTER TABLE STORE_ADMIN
  ADD PRIMARY KEY (Admin_ID);


ALTER TABLE STORE_ORDER
  ADD PRIMARY KEY (Ord_ID),
  ADD KEY Placer_ID (Placer_ID),
  ADD KEY Ord_mgrID (Ord_mgrID),
  ADD KEY RELATEDPAYREC (Related_payID);


ALTER TABLE WRITES
  ADD PRIMARY KEY (Work_ID,Writer_ID),
  ADD KEY Writer_ID (Writer_ID);



ALTER TABLE BOOK
  ADD CONSTRAINT book_ibfk_1 FOREIGN KEY (Book_mgrID) REFERENCES STORE_ADMIN (Admin_ID) ON DELETE SET NULL;


ALTER TABLE CATEGORIZATION
  ADD CONSTRAINT categorization_ibfk_1 FOREIGN KEY (Cgz_catID) REFERENCES CATEGORY_GENRE (Cat_ID) ON DELETE CASCADE,
  ADD CONSTRAINT categorization_ibfk_2 FOREIGN KEY (Cgz_bookID) REFERENCES BOOK (ISBN) ON DELETE CASCADE;


ALTER TABLE CATEGORY_GENRE
  ADD CONSTRAINT category_genre_ibfk_1 FOREIGN KEY (Cat_mgrID) REFERENCES STORE_ADMIN (Admin_ID) ON DELETE SET NULL;


ALTER TABLE ORDER_ITEM
  ADD CONSTRAINT order_item_ibfk_1 FOREIGN KEY (Item_ordID) REFERENCES STORE_ORDER (Ord_ID) ON DELETE CASCADE,
  ADD CONSTRAINT order_item_ibfk_2 FOREIGN KEY (Item_ID) REFERENCES BOOK (ISBN) ON DELETE CASCADE;


ALTER TABLE PAYMENT_METHOD
  ADD CONSTRAINT payment_method_ibfk_1 FOREIGN KEY (M_payID) REFERENCES PAYMENT_REC (Pay_ID) ON DELETE CASCADE;


ALTER TABLE PAYMENT_REC
  ADD CONSTRAINT payment_rec_ibfk_1 FOREIGN KEY (Related_ordID) REFERENCES STORE_ORDER (Ord_ID) ON DELETE SET NULL;


ALTER TABLE REVIEW
  ADD CONSTRAINT review_ibfk_1 FOREIGN KEY (ReviewerID) REFERENCES CUSTOMER (Cust_ID) ON DELETE CASCADE,
  ADD CONSTRAINT review_ibfk_2 FOREIGN KEY (ReviewedID) REFERENCES BOOK (ISBN) ON DELETE CASCADE;


ALTER TABLE STORE_ORDER
  ADD CONSTRAINT RELATEDPAYREC FOREIGN KEY (Related_payID) REFERENCES PAYMENT_REC (Pay_ID) ON DELETE SET NULL,
  ADD CONSTRAINT store_order_ibfk_1 FOREIGN KEY (Placer_ID) REFERENCES CUSTOMER (Cust_ID) ON DELETE SET NULL,
  ADD CONSTRAINT store_order_ibfk_2 FOREIGN KEY (Ord_mgrID) REFERENCES STORE_ADMIN (Admin_ID) ON DELETE SET NULL;


ALTER TABLE WRITES
  ADD CONSTRAINT writes_ibfk_1 FOREIGN KEY (Work_ID) REFERENCES BOOK (ISBN) ON DELETE CASCADE,
  ADD CONSTRAINT writes_ibfk_2 FOREIGN KEY (Writer_ID) REFERENCES AUTHOR (Auth_ID) ON DELETE CASCADE;









