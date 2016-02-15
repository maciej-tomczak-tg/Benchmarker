<?php

namespace BenchmarkerBundle\Email;


interface EmailInterface
{
    /**
     * @return string
     */
    public function getReceiver();

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return string
     */
    public function getSubject();
}
