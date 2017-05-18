<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Command\Command;

/**
 * BaseCommand
 *
 * @author      Tim Joosten   <Topairy@gmail.com>
 * @copyright   Tim Joosten   <Topairy@gmail.com>
 * @license:    MIT license
 * @since       2017
 * @package     ActivismeBe\Artillery\Commands
 */
class BaseCommand extends Command
{
	protected $stubPath;            /** @var string $stubPath 			The path to the stubs.        			*/
    protected $appControllerPath;   /** @var string $appControllerPath 	The path to the application controllers.*/
    protected $appModelPath;        /** @var string $appModelPath		The path to the application models      */
	protected $appLibraryPath;     	/** @var string $appLibraryPath		The path for the application libraries. */
    protected $appViewPath;         /** @var string $appViewPath        The path to the application views.      */
    protected $appMiddlewarePath;   /** @var string $appMiddlewarePath  The path to the application middlewares */

    /**
     * BaseCommand constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->stubPath           = __DIR__ . '/../stubs';
        $this->appControllerPath  = './application/controllers';
        $this->appModelPath       = './application/models';
        $this->appLibraryPath     = './application/libraries';
        $this->appViewPath        = './application/view';
        $this->appMiddlewarePath  = './application/middlewares'; 
    }

	/**
	 * Get the path for the package stubs.
	 *
	 * @return string
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
	 * Model path for the codeigniter application.
	 *
	 * @return string
	 */
    public function getAppModelPath()
    {
        return $this->appModelPath;
    }

	/**
	 * Get the application library path.
	 *
	 * @return string
	 */
    public function getAppLibraryPath()
	{
		return $this->appLibraryPath;
	}

    /**
     * Get the application middleware path.
     *
     * @return string
     */
    public function getAppMiddlewarePath()
    {
        return $this->appMiddlewarePath;
    }

    /**
     * Get the application views path.
     *
     * @return string
     */
	public function getAppViewPath()
    {
        return $this->appViewPath;
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
            return $output->writeln('<error>The controller already exists.</error>');
        }
    }

	/**
	 * Get the content form the stub.
	 *
	 * @param  string $filePath
	 * @param  string $name			The name from the stub file.
	 * @return bool|mixed|string
	 */
    protected function getStubContent($filePath, $name)
    {
        $stub = file_get_contents($filePath);
        $stub = str_replace('{{ class }}', ucfirst($name), $stub);

        return $stub;
    }

	/**
	 * Write a new stub to it's destination.
	 *
	 * @param  string $filePath 	The path for the file.
	 * @param  mixed  $stub			The stub data.
	 * @return bool
	 */
    protected function writeFile($filePath, $stub)
    {
        if (file_put_contents($filePath, $stub)) {
            return true;
        }

        return false;
    }
}
