<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 22:33
 */

namespace WebAppId\DDD\Responses;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 18/04/20
 * Time: 18.55
 * Class AbstractResponse
 * @package WebAppId\DDD\Responses
 */
abstract class AbstractResponse
{
    /**
     * @var bool
     */
    protected $status;
    /**
     * @var string
     */
    protected $message;

    /**
     * @return bool
     * @deprecated
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @return bool
     * @deprecated
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @deprecated
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     * @deprecated
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @deprecated
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
