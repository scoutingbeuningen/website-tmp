<?php
declare(strict_types=1);
session_start();
function response_page(string $title,string $message,bool $success=false): never {
  $t=htmlspecialchars($title,ENT_QUOTES,'UTF-8'); $m=htmlspecialchars($message,ENT_QUOTES,'UTF-8');
  $c=$success?'#008f49':'#b3261e';
  echo '<!doctype html><html lang="nl"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.$t.'</title><body style="font-family:Arial,sans-serif;background:#f4f7f4;margin:0;min-height:100vh;display:grid;place-items:center"><main style="background:#fff;padding:36px;max-width:520px;margin:20px"><h1 style="color:'.$c.'">'.$t.'</h1><p>'.$m.'</p><a href="index.html" style="color:#008f49;font-weight:bold">Terug naar de website</a></main></body></html>'; exit;
}
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: index.html#contact',true,303);exit;}
if(!empty($_POST['website']??'')){response_page('Bedankt','Je bericht is ontvangen.',true);}
$now=time(); if(isset($_SESSION['last_submit']) && $now-(int)$_SESSION['last_submit']<20){response_page('Even wachten','Probeer het over een moment opnieuw.');}
$name=trim((string)($_POST['naam']??'')); $email=trim((string)($_POST['email']??'')); $phone=trim((string)($_POST['telefoon']??'')); $topic=trim((string)($_POST['onderwerp']??'')); $message=trim((string)($_POST['bericht']??''));
if($name===''||mb_strlen($name)>100||!filter_var($email,FILTER_VALIDATE_EMAIL)||mb_strlen($email)>160||mb_strlen($phone)>40||$message===''||mb_strlen($message)>5000){response_page('Controleer je gegevens','Niet alle gegevens zijn geldig ingevuld.');}
$routes=['aanmelden'=>['aanmelden@scoutingbeuningen.nl','Aanmelden'],'verhuur'=>['verhuur@scoutingbeuningen.nl','Verhuur'],'overig'=>['info@scoutingbeuningen.nl','Overige vragen']];
if(!isset($routes[$topic])){response_page('Kies een onderwerp','Selecteer een onderwerp in het formulier.');}
[$to,$label]=$routes[$topic];
$name=str_replace(["\r","\n"],' ',$name); $email=str_replace(["\r","\n"],'',$email);
$subject='Website Scouting Beuningen ’76 - '.$label;
$body="Nieuw bericht via de tijdelijke website van Scouting Beuningen '76\n\nOnderwerp: $label\nNaam: $name\nE-mail: $email\nTelefoon: $phone\n\nBericht:\n$message\n";
$headers=['MIME-Version: 1.0','Content-Type: text/plain; charset=UTF-8','From: Website Scouting Beuningen <noreply@scoutingbeuningen.nl>','Reply-To: '.$email];
$sent=mail($to,'=?UTF-8?B?'.base64_encode($subject).'?=',$body,implode("\r\n",$headers));
if(!$sent){response_page('Bericht niet verzonden','Verzenden is niet gelukt. Probeer het later opnieuw of mail info@scoutingbeuningen.nl.');}
$_SESSION['last_submit']=$now; response_page('Bedankt voor je bericht!','Je bericht is aangeboden aan het juiste team. We nemen zo snel mogelijk contact op.',true);
?>