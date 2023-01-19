/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*****************************Nav Bar*******************************************/
$(document).ready(function () {
    // Transition effect for navbar 
    $(window).scroll(function () {
        // checks if window is scrolled more than 500px, adds/removes solid class
        if ($(this).scrollTop() > 500) {
            $('.navbar').addClass('solid');
        } else {
            $('.navbar').removeClass('solid');
        }
    });
});

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
/*****************************Sign up and Change pd page*******************************************/
// Sign up page
function signup() {
    var password = document.forms["signupForm"]["signpassword"].value;
    var confirm = document.forms["signupForm"]["signconpassword"].value;

    if (password !== confirm) {
        document.getElementById('mismatchpassword').innerHTML = 'Password not the same.';
        return false;

    }

    if (!password.match(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/)) {
        document.getElementById('mismatchpassword').innerHTML = 'Password should have at least 6 character, a number, a uppercase and a lowercase.';

        return false;
    }

}

function check() {
    var password = document.forms["signupForm"]["signpassword"].value;
    var confirm = document.forms["signupForm"]["signconpassword"].value;

    if (password === confirm) {
        document.getElementById('mismatchpassword').innerHTML = '';

    } else {
        document.getElementById('mismatchpassword').innerHTML = 'Password not the same.';

    }
}

//Account page change password
function pwdchg() {
    var password = document.forms["chgpwd"]["newpwd"].value;
    var confirm = document.forms["chgpwd"]["connewpwd"].value;

    if (password !== confirm) {
        document.getElementById('chgpwdmismatchpassword').innerHTML = 'Password not the same.';
        return false;

    }

    if (!password.match(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/)) {
        document.getElementById('chgpwdmismatchpassword').innerHTML = 'Password should have at least 6 character, a number, a uppercase and a lowercase.';

        return false;
    }

}
function pwdchgcheck() {
    var password = document.forms["chgpwd"]["newpwd"].value;
    var confirm = document.forms["chgpwd"]["connewpwd"].value;

    if (password === confirm) {
        document.getElementById('chgpwdmismatchpassword').innerHTML = '';

    } else {
        document.getElementById('chgpwdmismatchpassword').innerHTML = 'Password not the same.';

    }
}
