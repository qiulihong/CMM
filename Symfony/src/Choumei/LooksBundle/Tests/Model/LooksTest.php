<?php
/**
 * @author Leon Qiu
 * 
 * @copyright Choumei.me 
 * @version 0.0.1
 * 
 * This Test case is related to Looks entity
 */

namespace Choumei\LooksBundle\Tests\Model;

use Choumei\LooksBundle\Entity\Looks;
use Choumei\LooksBundle\Entity\LooksRepository;

class LooksTest extends \PHPUnit_Framework_TestCase
{
  public function testDefatul()
  {
    date_default_timezone_set('Australia/ACT');
    $t  = null;
    $this->assertNULL($t);
  }
  
  public function testGetLatestLooks()
  {
    $looksRep  = new 
  }
}