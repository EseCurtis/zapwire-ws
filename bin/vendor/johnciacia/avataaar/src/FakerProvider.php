<?php

namespace Avataaar;

/**
 *
 */
class FakerProvider extends \Faker\Provider\Base
{
    
    /**
     *
     */
    public function avataaar(): string
    {
        return (new Avataaar())->url();
    }
}
