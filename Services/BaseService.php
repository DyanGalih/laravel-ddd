<?php

/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 21:58
 */

namespace WebAppId\DDD\Services;

use Illuminate\Container\Container;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class BaseService
 */
class BaseService
{
    /**
     * @var Container
     */
    private $container;
    
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