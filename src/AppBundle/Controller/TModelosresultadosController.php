<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\TModelosresultados;
use AppBundle\Form\TModelosresultadosType;
use Symfony\Component\HttpFoundation\Response;

/**
 * TModelosresultados controller.
 *
 * @Route("/ModelosResultados")
 */
class TModelosresultadosController extends Controller
{

    /**
     * Lists all TModelosresultados entities.
     *
     * @Route("/", name="tmodelosresultados")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:TModelosresultados')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TModelosresultados entity.
     *
     * @Route("/GetAllModelosResultado")
     * @Method("Get")
     */
    public function GetAllModelosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:TModelosresultados')->findAll();

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($entities,'json');
        return new Response(json_encode($response));
    }

    /**
     * Deletes a TModelosresultados entity.
     *
     * @Route("/DeleteSelec/{id}", name="tmodelosresultados_delete_selec")
     * @Method("DELETE")
     * @param $id
     * @return Response
     */
    public function deleteSelecAction($id)
    {
        $elem = explode("L", $id);


        for($i = 0 ; $i < count($elem); $i++){
            if($elem[$i] != ''){
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('AppBundle:TModelosresultados')->find($elem[$i]);
                $em->remove($entity);
                $em->flush();
            }
        }
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:TModelosresultados')->findAll();
        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($entities,'json');
        return new Response(json_encode($response));

    }


    /**
     * Creates a new TModelosresultados entity.
     *
     * @Route("/", name="tmodelosresultados_create")
     * @Method("POST")
     * @Template("AppBundle:TModelosresultados:new.html.twig")
     * @param Request $request
     * @param $goto
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request, $goto)
    {
        $entity = new TModelosresultados();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tmodelosresultados_show', array('id' => $entity->getFnId())));

        }

        return array('entity' => $entity,'form'   => $form->createView(),);
    }

    /**
     * Creates a form to create a TModelosresultados entity.
     *
     * @param TModelosresultados $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TModelosresultados $entity)
    {
        $form = $this->createForm(new TModelosresultadosType(), $entity, array(
            'action' => $this->generateUrl('tmodelosresultados_create'),
            'method' => 'POST',
        ));



        return $form;
    }

    /**
     * Displays a form to create a new TModelosresultados entity.
     *
     * @Route("/new", name="tmodelosresultados_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TModelosresultados();
        $form   = $this->createCreateForm($entity);

        return array('entity' => $entity,'form'   => $form->createView(),);
    }

    /**
     * Finds and displays a TModelosresultados entity.
     *
     * @Route("/{id}", name="tmodelosresultados_show")
     * @Method("GET")
     * @Template()
     * @param $id
     * @return array
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TModelosresultados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TModelosresultados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TModelosresultados entity.
     *
     * @Route("/{id}/edit", name="tmodelosresultados_edit")
     * @Method("GET")
     * @Template()
     * @param $id
     * @return array
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TModelosresultados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TModelosresultados entity.');
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
    * Creates a form to edit a TModelosresultados entity.
    *
    * @param TModelosresultados $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TModelosresultados $entity)
    {
        $form = $this->createForm(new TModelosresultadosType(), $entity, array(
            'action' => $this->generateUrl('tmodelosresultados_update', array('id' => $entity->getFnId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing TModelosresultados entity.
     *
     * @Route("/{id}", name="tmodelosresultados_update")
     * @Method("PUT")
     * @Template("AppBundle:TModelosresultados:edit.html.twig")
     * @param Request $request
     * @param $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TModelosresultados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TModelosresultados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tmodelosresultados_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TModelosresultados entity.
     *
     * @Route("/{id}", name="tmodelosresultados_delete")
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
            $entity = $em->getRepository('AppBundle:TModelosresultados')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TModelosresultados entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tmodelosresultados'));
    }

    /**
     * Creates a form to delete a TModelosresultados entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tmodelosresultados_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
