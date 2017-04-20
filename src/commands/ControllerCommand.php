<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Disclaimer controller.
 *
 * @author      Tim Joosten   <Topairy@gmail.com>
 * @copyright   Tim Joosten   <Topairy@gmail.com>
 * @license:    MIT license
 * @since       2017
 * @package     Artillery
 * @subpackage  Controller command.
 */
class ControllerCommand extends BaseCommand
{
    /**
     * Command configuration.
     *
     * @return void.
     */
    protected function configure()
    {
        $this->setName('make:controller')
            ->setDescription('Create a new controller')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the controller class')
            ->addOption('resource', 'r',InputOption::VALUE_NONE, 'Indicate that the controller is for resource operations.')
            ->addOption('api', 'a', InputOption::VALUE_NONE, 'Indicate that the controller is for API operations.');
    }

    /**
     * Execute the command.
     *
     * @param  InputInterface  $input   An InputInterface instance.
     * @param  OutputInterface $output  An OutputInterface instance.
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name       = $input->getArgument('name');
        $controller = ucfirst($name);

        if ($input->getOption('resource')) { // The controller is for resource operations.
            $template = $this->getStubContent("{$this->getStubPath()}/controller-resource.stub", $name);
            $this->makeResourceController($name, $template, $output);
        } elseif ($input->getOption('api')) { // The controller is for API operations.
            $template = $this->getStubContent("{$this->getStubPath()}/controller-api.stub", $name);
            $this->makeApiController($name, $template, $output);
        } else { // Just need an empty controller.
            $template = $this->getStubContent("{$this->getStubPath()}/controller.stub", $name);
            $this->makeEmptyController($name, $template, $output);
        }
    }

    /**
     * Create an API controller and placed into application/controllers.
     *
     * @param  string           $name       The controller name.
     * @param  mixed            $stub       The controller stub.
     * @param  OutputInterface  $output     An OutputInterface instance.
     * @return mixed
     */
    private function makeApiController($name, $stub, OutputInterface $output)
    {
        if ($filename = $this->checkFileExists("{$this->getAppControllerPath()}/{$name}.php", $output)) {
            if ($this->writeFile($filename, $stub)) {
                $output->writeln('<info>API Controller created successfully!</info>');
            }
        }
    }

    /**
     * Create an resource controller and placed into application/controllers.
     *
     * @param  string           $name       The controller name.
     * @param  mixed            $stub       The controller stub.
     * @param  OutputInterface  $output     An OutputInterface instance.
     * @return mixed
     */
    private function makeResourceController($name, $stub, OutputInterface $output)
    {
        if ($filename = $this->checkFileExists("{$this->getAppControllerPath()}/{$name}.php", $output)) {
            if ($this->writeFile($filename, $stub)) {
                $output->writeln('<info>Resource controller created successfully!</info>');
            }
        }
    }

    /**
     * Create an empty controller and placed into application/controllers
     *
     * @param  string           $name       The controller name
     * @param  mixed            $stub       The controller stub.
     * @param  OutputInterface  $output     An OutputInterface instance
     * @return mixed
     */
    private function makeEmptyController($name, $stub, OutputInterface $output)
    {
        if ($filename = $this->checkFileExists("{$this->getAppControllerPath()}/{$name}.php", $output)) {
            if ($this->writeFile($filename, $stub)) {
                $output->writeln("<info>Empty controller created successfully!</info>");
            }
        }
    }
}
