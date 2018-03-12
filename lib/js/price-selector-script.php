<?php
/**
 * Created by PhpStorm.
 * User: geunheejung
 * Date: 2018. 3. 8.
 * Time: 오후 2:42
 */

function getPriceSelectorScript() {
    echo "
        <script>                                  
        var Price = (function () {
            var Price = function() {
                this._target = null;
                this._viewTarget = null;
                this._pricings = [];
                
                var fn = Price.prototype;
            
                fn.setPricingArr = function(pricing) {
                    if (!(Array.isArray(pricing))) return;
                    this._pricings.push(pricing);
                };
                
                fn.setTarget = function(target) {
                    this._target = target;
                }
                                                                                           
                return Price;
            }                        
        })();
        
        
       
        var changePriceMoney = (function () {
        var plusSelectorTarget;
        var viewPlusText;
        var autoSelectorTarget;
        var	viewAutoText;
        var plusPriceArr = [];
        var autoPriceArr = [];
        var PRICE_P = 'plus';
        var PRICE_A = 'auto';
    
        function PriceText(type, pricng) {
            this.money = pricng;
            if (type === 'plus') {
                this.target = plusSelectorTarget;
                this.view = viewPlusText;
            } else {
                this.target = autoSelectorTarget;
                this.view = viewAutoText;
            }
        }
    
        var bindChangePriceEvent = function(priceInfo) {
            if (!priceInfo instanceof PriceText) return Error('priceInfo not PriceText instacne');
            var priceEventCb = function(current) {
                var resultPriceText = priceInfo.money[current.target.options[current.target.selectedIndex].value];
                priceInfo.view.innerHTML = \"<span class='before_' + type + '_money'>\" + resultPriceText + \"</span>\";
                priceInfo.view.innerHTML += \"<span class='after_' + type + '_unit'></span>\";
            };
            priceInfo.target.addEventListener('change', priceEventCb);
        };
    
        return {
            setPlusPricings: function(priArr) {               
                plusPriceArr = priArr;                
            },
            setAutoPricings: function(priArr) {
                autoPriceArr = priArr;
            },
            bindPlusEvent: function() {
               
                plusSelectorTarget = document.getElementById('plus_selector');
                viewPlusText = document.getElementById('plus_text');
                var priceMoney = new PriceText(PRICE_P, plusPriceArr);
                bindChangePriceEvent(priceMoney);
            },
            bindAutoEvent: function() {
                
                autoSelectorTarget = document.getElementById('auto_selector');
                viewAutoText = document.getElementById('auto_text');
                var priceMoney = new PriceText(PRICE_A, autoPriceArr);
                bindChangePriceEvent(priceMoney);
            },                   
        }
    })();         
</script>";
};
?>

