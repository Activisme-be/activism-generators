<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateLibraryCommand
 *
 * @package ActivismeBe\Artillery\Commands
 */
class CreateLibraryCommand extends BaseCommand
{
    /**
     * Command configuration.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('make:library')
            ->setDescription('Create a new library')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the model class');
    }

    /**
     * Command execution.
     *
     * @param  InputInterface   $input  AN symfony input interface.
     * @param  OutputInterface  $output An symfony output interface.
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}