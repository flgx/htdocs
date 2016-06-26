<?php

Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[\pL\sáàâãÁÀÂÃÍÌÎíìîéèêÉÈÊóòôõÓÒÔÕúùûÚÙÛñÑäëïöüÄËÏÖÜçÇ]+$/u', $value);
});

Validator::extend('alpha_num_spaces', function($attribute, $value)
{
    return preg_match('/^[a-zA-Z0-9\sáàâãÁÀÂÃÍÌÎíìîéèêÉÈÊóòôõÓÒÔÕúùûÚÙÛñÑäëïöüÄËÏÖÜçÇ]+$/', $value);
});

Validator::extend('double', function($attribute, $value)
{
    return preg_match('/^-?(?:\d+|\d*\.\d+)$/', $value);
});

Validator::extend('code', function($attribute, $value)
{
    return preg_match('/^[a-zA-Z0-9\s\/\-_.]+$/', $value);
});

Validator::extend('phone', function($attribute, $value)
{
	return preg_match('/^[0-9\s\/\-_.\(\)\+]+$/', $value);
});

Validator::extend('file_extension', function($attribute, $value, $parameters) 
{
	if ( ! $value instanceof Symfony\Component\HttpFoundation\File\UploadedFile)
	{
		return false;
	}

	if ($value instanceof UploadedFile && ! $value->isValid())
	{
		return false;
	}

	// The Symfony File class should do a decent job of guessing the extension
	// based on the true MIME type so we'll just loop through the array of
	// extensions and compare it to the guessed extension of the files.
	if ($value->getPath() != '')
	{
		return in_array($value->getClientOriginalExtension(), $parameters);
	}
	else
	{
		return false;
	}
});

Validator::replacer('file_extension', function($message, $attribute, $rule, $parameters)
{
    return str_replace(':values', implode(', ', $parameters), $message);
});