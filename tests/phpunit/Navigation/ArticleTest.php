<?php
namespace Redaxscript\Tests\Navigation;

use Redaxscript\Db;
use Redaxscript\Navigation;
use Redaxscript\Tests\TestCaseAbstract;

/**
 * ArticleTest
 *
 * @since 3.3.0
 *
 * @package Redaxscript
 * @category Tests
 * @author Henry Ruhs
 */

class ArticleTest extends TestCaseAbstract
{
	/**
	 * setUp
	 *
	 * @since 3.3.0
	 */

	public function setUp()
	{
		parent::setUp();
		$installer = $this->installerFactory();
		$installer->init();
		$installer->rawCreate();
		$installer->insertSettings(
		[
			'adminName' => 'Test',
			'adminUser' => 'test',
			'adminPassword' => 'test',
			'adminEmail' => 'test@test.com'
		]);
		$categoryOne = Db::forTablePrefix('categories')->create();
		$categoryOne
			->set(
			[
				'title' => 'Category One',
				'alias' => 'category-one',
				'rank' => 1,
				'status' => 1
			])
			->save();
		$categoryTwo = Db::forTablePrefix('categories')->create();
		$categoryTwo
			->set(
			[
				'title' => 'Category Two',
				'alias' => 'category-two',
				'rank' => 2,
				'status' => 1
			])
			->save();
		Db::forTablePrefix('articles')
			->create()
			->set(
			[
				'title' => 'Article One',
				'alias' => 'article-one',
				'category' => $categoryOne->id,
				'rank' => 1,
				'status' => 1
			])
			->save();
		Db::forTablePrefix('articles')
			->create()
			->set(
			[
				'title' => 'Article Two',
				'alias' => 'article-two',
				'category' => $categoryTwo->id,
				'rank' => 2,
				'status' => 1
			])
			->save();
		Db::forTablePrefix('articles')
			->create()
			->set(
			[
				'title' => 'Article Three',
				'alias' => 'article-three',
				'rank' => 3,
				'status' => 1
			])
			->save();
	}

	/**
	 * tearDown
	 *
	 * @since 3.3.0
	 */

	public function tearDown()
	{
		$installer = $this->installerFactory();
		$installer->init();
		$installer->rawDrop();
	}

	/**
	 * providerRender
	 *
	 * @since 3.3.0
	 *
	 * @return array
	 */

	public function providerRender() : array
	{
		return $this->getProvider('tests/provider/Navigation/article_render.json');
	}

	/**
	 * testRender
	 *
	 * @since 3.3.0
	 *
	 * @param array $registryArray
	 * @param array $optionArray
	 * @param string $expect
	 *
	 * @dataProvider providerRender
	 */

	public function testRender(array $registryArray = [], array $optionArray = [], string $expect = null)
	{
		/* setup */

		$this->_registry->init($registryArray);
		$navigation = new Navigation\Article($this->_registry, $this->_language);
		$navigation->init($optionArray);

		/* actual */

		$actual = $navigation;

		/* compare */

		$this->assertEquals($expect, $actual);
	}
}
