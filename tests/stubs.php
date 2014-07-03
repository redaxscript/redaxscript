<?php

/* check alias */

function check_alias($input = '', $mode = '')
{
	$aliasDefault = array(
		'admin',
		'loader',
		'login',
		'logout',
		'password_reset',
		'scripts',
		'styles',
		'registration',
		'reminder'
	);

	/* check if default */

	if (in_array($input, $aliasDefault))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

/* hook */

function hook($input = '')
{
	return null;
}