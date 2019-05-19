<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 22:33
 */

namespace WebAppId\DDD\Responses;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class AbstractResponse
 */
abstract class AbstractResponse
{
    /**
     * @var bool
     */
    private $status;
    /**
     * @var string
     */
    private $message;
    
    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }
    
    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }
    
    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
    
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
    
    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}