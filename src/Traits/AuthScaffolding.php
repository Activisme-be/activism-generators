<?php

namespace ActivismeBe\Artillery\Traits;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AuthScaffolding
 *
 * @package ActivismeBe\Artillery\Traits
 */
trait AuthScaffolding
{
    /**
     * Make the views in the application.
     *
     * @param  string           $stubPath
     * @param  string           $viewsPath
     * @param  OutputInterface  $output
     * @return void
     */
	public function makeViews($stubPath, $viewsPath, OutputInterface $output)
	{
        //
	}


    /** 
     * @param  string           $stubPath           The path to the authencation stubs. 
     * @param  string           $controllerPath     
     * @param  OutputInterface  $output
     * @return void
     */ 
	public function makeController($stubPath, $controllerPath, OutputInterface $output)
    {
        $stubData = file_get_contents("{$stubPath}/auth/authencation.stub");

        if (! file_exists($controllerPath = "{$controllerPath}/Authencation.php")) {
            file_put_contents($controllerPath, $stubData); 
            $output->writeln('<info>The controller has been created');
        } else {
            $output->writeln('<error>The controller already exists.</error>');
        }
    }

    /**
     * Create the authencation tables in the database.
     *
     * @param  string           $database The database name.
     * @param  string           $user The database user.
     * @param  string           $password The database user his password.
     * @param  int|string       $host The host for the database.
     * @param  integer          $port The port from the database server.
     * @param  OutputInterface  $output An output interface instance
     * @return void
     */
	public function makeDatabase($database = 'localhost', $user, $password, $host = 3306, $port, OutputInterface $output)
    {
        try {
            $dsn      = "mysql: dbname={$database};host={$host};port={$port}";
            $stubPath = __DIR__ . '/../stubs/auth/migrations';

            $server = new \PDO($dsn, $user, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);

            $server->query(file_get_contents("{$stubPath}/migration-ban.sql"));
            $server->query(file_get_contents("{$stubPath}/migration-users.sql"));
            $server->query(file_get_contents("{$stubPath}/migration-permissions.sql"));
            $server->query(file_get_contents("{$stubPath}/migration-abilities.sql"));
            $server->query(file_get_contents("{$stubPath}/migration-relations.sql"));

            $server = null; // Close DB server connection.

            $output->writeln('<info>The database is migrated.</info>');
        } catch (\PDOException $exceptionData) {
            throw new \ActivismeBe\Artillery\Exceptions\DatabaseException($exceptionData);
        }
    }

    /**
     * Create the needed database models.
     *
     * @param  string           $stubPath   The path to the authencation stubs. 
     * @param  string           $modelPath  The path to the application models. 
     * @param  OutputInterface  $output     An Output Interface instance. 
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
