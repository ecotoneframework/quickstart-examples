<?php

require __DIR__ . "/vendor/autoload.php";

use App\Domain\Command\RegisterNewTicket;
use Ecotone\Lite\EcotoneLiteApplication;
use Enqueue\Dbal\DbalConnectionFactory;
use Ramsey\Uuid\Uuid;

$messagingSystem = EcotoneLiteApplication::boostrap([DbalConnectionFactory::class => new DbalConnectionFactory('pgsql://ecotone:secret@database:5432/ecotone')]);
$commandBus = $messagingSystem->getCommandBus();
$queryBus = $messagingSystem->getQueryBus();

echo "Registers two next tickets:\n";
$commandBus->send(new RegisterNewTicket(Uuid::uuid4()->toString()));
$commandBus->send(new RegisterNewTicket(Uuid::uuid4()->toString()));
echo "Rerun the example to register new ones\n";