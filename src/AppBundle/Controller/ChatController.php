<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


use AppBundle\Entity\HistChat;
use AppBundle\Entity\FosUserUser;

/**
 * Agenda controller.
 *
 * @Route("/chat")
 */
class ChatController extends Controller
{

  /**
     * Todos os utilizadores diferentes do utilizador autenticado
     *
     * @Route("chat/getusers", name="utilizadores")
     */
    public function getusersAction()
    {

        $parameter = $this->get("request")->getContent();
        $arr1 = explode("=", $parameter);
        $nid = intval($arr1[1]);

        $em = $this->getDoctrine()->getManager();

        $result = $em->createQueryBuilder();

        $dql = $result->select('f')
                      ->from('AppBundle:FosUserUser', 'f')
                      ->andWhere('f.id != :id')
                      ->setParameter('id', $nid)
                      ->getQuery()
                      ->getResult();

    $info = [];
    $i=0;
    foreach ($dql as $fosuseruser)
    {
      $info[$i]['id'] = $fosuseruser->getId();
      $info[$i]['firstname'] = $fosuseruser->getFirstname();
      $info[$i]['imagem'] = $fosuseruser->getImagem();
      $i++;

    }

        return new Response(json_encode($info));
    }
    
  /**
     * Dados  do utilizador autenticado
     *
     * @Route("chat/getdusers", name="utilizadores")
     */
    public function getdusersAction()
    {

        $parameter = $this->get("request")->getContent();
        $arr1 = explode("=", $parameter);
        $nid = intval($arr1[1]);

        $em = $this->getDoctrine()->getManager();

        $result = $em->createQueryBuilder();

        $dql = $result->select('f')
                      ->from('AppBundle:FosUserUser', 'f')
                      ->andWhere('f.id = :id')
                      ->setParameter('id', $nid)
                      ->getQuery()
                      ->getResult();

    $info = [];
    $i=0;
    foreach ($dql as $fosuseruser)
    {
      $info[$i]['id'] = $fosuseruser->getId();
      $info[$i]['firstname'] = $fosuseruser->getFirstname();
      $info[$i]['imagem'] = $fosuseruser->getImagem();
      $info[$i]['morada'] = $fosuseruser->getMorada();
      $info[$i]['telemovel'] = $fosuseruser->getTelemovel();
      $info[$i]['codigopostal'] = $fosuseruser->getCodigopostal();
      $info[$i]['cidade'] = $fosuseruser->getCidade();
      $info[$i]['data'] = $fosuseruser->getDateOfBirth();
      $i++;

    }

        return new Response(json_encode($info));
    }
    
  /**
     * Mensagens novas do utilizado clicado para o utilizador autenticado
     *
     * @Route("/chat/gethistoriconovo", name="historiconovo")
     *
     */  
  public function gethistoriconovoAction()
    {

        $parameter = $this->get("request")->getContent();
        $parameter = explode("&", $parameter);
        $arr1 = explode("=", $parameter[0]);

        $user_clicado = intval($arr1[1]);

        $arr2 = explode("=", $parameter[1]);

        $user_logado = intval($arr2[1]);

        $em = $this->getDoctrine()->getManager();

        $result = $em->createQueryBuilder();

        $dql = $result->select('h')
                      ->from('AppBundle:HistChat', 'h')
                      ->andWhere('h.lida = 1')
                      ->andWhere('h.id_emissor = :user AND h.id_receptor = :ntuser')
                      ->setParameter('user', $user_clicado)
                      ->setParameter('ntuser',$user_logado)
                      ->orderBy('h.data_escrita_mensagem', 'ASC')
                      ->getQuery()
                      ->getResult();

        $info = [];
        $i = 0;

    $repository = $this->getDoctrine()->getRepository('AppBundle:FosUserUser');

        foreach ($dql as $histchat) {
            $nid=$histchat->getIdEmissor();
            $info[$i]['id_emissor'] = $histchat->getIdEmissor();
            $info[$i]['mensagem'] = $histchat->getMensagem();
            $utilizador = $repository->find($nid);
            $info[$i]['firstname'] = $utilizador->getFirstname();
            $info[$i]['imagem'] = $utilizador->getImagem();
            $info[$i]['ident'] = $histchat->getId();
            $i++;
        }


        return new Response(json_encode($info));
    }

  /**
     * Mensagens entre o utilizador clicado e o utilizador autenticado
     *
     * @Route("chat/gethistorico", name="historico")
     */
  public function gethistoricoAction()
    {

        $parameter = $this->get("request")->getContent();
        $parameter = explode("&", $parameter);
        $arr1 = explode("=", $parameter[0]);

        $user_clicado = intval($arr1[1]);

        $arr2 = explode("=", $parameter[1]);

        $user_logado = intval($arr2[1]);

        $em = $this->getDoctrine()->getManager();

        $result = $em->createQueryBuilder();

        $dql = $result->select('h')
                      ->from('AppBundle:HistChat', 'h')
                      ->andWhere('h.lida = 0')
                      ->andWhere('h.id_emissor = :user AND h.id_receptor = :ntuser')
                      ->setParameter('user', $user_clicado)
                      ->setParameter('ntuser',$user_logado)
                      ->orWhere('h.id_emissor = :user2 AND h.id_receptor = :ntuser2')
                      ->setParameter('user2', $user_logado)
                      ->setParameter('ntuser2',$user_clicado)
                      ->orderBy('h.data_escrita_mensagem', 'ASC')
                      ->getQuery()
                      ->getResult();

        $info = [];
        $i = 0;
        $repository = $this->getDoctrine()->getRepository('AppBundle:FosUserUser');

        foreach ($dql as $histchat) {
            $nid=$histchat->getIdEmissor();
            $info[$i]['id_emissor'] = $histchat->getIdEmissor();
            $info[$i]['mensagem'] = $histchat->getMensagem();
            $utilizador = $repository->find($nid);
            $info[$i]['firstname'] = $utilizador->getFirstname();
            $info[$i]['imagem'] = $utilizador->getImagem();
            $info[$i]['ident'] = $histchat->getId();
            $i++;
        }


        return new Response(json_encode($info));
    }

