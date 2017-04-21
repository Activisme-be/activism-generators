<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ModelEloquentCommand
 *
 * @author      Tim Joosten   <Topairy@gmail.com>
 * @copyright   Tim Joosten   <Topairy@gmail.com>
 * @license:    MIT license
 * @since       2017
 * @package     Artillery
 * @subpackage  ActivismeBe\Artillery\Commands
 */
class ModelEloquentCommand extends BaseCommand
{
    /**
     * Command configuration.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('make:model-eloquent')
            ->setDescription('Create a new Eloquent model')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the model class');
    }

    /**
     * Command execution.
     *
     * @param  InputInterface $input
     * @param  OutputInterface $output  An OutputInterface instance.
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$name   = $input->getArgument('name');
		$this->make($name, $output);
    }

	/**
	 * Create a model and placed into application/models.
	 *
	 * @param  string           $model      A model name.
	 * @param  OutputInterface  $output     An OutputInterface instance.
	 * @return bool
	 */
	private function make($model, OutputInterface $output)
	{
		$stub  = file_get_contents($this->getStubPath() . '/model-eloquent.stub');
		$model = ucfirst($model);
		$file  = str_replace('{{ class }}', ucfirst($model), $stub);

		if (! file_exists($fullPath = "{$this->getAppModelPath()}/{$model}.php")) {
			file_put_contents($fullPath, $file);
			$output->writeln("<info>Model created successfully!</info>");

			shell_exec('composer dump-autoload');
		} else {
			$output->writeln('<error>Model already exists.</error>');
		}

		return false;
	}
}
