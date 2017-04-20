<?php

namespace ActivismeBe\Artillery\Tests;

use ActivismeBe\Artillery\Commands\ModelCodeigniterCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CreateModelTest extends \PHPUnit\Framework\TestCase
{
	public function testExecute()
	{
		$application = new Application();
		$application->add(new ModelCodeigniterCommand);

		$command = $application->find('make:model-CodeIgniter');
		$commandTester = new CommandTester($command);
		$commandTester->execute([
			'command' => $command->getName()
		]);
	}
}
