<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Command\Command;

class BaseCommand extends Command
{
    protected $stubpath;
    protected $appControllerPath;

    /**
     * BaseCommand constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->stubPath          =
        $this->appControllerPath =
    }

    public function stubPath()
    {
        $this->stubpath;
    }

    /**
     * Controller path for the codeigniter application.
     *
     */
    public function appControllerPath()
    {
        return $this->appControllerPath;
    }

    /**
     * Check if the controller already exists
     *
     * @return bool
     */
    public function controllerExists()
    {
        if (! file_exists($fullPath = "{$this->appControllerPath()}/{$controller}.php") {
            return true;
        }

        return false;
    }
}
