<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'lib/PHPMailer/class.phpmailer.php';
/**
 * Description of emailAutenticado
 *
 * @author HP
 */
class MailAutenticado {
    
    //smtp da sua hospedagem
    private $smtpHost;
    //um dos emails do dominio para autenticar email
    private $emailDominio;
    //senha do email do dominio para autenticação
    private $passwdEmailDominio;
    //remetede do email
    private $emailRemetente;
    //nome dado a quem envia mensagem
    private $nomeRemetente;
    //email do destinatario
    private $emailDestinatario;
    //nome do destinatario
    private $nomeDestinatario;
    //opção de enviar email html;
    private $enviarHtml;
    //assunto do email
    private $assunto;
    //conteudo do email
    private $corpoDaMensagem;
    //atributo que verifica se mensagem foi enviada com sucesso
    public $statusMensagem;

    
    function __construct($serverSMTP,$emailDomino,$passwordDominio,$emailRementente,
            $nomeRemetente,$emailDestinatario,$nomeDetinatario,$mensagemHTML,$assunto
            ,$conteudoMensagem){
        
                $this->smtpHost= $serverSMTP;
                $this->emailDominio = $emailDomino;
                $this->passwdEmailDominio = $passwordDominio;
                $this->emailRemetente = $emailRementente;
                $this->nomeRemetente = utf8_decode($nomeRemetente);
                $this->emailDestinatario = $emailDestinatario;
                $this->nomeDestinatario = utf8_decode($nomeDetinatario);
                $this->enviarHtml = $mensagemHTML;
                $this->assunto =utf8_decode(@ $assunto);
                $this->corpoDaMensagem = utf8_decode(@$conteudoMensagem);

        
    }
    
    function enviar(){
        $mail = new PHPMailer;

        $mail->IsSMTP();

        $mail->Host = $this->smtpHost; 
        $mail->SMTPAuth = true; //ATIVA O SMTP AUTENTICADO
        $mail->Username = $this->emailDominio;
        $mail->Password = $this->passwdEmailDominio;
        $mail->From = $this->emailRemetente; 
        $mail->FromName = $this->nomeRemetente;
        $mail->AddAddress($this->emailDestinatario,$this->nomeDestinatario); //E-MAIL DO DESINATÁRIO, NOME DO DESINATÁRIO --> AS VARIÁVEIS ALI PODEM FAZER REFERÊNCIA A DADOS VINDO DE $_GET OU $_POST, OU AINDA DO BANCO DE DADOS
        //numero de caracteres quebra de linha  
        $mail->WordWrap = 50; 
        //habilita mensagem via html
        $mail->IsHTML($this->enviarHtml); 
        $mail->Subject = $this->assunto;
        $mail->Body = $this->corpoDaMensagem;
        //envia mensagem
        if(!$mail->Send()){ 
            $this->statusMensagem = false;
        }else{
            $this->statusMensagem = true;
        }
        
    }
    
}

?>

