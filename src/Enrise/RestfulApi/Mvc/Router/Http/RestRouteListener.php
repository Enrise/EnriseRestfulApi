<?php
/**
 * Enrise RestfulApi  (http://enrise.com/)
 *
 * @link      https://github.com/Enrise/EnriseRestfulApi for the canonical source repository
 * @copyright Copyright (c) 2012 Dolf Schimmel - Freeaqingme (dolfschimmel@gmail.com)
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license   New BSD License, see LICENSE.MD
 */

namespace Enrise\RestfulApi\Mvc\Router\Http;

use Enrise\RestfulApi\Mvc\Router\Http\Rest as RestRoute;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;

class RestRouteListener
{

    public function setupRoutes(MvcEvent $e)
    {
        $options = $e->getApplication()->getServiceManager()->get('Config');
        if (!isset($options['router']['apiRoutes'])) {
            return;
        }

        $sm = $e->getApplication()->getServiceManager();
        $router = $e->getApplication()->getServiceManager()->get('router');
        if (!$router instanceof HttpRouter) {
            return;
        }

        foreach($options['router']['apiRoutes'] as $key => $routeOptions) {
            $route = RestRoute::factory($routeOptions, $sm);
            $router->addRoute($key, $route);
        }
    }
}
