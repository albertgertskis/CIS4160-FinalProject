CREATE DATABASE reddit;
USE reddit;


-- Stores information of a 'Reddit user'
CREATE TABLE users(
    user_username VARCHAR(25) UNIQUE NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    cake_day DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    total_karma INT DEFAULT 0 NOT NULL, -- Aggregate amount of karma user earned from posts and comments
    PRIMARY KEY (user_username)
);

/*
 * Stores information of a "Reddit post' made by a 'Reddit user'
 * NOTE, if 'Reddit user' is deleted from the DB, the 'Reddit posts' made
 * by that user are deleted
*/
CREATE TABLE posts(
    post_id INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL,
    post_title VARCHAR(300) NOT NULL,
    post_image_url VARCHAR(1000), -- This is a link to the actual image, supplied by the user (used for posts only to display the actual image within the post, rather than having the user click on the link to see the image)
    post_body TEXT(40000),
    post_voteDirection INT DEFAULT 0,  -- -1 is downvote, 0 is no vote, +1 is upvote. Logging whether upvote/downvote makes it easier to display the proper CSS
    post_karma INT DEFAULT 1, -- Posts start with a default karma value of 1 (upvote button automatically clicked; if clicked again, karma value decrements by 1 to 0)
    post_timeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    poster_username VARCHAR(25) NOT NULL,
    PRIMARY KEY (post_id),
    FOREIGN KEY (poster_username) REFERENCES users(user_username) ON DELETE CASCADE
);

/*
 * Stores information of a "Reddit comment' made by a 'Reddit user'on a 'Reddit post'.
 * NOTE, if 'Reddit user' is deleted from the DB, the 'Reddit comments' made
 * by that user are deleted
*/
CREATE TABLE comments (
    comment_id INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL,
    comment_content TEXT(10000) NOT NULL,
    comment_voteDirection INT DEFAULT 0, -- -1 is downvote, 0 is no vote, +1 is upvote. Logging whether upvote/downvote makes it easier to display the proper CSS
    comment_karma INT DEFAULT 1, -- Comments start with a default karma value of 1 (upvote button automatically clicked; if clicked again, karma value decrements by 1 to 0)
    comment_timeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    commenter_username VARCHAR(25) NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (comment_id),
    FOREIGN KEY (commenter_username) REFERENCES users(user_username) ON DELETE CASCADE, -- If a user is deleted, deleted all their posts
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE -- If a post is deleted, deleted the post and all of it's content
);


