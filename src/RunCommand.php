<?php
declare(strict_types=1);

namespace App;

use App\Game\Decision\ConditionFactory;
use App\Game\Executor;
use App\Game\Strategy\ContextFactory;
use App\History\CaretakerFactory;
use App\Reader\XmlFileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command
{
	protected function configure()
	{
		$this->setName('game:run');

		$this->setName('game:run');
		$this->setDescription('use input file [-i]');
		$this->addOption('input', 'i', InputOption::VALUE_OPTIONAL, 'Input file', 'input.xml');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$reader = new XmlFileReader($input->getOption('input'));

		(new Game($reader, new Executor(
				ConditionFactory::getInstance(),
				ContextFactory::getInstance(),
			),
			CaretakerFactory::getInstance(),
		))->run($input, $output, $this);

		return Command::SUCCESS;
	}
}