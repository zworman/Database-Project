CREATE OR REPLACE VIEW item_nutrition AS
	SELECT m.name AS item,
	n.n_type AS nutrit,
	SUM(v.value) AS amount
	FROM menu_items m NATURAL JOIN menu_produce NATURAL JOIN produce 
	NATURAL JOIN produce_nutrition v NATURAL JOIN nutrition n
	GROUP BY m.name, n.n_type;

CREATE OR REPLACE FUNCTION update_item_nutrition_func()
RETURNS trigger AS
$func$
BEGIN
        UPDATE menu_items SET name = NEW.item
        WHERE name = OLD.item;
        UPDATE nutrition SET n_type = NEW.nutrit
        WHERE n_type = OLD.nutrit;
        RETURN NEW;
END
$func$ LANGUAGE plpgsql;

CREATE TRIGGER insert_item_nutrition_trig
        INSTEAD OF UPDATE ON item_nutrition
	FOR EACH ROW EXECUTE PROCEDURE update_item_nutrition_func();

CREATE OR REPLACE VIEW item_produce AS
	SELECT p.prod_type AS prod,
	m.name AS item
	FROM menu_items m NATURAL JOIN menu_produce NATURAL JOIN produce p
	GROUP BY m.name, p.prod_type;

CREATE OR REPLACE FUNCTION update_item_produce_func()
RETURNS trigger AS
$func$
BEGIN
        UPDATE produce SET prod_type = NEW.prod
        WHERE produce_type = OLD.prod;
        UPDATE menu_items SET name = NEW.item
        WHERE name = OLD.item;
        RETURN NEW;
END
$func$ LANGUAGE plpgsql;

CREATE TRIGGER insert_item_produce_trig
        INSTEAD OF UPDATE ON item_produce
	FOR EACH ROW EXECUTE PROCEDURE update_item_produce_func();

CREATE OR REPLACE VIEW produce_health AS
	SELECT p.prod_type AS item,
	n.n_type AS nutrit,
	SUM(v.value) AS amount
	FROM produce p NATURAL JOIN produce_nutrition v NATURAL JOIN nutrition n 
	GROUP BY p.prod_type, n.n_type;
CREATE OR REPLACE FUNCTION

CREATE OR REPLACE FUNCTION update_produce_health_func()
RETURNS trigger AS
$func$
BEGIN
        UPDATE produce SET prod_type = NEW.item
        WHERE produce_type = OLD.item;
        UPDATE nutrition SET n_type = NEW.nutrit
        WHERE n_type = OLD.nutrit;
        RETURN NEW;
END
$func$ LANGUAGE plpgsql;

CREATE TRIGGER insert_produce_health_trig
        INSTEAD OF UPDATE ON produce_health
	FOR EACH ROW EXECUTE PROCEDURE update_produce_health_func();
