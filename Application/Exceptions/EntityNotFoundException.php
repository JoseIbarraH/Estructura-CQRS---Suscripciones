<?php

class EntityNotFoundException extends Exception {
    public function __construct($message = "", $code = 0, $throwable = null) {
        parent::__construct($message, $code, $throwable);
    }
}