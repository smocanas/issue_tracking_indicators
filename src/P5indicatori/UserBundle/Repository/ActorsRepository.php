<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
/**
 * Description of ActorsRepository
 *
 * @author mtamazlicaru
 */
class ActorsRepository extends DocumentRepository {

    public function getAllActorsNames() {
        return $this->createQueryBuilder()
                    ->field('name')->prime(true)
                    ->getQuery()->execute();
    }

}

?>
