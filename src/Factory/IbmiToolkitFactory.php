<?php

namespace ZfIbmiToolkit\Factory;

use Interop\Container\ContainerInterface;
use ToolkitApi\Toolkit;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Class IbmiToolkitFactory
 * @package ZfIbmiToolkit
 */
final class IbmiToolkitFactory implements FactoryInterface 
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Toolkit
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var ServiceManager $container **/

        /** @var array $toolkitConfig */
        $toolkitConfig = $container->get('Config')['ibmi_toolkit'];

        /** @var Adapter $databaseAdapter */
        $databaseAdapter = $container->get($toolkitConfig['databaseAdapterService']);

        $toolkit = new Toolkit(
            $databaseAdapter->getDriver()->getConnection()->getResource(),
            '0'
        );

        $toolkit->setOptions($toolkitConfig['system']);

        return $toolkit;
    }
}
