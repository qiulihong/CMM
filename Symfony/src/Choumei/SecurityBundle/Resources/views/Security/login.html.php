<?php //$view->extend('::layout.html.php');?>

<?php if( $error ):?>
<div class="error">
	<?php echo $error->getMessage();?>
</div>
<?php endif;?>
<form id="login_form" action=<?php echo $view['router']->generate('ChoumeiSecurityBundle_login_check'); ?> method="post">
	<label>邮箱:</label>
	<input type="text" name="_useremail" id="useremail" value="<?php echo $last_username; ?>" />
	<label>密码:</label>
	<input type="password" name="_password" id="password" />
	<?php 
	/*
	 * if you want to control the page redirected to login, do more bellow
	 * <input type="hidden" name="_target_path" value="/account" />
	*/
	?>
	<input type="submit" name="login" value="登录" />
</form>
