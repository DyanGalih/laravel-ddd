<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 22:44
 */

namespace WebAppId\DDD\Controllers;

use Illuminate\Container\Container;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class BaseController
 * @package WebAppId\DDD\Controllers
 */
class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /**
     * @var Container
     */
    private $container;
    
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * @return Container
     */
    protected function getContainer()
    {
        return $this->container;
    }
}