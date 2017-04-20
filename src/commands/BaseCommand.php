<?php

namespace ActivismeBe\Artillery\Commands;

use Symfony\Component\Console\Command\Command;

/**
 * @todo docblock
 */
class BaseCommand extends Command
{
    protected $stubpath;
    protected $appControllerPath;
    protected $appModelPath;

    /**
     * BaseCommand constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->stubPath          = '../stubs';
        $this->appControllerPath = './application/controllers';
        $this->appModelPath      = './application/models';
    }

    /**
     * @todo docblock
     */
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

    public function appModelPath()
    {
        return $this->appModelPath;
    }
}
