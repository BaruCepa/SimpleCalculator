<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\CalculatorModel;
use InvalidArgumentException;
use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

final class CalculatorPresenter extends Nette\Application\UI\Presenter
{
	private const
		MESSAGE_REQUIRED = 'Povinný vstup, prosím vyplňte.',
		MESSAGE_RULE = 'Neplatný formát vstupu, zadejte prosím celé číslo.';

	private $result = null;

	private CalculatorModel $calculator;

	public function __construct(CalculatorModel $calculator)
	{
		parent::__construct();
		$this->calculator = $calculator;
	}

	public function renderDefault()
	{
		$this->template->result = $this->result;
	}

	public function calculatorFormSucceeded(Form $form, ArrayHash $data): void
	{
		try 
		{
			$this->result = $this->calculator->calculate($data->operation, $data->x, $data->y);
		}
		catch (InvalidArgumentException $e)
		{
			$this->flashMessage($form['y']->addError('Nelze dělit nulou.'));
		}
	}

	protected function createComponentCalculatorForm(): Form
	{
		$form = new Form;

		$form->addRadioList('operation', 'Matematická operace:', $this->calculator->getOperations())
			->setDefaultValue(CalculatorModel::ADD)
			->setRequired(self::MESSAGE_REQUIRED);
		$form->addText('x', '1.číslo:')
			->setDefaultValue(0)
			->setHtmlType('number')
			->setRequired(self::MESSAGE_REQUIRED)
			->addRule(Form::INTEGER, self::MESSAGE_RULE);
		$form->addText('y', '2.číslo:')
			->setDefaultValue(0)
			->setHtmlType('number')
			->setRequired(self::MESSAGE_REQUIRED)
			->addRule(Form::INTEGER, self::MESSAGE_RULE);

		$form->addSubmit('calculate', 'Spočítej');
		$form->onSuccess[] = [$this, 'calculatorFormSucceeded'];

		return $form;
	}
}
