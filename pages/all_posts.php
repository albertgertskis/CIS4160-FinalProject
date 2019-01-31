<?php // This page shows all the posts on the submitted on the site, depending on the user's filter

// Set the timezone to New York's eastern time
date_default_timezone_set('America/New_York');

// Page title
include 'dynamic_title.php';
$pageTitle = "Posts";

include 'all_posts_header.php';

require 'reddit_connect.php'; // Connect to the DB

include 'reddit_logo.php';

// Get list of 'Reddit posts' in the database (and their comment counts), order by time created (newest > oldest)
$get_posts_query = 
    "SELECT post_id, poster_username, post_title, post_body, post_image_url, post_karma, post_voteDirection, post_timeStamp, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.post_id) AS commentCount FROM posts ORDER BY post_timeStamp DESC";
// Run the query to get list of 'Reddit posts' and store results
$run_getPosts = mysqli_query($dbc, $get_posts_query);
// Count the number of rows (number of posts in the DB) returned by the query
$post_count = mysqli_num_rows($run_getPosts);

echo '<div class="all-posts" id="post-page">';

// New post button
echo '<div id="new-post">
        <div id="new-post-section">
            <div id="new-post-button-section">
                <button type="button" class="btn btn-primary" id="new-post-button">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Create Post</span>
                </button>
            </div>
        </div>
       </div>';

//If the number of posts returned is greater than 0, display the posts
if ($post_count > 0) {
    while($reddit_post = mysqli_fetch_array($run_getPosts, MYSQLI_ASSOC)) {

        // Get the time passed since the 'Reddit post' was created
        $time_difference = time() - strtotime($reddit_post["post_timeStamp"]);
        $hours = floor($time_difference / 3600);
        $time_difference %= 3600;
        $minutes = floor($time_difference / 60);

        // If post was made less than 1 hour ago, use 'minutes' as the relative time reference
        if ($hours < 1) {
            if ($minutes == 1) {
                $timeSinceCreation = "{$minutes} minute";
            } else {
                $timeSinceCreation = "{$minutes} minutes";
            }
        } elseif ($hours == 1) {
            $timeSinceCreation = "{$hours} hour";
        } elseif ($hours > 1 and $hours < 24) { // If post was made less than 24 hours ago, use 'hours' as the relative time reference
            $timeSinceCreation = "{$hours} hours";
        } elseif ($hours >= 24 and $hours < 48) { // Otherwise, if a post was made more than 24 hours ago, use 'days' as the relative time reference
            $timeSinceCreation = '1 day';
        } elseif ($hours > 24) {
            $timeSinceCreation = $hours % 24 .' days';
        }

        // If a post has one comment, use 'comment' text next to comment count
        if ($reddit_post["commentCount"] == 1) {
            $comment_word = "Comment";
        } else { // Otherwise, if a post has 0 comments or more than 1 comment, use 'comments' text next to comment count
            $comment_word = "Comments";
        }

        // Skeleton for 'all_posts' page
        echo ' 
        <div class="post-border">
            <div id='.$reddit_post["post_id"].' class="whole-post">
                <!-- Div storing voting arrows and karma count (net votes) -->
                <div class="left-align-karma-and-vote">
                    <div class="karma-and-vote">
                        <div class="post-vote-direction">'.$reddit_post["post_voteDirection"].'</div>
                        <!-- Upvote button -->
                        <div class="upvote-button"><i class="fas fa-arrow-circle-up"></i></div>
                        <!-- Karma count -->
                        <div class="post-karma">'.$reddit_post["post_karma"].'</div>
                        <!-- Downvote button -->
                        <div class="downvote-button"><i class="fas fa-arrow-circle-down"></i></div>
                    </div>
                </div>
                <!-- Div storing post content (title, text or image, comment count) -->
                <div class="post-content" onclick="window.location.href=\'post_and_comments.php?post_id='.$reddit_post["post_id"].'\'">
                    <!-- Div for the post details (username of poster + time since post created) -->
                    <div class="post">
                        <!-- Top line of the post area (username + relative posting time) -->
                        <div class="top-of-post">
                            <!-- Username and link to user + time when post was created, relative from now (hours if < 24 hours, days if >= 24 hours) -->
                            <div class="post-creator-and-relativeTime">
                                <span class="posted-by">Posted by u/'.$reddit_post["poster_username"].'</span>
                                <!-- Username and link to user\'s page -->
                                <div class="username-link">
    <! -- LINK TO USER\'S PAGE GOES HERE -->
    <! -- Using temporary user -->   
                                </div>
                                <!-- Time passed since post created -->
                                <div class="relative-time-from-posting">
    <! -- Change this date relative to now instead of absolute date of post creation -->
                                    '.$timeSinceCreation.' ago'.'
                                </div>
                            </div>
                        </div>
                        
                        <!-- Middle of the post area (main post content) -->
                        <div class="middle-of-post">
                            <!-- Title of the post -->
                            <div class="title">
                                <span class="title-details">'.$reddit_post["post_title"].'</span>
                            </div>
                            <!-- Body of the user\'s post (part of the post that isn\'t the title -->
                            <div class="post-body">
                                <div class="post-body-details">'.
                                    (isset($reddit_post["post_image_url"]) ?
                                        // If post_image_url is not empty, use the post_image_url within the body of the post
                                        '<div class="post-body-image">
                                            <img class="post-body-image" src="'.$reddit_post["post_image_url"].'">
                                         </div>'
                                        :
                                        // Else if post_image_url is empty, use the post_body within the body of the post
                                        '<div class="post-body-text">
                                            '.$reddit_post["post_body"].'
                                        </div>'
                                    ).'
                                </div>
                            </div>
                        </div>
    
                        <!-- Bottom line of the post area (comment count) --> 
                        <div class="bottom-of-post">
                            <div class="comment-details">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                                <span class="comment-count"> 
                                    '.$reddit_post["commentCount"].' '.$comment_word.'
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
} else{ // If no 'Reddit posts' are returned by the query, print a message to the user
    echo "<div>There are currently no posts available for viewing.</div>";
}

// Close the 'all-posts' <div>
echo '</div>';

include 'reddit_footer.php';