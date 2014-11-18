<?php
namespace Redaxscript\Modules\Preview;

use Redaxscript\Directory;
use Redaxscript\Element;
use Redaxscript\Language;
use Redaxscript\Module;
use Redaxscript\Registry;

/**
 * preview template elements
 *
 * @since 2.2.0
 *
 * @package Redaxscript
 * @category Modules
 * @author Henry Ruhs
 */

class Preview extends Module
{
	/**
	 * custom module setup
	 *
	 * @var array
	 */

	protected static $_module = array(
		'name' => 'Preview',
		'alias' => 'Preview',
		'author' => 'Redaxmedia',
		'description' => 'Preview template elements',
		'version' => '2.2.0',
		'status' => 1,
		'access' => 0
	);

	/**
	 * loaderStart
	 *
	 * @since 2.2.0
	 */

	public static function loaderStart()
	{
		if (Registry::get('firstParameter') === 'preview')
		{
			global $loader_modules_styles;
			$loader_modules_styles[] = 'modules/Preview/styles/preview.css';
		}
	}

	/**
	 * renderStart
	 *
	 * @since 2.2.0
	 */

	public static function renderStart()
	{
		if (Registry::get('firstParameter') === 'preview')
		{
			Registry::set('title', Language::get('preview', '_preview'));
			Registry::set('description', Language::get('description', '_preview'));
			Registry::set('centerBreak', true);
		}
	}

	/**
	 * centerStart
	 *
	 * @since 2.2.0
	 */

	public static function centerStart()
	{
		if (Registry::get('firstParameter') === 'preview')
		{
			$partialsPath = 'modules/Preview/partials';
			$partialExtension = '.phtml';
			$partialsDirectory = new Directory($partialsPath);
			$partialsDirectoryArray = $partialsDirectory->getArray();
			$secondParameter = Registry::get('secondParameter');

			/* collect partial output */

			$output = '<div class="preview clearfix">';

			/* include as needed */

			if ($secondParameter)
			{
				$output .= self::render($secondParameter, $partialsPath . '/' . $secondParameter . $partialExtension);
			}

			/* else include all */

			else
			{
				foreach ($partialsDirectoryArray as $partial)
				{
					$alias = str_replace($partialExtension, '', $partial);
					$output .= self::render($alias, $partialsPath . '/' . $partial);
				}
			}
			$output .= '</div>';
			echo $output;
		}
	}

	/**
	 * render
	 *
	 * @since 2.2.0
	 *
	 * @param string $alias
	 * @param string $path
	 *
	 * @return string
	 */

	public static function render($alias = null, $path = null)
	{
		$headlineElement = new Element('h2', array(
			'class' => 'title_content',
			'title' => $alias
		));
		$linkElement = new Element('a', array(
			'href' => Registry::get('secondParameter') === $alias ? null : Registry::get('rewriteRoute') . 'preview/' . $alias,
			'title' => $alias
		));
		$linkElement->text($alias);

		/* collect output */

		$output = $headlineElement->html($linkElement);
		ob_start();
		include_once($path);
		$output .= ob_get_clean();
		return $output;
	}
}