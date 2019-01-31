$(document).ready(function () {
    // Event listeners for upvote and downvote buttons
    var upvoteButtons = document.getElementsByClassName("upvote-button");
    var downvoteButtons = document.getElementsByClassName("downvote-button");

    for (var i = 0; i < upvoteButtons.length; i++) {

        /******************** HOVERING ********************/
        // If the upvote button is moused over
        upvoteButtons[i].addEventListener("mouseover", function(event) {
            // If upvote button is black
            if ($(this).children(":first").css("color") == "rgb(33, 37, 41)") {
                $(this).children(":first").css("color", "rgb(204, 55, 0)");
            }
        })
        // If mouse leaves hover area of upvote button
        upvoteButtons[i].addEventListener("mouseout", function() {
            // If upvote button is hover color
            if ($(this).children(":first").css("color") == "rgb(204, 55, 0)") {
                $(this).children(":first").css("color", "rgb(33, 37, 41)");
            }
        })
        // If the downvote button is moused over
        downvoteButtons[i].addEventListener("mouseover", function() {
            // If downvote button is black
            if ($(this).children(":first").css("color") == "rgb(33, 37, 41)") {
                $(this).children(":first").css("color", "rgb(90, 117, 204)");
            }
        })
        // If mouse leaves hover area of downvote button
        downvoteButtons[i].addEventListener("mouseout", function() {
            // If downvote button is hover color
            if ($(this).children(":first").css("color") == "rgb(90, 117, 204)") {
                $(this).children(":first").css("color", "rgb(33, 37, 41)");
            }
        })
    
        /******************** CLICKING ********************/
        /******************** UPVOTE ********************/
        upvoteButtons[i].addEventListener("click", function(event) {
            // If the upvote button is black and karma count is black (post-vote-direction == 0)
            if ($(this).children(":first").css("color") == "rgb(33, 37, 41)" && $(this).next('div').css("color") == "rgb(33, 37, 41)") {
                // Make the upvote button clicked color
                $(this).children(":first").css("color", "rgb(255, 69, 0)");
                // Make the karma count upvote clicked color
                $(this).next('div').css("color", "rgb(255, 69, 0)");
                // Add 1 to the karma count
                $(this).next('div').text(parseInt($(this).next('div').text()) + 1);
                // Change the post-vote-direction to 1
                $(this).prev('div').text(1);

                // Send the new post-vote-direction and karma count to the server which then sends it to the database
                if (parseInt($(this).prev('div').text()) == 1) {
                    $.ajax({
                        type: "POST",
                        url: "post_vote_update.php",
                        data: ({
                            "post_id": $(this).parent().parent().parent().attr("id"),
                            "post_vote_direction": parseInt($(this).prev('div').text()),
                            "post_karma": parseInt($(this).next('div').text()),
                        })
                    });
                }
            }

            // If the upvote button is upvote hover color and the karma count is black (post-vote-direction == 0)
            if ($(this).children(":first").css("color") == "rgb(204, 55, 0)" && $(this).next('div').css("color") == "rgb(33, 37, 41)") {
                // Make the upvote button clicked color
                $(this).children(":first").css("color", "rgb(255, 69, 0)");
                // Make the karma count upvote clicked color
                $(this).next('div').css("color", "rgb(255, 69, 0)");
                // Add 1 to the karma count
                $(this).next('div').text(parseInt($(this).next('div').text()) + 1);
                // Change the post-vote-direction to 1
                $(this).prev('div').text(1);

                // Send the new post-vote-direction and karma count to the server which then sends it to the database
                if (parseInt($(this).prev('div').text()) == 1) {
                    $.ajax({
                        type: "POST",
                        url: "post_vote_update.php",
                        data: ({
                            "post_id": $(this).parent().parent().parent().attr("id"),
                            "post_vote_direction": parseInt($(this).prev('div').text()),
                            "post_karma": parseInt($(this).next('div').text()),
                        })
                    });
                }

            }
            // If the upvote button is upvote hover color and the karma count is downvote button clicked color (post-vote-direction == -1)
            else if ($(this).children(":first").css("color") == "rgb(204, 55, 0)" && $(this).next('div').css("color") == "rgb(113, 147, 255)") {
                // Make the upvote button upvote clicked color
                $(this).children(":first").css("color", "rgb(255, 69, 0)");
                // Make the karma count upvote clicked color
                $(this).next('div').css("color", "rgb(255, 69, 0)");
                // Change the post-vote-direction to 1
                $(this).prev('div').text(1);
                // Add 2 to the karma count
                $(this).next('div').text(parseInt($(this).next('div').text()) + 2);
                // Make the downvote button its default black color
                $(this).next('div').next('div').children(":first").css("color", "rgb(33, 37, 41)");

                // Send the new post-vote-direction and karma count to the server which then sends it to the database
                if (parseInt($(this).prev('div').text()) == 1) {
                    $.ajax({
                        type: "POST",
                        url: "post_vote_update.php",
                        data: ({
                            "post_id": $(this).parent().parent().parent().attr("id"),
                            "post_vote_direction": parseInt($(this).prev('div').text()),
                            "post_karma": parseInt($(this).next('div').text()),
                        })
                    });
                }
            } 

            // If the upvote button is upvote clicked color and karma count is upvote button clicked color (post-vote-direction == 1)
            else if ($(this).children(":first").css("color") == "rgb(255, 69, 0)" && $(this).next('div').css("color") == "rgb(255, 69, 0)") {
                // Make the upvote button its default black color
                $(this).children(":first").css("color", "rgb(33, 37, 41)");
                // Make the karma count its default black color
                $(this).next('div').css("color", "rgb(33, 37, 41)");
                // Subtract 1 from the karma count
                $(this).next('div').text(parseInt($(this).next('div').text()) - 1);
                // Change the post-vote-direction to 0
                $(this).prev('div').text(0);

                // Send the new post-vote-direction and karma count to the server which then sends it to the database
                if (parseInt($(this).prev('div').text()) == 0) {
                    $.ajax({
                        type: "POST",
                        url: "post_vote_update.php",
                        data: ({
                            "post_id": $(this).parent().parent().parent().attr("id"),
                            "post_vote_direction": parseInt($(this).prev('div').text()),
                            "post_karma": parseInt($(this).next('div').text()),
                        })
                    });
                }
            }
        })

        /******************** DOWNVOTE ********************/
        downvoteButtons[i].addEventListener("click", function(event) {
            // If the downvote button is black and karma count is black (post-vote-direction == 0)
            if ($(this).children(":first").css("color") == "rgb(33, 37, 41)" && $(this).prev('div').css("color") == "rgb(33, 37, 41)") {
                // Make the downvote button clicked color
                $(this).children(":first").css("color", "rgb(113, 147, 255)");
                // Make the karma count downvote clicked color
                $(this).prev('div').css("color", "rgb(113, 147, 255)");
                // Subtract 1 from the karma count
                $(this).prev('div').text(parseInt($(this).prev('div').text()) - 1);
                // Change the post-vote-direction to -1
                $(this).prev('div').prev('div').prev('div').text(-1);
                
                // Send the new post-vote-direction and karma count to the server which then sends it to the database
                if (parseInt($(this).prev('div').prev('div').prev('div').text()) == -1) {
                    $.ajax({
                        type: "POST",
                        url: "post_vote_update.php",
                        data: ({
                            "post_id": $(this).parent().parent().parent().attr("id"),
                            "post_vote_direction": parseInt($(this).prev('div').prev('div').prev('div').text()),
                            "post_karma": parseInt($(this).prev('div').text()),
                        })
                    });
                }
            }

            // If the downvote button is downvote hover color and the karma count is black (post-vote-direction == 0)
            if ($(this).children(":first").css("color") == "rgb(90, 117, 204)" && $(this).prev('div').css("color") == "rgb(33, 37, 41)") {
                // Make the downvote button clicked color
                $(this).children(":first").css("color", "rgb(113, 147, 255)");
                // Make the karma count downvote clicked color
                $(this).prev('div').css("color", "rgb(113, 147, 255)");
                // Subtract 1 from the karma count
                $(this).prev('div').text(parseInt($(this).prev('div').text()) - 1);
                // Change the post-vote-direction to -1
                $(this).prev('div').prev('div').prev('div').text(-1);

                // Send the new post-vote-direction and karma count to the server which then sends it to the database
                if (parseInt($(this).prev('div').prev('div').prev('div').text()) == -1) {
                    $.ajax({
                        type: "POST",
                        url: "post_vote_update.php",
                        data: ({
                            "post_id": $(this).parent().parent().parent().attr("id"),
                            "post_vote_direction": parseInt($(this).prev('div').prev('div').prev('div').text()),
                            "post_karma": parseInt($(this).prev('div').text()),
                        })
                    });
                }
            }

            // If the downvote button is downvote clicked color and the karma count is downvote button clicked color (post-vote-direction == -1)
            else if ($(this).children(":first").css("color") == "rgb(113, 147, 255)" && $(this).prev('div').css("color") == "rgb(113, 147, 255)") {
                // Make the downvote button its default black color
                $(this).children(":first").css("color", "rgb(33, 37, 41)");
                // Make the karma count its default black color
                $(this).prev('div').css("color", "rgb(33, 37, 41)");
                // Subtract 1 from the karma count
                $(this).prev('div').text(parseInt($(this).prev('div').text()) + 1);
                // Change the post-vote-direction to 0
                $(this).prev('div').prev('div').prev('div').text(0);

                // Send the new post-vote-direction and karma count to the server which then sends it to the database
                if (parseInt($(this).prev('div').prev('div').prev('div').text()) == 0) {
                    $.ajax({
                        type: "POST",
                        url: "post_vote_update.php",
                        data: ({
                            "post_id": $(this).parent().parent().parent().attr("id"),
                            "post_vote_direction": parseInt($(this).prev('div').prev('div').prev('div').text()),
                            "post_karma": parseInt($(this).prev('div').text()),
                        })
                    });
                }
            } 

            // If the downvote button is downvote hover color and karma count is upvote button clicked color (post-vote-direction == 1)
            else if ($(this).children(":first").css("color") == "rgb(90, 117, 204)" && $(this).prev('div').css("color") == "rgb(255, 69, 0)") {
                // Make the downvote button its downvote button clicked color
                $(this).children(":first").css("color", "rgb(113, 147, 255)");
                // Make the karma count its downvote button clicked color
                $(this).prev('div').css("color", "rgb(113, 147, 255)");
                // Change the post-vote-direction to -1
                $(this).prev('div').prev('div').prev('div').text(-1);
                // Subtract 2 from the karma count
                $(this).prev('div').text(parseInt($(this).prev('div').text()) - 2);
                // Make the upvote button its default black color
                $(this).prev('div').prev('div').children(":first").css("color", "rgb(33, 37, 41)");

                // Send the new post-vote-direction and karma count to the server which then sends it to the database
                if (parseInt($(this).prev('div').prev('div').prev('div').text()) == -1) {
                    $.ajax({
                        type: "POST",
                        url: "post_vote_update.php",
                        data: ({
                            "post_id": $(this).parent().parent().parent().attr("id"),
                            "post_vote_direction": parseInt($(this).prev('div').prev('div').prev('div').text()),
                            "post_karma": parseInt($(this).prev('div').text()),
                        })
                    });
                }
            }
        });
    }
});