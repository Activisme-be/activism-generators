<?php

namespace ActivismeBe\Artillery\Tests;

use ActivismeBe\Artillery\Commands\ControllerCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @todo docblock
 */
class CreateControllerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @todo Create the testing logic
     */
    public function CreateEmptyController()
    {
        $application = new Application();
		$application->add(new ControllerCommand);

		$command       = $application->find('make:controller');
		$commandData   = ['command' => $command->getName(), 'name'    => rand(0, 2437)];
		$commandTester = new CommandTester($command);
		$commandTester->execute($commandData);

		$output = $commandTester->getDisplay();

		$this->assertContains('Empty controller created successfully!', $output);
    }

    /**
     * @test
     * @todo Create the testing logic
     */
    public function CreateResourceController()
    {
        //
    }

    /**
     * @test
     * @todo Create the testing logic
     */
    public function CreateApiController()
    {
        //
    }

    /**
     * @test
     * @todo Create the testing logic.
     */
     public function ControllerAlreadyExist()
     {
         //
     }

     public function setUp()
     {
         $path = 'application/controllers';

         if (! file_exists($path)) {
             mkdir($path, 755, true);
         }
     }

     public function tearDown()
     {
         $path = 'application/controllers';

         if (! file_exists($path)) {
             rrmdir($path, 755, true);
         }
     }
}
