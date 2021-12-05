<?
    // Klassendefinition
    class IPS2AmazonFireTVSplitter extends IPSModule 
    {
	// https://github.com/glenndehaan/ikea-tradfri-coap-docs
	    
	// Überschreibt die interne IPS_Create($id) Funktion
        public function Create() 
        {
            	// Diese Zeile nicht löschen.
            	parent::Create();
		          $this->RegisterPropertyBoolean("Open", false);
		
        }
 	
	public function GetConfigurationForm() 
	{ 
		$arrayStatus = array(); 
		$arrayStatus[] = array("code" => 101, "icon" => "inactive", "caption" => "Instanz wird erstellt"); 
		$arrayStatus[] = array("code" => 102, "icon" => "active", "caption" => "Instanz ist aktiv");
		$arrayStatus[] = array("code" => 104, "icon" => "inactive", "caption" => "Instanz ist inaktiv");
		$arrayStatus[] = array("code" => 202, "icon" => "error", "caption" => "Kommunikationfehler!");
		$arrayStatus[] = array("code" => 203, "icon" => "error", "caption" => "Fehlerhafter Key!");
				
		$arrayElements = array(); 
		$arrayElements[] = array("name" => "Open", "type" => "CheckBox",  "caption" => "Aktiv");
		
		$arrayActions = array();
		      	
 		return JSON_encode(array("status" => $arrayStatus, "elements" => $arrayElements, "actions" => $arrayActions)); 		 
 	}       
	   
        // Überschreibt die intere IPS_ApplyChanges($id) Funktion
        public function ApplyChanges() 
        {
            	// Diese Zeile nicht löschen
            	parent::ApplyChanges();
		
		If ($this->ReadPropertyBoolean("Open") == true) {
			$this->SetStatus(102);
		}
		else {
			$this->SetStatus(104);
		}	
	}
	
	public function ForwardData($JSONString) 
	{
	 	// Empfangene Daten von der Device Instanz
	    	$data = json_decode($JSONString);
	    	$Result = false;
	 	switch ($data->Function) {
			case "SendMessage":
				$Response = $this->Send_Message($data->IP, $data->Command);
				
				break;
		
		}
	return $Result;
	}
	    
	// Beginn der Funktionen
 	private function Send_Message(string $IP, string $command)
	{
		$Response = "";
		if (IPS_SemaphoreEnter("Message", 300)) {
			$Response = shell_exec("adb connect ".$IP);  //Connect FireTV
			$this->SendDebug("Connect FireTV", $Response, 0);
			$Response = shell_exec($command);
			$this->SendDebug("Send_Message", "IP: ".$IP." Command: ".$command." Response:".$Response, 0);
			shell_exec("adb disconnect");  //Disconnect FireTV
			IPS_SemaphoreLeave("Message");
		}
		else {
		   	$this->SendDebug("SemaphoreEnter", "Konnte nicht ausgeführt werden!", 0);
		}	
	return $Response;
	}
	
	private function ConnectionTest()
	{
		$Result = false;
	     	If (Sys_Ping($this->ReadPropertyString("GatewayIP"), 150)) {
		      	//$this->SendDebug("ConnectionTest", "Angegebene IP ".$this->ReadPropertyString("GatewayIP")." reagiert", 0);
			$Result = true;
	      	}
		else {
			$this->SendDebug("ConnectionTest", "GatewayIP ".$this->ReadPropertyString("GatewayIP")." reagiert nicht!", 0);
			IPS_LogMessage("IPS2Tradfi","GatewayIP ".$this->ReadPropertyString("GatewayIP")." reagiert nicht!");
			$this->SetStatus(202);
		}
	return $Result;
	}
}
?>
