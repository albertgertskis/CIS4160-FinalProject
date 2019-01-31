<?php // This page shows the whole post and the comments associated with that post

// Set the timezone to New York's eastern time
date_default_timezone_set('America/New_York');

// Connect to the DB
require 'reddit_connect.php';

// Page title
include 'dynamic_title.php';

// post_id in current URL
$post_id = $_GET['post_id'];

// Check if the post_id in the URL exists in the database
$check_post_id_query = "SELECT post_id FROM posts WHERE post_id = $post_id";
$run_checkPostId = mysqli_query($dbc, $check_post_id_query);

include 'reddit_logo.php';

// If post_id exists in the database and is numeric, display the post's content and its comments
if((mysqli_num_rows($run_checkPostId) > 0) && (is_numeric($_GET['post_id']))) {
    // Get the page title based on the post_title of the current post_id
    $get_page_title_query = "SELECT post_title FROM posts WHERE post_id = $post_id";
    $run_getPageTitle = mysqli_query($dbc, $get_page_title_query);
    $page_title = mysqli_fetch_array($run_getPageTitle, MYSQLI_ASSOC);
    $page_title = $page_title["post_title"];
    $pageTitle = $page_title;

    include 'post_and_comments_header.php';

    // Get the post's content
    $get_post_content_query = "SELECT post_id, poster_username, post_title, post_body, post_image_url, post_voteDirection, post_karma, post_timeStamp, (SELECT COUNT(*) FROM comments WHERE comments.post_id = $post_id) AS commentCount FROM posts WHERE post_id = $post_id";
    $run_getPostContent = mysqli_query($dbc, $get_post_content_query);

    echo '<div class="whole-post" id="post-and-comments-page">';
    while($reddit_post = mysqli_fetch_array($run_getPostContent, MYSQLI_ASSOC)) {

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
            $comment_description = $reddit_post["commentCount"] . " Comment";
        } else if ($reddit_post["commentCount"] == 0) { // If a post has 0 comments 
            $comment_description = 'Comment';
        } else { // Otherwise, if a post more than 1 comment, use 'comments' text next to comment count
            $comment_description = $reddit_post["commentCount"] . " Comments";
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
                <div class="post-content">
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
                                            <img class="post-body-image" src="'.$reddit_post["post_image_url"].'" onclick="window.open(\''.$reddit_post["post_image_url"].'\')"
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
                                    '.$comment_description.'
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }

    // Get the posts's comments
    $get_post_comments_query = "SELECT * FROM comments WHERE comments.post_id = $post_id";
    $run_getPostComments = mysqli_query($dbc, $get_post_comments_query);

    // If the post contains comments
    if (mysqli_num_rows($run_getPostComments) > 0){
        $post_comments = mysqli_fetch_array($run_getPostComments, MYSQLI_ASSOC);
    } else { // Otherwise, if the post does not contain any comments, display so to the user
        echo '<div class="comments">
                <div class="no-comments-message">
                    <p id="no-comments">No Comments Yet</p>
                    <p id="first-to-share">Be the first to share what you think!</p>
                </div>
              </div>';
    }
    
    // Close the <div> representing the whole page (<div class="whole-post" id="post-and-comments-page">)
    echo "</div>"; 


} else { // The post_id is not valid and the page does not exist
    $pageTitle = "page not found";

    include 'post_and_comments_header.php';

    // Display an error message to the user
    echo '<div class="error-page-content">
            <div id="reddit-error" class="error-page-content">
                <img src="../images/reddit404.png" class="reddit-error-image" alt="Reddit error image - page not found">
                <h1>page not found</h1>
                <div class="reddit-error-message">
                    <p>the page you requested does not exist</p>
                </div>
            </div>
          </div>';
}


// Get list of 'Reddit comments' in the database, order by karma (most popular > least popular). For comments with the same karma amount, order by date (oldest > newest)
// $get_comments_query =








include 'reddit_footer.php';