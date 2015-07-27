<?php
add_action('login_footer','mail_login_link');
function mail_login_link() { 
	echo '<p style="width: 30px; margin: auto; padding-top: 10px;"><a class="button" style="color: #999; margin-left: 24px;" href="'.get_template_directory_uri().'/mail-login.php">通过邮件验证身份登录</a></p>';
}

function mail_login_access_check($hash){
	$email = generrate_access_token($hash,$operation='DECODE');
	if ($email != '') login_required($email);
    wp_die('认证失败！', 'Authorization Not Allowed | '.get_option('blogname'), array('response' => '403'));
}

function login_required($user_email){
	if (is_user_logged_in()) return;
	if ($user = get_user_by('email',$user_email)) {
		wp_set_current_user($user->ID);
		wp_set_auth_cookie($user->ID);
		do_action('wp_login', $user->user_login);
		$redirect_to=home_url();
		wp_safe_redirect($redirect_to);
		exit();
	}
}

function send_mail_login_token($email){
	if (get_user_by('email',$email)) {
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
		$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
		$subject = '[' . $blogname . '] 后台登录授权申请';
		$message = '如果您确定该申请，请点击链接授权：';
		$message .= mail_login_access_link($email);
		$headers[] = 'From: "'.$blogname.'" <'.$wp_email.">";
		$headers[] = 'Content-Type: text/plain; charset="UTF-8"';
		wp_mail( $email, $subject, $message, $headers );
		wp_die('邮件已发送！', '后台登录授权申请 | '.get_option('blogname'), array('response' => '200'));
	}
	wp_die('拒绝访问！', '后台登录授权申请 | '.get_option('blogname'), array('response' => '403'));
}

function mail_login_access_link($email){
	$authkey=generrate_access_token($email,$operation='ENCODE');
	return get_template_directory_uri().'/mail-login.php?hash='.$authkey;
}

function generrate_access_token($string, $operation = 'ENCODE', $key = 'Mail-Login-Key', $expiry = 600) {
	$hash = md5(time().rand()).md5($string.rand());
	if($operation == 'DECODE') { 
		if($result = wp_cache_get($key.'_'.$string, 'loper_cache')){
			wp_cache_delete($key.'_'.$string, 'loper_cache');
			return $result;
		}else{
			return '';
		}
	} else { 
		  wp_cache_set($key.'_'.$hash, $string, 'loper_cache', $expiry);
		  return $hash;
	}
}
?>
