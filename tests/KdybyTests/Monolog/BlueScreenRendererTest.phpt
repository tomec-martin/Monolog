<?php

/**
 * Test: Kdyby\Monolog\MonologAdapter.
 *
 * @testCase
 */

namespace KdybyTests\Monolog;

use Kdyby\Monolog\Tracy\BlueScreenRenderer;
use Tester\Assert;
use Tracy\BlueScreen;

require_once __DIR__ . '/../bootstrap.php';

class BlueScreenRendererTest extends \Tester\TestCase
{

	public function testLogginIsNotSupported()
	{
		$renderer = new BlueScreenRenderer(TEMP_DIR, new BlueScreen());

		Assert::exception(function () use ($renderer) {
			$renderer->log('message');
		}, \Kdyby\Monolog\NotSupportedException::class, 'This class is only for rendering exceptions');
	}

}

(new BlueScreenRendererTest())->run();
