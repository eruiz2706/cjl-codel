<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Sendmailgun{
    private $args;
    public function __construct($args){
        $this->args=$args;
    }

    public function send(){
        $MAILGUN_URL    ='https://api.mailgun.net/v3/sandbox9203901f489146d8a3675399428c4fb0.mailgun.org';
        $MAILGUN_KEY    ='key-170939e0b64d6e321072b338e43666bf';  
    
        $array_data = array(
            'from'=> $this->args['mailfromnane'] .'<'.$this->args['mailfrom'].'>',
            'to'=>$this->args['to'],
            'subject'=>$this->args['subject'],
            'html'=>$this->args['html'],
            'text'=>$this->args['text'],
            'o:tracking'=>'yes',
            'o:tracking-clicks'=>'yes',
            'o:tracking-opens'=>'yes'
        );
        $session = curl_init($MAILGUN_URL.'/messages');
        curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($session, CURLOPT_USERPWD, 'api:'.$MAILGUN_KEY);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $array_data);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($session);
        curl_close($session);
        $results = json_decode($response, true);
        return $results;
    }


}

?>