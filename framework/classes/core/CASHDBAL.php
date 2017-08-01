<?php

namespace CASHMusic\Core;

use CASHMusic\Core\CASHSystem;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class CASHDBAL {

    public static function entityManager($pdo)
    {
        $paths = array(CASH_PLATFORM_ROOT."/classes/entities");
        $isDevMode = true;

        $cash_db_settings = CASHSystem::getSystemSettings();

        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => $cash_db_settings['username'],
            'password' => $cash_db_settings['password'],
            'dbname'   => $cash_db_settings['database'],
        );

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $config->addEntityNamespace("CASHMusic", "CASHMusic\\Entities\\");

        return EntityManager::create($dbParams, $config);
    }

    public static function queryBuilder() {
        $db = self::entityManager();
        return $db->createQueryBuilder();
    }




}