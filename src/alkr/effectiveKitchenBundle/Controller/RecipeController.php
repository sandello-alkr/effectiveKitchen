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
use Doctrine\Common\Collections\ArrayCollection;

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

        $originalFlows = new ArrayCollection();
        foreach ($entity->getFlows() as $flow) {
            $originalFlows->add($flow);
        }

        $form = $this->createForm(new RecipeType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($originalFlows as $flow) {
                if (false === $task->getTags()->contains($flow)) {
                    // if it was a many-to-one relationship, remove the relationship like this
                    $flow->setTask(null);
                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($tag);
                }
            }
            $em->persist($entity);
            $em->flush();
            return $this->handleView($this->view(true));
        }
        dump($form->getErrors(true));
        // dump($form->getErrors());die;

        return $this->handleView($this->view(false));
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
