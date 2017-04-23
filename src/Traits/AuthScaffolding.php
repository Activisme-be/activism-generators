<?php

namespace ActivismeBe\Artillery\Traits;


use Symfony\Component\Console\Output\OutputInterface;

trait AuthScaffolding
{
	public function makeViews(OutputInterface $output)
	{

	}

	public function makeController(OutputInterface $output)
	{

	}

    /**
     * Create the needed database models.
     *
     * @param  string
     * @param  string
     * @param  OutputInterface $output
     * @return void
     */
	public function makeModels($stubPath, $modelPath, OutputInterface $output)
	{
		$stubData = file_get_contents("{$stubPath}/auth/model.stub");

		// Generation Ability Model.
		$abilityName    = ucfirst('abilities');
		$prepareAbility = str_replace('{{ class }}', $abilityName, $stubData);
		$prepareAbility = str_replace('{{ fields }}', "'name', 'description'", $prepareAbility);
		$prepareAbility = str_replace('{{ table }}', 'auth_abilities', $prepareAbility);

		if (! file_exists($abilityModelPath = "{$modelPath}/{$abilityName}.php")) {
			file_put_contents($abilityModelPath, $prepareAbility);
			$output->writeln('<info>Ability Model created</info>');
		} else {
			$output->writeln('<error>Ability model already exists.</error>');
		}
		//> END Generation Ability Model.

        // Generation Ban model.
		$banName    = ucfirst('bans');
        $prepareBan = str_replace('{{ class }}', $banName, $stubData);
        $prepareBan = str_replace('{{ fields }}', "'author_id', 'reason'", $prepareBan);
        $prepareBan = str_replace('{{ table }}', 'auth_bans', $prepareBan);

        if (! file_exists($banModelPath = "{$modelPath}/{$banName}.php")) {
            file_put_contents($banModelPath, $prepareBan);
            $output->writeln('<info>Ban model has been created.</info>');
        } else {
            $output->writeln('<error>Ban model already exists.</error>');
        }
        //> End generation Ban model.

        // Generation Permissions model.
		$permissionsName    = ucfirst('permissions');
        $preparePermissions = str_replace('{{ class }}', $permissionsName, $stubData);
        $preparePermissions = str_replace('{{ fields }}', "'name', 'description'", $preparePermissions);
        $preparePermissions = str_replace('{{ table }}', 'auth_permissions', $preparePermissions);

        if (! file_exists($permissionsModelPath = "{$modelPath}/{$permissionsName}.php")) {
            file_put_contents($permissionsModelPath, $preparePermissions);
            $output->writeln('<info>Permissions model has been created.</info>');
        } else {
            $output->writeln('<error>Permissions model already exists.</error>');
        }
        //>

        // Generation Authencate model.
		$authencateName    = ucfirst('authencate');
        $prepareAuthencate = str_replace('{{ class }}', $authencateName, $stubData);
        $prepareAuthencate = str_replace('{{ fields }}', "'ban_id', 'name', 'blocked', 'password', 'email', 'username'", $prepareAuthencate);
        $prepareAuthencate = str_replace('{{ table }}', 'auth_users', $prepareAuthencate);

        if (! file_exists($authencateModelPath = "{$modelPath}/{$authencateName}.php")) {
            file_put_contents($authencateModelPath, $prepareAuthencate);
            $output->writeln('<info>Authencation model has been created.</info>');
        } else {
            $output->writeln('<error>Authencation model already exists.</error>');
        }
        //>

		// Dump composer autoload.
		shell_exec('composer dump-autoload');
	}
}
