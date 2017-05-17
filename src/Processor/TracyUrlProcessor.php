<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace Kdyby\Monolog\Processor;

use Kdyby\Monolog\Tracy\MonologAdapter;



class TracyUrlProcessor
{

	/**
	 * @var string
	 */
	private $baseUrl;

	/**
	 * @var \Kdyby\Monolog\Tracy\MonologAdapter
	 */
	private $logger;



	public function __construct($baseUrl, MonologAdapter $logger)
	{
		$this->baseUrl = rtrim($baseUrl, '/');
		$this->logger = $logger;
	}



	public function __invoke(array $record)
	{
		if ($this->isHandling($record)) {
			$exceptionFile = $this->logger->getExceptionFile($record['context']['exception']);
			$record['context']['tracyUrl'] = sprintf('%s/%s', $this->baseUrl, basename($exceptionFile));
		}

		return $record;
	}



	public function isHandling(array $record)
	{
		return isset($record['context']['exception'])
			&& $record['context']['exception'] instanceof \Throwable;
	}

}
