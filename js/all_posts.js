$(document).ready(function () {
    $(".post-border").hover(
        // When mouse hovers over a 'Reddit post' element
        function() {
            // Highlight the border of that 'Reddit post' with a darker color
            $(this).css("border", "1px solid rgb(135, 138, 140)");
        },
        // When mouse is moved off of a 'Reddit post' element
        function() {
            // Change the color of the border of that 'Reddit post' back to its original color
            $(this).css("border", "1px solid rgb(204, 204, 204)");
    });
});