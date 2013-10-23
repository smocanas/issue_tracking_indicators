<?php

namespace P5indicatori\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use P5indicatori\UserBundle\Form\Type\BaseFilterFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use P5indicatori\UserBundle\Document\User;
use P5indicatori\UserBundle\Document\Source;

class FormFilterController extends DefaultController {

    public function addFormsAction($id) {
        if (!empty($id)) {
            $userSource = $this->get('doctrine_mongodb')
                    ->getRepository('P5indicatoriUserBundle:Source')
                    ->find($id);
            $isUserOwner = $this->isUserOwner($userSource);
            if ((count($userSource) > 0 ) && ($isUserOwner)) {
                $formConfig['userSource'] = $userSource;
                $formConfig['trackerTypeObject'] = $this->createDynamicObjectBySourceType($userSource);
                $baseFilterForm = $this->createForm(new BaseFilterFormType($this->container, $formConfig));
                
//                print "OK controller.";
//                die;
                return $this->render('P5indicatoriUserBundle:BaseFilter:baseFilter.html.twig', array(
                            'form' => $baseFilterForm->createView(),
                            'page_title' => 'z',
                ));
            } else {
                $message = "You are not owner of this source.";
                return $this->render('P5indicatoriUserBundle:Sources:sourceErrorMessage.html.twig', array(
                            'message' => $message,
                ));
            }
        }
    }

    /**
     * Check if current Source belongs to current logged user.
     * @param object $returnedSource
     * @return boolean
     */
    public function isUserOwner($returnedSource) {
        $loggedInUser = $this->container->get('security.context')->getToken()->getUser();
        if (count($returnedSource) > 0) {
            if ($loggedInUser == $returnedSource->getOwnerSource()) {
                return true;
            }
        }
        return false;
    }

}
