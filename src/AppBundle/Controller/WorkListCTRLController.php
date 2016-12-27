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
/**
 * Agenda controller.
 *
 * @Route("/generateworklist")
 */
class WorkListCTRLController extends Controller
{
    //parameters actions
    public function CompleteparaAction()
    {
        error_reporting(0);
        $em = $this->getDoctrine()->getManager();
        $arr = $this->get("request")->getContent();
        $arr = json_decode($arr);
        $envia = "";
        foreach ($arr as &$value) {
            $resultados = $em->getRepository('AppBundle:TResultados')->findOneBy(array('fnId' => $value));
            $amostra = $em->getRepository('AppBundle:TParametrosamostra')->findOneBy(array('id' => $resultados->getFnParametro()));
            $estado = $em->getRepository('AppBundle:TEstados')->findOneBy(array('ftCodigo' => 'C'));
            $resultados->setFtEstado($estado);
            $amostra->setFtEstado($estado);
            $em->persist($amostra);
            $em->persist($resultados);
            $em->flush();
            $sql = "SELECT MAX(id_table) FROM t_parametrosamostra_log ";
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $last = $activeDate->fetchAll();
            $envia = $envia . "," . $last[0]["MAX(id_table)"];
            $sql = "INSERT INTO t_parametrosamostra_log (fn_id, listatrabalho_id, ft_descricao, fn_id_metodo, 
                    fn_id_tecnica, fn_id_amostra, fn_id_areaensaio, fd_limiterealizacao, ft_cumpreespecificacao, 
                    ft_conclusao, fn_id_modeloparametro, ft_observacao, fd_criacao, fd_conclusao, fd_autorizacao, 
                    fn_id_laboratorio, fn_precocompra, fn_precovenda, fn_factorcorreccao, fb_acreditado, 
                    fn_limitelegal, fn_id_familiaparametro, ft_formulaquimica, fn_id_frasco, fn_volumeminimo, 
                    fb_confirmacao, ft_id_estado, fb_contraanalise, fd_Realizacao,id) 
                    SELECT aa.fn_id, aa.listatrabalho_id, aa.ft_descricao, aa.fn_id_metodo, aa.fn_id_tecnica, 
                    aa.fn_id_amostra, aa.fn_id_areaensaio, aa.fd_limiterealizacao, aa.ft_cumpreespecificacao, 
                    aa.ft_conclusao, aa.fn_id_modeloparametro, aa.ft_observacao, aa.fd_criacao, aa.fd_conclusao, 
                    aa.fd_autorizacao, aa.fn_id_laboratorio, aa.fn_precocompra, aa.fn_precovenda, 
                    aa.fn_factorcorreccao, aa.fb_acreditado, aa.fn_limitelegal, aa.fn_id_familiaparametro, 
                    aa.ft_formulaquimica, aa.fn_id_frasco, aa.fn_volumeminimo, aa.fb_confirmacao, aa.ft_id_estado, 
                    aa.fb_contraanalise, aa.fd_Realizacao , aa.id FROM t_parametrosamostra_log AS aa 
                    WHERE aa.ft_id_estado = 6 and aa.fn_id_amostra = " . $amostra->getFnIdAmostra() .
                " and aa.id =" . $amostra->getId();
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $sql = "UPDATE t_parametrosamostra_log SET  date = NOW() ,  user = '" .
                $this->get('security.token_storage')->getToken()->getUser() .
                "' , ft_id_estado = 3 where id_table > " . $last[0]["MAX(id_table)"];
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
        }
        return new Response($envia);
    }

    public function AtualizaListaTrabalhoAction()
    {
        error_reporting(0);
        $em = $this->getDoctrine()->getManager();
        $arr = $this->get("request")->getContent();
        $arr = json_decode($arr);
        $envia = array();
        foreach ($arr as &$value) {
            $resultados = $em->getRepository('AppBundle:TResultados')->findOneBy(array('fnId' => $value));
            $amostra = $em->getRepository('AppBundle:TParametrosamostra')->findOneBy(array('id' => $resultados->getFnParametro()));
            $result = $em->createQueryBuilder();
            if($amostra->getFnIdlista()) {
                $lista_trab = $em->getRepository('AppBundle:ListaTrabalhos')->findOneBy(array('id' => $amostra->getFnIdlista()));
                $dql = $result->select('tpa')
                    ->from('AppBundle:TParametrosamostra', 'tpa')
                    ->where('tpa.fnIdlista = :lista')
                    ->setParameter('lista', $lista_trab->getId())
                    ->getQuery()
                    ->getResult();
                $conta_completo = 0;
                $nelem = count($dql);
                foreach ($dql as $pa) {
                    if($pa->getFtIdEstado() == 3){
                        $conta_completo++;
                    }
                }
                if($conta_completo == $nelem)
                {
                    $lista_trab->setDatafecho(new \DateTime());
                    $lista_trab->setConcluido(1);
                    $em->flush();
                    array_push($envia,$lista_trab->getId());
                }
            }
        }
        $narray = count($envia);
        $id_lista="";
        if($narray != 0)
        {
            $envia = array_unique($envia);
            $id_lista = "Lista";
            if($narray > 1)
            {
                $id_lista .= "s com os ids";
            }
            else
            {
                $id_lista .= " com o id";
            }
            for($x = 0; $x < count($envia); $x++) {
                if($x==0)
                    $id_lista .= " " . $envia[$x];
                else
                    $id_lista .= "," . $envia[$x];
            }
            if($narray > 1)
            {$id_lista .= " estão concluídas";}
            else{
                $id_lista .= " está concluída";
            }
        }
        return new Response($id_lista);
    }

    public function ReopenparaAction()
    {
        error_reporting(0);
        $em = $this->getDoctrine()->getManager();
        $arr = $this->get("request")->getContent();
        $arr = json_decode($arr);
        $sql = "";
        foreach ($arr as &$value) {
            $resultados = $em->getRepository('AppBundle:TResultados')->findOneBy(array('fnId' => $value));
            $amostra = $em->getRepository('AppBundle:TParametrosamostra')->findOneBy(array('id' => $resultados->getFnParametro()));
            $estado = $em->getRepository('AppBundle:TEstados')->findOneBy(array('ftCodigo' => 'D'));
            $resultados->setFtEstado($estado);
            $amostra->setFtEstado($estado);
            $em->persist($amostra);
            $em->persist($resultados);
            $em->flush();
            $sql = "SELECT MAX(id_table) FROM t_parametrosamostra_log ";
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $last = $activeDate->fetchAll();
            $sql = "INSERT INTO t_parametrosamostra_log (fn_id, listatrabalho_id, ft_descricao, fn_id_metodo, 
                    fn_id_tecnica, fn_id_amostra, fn_id_areaensaio, fd_limiterealizacao, ft_cumpreespecificacao, 
                    ft_conclusao, fn_id_modeloparametro, ft_observacao, fd_criacao, fd_conclusao, fd_autorizacao, 
                    fn_id_laboratorio, fn_precocompra, fn_precovenda, fn_factorcorreccao, fb_acreditado, 
                    fn_limitelegal, fn_id_familiaparametro, ft_formulaquimica, fn_id_frasco, fn_volumeminimo, 
                    fb_confirmacao, ft_id_estado, fb_contraanalise, fd_Realizacao,id) 
                    SELECT aa.fn_id, aa.listatrabalho_id, aa.ft_descricao, aa.fn_id_metodo, aa.fn_id_tecnica, 
                    aa.fn_id_amostra, aa.fn_id_areaensaio, aa.fd_limiterealizacao, aa.ft_cumpreespecificacao, 
                    aa.ft_conclusao, aa.fn_id_modeloparametro, aa.ft_observacao, aa.fd_criacao, aa.fd_conclusao, 
                    aa.fd_autorizacao, aa.fn_id_laboratorio, aa.fn_precocompra, aa.fn_precovenda, 
                    aa.fn_factorcorreccao, aa.fb_acreditado, aa.fn_limitelegal, aa.fn_id_familiaparametro, 
                    aa.ft_formulaquimica, aa.fn_id_frasco, aa.fn_volumeminimo, aa.fb_confirmacao, aa.ft_id_estado, 
                    aa.fb_contraanalise, aa.fd_Realizacao , aa.id FROM t_parametrosamostra_log AS aa 
                    WHERE aa.ft_id_estado = 6 and aa.fn_id_amostra = " . $amostra->getFnIdAmostra() .
                " and aa.id =" . $amostra->getId();
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $sql = "UPDATE t_parametrosamostra_log SET  date = NOW() ,  user = '" .
                $this->get('security.token_storage')->getToken()->getUser() .
                "' , ft_id_estado = 6 where id_table > " . $last[0]["MAX(id_table)"];
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
        }
        return new Response($sql);
    }

    public function AddparaAction()
    {
        error_reporting(0);
        $arr = $this->get("request")->getContent();
        $arr2 = explode("&", $arr);
        $amostra = explode("=", $arr2[1]);
        $para = explode("=", $arr2[0]);
        $res=$this->AddNewparaAction($amostra[1], $para[1]);
        return new Response($res);
    }

    public function CancelparaAction()
    {
        error_reporting(0);
        $em = $this->getDoctrine()->getManager();
        $arr = $this->get("request")->getContent();
        $arr = json_decode($arr);
        foreach ($arr as &$value) {
            $resultados = $em->getRepository('AppBundle:TResultados')->findOneBy(array('fnId' => $value));
            $amostra = $em->getRepository('AppBundle:TParametrosamostra')->findOneBy(array('id' => $resultados->getFnParametro()));
            $estado = $em->getRepository('AppBundle:TEstados')->findOneBy(array('ftCodigo' => 'X'));
            $resultados->setFtEstado($estado);
            $amostra->setFtEstado($estado);
            $em->persist($amostra);
            $em->persist($resultados);
            $em->flush();
            $sql = "SELECT MAX(id_table) FROM t_parametrosamostra_log ";
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $last = $activeDate->fetchAll();
            $sql = "INSERT INTO t_parametrosamostra_log (fn_id, listatrabalho_id, ft_descricao, fn_id_metodo, 
                    fn_id_tecnica, fn_id_amostra, fn_id_areaensaio, fd_limiterealizacao, ft_cumpreespecificacao, 
                    ft_conclusao, fn_id_modeloparametro, ft_observacao, fd_criacao, fd_conclusao, fd_autorizacao, 
                    fn_id_laboratorio, fn_precocompra, fn_precovenda, fn_factorcorreccao, fb_acreditado, 
                    fn_limitelegal, fn_id_familiaparametro, ft_formulaquimica, fn_id_frasco, fn_volumeminimo, 
                    fb_confirmacao, ft_id_estado, fb_contraanalise, fd_Realizacao,id) 
                    SELECT aa.fn_id, aa.listatrabalho_id, aa.ft_descricao, aa.fn_id_metodo, aa.fn_id_tecnica, 
                    aa.fn_id_amostra, aa.fn_id_areaensaio, aa.fd_limiterealizacao, aa.ft_cumpreespecificacao, 
                    aa.ft_conclusao, aa.fn_id_modeloparametro, aa.ft_observacao, aa.fd_criacao, aa.fd_conclusao, 
                    aa.fd_autorizacao, aa.fn_id_laboratorio, aa.fn_precocompra, aa.fn_precovenda, 
                    aa.fn_factorcorreccao, aa.fb_acreditado, aa.fn_limitelegal, aa.fn_id_familiaparametro, 
                    aa.ft_formulaquimica, aa.fn_id_frasco, aa.fn_volumeminimo, aa.fb_confirmacao, aa.ft_id_estado, 
                    aa.fb_contraanalise, aa.fd_Realizacao , aa.id FROM t_parametrosamostra_log AS aa 
                    WHERE aa.ft_id_estado = 6 and aa.fn_id_amostra = " . $amostra->getFnIdAmostra() .
                " and aa.id =" . $amostra->getId();
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $sql = "UPDATE t_parametrosamostra_log SET  date = NOW() ,  user = '" .
                $this->get('security.token_storage')->getToken()->getUser() .
                "' , ft_id_estado = 2 where id_table > " . $last[0]["MAX(id_table)"];
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
        }
        return new Response("ok");
    }

    public function EmitirRelatorioAction($slug){
        error_reporting(0);
        $samples = explode(",", $slug);
        $conta = count($samples);
        $pdf = $this->container->get("white_october.tcpdf")->create(
            'P',
            'mm',
            'A4',
            false,
            'ISO-8859-1',
            false
        );
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Pimenta do Vale');
        $pdf->SetTitle('RELATÓRIO DE AMOSTRAS');
// set default header data
        $pdf->SetMargins(7, 35, 7);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterData(array(date("d-m-Y"), 0, 0), array(1, 0, 0));
        //TODO: ir buscar o tipo de parametros e colocar diretamente na tabela parametrosamostras
        $ids_file = "";
        foreach ($samples as &$slug) {
            $cumpre = true;
            $em = $this->getDoctrine()->getManager();
            $amostra = $em->getRepository('AppBundle:TAmostras')->findOneBy(array('fnId' => $slug));
            if(!$amostra->getFnEspecificacao() || !$amostra->getFnModelo() || !$amostra->getFtGrupoparametros())
            {
                return new Response("Defina a especificação, o modelo de amostra e o grupo de parâmetros para a amostra com o ID " . $amostra->getFnId());
            }
            $ids_file .= "_".$amostra->getFnId();
            $especificacao = $em->getRepository('AppBundle:TEspecificacoes')->findOneBy(array('fnId' => $amostra->getFnEspecificacao()));
            $parametros = $em->getRepository('AppBundle:TParametrosamostra')->findByFnIdAmostra($slug);
            foreach ($parametros as &$value) {
                $parametro = $em->getRepository('AppBundle:TParametros')->findOneBy(array('fnId' => $value->getFnId()));
                $value->setFnTipoparametro($parametro->getFnTipoparametro());
            }
            $header_micro = '<table class="table_parametros" ><tr style="margin-top 5px;"><td style="width:15px;"></td><td colspan="4"><span>' . utf8_decode("Parâmetros Microbiologicos") . '</span><br/><span class="table_parametros_tecnica">' . utf8_decode("Método de ensaio / Técnica analítica") . '</span></td><td class="table_parametros_data"></td><td>Unidades</td><td class="table_parametros_data">' . $especificacao->getFtSiglavl() . '</td><td>Incerteza</td><td></td><td class="table_parametros_data"></td></tr></table>';
            $header_fisico = '<table class="table_parametros" ><tr style="margin-top 5px;"><td style="width:15px;"></td><td colspan="4"><span>' . utf8_decode("Físico-químicos") . '</span><br/><span class="table_parametros_tecnica">' . utf8_decode("Método de ensaio / Técnica analítica") . '</span></td><td class="table_parametros_data"></td><td>Unidades</td><td class="table_parametros_data">' . $especificacao->getFtSiglavl() . '</td><td>Incerteza</td><td></td><td class="table_parametros_data"></td></tr></table>';
            $body_fisico = "";
            $body_micro = "";
            $microeven = 0;
            $fisieven = 0;
            //valida se nesta amostra existe algum parametro que tenha certificaçao, caso tenha coloca a imagem do ipac no header caso contrario não coloca
            $ipac_cert = false;
            foreach ($parametros as &$value) {
                if ($value->getFbAmostraexterno() || $value->getFbAmostrainterno() || $value->getFbDeterminacaoexterno() || $value->getFbDeterminacaointerno()) {
                    $ipac_cert = true;
                    $pdf->SetHeaderData('logopimenta.png', 50, utf8_decode('RELATÓRIO DE AMOSTRAS') , $ipac_cert);
                }
            }
            if($ipac_cert==false)
                $pdf->SetPrintHeader(false);
            //TODO: melhorar a logica dos parametros
            foreach ($parametros as &$value) {
                $label = "";
                if ($value->getFnTipoparametro() != null && $value->getFnTipoparametro()->getFtCodigo() == "Microbiologicos") {
                    $resultado = $em->getRepository('AppBundle:TResultados')->findOneBy(array('fnParametro' => $value->getId()));
                    $espe_texto = "";
                    foreach ($especificacao->getfnParametros() as &$para_espe) {
                        if ($para_espe->getFnIdFamiliaparametro()->getFnId() == $value->getFnId()) {
                            $sql = "SELECT * FROM t_parametrosporespecificacao where fn_id_familiaparametro = " .
                                $para_espe->getFnIdFamiliaparametro()->getFnId() .
                                " and fn_id_especificacao = " . $amostra->getFnEspecificacao()->getFnId() . " ";
                            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                            $activeDate->execute();
                            $last = $activeDate->fetchAll();
                            $original = floatval($resultado->getFtOriginal());
                            $max = floatval($last[0]['fn_maximo']);
                            $min = floatval($last[0]['fn_minimo']);
                            if ($original < $max && $original > $min) {
                                $espe_texto = utf8_decode($last[0]['ft_texto_relatorio']);
                            } else {
                                $cumpre = false;
                                $espe_texto = utf8_decode($especificacao->getFtTextoQdNaoPassaP());
                            }
                        }
                    }
                    if ($value->getFbAmostrainterno() || $value->getFbDeterminacaointerno() || $ipac_cert == false) {
                        if (!$value->getFbAmostrainterno()) {
                            $label = $label . "(4)";
                        }
                        if (!$value->getFbDeterminacaointerno()) {
                            $label = $label . "(1)";
                        }
                    } else {
                        if ($value->getFbAmostraexterno() || $value->getFbDeterminacaoexterno()) {
                            if (!$value->getFbAmostraexterno()) {
                                $label = $label . "(5)";
                            }
                            if (!$value->getFbDeterminacaoexterno()) {
                                $label = $label . "(2)";
                            }
                        } else {
                            if (!$value->getFbAmostrainterno()) {
                                $label = $label . "(4)";
                            }
                            if (!$value->getFbDeterminacaointerno()) {
                                $label = $label . "(1)";
                            }
                            if ($value->getFbAmostraexterno()) {
                                $label = $label . "(6)";
                            }
                            if ($value->getFbDeterminacaoexterno()) {
                                $label = $label . "(3)";
                            }
                        }
                    }
                    if ($body_micro == "") {
                        if($value->getFnFamiliaparametro() && $value->getFnMetodo() && $value->getFnMetodo()->getFnTecnica() && $resultado->getFnUnidade())
                        {
                            $body_micro = $header_micro . '<table class="table_resultados"><tr style=""><td style="width:18px;font-size:5px;">' . $label . '</td><td colspan="4" class="resultados_one" style="">' . utf8_decode($value->getFnFamiliaparametro()->getFtDescricao()) . ' <br /><span class="table_parametros_tecnica">' . utf8_decode($value->getFnMetodo()->getFtDescricao()) . '/ ' . $value->getFnMetodo()->getFnTecnica()->getFtDescricao() . '</span></td><td class="">' . $resultado->getFtFormatado() . '</td><td>' . $resultado->getFnUnidade()->getFtDescricao() . '</td><td class="table_parametros_data">' . $espe_texto . '</td><td></td><td class="table_parametros_data"></td></tr>';
                            $microeven++;
                        }
                    } else {
                        $microeven++;
                        if ($microeven % 2 == 0) {
                            $microevenclass = "#d3d3d3";
                        } else {
                            $microevenclass = "#ffffff";
                        }
                        if($value->getFnFamiliaparametro() && $value->getFnMetodo() && $value->getFnMetodo()->getFnTecnica() && $resultado->getFnUnidade())
                            $body_micro = $body_micro . '<tr bgcolor="' . $microevenclass . '" style=""><td style="width:18px;font-size:5px;">' . $label . '</td><td bgcolor="' . $microevenclass . '" colspan="4" class="resultados_one" style="">' . utf8_decode($value->getFnFamiliaparametro()->getFtDescricao()) . ' <br /><span class="table_parametros_tecnica">' . utf8_decode($value->getFnMetodo()->getFtDescricao()) . '/ ' . $value->getFnMetodo()->getFnTecnica()->getFtDescricao() . '</span></td><td class="" bgcolor="' . $microevenclass . '">' . $resultado->getFtFormatado() . '</td><td bgcolor="' . $microevenclass . '">' . $resultado->getFnUnidade()->getFtDescricao() . '</td><td class="table_parametros_data">' . $espe_texto . '</td><td></td><td class="table_parametros_data"></td></tr>';
                    }
                }
                if ($value->getFnTipoparametro() != null && $value->getFnTipoparametro()->getFtCodigo() == "FisicoQuimicos") {
                    $resultado = $em->getRepository('AppBundle:TResultados')->findOneBy(array('fnParametro' => $value->getId()));
                    $espe_texto = "";
                    foreach ($especificacao->getfnParametros() as &$para_espe) {
                        if ($para_espe->getFnIdFamiliaparametro()->getFnId() == $value->getFnId()) {
                            $sql = "SELECT * FROM t_parametrosporespecificacao where fn_id_familiaparametro = " .
                                $para_espe->getFnIdFamiliaparametro()->getFnId() .
                                " and fn_id_especificacao = " . $amostra->getFnEspecificacao()->getFnId() . " ";
                            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                            $activeDate->execute();
                            $last = $activeDate->fetchAll();
                            $original = floatval($resultado->getFtOriginal());
                            $max = floatval($last[0]['fn_maximo']);
                            $min = floatval($last[0]['fn_minimo']);
                            if ($original < $max && $original > $min) {
                                $espe_texto = utf8_decode($last[0]['ft_texto_relatorio']);
                            } else {
                                $cumpre = false;
                                $espe_texto = utf8_decode($especificacao->getFtTextoQdNaoPassaP());
                            }
                        }
                    }
                    if ($value->getFbAmostrainterno() || $value->getFbDeterminacaointerno() || $ipac_cert == false) {
                        if (!$value->getFbAmostrainterno()) {
                            $label = $label . "(4)";
                        }
                        if (!$value->getFbDeterminacaointerno()) {
                            $label = $label . "(1)";
                        }
                    } else {
                        if ($value->getFbAmostraexterno() || $value->getFbDeterminacaoexterno()) {
                            if (!$value->getFbAmostraexterno()) {
                                $label = $label . "(5)";
                            }
                            if (!$value->getFbDeterminacaoexterno()) {
                                $label = $label . "(2)";
                            }
                        } else {
                            if (!$value->getFbAmostrainterno()) {
                                $label = $label . "(4)";
                            }
                            if (!$value->getFbDeterminacaointerno()) {
                                $label = $label . "(1)";
                            }
                            if ($value->getFbAmostraexterno()) {
                                $label = $label . "(6)";
                            }
                            if ($value->getFbDeterminacaoexterno()) {
                                $label = $label . "(3)";
                            }
                        }
                    }
                    if ($body_fisico == "") {
                        if($value->getFnFamiliaparametro() && $value->getFnMetodo() && $value->getFnMetodo()->getFnTecnica() && $resultado->getFnUnidade())
                        {
                            $body_fisico = $header_fisico . '<table class="table_resultados" ><tr style="margin-top 0px;"><td style="width:18px;font-size:5px;">' . $label . '</td><td colspan="4" class="resultados_one" style="">' . utf8_decode($value->getFnFamiliaparametro()->getFtDescricao()) . ' <br /><span class="table_parametros_tecnica">' . utf8_decode($value->getFnMetodo()->getFtDescricao()) . '/ ' . $value->getFnMetodo()->getFnTecnica()->getFtDescricao() . '</span></td><td class="">' . $resultado->getFtFormatado() . '</td><td>' . $resultado->getFnUnidade()->getFtDescricao() . '</td><td class="table_parametros_data">' . $espe_texto . '</td><td></td><td class="table_parametros_data"></td></tr>';
                            $fisieven++;
                        }
                    } else {
                        $fisieven++;
                        if ($fisieven % 2 == 0) {
                            $fisievenclass = "#d3d3d3";
                        } else {
                            $fisievenclass = "#ffffff";
                        }
                        if($value->getFnFamiliaparametro() && $value->getFnMetodo() && $value->getFnMetodo()->getFnTecnica() && $resultado->getFnUnidade())
                            $body_fisico = $body_fisico . '<tr bgcolor="' . $fisievenclass . '" style="margin-top 0px;"><td style="width:18px;font-size:5px;">' . $label . '</td><td colspan="4" class="resultados_one" style="">' . utf8_decode($value->getFnFamiliaparametro()->getFtDescricao()) . ' <br /><span class="table_parametros_tecnica">' . utf8_decode($value->getFnMetodo()->getFtDescricao()) . '/ ' . $value->getFnMetodo()->getFnTecnica()->getFtDescricao() . '</span></td><td class="">' . $resultado->getFtFormatado() . '</td><td>' . $resultado->getFnUnidade()->getFtDescricao() . '</td><td class="table_parametros_data">' . $espe_texto . '</td><td></td><td class="table_parametros_data"></td></tr>';
                    }
                }
            }
            $conclusao = '<div></div><table class="margin"><tr><td class="apreciacao">' . utf8_decode("(*)Apreciação") . '</td></tr><tr><td class="font8">' . utf8_decode($amostra->getFtConclusao()) . '</td></tr></table>';
            //    $conclusao = '<div></div><table class="margin"><tr><td class="apreciacao">' . utf8_decode("(*)Apreciação") . '</td></tr><tr><td class="font8">' . utf8_decode($especificacao->getFtTextoQdNaoCumpreA()) . '</td></tr></table>';
            $body_fisico = $body_fisico . '</table></br>';
            $body_micro = $body_micro . '</table></br>';
            $modeloamostra = $em->getRepository('AppBundle:TModelosamostra')->findOneBy(array('fnId' => $amostra->getFnModelo()->getFnId()));
            $amostraalimentos = $em->getRepository('AppBundle:TAmostrasalimentos')->findOneBy(array('fnId' => $amostra->getFnAmostrasalimentos()->getFnId()));
            $cliente = $em->getRepository('AppBundle:TClientes')->findOneBy(array('fnId' => $amostra->getFnCliente()->getFnId()));
            if ($amostraalimentos->getFtLote() != null || $amostraalimentos->getFtAcondicionamento() != null || $amostraalimentos->getFtTemperatura() != null || $amostraalimentos->getFtFaseprocesso() != null) {
                $origem = '<tr><td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">Origem da Amostra:</td></tr><tr><td width="100" style="font-size: 10px;text-align:left;padding-left: 10px;width: 100%;margin: 0;" class="tit_info_amostra">  <table border="0" align="left"><tr><td class="bold_one" style="font-size:8px;width: 140px;" >Lote: ' . $amostraalimentos->getFtLote() . '</td><td class="bold_one" style="font-size:8px;width:  140px;" >Acondicionamento:' . $amostraalimentos->getFtAcondicionamento() . '</td></tr><tr><td class="bold_one" style="font-size:8px;width: 140px;" >Validade: ' . $amostraalimentos->getFtValidade() . ' </td><td class="bold_one" style="font-size:8px;width: 140px;" >Fase do processo:' . $amostraalimentos->getFtFaseprocesso() . '</td></tr><tr><td class="bold_one" style="font-size:8px;width: 140px;" >Temperatura: ' . $amostraalimentos->getFtTemperatura() . ' </td></tr></table>  </td></tr>';
            } else {
                $origem = '<tr><td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">Origem da Amostra:</td></tr><tr><td width="100" style="font-size: 10px;text-align:left;padding-left: 10px;width: 100%;margin: 0;" class="tit_info_amostra">' . $amostra->getFtOrigem() . '</td></tr>';
            }
            //texto das vars
            $ref = utf8_decode('Referência');
            $recepcao = utf8_decode('Recepção');
            $datacolheita = $amostra->getFdColheita()->format('d-m-Y');
            //date de recepção da amostra
            $sql = "select * from t_amostras_logs where fn_id_amostra = " . $slug .
                " group by ft_id_estado order by fn_id desc";
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $datarecepcao = $activeDate->fetchAll();
            if (count($datarecepcao) != 0) {
                $datarecepcao = strtotime($datarecepcao[0]['updated_by_time']);
                $datarecepcao = date('d-m-Y', $datarecepcao);
            } else {
                $datarecepcao = "";
            }
            //date de inicio dos trabalhos
            $sql = "select * from t_amostras_logs where fn_id_amostra = " . $slug .
                " and ft_id_estado = 3 group by ft_id_estado order by fn_id desc";
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $datainicio = $activeDate->fetchAll();
            if (count($datainicio) != 0) {
                $datainicio = strtotime($datainicio[0]['updated_by_time']);
                $datainicio = date('d-m-Y', $datainicio);
            } else {
                $datainicio = "";
            }
            //date de fim dos trabalhos
            $sql = "select * from t_amostras_logs where fn_id_amostra = " . $slug .
                " and ft_id_estado = 2 group by ft_id_estado order by fn_id desc";
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $datafim = $activeDate->fetchAll();
            if (count($datafim) != 0) {
                $datafim = strtotime($datafim[0]['updated_by_time']);
                $datafim = date('d-m-Y', $datafim);
            } else {
                $datafim = "";
            }
            $ref_ext = utf8_decode($amostra->getFtRefexterna());
// set header and footer fonts
            $pdf->SetLineStyle(array('width' => 0.25 / 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255)));
            $pdf->AddPage();
            $html = <<<EOF
        <style type="text/css">
    .info_amostra{
        font-size: 11px;
    }
    .odd{
        background-color: #FFFFAA;
    }
    h3{
        text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;
    }
    .table_resultados *{
    font-size:8px !important;
    }
    .font8{
    font-size:8px !important;
    }
    .info_amostra div{
        float: left;
    }
    .table_colheita_info td{
        border:none;
        font-size:8px;
        padding: 2px;
    }
    .table_colheita_info {
        border-top :1px solid #000;
        border-bottom :1px solid #000;
    }
    .table_colheita_info .table_colheita_info_data{
        background-color: gray;
        padding-left: 10px;
    }
    .table_parametros_tecnica{
        font-size:7px;
        font-weight: normal;
    }
    .table_resultados .resultados_one{
        font-size:9px;
        font-weight: normal;
    }
     .table_resultados{
        
        border-bottom :2px solid #000;
    }
    .table_resultados span{
        width:100%;
    }
    .table_resultados{
    }
    .table_parametros td{
        border:none;
        font-size:9px;
        font-weight: bold;
        padding-top: 8px;
    }
    .table_parametros td span{
        display:block;
    }
    .table_parametros {
        border-top :1px solid #000;
        border-bottom :1px solid #000;
    }
    .apreciacao{
        font-size:10px;
        font-weight: bold;
        margin-top : 10px;
        border-bottom :2px solid #000;
    }
    .margin{
        margin-top : 10px;
    }
    .info_amostra div div{
        width: 100%;
        float: left;
        padding-left: 5px;
    }
</style>
        <table class="first"  cellspacing="1" cellpadding="1">
            <tr>
                <td  align="left" width="280">
                    <table cellspacing="1" cellpadding="2">
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">Tipo de Amostra:</td>
                        </tr>
                        <tr>
                            <td width="100" style="font-size: 10px;text-align:left;padding-left: 10;width: 100%;margin: 0;" class="tit_info_amostra">{$modeloamostra->getFnTipoamostra()->getFtDescricao()}</td>
                        </tr>
                         {$origem}
                         <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">Colheita Realizada por:</td>
                        </tr>
                        <tr>
                            <td width="100" style="font-size: 10px;text-align:left;padding-left: 10;width: 100%;margin: 0;" class="tit_info_amostra">{$amostra->getFtResponsavelcolheita()}</td>
                        </tr>
                         <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">{$ref}</td>
                        </tr>
                        <tr>
                            <td width="100" style="font-size: 10px;text-align:left;padding-left: 10;width: 100%;margin: 0;" class="tit_info_amostra">{$ref_ext}</td>
                        </tr>
                    </table>
                </td>
                <td  align="left" width="10"></td>
                <td  align="left" width="220">
                    <table cellspacing="1" cellpadding="2">
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;width: 100%;margin: 0;" class="tit_info_amostra"></td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;"  bgcolor="#d3d3d3" class="tit_info_amostra">{$cliente->getFtNome()}</td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;"  bgcolor="#d3d3d3" class="tit_info_amostra">{$cliente->getFtMorada()}</td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;" bgcolor="#d3d3d3" class="tit_info_amostra">{$cliente->getFtCodpostal()}- {$cliente->getFtLocalidade()}</td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;" bgcolor="#d3d3d3" class="tit_info_amostra"></td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;" class="tit_info_amostra"></td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;" class="tit_info_amostra"></td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;width: 100%;margin: 0;" class="tit_info_amostra"></td>
                        </tr>
                    </table>
                </td>
         </tr>
        </table>
        <table class="table_colheita_info" cellspacing="0" cellpadding="1">
            <tr>
                <td>Colheita:</td>
                <td class="table_colheita_info_data">{$datacolheita}</td>
                <td>{$recepcao}:</td>
                <td class="table_colheita_info_data">{$datarecepcao}</td>
                <td>Inicio ensaios:</td>
                <td class="table_colheita_info_data">{$datainicio}</td>
                <td>Fim dos ensaios:</td>
                <td class="table_colheita_info_data">{$datafim}</td>
            </tr>
        </table>
      {$body_micro}
      {$body_fisico}
      {$conclusao}
EOF;
            $tagvs = array('p' => array(1 => array('h' => 0.0001, 'n' => 1)), 'ul' => array(0 => array('h' => 0.0001, 'n' => 1)));
            $pdf->setHtmlVSpace($tagvs);
// output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->setAutoPageBreak(true, 30);
        }
        $pdf->lastPage();
