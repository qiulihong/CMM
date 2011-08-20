<?php
namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\EntityRepository;

class LooksRepository extends EntityRepository
{
  /*
  public function getLatestLooks()
  {
    $query  = $this->createQueryBuilder('l')
                ->where('id > 0')
                ->orderBy('id', 'DESC')
                ->getQuery();
    
    $looks  = $query->getResult();            
    return $looks;
  }
  */
}