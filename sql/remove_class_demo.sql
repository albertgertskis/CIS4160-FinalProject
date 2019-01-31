USE reddit;

-- Delete the users
DELETE FROM users WHERE user_username="albert_gertskis";
DELETE FROM users WHERE user_username="aman_bablu";

-- Delete the posts
DELETE FROM posts WHERE post_id=10;