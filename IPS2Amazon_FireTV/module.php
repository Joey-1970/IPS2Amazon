<?
class IPS2AmazonFireTV extends IPSModule
{
	// Überschreibt die interne IPS_Create($id) Funktion
        public function Create() 
        {
            	// Diese Zeile nicht löschen.
            	parent::Create();
		$this->RegisterPropertyBoolean("Open", false);
	    	$this->RegisterPropertyString("IPAddress", "127.0.0.1");
		
		// Profile anlegen
		$this->RegisterProfileInteger("AmazonFireTV.DirectionPad", "Information", "", "", 0, 4, 0);
		IPS_SetVariableProfileAssociation("AmazonFireTV.DirectionPad", 0, "Left", "Information", -1);
		IPS_SetVariableProfileAssociation("AmazonFireTV.DirectionPad", 1, "Up", "Information", -1);
		IPS_SetVariableProfileAssociation("AmazonFireTV.DirectionPad", 2, "Select", "Information", 0x00FF00);
		IPS_SetVariableProfileAssociation("AmazonFireTV.DirectionPad", 3, "Down", "Information", -1);
		IPS_SetVariableProfileAssociation("AmazonFireTV.DirectionPad", 4, "Right", "Information", -1);
		
		$this->RegisterProfileInteger("AmazonFireTV.Action", "Information", "", "", 0, 4, 0);
		IPS_SetVariableProfileAssociation("AmazonFireTV.Action", 0, "<<", "Information", -1);
		IPS_SetVariableProfileAssociation("AmazonFireTV.Action", 1, ">||", "Information", 0x00FF00);
		IPS_SetVariableProfileAssociation("AmazonFireTV.Action", 2, ">>", "Information", -1);
		
		// Statusvariablen anlegen
		$this->RegisterVariableInteger("DirectionPad", "DirectionPad", "AmazonFireTV.DirectionPad", 10);
		$this->EnableAction("DirectionPad");
		
		$this->RegisterVariableInteger("Action", "Action", "AmazonFireTV.Action", 20);
		$this->EnableAction("Action");
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
		
 		$arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");
		
		
		
		return JSON_encode(array("status" => $arrayStatus, "elements" => $arrayElements)); 		 
 	} 
	
	public function ApplyChanges()
	{
		//Never delete this line!
		parent::ApplyChanges();
		
		SetValueInteger($this->GetIDForIdent("DirectionPad"), 2);
		SetValueInteger($this->GetIDForIdent("Action"), 1);
		
		If (IPS_GetKernelRunlevel() == 10103) {
			If ($this->ReadPropertyBoolean("Open") == true) {
				
				$this->SetStatus(102);
				If ($this->ConnectionTest() == true) {
					$this->StartADB();
				}
			}
			else {
				$this->SetStatus(104);
			}	   
		}
	}
	
	private function StartADB()
	{
		$IPAddress = $this->ReadPropertyString("IPAddress");
		shell_exec("adb start-server");  //Start Server
		IPS_Sleep(1500);
		shell_exec("adb connect ".$IPAddress);  //Connect FireTV
	}
	
	public function RequestAction($Ident, $Value) 
	{
  		If ($this->ReadPropertyBoolean("Open") == true) {
			switch($Ident) {
				case "DirectionPad":
					SetValueInteger($this->GetIDForIdent($Ident), $Value);
					If ($Value == 0) {
						// Left
						$this->Send_Key("21");
					}
					elseIf ($Value == 1) {
						// Up
						$this->Send_Key("19");
					}
					elseIf ($Value == 2) {
						// Select
						$this->Send_Key("66");
					}
					elseIf ($Value == 3) {
						// Down
						$this->Send_Key("20");
					}
					elseIf ($Value == 4) {
						// Right
						$this->Send_Key("22");
					}
					SetValueInteger($this->GetIDForIdent($Ident), 2);
					break;
				case "Action":
					SetValueInteger($this->GetIDForIdent($Ident), $Value);
					If ($Value == 0) {
						// <<
						$this->Send_Key("88");
					}
					elseIf ($Value == 1) {
						// >||
						$this->Send_Key("85");
					}
					elseIf ($Value == 2) {
						// >>
						$this->Send_Key("87");
					}
					SetValueInteger($this->GetIDForIdent($Ident), 1);
					break;	
				
				default:
				    throw new Exception("Invalid Ident");
			}
		}
	}
	
