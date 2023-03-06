SELECT users.id, users.name as user_name, q.content, c.name as category_name, a.answer, a.correct, tu.point
FROM users
         join test_user tu on users.id = tu.user_id
         join category c on tu.category_id = c.id
         join questions q on c.id = q.category_id
         join answers a on q.id = a.questions_id where tu.user_id = 8