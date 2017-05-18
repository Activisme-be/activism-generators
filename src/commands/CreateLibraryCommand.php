<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CreateLibraryCommand
 *
 * @author      Tim Joosten   <Topairy@gmail.com>
 * @copyright   Tim Joosten   <Topairy@gmail.com>
 * @license:    MIT license
 * @since       2017
 * @package     Artillery
 * @subpackage  ActivismeBe\Artillery\Commands
 */
class CreateLibraryCommand extends BaseCommand
{
	/**
	 * Command figuration.
     *
	 * @return void
	 */
	protected function configure()
	{
		$this->setName('make:library')
			->setDescription('Create a new library')
			->addArgument('name', InputArgument::REQUIRED, 'The name of the library.');
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
		$name = $input->getArgument('name');
		$this->make($name, $output);
	}

	/**
	 * Create a new library file.
	 *
	 * @param 	string $name The name for the library.
	 * @param 	OutputInterface $output An OutputInterface instance.
	 * @return 	bool
	 */
	private function make($name, OutputInterface $output)
	{
		$stub  = file_get_contents($this->getStubPath() . '/library.stub');
		$model = ucfirst($name);
		$file  = str_replace('{{ class }}', ucfirst($model), $stub);

		if (! file_exists($fullPath = "{$this->getAppLibraryPath()}/{$model}.php")) {
			file_put_contents($fullPath, $file);
			$output->writeln("<info>Library created successfully!</info>");

			shell_exec('composer dump-autoload');
		} else {
			$output->writeln('<error>Library already exists.</error>');
		}

		return false;
	}
}
