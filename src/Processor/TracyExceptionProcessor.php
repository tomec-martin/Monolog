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



class TracyExceptionProcessor
{

	/**
	 * @var array
	 */
	private $processedExceptionFileNames = [];

	/**
	 * @var \Tracy\Logger
	 */
	private $logger;



	public function __construct(MonologAdapter $logger)
	{
		$this->logger = $logger;
	}



	public function __invoke(array $record)
	{
		if (isset($record['context']['tracy'])) {
			// already processed by MonologAdapter
			return $record;
		}

		if (isset($record['context']['exception'])
			&& ($record['context']['exception'] instanceof \Exception || $record['context']['exception'] instanceof \Throwable)
		) {
			// exception passed to context
			$record['context']['tracy'] = $this->logBluescreen($record['context']['exception']);
		}

		return $record;
	}



	/**
	 * @param \Exception|\Throwable $exception
	 * @return string
	 */
	protected function logBluescreen($exception)
	{
		$fileName = $this->logger->getExceptionFile($exception);

		if (!isset($this->processedExceptionFileNames[$fileName])) {
			$this->logger->renderToFile($exception, $fileName);
			$this->processedExceptionFileNames[$fileName] = TRUE;
		}

		return ltrim(strrchr($fileName, DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR);
	}

}
