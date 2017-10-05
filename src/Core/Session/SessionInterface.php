<?php

namespace Core\Session;


interface SessionInterface
{

    /**
     * @param string $index
     * @return mixed
     */
    public function get(string $index);

    /**
     * @param string $index
     * @param $value
     */
    public function set(string $index, $value) :void;

    /**
     * @param string $index
     */
    public function delete(string $index) :void;

}