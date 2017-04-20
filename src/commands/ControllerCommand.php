<?php

namespace ActivismeBE\ArtilleryCommands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the controller class');
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
        $name = $input->getArgument('name');
		$this->make($name, $output);
    }

    /**
     * Create a controller and placed into application/controllers
     *
     * @param  mixed            $controller The controller name.
     * @param  OutputInterface  $output     An OutputInterface instance
     * @return bool
     */
    private function make($controller, OutputInterface $output)
    {
        $stub       = file_get_contents($this->stubPath() . '/controller.stub');
        $controller = ucfirst($controller);
        $file       = str_replace('{{ class }}', ucfirst($controller), $stub);

        if (! file_exists($fullPath = "{$this->appControllerPath()}/{$controller}.php")) {
            file_put_contents($fullPath, $file);
            $output->writeln("<info>Controller created successfully!</info>");
        } else {
            $output->writeln('<error>Controller already exists.</error>');
        }

        return false;
    }
}
