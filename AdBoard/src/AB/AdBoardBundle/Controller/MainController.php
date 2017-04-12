<?php

namespace AB\AdBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AB\AdBoardBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MainController extends Controller
{
    /**
     * @Route("/")
     */
    public function showMainAction()
    {
        return $this->render('ABAdBoardBundle:Main:show_main.html.twig', array(
            // ...
        ));
        
        
    }
//        /**
//     * Lists all category entities.
//     *
//     * @Route("/", name="all_categories")
//     * @Method("GET")
//     */
//    public function AllCategoriesAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $categories = $em->getRepository('ABAdBoardBundle:Category')->findAll();
//
//        return $this->render('ABAdBoardBundle:Main:show_main.html.twig', array(
//            'categories' => $categories,
//        ));
//    }

}
