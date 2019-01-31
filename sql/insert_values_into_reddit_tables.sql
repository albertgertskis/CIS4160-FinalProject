USE reddit;

INSERT INTO users (user_username, user_password) VALUES ('amger', 'test123'), ('sean_musk', 'test1234'), ('dave', 'test12345'), ('elon_musk', 'test123456'), ('steve_rafalovich', 'test12345'), ('polina_gertskis', 'test123456'), ('albert_gertskis', 'myPassword'), ('aman_bablu', 'someOtherPassword');

INSERT INTO posts (post_id, post_title, post_image_url, post_body, poster_username) VALUES(NULL, 'Title Test 1', NULL, 'This is a test of the post body # 1.', 'amger'), (NULL, 'Title Test 2', NULL, 'This is a test of the post body # 2.', 'sean_musk'), (NULL, 'Title Test 1', NULL, 'This is a test of the post body # 1.', 'dave'), (NULL, 'Title Test 2', NULL, 'This is a test of the post body # 2.', 'dave'), (NULL, 'This is a test title for my post', NULL, 'This is the body of my post...Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'steve_rafalovich'), (NULL, 'Title Test 2', NULL, 'This is a test of the post body # 2.', 'polina_gertskis'), (NULL, 'This is a really cool topic', NULL, 'What do you guys think about this topic? I will be very interested to see your thoughts on this!', 'polina_gertskis'), (NULL, 'An image of a road during fall that I really like', 'https://images.freeimages.com/images/large-previews/05e/on-the-road-6-1384796.jpg', NULL, 'steve_rafalovich'), (NULL, 'An even taller image test', 'https://upload.wikimedia.org/wikipedia/commons/3/38/Tampa_FL_Sulphur_Springs_Tower_tall_pano01.jpg', NULL, 'elon_musk');

INSERT INTO posts (post_id, post_title, post_image_url, post_body, post_karma, poster_username) VALUES(NULL, 'This is an image of my favorite sunset in a city that I really like', 'https://images.unsplash.com/photo-1535498730771-e735b998cd64?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80', NULL, 245, 'albert_gertskis');

INSERT INTO comments (comment_id, comment_content, commenter_username, post_id) VALUES (NULL, 'This is comment 1', 'amger', 1), (NULL, 'This is comment 2', 'sean_musk', 1), (NULL, 'This is comment 1', 'sean_musk', 2), (NULL, 'This is comment 1', 'amger', 3), (NULL, 'This is comment 2', 'sean_musk', 1), (NULL, 'This is comment 1', 'dave', 4), (NULL, 'This is comment made by amger', 'amger', 6), (NULL, 'This is comment 2', 'sean_musk', 1), (NULL, 'This is comment made by dave', 'dave', 6), (NULL, 'This is comment made by Aman during the beginning of the class presentation.', 'aman_bablu', 9), (NULL, 'This is comment 2 made by Aman as well!', 'aman_bablu', 9), (NULL, 'This is a comment made by Albert during the end of the presenatation.', 'albert_gertskis', 9);