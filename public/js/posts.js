$(document).ready(function () {
    var posts = {
        title : $("#titlePost"),
        story : $("#storyPost"),
        titleValidation : function () {
            if (this.title.val() < 1){
                $("#errTitle").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                    "  <strong>Please enter the title!</strong>" +
                    "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                    "    <span aria-hidden=\"true\">&times;</span>\n" +
                    "  </button>\n" +
                    "</div>");
                return false;
            }
            else {
                return true;
            }
        },

        storyValidator : function () {
            if (this.story.val() < 1){
                $("#errStory").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                    "  <strong>Please enter the story!</strong>" +
                    "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                    "    <span aria-hidden=\"true\">&times;</span>\n" +
                    "  </button>\n" +
                    "</div>");
                return false;
            }
            else {
                return true;
            }
        }
    };


    $('#story_form').submit(function (e) {
        if (!posts.titleValidation()){
            e.preventDefault();
        }
        if (!posts.storyValidator()){
            e.preventDefault();
        }
        return true;
    })

});