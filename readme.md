## Database

db_gameshop

## Table

1. tb_admin
- admin_id 		|| int () primary key auto increment
- admin_name 		|| varchar (50)
- username		|| varchar (50)
- password		|| varchar (100)
- admin_telp		|| varchar (20)
- admin_email		|| varchar (50)
- admin_address		|| text

2. tb_user
- user_id		|| int () primary key auto increment
- user_name		|| varchar (50)
- username		|| varchar (50)
- password		|| varchar (100)
- user_email		|| varchar (50)

3. tb_category
- category_id		|| int () primary key auto increment
- category_name		|| varchar (25)

4. tb_product
- product_id		|| int () primary key auto increment
- category_id		|| int () foreign key index
- product_name		|| varchar (100)
- product_price		|| int ()
- product_description	|| text
- product_image		|| varchar (100)
- product_status	|| tinyint (1)
- date_created		|| timestamp () current_timestamp()

## Data

## Category
1. Accessories
2. Mouse
3. Keyboard
4. Monitor
5. Controller
6. Computer
7. Laptop
8. Smartphone
9. Console