	public function Up()
	{
		$command = "19"; // Up
		$this->Send_Key($command);
	}
	public function Down()
	{
		$command = "20"; // Down
		$this->Send_Key($command);
	}
	public function Left()
	{
		$command = "21"; // Left
		$this->Send_Key($command);
	}
	public function Right()
	{
		$command = "22"; // Right
		$this->Send_Key($command);
	}
	public function Enter()
	{
		$command = "66"; // Enter
		$this->Send_Key($command);
	}
	public function Back()
	{
		$command = "4"; // Back
		$this->Send_Key($command);
	}
	public function Home()
	{
		$command = "3"; // Home
		$this->Send_Key($command);
	}
	public function Menu()
	{
		$alternative_menu = $this->ReadPropertyBoolean("alternative_menu");
		if ($alternative_menu) {
			$command = "1";
		} else {
			$command = "82";
		}
		$this->Send_Key($command);
	}
	public function Play()
	{
		$command = "85"; // Play / Pause
		$this->Send_Key($command);
	}
	public function Previous()
	{
		$command = "88"; // Previous
		$this->Send_Key($command);
	}
	public function Next()
	{
		$command = "87"; // Next
		$this->Send_Key($command);
	}
	public function Soft_Right()
	{
		$command = "2"; // Soft Right
		$this->Send_Key($command);
	}
	public function Call()
	{
		$command = "5"; // Call
		$this->Send_Key($command);
	}
	public function Endcall()
	{
		$command = "6"; // Endcall
		$this->Send_Key($command);
	}
	public function Key_0()
	{
		$command = "7"; // Keycode 0
		$this->Send_Key($command);
	}
	public function Key_1()
	{
		$command = "8"; // Keycode 1
		$this->Send_Key($command);
	}
	public function Key_2()
	{
		$command = "9"; // Keycode 2
		$this->Send_Key($command);
	}
	public function Key_3()
	{
		$command = "10"; // Keycode 3
		$this->Send_Key($command);
	}
	public function Key_4()
	{
		$command = "11"; // Keycode 4
		$this->Send_Key($command);
	}
	public function Key_5()
	{
		$command = "12"; // Keycode 5
		$this->Send_Key($command);
	}
	public function Key_6()
	{
		$command = "13"; // Keycode 6
		$this->Send_Key($command);
	}
	public function Key_7()
	{
		$command = "14"; // Keycode 7
		$this->Send_Key($command);
	}
	public function Key_8()
	{
		$command = "15"; // Keycode 8
		$this->Send_Key($command);
	}
	public function Key_9()
	{
		$command = "16"; // Keycode 9
		$this->Send_Key($command);
	}
	public function Key_Star()
	{
		$command = "17"; // Star
		$this->Send_Key($command);
	}
	public function Key_Pound()
	{
		$command = "18"; // Pound
		$this->Send_Key($command);
	}
	public function Center()
	{
		$command = "23"; // Center
		$this->Send_Key($command);
	}
	public function Volume_Up()
	{
		$command = "24"; // Volume up
		$this->Send_Key($command);
	}
	public function Volume_Down()
	{
		$command = "25"; // Volume down
		$this->Send_Key($command);
	}
	public function Power()
	{
		$command = "26"; // Power
		$this->Send_Key($command);
	}
	public function Camera()
	{
		$command = "27"; // Camera
		$this->Send_Key($command);
	}
	public function Clear()
	{
		$command = "28"; // Clear
		$this->Send_Key($command);
	}
	public function Key_A()
	{
		$command = "29"; // Keycode A
		$this->Send_Key($command);
	}
	public function Key_B()
	{
		$command = "30"; // Keycode B
		$this->Send_Key($command);
	}
	public function Key_C()
	{
		$command = "31"; // Keycode C
		$this->Send_Key($command);
	}
	public function Key_D()
	{
		$command = "32"; // Keycode D
		$this->Send_Key($command);
	}
	public function Key_E()
	{
		$command = "33"; // Keycode E
		$this->Send_Key($command);
	}
	public function Key_F()
	{
		$command = "34"; // Keycode F
		$this->Send_Key($command);
	}
	public function Key_G()
	{
		$command = "35"; // Keycode G
		$this->Send_Key($command);
	}
	public function Key_H()
	{
		$command = "36"; // Keycode H
		$this->Send_Key($command);
	}
	public function Key_I()
	{
		$command = "37"; // Keycode I
		$this->Send_Key($command);
	}
	public function Key_J()
	{
		$command = "38"; // Keycode J
		$this->Send_Key($command);
	}
	public function Key_K()
	{
		$command = "39"; // Keycode K
		$this->Send_Key($command);
	}
	public function Key_L()
	{
		$command = "40"; // Keycode L
		$this->Send_Key($command);
	}
	public function Key_M()
	{
		$command = "41"; // Keycode M
		$this->Send_Key($command);
	}
	public function Key_N()
	{
		$command = "42"; // Keycode N
		$this->Send_Key($command);
	}
	public function Key_O()
	{
		$command = "43"; // Keycode O
		$this->Send_Key($command);
	}
	public function Key_P()
	{
		$command = "44"; // Keycode P
		$this->Send_Key($command);
	}
	public function Key_Q()
	{
		$command = "45"; // Keycode Q
		$this->Send_Key($command);
	}
	public function Key_R()
	{
		$command = "46"; // Keycode R
		$this->Send_Key($command);
	}
	public function Key_S()
	{
		$command = "47"; // Keycode S
		$this->Send_Key($command);
	}
	public function Key_T()
	{
		$command = "48"; // Keycode T
		$this->Send_Key($command);
	}
	public function Key_U()
	{
		$command = "49"; // Keycode U
		$this->Send_Key($command);
	}
	public function Key_V()
	{
		$command = "50"; // Keycode V
		$this->Send_Key($command);
	}
	public function Key_W()
	{
		$command = "51"; // Keycode W
		$this->Send_Key($command);
	}
	public function Key_X()
	{
		$command = "52"; // Keycode X
		$this->Send_Key($command);
	}
	public function Key_Y()
	{
		$command = "53"; // Keycode Y
		$this->Send_Key($command);
	}
	public function Key_Z()
	{
		$command = "54"; // Keycode Z
		$this->Send_Key($command);
	}
	public function Key_Comma()
	{
		$command = "55"; // Keycode Comma
		$this->Send_Key($command);
	}
	public function Key_Period()
	{
		$command = "56"; // Keycode Period
		$this->Send_Key($command);
	}
	public function Key_Alt_Left()
	{
		$command = "57"; // Keycode Alt Left
		$this->Send_Key($command);
	}
	public function Key_Alt_Right()
	{
		$command = "58"; // Keycode Alt Right
		$this->Send_Key($command);
	}
	public function Key_Shift_Left()
	{
		$command = "59"; // Keycode Shift Left
		$this->Send_Key($command);
	}
	public function Key_Shift_Right()
	{
		$command = "60"; // Keycode Shift Right
		$this->Send_Key($command);
	}
	public function Key_Tab()
	{
		$command = "61"; // Keycode Tab
		$this->Send_Key($command);
	}
	public function Key_Space()
	{
		$command = "62"; // Keycode Space
		$this->Send_Key($command);
	}
	public function Key_Sym()
	{
		$command = "63"; // Keycode Sym
		$this->Send_Key($command);
	}
	public function Key_Explorer()
	{
		$command = "64"; // Keycode Explorer
		$this->Send_Key($command);
	}
	public function Key_Envelope()
	{
		$command = "65"; // Keycode Envelope
		$this->Send_Key($command);
	}
	public function Key_Enter()
	{
		$command = "66"; // Keycode Enter
		$this->Send_Key($command);
	}
	public function Key_Del()
	{
		$command = "67"; // Keycode Del
		$this->Send_Key($command);
	}
	public function Key_Grave()
	{
		$command = "68"; // Keycode Grave
		$this->Send_Key($command);
	}
	public function Key_Minus()
	{
		$command = "69"; // Keycode Minus
		$this->Send_Key($command);
	}
	public function Key_Equals()
	{
		$command = "70"; // Keycode Equals
		$this->Send_Key($command);
	}
	public function Key_Left_Bracket()
	{
		$command = "71"; // Keycode Left Bracket
		$this->Send_Key($command);
	}
	public function Key_Right_Bracket()
	{
		$command = "72"; // Keycode Right Bracket
		$this->Send_Key($command);
	}
	public function Key_Backslash()
	{
		$command = "73"; // Keycode Backslash
		$this->Send_Key($command);
	}
	public function Key_Semicolon()
	{
		$command = "74"; // Keycode Semicolon
		$this->Send_Key($command);
	}
	public function Key_Apostrophe()
	{
		$command = "75"; // Keycode Apostrophe
		$this->Send_Key($command);
	}
	public function Key_Slash()
	{
		$command = "76"; // Keycode Slash
		$this->Send_Key($command);
	}
	public function Key_At()
	{
		$command = "77"; // Keycode At
		$this->Send_Key($command);
	}
	public function Key_Num()
	{
		$command = "78"; // Keycode Num
		$this->Send_Key($command);
	}
	public function Key_Headsethook()
	{
		$command = "79"; // Keycode Heatsethook
		$this->Send_Key($command);
	}
	public function Key_Focus()
	{
		$command = "80"; // Keycode Focus
		$this->Send_Key($command);
	}
	public function Key_Plus()
	{
		$command = "81"; // Keycode Plus
		$this->Send_Key($command);
	}
	public function Key_Notification()
	{
		$command = "83"; // Keycode Notification
		$this->Send_Key($command);
	}
	
	public function Key_Search()
	{
		$command = "84"; // Keycode Search
		$this->Send_Key($command);
	}
	
	public function Tag_Last_Keycode()
	{
		$command = "85"; // tag last keycode
		$this->Send_Key($command);
	}
	
	public function StartNetflix()
	{
		shell_exec("adb shell am start -n com.netflix.ninja/.MainActivity");
	}
	
	public function StopNetflix()
	{
		shell_exec("adb shell am force-stop com.netflix.ninja");
	}
	
	private function Send_Key($command)
	{
		shell_exec("adb shell input keyevent ".$command);
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
