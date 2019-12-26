
<div class="form-item">
    <fieldset><legend>{ts}Card ID{/ts}</legend>
        <div class="crm-block crm-form-block crm-accesscard-form-block">
            
            <table class="form-layout-compressed">
                     <td class="label">{$form.card_id.label}</td>
                    <td>
                        <div style="float:left">{$form.card_id.html}</div>
                    </td>  
                </tr>
                <tr class="crm-cardid-form-block">
                    <td class="label"></td>
                    <td><div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="bottom"}</div></td>
                </tr>
            </table>
        </div>
    </fieldset>
</div>
                                            
<style type="text/css">
{literal}
#crm-container .crm-error {
    padding: 0;
}
{/literal}
</style>
                 
