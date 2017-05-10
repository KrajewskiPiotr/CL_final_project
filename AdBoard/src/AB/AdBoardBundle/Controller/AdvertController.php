<?php

namespace AB\AdBoardBundle\Controller;
use AB\AdBoardBundle\Entity\Comment;
use AB\AdBoardBundle\Entity\Advert;
use AB\AdBoardBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AB\AdBoardBundle\Form\AdvertType;
use Symfony\Component\HttpFoundation\File\File;
use AB\AdBoardBundle\Repository\AdvertRepository;

/**
 * Advert controller.
 *
 * @Route("advert")
 */
class AdvertController extends Controller
{

    /**
     * Lists all advert entities.
     *
     * @Route("/", name="advert_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('ABAdBoardBundle:Advert')->findAll();

        return $this->render('advert/index.html.twig', array(
            'adverts' => $adverts,
        ));
    }

    /**
     * Creates a new advert entity.
     *
     * @Route("/new", name="advert_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $advert = new Advert();
        $advert->setUser($this->getUser());
        $advert->setCreationTime(new \DateTime());
        $form = $this->createForm('AB\AdBoardBundle\Form\AdvertType', $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//stores uploaded image
            $file = $advert->getImage();
//generate unique name
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move($this->getParameter('images_dir'), $fileName);
            $advert->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('advert_show', array('id' => $advert->getId()));
        }

        return $this->render('advert/new.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a advert entity.
     *
     * @Route("/{id}", name="advert_show")
     * @Method("GET")
     */
    public function showAction(Advert $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);

        return $this->render('advert/show.html.twig', array(
            'advert' => $advert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing advert entity.
     *
     * @Route("/{id}/edit", name="advert_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Advert $advert)
    {


        $oldImagePath = $this->getParameter('images_dir') . '/' . $advert->getImage();
        $oldImageName = $advert->getImage();
        $advert->setImage($oldImageName);
        $image = new File($oldImagePath);
        $advert->setImage($image);


        $deleteForm = $this->createDeleteForm($advert);
        $editForm = $this->createForm('AB\AdBoardBundle\Form\AdvertType', $advert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advert_edit', array('id' => $advert->getId()));
        }

        return $this->render('advert/edit.html.twig', array(
            'advert' => $advert,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a advert entity.
     *
     * @Route("/{id}", name="advert_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Advert $advert)
    {
        $form = $this->createDeleteForm($advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();
        }

        return $this->redirectToRoute('advert_index');
    }

    /**
     * Creates a form to delete a advert entity.
     *
     * @param Advert $advert The advert entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Advert $advert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('advert_delete', array('id' => $advert->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @Route("/last/Ten", name="last_ten")
     */
    public function LastTenAdvertsAction()
    {
        $em = $this->getDoctrine()->getRepository('ABAdBoardBundle:Advert');
        $adverts = $em->lastTen();
        return $this->render('advert/lastTen.html.twig', array(
            'adverts' => $adverts
        ));
    }

}
