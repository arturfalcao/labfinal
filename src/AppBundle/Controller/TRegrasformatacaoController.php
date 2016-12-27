<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\TRegrasformatacao;
use AppBundle\Form\TRegrasformatacaoType;
use Symfony\Component\HttpFoundation\Response;


/**
 * TRegrasformatacao controller.
 *
 * @Route("/RegrasFormatacao")
 */
class TRegrasformatacaoController extends Controller
{

    /**
     * Lists all TRegrasformatacao entities.
     *
     * @Route("/", name="tregrasformatacao")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:TRegrasformatacao')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new TRegrasformatacao entity.
     *
     * @Route("/", name="tregrasformatacao_create")
     * @Method("POST")
     * @Template("AppBundle:TRegrasformatacao:new.html.twig")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $entity = new TRegrasformatacao();
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
     * Creates a form to create a TRegrasformatacao entity.
     *
     * @param TRegrasformatacao $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TRegrasformatacao $entity)
    {
        $form = $this->createForm(new TRegrasformatacaoType(), $entity, array(
            'action' => $this->generateUrl('tregrasformatacao_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TRegrasformatacao entity.
     *
     * @Route("/new", name="tregrasformatacao_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TRegrasformatacao();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TRegrasformatacao entity.
     *
     * @Route("/{id}", name="tregrasformatacao_show")
     * @Method("GET")
     * @Template()
     * @param $id
     * @return array
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TRegrasformatacao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TRegrasformatacao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TRegrasformatacao entity.
     *
     * @Route("/{id}/edit", name="tregrasformatacao_edit")
     * @Method("GET")
     * @Template()
     * @param $id
     * @return array
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TRegrasformatacao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TRegrasformatacao entity.');
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
    * Creates a form to edit a TRegrasformatacao entity.
    *
    * @param TRegrasformatacao $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TRegrasformatacao $entity)
    {
        $form = $this->createForm(new TRegrasformatacaoType(), $entity, array(
            'action' => $this->generateUrl('tregrasformatacao_update', array('id' => $entity->getFnId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Creates a new TRegrasformatacao entity.
     *
     * @Route("/GetAllRegrasFormatacao/{slug}")
     * @Method("Get")
     * @param $slug
     * @return Response
     */
    public function GetAllRegrasFormatacaoAction($slug)
    {
        $em = $this->getDoctrine()->getManager();



        $entities = $em->getRepository('AppBundle:TRegrasformatacao')->findBy(
            array('fnModeloresultado'=> $slug)
        );

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($entities,'json');


        return new Response(json_encode($response));

    }

    /**
     * Edits an existing TRegrasformatacao entity.
     *
     * @Route("/{id}", name="tregrasformatacao_update")
     * @Method("PUT")
     * @Template("AppBundle:TRegrasformatacao:edit.html.twig")
     * @param Request $request
     * @param $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TRegrasformatacao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TRegrasformatacao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tregrasformatacao_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TRegrasformatacao entity.
     *
     * @Route("/{id}", name="tregrasformatacao_delete")
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
            $entity = $em->getRepository('AppBundle:TRegrasformatacao')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TRegrasformatacao entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tregrasformatacao'));
    }

    /**
     * Creates a form to delete a TRegrasformatacao entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tregrasformatacao_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
