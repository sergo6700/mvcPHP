$(document).ready(function () {



    var logReg = {
        loginEmail : $("#loginEmail"),
        pass : $('#loginPass'),
        //registration form variables
        full_name : $('#name'),
        upload     : $('#inputGroupFile01'),
        regEmail      : $('#email'),
        phone      : $('#phone'),
        password1  : $('#pass'),
        password2  : $('#pass2'),
        validateEmailLogin : function () {
            if (this.loginEmail.val().length < 1) {
                $('#logEmailErr').html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                    "  <strong>The field email is requared!</strong>" +
                    "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                    "    <span aria-hidden=\"true\">&times;</span>\n" +
                    "  </button>\n" +
                    "</div>");
                return false;
            } else {
                // var regEx = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)(?!yahoo.co.in)(?!aol.com)(?!abc.com)(?!xyz.com)(?!pqr.com)(?!rediffmail.com)(?!live.com)(?!outlook.com)(?!me.com)(?!msn.com)(?!ymail.com)([\w-]+\.)+[\w-]{2,4})?$/;
                var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var validEmail = regEx.test(logReg.loginEmail.val());
                if (!validEmail) {
                    $('#logEmailErr').html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                        "  <strong>Please enter the valid email!</strong>" +
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
        },

        validatePassLogin : function () {
            if (this.pass.val().length < 8) {
                $('#logPassErr').html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                    "  <strong>Password is wrong!</strong>" +
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

        //registration form validation
        nameValidation : function () {
            if (this.full_name.val().length < 1) {
                $('#nameerr').html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                    "  <strong>The field name is requared</strong>" +
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

        uploadFileValidation : function () {
            if (this.upload.val().length < 1) {
                $('#uploaderr').html("<div class=\"alert alert-danger alert-dismissible fade show mt-3\" role=\"alert\">\n" +
                    "  <strong>Please upload the image!</strong>" +
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

        phoneValidation : function () {
            if (this.phone.val().length < 1) {
                $('#phoneerr').html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                    "  <strong>The field phone is requared!</strong>" +
                    "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                    "    <span aria-hidden=\"true\">&times;</span>\n" +
                    "  </button>\n" +
                    "</div>");
                return false
            }
            else {
                return true;
            }
        },

        regEmailValidation : function () {
            if (this.regEmail.val().length < 1) {
                $('#emailerr').html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                    "  <strong>The field email is requared!</strong>" +
                    "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                    "    <span aria-hidden=\"true\">&times;</span>\n" +
                    "  </button>\n" +
                    "</div>");
                return false;
            } else {
                // var regEx = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)(?!yahoo.co.in)(?!aol.com)(?!abc.com)(?!xyz.com)(?!pqr.com)(?!rediffmail.com)(?!live.com)(?!outlook.com)(?!me.com)(?!msn.com)(?!ymail.com)([\w-]+\.)+[\w-]{2,4})?$/;
                var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var validEmail = regEx.test(this.regEmail.val());
                if (!validEmail) {
                    $('#emailerr').html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                        "  <strong>Please enter the valid email!</strong>" +
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
        },

        regPasswordValidation : function () {

            if ( this.password1.val() != this.password2.val() || this.password1.val().length < 8 || this.password2.val().length < 8) {
                $('#passerr').html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                    "  <strong>Password wrong!</strong>" +
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
    $('#login_form').submit(function (e) {
       if (!logReg.validateEmailLogin()){
           e.preventDefault();
       }
       if ( !logReg.validatePassLogin()){
           e.preventDefault();
       }
       return true;
    });

    $('#reg_form').submit(function(e) {
        if (!logReg.nameValidation()){
            e.preventDefault();
        }
        if (!logReg.uploadFileValidation()){
            e.preventDefault();
        }
        if (!logReg.phoneValidation()){
            e.preventDefault();
        }
        if (!logReg.regEmailValidation()){
            e.preventDefault();
        }
        if (!logReg.regPasswordValidation()){
            e.preventDefault();
        }
        return true;
    });

});
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});