// set default monospaced font
// set margins
// set auto page breaks
// set image scale factor
        if($conta > 1)
            $fileNL = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR ."relatorios" . DIRECTORY_SEPARATOR ."relatorio_amostras". $ids_file.".pdf";
        else
            $fileNL = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . "relatorios" . DIRECTORY_SEPARATOR . "relatorio_amostra_" . $samples[0] .".pdf";
        $pdf->Output($fileNL , 'FI');
    }

    public function EmitRelatorioAction($slug){
        error_reporting(0);
        $pdf = $this->container->get("white_october.tcpdf")->create(
            'P',
            'mm',
            'A4',
            false,
            'ISO-8859-1',
            false
        );
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Pimenta do Vale');
        $pdf->SetTitle('RELATÓRIO DE AMOSTRAS');
// set default header data
        $pdf->SetMargins(7, 35, 7);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterData(array(date("d-m-Y"), 0, 0), array(1, 0, 0));
        //TODO: ir buscar o tipo de parametros e colocar diretamente na tabela parametrosamostras
        $cumpre = true;
        $em = $this->getDoctrine()->getManager();
        $amostra = $em->getRepository('AppBundle:TAmostras')->findOneBy(array('fnId' => $slug));
        if(!$amostra->getFnEspecificacao() || !$amostra->getFnModelo() || !$amostra->getFtGrupoparametros())
        {
            return new Response("Defina a especificação, o modelo de amostra e o grupo de parâmetros para a amostra com o ID " . $amostra->getFnId());
        }
        $especificacao = $em->getRepository('AppBundle:TEspecificacoes')->findOneBy(array('fnId' => $amostra->getFnEspecificacao()));
        $parametros = $em->getRepository('AppBundle:TParametrosamostra')->findByFnIdAmostra($slug);
        foreach ($parametros as &$value) {
            $parametro = $em->getRepository('AppBundle:TParametros')->findOneBy(array('fnId' => $value->getFnId()));
            $value->setFnTipoparametro($parametro->getFnTipoparametro());
        }
        $header_micro = '<table class="table_parametros" ><tr style="margin-top 5px;"><td style="width:15px;"></td><td colspan="4"><span>' . utf8_decode("Parâmetros Microbiologicos") . '</span><br/><span class="table_parametros_tecnica">' . utf8_decode("Método de ensaio / Técnica analítica") . '</span></td><td class="table_parametros_data"></td><td>Unidades</td><td class="table_parametros_data">' . $especificacao->getFtSiglavl() . '</td><td>Incerteza</td><td></td><td class="table_parametros_data"></td></tr></table>';
        $header_fisico = '<table class="table_parametros" ><tr style="margin-top 5px;"><td style="width:15px;"></td><td colspan="4"><span>' . utf8_decode("Físico-químicos") . '</span><br/><span class="table_parametros_tecnica">' . utf8_decode("Método de ensaio / Técnica analítica") . '</span></td><td class="table_parametros_data"></td><td>Unidades</td><td class="table_parametros_data">' . $especificacao->getFtSiglavl() . '</td><td>Incerteza</td><td></td><td class="table_parametros_data"></td></tr></table>';
        $body_fisico = "";
        $body_micro = "";
        $microeven = 0;
        $fisieven = 0;
        $tt = 0;
        //valida se nesta amostra existe algum parametro que tenha certificaçao, caso tenha coloca a imagem do ipac no header caso contrario não coloca
        $ipac_cert = false;
        foreach ($parametros as &$value) {
            if ($value->getFbAmostraexterno() || $value->getFbAmostrainterno() || $value->getFbDeterminacaoexterno() || $value->getFbDeterminacaointerno()) {
                $ipac_cert = true;
                $pdf->SetHeaderData('logopimenta.png', 50, utf8_decode('RELATÓRIO DE AMOSTRAS'),PDF_HEADER_STRING);
            }
        }
        if($ipac_cert==false)
            $pdf->SetPrintHeader(false);
        //TODO: melhorar a logica dos parametros
        foreach ($parametros as &$value) {
            $label = "";
            if ($value->getFnTipoparametro() != null && $value->getFnTipoparametro()->getFtCodigo() == "Microbiologicos") {
                $resultado = $em->getRepository('AppBundle:TResultados')->findOneBy(array('fnParametro' => $value->getId()));
                $espe_texto = "";
                foreach ($especificacao->getfnParametros() as &$para_espe) {
                    if ($para_espe->getFnIdFamiliaparametro()->getFnId() == $value->getFnId()) {
                        $sql = "SELECT * FROM t_parametrosporespecificacao where fn_id_familiaparametro = " .
                            $para_espe->getFnIdFamiliaparametro()->getFnId() .
                            " and fn_id_especificacao = " . $amostra->getFnEspecificacao()->getFnId() . " ";
                        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                        $activeDate->execute();
                        $last = $activeDate->fetchAll();
                        $original = floatval($resultado->getFtOriginal());
                        $max = floatval($last[0]['fn_maximo']);
                        $min = floatval($last[0]['fn_minimo']);
                        if ($original < $max && $original > $min) {
                            $espe_texto = utf8_decode($last[0]['ft_texto_relatorio']);
                        } else {
                            $cumpre = false;
                            $espe_texto = utf8_decode($especificacao->getFtTextoQdNaoPassaP());
                        }
                    }
                }
                if ($value->getFbAmostrainterno() || $value->getFbDeterminacaointerno() || $ipac_cert == false) {
                    if (!$value->getFbAmostrainterno()) {
                        $label = $label . "(4)";
                    }
                    if (!$value->getFbDeterminacaointerno()) {
                        $label = $label . "(1)";
                    }
                } else {
                    if ($value->getFbAmostraexterno() || $value->getFbDeterminacaoexterno()) {
                        if (!$value->getFbAmostraexterno()) {
                            $label = $label . "(5)";
                        }
                        if (!$value->getFbDeterminacaoexterno()) {
                            $label = $label . "(2)";
                        }
                    } else {
                        if (!$value->getFbAmostrainterno()) {
                            $label = $label . "(4)";
                        }
                        if (!$value->getFbDeterminacaointerno()) {
                            $label = $label . "(1)";
                        }
                        if ($value->getFbAmostraexterno()) {
                            $label = $label . "(6)";
                        }
                        if ($value->getFbDeterminacaoexterno()) {
                            $label = $label . "(3)";
                        }
                    }
                }
                if ($body_micro == "") {
                    if($value->getFnFamiliaparametro() && $value->getFnMetodo() && $value->getFnMetodo()->getFnTecnica() && $resultado->getFnUnidade())
                    {
                        $body_micro = $header_micro . '<table class="table_resultados"><tr style=""><td style="width:18px;font-size:5px;">' . $label . '</td><td colspan="4" class="resultados_one" style="">' . utf8_decode($value->getFnFamiliaparametro()->getFtDescricao()) . ' <br /><span class="table_parametros_tecnica">' . utf8_decode($value->getFnMetodo()->getFtDescricao()) . '/ ' . $value->getFnMetodo()->getFnTecnica()->getFtDescricao() . '</span></td><td class="">' . $resultado->getFtFormatado() . '</td><td>' . $resultado->getFnUnidade()->getFtDescricao() . '</td><td class="table_parametros_data">' . $espe_texto . '</td><td></td><td></td><td class="table_parametros_data"></td></tr>';
                        $microeven++;
                    }
                } else {
                    $microeven++;
                    if ($microeven % 2 == 0) {
                        $microevenclass = "#d3d3d3";
                    } else {
                        $microevenclass = "#ffffff";
                    }
                    if($value->getFnFamiliaparametro() && $value->getFnMetodo() && $value->getFnMetodo()->getFnTecnica() && $resultado->getFnUnidade())
                        $body_micro = $body_micro . '<tr bgcolor="' . $microevenclass . '" style=""><td style="width:18px;font-size:5px;">' . $label . '</td><td bgcolor="' . $microevenclass . '" colspan="4" class="resultados_one" style="">' . utf8_decode($value->getFnFamiliaparametro()->getFtDescricao()) . ' <br /><span class="table_parametros_tecnica">' . utf8_decode($value->getFnMetodo()->getFtDescricao()) . '/ ' . $value->getFnMetodo()->getFnTecnica()->getFtDescricao() . '</span></td><td class="" bgcolor="' . $microevenclass . '">' . $resultado->getFtFormatado() . '</td><td bgcolor="' . $microevenclass . '">' . $resultado->getFnUnidade()->getFtDescricao() . '</td><td class="table_parametros_data">' . $espe_texto . '</td><td></td><td></td><td class="table_parametros_data"></td></tr>';
                }
            }
            if ($value->getFnTipoparametro() != null && $value->getFnTipoparametro()->getFtCodigo() == "FisicoQuimicos") {
                $resultado = $em->getRepository('AppBundle:TResultados')->findOneBy(array('fnParametro' => $value->getId()));
                $espe_texto = "";
                foreach ($especificacao->getfnParametros() as &$para_espe) {
                    if ($para_espe->getFnIdFamiliaparametro()->getFnId() == $value->getFnId()) {
                        $sql = "SELECT * FROM t_parametrosporespecificacao where fn_id_familiaparametro = " .
                            $para_espe->getFnIdFamiliaparametro()->getFnId() .
                            " and fn_id_especificacao = " . $amostra->getFnEspecificacao()->getFnId() . " ";
                        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                        $activeDate->execute();
                        $last = $activeDate->fetchAll();
                        $original = floatval($resultado->getFtOriginal());
                        $max = floatval($last[0]['fn_maximo']);
                        $min = floatval($last[0]['fn_minimo']);
                        if ($original < $max && $original > $min) {
                            $espe_texto = utf8_decode($last[0]['ft_texto_relatorio']);
                        } else {
                            $cumpre = false;
                            $espe_texto = utf8_decode($especificacao->getFtTextoQdNaoPassaP());
                        }
                    }
                }
                if ($value->getFbAmostrainterno() || $value->getFbDeterminacaointerno() || $ipac_cert == false) {
                    if (!$value->getFbAmostrainterno()) {
                        $label = $label . "(4)";
                    }
                    if (!$value->getFbDeterminacaointerno()) {
                        $label = $label . "(1)";
                    }
                } else {
                    if ($value->getFbAmostraexterno() || $value->getFbDeterminacaoexterno()) {
                        if (!$value->getFbAmostraexterno()) {
                            $label = $label . "(5)";
                        }
                        if (!$value->getFbDeterminacaoexterno()) {
                            $label = $label . "(2)";
                        }
                    } else {
                        if (!$value->getFbAmostrainterno()) {
                            $label = $label . "(4)";
                        }
                        if (!$value->getFbDeterminacaointerno()) {
                            $label = $label . "(1)";
                        }
                        if ($value->getFbAmostraexterno()) {
                            $label = $label . "(6)";
                        }
                        if ($value->getFbDeterminacaoexterno()) {
                            $label = $label . "(3)";
                        }
                    }
                }
                if ($body_fisico == "") {
                    if($value->getFnFamiliaparametro() && $value->getFnMetodo() && $value->getFnMetodo()->getFnTecnica() && $resultado->getFnUnidade())
                    {
                        $body_fisico = $header_fisico . '<table class="table_resultados" ><tr style="margin-top 0px;"><td style="width:18px;font-size:5px;">' . $label . '</td><td colspan="4" class="resultados_one" style="">' . utf8_decode($value->getFnFamiliaparametro()->getFtDescricao()) . ' <br /><span class="table_parametros_tecnica">' . utf8_decode($value->getFnMetodo()->getFtDescricao()) . '/ ' . $value->getFnMetodo()->getFnTecnica()->getFtDescricao() . '</span></td><td class="">' . $resultado->getFtFormatado() . '</td><td>' . $resultado->getFnUnidade()->getFtDescricao() . '</td><td class="table_parametros_data">' . $espe_texto . '</td><td></td><td class="table_parametros_data"></td></tr>';
                        $fisieven++;
                    }
                } else {
                    $fisieven++;
                    if ($fisieven % 2 == 0) {
                        $fisievenclass = "#d3d3d3";
                    } else {
                        $fisievenclass = "#ffffff";
                    }
                    if($value->getFnFamiliaparametro() && $value->getFnMetodo() && $value->getFnMetodo()->getFnTecnica() && $resultado->getFnUnidade())
                        $body_fisico = $body_fisico . '<tr bgcolor="' . $fisievenclass . '" style="margin-top 0px;"><td style="width:18px;font-size:5px;">' . $label . '</td><td colspan="4" class="resultados_one" style="">' . utf8_decode($value->getFnFamiliaparametro()->getFtDescricao()) . ' <br /><span class="table_parametros_tecnica">' . utf8_decode($value->getFnMetodo()->getFtDescricao()) . '/ ' . $value->getFnMetodo()->getFnTecnica()->getFtDescricao() . '</span></td><td class="">' . $resultado->getFtFormatado() . '</td><td>' . $resultado->getFnUnidade()->getFtDescricao() . '</td><td class="table_parametros_data">' . $espe_texto . '</td><td></td><td class="table_parametros_data"></td></tr>';
                }
            }
        }
        /*
                if ($cumpre) {
                    $conclusao = '<div></div><table class="margin"><tr><td class="apreciacao">' . utf8_decode("(*)Apreciação") . '</td></tr><tr><td class="font8">' . utf8_decode($especificacao->getFtTextoQdCumpreA()) . '</td></tr></table>';
                } else {
                    $conclusao = '<div></div><table class="margin"><tr><td class="apreciacao">' . utf8_decode("(*)Apreciação") . '</td></tr><tr><td class="font8">' . utf8_decode($especificacao->getFtTextoQdNaoCumpreA()) . '</td></tr></table>';
                }*/
        $conclusao = '<div></div><table class="margin"><tr><td class="apreciacao">' . utf8_decode("(*)Apreciação") . '</td></tr><tr><td class="font8">' . utf8_decode($amostra->getFtConclusao()) . '</td></tr></table>';
        $body_fisico = $body_fisico . '</table></br>';
        $body_micro = $body_micro . '</table></br>';
        $modeloamostra = $em->getRepository('AppBundle:TModelosamostra')->findOneBy(array('fnId' => $amostra->getFnModelo()->getFnId()));
        $amostraalimentos = $em->getRepository('AppBundle:TAmostrasalimentos')->findOneBy(array('fnId' => $amostra->getFnAmostrasalimentos()->getFnId()));
        $cliente = $em->getRepository('AppBundle:TClientes')->findOneBy(array('fnId' => $amostra->getFnCliente()->getFnId()));
        if ($amostraalimentos->getFtLote() != null || $amostraalimentos->getFtAcondicionamento() != null || $amostraalimentos->getFtTemperatura() != null || $amostraalimentos->getFtFaseprocesso() != null) {
            $origem = '<tr><td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">Origem da Amostra:</td></tr><tr><td width="100" style="font-size: 10px;text-align:left;padding-left: 10px;width: 100%;margin: 0;" class="tit_info_amostra">  <table border="0" align="left"><tr><td class="bold_one" style="font-size:8px;width: 140px;" >Lote: ' . $amostraalimentos->getFtLote() . '</td><td class="bold_one" style="font-size:8px;width:  140px;" >Acondicionamento:' . $amostraalimentos->getFtAcondicionamento() . '</td></tr><tr><td class="bold_one" style="font-size:8px;width: 140px;" >Validade: ' . $amostraalimentos->getFtValidade() . ' </td><td class="bold_one" style="font-size:8px;width: 140px;" >Fase do processo:' . $amostraalimentos->getFtFaseprocesso() . '</td></tr><tr><td class="bold_one" style="font-size:8px;width: 140px;" >Temperatura: ' . $amostraalimentos->getFtTemperatura() . ' </td></tr></table>  </td></tr>';
        } else {
            $origem = '<tr><td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">Origem da Amostra:</td></tr><tr><td width="100" style="font-size: 10px;text-align:left;padding-left: 10px;width: 100%;margin: 0;" class="tit_info_amostra">' . $amostra->getFtOrigem() . '</td></tr>';
        }
        //texto das vars
        $ref = utf8_decode('Referência');
        $recepcao = utf8_decode('Recepção');
        $datacolheita = $amostra->getFdColheita()->format('d-m-Y');
        //date de recepção da amostra
        $sql = "select * from t_amostras_logs where fn_id_amostra = " . $slug .
            " group by ft_id_estado order by fn_id desc";
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $datarecepcao = $activeDate->fetchAll();
        if (count($datarecepcao) != 0) {
            $datarecepcao = strtotime($datarecepcao[0]['updated_by_time']);
            $datarecepcao = date('d-m-Y', $datarecepcao);
        } else {
            $datarecepcao = "";
        }
        //date de inicio dos trabalhos
        $sql = "select * from t_amostras_logs where fn_id_amostra = " . $slug .
            " and ft_id_estado = 3 group by ft_id_estado order by fn_id desc";
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $datainicio = $activeDate->fetchAll();
        if (count($datainicio) != 0) {
            $datainicio = strtotime($datainicio[0]['updated_by_time']);
            $datainicio = date('d-m-Y', $datainicio);
        } else {
            $datainicio = "";
        }
        //date de fim dos trabalhos
        $sql = "select * from t_amostras_logs where fn_id_amostra = " . $slug .
            " and ft_id_estado = 2 group by ft_id_estado order by fn_id desc";
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $datafim = $activeDate->fetchAll();
        if (count($datafim) != 0) {
            $datafim = strtotime($datafim[0]['updated_by_time']);
            $datafim = date('d-m-Y', $datafim);
        } else {
            $datafim = "";
        }
        $ref_ext = utf8_decode($amostra->getFtRefexterna());
// set header and footer fonts
        $pdf->SetLineStyle(array('width' => 0.25 / 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255)));
        $pdf->AddPage();
        $html = <<<EOF
        <style type="text/css">
    .info_amostra{
        font-size: 11px;
    }
    .odd{
        background-color: #FFFFAA;
    }
    h3{
        text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;
    }
    .table_resultados *{
    font-size:8px !important;
    }
    .font8{
    font-size:8px !important;
    }
    .info_amostra div{
        float: left;
    }
    .table_colheita_info td{
        border:none;
        font-size:8px;
        padding: 2px;
    }
    .table_colheita_info {
        border-top :1px solid #000;
        border-bottom :1px solid #000;
    }
    .table_colheita_info .table_colheita_info_data{
        background-color: gray;
        padding-left: 10px;
    }
    .table_parametros_tecnica{
        font-size:7px;
        font-weight: normal;
    }
    .table_resultados .resultados_one{
        font-size:9px;
        font-weight: normal;
    }
     .table_resultados{
        
        border-bottom :2px solid #000;
    }
    .table_resultados span{
        width:100%;
    }
    .table_resultados{
    }
    .table_parametros td{
        border:none;
        font-size:9px;
        font-weight: bold;
        padding-top: 8px;
    }
    .table_parametros td span{
        display:block;
    }
    .table_parametros {
        border-top :1px solid #000;
        border-bottom :1px solid #000;
    }
    .apreciacao{
        font-size:10px;
        font-weight: bold;
        margin-top : 10px;
        border-bottom :2px solid #000;
    }
    .margin{
        margin-top : 10px;
    }
    .info_amostra div div{
        width: 100%;
        float: left;
        padding-left: 5px;
    }
