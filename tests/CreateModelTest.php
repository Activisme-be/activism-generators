<?php

namespace ActivismeBe\Artillery\Tests;

use ActivismeBe\Artillery\Commands\ModelCodeigniterCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @todo docblock
 */
class CreateModelTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @test
	 */
	public function ModelCodeigniterCreateWithoutSuffix()
	{
		$application = new Application();
		$application->add(new ModelCodeigniterCommand);

		$command       = $application->find('make:model-codeigniter');
		$commandData   = ['command' => $command->getName(), 'name'    => 'test'];
		$commandTester = new CommandTester($command);
		$commandTester->execute($commandData);

		$output = $commandTester->getDisplay();

		$this->assertContains('Model created successfully!', $output);
		$this->assertTrue(file_exists("./application/models/{$commandData['name']}_m.php"));
		// TODO: check if the generated model is the same as the stub.
	}

    /**
     * @test
     * @todo create test
     */
    public function ModelCodeigniterCreateWithCustomSuffix()
    {
    	//
    }

    /**
     * @test
     * @todo create test
     */
    public function ModelCodeigniterModelAlreadyExists()
    {
    	//
    }

	/**
	 * @todo docblock
	 */
	public function tearDown()
    {
        //
    }
}
