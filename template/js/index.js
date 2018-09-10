/**
 * Created by 4epa9 on 14.10.2017.
 */
document.getElementById('form-text').innerHTML = 'Авторизация <i class="fa fa-sign-in"></i>';

$('.toggle').click(function(){
    if(document.getElementById('form-text').innerHTML == 'Регистрация <i class="fa fa-pencil"></i>'){
        document.getElementById('form-text').innerHTML = 'Авторизация <i class="fa fa-sign-in"></i>';
    }
    else document.getElementById('form-text').innerHTML = 'Регистрация <i class="fa fa-pencil"></i>';
    // Switches the Icon
    $(this).children('i').toggleClass('fa-pencil');
    // Switches the forms
    $('.form').animate({
        height: "toggle",
        'padding-top': 'toggle',
        'padding-bottom': 'toggle',
        opacity: "toggle"
    }, "slow");
});