</style>
        <table class="first"  cellspacing="1" cellpadding="1">
            <tr>
                <td  align="left" width="280">
                    <table cellspacing="1" cellpadding="2">
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">Tipo de Amostra:</td>
                        </tr>
                        <tr>
                            <td width="100" style="font-size: 10px;text-align:left;padding-left: 10;width: 100%;margin: 0;" class="tit_info_amostra">{$modeloamostra->getFnTipoamostra()->getFtDescricao()}</td>
                        </tr>
                         {$origem}
                         <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">Colheita Realizada por:</td>
                        </tr>
                        <tr>
                            <td width="100" style="font-size: 10px;text-align:left;padding-left: 10;width: 100%;margin: 0;" class="tit_info_amostra">{$amostra->getFtResponsavelcolheita()}</td>
                        </tr>
                         <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;border-bottom: 1px solid black;width: 100%;margin: 0;" class="tit_info_amostra">{$ref}</td>
                        </tr>
                        <tr>
                            <td width="100" style="font-size: 10px;text-align:left;padding-left: 10;width: 100%;margin: 0;" class="tit_info_amostra">{$ref_ext}</td>
                        </tr>
                    </table>
                </td>
                <td  align="left" width="10"></td>
                <td  align="left" width="220">
                    <table cellspacing="1" cellpadding="2">
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;width: 100%;margin: 0;" class="tit_info_amostra"></td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;"  bgcolor="#d3d3d3" class="tit_info_amostra">{$cliente->getFtNome()}</td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;"  bgcolor="#d3d3d3" class="tit_info_amostra">{$cliente->getFtMorada()}</td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;" bgcolor="#d3d3d3" class="tit_info_amostra">{$cliente->getFtCodpostal()}- {$cliente->getFtLocalidade()}</td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;" bgcolor="#d3d3d3" class="tit_info_amostra"></td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;" class="tit_info_amostra"></td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;margin: 0;" class="tit_info_amostra"></td>
                        </tr>
                        <tr>
                            <td  style="font-size: 10px;text-align:left;padding: 0;font-weight: bold;width: 100%;margin: 0;" class="tit_info_amostra"></td>
                        </tr>
                    </table>
                </td>
         </tr>
        </table>
        <table class="table_colheita_info" cellspacing="0" cellpadding="1">
            <tr>
                <td>Colheita:</td>
                <td class="table_colheita_info_data">{$datacolheita}</td>
                <td>{$recepcao}:</td>
                <td class="table_colheita_info_data">{$datarecepcao}</td>
                <td>Inicio ensaios:</td>
                <td class="table_colheita_info_data">{$datainicio}</td>
                <td>Fim dos ensaios:</td>
                <td class="table_colheita_info_data">{$datafim}</td>
            </tr>
        </table>
      {$body_micro}
      {$body_fisico}
      {$conclusao}
