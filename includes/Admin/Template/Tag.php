<?php
namespace Redaxscript\Admin\Template;

use Redaxscript\Admin;
use Redaxscript\Language;
use Redaxscript\Registry;
use Redaxscript\Template\Tag as BaseTag;

/**
 * parent class to provide admin template tags
 *
 * @since 4.0.0
 *
 * @package Redaxscript
 * @category Template
 * @author Henry Ruhs
 */

class Tag extends BaseTag
{
	/**
	 * dashboard
	 *
	 * @since 4.1.0
	 *
	 * @param array $optionArray options of the dashboard
	 *
	 * @return string
	 */

	public static function dashboard(array $optionArray = []) : string
	{
		$dashboard = new Admin\View\Helper\Dashboard(Registry::getInstance(), Language::getInstance());
		return $dashboard->init($optionArray)->render();
	}

	/**
	 * panel
	 *
	 * @since 4.0.0
	 *
	 * @param array $optionArray options of the panel
	 *
	 * @return string
	 */

	public static function panel(array $optionArray = []) : string
	{
		$panel = new Admin\View\Helper\Panel(Registry::getInstance(), Language::getInstance());
		return $panel->init($optionArray)->render();
	}
}
