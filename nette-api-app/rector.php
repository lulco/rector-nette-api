<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Nette\Rector\ClassMethod\RemoveParentAndNameFromComponentConstructorRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void
{
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

    $parameters->set(Option::SETS, [
        SetList::NETTE_30,
    ]);

    $parameters->set(Option::SKIP, [
        RemoveParentAndNameFromComponentConstructorRector::class
    ]);

    $services = $containerConfigurator->services();
    $services->set(RenameClassRector::class)->call('configure', [[
        RenameClassRector::OLD_TO_NEW_CLASSES => [
            'Klimesf\NetteRequestId\Provider' => 'Efabrica\Nette\DI\Extension\RequestId\Provider',
        ]
    ]]);

    $containerConfigurator->import(__DIR__ . '/../external-rules/vendor/efabrica/rector-tomaj-nette-api/src/Sets/tomaj-nette-api-1.x.x-2.0.0.php');
};
