<?php
/**
 * Enrise RestfulApi  (http://enrise.com/)
 *
 * @link      https://github.com/Enrise/EnriseRestfulApi for the canonical source repository
 * @copyright Copyright (c) 2012 Dolf Schimmel - Freeaqingme (dolfschimmel@gmail.com)
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license   New BSD License, see LICENSE.MD
 */

namespace  Enrise\RestfulApi;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Enrise\RestfulApi\Mvc\Router\Http\RestRouteListener;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sharedEvents = $eventManager->getSharedManager();
        $restRouteListener   = new RestRouteListener();;
        $eventManager->attach(MvcEvent::EVENT_ROUTE, array($restRouteListener, 'setupRoutes'), 25);

    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ =>  __DIR__ . '/',
                ),
            ),
        );
    }
}
