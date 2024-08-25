<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arResult["isFormErrors"] == "Y"):?><?endif;?>
<?=$arResult["FORM_NOTE"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>


<div class="contact-form" >
    <div class="contact-form__head">
        <div class="contact-form__head-title">Связаться</div>
        <div class="contact-form__head-text">Наши сотрудники помогут выполнить подбор услуги и&nbsp;расчет цены с&nbsp;учетом
            ваших требований
        </div>
    </div>
    <?=$arResult["FORM_HEADER"]?>
    <form class="contact-form__form" >
        <div class="contact-form__form-inputs">
        <?
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
            {
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
                {
                    echo $arQuestion["HTML_CODE"];
                }
                else
                {
                    $class_main = 'input contact-form__input';
                    if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea')
                        break;
        ?>
                    <div class="<?=$class_main?>">
                        <label class="input__label" for="<?=$FIELD_SID?>">
                            <div class="input__label-text"><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?></div>
                            <?=$arQuestion["HTML_CODE"]?>
                            <div class="input__notification">Введите корректные данные</div>
                        </label>
                    </div>
        <?
                }
            } 
            $lastQuestion= end($arResult["QUESTIONS"]);
        ?>
        </div>

        <div class="contact-form__form-message">
            <div class="input"><label class="input__label" for="medicine_message">
                <div class="input__label-text">Сообщение</div>
                <?=$lastQuestion["HTML_CODE"]?>

                <div class="input__notification"></div>
            </label></div>
        </div>

        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
                данных&raquo;.
            </div>

            <input 
                <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> 
                type="submit" 
                name="web_form_submit" 
                class="form-button contact-form__bottom-button" 
                value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" 
                data-success="Отправлено" 
                data-error="Ошибка отправки"
            />

        </div>
    </form>

    <p><?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?></p>
    <?=$arResult["FORM_FOOTER"]?>

</div>


<?
} 
?>
