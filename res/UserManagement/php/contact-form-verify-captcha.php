<?php
session_start();
session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));

header('Content-type: application/json');

if (strtolower($_POST["captcha"]) == strtolower($_SESSION['captchaCode'])) {
	$arrResult = array ('response'=>'success');
} else {
	$arrResult = array ('response'=>'error', 'code'=>strtolower($_SESSION['captchaCode']));
}

echo json_encode($arrResult);
?>