EOF;
        $tagvs = array('p' => array(1 => array('h' => 0.0001, 'n' => 1)), 'ul' => array(0 => array('h' => 0.0001, 'n' => 1)));
        $pdf->setHtmlVSpace($tagvs);
// output the HTML content
        $pdf->writeHTML($html, true, true, true, true, '');
        $pdf->setAutoPageBreak(true, 30);
        $pdf->lastPage();
// set default monospaced font
// set margins
// set auto page breaks
// set image scale factor
        $fileNL = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . "relatorios" . DIRECTORY_SEPARATOR . "relatorio_amostra_" . $slug . ".pdf";
        return new Response($pdf->Output($fileNL , 'FI'));
    }

    //Get relatorio
    public function GetRelatorioAction($slug){
        $file = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . "amostras" . DIRECTORY_SEPARATOR ."87.pdf" .
            //$file = '/var/www/html/lab/app/amostras/87.pdf';
            $filename = 'filename.pdf';
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($file);
    }

    //Sample actions
    public function CompletesampleAction($slug)
    {
        error_reporting(0);
        $em = $this->getDoctrine()->getManager();
        $amostra = $em->getRepository('AppBundle:TAmostras')->findOneBy(array('fnId' => $slug));
        if ($amostra->getFtEstado()->getFtCodigo() == 'P') {
            return new Response("0");
        }
        $estado = $em->getRepository('AppBundle:TEstados')->findOneBy(array('ftCodigo' => 'C'));
        $amostra->setFtEstado($estado);
        $em->persist($amostra);
        $em->flush();
        return new Response("" . $estado->getFnId());
    }

    public function ReopensampleAction($slug)
    {
        error_reporting(0);
        $em = $this->getDoctrine()->getManager();
        $amostra = $em->getRepository('AppBundle:TAmostras')->findOneBy(array('fnId' => $slug));
        if ($amostra->getFtEstado()->getFtCodigo() == 'P') {
            return new Response("0");
        }
        $estado = $em->getRepository('AppBundle:TEstados')->findOneBy(array('ftCodigo' => 'D'));
        $amostra->setFtEstado($estado);
        $em->persist($amostra);
        $em->flush();
        return new Response("" . $estado->getFnId());
    }

    public function CancelsampleAction($slug)
    {
        error_reporting(0);
        $em = $this->getDoctrine()->getManager();
        $amostra = $em->getRepository('AppBundle:TAmostras')->findOneBy(array('fnId' => $slug));
        $estado = $em->getRepository('AppBundle:TEstados')->findOneBy(array('ftCodigo' => 'X'));
        $amostra->setFtEstado($estado);
        $em->persist($amostra);
        $em->flush();
        return new Response("" . $estado->getFnId());
    }

    //get all sample with the selected parameter
    public function GetparameterbysampleAction()
    {
        $id_parameter = $this->get("request")->getContent();
        $sql = "select t_parametrosamostra.fn_id_amostra , t_parametrosamostra.ft_descricao , 
               t_parametrosamostra.ft_id_estado , t_metodos.ft_descricao as metodo, 
               t_tecnicas.ft_descricao as tecnica from t_parametrosamostra 
               inner join t_amostras on t_amostras.fn_id = t_parametrosamostra.fn_id_amostra 
               left join t_metodos  on t_parametrosamostra.fn_id_metodo = t_metodos.fn_id 
               left join t_tecnicas on t_metodos.fn_id_tecnica = t_tecnicas.fn_id 
               where (t_amostras.ft_id_estado = 4 or t_amostras.ft_id_estado = 6 or t_amostras.ft_id_estado = 3 
               or t_amostras.ft_id_estado = 1) and t_parametrosamostra.fn_id = " . $id_parameter;
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $result = $activeDate->fetchAll();
        if (count($result) != 0) {
            $response = array("data" => $result);
        } else {
            $response = "NoData";
        }
        return new Response(json_encode($response));
    }

    // get parameters by sample for worklist grouped by parameter
    public function GetparameterbysampleForParameterAction()
    {
        $id_parameter = $this->get("request")->getContent();
        $arr2 = explode(",", $id_parameter );
        $id_parameter  = $arr2[0];
        $id_metodo = $arr2[1];
        if(intval($id_metodo) != 0)
            $sql = "select t_parametrosamostra.fn_id_amostra,t_parametrosamostra.ft_descricao ,
                    t_parametrosamostra.ft_id_estado,t_metodos.ft_descricao as metodo,
                    t_tecnicas.ft_descricao as tecnica 
                    from t_parametrosamostra 
                    inner join t_amostras on t_amostras.fn_id = t_parametrosamostra.fn_id_amostra 
                    left join t_metodos  on t_parametrosamostra.fn_id_metodo = t_metodos.fn_id 
                    left join t_tecnicas on t_metodos.fn_id_tecnica = t_tecnicas.fn_id 
                    where (t_amostras.ft_id_estado = 4 or (t_amostras.ft_id_estado = 6 
                    and t_parametrosamostra.listatrabalho_id IS NULL) ) 
                    and t_parametrosamostra.fn_id_metodo = ". $id_metodo ." 
                    and t_parametrosamostra.fn_id = ". $id_parameter ;
        else
            $sql = "select t_parametrosamostra.fn_id_amostra,t_parametrosamostra.ft_descricao ,
                    t_parametrosamostra.ft_id_estado,t_metodos.ft_descricao as metodo,
                    t_tecnicas.ft_descricao as tecnica 
                    from t_parametrosamostra 
                    inner join t_amostras on t_amostras.fn_id = t_parametrosamostra.fn_id_amostra 
                    left join t_metodos  on t_parametrosamostra.fn_id_metodo = t_metodos.fn_id 
                    left join t_tecnicas on t_metodos.fn_id_tecnica = t_tecnicas.fn_id 
                    where (t_amostras.ft_id_estado = 4 or (t_amostras.ft_id_estado = 6 and 
                    t_parametrosamostra.listatrabalho_id IS NULL) ) 
                    and t_parametrosamostra.fn_id = ". $id_parameter ;
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $result = $activeDate->fetchAll();
        if (count($result) != 0) {
            $response = array("data" => $result);
        } else {
            $response = null;
        }
        return new Response(json_encode($response));
    }

    //Selecção de parametro por lista de amostra
    public function EmiteListaporParametroAction()
    {
        $em = $this->getDoctrine()->getManager();
        $parameters = $em->getRepository('AppBundle:TParametros')->findAll();
        $metodos= $em->getRepository('AppBundle:TMetodos')->findAll();
        return $this->render('AppBundle:ModelosListas:listaporparametro.html.twig',array('data' => $parameters,'data_metodos' => $metodos));
    }

    //TODO : notificar cliente de amostra completa
    public function NotifysampleAction($slug){
        //add new tparametrosamostra
        $to      = 'celso.s.falcao@gmail.com';
        $subject = 'the subject';
        $message = 'hello';
        $headers = 'From: celso.silva@iwish.solutions' . "\r\n" .
            'Reply-To: celso.silva@iwish.solutions' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
        return new Response("ok");
    }

    public function RelatoriosampleAction()
    {
        return new Response("ok");
    }

    public function AddNewparaAction($idsample, $idpara)
    {
        error_reporting(0);
        $resultflag = 0;
        $em = $this->getDoctrine()->getManager();
        //add new tparametrosamostra
        $amostra = $em->getRepository('AppBundle:TAmostras')->findOneByFnId($idsample);
        $conn = $this->getDoctrine()->getConnection();
        $sql = "INSERT INTO t_parametrosamostra (fn_id, listatrabalho_id, ft_descricao, 
                fn_id_metodo, fn_id_tecnica, fn_id_amostra, fn_id_areaensaio, fd_limiterealizacao, 
                ft_cumpreespecificacao, ft_conclusao, fn_id_modeloparametro, ft_observacao, fd_criacao, 
                fd_conclusao, fd_autorizacao, fn_id_laboratorio, fn_precocompra, fn_precovenda, fn_factorcorreccao, 
                fb_acreditado, fn_limitelegal, fn_id_familiaparametro, ft_formulaquimica, fn_id_frasco, 
                fn_volumeminimo, fb_confirmacao, ft_id_estado, fb_contraanalise, fd_Realizacao,fb_amostrainterno ,
                fb_amostraexterno ,fb_determinacaoexterno ,fb_determinacaointerno) 
                SELECT aa.fn_id, aa.listatrabalho_id, aa.ft_descricao, aa.fn_id_metodo, aa.fn_id_tecnica, 
                aa.fn_id_amostra, aa.fn_id_areaensaio, aa.fd_limiterealizacao, aa.ft_cumpreespecificacao, 
                aa.ft_conclusao, aa.fn_id_modeloparametro, aa.ft_observacao, aa.fd_criacao, aa.fd_conclusao, 
                aa.fd_autorizacao, aa.fn_id_laboratorio, aa.fn_precocompra, aa.fn_precovenda, aa.fn_factorcorreccao, 
                aa.fb_acreditado, aa.fn_limitelegal, aa.fn_id_familiaparametro, aa.ft_formulaquimica, 
                aa.fn_id_frasco, aa.fn_volumeminimo, aa.fb_confirmacao, 6, aa.fb_contraanalise, 
                aa.fd_Realizacao ,aa.fb_amostrainterno ,aa.fb_amostraexterno ,aa.fb_determinacaoexterno ,
                aa.fb_determinacaointerno FROM t_parametros AS aa WHERE aa.fn_id = " . $idpara;
        $activeDate = $this->getDoctrine()->getManager()->getConnection();
        $activeDate->prepare($sql)->execute();
        $par_am_id = $conn->lastInsertId('id');
        //log parametros
        $sql = "INSERT INTO t_parametrosamostra_log (fn_id, listatrabalho_id, ft_descricao, fn_id_metodo, 
                fn_id_tecnica, fn_id_amostra, fn_id_areaensaio, fd_limiterealizacao, ft_cumpreespecificacao, 
                ft_conclusao, fn_id_modeloparametro, ft_observacao, fd_criacao, fd_conclusao, fd_autorizacao, 
                fn_id_laboratorio, fn_precocompra,fn_precovenda, fn_factorcorreccao, fb_acreditado, fn_limitelegal, 
                fn_id_familiaparametro, ft_formulaquimica,fn_id_frasco, fn_volumeminimo, fb_confirmacao, ft_id_estado, fb_contraanalise, fd_Realizacao,id) SELECT aa.fn_id, 
                aa.listatrabalho_id, aa.ft_descricao, aa.fn_id_metodo, aa.fn_id_tecnica, aa.fn_id_amostra, 
                aa.fn_id_areaensaio, aa.fd_limiterealizacao, aa.ft_cumpreespecificacao, aa.ft_conclusao, 
                aa.fn_id_modeloparametro, aa.ft_observacao, aa.fd_criacao, aa.fd_conclusao, aa.fd_autorizacao, 
                aa.fn_id_laboratorio, aa.fn_precocompra, aa.fn_precovenda, aa.fn_factorcorreccao, aa.fb_acreditado, 
                aa.fn_limitelegal, aa.fn_id_familiaparametro, aa.ft_formulaquimica,aa.fn_id_frasco, 
                aa.fn_volumeminimo, aa.fb_confirmacao, 8 , aa.fb_contraanalise, aa.fd_Realizacao , aa.id 
                FROM t_parametrosamostra AS aa WHERE aa.id = " . $par_am_id;
        $activeDate = $this->getDoctrine()->getManager()->getConnection();
        $activeDate->prepare($sql)->execute();
        $sql = "SELECT max(id_table) as maximo_log from t_parametrosamostra_log";
        $activeDate =$this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $result1 = $activeDate->fetchAll();
        $par_am_log_id = $result1[0]['maximo_log'] != null ? $result1[0]['maximo_log'] : 0;
        $sql = "UPDATE t_parametrosamostra SET fn_id_amostra = " . $idsample . " where id=" . $par_am_id;
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        //log parametros
        $sql = "UPDATE t_parametrosamostra_log SET  ft_id_estado = 6 , date = NOW() ,  
                user = '" . $this->get('security.token_storage')->getToken()->getUser() .
            "' , fn_id_amostra = " . $idsample . " where id_table=" . $par_am_log_id;
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $NewAmostraParametro = new TAmostrasParametros();
        $NewAmostraParametro->setIdamostra($idsample);
        $NewAmostraParametro->setIdparametro($idpara);
        $em->persist($NewAmostraParametro);
        $em->flush();
        //cria resultado
        if (!$em->getRepository('AppBundle:TResultados')->findOneBy(array('fnParametro' => $idpara, 'fnAmostra' => $idsample))) {
            if ($resultflag != 1) {
                $result = new TResultados();
                $estado_resultados = $em->getRepository('AppBundle:TEstados')->findOneByFtCodigo('D');
                $result->setFnAmostra($amostra);
                $value2 = $em->getRepository('AppBundle:TParametrosamostra')->findOneBy(array('id' => $par_am_id));
                $result->setFnParametro($value2);
                $mod_para_id = $value2->getFnIdModeloparametro();
                $mod_para = $em->getRepository('AppBundle:TModelosparametro')->findOneByFnId($mod_para_id);
                $result->setFnModeloresultado($mod_para->getFnModeloresultado());
                $result->setFnUnidade($mod_para->getFnModeloresultado()->getFnUnidade());
                $result->setFtDescricao($value2->getFtDescricao());
                $result->setFtEstado($estado_resultados);
                $em->persist($result);
                $em->flush();
                $sql = "UPDATE t_resultados SET fn_id_parametro = " . $result->getFnParametro()->getId() .
                    " where fn_id=" . $result->getFnId();
                $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                $activeDate->execute();
            }
        }
        return $par_am_log_id;
    }

    public function GenerateworklistAction($slug)
    {
        error_reporting(0);
        $samples = explode(",", $slug);
        $par_container = [];
        $tipo_modelo = '';
        $resultflag = 0;
        $ids="";
        foreach ($samples as &$slug) {
            $ids .= "_" . $slug;
            $em = $this->getDoctrine()->getManager();
            $amostra = $em->getRepository('AppBundle:TAmostras')->findOneByFnId($slug);
            if ($amostra->getFtEstado()->getFtCodigo() != 'D') {

                $sql = "SELECT MAX(id_table) FROM t_parametrosamostra_log ";
                $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                $activeDate->execute();
                $last = $activeDate->fetchAll();
                $sql = "INSERT INTO t_parametrosamostra_log (fn_id, listatrabalho_id, ft_descricao, fn_id_metodo, 
                        fn_id_tecnica, fn_id_amostra, fn_id_areaensaio, fd_limiterealizacao, ft_cumpreespecificacao, 
                        ft_conclusao, fn_id_modeloparametro, ft_observacao, fd_criacao, fd_conclusao, 
                        fd_autorizacao, fn_id_laboratorio, fn_precocompra, fn_precovenda, fn_factorcorreccao, 
                        fb_acreditado, fn_limitelegal, fn_id_familiaparametro, ft_formulaquimica, fn_id_frasco, 
                        fn_volumeminimo, fb_confirmacao, ft_id_estado, fb_contraanalise, fd_Realizacao,id) 
                        SELECT aa.fn_id, aa.listatrabalho_id, aa.ft_descricao, aa.fn_id_metodo, aa.fn_id_tecnica, 
                        aa.fn_id_amostra, aa.fn_id_areaensaio, aa.fd_limiterealizacao, aa.ft_cumpreespecificacao, 
                        aa.ft_conclusao, aa.fn_id_modeloparametro, aa.ft_observacao, aa.fd_criacao, aa.fd_conclusao, 
                        aa.fd_autorizacao, aa.fn_id_laboratorio, aa.fn_precocompra, aa.fn_precovenda, 
                        aa.fn_factorcorreccao, aa.fb_acreditado, aa.fn_limitelegal, aa.fn_id_familiaparametro, 
                        aa.ft_formulaquimica, aa.fn_id_frasco, aa.fn_volumeminimo, aa.fb_confirmacao, 
                        aa.ft_id_estado, aa.fb_contraanalise, aa.fd_Realizacao , aa.id 
                        FROM t_parametrosamostra_log AS aa WHERE aa.ft_id_estado = 4 and aa.fn_id_amostra =" . $slug;
                $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                $activeDate->execute();

                $sql = "UPDATE t_parametrosamostra_log SET  date = NOW() ,  user = '" .
                    $this->get('security.token_storage')->getToken()->getUser() .
                    "' , ft_id_estado = 3 , fn_id_amostra = " . $slug .
                    " where id_table >" . $last[0]["MAX(id_table)"];
                $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                $activeDate->execute();


            }
            if ($amostra->getFtEstado()->getFtCodigo() == 'P') {
                return $this->render('AppBundle:ModelosListas:Indisponivel.html.twig', array('amostra' => $amostra->getFnId()));
            }
            if($amostra->getFtEstado()->getFtCodigo() != 'D' && $amostra->getFtEstado()->getFtCodigo() != 'C' && $amostra->getFtEstado()->getFtCodigo() != 'A' && $amostra->getFtEstado()->getFtCodigo() != 'X' && $amostra->getFtEstado()->getFtCodigo() != 'P' ){
                $arr = $em->getRepository('AppBundle\Entity\TParametrosgrupo')->findBytgrupo($amostra->getFtGrupoparametros());
                $flag = 0;
            }else{
                $arr = $em->getRepository('AppBundle:TAmostrasParametros')->findByIdamostra($slug);
                $flag = 1;
            }
            foreach ($arr as $value) {
                if ($flag == 0) {
                    $value2 = $em->getRepository('AppBundle:TParametros')->findOneByFnId($value->getTparametro());
                } else {
                    $value2 = $em->getRepository('AppBundle:TParametros')->findOneByFnId($value->getIdparametro());
                }
                if ($value2) {
                    $info = $value2->getFnIdAreaensaio();
                    $info2 = $em->getRepository('AppBundle:TAreasensaio')->findOneByFnId($info);
                    if (strpos($info2->getFtDescricao(), 'Alimentos') !== false) {
                        if ($tipo_modelo != '' && $tipo_modelo != 'Alimentos') {
                            $tipo_modelo = 'ERROR';
                        } else {
                            $tipo_modelo = 'Alimentos';
                        }
                    } else {
                        if ($tipo_modelo != '' && $tipo_modelo != 'Agua') {
                            $tipo_modelo = 'ERROR';
                        } else {
                            $tipo_modelo = 'Agua';
                        }
                    }
                }
            }
        }
        foreach ($samples as &$slug) {
            $em = $this->getDoctrine()->getManager();
            $amostra = $em->getRepository('AppBundle:TAmostras')->findOneByFnId($slug);
            $amostra2 = $em->getRepository('AppBundle:TAmostras')->findOneByFnId($slug);
            $estado = $em->getRepository('AppBundle:TEstados')->findOneByftId("D");
            $data_inicio = $amostra2->getFdCriacao();
            $flag = 0;
            if ($amostra->getFtEstado()->getFtCodigo() != 'D' && $amostra->getFtEstado()->getFtCodigo() != 'C' && $amostra->getFtEstado()->getFtCodigo() != 'A' && $amostra->getFtEstado()->getFtCodigo() != 'X') {
                if(!empty($amostra2->getFnModelo())){
                    $arr = $em->getRepository('AppBundle:TParametrosgrupo')->findBytgrupo($amostra2->getFnModelo()->getFnGrupoparametros()->getFnId());
                }else{
                    $arr = $em->getRepository('AppBundle:TParametrosgrupo')->findBytgrupo($amostra2->getFtGrupoparametros());
                }
                foreach ($arr as $value) {
                    $NewAmostraParametro = new TAmostrasParametros();
                    $NewAmostraParametro->setIdamostra($slug);
                    $NewAmostraParametro->setIdparametro($value->getTparametro());
                    $em->persist($NewAmostraParametro);
                    $em->flush();
                }
            } else {
                $flag = 1;
            }
            $amostra->setFtEstado($estado);
            $em->persist($amostra);
            $em->flush();
            $nome_produto = $amostra->getFnProduto()->getFtCodigo();
            //crio novo parametro associado a amostra em questão
            $arr = $em->getRepository('AppBundle:TParametrosamostra')->findByFnIdAmostra($slug);
            foreach ($arr as $value) {
                if ($flag == 0) {
                    $value2 = $em->getRepository('AppBundle:TParametrosamostra')->findOneBy(array('id' => $value->getId()));
                } else {
                    $value2 = $em->getRepository('AppBundle:TParametrosamostra')->findOneBy(array('id' => $value->getId()));
                }
                $info = $value2->getFtDescricao();

                if (!$em->getRepository('AppBundle:TResultados')->findOneBy(array('fnParametro' => $value2->getId(), 'fnAmostra' => $amostra2->getFnId()))) {
                    if ($resultflag != 1) {
                        $result = new TResultados();
                        $estado_resultados = $em->getRepository('AppBundle:TEstados')->findOneByFtCodigo('D');
                        $result->setFnAmostra($amostra2);
                        $result->setFnParametro($value2);
                        $mod_para_id = $value2->getFnIdModeloparametro();
                        $mod_para = $em->getRepository('AppBundle:TModelosparametro')->findOneByFnId($mod_para_id);
                        $result->setFnModeloresultado($mod_para->getFnModeloresultado());
                        $result->setFnUnidade($mod_para->getFnModeloresultado()->getFnUnidade());
                        $result->setFtDescricao($value2->getFtDescricao());
                        $result->setFtEstado($estado_resultados);
                        $em->persist($result);
                        $em->flush();
                        $sql = "UPDATE t_resultados SET fn_id_parametro = " . $result->getFnParametro()->getId()
                            . " where fn_id=" . $result->getFnId();
                        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                        $activeDate->execute();
                    }
                }
                $amostra = $em->getRepository('AppBundle:ModelosListas')->findOneByidParametro($value2->getFnId());
                if ($amostra != null) {
                    $par_container[] = ['tipo_modelo' => $tipo_modelo, 'data_inicio' => $data_inicio, "tablejson" => $amostra->getTablejson(), "id_amostra" => $amostra2->getFnId(), "nome_parametro" => $info, "tipo" => $nome_produto];
                } else {
                    $par_container[] = ['tipo_modelo' => $tipo_modelo, "tablejson" => "Por favor crie um modelo de Lista de Trabalho para o parametro " . $value2->getFtDescricao(), "id_amostra" => $amostra2->getFnId(), "nome_parametro" => $info, "tipo" => $nome_produto];
                }
            }
        }
        $html = $this->render('AppBundle:ModelosListas:modelo.html.twig', array(
            'par_container' => $par_container, 'tipo_de_amostra' => $tipo_modelo
        ))->getContent();
        $pdf = $this->container->get("white_october.tcpdf")->create(
            $orientation='P',
            $unit='mm',
            $format='A4',
            $unicode=true,
            $encoding='UTF-8',
            $diskcache=false,
            $pdfa=false,
            1
        );
        $pdf->setPrintFooter(true);
        $pdf->setPrintHeader(false);
        $pdf->SetMargins(5,6,0,false);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->lastPage();
        if(count($samples) > 1)
            $target_dir = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . "listas" . DIRECTORY_SEPARATOR . "lista_trabalho_amostras". $ids.".pdf";
        else
            $target_dir = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . "listas" . DIRECTORY_SEPARATOR . "lista_trabalho_amostra". $ids.".pdf";
        $response = new Response($pdf->Output($target_dir,'FI'));
        return $response;
    }


    public function GeraCodigoBarrasAction($slug)
    {
        error_reporting(0);
        $samples = explode(",", $slug);
        $ids = "";
        $pdf = $this->container->get("white_october.tcpdf")->create(
            $orientation='L',
            $unit='mm',
            $format='A4',
            $unicode=true,
            $encoding='UTF-8',
            $diskcache=false,
            $pdfa=false
            );

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Pimenta do Vale');
        $pdf->SetTitle('Código de Barras');
        // set default header data
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setAutoPageBreak(true, 30);

// set image scale factor
        $pdf->SetFont('helvetica', '', 10);
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => true,
            'fitwidth' => false,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 20,
            'stretchtext' => 0
        );

