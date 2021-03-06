<?php
namespace Redaxscript\Validator;

use function preg_match;

/**
 * children class to validate user
 *
 * @since 4.3.0
 *
 * @package Redaxscript
 * @category Validator
 * @author Henry Ruhs
 */

class User implements ValidatorInterface
{
	/**
	 * pattern for user
	 *
	 * @var string
	 */

	protected $_pattern = '^[a-zA-Z0-9\._-]{3,100}$';

	/**
	 * get the pattern
	 *
	 * @since 4.3.0
	 *
	 * @return string
	 */

	public function getPattern() : string
	{
		return $this->_pattern;
	}

	/**
	 * validate the user
	 *
	 * @since 4.0.0
	 *
	 * @param string $user user to be validated
	 *
	 * @return bool
	 */

	public function validate(string $user = null) : bool
	{
		return preg_match('/' . $this->_pattern . '/', $user);
	}
}
