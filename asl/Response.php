<?php

/*
 * chathura widanage <chathurawidanage@gmail.com>
 */

/**
 * Description of Response
 *
 * @author Chathura
 */
class Response {

    const SUCCESS = 200;
    const ERROR_DATABASE = 100;
    const ERROR_SERVICE = 101;

    public $error;
    public $payload;
    public $id;
    public $word;
    public $data;
    public $type;

}
