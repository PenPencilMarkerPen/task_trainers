<?php

class Modify{

    private $arResult;

    public function __construct(&$arResult) {
        $this->arResult = &$arResult;
    }

    public function Errors()
    {
        if (is_array($this->arResult['FORM_ERRORS'])){
            foreach($this->arResult["FORM_ERRORS"] as $FIELD_SID => $BITRIX_ERROR_TEXT){
                $arQuestion = $this->arResult["QUESTIONS"][$FIELD_SID];
                if (isset($arQuestion['HTML_CODE'])) {
                    $arQuestion['HTML_CODE'] = $this->addInvalidClass($arQuestion['HTML_CODE']);
                    
                    $this->arResult["QUESTIONS"][$FIELD_SID] = $arQuestion;
                }
            }
        }
    }
   
    public function addInvalidClass($htmlCode) {
    
        $pos = strpos($htmlCode, 'class="inputtext');
        if ($pos === false) {
            return $htmlCode;
        }
    
        $posEnd = strpos($htmlCode, '"', $pos + strlen('class="inputtext'));
        if ($posEnd === false) {
            return $htmlCode;
        }
    
        $htmlResult = substr_replace($htmlCode, ' invalid', $pos + strlen('class="inputtext'), 0);

    
        return $htmlResult;
    }

    public function iterArray(){
        foreach ($this->arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
        {
            if (strpos($arQuestion["HTML_CODE"], 'inputtextarea')){
                $arQuestion['HTML_CODE']= $this->editClass($arQuestion["HTML_CODE"]);
                $this->arResult["QUESTIONS"][$FIELD_SID] = $arQuestion;

            }
        }
    }

    public function editClass($htmlCode){
        $htmlResult = str_replace('class="inputtextarea"', 'class="inputtext"', $htmlCode);
        return $htmlResult;
    }
}

$modify = new Modify($arResult);
$modify->Errors();
$modify->iterArray();
