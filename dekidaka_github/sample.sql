INSERT INTO dekidaka
  (title, section, q_num, a_num, cnt)
VALUES
  (:title, :section, :q_num, :a_num, :cnt)

UPDATE dekidaka
SET $column = :value
WHERE title = :title
AND section = :section
AND cnt = :cnt

SELECT
  title, section, q_num, a_num, q_num/a_num AS percent, cnt
FROM dekidaka

SELECT
  title
FROM menu
WHERE title LIKE "%キャラメル%";


SELECT
  title, section, MAX(TRUNCATE(a_num/q_num*100, 2)) AS percent
FROM dekidaka
GROUP BY title, section;
