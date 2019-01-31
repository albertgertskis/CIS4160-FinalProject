<?php

include 'dynamic_title.php';
$pageTitle = "Posts";

include 'all_posts_header.php';
// Connect to the DB
require 'reddit_connect.php';


// Get list of 'Reddit posts' in the database (and their comment counts), order by time created (newest > oldest)
$get_posts_query =
    "SELECT post_id, poster_username, post_title, post_body, post_image_url, post_karma, post_timeStamp, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.post_id) AS commentCount FROM posts ORDER BY post_timeStamp DESC";
// Run the query to get list of 'Reddit posts' and store results
$run_getPosts = mysqli_query($dbc, $get_posts_query);
// Count the number of rows (number of posts in the DB) returned by the query
$post_count = mysqli_num_rows($run_getPosts);

if ($post_count > 0) {
    // Set the timezone to New York's eastern time
    date_default_timezone_set('America/New_York');
    while($reddit_post = mysqli_fetch_array($run_getPosts, MYSQLI_ASSOC)) {

        echo '<p>'.strtotime($reddit_post["post_timeStamp"]);
        echo ' --> '.$reddit_post["post_timeStamp"];
        $time_difference = time() - strtotime($reddit_post["post_timeStamp"]);
        echo '--> '.$time_difference;
        $hours = floor($time_difference / 3600);
        $time_difference %= 3600;
        $minutes = floor($time_difference / 60);

        echo " --> {$hours} hours and {$minutes} minutes ago</p>";
    }
} else{ // If no 'Reddit posts' are returned by the query, print a message to the user
    echo "<div>There are currently no posts available for viewing.</div>";
}

// Close the 'all-posts' <div>
echo '</div>';

include 'reddit_footer.php';