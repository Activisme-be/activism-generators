<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Input\InputOption;
use ActivismeBe\Artillery\Traits\AuthScaffolding;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateAuthCommand
 *
 * @package ActivismeBe\Artillery\Commands
 */
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
			->setDescription('Create authencation system')
            ->addArgument('db-user', InputArgument::REQUIRED, '')
            ->addArgument('db-pass', InputArgument::REQUIRED, '')
            ->addArgument('db-name', InputArgument::REQUIRED, '')
            ->addOption('db-host', null, InputOption::VALUE_OPTIONAL, 'Default: localhost,')
			->addOption('db-port', null, InputOption::VALUE_OPTIONAL, 'Default: 3306,');
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
	    // Command inputs

	    // Make command.
		$this->makeViews($this->getStubPath(), '', $output);
		$this->makeController($this->getStubPath(), '', $output);
		$this->makeDatabase('', '', '', '', '', $output);
		$this->makeModels($this->getStubPath(), $this->getAppModelPath(), $output);
	}
}
