<?php
declare(strict_types=1);

namespace App;

use App\Data\Organism;
use App\DataStructure\WorldBuilder;
use App\DataStructure\WorldDirector;
use App\Game\Executor;
use App\History\Caretaker;
use App\Reader\Reader;
use App\Render\Grid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

readonly class Game
{
	public function __construct(
		private Reader $reader,
		private Executor $executor,
		private Caretaker $caretaker,
	)
	{
	}

	public function run(InputInterface $input, OutputInterface $output, Command $command): void
	{
		$this->clear($output);

		$life = $this->reader->read();

		$builder = new WorldBuilder;
		$builder->setSize($life->getWorld()->getSize());

		/** @var Organism $organism */
		foreach ($life->getOrganisms() as $organism) {
			$builder->addCoordinate($organism->getX(), $organism->getY());
		}

		$director = new WorldDirector;
		$director->setBuilder($builder);

		$world = $director->create();
		$this->caretaker->backup(0, $world);

		$grid = new Grid($output);

		$grid->setWorld($world);

		$output->writeln("<info>Start grid.</info>");
		$grid->render();
		usleep(pow(10, 5));
		$this->clear($output);

		$iterations = 0;
		while ($iterations < $life->getWorld()->getIterations()) {
			++$iterations;
			$output->writeln("<info>Iteration $iterations of {$life->getWorld()->getIterations()}.</info>");
			$world = $this->executor->execute($world);
			$this->caretaker->backup($iterations, $world);

			$grid->setWorld($world);
			$grid->render();

			usleep(pow(10, 5));

			if ($iterations !== $life->getWorld()->getIterations()) {
				$this->clear($output);
			}
		}

		$output->writeln("<info>Game over!</info>");
		$output->writeln("--------");

		//rendering history

		/** @var QuestionHelper $question */
		$question = $command->getHelper('question');

		$interval = null;

		while ($interval !== 'E') {
			$interval = $question->ask($input, $output, new Question("<info>If you want to plot individual iterations, enter a number from the interval 0 - {$iterations}. (Press [E] to exit): </info>", $life->getWorld()->getIterations()  - 1));

			$memento = $this->caretaker->getHistory((int) $interval);
			if ($memento === null) {
				$output->writeln("<error>Interval number #$interval will not run!</error>");
			} else {
				$this->clear($output);
				$output->writeln("<info>Rendering the world in interaction number #{$memento->getIteration()}</info>");
				$grid->setWorld($memento->getWorld());
				$grid->render();
			}
		}

		$this->clear($output);

		$output->writeln("<comment>\"Let us endeavor so to live that when we come to die even the undertaker will be sorry.\" - Mark Twain</comment>");

	}

	private function clear(OutputInterface $output): void
	{
		$output->write(sprintf("\033\143"));
	}
}