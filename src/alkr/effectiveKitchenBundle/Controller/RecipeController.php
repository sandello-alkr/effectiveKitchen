<?php

namespace alkr\effectiveKitchenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use alkr\effectiveKitchenBundle\Entity\Recipe;
use alkr\effectiveKitchenBundle\Form\RecipeType;

/**
 * Recipe controller.
 *
 * @Route("/recipe")
 */
class RecipeController extends FOSRestController
{

    /**
     * Lists all Recipe entities.
     *
     * @Route("/", name="recipe")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EKBundle:Recipe')->findAll();

        return $this->handleView($this->view($entities));
    }

    /**
     * Creates a new Recipe entity.
     *
     * @Route("/", name="recipe_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Recipe();
        $form = $this->createForm(new RecipeType(), $entity);
        $form->submit($request, false);
        $em->persist($entity);
        $em->flush();

        return $this->handleView($this->view(true));
    }

    /**
     * Finds and displays a Recipe entity.
     *
     * @Route("/{id}", name="recipe_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EKBundle:Recipe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recipe entity.');
        }

        return $this->handleView($this->view($entity));
    }

    /**
     * Edits an existing Recipe entity.
     *
     * @Route("/{id}", name="recipe_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EKBundle:Recipe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recipe entity.');
        }

        $form = $this->createForm(new RecipeType(), $entity);
        $form->submit($request, false);

        $em->flush();

        return $this->handleView($this->view(true));
    }

    /**
     * Deletes a Recipe entity.
     *
     * @Route("/{id}", name="recipe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EKBundle:Recipe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recipe entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->handleView($this->view(true));
    }
}
