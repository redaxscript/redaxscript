<?php
namespace Redaxscript\Modules\Tinymce;

use Redaxscript\Head;
use Redaxscript\Header;

/**
 * javascript powered wysiwyg editor
 *
 * @since 3.0.0
 *
 * @package Redaxscript
 * @category Modules
 * @author Henry Ruhs
 */

class Tinymce extends Config
{
	/**
	 * array of the module
	 *
	 * @var array
	 */

	protected static $_moduleArray =
	[
		'name' => 'Tinymce',
		'alias' => 'Tinymce',
		'author' => 'Redaxmedia',
		'description' => 'JavaScript powered WYSIWYG editor',
		'version' => '4.0.0'
	];

	/**
	 * renderStart
	 *
	 * @since 3.0.0
	 */

	public function renderStart()
	{
		if ($this->_registry->get('loggedIn') === $this->_registry->get('token'))
		{
			$script = Head\Script::getInstance();
			$script
				->init('foot')
				->appendFile('https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.8.3/tinymce.min.js')
				->appendFile('modules/Tinymce/assets/scripts/init.js')
				->appendFile('modules/Tinymce/dist/scripts/tinymce.min.js');

			/* upload */

			if ($this->_registry->get('firstParameter') === 'tinymce' && $this->_registry->get('secondParameter') === 'upload' && $this->_registry->get('lastParameter') === $this->_registry->get('token'))
			{
				$this->_registry->set('renderBreak', true);
				echo $this->_upload();
			}
		}
	}

	/**
	 * adminNotification
	 *
	 * @since 3.0.0
	 *
	 * @return array|null
	 */

	public function adminNotification() : ?array
	{
		if (!is_dir($this->_configArray['uploadDirectory']) && !mkdir($this->_configArray['uploadDirectory']))
		{
			$this->setNotification('error', $this->_language->get('directory_not_found') . $this->_language->get('colon') . ' ' . $this->_configArray['uploadDirectory'] . $this->_language->get('point'));
		}
		else if (!chmod($this->_configArray['uploadDirectory'], 0777))
		{
			$this->setNotification('error', $this->_language->get('directory_permission_grant') . $this->_language->get('colon') . ' ' . $this->_configArray['uploadDirectory'] . $this->_language->get('point'));
		}
		return $this->getNotification();
	}

	/**
	 * upload
	 *
	 * @since 3.0.0
	 *
	 * @return array|null
	 */

	protected function _upload() : ?array
	{
		$filesArray = current($this->_request->getFiles());

		/* upload file */

		if (is_uploaded_file($filesArray['tmp_name']))
		{
			if (move_uploaded_file($filesArray['tmp_name'], $this->_configArray['uploadDirectory'] . DIRECTORY_SEPARATOR . $filesArray['name']))
			{
				return json_encode(
				[
					'location' => $this->_configArray['uploadDirectory'] . DIRECTORY_SEPARATOR . $filesArray['name']
				]);
			}
		}
		Header::statusCode(404);
		return null;
	}
}