  /**
     * Atualizador o histórico com as mensagens enviadas pelo utilizador autenticado
     *
     * @Route("chat/inserthistorico", name="inserehistorico")
     */
    public function inserthistoricoAction()
    {
        $parameter = $this->get("request")->getContent();
        $parameter = explode("&", $parameter);
        $arr1 = explode("=", $parameter[0]);

        $id_emissor = intval($arr1[1]);
        $arr2 = explode("=", $parameter[1]);

        $id_receptor = intval($arr2[1]);

        $arr3 = explode("=", $parameter[2]);

        $mensagem = urldecode(trim($arr3[1]));

        $data_mensagem = new \DateTime();

        $n_lida = 1;

        $histchat = new HistChat();
        $histchat->setIdEmissor($id_emissor);
        $histchat->setIdReceptor($id_receptor);
        $histchat->setDataEscritaMensagem($data_mensagem);
        $histchat->setLida($n_lida);
        $histchat->setMensagem($mensagem);

        $em = $this->getDoctrine()->getManager();

        $em->persist($histchat);

        $em->flush();
        
    return new Response(json_encode($mensagem));
    }


  /**
     * Atualizar as mensagens não lidas como lidas entre o utilizador clicaodo e o autenticado
     *
     * @Route("chat/updatehistorico", name="atualizahistorico")
     */
    public function updatehistoricoAction()
    {

        $parameter = $this->get("request")->getContent();
        $parameter = explode("&", $parameter);
        $arr1 = explode("=", $parameter[0]);

        $user_clicado = intval($arr1[1]);

        $arr2 = explode("=", $parameter[1]);

        $user_logado = intval($arr2[1]);


        $em2 = $this->getDoctrine()->getManager();

        $result2 = $em2->createQueryBuilder();

        $dql2 = $result2->select('h')
                      ->from('AppBundle:HistChat', 'h')
                      ->andWhere('h.id_emissor = :user AND h.id_receptor = :ntuser')
                      ->setParameter('user', $user_clicado)
                      ->setParameter('ntuser',$user_logado)
                      ->andWhere('h.lida = 1')
                      ->getQuery()
                      ->getResult();

        foreach ($dql2 as $histchat2) {
          $histchat2->setLida(0);
          $em2->flush();
        }


        return new Response(json_encode($user_logado));
    }

  /**
     * Mensagens não lidas que tem como destinatário o utilizador autenticado
     *
     * @Route("chat/mens_nao_lidas", name="mensagens_nao_lidas")
     */
    public function mens_nao_lidasAction()
    {
        $parameter = $this->get("request")->getContent();
        $parameter = explode("&", $parameter);
        $arr1 = explode("=", $parameter[0]);

        $user_logado = intval($arr1[1]);

        $arr2 = explode("=", $parameter[1]);

        $user_clicado = intval($arr2[1]);

        if($user_clicado == 0)
        {
          $em = $this->getDoctrine()->getManager();

          $result = $em->createQueryBuilder();

          $dql = $result->select('h')
                        ->from('AppBundle:HistChat', 'h')
                        ->where('h.id_receptor = :ntuser')
                        ->setParameter('ntuser',$user_logado)
                        ->andWhere('h.lida = 1')
                        ->getQuery()
                        ->getResult();

          $mens_nao_lidas = count($dql);
          $mens_nao_lidas = $mens_nao_lidas . "_0";
        }
      else{

          $em2 = $this->getDoctrine()->getManager();
          $result2 = $em2->createQueryBuilder();
          $dql2 = $result2->select('h')
                        ->from('AppBundle:HistChat', 'h')
                        ->where('h.id_receptor = :ntuser AND h.id_emissor != :uc')
                        ->setParameter('ntuser',$user_logado)
                        ->setParameter('uc',$user_clicado)
                        ->andWhere('h.lida = 1')
                        ->getQuery()
                        ->getResult();
          $mens_nao_lidas = count($dql2);

            
          $em2 = $this->getDoctrine()->getEntityManager();
          $connection = $em2->getConnection();
          $statement = $connection->prepare('SELECT COUNT(DISTINCT id_emissor) AS utilizadores
            FROM histchat WHERE id_receptor = :id AND lida = 1
            AND id_emissor != :uc AND id_emissor != :ul');
          $statement->bindValue('id', $user_logado);
          $statement->bindValue('uc', $user_clicado);
          $statement->bindValue('ul', $user_logado);
          $statement->execute();
          $results = $statement->fetchAll();

          $nutilizadores=0;
          for($j=0;$j < count($results); $j++)
          {
          $nutilizadores += intval($results[$j]['utilizadores']);
          }

          $mens_nao_lidas = $mens_nao_lidas . "_" . $nutilizadores;
      }



       return new Response(json_encode($mens_nao_lidas));

    }
    
  /**
     * Obter imagem associado ao utilizador logado
     *
     * @Route("chat/getimagem", name="imagens")
     */
    public function getimagemAction()
    {

        $parameter = $this->get("request")->getContent();
        $arr1 = explode("=", $parameter);
        $user_logado = intval($arr1[1]);

        $repository = $this->getDoctrine()->getRepository('AppBundle:FosUserUser');

        $utilizador = $repository->find($user_logado);

        $imagem = $utilizador->getImagem();

        return new Response(json_encode($imagem));
    }


}
