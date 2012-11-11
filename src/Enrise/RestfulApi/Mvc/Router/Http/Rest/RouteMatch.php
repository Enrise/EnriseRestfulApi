<?php
/**
 * Enrise RestfulApi  (http://enrise.com/)
 *
 * @link      https://github.com/Enrise/EnriseRestfulApi for the canonical source repository
 * @copyright Copyright (c) 2012 Dolf Schimmel - Freeaqingme (dolfschimmel@gmail.com)
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license   New BSD License, see LICENSE.MD
 */

namespace Enrise\RestfulApi\Mvc\Router\Http\Rest;

use Enrise\RestfulApi\Mvc\Router\Http\Rest as HttpRoute;
use Zend\Http\Request;
use Zend\Mvc\Router\Http\RouteMatch as HttpRouteMatch;
use SplQueue;

/**
 * RouteInterface match.
 *
 * @package    Zend_Mvc_Router
 */
class RouteMatch extends HttpRouteMatch
{
    const PATH_SEPARATOR = '/';

    /**
     *
     * @var \SplQueue
     */
    protected $urlParts;

    /**
     * Create a part RouteMatch with given parameters and length.
     *
     * @param  Request        $request
     * @param  HttpRoute      $route
     * @param  HttpRouteMatch $match
     *
     * @todo evaluate if we should do something with $match->getLength()
     */
    public function __construct(Request $request, HttpRoute $route, HttpRouteMatch $match)
    {
        parent::__construct(array('controller' => $match->getParam('controller'),
                                  'action'     => $match->getParam('action')));

        $this->length = $match->getLength();
        $path = substr(
                    $request->getUri()->getPath(),
                    strlen($route->getRoutePath())
        );

        $parts = explode(self::PATH_SEPARATOR, $path);
        if (!reset($parts)) { // First element is empty
            array_shift($parts);
        }

        $stack = new SplQueue();
        array_map(function($val) use ($stack) { $stack[] = $val; }, $parts);
        $stack->rewind();
        $this->urlParts = $stack;
    }

    /**
     *
     * @return \Zend\StdLib\SplQueue
     */
    public function getUrlParts()
    {
        return $this->urlParts;
    }

}
