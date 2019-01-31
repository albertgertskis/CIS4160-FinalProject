<?php

// Connect to the DB
require('reddit_connect.php');

// Store the post's new information
$post_id = $_POST['post_id'];
$post_vote_direction = $_POST['post_vote_direction'];
$post_karma = $_POST['post_karma'];

// Update the values in the database
$query_updatePost = "UPDATE posts SET post_voteDirection = $post_vote_direction, post_karma = $post_karma WHERE post_id = $post_id";

// Run the 'updatePost' query
$run_updatePost = mysqli_query($dbc, $query_updatePost);

// Close the connection to the database
mysqli_close($dbc);


