var loggedIn = false;

$(function() {
    var tests = {
        user: function (val) {
            return val.length > 3 &&
                   val.length <= 16 &&
                   /^[0-9A-Za-z_-][0-9A-Za-z_.-]*[0-9A-Za-z_-]$/.test(val);
        },

        email: function (val) {
            return /^(?:\w+\.?)*\w+@(?:\w+\.)+\w+$/.test(val);
        },
          
        minLength: function (val, length) {
            return val.length >= length;
        },
          
        maxLength: function (val, length) {
            return val.length <= length;
        },
          
        equal: function (val1, val2) {
            return (val1 == val2);
        }
    };

    $('#login_form').isHappy({
        fields: {
            '#username': {
                required: true
            },
            '#password': {
                required: true
            }
        }
    });

    $('#registration_form').isHappy({
        fields: {
            '#reg_username': {
                required: true,
                test: tests.user
            },
            '#reg_password': {
                required: true
            },
            '#reg_password_2': {
                required: true,
                test: tests.equal,
                arg: function () {
                    return $('#reg_password').val();
                }
            },
            '#reg_email': {
                required: true,
                test: tests.email
            }
        }
    });



    // Navigation forms
    var dropdown = $('.nav-extra-dropdown');

    $('.nav-extra').each(function() {
        if ($(this).parent().hasClass('active')) {
            if ($(this).hasClass('nav-extra-login'))
                $('#nav-extra-login').slideDown(200);
            else
                $('#nav-extra-register').slideDown(200);
            bindCloseNotifications();
            return false;
        }
    });

    $('.nav-extra').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        if (($(this).hasClass('nav-extra-login') && $('#nav-extra-login').is(":visible")) ||
            $(this).hasClass('nav-extra-register') && $('#nav-extra-register').is(":visible")) {
            closeNotifications();
            return false;
        }
        dropdown.slideUp(200);

        if ($(this).hasClass('nav-extra-login'))
            $('#nav-extra-login').slideDown(200);
        else
            $('#nav-extra-register').slideDown(200);
        $(this).parent().addClass('active');

        bindCloseNotifications();
    });

    function bindCloseNotifications() {
        $(document).bind('click.extra-hide', function(e) {
            if ($(e.target).closest('.nav-extra-dropdown').length != 0 && $(e.target).not('.nav-extra')) return true;
            closeNotifications();
        });
    }

    function closeNotifications() {
        dropdown.slideUp(200);
        $('.nav-extra').parent().removeClass('active');
        $('.nav-extra-dropdown .msg').remove();
    }
});