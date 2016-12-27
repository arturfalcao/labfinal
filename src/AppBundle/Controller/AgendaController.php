<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Agenda;
use AppBundle\Form\AgendaType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


use AppBundle\Entity\TAmostras;
/**
 * Agenda controller.
 *
 * @Route("/agenda")
 */
class AgendaController extends Controller
{

    /**
     * Lists all Agenda entities.
     *
     * @Route("/calendar", name="agenda")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Agenda')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Obter todas as amostras do dia de hoje.
     *
     * @Route("/calendar/geteventos", name="eventos_planeados")
     */
    
    public function geteventosAction()
    {
        $parameter = $this->get("request")->getContent();
        $parameter = explode("&", $parameter);
        $arr1 = explode("=", $parameter[0]);
        $user = intval($arr1[1]);

        $t = \date('Y-m-d');
        
        $inicio = $t . " 00:00:00";
        
        $fim = $t . " 23:59:59";

        $data_inicio = \DateTime::createFromFormat("Y-m-d H:i:s",$inicio);
        $data_fim = \DateTime::createFromFormat("Y-m-d H:i:s",$fim);
        
        $em = $this->getDoctrine()->getManager();


        $estado = $em->getRepository('AppBundle:TEstados')->findOneByftCodigo('P');

        $result = $em->createQueryBuilder();
        $info = [];
        $i = 0;
        if($estado) {
            $data_inicio =  date_format($data_inicio,"Y-m-d H:i:s");
           $data_fim =  date_format($data_fim,"Y-m-d H:i:s");

            $dql = $result->select('a')
                ->from('AppBundle:TAmostras', 'a')
                ->where('a.startdatetime >= :data_inicio')
                ->setParameter('data_inicio', $data_inicio)
                ->andWhere('a.startdatetime <= :data_fim')
                ->setParameter('data_fim', $data_fim)
                ->andWhere('a.ftEstado = :ft_estado')
                ->setParameter('ft_estado', $estado->getFnId())
                ->orderBy('a.startdatetime', 'ASC')
                ->getQuery()
                ->getResult();


            foreach ($dql as $amostra) {
    
                $info[$i]['tempo'] = $amostra->getStartdatetime();
                $info[$i]['observacao'] = $amostra->getFtObs();
                $info[$i]['am_ag'] = 1;
                $info[$i]['id'] = 'am_' . $amostra->getFnId();
                $info[$i]['done'] = $amostra->getFnDone();
                $i++;
            }
            

        }

        $em_2 = $this->getDoctrine()->getManager();
        
        $result_2 = $em_2->createQueryBuilder();
        

        $dql_ag = $result_2->select('ag')
                           ->from('AppBundle:Agenda', 'ag')
                           ->where('ag.startdatetime >= :data_inicio')
                           ->setParameter('data_inicio', $data_inicio)
                           ->andWhere('ag.startdatetime <= :data_fim')
                           ->setParameter('data_fim', $data_fim)
                           ->andWhere('ag.FnIdUtilizador = :user')
                           ->setParameter('user', $user)
                           ->orderBy('ag.startdatetime', 'ASC')
                           ->getQuery()
                           ->getResult();
        

        foreach ($dql_ag as $agenda) {
            $info[$i]['tempo'] = $agenda->getStartdatetime();
            $info[$i]['observacao'] = $agenda->getTitle(); 
            $info[$i]['am_ag'] = 0;
            $info[$i]['id'] = 'ag_' . $agenda->getId();
            $info[$i]['done'] = $agenda->getFnDone();
            $i++;
        }

        return new Response(json_encode($info));
    }

    /**
     * Obter todas as amostras do dia de hoje.
     *
     * @Route("/calendar/updateeventos", name="eventos_atualizados")
     */

    public function updateeventosAction()
    {
        $parameter = $this->get("request")->getContent();
        $parameter = explode("&", $parameter);
        $arr1 = explode("=", $parameter[0]);
        
        $am_or_ag = $arr1[1];
        
        $arr2 = explode("=", $parameter[1]);
        
        $done = intval($arr2[1]);
        
        $arr3 = explode("=", $parameter[2]);

        $nid = intval($arr3[1]);

        $em = $this->getDoctrine()->getManager();

        if(strcmp($am_or_ag,"am") == 0)
        {
        $amostra = $em->getRepository('AppBundle:TAmostras')->find($nid);   
        $amostra->setFnDone($done);
        $em->flush();        
        }
        elseif (strcmp($am_or_ag,"ag") == 0) 
        {
        $amostra = $em->getRepository('AppBundle:Agenda')->find($nid);   
        $amostra->setFnDone($done);
        $em->flush();
        }

        return new Response(json_encode($nid));
    }

    /**
     * Creates a new Agenda entity.
     *
     * @Route("/calendario", name="agenda_create")
     * @Method("POST")
     * @Template("AppBundle:Agenda:new.html.twig")
     * @param Request $request
     * @return array
     */
    public function createAction(Request $request)
    {

        $entity = new Agenda();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $id_user = $user -> getId();
            $entity->setFnIdUtilizador($id_user);
            $em->persist($entity);
            $em->flush();


        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Agenda entity.
     *
     * @param Agenda $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Agenda $entity)
    {

        $form = $this->createForm(new AgendaType(), $entity, array(
            'action' => $this->generateUrl('agenda_create'),
            'method' => 'POST',
        ));
        return $form;
    }

