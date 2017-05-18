<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ModelCodeigniterCommand
 *
 * @author      Tim Joosten   <Topairy@gmail.com>
 * @copyright   Tim Joosten   <Topairy@gmail.com>
 * @license:    MIT license
 * @since       2017
 * @package     Artillery
 * @subpackage  ActivismeBe\Artillery\Commands
 */
class ModelCodeigniterCommand extends BaseCommand
{
    /**
     * Command configuration.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('make:model-codeigniter')
            ->setDescription('Create a new CodeIgniter model')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the model class')
            ->addOption('suffix', null, InputOption::VALUE_OPTIONAL, 'Default: _m, the model suffix will be replaced with the defined.');
    }

    /**
     * Execute the command.
     *
     * @param  InputInterface   $input      An InputInterface instance.
     * @param  OutputInterface  $output     An OutputInterface instance.
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name   = $input->getArgument('name');
        $suffix = $input->getOption('suffix') ?: '_m';

        $this->make($name, $suffix, $output);
    }

    /**
     * Create a model and placed into application/models.
     *
     * @param  string           $model      A model name
     * @param  string           $suffix     Suffix for the model name.
     * @param  OutputInterface  $output     An OutputInterface instance.
     * @return bool
     */
    private function make($model, $suffix, OutputInterface $output)
    {
        $stub  = file_get_contents($this->getStubPath() . '/model-codeigniter.stub');
        $model = ucfirst($model) . $suffix;
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
