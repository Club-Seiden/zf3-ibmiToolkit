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

        /** @var Adapter $databaseAdapter */
        $databaseAdapter = $container->get($container->get('Config')['ibmi_toolkit_module']['databaseAdapterService']);

        $toolkit = new Toolkit(
            $databaseAdapter->getDriver()->getConnection()->getResource(),
            '0'
        );

        $toolkit->setOptions($container->get('Config')['ibmi_toolkit']);

        return $toolkit;
    }
}