// add a page
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->AddPage();

        foreach ($samples as &$slug) {
            $ids .= "_" . $slug;
            $em = $this->getDoctrine()->getManager();
            $amostra = $em->getRepository('AppBundle:TAmostras')->findOneByFnId($slug);
            //$pdf->Cell(0, 0, 'Amostra com o ID ' . $amostra->getFnId(), 0, 1);
            $pdf->write1DBarcode('' . $amostra->getFnId(), 'EAN13', '', '', '', 180 , 0.4, $style, 'N');

            $pdf->Ln();
        }

        if(count($samples) > 1)
            $target_dir = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . "codigobarras" . DIRECTORY_SEPARATOR . "codigos_barras_amostras". $ids.".pdf";
        else
            $target_dir = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . "codigobarras" . DIRECTORY_SEPARATOR . "codigos_barras_amostra". $ids.".pdf";
        
        $pdf->Output($target_dir,'FI');
        return new Response("ok");
    }

    public function GetPDFFileAction($slug)
    {
        if(substr( $slug, 0, 6 ) === "Defina")
        {
            return new Response($slug);
        }
        $slug = str_replace('"', "", $slug);
        return new BinaryFileResponse('../app/listas/lista_trabalho_parametro_' . $slug);
    }

    /**
     * Geração do relatório dos logs associados à amostra e ao parâmetro em questão
     * @param $slug
     * @return Response
     */
    public function GenerateworklistaltAction($slug)
    {
        $repo_0 = $this->getDoctrine()->getRepository('AppBundle:TAmostras');
        $repo_1 = $this->getDoctrine()->getRepository('AppBundle:TParametrosamostra');
        $repo_2 = $this->getDoctrine()->getRepository('AppBundle:TResultados');
        $repo_3 = $this->getDoctrine()->getRepository('AppBundle:TParametros');
        $repo_4 = $this->getDoctrine()->getRepository('AppBundle:TProdutos');
        $repo_5 = $this->getDoctrine()->getRepository('AppBundle:TGruposparametros');
        $repo_6 = $this->getDoctrine()->getRepository('AppBundle:TModelosamostra');
        $amostra = $repo_0->find($slug);
        $header_inferior_direito = 'Processo de amostragem. Colheita ' . $amostra->getFdColheita()->format('d/m/Y')
            . ' - ' . $amostra->getFnCliente()->getFtNome();
        $sql = "SELECT * FROM t_parametrosamostra_log WHERE fn_id_amostra = " . $slug . " order by date asc";
        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $activeDate->execute();
        $result = $activeDate->fetchAll();
        $data_primeiro_registo = $result[0]['date'];
        $posicao = strpos($data_primeiro_registo, '-');
        $ano = '';
        if ($posicao !== false) {
            $ano = substr ( $data_primeiro_registo , 0 , $posicao);
        }
        $header_superior_direito = 'AMOSTRA ' . $ano . "-" . $slug;
        $em2 = $this->getDoctrine()->getManager();
        $result = $em2->createQueryBuilder();
        $dql = $result->select('pa')
            ->from('AppBundle:TParametrosamostraLog', 'pa')
            ->andWhere('pa.fnIdAmostra = :idamostra')
            ->setParameter('idamostra', $slug)
            ->orderBy('pa.id', 'ASC')
            ->getQuery()
            ->getResult();
        $array = array();

        foreach ($dql as $amostra_log){
            $parametro = $repo_3->find($amostra_log->getFnId());
            $amostra = $repo_0->find($amostra_log->getFnIdAmostra());
            $produto = $repo_4->find($amostra->getFnProduto());
            $grupoparametro=$repo_5->find($amostra->getFtGrupoparametros());
            $modelo = $repo_6->find($amostra->getFnModelo());
            $pamostra = $repo_1->findOneBy(array('fnId' => $parametro->getFnId(),
                'fnIdAmostra' => $amostra->getFnId()));
            if($pamostra)
                $tresultado = $repo_2->findOneBy(array('fnParametro' => $pamostra->getId()));
            else
                $tresultado = null;
            $sql = "SELECT * FROM t_parametrosamostra_log WHERE id = " . $amostra_log->getId() ;
            $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $activeDate->execute();
            $data = $activeDate->fetchAll();
            $conta = count($data);
            if($conta != 0){
                $data_registo = $data[0]['date'];
                $tecnico = $data[0]['user'];
                $data_ultima_alteracao = new \DateTime($data_registo);
                $data_ultima_alteracao = $data_ultima_alteracao->format('d/m/Y H:i');
                $data_ultima_alteracao .= 'h';
            }
            else{
                $data_ultima_alteracao = null;
                $tecnico = null;
            }

            array_push ( $array , array($parametro,$produto,$grupoparametro,$modelo,$tresultado,$data_ultima_alteracao,$tecnico));
        }
        $pdf = $this->container->get("white_october.tcpdf")->create(
            $orientation='L',
            $unit='mm',
            $format='A4',
            $unicode=true,
            $encoding='UTF-8',
            $diskcache=false, $pdfa=false
        );
        $html = $this->renderView('AppBundle:PDF:relatorio_alteracoes.html.twig', array(
            'h_i_d' => $header_inferior_direito,
            'h_s_d' => $header_superior_direito,
            'amostras_log' => $array,
        ));
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->lastPage();
        $target_dir = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . "relatorios" . DIRECTORY_SEPARATOR . "relatorio_alteracoes_amostra_".$slug.".pdf";
        $response = new Response($pdf->Output($target_dir,'FI'));

        return $response;
    }

    //generate worklist by parameter
    public function GenerateworklistbyParameterAction()
    {
        //get os id de parametros
        $response = $this->get("request")->getContent();
        $arr2 = explode("&", $response);
        $amostra = explode("=", $arr2[0]);
        $amostra = explode("%2C", $amostra[1]);
        $para =explode("=", $arr2[1]);
        $para =$para[1];

        //get all html from modelos lista

        $repo = $this->getDoctrine()->getRepository('AppBundle:ModelosListas');
        $users = $repo->createQueryBuilder('q')
            ->Where('q.idParametro = ' . $para)
            ->getQuery()
            ->getArrayResult();
        $repo_para = $this->getDoctrine()->getRepository('AppBundle:TParametros');
        if(!$users)
        {
            $parametro = $repo_para->find($para);
            return new Response("Defina o modelo de lista para o parâmetro " . $parametro->getFtDescricao());
        }
        try {
            //generate pdf with html
            $pdf = $this->container->get("white_october.tcpdf")->create(
                'P',
                'mm',
                'A4',
                false,
                'ISO-8859-1',
                false
            );
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Pimenta do Vale');
            $pdf->SetTitle('Lista de Trabalho');
            // set default header data
            $pdf->SetMargins(7, 35, 7);
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setAutoPageBreak(true, 30);
            $body="";
            $header_aux = 0 ;
            if(count($amostra)!=0) {
                foreach ($amostra as &$value) {
                    if ($value != "") {
                        $sql = "SELECT t_parametrosamostra.fn_id_amostra as amostra, 
                           t_parametrosamostra.ft_descricao as parametro , t_gruposparametros.ft_codigo as grupo  , 
                           t_metodos.ft_descricao as metodo , t_unidadesmedida.ft_descricao as unidade 
                           FROM t_parametrosamostra 
                           inner join t_amostras on t_parametrosamostra.fn_id_amostra = t_amostras.fn_id 
                           inner join t_gruposparametros on t_amostras.ft_grupoparametros = t_gruposparametros.fn_id 
                           inner join t_metodos on t_parametrosamostra.fn_id_metodo = t_metodos.fn_id 
                           inner join t_resultados on t_parametrosamostra.id = t_resultados.fn_id_parametro 
                           inner join t_unidadesmedida on t_resultados.fn_id_unidade = t_unidadesmedida.fn_id 
                           where t_parametrosamostra.fn_id_amostra = " . $value .
                            " and t_parametrosamostra.fn_id = " . $para . ";";
                        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                        $activeDate->execute();
                        $result = $activeDate->fetchAll();
                        if (count($result) == 0) {
                            return new Response("Defina o resultado(via entrada de resultados ou na amostra, verificando que os resultados são guardados com sucesso) para o parâmetro com o id " . $para .
                                " e para a amostra com o id " . $value);
                        }
                    }
                }
            }
            if(count($amostra)!=0) {
                $lt = new ListaTrabalhos();
                $lt->setDataemissao(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($lt);
                $em->flush();
                $ultimo_id = $lt->getId();
            }
            else{
                $ultimo_id = 0;
            }
            foreach ($amostra as &$value) {
                if ($value != "") {
                    $sql = "SELECT t_parametrosamostra.fn_id_amostra as amostra, 
                           t_parametrosamostra.ft_descricao as parametro , t_gruposparametros.ft_codigo as grupo  , 
                           t_metodos.ft_descricao as metodo , t_unidadesmedida.ft_descricao as unidade 
                           FROM t_parametrosamostra 
                           inner join t_amostras on t_parametrosamostra.fn_id_amostra = t_amostras.fn_id 
                           inner join t_gruposparametros on t_amostras.ft_grupoparametros = t_gruposparametros.fn_id 
                           inner join t_metodos on t_parametrosamostra.fn_id_metodo = t_metodos.fn_id 
                           inner join t_resultados on t_parametrosamostra.id = t_resultados.fn_id_parametro 
                           inner join t_unidadesmedida on t_resultados.fn_id_unidade = t_unidadesmedida.fn_id 
                           where t_parametrosamostra.fn_id_amostra = " . $value .
                        " and t_parametrosamostra.fn_id = " . $para . ";";
                    $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                    $activeDate->execute();
                    $result = $activeDate->fetchAll();
                    if($ultimo_id != 0) {
                        $sql = "UPDATE t_parametrosamostra SET listatrabalho_id = " . $ultimo_id .
                            " where t_parametrosamostra.fn_id_amostra = " . $value .
                            " and t_parametrosamostra.fn_id = " . $para;
                        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                        $activeDate->execute();
                        $sql = "UPDATE t_amostras SET ft_id_estado = 6 where t_amostras.fn_id = " . $value;
                        $activeDate = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                        $activeDate->execute();
                    }
                    if ($header_aux == 0) {
                        $header_aux = 1;
                        $codigo = utf8_decode("Código");
                        $x = '<table border="0" style="font-size:8px;" align="center"><tr><th>Lista de Trabalho</th></tr><tr><th>' . utf8_decode($result[0]["parametro"]) . ' (' . utf8_decode($result[0]["metodo"]) . ')</th></tr><tr><th>' . utf8_decode($result[0]["unidade"]) . '</th></tr><tr><th>'.$codigo.": ".$ultimo_id.'</th></tr><tr><th>' . utf8_decode("Emissão:") . date("d-m-Y") . '</th></tr></table>';
                        $pdf->SetHeaderData('logopimenta.png', 50, $x, PDF_HEADER_STRING);
                        $pdf->setFooterData(array(0, 0, 0), array(0, 0, 0));
                        // set header and footer fonts
                        //$pdf->SetLineStyle(array('width' => 0.25 / 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255)));
                        $pdf->AddPage();
                        $pdf->SetFont('helvetica', '', 10, '', 'default', true);
                    }
                    $pdf->SetFont('helvetica', '', 10, '', 'default', true);
                    $body = $body . '<tr style="line-height: 4px;"><th></th></tr><tr><th style="width: 40px;"  >' . $result[0]["grupo"] . '</th><th style="width: 50px;">' . $result[0]["amostra"] . '</th><th style="width: 470px;">' . $users[0]["tablejson"] . '</th></tr>';
                }
            }

            $head=$users[0]['cabecalhojson'];
            $html = <<<EOD
            <style>
              th {
                font-size: 8px;
              }
              .bold_one{
                font-weight: bold;
              }
              tr {
                font-size: 8px;
              }
            </style>
            <table border="0" align="center">
            <tr style="line-height: 4px;"><th></th></tr>
            <tr>
            <th class="bold_one" style="width: 40px;" >Tipo</th>
            <th class="bold_one" style="width: 50px;">Amostra</th>
            <th class="bold_one" style="width: 470px;">{$head}</th>
            </tr>
            {$body}
            </table>
EOD;
            $pdf->writeHTML($html, true, false, false, false, 'center');
            // output the HTML content
            //$pdf->writeHTML($html, true, false, true,false, '');
            $pdf->lastPage();
            // set default monospaced font
            // set margins
            // set auto page breaks
            // set image scale factor
            if($ultimo_id != 0) {
                $fileNL = $this->container->getParameter('kernel.root_dir') . DIRECTORY_SEPARATOR . "listas" . DIRECTORY_SEPARATOR . "lista_trabalho_parametro_" . $ultimo_id . ".pdf";
                //"/var/www/lab.iwish.solutions/app/listas";
                $pdf->Output($fileNL, 'F');
            }
            //change all sample to state on progress
            //change all parameter to state on progress
        } catch (Exception $e) {
            return new Response(json_encode($e->getMessage()));
        }
        return new Response(json_encode("" . $ultimo_id.".pdf"));
    }
}