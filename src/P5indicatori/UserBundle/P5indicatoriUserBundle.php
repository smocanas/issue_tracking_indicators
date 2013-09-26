<?php

namespace P5indicatori\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class P5indicatoriUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
