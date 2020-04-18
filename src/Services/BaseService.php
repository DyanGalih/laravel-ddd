<?php

/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 21:58
 */

namespace WebAppId\DDD\Services;

use Illuminate\Container\Container;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 18/04/20
 * Time: 18.55
 * Class BaseService
 * @package WebAppId\DDD\Services
 */
class BaseService
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * BaseService constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return Container
     */
    protected function getContainer(): Container
    {
        return $this->container;
    }
}
