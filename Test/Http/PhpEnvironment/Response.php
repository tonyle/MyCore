<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 1/17/15
 * Time: 6:47 PM
 */
namespace MyCore\Test\Http\PhpEnvironment;

class Response extends \Zend\Http\PhpEnvironment\Response
{
    public function sendHeaders()
    {
        $this->headersSent = true;
        return $this;
    }

    public function sendContent()
    {
        $this->contentSent = true;
        return $this;
    }
}