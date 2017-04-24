<?php

namespace ActivismeBe\Artillery\Commands;

use ActivismeBe\Artillery\Traits\AuthScaffolding;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAuthCommand extends BaseCommand
{
	use AuthScaffolding;

	/**
	 * Command configuration.
	 *
	 * @return void
	 */
	protected function configure()
	{
		// TODO: Set argument for database name, user, password, host, port.
		
		$this->setName('make:auth')
			->setDescription('Create authencation system');
	}

	/**
	 * Command execution.
	 *
	 * @param  InputInterface $input
	 * @param  OutputInterface $output
	 * @return int|null|void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
        // TODO: Lock command out when is running.
        // TODO: Release the lock
        // TODO: Implement stub path and app model path on the functions.
        // TODO: Complete the docblocks.

		$this->makeViews($output);
		$this->makeController($output);
		$this->makeModels($this->getStubPath(), $this->getAppModelPath(), $output);
	}
}
