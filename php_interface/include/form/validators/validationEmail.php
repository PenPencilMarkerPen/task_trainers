<?
class validationEmail
{
	public static function GetDescription()
	{
		return array(
			"NAME"            => "custom_mail",                                   
			"DESCRIPTION"     => "Email",                                
			"TYPES"           => array("text"),                           
			"HANDLER"         => array("validationEmail", "DoValidate")   
		);
	}

	
	public static function DoValidate($arParams, $arQuestion, $arAnswers, $arValues)
	{
		global $APPLICATION;
    
		foreach ($arValues as $value)
		{
			if (!preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i', $value)){
				$APPLICATION->ThrowException("#FIELD_NAME#: Неверный формат почты!");
				return false;
			}
		}
    
		return true;
	}
}
AddEventHandler("form", "onFormValidatorBuildList", array("validationEmail", "GetDescription"));
?>