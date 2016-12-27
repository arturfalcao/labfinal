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


class EntResultadosController extends Controller
{
    /**
     * @Route("/entresultados", name="Entrada de Resultados")
     */
    public function EntradaResultadosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $parameters = $em->getRepository('AppBundle:TParametros')->findAll();
        return $this->render('AppBundle:EntradaResultados:EntradaResultados.html.twig', array('data' => $parameters));
    }

    public function getByParameterAction()
    {
        $id_parameter = $this->get("request")->getContent();
        $sql = "SELECT t_resultados.ft_observacao , t_resultados.fn_id_modeloresultado ,t_resultados.fd_criacao ,
                t_resultados.fd_conclusao , t_unidadesmedida.ft_descricao AS medida, 
                t_parametrosamostra.ft_descricao , t_resultados.ft_id_estado, t_resultados.fn_id_amostra, 
                t_resultados.fn_calculado,t_resultados.ft_original,t_resultados.ft_prefixo, 
                t_resultados.ft_formatado , t_resultados.fn_id_parametro  
                FROM t_resultados 
                INNER JOIN t_parametrosamostra ON t_resultados.fn_id_parametro = t_parametrosamostra.id 
                INNER JOIN t_unidadesmedida ON t_unidadesmedida.fn_id = t_resultados.fn_id_unidade  
                WHERE t_parametrosamostra.fn_id =" . $id_parameter . " 
                AND (t_resultados.ft_id_estado = 6 OR t_resultados.ft_id_estado = 3)";
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $result = $activeDate->fetchAll();
        $query2 = "";
        if (count($result) != 0) {
            foreach ($result as &$value) {
                if ($query2 == "") {
                    $query2 = "fn_modeloresultado_id = " . $value['fn_id_modeloresultado'];
                } else {
                    $query2 = $query2 . " or fn_modeloresultado_id = " . $value['fn_id_modeloresultado'];
                }
            }

            if ($query2 != "") {
                $sql = "select * from t_regrasformatacao where " . $query2;
                $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                $activeDate->execute();
                $result2 = $activeDate->fetchAll();
                $response = array("data" => $result, "condi" => $result2);
            } else {
                $response = array("data" => $result);
            }
        } else {
            $response = null;
        }


        return new Response(json_encode($response));
    }

    public function setByRegrasFormatacaoAction()
    {
        $arr1 = json_decode($this->get("request")->getContent(), true);
        $p = 0;
        foreach ($arr1 as $arr) {
            $sql = "SELECT t_resultados.ft_observacao , t_resultados.fn_id_modeloresultado ,t_resultados.fd_criacao ,
                    t_resultados.fd_conclusao , t_unidadesmedida.ft_descricao AS medida, 
                    t_parametrosamostra.ft_descricao , t_resultados.ft_id_estado, t_resultados.fn_id_amostra, 
                    t_resultados.fn_calculado,t_resultados.ft_original,t_resultados.ft_prefixo, 
                    t_resultados.ft_formatado 
                    FROM t_resultados 
                    INNER JOIN t_parametrosamostra ON t_resultados.fn_id_parametro = t_parametrosamostra.id 
                    INNER JOIN t_unidadesmedida ON t_unidadesmedida.fn_id = t_resultados.fn_id_unidade  
                    WHERE t_resultados.fn_id_amostra =" . $arr['columns'][1] . 
                    " AND (t_resultados.ft_id_estado = 6 OR t_resultados.ft_id_estado = 3) 
                    AND t_parametrosamostra.ft_descricao = '" . $arr['columns'][2] . "' ";
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $qb = $this->getDoctrine()->getManager()->createQueryBuilder();

            $q = $qb->update('AppBundle\Entity\TResultados', 'u')
                ->set('u.ftFormatado', $qb->expr()->literal($arr['columns'][4]))
                ->set('u.ftOriginal', $qb->expr()->literal($arr['columns'][3]))
                //->set('u.ftEstado', $qb->expr()->literal("C"))
                ->where('u.fnAmostra = :idamostra and u.fnParametro  = :idpara')
                ->setParameter('idamostra', ($arr['columns'][1]))
                ->setParameter('idpara', ($arr['columns'][6]))
                ->getQuery();
            $p = $q->execute();
        }


        return new Response(json_encode($p));
    }

    /**
    * Atualização dos resultados relativos à amostra e aos parâmetros em questão
    *
    **/
    public function setByRegrasFormatacaoAmostraAction()
    {
        $arr1 = json_decode($this->get("request")->getContent(), true);

        $p = 0;
        $amostra_id = 0;
        foreach ($arr1 as $i => $value)
        {
            $amostra_id = $arr1[$i]["IA"];
            $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
            $q = $qb->update('AppBundle\Entity\TResultados', 'u')
                ->set('u.ftFormatado', $qb->expr()->literal($arr1[$i]["FO"]))
                ->set('u.ftOriginal', $qb->expr()->literal($arr1[$i]["OR"]))
                ->set('u.fnUnidade', $qb->expr()->literal($arr1[$i]["UM"]))
                ->where('u.fnAmostra = :idamostra and u.fnParametro  = :idpara')
                ->setParameter('idamostra', ($arr1[$i]["IA"]))
                ->setParameter('idpara', ($i))
                ->getQuery();
            $p = $q->execute();
        }

        //validação da especificação
        $flag = 0;
        $repository = $this->getDoctrine()->getRepository('AppBundle:TAmostras')->findOneBy(array('fnId' => $amostra_id));
        $esp = $repository->getFnEspecificacao()->getFnId();
        $para_esp = $this->getDoctrine()->getRepository('AppBundle:TParametrosporespecificacao')->findBy(array('fnIdEspecificacao' => $esp));
        $teste = "";
        foreach ($arr1 as $i => $value){

            $id_para_amostra = $this->getDoctrine()->getRepository('AppBundle:TParametrosamostra')->findOneBy(array('id' => $i));
            foreach ($para_esp as $y => $value1){

                if($value1->getFnIdFamiliaparametro()->getFnId() == $id_para_amostra->getFnId()){

                    if((float) $arr1[$i]['OR'] >= (float) $value1->getFnMaximo() &&  (float) $arr1[$i]['OR'] <= (float) $value1->getFnMinimo()){
                        $teste .=  $arr1[$i]['OR'] . "--" . $value1->getFnMaximo() . "--" . $arr1[$i]['OR'] . "--" . $value1->getFnMinimo() . "//";
                    }else{
                        $flag = 1;
                    }
                }
            }
        }

        

        if($flag == 1){
            $texto = $repository->getFnEspecificacao()->getFtTextoQdNaoCumpreA();
            return new Response($texto);
        }else{
            $texto = $repository->getFnEspecificacao()->getFtTextoQdCumpreA();
            return new Response($texto);
        }
        
    }
    
    public function getByRegrasFormatacaoAction()
    {
        $arr = $this->get("request")->getContent();
        $arr = explode("&", $arr);
        $arr1 = explode("=", $arr[0]);
        $arr2 = explode("=", $arr[1]);
        $sql = "SELECT t_resultados.ft_observacao , t_resultados.fn_id_modeloresultado ,t_resultados.fd_criacao ,
                t_resultados.fd_conclusao , t_unidadesmedida.ft_descricao AS medida, 
                t_parametrosamostra.ft_descricao , t_resultados.ft_id_estado, t_resultados.fn_id_amostra, 
                t_resultados.fn_calculado,t_resultados.ft_original,t_resultados.ft_prefixo, t_resultados.ft_formatado 
                FROM t_resultados 
                INNER JOIN t_parametrosamostra ON t_resultados.fn_id_parametro = t_parametrosamostra.id 
                INNER JOIN t_unidadesmedida ON t_unidadesmedida.fn_id = t_resultados.fn_id_unidade  
                WHERE t_resultados.fn_id_amostra =" . $arr1[1] . 
                " AND (t_resultados.ft_id_estado = 6 OR t_resultados.ft_id_estado = 3) 
                AND t_parametrosamostra.id = " . $arr2[1] . " ";
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $result = $activeDate->fetchAll();
        $query2 = "";
        foreach ($result as &$value) {
            $query2 = "fn_modeloresultado_id = " . $value['fn_id_modeloresultado'];
        }
        if ($query2 != "") {
            $sql = "select * from t_regrasformatacao where " . $query2;
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $result2 = $activeDate->fetchAll();
            $response = array("condi" => $result2);
        } else {
            $response = array("condi" => []);
        }

        return new Response(json_encode($response));
    }

    public function getByAmostraAction()
    {
        $id_amostra = $this->get("request")->getContent();
        
        if (strpos($id_amostra, ',') !== false) {
            $pieces = explode(",", $id_amostra);
            $id_amostra = "";    
            foreach ($pieces as $value) {
                
                if($id_amostra == "") {
                    $id_amostra = $value;
                }else{
                    $id_amostra = $id_amostra . " or  t_resultados.fn_id_amostra = " . $value . " ";
                }

                
                
                
                
            }
        }
        
        $sql = "SELECT t_resultados.ft_observacao , t_resultados.fn_id_modeloresultado ,t_resultados.fd_criacao ,
                t_resultados.fd_conclusao , t_unidadesmedida.ft_descricao AS medida, 
                t_parametrosamostra.ft_descricao , t_resultados.ft_id_estado, t_resultados.fn_id_amostra, 
                t_resultados.fn_calculado,t_resultados.ft_original,t_resultados.ft_prefixo, 
                t_resultados.ft_formatado ,t_resultados.fn_id_parametro 
                FROM t_resultados 
                INNER JOIN t_parametrosamostra ON t_resultados.fn_id_parametro = t_parametrosamostra.id 
                INNER JOIN t_unidadesmedida ON t_unidadesmedida.fn_id = t_resultados.fn_id_unidade  
                WHERE t_resultados.fn_id_amostra =" . $id_amostra . 
                " AND (t_resultados.ft_id_estado = 6 OR t_resultados.ft_id_estado = 3)";

        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $result = $activeDate->fetchAll();
        $query2 = "";

        if (count($result) != 0) {
            foreach ($result as &$value) {
                if ($query2 == "") {
                    $query2 = "fn_modeloresultado_id = " . $value['fn_id_modeloresultado'];
                } else {
                    $query2 = $query2 . " or fn_modeloresultado_id = " . $value['fn_id_modeloresultado'];
                }
            }

            if ($query2 != "") {
                $sql = "select * from t_regrasformatacao where " . $query2;
                $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                $activeDate->execute();

                $response = array("data" => $result, "condi" => $sql);
            } else {
                $response = array("data" => $result);
            }
        } else {
            $response = null;
        }
        return new Response(json_encode($response));
    }
}


