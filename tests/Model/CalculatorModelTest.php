<?php

declare(strict_types=1);

namespace tests\Model;

use Tester\Assert;
use App\Model\CalculatorModel;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

class CalculatorModelTest extends TestCase
{

	private CalculatorModel $calculator;

	public function setUp(): void
	{
		$this->calculator = new CalculatorModel();
	}

	public function testGeneralAdd()
	{
		$result = $this->calculator->calculate(1, 10, 15);
		Assert::same(25, $result);
	}

	public function testOneNegativeAdd()
	{
		$result = $this->calculator->calculate(1, 2, -7);
		Assert::same(-5, $result);
	}

	public function testTwoNegativeAdd()
	{
		$result = $this->calculator->calculate(1, -2, -7);
		Assert::same(-9, $result);
	}

	public function testGeneralSubtract()
	{
		$result = $this->calculator->calculate(2, 15, 10);
		Assert::same(5, $result);
	}

	public function testReverseSubtract()
	{
		$result = $this->calculator->calculate(2, 10, 15);
		Assert::same(-5, $result);
	}

	public function testOneNegativeSubtract()
	{
		$result = $this->calculator->calculate(2, -2, 15);
		Assert::same(-17, $result);
	}

	public function testTwoNegativeSubtract()
	{
		$result = $this->calculator->calculate(2, -2, -10);
		Assert::same(8, $result);
	}

	public function testGeneralMultiply()
	{
		$result = $this->calculator->calculate(3, 2, 10);
		Assert::same(20, $result);
	}

	public function testOneNegativeMultiply()
	{
		$result = $this->calculator->calculate(3, -2, 5);
		Assert::same(-10, $result);
	}

	public function testTwoNegativeMultiply()
	{
		$result = $this->calculator->calculate(3, -2, -5);
		Assert::same(10, $result);
	}

	public function testZeroMultiply()
	{
		$result = $this->calculator->calculate(3, 0, 5);
		Assert::same(0, $result);
	}

	public function testGeneralDivide()
	{
		$result = $this->calculator->calculate(4, 10, 5);
		Assert::same(2.0, $result);
	}

	public function testOneNegativeDivide()
	{
		$result = $this->calculator->calculate(4, -10, 5);
		Assert::same(-2.0, $result);
	}

	public function testTwoNegativeDivide()
	{
		$result = $this->calculator->calculate(4, -10, -2);
		Assert::same(5.0, $result);
	}

	/** @throws InvalidArgumentException */
	public function testCannotBeDevidedByZero()
	{
		$this->calculator->calculate(4, 10, 0);
	}
}

(new CalculatorModelTest())->run();