<?php

namespace App\utils;

use PhpParser\Node\Expr\Cast\Object_;

class ReponseEntity
{

    private String $message;
    private String $code;

    private array $data;

    /**
     * @param String $message
     * @param String $code
     * @param array $data
     */
    public function __construct(string $message, string $code, array $data)
    {
        $this->message = $message;
        $this->code = $code;
        $this->data = $data;
    }

    /**
     * @param String $message
     * @param String $code
     * @param Object_ $data
     */


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

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }



}
