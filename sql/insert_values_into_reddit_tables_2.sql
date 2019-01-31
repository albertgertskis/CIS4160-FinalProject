USE reddit;

INSERT INTO users (user_username, user_password) VALUES ('dave', 'test12345'), ('elon_musk', 'test123456');

INSERT INTO posts (post_id, post_title, post_image_url, post_body, poster_username) VALUES(NULL, 'Title Test 1', NULL, 'This is a test of the post body # 1.', 'dave'), (NULL, 'Title Test 2', NULL, 'This is a test of the post body # 2.', 'dave');

INSERT INTO comments (comment_id, comment_content, commenter_username, post_id) VALUES (NULL, 'This is comment 1', 'amger', 3), (NULL, 'This is comment 2', 'sean_musk', 1), (NULL, 'This is comment 1', 'dave', 4);