SELECT * FROM memes WHERE deleted_at IS NULL
OFFSET 0 LIMIT 10

SELECT file, updated_at, title, likes FROM memes

 

SELECT m.id, m.file, m.title, m.likes, m.updated_at as "date", u1_name as "author", u2_name as "admin" FROM memes m
JOIN users u1  ON m.user_id = u1.id
JOIN users u2 ON m.admin_id = u2.id
WHERE m.deleted_at IS NULL OFFSET 0 LIMIT 10
