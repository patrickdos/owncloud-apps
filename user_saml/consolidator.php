<?php

/**
 * ownCloud - Documents App
 *
 * @author Victor Dubiniuk
 * @copyright 2013 Victor Dubiniuk victor.dubiniuk@gmail.com
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 */


\OCP\JSON::checkAppEnabled('user_saml');

if ($_POST) {
        // CSRF check
        OCP\JSON::callCheck();
	
	if (isset($_POST['continue'])) {
		$secure_cookie = OC_Config::getValue("forcessl", false);
                $expires = time() + OC_Config::getValue('remember_login_cookie_lifetime', 60*60*24*15);
		setcookie("oc_consolidated", true, $expires, \OC::$WEBROOT.'/', '', $secure_cookie);
		header('Location: '. OCP\Util::linkToAbsolute('simplesamlphp',
			'module.php/core/as_login.php?AuthId=default-sp&ReturnTo=').
			OCP\Util::linkToAbsolute('index.php','').'?app=user_saml');
        	exit();
	}
	if (isset($_POST['back'])) {
		OCP\User::logout();
		exit();
	}
}

if (isset($_GET['t'])) {
	$accountsStr = '';
	$accounts = array();
	if($accountsStr = base64_decode($_GET['t'])) {
		\OCP\Util::addStyle('user_saml', 'consolidator');
		\OCP\Util::addScript('user_saml', 'consolidator');
		parse_str($accountsStr, $accounts);
		$tmpl = new \OCP\Template('user_saml', 'consolidator', 'guest');
		$tmpl->assign('accounts', $accounts);
		$tmpl->printPage();
		exit();
	}
}

header('HTTP/1.0 404 Not Found');
$tmpl = new OCP\Template('', '404', 'guest');
$tmpl->printPage();
