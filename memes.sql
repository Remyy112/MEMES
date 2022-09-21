SELECT * FROM memes WHERE deleted_at IS NULL
OFFSET 0 LIMIT 10

INSERT INTO users (1, nazwa, haslo)
VALUE (1, Adam, Adam123)