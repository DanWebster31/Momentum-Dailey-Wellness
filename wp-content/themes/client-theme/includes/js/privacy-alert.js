/*******************
PRIVACY ALERT
*******************/
var currdomain = document.domain;
currdomain = currdomain.replace(/^(?:https?:\/\/)?(?:www\.)?/i, "").split('/')[0];
console.log(currdomain);

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires+'; domain=' + currdomain +';path=/';
}

function getCookie(c_name) {
    var c_value = document.cookie,
        c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1) c_start = c_value.indexOf(c_name + "=");
    if (c_start == -1) {
        c_value = null;
    } else {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1) {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
}

$('#privacy-policy-agree').on ('click', function () {
    setCookie('privacyalert', '999', 365);
    var $privacyBar = $('#privacy-alert');
    $privacyBar.slideUp(300);
    $('footer .footer-content').animate({ 'marginBottom': 0 }, 300);
});

$(window).on('load', function(){
    var acookie = getCookie("privacyalert");
    if (!acookie) {
      var $winWidth = $(window).width();
      var $privacyBar = $('#privacy-alert');
      $privacyBar.slideDown (function () {
        var $privacyBarHeight = $($privacyBar).outerHeight();
        $('footer .footer-content').animate({ 'marginBottom': $privacyBarHeight }, 300);
      });

    }
});

$(window).on('resize orientationchange', function(){
    var acookie = getCookie("privacyalert");
    if (!acookie) {
        var $privacyBar = $('#privacy-alert');
        var $privacyBarHeight = $($privacyBar).outerHeight();
        $('footer .footer-content').animate({ 'marginBottom': $privacyBarHeight }, 0);
    }
});
