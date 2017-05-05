<?php



function sha256($chaine){
    return hash('sha256', $chaine);
}


function clef_u($user){
    $sortie = uniqid(sha256($user)).sha1(time()).md5(mt_rand(1, 999999999));
    $sortie = sha256($sortie);
    return sha256($sortie);
}



function valide_compte($mail_util,$util_name,$idutil,$clef_unique){

    
     $to  = $mail_util;

     
     $subject = 'Confirmez votre inscription sur local.host';

     
     $message = "
     <html>
      <head>
       <title>Confirmez votre inscription sur tchat2017</title>
      </head>
      <body>
       <p>Merci $util_name pour votre inscription sur le tchat2017</p>
       <p>Cliquez sur <a href='tchat.webdev-cf2m.be?confirm&id=$idutil&c=$clef_unique' target='_blank'>ce lien</a> pour activer votre compte</p>
       <p>Si vous ne vous êtes pas inscrit sur notre site, vous pouvez ignorer ce mail</p>
      </body>
     </html>
     ";

     
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    
     $headers .= 'From: tchat2017@cf2m.be' . "\r\n" .
     'Reply-To: tchat2017@cf2m.be' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

    
     return mail($to, $subject, $message, $headers);

}



class sha256{
    protected $chaine;
    public function __construct($string) {
        $this->chaine=hash('sha256', $string);
    }
    public function recupChaine(){
        return $this->chaine;
    }
}

