USE reddit;

INSERT INTO users (user_username, user_password) VALUES ('albert_gertskis', 'myPassword'), ('aman_bablu', 'someOtherPassword');

INSERT INTO posts (post_id, post_title, post_image_url, post_body, post_karma, poster_username) VALUES(NULL, 'This is an image of my favorite sunset in a city that I really like', 'https://images.unsplash.com/photo-1535498730771-e735b998cd64?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80', NULL, 245, 'albert_gertskis');

INSERT INTO comments (comment_id, comment_content, commenter_username, post_id) VALUES (NULL, 'This is comment made by Aman during the beginning of the class presentation.', 'aman_bablu', 10), (NULL, 'This is comment 2 made by Aman as well!', 'aman_bablu', 10), (NULL, 'This is a comment made by Albert during the end of the presenatation.', 'albert_gertskis', 10);


