---- setups database ----
# CREATE DATABASE shoppingonline
CREATE DATABASE shoppingonline;

# CREATE TABLE admin
CREATE TABLE admin(
    admin_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    admin_fullname VARCHAR(100) NOT NULL,
    admin_email VARCHAR(255) NOT NULL,
    admin_phone INT(15) NOT NULL,
    admin_password VARCHAR(100) NOT NULL,
    admin_account_type VARCHAR(5) NOT NULL DEFAULT 'not have access',
    created_ad TIMESTAMP
);

# CREATE TABLE users

CREATE TABLE users(
    user_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_email VARCHAR(255) NOT NULL,
    user_phone INT(15) NOT NULL,
    user_password VARCHAR(100) NOT NULL,
    user_status INT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP
);

# CREATE TABLE categories
CREATE TABLE categories(
    cate_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cate_small_description VARCHAR(100) NOT NULL,
    cate_code_type VARCHAR(50) NOT NULL,
    cate_title VARCHAR(255) NOT NULL,
    cate_description MEDIUMTEXT,
    cate_image VARCHAR(255) NOT NULL,
    cate_status INT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP
);

# CREATE TABLE products
CREATE TABLE products(
    prod_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    prod_category_id INT(11) NOT NULL,
    prod_title VARCHAR(255) NOT NULL,
    prod_code_type VARCHAR(50) NOT NULL,
    prod_small_description MEDIUMTEXT,
    prod_original_price INT(255) NOT NULL,
    prod_selling_price INT(255) NOT NULL,
    prod_image VARCHAR(255) NOT NULL,
    prod_quantity INT(255) NOT NULL,
    prod_trending INT(1) NOT NULL DEFAULT 0,
    prod_status  INT(1) NOT NULL DEFAULT 0,
    prod_description MEDIUMTEXT,
    created_at TIMESTAMP
);