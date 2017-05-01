<?php

namespace ActivismeBe\Artillery\Commands;

use ActivismeBe\Artillery\Traits\AuthScaffolding;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CreateAuthCommand
 *
 * @author      Tim Joosten   <Topairy@gmail.com>
 * @copyright   Tim Joosten   <Topairy@gmail.com>
 * @license:    MIT license
 * @since       2017
 * @package     Artillery
 * @subpackage  ActivismeBe\Artillery\Commands
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
		$this->setName('make:auth')->setDescription('Create authencation system');
	}

	/**
	 * Command execution.
	 *
	 * @param  InputInterface  $input   An Input interface instance. 
	 * @param  OutputInterface $output 	An Output interface instance. 
	 * @return int|null|void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
        // TODO: Lock command out when is running.
        // TODO: Release the lock
        // TODO: Implement stub path and app model path on the functions.
        // TODO: Complete the docblocks.

		$this->makeViews($output);
		$this->makeController($this->getStubPath(), $this->getAppControllerPath(), $output);
		$this->makeModels($this->getStubPath(), $this->getAppModelPath(), $output);
	}
}
