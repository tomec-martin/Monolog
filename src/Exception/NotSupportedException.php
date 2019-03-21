<?php declare(strict_types=1);

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace Kdyby\Monolog\Exception;

class NotSupportedException extends \LogicException implements \Kdyby\Monolog\Exception\Exception
{

}

class_alias(\Kdyby\Monolog\Exception\NotSupportedException::class, '\Kdyby\Monolog\NotSupportedException');
