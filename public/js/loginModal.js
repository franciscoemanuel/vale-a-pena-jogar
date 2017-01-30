    $(document).ready(function(){
    var loginForm = $("#loginForm");
    loginForm.submit(function(e) {
        e.preventDefault();
        var formData = loginForm.serialize();
        $('#form-erros-email').html("");
        $('#form-erros-senha').html("");
        $('#form-login-erros').html("");
        $("#email-div").removeClass("has-error");
        $("#senha-div").removeClass("has-error");
        $("#login-errors").removeClass("has-error");
        $("#login-erros").addClass('hidden');
    $.ajax({
        url: '/login',
        type: 'POST',
        data: formData,
        success: function(data) {
            $('#loginModal').modal('hide');
            console.log("success");
            location.reload(true);
        },
        error: function(data) {
            console.log(data.responseText);
            var obj = jQuery.parseJSON(data.responseText);
            if (obj.email) {
                $("#email-div").addClass("has-error");
                $('#form-erros-email').html(obj.email);
            }
            if (obj.senhaUsuario) {
                $("#password-div").addClass("has-error");
                $('#form-erros-password').html(obj.password);
            }
            if (obj.error) {
                console.log("teste");
                $("#login-erros").removeClass('hidden');
                $("#senha-div").addClass("has-error");
                $("#email-div").addClass("has-error");
                $("#login-erros").addClass("has-error");
                $('#form-login-erros').html(obj.error);
            }
        }
    });
    });
});