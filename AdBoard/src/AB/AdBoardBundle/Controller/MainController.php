<?php

namespace AB\AdBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function showMainAction()
    {
        return $this->render('main/show_main.html.twig', array(
            // ...
        ));
        
        
    }
        /**
     * Lists all category entities.
     *
     * @Route("/", name="all_categories")
     * @Method("GET")
     */


}
