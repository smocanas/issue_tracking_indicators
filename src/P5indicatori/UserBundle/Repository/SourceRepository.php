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
                ->addAnd($queryBuilder->expr()->field('trackingTypes')->equals($sourceType))
                ->sort('sourceName', 'ASC')
                ->getQuery()
                ->execute()
                ->toArray();

        return $result;
    }
    
    public function getProjectDetailsByName($id,$projectKey){
        $queryBuilder = $this->createQueryBuilder();
//        db.Source.find( { "_id":ObjectId("5257e10c3b27c914218b4567") }, { "project_name": { $elemMatch: { "key": "UP" } } } )
        $result = $queryBuilder
                ->select("projectName")
                ->field('id')->equals($id)
                ->field('projectName')->elemMatch($queryBuilder->expr()->field('key')->equals($projectKey))
                ->getQuery()
                ->getSingleResult();

        return $result;
    }
}

?>
