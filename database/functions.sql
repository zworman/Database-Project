CREATE OR REPLACE FUNCTION bot_average(n integer)
RETURNS real AS $$
DECLARE
	num real;
BEGIN
	SELECT AVG(price) INTO num FROM (SELECT price FROM menu_items ORDER BY
		price ASC LIMIT n) AS p;
	RETURN num;
END; $$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION top_average(n integer)
RETURNS real AS $$
DECLARE
	num real;
BEGIN
	SELECT AVG(price) INTO num FROM (SELECT price FROM menu_items ORDER BY
		price DESC LIMIT n) AS p;
	RETURN num;
END; $$
LANGUAGE plpgsql;

CREATE OR REPLACE PROCEDURE insert_customer(integer, varchar(50), varchar(50))
LANGUAGE plpgsql
AS $$
BEGIN
	INSERT INTO customer
	VALUES($1, $2, $3);
	COMMIT;
END;
$$;

CREATE OR REPLACE PROCEDURE delete_customer(integer, varchar(50), varchar(50))
LANGUAGE plpgsql
AS $$
BEGIN
	DELETE FROM customer
	WHERE customer_num = $1 OR phone_number = $2 OR name = $3;
	COMMIT;
END;
$$;

CREATE OR REPLACE FUNCTION f_customer_update()
RETURNS trigger AS $BODY$
BEGIN
	IF NEW.customer_num != OLD.customer_num THEN
	UPDATE c_order set customer_num = NEW.customer_num
	WHERE customer_num = OLD.customer_num;
	END IF;

	RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER customer_update
	BEFORE UPDATE
	ON customer
	FOR EACH ROW
	EXECUTE PROCEDURE f_customer_update();

CREATE OR REPLACE FUNCTION f_customer_delete()
RETURNS trigger AS $BODY$
BEGIN
	DELETE FROM c_order o WHERE o.customer_num = OLD.customer_num;

	RETURN OLD;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER customer_delete
	BEFORE DELETE
	ON customer
	FOR EACH ROW
	EXECUTE FUNCTION f_customer_delete();

CREATE OR REPLACE FUNCTION f_order_delete()
RETURNS trigger AS $BODY$
BEGIN
	DELETE FROM order_quantity o WHERE o.order_id = OLD.order_id;

	RETURN OLD;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER order_delete
	BEFORE DELETE
	ON c_order
	FOR EACH ROW
	EXECUTE FUNCTION f_order_delete();

CREATE VIEW customerview AS
	SELECT cu.customer_num AS num,
	cu.phone_number AS phone,
	cu.name AS name,
	o.order_id AS ord
	FROM customer cu INNER JOIN c_order o USING(customer_num);


CREATE OR REPLACE FUNCTION update_customerview_func()
RETURNS trigger AS
$func$
BEGIN
	UPDATE customer SET customer_num = NEW.num
	WHERE customer_num = OLD.num;
	UPDATE customer SET phone_number = NEW.phone
	WHERE phone_number = OLD.phone;
	UPDATE customer SET name = NEW.name
	WHERE name = OLD.name;
	UPDATE c_order SET order_id = NEW.ord
	WHERE order_id = OLD.ord;
	RETURN NEW;
END
$func$ LANGUAGE plpgsql;

CREATE TRIGGER insert_customerview_trig
	INSTEAD OF UPDATE ON customerview
	FOR EACH ROW EXECUTE PROCEDURE update_customerview_func();
