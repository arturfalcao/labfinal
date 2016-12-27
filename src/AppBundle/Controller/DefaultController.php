<?php

namespace AppBundle\Controller;


use AppBundle\Form\TMetodosType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\TParametros;
use AppBundle\Entity\TMetodos;
use AppBundle\Form\TParametrosType;


class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            return $this->redirectToRoute('sonata_user_security_login');

        }

        return $this->render('default/index.html.twig');
    }

    public function newAction(Request $request)
    {
        $form = $this->createForm(new TParametrosType());
        $form->add('submit', 'submit', array('label' => 'celso'));

        return $this->render('default/newaction.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function AfterLoginAction(Request $request)
    {
        return $this->render('default/calendar.html.twig');
    }

    public function getAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:TParametros')->findAll();
        return array(
            'entities' => $entities,
        );

    }
}
