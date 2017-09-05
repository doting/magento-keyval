<?php

interface Doting_KeyVal_Model_Storage {

    public function set($key, $value);

    public function get($key);

    public function has($key);

    public function remove($key);

}
