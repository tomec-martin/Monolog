<?php

/**
 * Test: Kdyby\Monolog\MonologAdapter.
 *
 * @testCase KdybyTests\Monolog\MonologAdapterTest
 * @author Filip Procházka <filip@prochazka.su>
 * @package Kdyby\Monolog
 */

namespace KdybyTests\Monolog;

use Kdyby;
use Kdyby\Monolog\Tracy\BlueScreenRenderer;
use Tester;
use Tester\Assert;
use Tracy\BlueScreen;

require_once __DIR__ . '/../bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class BlueScreenRendererTest extends Tester\TestCase
{

	public function testLogginIsNotSupported()
	{
		$renderer = new BlueScreenRenderer(TEMP_DIR, new BlueScreen());

		Assert::exception(function () use ($renderer) {
			$renderer->log('message');
		}, 'Kdyby\Monolog\NotSupportedException', 'This class is only for rendering exceptions');
	}

}

(new BlueScreenRendererTest())->run();
