<?php
namespace Los\ApiClient;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\ResourceGenerator;

class ApiClientFactory
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ApiClient
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, array $options = null)
    {
        $config = $container->get('config');

        $clientConfig = $config['los']['api-client'] ?? [];

        return new ApiClient(
            $clientConfig['root_url'] ?? '',
            $container->get(ResourceGenerator::class),
            new HttpClient\Guzzle6HttpClient(),
            $clientConfig
        );
    }
}