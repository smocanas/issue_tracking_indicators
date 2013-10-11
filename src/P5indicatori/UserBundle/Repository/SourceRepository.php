<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Description of SourceRepository
 *
 * @author mtamazlicaru
 */
class SourceRepository extends DocumentRepository{
    
    public function getUserSourcesByType($username, $sourceType) {
        $queryBuilder = $this->createQueryBuilder();

        $result = $queryBuilder->addAnd($queryBuilder->expr()->field('ownerSource')->equals($username))
                ->addAnd($queryBuilder->expr()->field('tracking_types')->equals($sourceType))
                ->sort('source_name', 'ASC')
                ->getQuery()
                ->execute()
                ->toArray();

        return $result;
    }
}

?>
