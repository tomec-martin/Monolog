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
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Nette;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class MonologAdapterTest extends Tester\TestCase
{

	/**
	 * @var Kdyby\Monolog\Diagnostics\MonologAdapter
	 */
	protected $adapter;

	/**
	 * @var Logger
	 */
	protected $monolog;

	/**
	 * @var TestHandler
	 */
	protected $testHandler;



	protected function setUp()
	{
		$this->monolog = new Logger('kdyby', [$this->testHandler = new TestHandler()]);
		$this->adapter = new Kdyby\Monolog\Diagnostics\MonologAdapter($this->monolog);
	}



	/**
	 * @return array
	 */
	public function dataLog_standard()
	{
		return [
			['test message 1', 'debug'],
			['test message 2', 'info'],
			['test message 3', 'notice'],
			['test message 4', 'warning'],
			['test message 5', 'error'],
			['test message 6', 'critical'],
			['test message 7', 'alert'],
			['test message 8', 'emergency'],
		];
	}



	/**
	 * @dataProvider dataLog_standard
	 */
	public function testLog_standard($message, $priority)
	{
		Assert::count(0, $this->testHandler->getRecords());
		$this->adapter->log($message, $priority);
		Assert::count(1, $this->testHandler->getRecords());

		list($record) = $this->testHandler->getRecords();
		Assert::same('kdyby', $record['channel']);
		Assert::same($message, $record['message']);
		Assert::same(strtoupper($priority), $record['level_name']);
		Assert::same($priority, $record['context']['priority']);
		Assert::type('DateTime', $record['datetime']);
		Assert::match('CLI%a%: %a%/MonologAdapter.phpt%a%', $record['context']['at']);
	}



	public function testLog_withCustomPriority()
	{
		$this->adapter->log('test message', 'nemam');
		Assert::count(1, $this->testHandler->getRecords());

		list($record) = $this->testHandler->getRecords();
		Assert::same('kdyby', $record['channel']);
		Assert::same('test message', $record['message']);
		Assert::same('INFO', $record['level_name']);
		Assert::same('nemam', $record['context']['priority']);
		Assert::match('CLI%a%: %a%/MonologAdapter.phpt%a%', $record['context']['at']);
	}

}

(new MonologAdapterTest())->run();
