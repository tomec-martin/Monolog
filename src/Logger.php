<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace Kdyby\Monolog;

class Logger extends \Monolog\Logger
{

	use \Kdyby\StrictObjects\Scream;

	/**
	 * @param string $channel
	 * @return \Kdyby\Monolog\CustomChannel
	 */
	public function channel($channel): CustomChannel
	{
		return new CustomChannel($channel, $this);
	}

	/**
	 * Adds a log record at the DEBUG level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function addDebug($message, array $context = []): void
	{
		$this->debug($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the INFO level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function addInfo($message, array $context = []): void
	{
		$this->info($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the NOTICE level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function addNotice($message, array $context = []): void
	{
		$this->notice($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the WARNING level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function addWarning($message, array $context = []): void
	{
		$this->warning($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the ERROR level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function addError($message, array $context = []): void
	{
		$this->error($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the CRITICAL level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function addCritical($message, array $context = []): void
	{
		$this->critical($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the ALERT level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function addAlert($message, array $context = []): void
	{
		$this->alert($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the EMERGENCY level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function addEmergency($message, array $context = []): void
	{
		$this->emergency($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the WARNING level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function warn($message, array $context = []): void
	{
		$this->warning($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the ERROR level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function err($message, array $context = []): void
	{
		$this->error($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the CRITICAL level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function crit($message, array $context = []): void
	{
		$this->critical($message, array_merge(['channel' => $this->name], $context));
	}

	/**
	 * Adds a log record at the EMERGENCY level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param array  $context The log context
	 */
	public function emerg($message, array $context = []): void
	{
		$this->emergency($message, array_merge(['channel' => $this->name], $context));
	}

}
