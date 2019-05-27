--Zakary Worman

CREATE TABLE customer (
	customer_num integer PRIMARY KEY,
	phone_number varchar (50),
	name varchar (50) NOT NULL,
	username varchar (20) NOT NULL UNIQUE,
	password varchar (10) NOT NULL
);

CREATE TABLE supplier (
	supplier_id integer PRIMARY KEY,
	name varchar (50) NOT NULL
);

CREATE TABLE nutrition (
	nutrition_id integer PRIMARY KEY,
	n_type varchar (50)
);

CREATE TABLE store (
	store_num integer PRIMARY KEY,
	location varchar (100)
);

CREATE TABLE employee (
	employee_id integer PRIMARY KEY,
	fname varchar (20) NOT NULL,
	minit varchar (1),
	lname varchar (20) NOT NULL,
	address varchar (50) NOT NULL,
	dob date NOT NULL,
	ssn varchar (11) NOT NULL,
	store_number integer DEFAULT 1 REFERENCES store(store_num),
	start_date date NOT NULL,
	end_date date,
	position varchar (20) CHECK (position in ('janitor', 'salad prep', 'griller', 'cold prep', 'support', 'cashier', 'supervisor', 'manager')),
	salary real DEFAULT 12.00 CHECK(salary >= 12.00),
	CONSTRAINT ck_employee_dates CHECK(start_date < end_date OR end_date IS NULL)
);

CREATE TABLE clock_in (
	employee_id integer NOT NULL REFERENCES employee(employee_id),
	time_in timestamp NOT NULL,
	time_out timestamp NOT NULL,
	earnings real NOT NULL CHECK (earnings > 0),
	store_number integer DEFAULT 1 REFERENCES store(store_num),
	CONSTRAINT ck_times CHECK(time_in < time_out)
);

CREATE TABLE produce (
	prod_type varchar (50) NOT NULL,
	quantity integer CHECK (quantity >= 0),
	acquired date,
	expiration date CHECK (expiration > acquired OR acquired IS NULL),
	weight real CHECK (weight >= 0.00),
	produce_id integer PRIMARY KEY
);

CREATE TABLE menu_items (
	menu_id integer PRIMARY KEY,
	name varchar (100) NOT NULL,
	type varchar (30) NOT NULL,
	price real NOT NULL CHECK(price > 0.00)
);

Create TABLE menu_produce (
	menu_id integer NOT NULL REFERENCES menu_items(menu_id),
	produce_id integer NOT NULL REFERENCES produce(produce_id)
);

CREATE TABLE c_order (
	employee_id integer NOT NULL REFERENCES employee(employee_id),
	customer_num integer NOT NULL REFERENCES customer(customer_num) ON UPDATE CASCADE,
	menu_id integer NOT NULL REFERENCES menu_items(menu_id),
	order_id integer PRIMARY KEY,
	order_date date NOT NULL
);

CREATE TABLE produce_quantity (
	produce_id integer NOT NULL REFERENCES produce(produce_id),
	menu_id integer NOT NULL REFERENCES menu_items(menu_id),
	weight_in_item real
);

CREATE TABLE order_quantity (
	order_id integer NOT NULL REFERENCES c_order(order_id) ON UPDATE CASCADE,
	menu_id integer NOT NULL REFERENCES menu_items(menu_id),
	price real CHECK(price >= 0.00)
);

CREATE TABLE supply_order (
	supplier_id integer NOT NULL REFERENCES supplier(supplier_id),
	price real CHECK (price > 0.00),
	produce_id integer NOT NULL REFERENCES produce(produce_id),
	order_date date NOT NULL,
	store_num integer NOT NULL REFERENCES store(store_num),
	weight real CHECK(weight > 0.00)
);
CREATE TABLE produce_nutrition(
	produce_id integer NOT NULL REFERENCES produce(produce_id),
	nutrition_id integer NOT NULL REFERENCES nutrition(nutrition_id),
	value float
);
