<?php
namespace Redaxscript\Filter;

use Redaxscript\Html as BaseHtml;

/**
 * children class to filter the html
 *
 * @since 3.0.0
 *
 * @package Redaxscript
 * @category Filter
 * @author Henry Ruhs
 */

class Html implements FilterInterface
{
	/**
	 * sanitize the html
	 *
	 * @since 3.0.0
	 *
	 * @param string $html html
	 * @param boolean $filter optional filter
	 *
	 * @return string
	 */

	public function sanitize($html = null, $filter = true)
	{
		$purifier = new BaseHtml\Purifier();
		return $purifier->purify($html, $filter);
	}
}
