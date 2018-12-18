<?php

namespace App\Tests;

use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;

trait TestDatabaseManagerTrait
{
    /**
     * @var Application
     */
    protected static $application;

    /**
     * @var KernelInterface
     */
    protected static $kernel;

    protected static function getApplication()
    {
        if (null === self::$application) {
            self::$application = new Application(self::$kernel);
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }

    protected static function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);

        return self::getApplication()->run(new StringInput($command));
    }

    public static function updateDatabaseSchema()
    {
        // Make sure we are in the test environment
        if ('test' !== self::$kernel->getEnvironment()) {
            throw new \LogicException('This method must be executed in the test environment');
        }

//        // Get the entity manager from the service container
//        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
//
//        // Run the schema update tool using our entity metadata
//        $metadata = $em->getMetadataFactory()->getAllMetadata();
//        $schemaTool = new SchemaTool($em);
//        $schemaTool->updateSchema($metadata);

        self::runCommand('doctrine:database:drop --force');
        self::runCommand('doctrine:database:create');
        self::runCommand('doctrine:schema:create');
    }
}
