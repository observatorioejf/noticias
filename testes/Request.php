<?php

/**
 * Created by PhpStorm.
 * User: danilo.silva
 * Date: 04/08/2017
 * Time: 17:08
 */
class Request
{
    private $method;
    private $protocol;
    private $host;
    private $path;
    private $query_string;
    private $status;
    private $type;
    private $cathegory;
    private $size;
    private $transfer_size;
    
    function __construct($method, $protocol, $host, $path, $query_string, $status, $type, $cathegory, $size, $transfer_size)
    {
        $this->method = $method;
        $this->protocol = $protocol;
        $this->host = $host;
        $this->path = $path;
        $this->query_string = $query_string;
        $this->status = $status;
        $this->type = $type;
        $this->cathegory = $cathegory;
        $this->size = $size;
        $this->transfer_size = $transfer_size;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param mixed $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getQueryString()
    {
        return $this->query_string;
    }

    /**
     * @param mixed $query_string
     */
    public function setQueryString($query_string)
    {
        $this->query_string = $query_string;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCathegory()
    {
        return $this->cathegory;
    }

    /**
     * @param mixed $cathegory
     */
    public function setCathegory($cathegory)
    {
        $this->cathegory = $cathegory;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getTransferSize()
    {
        return $this->transfer_size;
    }

    /**
     * @param mixed $transfer_size
     */
    public function setTransferSize($transfer_size)
    {
        $this->transfer_size = $transfer_size;
    }
    
}