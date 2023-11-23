<?php

declare(strict_types=1);

namespace App\Model;

use Nette\SmartObject;
use InvalidArgumentException;

class CalculatorModel
{
	use SmartObject;

	public const
			ADD = 1,
			SUBTRACT = 2,
			MULTIPLY = 3,
			DIVIDE = 4;

	public function getOperations(): array
	{
		return array(
			self::ADD => 'Sečti',
			self::SUBTRACT => 'Odečti',
			self::MULTIPLY => 'Vynásob',
			self::DIVIDE => 'Vyděl',
		);
	}

	public function calculate(int $operation, int $x, int $y): int|float|null
	{
		switch ($operation) {
			case self::ADD:
				return $this->add($x, $y);
			case self::SUBTRACT:
				return $this->subtract($x, $y);
			case self::MULTIPLY:
				return $this->multiply($x, $y);
			case self::DIVIDE:
				return $this->divide($x, $y);
			default:
				return null;
		}
	}

	private function add(int $x, int $y): int
	{
		return $x + $y;
	}

	private function subtract(int $x, int $y): int
	{
		return $x - $y;
	}

	private function multiply(int $x, int $y): int
	{
		return $x * $y;
	}

	private function divide(int $x, int $y): float
	{
		if ($y === 0)
		{
			throw new InvalidArgumentException('Nelze dělit nulou.');
		}

		return round($x/$y);
	}
}