<?php

namespace Choumei\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChoumeiSecurityBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
