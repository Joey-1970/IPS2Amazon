<?
class IPS2AmazonFireTV extends IPSModule
{
	public function Destroy() 
	{
		//Never delete this line!
		parent::Destroy();
		$this->SetTimerInterval("State", 0);
	}
	
	// Überschreibt die interne IPS_Create($id) Funktion
        public function Create() 
        {
            	// Diese Zeile nicht löschen.
            	parent::Create();
		$this->RegisterPropertyBoolean("Open", false);
	    	$this->RegisterPropertyString("IPAddress", "127.0.0.1");
		$this->RegisterPropertyString("MAC", "00:00:00:00:00:00");
		$this->RegisterPropertyString("User", "User");
	    	$this->RegisterPropertyString("Password", "Passwort");
		$this->RegisterTimer("State", 0, 'IPS2AcerP5530_GetcURLData($_IPS["TARGET"]);');
		
		// Profile anlegen
		$this->RegisterProfileInteger("IPS2AcerP5530.Source", "TV", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Source", 3, "HDMI 1", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Source", 6, "HDMI 2/MHL", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Source", 20, "VGA IN 1", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Source", 21, "VGA IN 2", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Source", 22, "Video", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Source", 33, "LAN/Wifi", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Source", 34, "Media", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Source", 35, "USB Display", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Source", 36, "Mirroring Display", "TV", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.DisplayMode", "TV", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.DisplayMode", 0, "Bright", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.DisplayMode", 1, "Presentation", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.DisplayMode", 2, "Standard", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.DisplayMode", 3, "Video", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.DisplayMode", 20, "User", "TV", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.AspectRatio", "TV", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.AspectRatio", 0, "Auto", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.AspectRatio", 1, "Full", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.AspectRatio", 2, "4:3", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.AspectRatio", 3, "16:9", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.AspectRatio", 20, "L.Box", "TV", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.Projection", "TV", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Projection", 0, "Front Table", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Projection", 1, "Rear Table", "TV", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.StartupScreen", "TV", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.StartupScreen", 0, "Acer", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.StartupScreen", 1, "User", "TV", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.Parameter", "Shutter", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Parameter", 0, "-", "Shutter", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Parameter", 1, "+", "Shutter", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.Volume", "Speaker", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Volume", -1, "-", "Speaker", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Volume", 0, "%d", "Speaker", 0x00FF00);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Volume", 101, "+", "Speaker", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.Brightness", "Intensity", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Brightness", -1, "-", "Intensity", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Brightness", 0, "%d", "Intensity", 0x00FF00);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Brightness", 101, "+", "Intensity", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.Contrast", "Intensity", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Contrast", -1, "-", "Intensity", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Contrast", 0, "%d", "Intensity", 0x00FF00);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.Contrast", 101, "+", "Intensity", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.VKeystone", "TV", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.VKeystone", -21, "-", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.VKeystone", -20, "%d", "TV", 0x00FF00);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.VKeystone", 21, "+", "TV", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.HKeystone", "TV", "", "", 0, 1, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.HKeystone", -21, "-", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.HKeystone", -20, "%d", "TV", 0x00FF00);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.HKeystone", 21, "+", "TV", -1);
		
		$this->RegisterProfileFloat("IPS2AcerP5530.DigitalZoom", "TV", "", "", -0.1, 2.1, 0, 1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.DigitalZoom", -0.1, "-", "TV", -1);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.DigitalZoom", 0, "%.1f", "TV", 0x00FF00);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.DigitalZoom", 2.1, "+", "TV", -1);
		
		$this->RegisterProfileInteger("IPS2AcerP5530.ErrorStatus", "Information", "", "", 0, 6, 0);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.ErrorStatus", 0, "Normal", "Information", 0x00FF00);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.ErrorStatus", 1, "Fan Lock", "Alert", 0xFF0000);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.ErrorStatus", 2, "Over Temperature", "Alert", 0xFF0000);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.ErrorStatus", 3, "Thermal Switch Error", "Alert", 0xFF0000);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.ErrorStatus", 4, "Lamp Strike Error", "Alert", 0xFF0000);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.ErrorStatus", 5, "Lamp Auto Off Error", "Alert", 0xFF0000);
		IPS_SetVariableProfileAssociation("IPS2AcerP5530.ErrorStatus", 6, "Color Wheel Error", "Alert", 0xFF0000);	
	
		// Statusvariablen anlegen
		$this->RegisterVariableInteger("LastKeepAlive", "Letztes Keep Alive", "~UnixTimestamp", 10);
		$this->DisableAction("LastKeepAlive");
		
		$this->RegisterVariableBoolean("Power", "Power", "~Switch", 50);
		$this->EnableAction("Power");
		
		$this->RegisterVariableBoolean("Hide", "Hide", "~Switch", 60);
		
		$this->RegisterVariableBoolean("Freeze", "Freeze", "~Switch", 70);
		
		$this->RegisterVariableBoolean("ECO", "ECO", "~Switch", 80);
		
		$this->RegisterVariableInteger("Source", "Source", "IPS2AcerP5530.Source", 90);
		$this->RegisterVariableString("Status", "Status", "~TextBox", 95);
		
		$this->RegisterVariableInteger("Volume", "Volume", "IPS2AcerP5530.Volume", 100);
				
		$this->RegisterVariableInteger("Brightness", "Brightness", "IPS2AcerP5530.Brightness", 110);
		
		$this->RegisterVariableInteger("Contrast", "Contrast", "IPS2AcerP5530.Contrast", 120);
		
		$this->RegisterVariableInteger("VKeystone", "V.-Keystone", "IPS2AcerP5530.VKeystone", 130);
		
		$this->RegisterVariableInteger("HKeystone", "H.-Keystone", "IPS2AcerP5530.HKeystone", 140);
		
		$this->RegisterVariableInteger("Gamma", "Gamma", "IPS2AcerP5530.Parameter", 150);
		
		$this->RegisterVariableInteger("ColorTemp", "Color Temp", "IPS2AcerP5530.Parameter", 160);
		
		$this->RegisterVariableInteger("DisplayMode", "Display Mode", "IPS2AcerP5530.DisplayMode", 170);
		
		$this->RegisterVariableBoolean("AutoKeystone", "Auto Keystone", "~Switch", 180);
		
		$this->RegisterVariableInteger("AspectRatio", "Aspect Ratio", "IPS2AcerP5530.AspectRatio", 190);
		
		$this->RegisterVariableFloat("DigitalZoom", "Digital Zoom", "IPS2AcerP5530.DigitalZoom", 200);
		
		$this->RegisterVariableInteger("Projection", "Projection", "IPS2AcerP5530.Projection", 210);
		
		$this->RegisterVariableInteger("StartupScreen", "Startup Screen", "IPS2AcerP5530.StartupScreen", 220);
		
		$this->RegisterVariableInteger("LampHours", "Lamp Hours", "", 230);
		
		$this->RegisterVariableInteger("ErrorStatus", "Error Status", "IPS2AcerP5530.ErrorStatus", 240);
		
	}
	
	public function GetConfigurationForm() { 
		$arrayStatus = array(); 
		$arrayStatus[] = array("code" => 101, "icon" => "inactive", "caption" => "Instanz wird erstellt"); 
		$arrayStatus[] = array("code" => 102, "icon" => "active", "caption" => "Instanz ist aktiv");
		$arrayStatus[] = array("code" => 104, "icon" => "inactive", "caption" => "Instanz ist inaktiv");
		$arrayStatus[] = array("code" => 200, "icon" => "error", "caption" => "Instanz ist fehlerhaft"); 
		$arrayStatus[] = array("code" => 202, "icon" => "error", "caption" => "Kommunikationfehler!");
		
		$arrayElements = array(); 
		$arrayElements[] = array("name" => "Open", "type" => "CheckBox",  "caption" => "Aktiv"); 
		$arrayElements[] = array("type" => "ValidationTextBox", "name" => "IPAddress", "caption" => "IP");
		$arrayElements[] = array("type" => "ValidationTextBox", "name" => "MAC", "caption" => "MAC");
		$arrayElements[] = array("type" => "Label", "label" => "Zugriffsdaten der Projektor-Website");
		$arrayElements[] = array("type" => "ValidationTextBox", "name" => "User", "caption" => "User");
		$arrayElements[] = array("type" => "PasswordTextBox", "name" => "Password", "caption" => "Password");
 		$arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");
		
		
		
		return JSON_encode(array("status" => $arrayStatus, "elements" => $arrayElements)); 		 
 	} 
	
	public function ApplyChanges()
	{
		//Never delete this line!
		parent::ApplyChanges();
		
		SetValueInteger($this->GetIDForIdent("Source"), 3);
		
		If (IPS_GetKernelRunlevel() == 10103) {
			If ($this->ReadPropertyBoolean("Open") == true) {
				
				$this->SetStatus(102);
				If ($this->ConnectionTest() == true) {
					// Erste Abfrage der Daten
					$this->GetData();
				}
				$this->SetTimerInterval("State", 5 * 1000);
				
			}
			else {
				$this->SetStatus(104);
				$this->SetTimerInterval("State", 0);
			}	   
		}
	}
	
	public function RequestAction($Ident, $Value) 
	{
  		If (($Ident == "Power") AND ($Value == true)) {
			$this->WakeOnLAN();
		}
		elseIf (($this->ReadPropertyBoolean("Open") == true) AND ($this->ConnectionTest() == true)) {
			switch($Ident) {
				case "Power":
					If ($Value == true) {
						$this->WakeOnLAN();
					}
					else {
						$this->SetcURLData("pwr=pwr");
					}
					break;
				case "ECO":
						$this->SetcURLData("eco=eco");
					break;
				case "Hide":
						$this->SetcURLData("hid=hid");
					break;
				case "Freeze":
						$this->SetcURLData("frz=frz");
					break;
				case "Source":
						$this->SetcURLData("src=".$Value);
					break;
				case "Volume":
						SetValueInteger($this->GetIDForIdent($Ident), $Value);
						If ($Value == -1) {
							$this->SetcURLData("vol1=vol1");
						}
						elseIf ($Value == 101) {
							$this->SetcURLData("vol2=vol2");
						}
					break;
				case "Brightness":
						SetValueInteger($this->GetIDForIdent($Ident), $Value);
						If ($Value == -1) {
							$this->SetcURLData("bri1=bri1");
						}
						elseIf ($Value == 101) {
							$this->SetcURLData("bri2=bri2");
						}
					break;
				case "Contrast":
						SetValueInteger($this->GetIDForIdent($Ident), $Value);
						If ($Value == -1) {
							$this->SetcURLData("con1=con1");
						}
						elseIf ($Value == 101) {
							$this->SetcURLData("con2=con2");
						}
					break;
				case "VKeystone":
						SetValueInteger($this->GetIDForIdent($Ident), $Value);
						If ($Value == -21) {
							$this->SetcURLData("vks1=vks1");
						}
						elseIf ($Value == 21) {
							$this->SetcURLData("vks2=vks2");
						}
					break;
				case "HKeystone":
						SetValueInteger($this->GetIDForIdent($Ident), $Value);
						If ($Value == -21) {
							$this->SetcURLData("hks1=hks1");
						}
						elseIf ($Value == 21) {
							$this->SetcURLData("hks2=hks2");
						}
					break;
				case "Gamma":
						SetValueInteger($this->GetIDForIdent($Ident), $Value);
						If ($Value == 0) {
							$this->SetcURLData("gam1=gam1");
						}
						else {
							$this->SetcURLData("gam2=gam2");
						}
					break;
				case "ColorTemp":
						SetValueInteger($this->GetIDForIdent($Ident), $Value);
						If ($Value == 0) {
							$this->SetcURLData("ctp1=ctp1");
						}
						else {
							$this->SetcURLData("ctp2=ctp2");
						}
					break;
				case "DigitalZoom":
						SetValueFloat($this->GetIDForIdent($Ident), $Value);
						If ($Value == -0.1) {
							$this->SetcURLData("zom1=zom1");
						}
						elseIf ($Value == 2.1) {
							$this->SetcURLData("zom2=zom2");
						}
					break;
				case "DisplayMode":
						$this->SetcURLData("mod=".$Value);
					break;
				case "AutoKeystone":
						$this->SetcURLData("aks=".$Value);
					break;
				case "AspectRatio":
						$this->SetcURLData("apr=".$Value);
					break;
				case "Projection":
						$this->SetcURLData("prj=".$Value);
					break;
				case "StartupScreen":
						$this->SetcURLData("lgo=".$Value);
					break;
				
			default:
				    throw new Exception("Invalid Ident");
			}
	    	}
		
	}
	
	private function WakeOnLAN()
	{
    		$mac = $this->ReadPropertyString("MAC");
		$broadcast = "255.255.255.255";
		$mac_array = preg_split('#:#', $mac);
    		$hwaddr = '';
    		foreach($mac_array AS $octet)
    		{
        		$hwaddr .= chr(hexdec($octet));
    		}
    		// Create Magic Packet
    		$packet = '';
    		for ($i = 1; $i <= 6; $i++)
    		{
        		$packet .= chr(255);
    		}
    		for ($i = 1; $i <= 16; $i++)
    		{
        		$packet .= $hwaddr;
    		}
    		$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    		if ($sock)
    		{
        		$options = socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, true);
        		if ($options >=0) 
        		{    
            			$e = socket_sendto($sock, $packet, strlen($packet), 0, $broadcast, 7);
            			socket_close($sock);
        		}    
    		}
	}
	
	private function SetcURLData(String $Message)
	{
		If ($this->ReadPropertyBoolean("Open") == true) {
			$this->SendDebug("SetcURLData", "Message: ".$Message, 0);
			
			$User = $this->ReadPropertyString("User");;
			$Password = $this->ReadPropertyString("Password");
			$IPAddress = $this->ReadPropertyString("IPAddress");
			$URL = "http://".$IPAddress."/form/control_cgi";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
				"Accept: */*",
				"Accept-Language: en-us,en;q=0.5",
				"Accept-Encoding: gzip, deflate",
				"Connection: keep-alive",
					"Content-type: application/x-www-form-urlencoded",
			));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $URL);
			curl_setopt($ch, CURLOPT_USERPWD, "$User:$Password");
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($ch, CURLOPT_TIMEOUT, 2);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $Message);
			$Response = curl_exec($ch);
			/*
			if(!curl_exec($ch)){
			    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
			}
			*/
			curl_close($ch);
			If ($Response <> Null) {
				$this->SetVariables($Response);
			}
			else {
				SetValueBoolean($this->GetIDForIdent("Power"), false);
				
				// restliche Statusvariablen disablen!
			}
			
		}
	}
	
	private function GetData()
	{
		If ($this->ReadPropertyBoolean("Open") == true) {
			$this->SendDebug("GetData", "Ausfuehrung", 0);
			$this->GetcURLData();
		}
	}
	
	public function GetcURLData()
	{
		If ($this->ReadPropertyBoolean("Open") == true) {
			$this->SendDebug("GetcURLData", "Ausfuehrung", 0);
			
			$User = $this->ReadPropertyString("User");;
			$Password = $this->ReadPropertyString("Password");
			$IPAddress = $this->ReadPropertyString("IPAddress");
			$URL_control = "http://".$IPAddress."/form/control_cgi";
			$URL_home = "http://".$IPAddress."/form/home_cgi";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $URL_control);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, "$User:$Password");
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($ch, CURLOPT_TIMEOUT, 2);
			$Response_control = curl_exec($ch);
			curl_setopt($ch, CURLOPT_URL, $URL_home);
			$Response_home = curl_exec($ch);
			curl_close($ch);
			
			If ($Response_control <> Null) {
				$this->SetVariables($Response_control);
			}
			else {
				If (GetValueBoolean($this->GetIDForIdent("Power")) <> false) {
					SetValueBoolean($this->GetIDForIdent("Power"), false);
					$this->SetVariablesEnable(false);
				}
			}
			
			If ($Response_home <> Null) {
				// Anführungszeichen der Keys ergänzen
				$Response_home = preg_replace('/("(.*?)"|(\w+))(\s*:\s*)\+?(0+(?=\d))?(".*?"|.)/s', '"$2$3"$4$6', $Response_home);
				// HTML-Tags entfernen
				$Response_home = strip_tags($Response_home);
				$Data = json_decode($Response_home);
				If (GetValueInteger($this->GetIDForIdent("LampHours")) <> intval($Data->lamphur)) {
					SetValueInteger($this->GetIDForIdent("LampHours"), intval($Data->lamphur));
				}
				If (GetValueInteger($this->GetIDForIdent("ErrorStatus")) <> intval($Data->errorstatus)) {
					SetValueInteger($this->GetIDForIdent("ErrorStatus"), intval($Data->errorstatus));
				}
			}
		}
	}
	
	private function SetVariables($Message)
	{
		// Anführungszeichen der Keys ergänzen
		$Response = preg_replace('/("(.*?)"|(\w+))(\s*:\s*)\+?(0+(?=\d))?(".*?"|.)/s', '"$2$3"$4$6', $Message);
		// HTML-Tags entfernen
		$Response = strip_tags($Response);
		$Data = json_decode($Response);
		If ($Response <> Null) {
			SetValueInteger($this->GetIDForIdent("LastKeepAlive"), time() );
		
			If (GetValueBoolean($this->GetIDForIdent("Power")) <> boolval($Data->pwr)) {
				SetValueBoolean($this->GetIDForIdent("Power"), boolval($Data->pwr));
				If (boolval($Data->pwr) == true) {
					$this->SetVariablesEnable(true);
				}
			}
			If (GetValueBoolean($this->GetIDForIdent("Freeze")) <> boolval($Data->frz)) {
				SetValueBoolean($this->GetIDForIdent("Freeze"), boolval($Data->frz));
			}
			If (GetValueBoolean($this->GetIDForIdent("Hide")) <> boolval($Data->hid)) {
				SetValueBoolean($this->GetIDForIdent("Hide"), boolval($Data->hid));
			}
			If (GetValueBoolean($this->GetIDForIdent("ECO")) <> boolval($Data->eco)) {
				SetValueBoolean($this->GetIDForIdent("ECO"), boolval($Data->eco));
			}
			If (GetValueInteger($this->GetIDForIdent("Source")) <> intval($Data->src)) {
				SetValueInteger($this->GetIDForIdent("Source"), intval($Data->src));
			}
			If (GetValueInteger($this->GetIDForIdent("Volume")) <> intval($Data->vol)) {
				SetValueInteger($this->GetIDForIdent("Volume"), intval($Data->vol));
			}
			If (GetValueInteger($this->GetIDForIdent("Brightness")) <> intval($Data->bri)) {
				SetValueInteger($this->GetIDForIdent("Brightness"), intval($Data->bri));
			}
			If (GetValueInteger($this->GetIDForIdent("Contrast")) <> intval($Data->con)) {
				SetValueInteger($this->GetIDForIdent("Contrast"), intval($Data->con));
			}
			If (GetValueInteger($this->GetIDForIdent("VKeystone")) <> intval($Data->vks)) {
				SetValueInteger($this->GetIDForIdent("VKeystone"), intval($Data->vks));
			}
			If (GetValueInteger($this->GetIDForIdent("HKeystone")) <> intval($Data->hks)) {
				SetValueInteger($this->GetIDForIdent("HKeystone"), intval($Data->hks));
			}
			
			$StatusText = "Gamma: ".floatval($Data->gam).chr(13)."Color Temp: ".$Data->ctp;
			SetValueString($this->GetIDForIdent("Status"), $StatusText);
			
			If (GetValueFloat($this->GetIDForIdent("DigitalZoom")) <> floatval($Data->zom)) {
				SetValueFloat($this->GetIDForIdent("DigitalZoom"), floatval($Data->zom));
			}
			If (GetValueInteger($this->GetIDForIdent("DisplayMode")) <> intval($Data->mod)) {
				SetValueInteger($this->GetIDForIdent("DisplayMode"), intval($Data->mod));
			}
			If (GetValueInteger($this->GetIDForIdent("AspectRatio")) <> intval($Data->apr)) {
				SetValueInteger($this->GetIDForIdent("AspectRatio"), intval($Data->apr));
			}
			If (GetValueInteger($this->GetIDForIdent("Projection")) <> intval($Data->prj)) {
				SetValueInteger($this->GetIDForIdent("Projection"), intval($Data->prj));
			}
			If (GetValueInteger($this->GetIDForIdent("StartupScreen")) <> intval($Data->lgo)) {
				SetValueInteger($this->GetIDForIdent("StartupScreen"), intval($Data->lgo));
			}
			If (GetValueBoolean($this->GetIDForIdent("AutoKeystone")) <> boolval($Data->aks)) {
				SetValueBoolean($this->GetIDForIdent("AutoKeystone"), boolval($Data->aks));
			}
		}
		else {
			SetValueBoolean($this->GetIDForIdent("Power"), false);
			$this->SetVariablesEnable(false);
		}
	}
	
	private function SetVariablesEnable($Enable)
	{
		If ($this->ReadPropertyBoolean("Open") == true) {
			$this->SendDebug("SetVariablesEnable", "Ausfuehrung", 0);
			$VariablesArray = array("Hide", "Freeze", "ECO", "Source", "Volume", "Brightness", "Contrast", "Gamma", "VKeystone", "HKeystone", "ColorTemp",
					       "DisplayMode", "AutoKeystone", "AspectRatio", "DigitalZoom", "Projection", "StartupScreen");
			foreach ($VariablesArray as $Variables) {
				If ($Enable == true) {
					$this->EnableAction($Variables);
				}
				else {
					$this->DisableAction($Variables);
				}
			}
		}
	}
	
	private function ConnectionTest()
	{
	      $result = false;
	      If (Sys_Ping($this->ReadPropertyString("IPAddress"), 2000)) {
			//IPS_LogMessage("IPS2AcerP5530","Angegebene IP ".$this->ReadPropertyString("IPAddress")." reagiert");
			$this->SetStatus(102);
		      	$result = true;
		}
		else {
			IPS_LogMessage("IPS2AcerP5530","IP ".$this->ReadPropertyString("IPAddress")." reagiert nicht!");
			$this->SendDebug("ConnectionTest", "IP ".$this->ReadPropertyString("IPAddress")." reagiert nicht!", 0);
			//$this->SetStatus(104);
		}
	return $result;
	}
	
	private function RegisterProfileInteger($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize)
	{
	        if (!IPS_VariableProfileExists($Name))
	        {
	            IPS_CreateVariableProfile($Name, 1);
	        }
	        else
	        {
	            $profile = IPS_GetVariableProfile($Name);
	            if ($profile['ProfileType'] != 1)
	                throw new Exception("Variable profile type does not match for profile " . $Name);
	        }
	        IPS_SetVariableProfileIcon($Name, $Icon);
	        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
	        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);    
	}    
	
	private function RegisterProfileFloat($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize, $Digits)
	{
	        if (!IPS_VariableProfileExists($Name))
	        {
	            IPS_CreateVariableProfile($Name, 2);
	        }
	        else
	        {
	            $profile = IPS_GetVariableProfile($Name);
	            if ($profile['ProfileType'] != 2)
	                throw new Exception("Variable profile type does not match for profile " . $Name);
	        }
	        IPS_SetVariableProfileIcon($Name, $Icon);
	        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
	        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
	        IPS_SetVariableProfileDigits($Name, $Digits);
	}
}
?>
