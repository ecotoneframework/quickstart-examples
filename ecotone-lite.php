<?php

use DI\Container;
use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\GatewayAwareContainer;
use Ecotone\Messaging\Config\ServiceConfiguration;
use Ecotone\Messaging\Support\Assert;

function createMessaging(array $containerServices, ?string $namespaceToLoad, string $catalog, ?string $serviceName = null): \Ecotone\Messaging\Config\ConfiguredMessagingSystem
{
    $rootCatalog = __DIR__ . "/" . $catalog;
    if (!isset ($containerServices)) {
        $containerServices = [];
    }

    $container = new class($containerServices) implements GatewayAwareContainer {
        private Container $container;

        public function __construct(array $containerServices)
        {
            $this->container = new Container();
            foreach ($containerServices as $serviceName => $service) {
                $this->container->set($serviceName, $service);
            }
        }

        public function get($id)
        {
            return $this->container->get($id);
        }

        public function has($id)
        {
            return $this->container->has($id);
        }

        public function addGateway(string $referenceName, object $gateway): void
        {
            $this->container->set($referenceName, $gateway);
        }
    };

    $serviceConfiguration = ServiceConfiguration::createWithDefaults();

    if ($namespaceToLoad) {
        $serviceConfiguration = $serviceConfiguration
            ->withNamespaces([$namespaceToLoad]);
    }

    if ($serviceName) {
        $serviceConfiguration = $serviceConfiguration
            ->withServiceName($serviceName);
    }

    return EcotoneLiteConfiguration::createWithConfiguration(
        $rootCatalog,
        $container,
        $serviceConfiguration,
        [],
        false
    );
}