<?php

/**
 * The Captcha class provides a simple CAPTCHA task to ensure that users are human
 *
 * @since 2.0.0
 *
 * @package Redaxscript
 * @category Captcha
 * @author Henry Ruhs
 */

class Redaxscript_Captcha
{
	/**
	 * task to be solved
	 *
	 * @var string
	 */

	private $_task;

	/**
	 * solution to the task
	 *
	 * @var string
	 */

	private $_solution;

	/**
	 * allowable range of values for the task
	 *
	 * @var array
	 */

	protected $_range = array(
		'min' => 1,
		'max' => 10
	);

	/**
	 * list of mathematical operators used for the task
	 *
	 * @var array
	 */

	protected $_operators = array(
		1 => 'plus',
		-1 => 'minus'
	);

	/**
	 * constructor
	 *
	 * @since 2.0.0
	 */

	public function __construct()
	{
		/* call init */

		$this->init();
	}

	/**
	 * create a task to be solved
	 *
	 * @since 2.0.0
	 */

	public function init()
	{
		$this->_create();
	}

	/**
	 * get the current task
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */

	public function getTask()
	{
		return $this->_task;
	}

	/**
	 * get the solution to the current task
	 *
	 * @since 2.0.0
	 *
	 * @param string $mode Set to 'raw' to get solution in plain text, otherwise sha1 hash
	 * @return integer
	 */

	public function getSolution($mode = 'hash')
	{
		/* raw output */

		if ($mode === 'raw')
		{
			return $this->_solution;
		}

		/* else hash output */

		else
		{
			return sha1($this->_solution);
		}
	}

	/**
	 * get the mathematical operator to use for the task
	 *
	 * @since 2.0.0
	 *
	 * @return integer
	 */

	protected function _getOperator()
	{
		/* switch captcha mode */

		switch (s('captcha'))
		{
			case 2:
				$output = 1;
				break;
			case 3:
				$output = -1;
				break;
			default:
				$output = mt_rand(0, 1) * 2 - 1;
				break;
		}
		return $output;
	}

	/**
	 * create a task
	 *
	 * the task is the addition or subtraction of two numbers between 1 and 10
	 *
	 * @since 2.0.0
	 */

	protected function _create()
	{
		/* range */

		$min = $this->_range['min'];
		$max = $this->_range['max'];

		/* random numbers */

		$a = mt_rand($min + 1, $max);
		$b = mt_rand($min, $a - 1);

		/* operator */

		$c = $this->_getOperator();
		$operator = $this->_operators[$c];

		/* solution and task */

		$this->_solution = $a + $b * $c;
		$this->_task = l($a) . ' ' . l($operator) . ' ' . l($b);
	}
}
?>