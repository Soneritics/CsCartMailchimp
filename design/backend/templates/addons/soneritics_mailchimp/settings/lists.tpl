<div class="form-field control-group setting-wide soneritics_mailchimp">
    <label for="addon_option_soneritics_mailchimp_lists" class="control-label">{__('soneritics_mailchimp_list')}:</label>
    <div class="controls">
        <select id="addon_option_soneritics_mailchimp_lists" name="soneritics_mailchimp_list_id">
            {foreach from=fn_soneritics_mailchimp_get_lists() item=mc_listname key=mc_listid}
                <option value="{$mc_listid}" {if $mc_listid==fn_soneritics_mailchimp_get_active_list_id()}selected="selected"{/if}>{$mc_listname}</option>
            {/foreach}
        </select>
    </div>
</div>