    /**
     * Displays a form to create a new Agenda entity.
     *
     * @Route("calendar/new", name="agenda_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Agenda();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Agenda entity.
     *
     * @Route("calendar/{id}", name="agenda_show")
     * @Method("GET")
     * @Template()
     * @param $id
     * @return array
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Agenda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agenda entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Agenda entity.
     *
     * @Route("calendar/{id}/edit", name="agenda_edit")
     * @Method("GET")
     * @Template()
     * @param $id
     * @return array
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Agenda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agenda entity.');
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
    * Creates a form to edit a Agenda entity.
    *
    * @param Agenda $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Agenda $entity)
    {
        $form = $this->createForm(new AgendaType(), $entity, array(
            'action' => $this->generateUrl('agenda_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Edits an existing Agenda entity.
     *
     * @Route("calendar/{id}", name="agenda_update")
     * @Method("PUT")
     * @Template("AppBundle:Agenda:edit.html.twig")
     * @param Request $request
     * @param $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Agenda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agenda entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('agenda_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Agenda entity.
     *
     * @Route("calendar/{id}", name="agenda_delete")
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
            $entity = $em->getRepository('AppBundle:Agenda')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Agenda entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('agenda'));
    }

    /**
     * Creates a form to delete a Agenda entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agenda_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


    /**
     * Creates a new Agenda entity.
     *
     * @Route("/calendar/newshort", name="agenda_create_short")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function newshortAction(Request $request)
    {
        $entity = new Agenda();
        $form = $this->createFormBuilder($entity)
            ->add('title',null,array('label' => 'O que'))
            ->add('startdatetime',null,array( 'attr'=>array('style'=>'display:none;','id'=>'start_date_short'),'label' => false))
            ->add('enddatetime',null,array( 'attr'=>array('style'=>'display:none;','id'=>'end_date_short'),'label' => false))
            ->add('submit','submit')
            ->getForm();
        $form->handleRequest($request);

        if ($request->getMethod() == "POST") {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                if($entity->getStartdatetime()->format('Y-m-d H:i:s') == $entity->getEnddatetime()->format('Y-m-d H:i:s')){
                    $entity->setAllDay(true);
                }
                $user = $this->get('security.token_storage')->getToken()->getUser();
                $id_user = $user -> getId();
                $entity->setFnIdUtilizador($id_user);
                $em->persist($entity);
                $em->flush();
                $data1 = $entity->getStartdatetime()->format('Y-m-d H:i:s');
                $data2 = $entity->getEnddatetime()->format('Y-m-d H:i:s');

                if($entity->getStartdatetime()->format('Y-m-d H:i:s') == $entity->getEnddatetime()->format('Y-m-d H:i:s')){
                    $allday = true;
                }else{
                    $allday = false;
                }


                return new Response('{"events" : {"event" : {"id": '. $entity->getId() .',"title": "'. $entity->getTitle() .'","startdate": "'. $data1 .'","enddate": "'. $data2.'","allday":"'. $allday .'"}}}');
            }else{
                return new Response("-->" .  $form->getErrorsAsString());
            }


        }else{
            return $this->render('AppBundle:Agenda:newshort.html.twig', array('form'=>$form->createView()));
        }

    }

    /**
     * Creates a new Agenda entity.
     *
     * @Route("/calendar/newshort/{slug}", name="agenda_update_short")
     * @Method({"PUT", "DELETE"})
     * @param $slug
     * @return Response
     */
    public function updatenewshortAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        $myEntity = 0;
        if(isset($slug)){
            $myEntity = $em->getRepository('AppBundle:Agenda')->find($slug);
        }


        if ($request->getMethod() == 'PUT') {

            if($request->request->get('allday') != ""){
                if($request->request->get('allday') == "true"){
                    $myEntity->setAllDay(1);
                }else{
                    $myEntity->setAllDay(0);
                }

            }


            if($request->request->get('start') != ""){
                $dateStarted = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->request->get('start')); // Thu Nov 15 2012 00:00:00 GMT-0700 (Mountain Standard Time)
                $myEntity->setStartdatetime($dateStarted);
        }

            if($request->request->get('end') != ""){
                $endStarted = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->request->get('end')); // Thu Nov 15 2012 00:00:00 GMT-0700 (Mountain Standard Time)
                if($request->request->get('allday') == "true" || $request->request->get('allday') == true){
                    $myEntity->setEnddatetime($endStarted );
                }else{
                    $myEntity->setEnddatetime($endStarted );
                }

            }

            $em->flush();

            return new Response($request->request->get('allday'));
        }else{
            if ($request->getMethod() == "DELETE") {
                $em->remove($myEntity);
                $em->flush();

                return new Response('' . $myEntity->getId());

            }else{
                return new Response('Alguma coisa correu mal');
            }

        }





    }

}
