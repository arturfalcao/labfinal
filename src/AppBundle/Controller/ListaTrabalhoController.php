<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ListaTrabalhos;
use AppBundle\Entity\TAmostrasParametros;
use AppBundle\Entity\TParametrosgrupo;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Agenda;
use AppBundle\Form\AgendaType;
use AppBundle\Entity\ModelosListas;
use AppBundle\Entity\TResultados;
use AppBundle\Entity\TEstados;
use Symfony\Component\HttpFoundation\Response;
use WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ListaTrabalhoController extends Controller
{

    //parameters actions
    public function GetAllParametroAmostraAction()
    {
        $queryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder();
        $queryBuilder->select('u.ftDescricao','u.fnId' )->from('AppBundle:TParametrosamostra','u')
            ->where('u.fnIdlista IS NOT NULL')->distinct();
        // consider using ->getArrayResult() to use less memory
        return new Response(json_encode($queryBuilder->getQuery()->getResult()));
    }

    public function GetMetodoPorParametroAction()
    {
        $arr = $this->get("request")->getContent();
        $arr2 = explode("=", $arr);
        $manager = $this->getDoctrine()->getManager();
        $conn = $manager->getConnection();
        $sql = 'SELECT t_metodos.fn_id fnId,t_metodos.ft_descricao ftDescricao
                FROM t_metodos 
                INNER JOIN t_parametrospormetodo 
                ON t_parametrospormetodo.fn_id_metodo = t_metodos.fn_id
                WHERE t_parametrospormetodo.fn_id_parametro = ' . $arr2[1];
        $result= $conn->query($sql)->fetchAll();
        return new Response(json_encode($result));
    }

    


    
}
