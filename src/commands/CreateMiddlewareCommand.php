<?php 

namespace ActivismeBE\Artillery\Commands; 

use Symfony\Component\Console\Input\InputArgument; 
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption; 
use Symfony\Component\Console\Output\OutputInterface; 

/**
 * CreateMiddlewareCommand
 * 
 * @author      Tim Joosten   <Topairy@gmail.com>
 * @copyright   Tim Joosten   <Topairy@gmail.com>
 * @license     MIT license
 * @since       2017
 * @package     Artillery 
 * @subpackage  ActivismeBe\Artillery\Commands
 */
class CreateMiddlewareCommand extends BaseCommand 
{
    /**
     * Command configuration
     * 
     * @return void
     */
    protected function configure() 
    {
        $this->setName('make:middleware'); 
        $this->setDescription('Create a new middleware instance');
        $this->addArgument('name', InputArgument::REQUIRED, 'The name for the middleware instance');
    }

    /**
     * Execute the command
     * 
     * @param  InputInterface   $input      An symfony InputInterface instance.
     * @param  OutputInterface  $output     An symfony OutputInterface instance. 
     * @return mixed
     */ 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->make($input->getArgument('name'), $output);
    }

    /**
     * Create a model and placed into application/models.
     *
     * @param  string           $name       A model name.
     * @param  OutputInterface  $output     An OutputInterface instance.
     * @return bool
     */
    private function make($name, OutputInterface $output)
    {
        $stub       = file_get_contents($this->getStubPath() . '/middleware.stub');
        $middleware = ucfirst($name . 'Middleware');
        $file       = str_replace('{{ class }}', ucfirst($middleware), $stub);

        if (! file_exists($fullPath = "{$this->getAppMiddlewarePath()}/{$middleware}.php")) {
var_dump("{$this->getAppMiddlewarePath()}/{$middleware}.php");
die();

            file_get_contents($fullPath, $file);
            $output->writeln('<info>Middleware created successfully!</info>');
        } else {
            $output->writeln('<error>Middleware already exists.</error>');
        }

        return false;
    }

}