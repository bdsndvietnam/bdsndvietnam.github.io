<?php	
	require_once("phpmailer.class.php");				
	$mail = new PHPMailer(true); 
	$mail->IsSMTP(); 
	$mail->PluginDir = ""; // Path to class dir
	$mail->SMTPDebug  = 0;                
	$mail->SMTPAuth   = true;             
	$mail->SMTPSecure = "ssl";            
	$mail->Host       = "smtp.gmail.com";  
	$mail->Port       = "465";  
	$mail->Username   = "sales@raobansim.com";  
	$mail->Password   = "anhyeuem1";
	$mail->AddReplyTo('noreply@blog.kai.vn', 'KAI Blog X-Mail');
	$mail->AddAddress('sale@raobansim.com', 'SO Name');
	$mail->SetFrom('noreply@blog.kai.vn', 'KAI Blog X-Mail');
	$mail->Subject = 'Email subject';
	$mail->AltBody = 'X-mail from KAI Blog'; 
	$mail->MsgHTML('HTMLcontent'); // Nội dung email
	$mail->Send();
?>