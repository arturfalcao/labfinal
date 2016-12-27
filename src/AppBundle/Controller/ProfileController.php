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
 * Profile Controller.
 *
 *
 */
class ProfileController extends Controller
{

    /**
     * @Route("/perfil", name="perfil")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function profilehandlerAction(Request $request)
    {
        $ficheiro = $request->files->get('file-input');
        $target_file = "";
        if($ficheiro)
        {
            $uploadedFile = $ficheiro->getClientOriginalName();
            $target_dir = $this->container->getParameter('kernel.root_dir') . "\Resources\public\images\\";
            $target_file = $target_dir . basename($uploadedFile);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Verificar se a imagem é verdadeira
            $check = getimagesize($ficheiro->getPathname());

            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            // Verificar se o ficheiro existe
            if (file_exists($target_file)) {
                $uploadOk = 0;
            }

            // Permitir alguns formatos
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $uploadOk = 0;
            }
            // Ocorreu algum erro nos testes
            if ($uploadOk == 0) {
            } else {
                if (move_uploaded_file($ficheiro->getPathname(), $target_file)) {
                }
            }

            $data = file_get_contents($target_file);
            $target_file = 'data:image/' . $imageFileType . ';base64,' . base64_encode($data);
        }

        $user_logado = intval($request->request->get('util'));
        $primeiro_nome = $request->request->get('primeiro_nome');
        $ultimo_nome = $request->request->get('ultimo_nome');
        $cargo = $request->request->get('cargo');
        $genero = $request->request->get('genero');
        $email = $request->request->get('email');
        $data_dia = $request->request->get('data_dia');
        $data_mes = $request->request->get('data_mes');
        $data_ano = $request->request->get('data_ano');
        $morada = $request->request->get('morada');
        $telefone = $request->request->get('telefone');
        $telemovel = $request->request->get('telemovel');
        $cp1 = $request->request->get('cp_1');
        $cp2 = $request->request->get('cp_2');
        $cidade = $request->request->get('cidade');

        $cp = "";

        if($cp1 && $cp2)
        {
            $cp = $cp1 . "-" . $cp2;
        }
        $data_nasc = null;

        if($data_dia && $data_mes && $data_ano)
        {
            $d_n = $data_ano . "-" . $data_mes . "-" . $data_dia;
            $data_nasc = new \DateTime($d_n);
        }

        $repository = $this->getDoctrine()->getRepository('AppBundle:FosUserUser');

        $utilizador = $repository->find($user_logado);
        $utilizador->setFirstname($primeiro_nome);
        $utilizador->setLastname($ultimo_nome);
        $utilizador->setCargo($cargo);
        $utilizador->setGender($genero);

        $utilizador->setEmail($email);
        $utilizador->setEmailCanonical($email);
        if($data_nasc)
            $utilizador->setDateOfBirth($data_nasc);
        if($morada)
            $utilizador->setMorada($morada);
        if($telefone)
            $utilizador->setPhone($telefone);
        if($telemovel)
            $utilizador->setTelemovel($telemovel);
        if($cp)
            $utilizador->setCodigopostal($cp);
        if($cidade)
            $utilizador->setCidade($cidade);
        if($target_file)
            $utilizador->setImagem($target_file);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('calendar');
    }

    /**
     * Validar a password associado ao utilizador logado
     *
     * @Route("perfil/perfil_validapass", name="vpass")
     */
    public function perfil_validapassAction()
    {

        $parameter = $this->get("request")->getContent();
        $parameter = explode("&", $parameter);
        $arr1 = explode("=", $parameter[0]);

        $user_logado = intval($arr1[1]);

        $arr2 = explode("=", $parameter[1]);

        $pass = $arr2[1];

        $repository = $this->getDoctrine()->getRepository('AppBundle:FosUserUser');

        $utilizador = $repository->find($user_logado);

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($utilizador);
        $ok = $encoder->isPasswordValid($utilizador->getPassword(), $pass, $utilizador->getSalt());

        if($ok){
            $ok=1;
        }
        else {
            $ok=0;
        }

        return new Response(json_encode($ok));
    }


    /**
     * Mudar a password associada ao utilizador
     *
     * @Route("/perfil/perfil_mudapass", name="mpass")
     */
    public function perfil_mudapassAction()
    {

        $parameter = $this->get("request")->getContent();
        $parameter = explode("&", $parameter);
        $arr1 = explode("=", $parameter[0]);

        $user_logado = intval($arr1[1]);

        $arr2 = explode("=", $parameter[1]);

        $pass = $arr2[1];

        $repository = $this->getDoctrine()->getRepository('AppBundle:FosUserUser');

        $utilizador = $repository->find($user_logado);

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($utilizador);
        $pass_encoded =  $encoder->encodePassword($pass,$utilizador->getSalt());
        $utilizador->setPassword($pass_encoded);

        $em = $this->getDoctrine()->getManager();

        $em->flush();

        return new Response(json_encode($pass));
    }


}
