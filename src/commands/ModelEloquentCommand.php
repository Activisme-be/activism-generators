<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @todo docblock
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
            ->setDescription('Create a new model')
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

    }
}
