CREATE DATABASE orders;
USE orders;

CREATE TABLE clients 
(cod_cli integer UNSIGNED PRIMARY KEY,
phone varchar(30),
name varchar(30),
details varchar(600));

CREATE TABLE managers
(cod_man integer UNSIGNED PRIMARY KEY,
phone varchar(30),
name varchar(30),
details varchar(600));

CREATE TABLE suppliers
(cod_sup integer UNSIGNED PRIMARY KEY,
phone varchar(30),
name varchar(30),
details varchar(600));

CREATE TABLE orders
(cod_ord integer UNSIGNED PRIMARY KEY,
cod_cli integer UNSIGNED,
cod_man integer UNSIGNED,
order_date date,
deliver_date date,
delivered boolean,
price decimal(10,2),
remarks varchar(600));

CREATE TABLE contain_o_p
(cod_ord integer UNSIGNED,
cod_piece integer UNSIGNED,
quantity integer UNSIGNED,
remarks varchar(600),
PRIMARY KEY (cod_ord,cod_piece));

CREATE TABLE pieces
(cod_piece integer UNSIGNED PRIMARY KEY,
plans varchar(30),
price decimal(10,2),
description varchar(600));

CREATE TABLE need_p_m
(cod_piece integer UNSIGNED,
cod_mat integer UNSIGNED,
quantity integer UNSIGNED,
remarks varchar(600),
PRIMARY KEY (cod_mat,cod_piece));

CREATE TABLE materials
(cod_mat integer UNSIGNED PRIMARY KEY,
price decimal(10,2),
description varchar(600));

CREATE TABLE supply_m_s
(cod_sup integer UNSIGNED,
cod_mat integer UNSIGNED,
order_date date,
deliver_date date,
delivered boolean,
quantity integer UNSIGNED,
price_u decimal(10,2),
price_t decimal(10,2),
remarks varchar(600),
PRIMARY KEY (cod_mat,cod_sup,order_date));




ALTER TABLE orders
ADD CONSTRAINT fk_orders
FOREIGN KEY (cod_cli)
REFERENCES clients(cod_cli)
ON UPDATE CASCADE;

ALTER TABLE orders
ADD CONSTRAINT fk_orders2
FOREIGN KEY (cod_man)
REFERENCES managers(cod_man)
ON UPDATE CASCADE;

ALTER TABLE contain_o_p
ADD CONSTRAINT fk_contain_o_p
FOREIGN KEY (cod_ord)
REFERENCES orders(cod_ord)
ON UPDATE CASCADE; 

ALTER TABLE contain_o_p
ADD CONSTRAINT fk_contain_o_p2
FOREIGN KEY (cod_piece)
REFERENCES pieces(cod_piece)
ON UPDATE CASCADE; 

ALTER TABLE need_p_m
ADD CONSTRAINT fk_need_p_m
FOREIGN KEY (cod_piece)
REFERENCES pieces(cod_piece)
ON UPDATE CASCADE; 

ALTER TABLE need_p_m
ADD CONSTRAINT fk_need_p_m2
FOREIGN KEY (cod_mat)
REFERENCES materials(cod_mat)
ON UPDATE CASCADE;

ALTER TABLE supply_m_s
ADD CONSTRAINT fk_supply_m_s
FOREIGN KEY (cod_mat)
REFERENCES materials(cod_mat)
ON UPDATE CASCADE;

ALTER TABLE supply_m_s
ADD CONSTRAINT fk_supply_m_s2
FOREIGN KEY (cod_sup)
REFERENCES suppliers(cod_sup)
ON UPDATE CASCADE;