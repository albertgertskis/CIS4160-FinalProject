$(document).ready(function() {
    $(".post-vote-direction").each(function() {
        post_vote_direction = parseInt($(this).text());
        // If the post vote direction is 1 (it has been upvoted)
        if (post_vote_direction == 1) {
            // Set the upvote button color to upvote button clicked color
            $(this).next('div').children(":first").css("color", "rgb(255, 69, 0)");
            // Set the karma count color to upvote button clicked color
            $(this).next('div').next('div').css("color", "rgb(255, 69, 0)");
        }
        // If the post vote direction is -1 (it has been downvoted)
        else if (post_vote_direction == -1) {
            // Set the upvote button color to upvote button clicked color
            $(this).next('div').next('div').next('div').children(":first").css("color", "rgb(113, 147, 255)");
            // Set the karma count color to upvote button clicked color
            $(this).next('div').next('div').css("color", "rgb(113, 147, 255)");
        }
    })
});