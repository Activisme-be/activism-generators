<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Command\Command;

/**
 * @todo docblock
 */
class BaseCommand extends Command
{
    protected $stubPath;            /** */
    protected $appControllerPath;   /** */
    protected $appModelPath;        /** */

    /**
     * BaseCommand constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->stubPath          = __DIR__ . '/../stubs';
        $this->appControllerPath = './application/controllers';
        $this->appModelPath      = './application/models';
    }
    /**
     * @todo docblock
     */
    public function getStubPath()
    {
        return $this->stubPath;
    }

    /**
     * Controller path for the codeigniter application.
     *
     * @return string
     */
    public function getAppControllerPath()
    {
        return $this->appControllerPath;
    }

    /**
     *
     *
     */
    public function appModelPath()
    {
        return $this->appModelPath;
    }

    /**
     * Check if a given file exists.
     *
     * @param  string           $filepath  The full filepath to be checked.
     * @param  OutputInterface  $output    An Output interface instance.
     * @return mixed
     */
    protected function checkFileExists($filepath, $output)
    {
        if (! file_exists($fullPath = $filepath)) {
            return $fullPath;
        } else {
            $formatter = $this->getHelper('formatter');
            return $output->writeln('<error>The controller already exists.</error>');
        }
    }

    /**
     * @todo docblock
     */
    protected function getStubContent($filePath, $name)
    {
        $stub = file_get_contents($filePath);
        $stub = str_replace('{{ class }}', ucfirst($name), $stub);

        return $stub;
    }

    /**
     * @todo docblock
     */
    protected function writeFile($filename, $stub)
    {
        if (file_put_contents($filename, $stub)) {
            return true;
        }

        return false;
    }
}
