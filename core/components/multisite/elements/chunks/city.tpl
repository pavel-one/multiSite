<select  data-base="{'multisite_url' | config}" data-origin="{$current_city.city_key}" name="changeCity" id="changeCity">
    <option value="">Ваш город</option>
    {foreach $cities as $city}
        <option {if $current_city.city_key == $city.city_key}selected{/if} value="{$city.city_key}">{$city.city_name}</option>
    {/foreach}
</select>