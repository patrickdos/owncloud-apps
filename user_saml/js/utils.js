(function() {
	var saml = document.createElement('script');
	saml.type = 'text/javascript';
	(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(saml);
})();

$(document).ready(function(){
	$('<div id="login-saml"></div>').css({'text-align': 'center',}).appendTo('form');

	var loginMsg = t("user_saml","Log in with your eduID account");
	$('#user').parent().remove();
	$('#password').parent().remove();
	$('#remember_login').parent().remove();
	$('#remember_login+label').parent().remove();
	$('#submit').remove();

	$('<a id="login-saml-action" href="simplesamlphp/module.php/core/as_login.php?AuthId=default-sp&ReturnTo=https://'+escapeHTML(document.domain)+'?app=user_saml" ></a>').css(
	{
		'text-decoration': 'none'
	}).appendTo('#login-saml');

	$('<p></p>').css(
	{
		'text-align': 'center',
		'font-weight': 'bolder',
		'font-size' : '110%',
		'color' : '#fafaff'
	}).appendTo('#login-saml').text(loginMsg);

	$('<img id="login-saml-img" src="' + OC.imagePath('user_saml', 'eduid.png') + '" title="'+ loginMsg +'" alt="'+ loginMsg +'" />').css(
	{
		'cursor' : 'pointer',
		'border' : '3px solid #777',
		'border-radius' : '15px',
		'-moz-border-radius' : '15px'
	}).appendTo('#login-saml-action');

	var termsLink = '<a href="https://du.cesnet.cz/wiki/doku.php/cs/provozni_pravidla"> '+escapeHTML(t('user_saml','terms of use'))+'</a>'
	var legalNotice = t("user_saml", "By logging in you agree with")+termsLink;
	$('<p class="info"></p>').appendTo('#login-saml').html(legalNotice);
});
