<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuBuilder
 *
 * @author mtamazlicaru
 */
namespace P5indicatori\UserBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createSidebarMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $item = $menu->addChild('Home', array('route' => 'p5indicatori_user_homepage'));
//        $item->setCurrent(true);
        $item = $menu->addChild('My sources', array('route' => 'p5indicatori_add_forms_filter'));
        // ... add more children

        return $menu;
    }
}