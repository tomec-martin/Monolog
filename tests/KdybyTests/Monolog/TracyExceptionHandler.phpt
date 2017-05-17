<?php

/**
 * Test: Kdyby\Monolog\Processor\TracyExceptionProcessor.
 *
 * @testCase KdybyTests\Monolog\TracyExceptionProcessor
 * @author Filip Procházka <filip@prochazka.su>
 * @package Kdyby\Monolog
 */

namespace KdybyTests\Monolog;

use Kdyby;
use Kdyby\Monolog\Handler\TracyExceptionHandler;
use Kdyby\Monolog\Tracy\BlueScreenRenderer;
use Tester;
use Tester\Assert;
use Tracy\BlueScreen;



require_once __DIR__ . '/../bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class TracyExceptionHandlerTest extends Tester\TestCase
{

	/**
	 * @var \Kdyby\Monolog\Handler\TracyExceptionHandler
	 */
	private $handler;

	/**
	 * @var \Kdyby\Monolog\Tracy\MonologAdapter
	 */
	private $monologAdapter;



	protected function setUp()
	{
		$this->monologAdapter = new BlueScreenRenderer(TEMP_DIR, new BlueScreen());
		$this->handler =  new TracyExceptionHandler($this->monologAdapter);
	}



	public function testLogBluescreenFromContext()
	{
		$exception = new \RuntimeException('message');
		$record = [
			'message' => 'Some error',
			'context' => [
				'exception' => $exception,
			],
		];
		Assert::false($this->handler->handle($record));
		Assert::true(file_exists(TEMP_DIR . '/' . basename($this->monologAdapter->getExceptionFile($exception))));
	}

}

(new TracyExceptionHandlerTest())->run();
