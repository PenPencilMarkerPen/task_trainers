<?
class validationPhone
{
	public static function GetDescription()
	{
		return array(
			"NAME"            => "custom_phone",                                   
			"DESCRIPTION"     => "Phone",                                
			"TYPES"           => array("text"),                           
			"HANDLER"         => array("validationPhone", "DoValidate")   
		);
	}

	
	public static function DoValidate($arParams, $arQuestion, $arAnswers, $arValues)
	{
		global $APPLICATION;
    
		foreach ($arValues as $value)
		{
			if (!preg_match('/^(8|\+7)\d{10}$/', $value)){
				$APPLICATION->ThrowException("#FIELD_NAME#: Введите корректный номер телефона!");
				return false;
			}
		}
    
		return true;
	}
}
AddEventHandler("form", "onFormValidatorBuildList", array("validationPhone", "GetDescription"));
?>