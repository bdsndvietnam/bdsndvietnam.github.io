<?
/*	@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	Date: 20 Dec 2005
	Author: Nicola Antonio Filannino
	Nation: Italy
	City: Barletta (Ba)

	Description:
		This class let you send e-mail messages from your PHP pages. 

	Features:
		1. Switching between HTML and PLAIN format of the messages.
		2. Usage of e-mail template to send HTML formatted e-mail.
		3. Scalable number of e-mail template vars.
		4. Multi-user sending using a semi-colon to at the end of a recipient.
	
	Important: 
		You can create a brand new Template, starting from a simple static HTML page.
		There put the variables parts in this format #VARIABLE_NAME#, after this fill the $mail->template_vars with an array
		as in the example whose keys are the name of the vars in the template.
	@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
*/


//FORMATI EMAIL
	define ("EMAIL_FORMAT_HTML",1);
	define ("EMAIL_FORMAT_PLAIN",2);

//ERRORI
	define ("EMAIL_MISSING_RECIPIENT",-1);
	define ("EMAIL_FILE_NOT_EXISTS",-2);


//############ CONFIGURAZIONE #####################################
	define ("EMAIL_DEF_FROM_NAME","Class Email test Team!");
	define ("EMAIL_DEF_FROM_EMAIL","info@filanninonicola.it");
//##################################################################

class Email {
//##########_Public_#######################################
	//Oggetto
	var $subject;	
	
	//Corpo messaggio
	var $body;		
	
	//Destinatarii
	var $to;	
	
	//Da (nome)
	var $from;		
	
	//(HTML | PLAIN)
	var $format;	
	
	//Percorso template
	var $template;	
	
	//Variabili da sostituire
	var $template_vars;

//##########_Private_########################################
	//Intestazioni
	var $headers;

	//Stato classe
	var $state;
		
	function Email ($from="",$to="",$subject="",$body="",$format=EMAIL_FORMAT_HTML)  {
		
		if (!$from) $from = EMAIL_DEF_FROM_EMAIL;
		
		if (!$to) {$this->state = EMAIL_MISSING_RECIPIENT;return false;}

		if ($format==EMAIL_FORMAT_HTML) 
			$this->headers = "Content-type:text/html; charset=ISO-8859-9\r\n";
			
		$this->headers .= "From: ".EMAIL_DEF_FROM_NAME." <".$from.">;";		
		
		$this->to = $to;
		
		$this->subject = $subject;
		
		
	}	

	function send () {
		//Imposto il corpo della mail
		$this->setBody ();
		
		//Se $to è una stringa, la trasf. in array
		if (!is_array($this->to) && $this->to) $this->to = explode(";",$this->to);
		
		foreach ($this->to as $v) 	
			if (mail ($v,$this->subject,$this->body,$this->headers))
				echo "Mail mandata a $v<br>";			
	}

	function setBody () {
		if (!$this->body && is_array($this->template_vars) && $this->template) {
		
			if (!file_exists($this->template)) { $this->state = EMAIL_FILE_NOT_EXISTS; return;}
			
			$this->body = join ("",file($this->template));

			foreach ($this->template_vars as $k=>$v) 
				$this->body = str_replace ($k,$v,$this->body);
		}
	}
}






?>