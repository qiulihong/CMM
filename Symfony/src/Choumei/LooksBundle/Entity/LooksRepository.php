<?php
namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\EntityRepository;

class LooksRepository extends EntityRepository
{
  public function getAllLatestLooks()
  {
    $query  = $this->createQueryBuilder('l')
                ->where('l.id > 0')
                ->orderBy('l.id', 'DESC')
                ->getQuery();
    
    $looks  = $query->getResult();            
    return $looks;
  }
}