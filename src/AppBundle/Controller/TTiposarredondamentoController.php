<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\TTiposarredondamento;
use AppBundle\Form\TTiposarredondamentoType;

/**
 * TTiposarredondamento controller.
 *
 * @Route("/ttiposarredondamento")
 */
class TTiposarredondamentoController extends Controller
{

    /**
     * Lists all TTiposarredondamento entities.
     *
     * @Route("/", name="ttiposarredondamento")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:TTiposarredondamento')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new TTiposarredondamento entity.
     *
     * @Route("/", name="ttiposarredondamento_create")
     * @Method("POST")
     * @Template("AppBundle:TTiposarredondamento:new.html.twig")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $entity = new TTiposarredondamento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ttiposarredondamento_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TTiposarredondamento entity.
     *
     * @param TTiposarredondamento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TTiposarredondamento $entity)
    {
        $form = $this->createForm(new TTiposarredondamentoType(), $entity, array(
            'action' => $this->generateUrl('ttiposarredondamento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TTiposarredondamento entity.
     *
     * @Route("/new", name="ttiposarredondamento_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TTiposarredondamento();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TTiposarredondamento entity.
     *
     * @Route("/{id}", name="ttiposarredondamento_show")
     * @Method("GET")
     * @Template()
     * @param $id
     * @return array
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TTiposarredondamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TTiposarredondamento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TTiposarredondamento entity.
     *
     * @Route("/{id}/edit", name="ttiposarredondamento_edit")
     * @Method("GET")
     * @Template()
     * @param $id
     * @return array
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TTiposarredondamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TTiposarredondamento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a TTiposarredondamento entity.
    *
    * @param TTiposarredondamento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TTiposarredondamento $entity)
    {
        $form = $this->createForm(new TTiposarredondamentoType(), $entity, array(
            'action' => $this->generateUrl('ttiposarredondamento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing TTiposarredondamento entity.
     *
     * @Route("/{id}", name="ttiposarredondamento_update")
     * @Method("PUT")
     * @Template("AppBundle:TTiposarredondamento:edit.html.twig")
     * @param Request $request
     * @param $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TTiposarredondamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TTiposarredondamento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ttiposarredondamento_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TTiposarredondamento entity.
     *
     * @Route("/{id}", name="ttiposarredondamento_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:TTiposarredondamento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TTiposarredondamento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ttiposarredondamento'));
    }

    /**
     * Creates a form to delete a TTiposarredondamento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ttiposarredondamento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
