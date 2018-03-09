<?php
function getOptions( $target, $optionsArr, $params ) {
    $i = 0;
    $options = $optionsArr;
    $staffUnit = $params['unit'];
    $staffLastUnit = $params['lastUnit'];
    $MAX = count($options);
    for ($i; $i < $MAX; $i++) {
        $resultOptions;
        if ($i == $MAX - 1) {
            $resultOptions .= "<option value='{$i}' id='{$target}_options'>$options[$i]{$staffLastUnit}</option>";
            return $resultOptions;
            } else {
            $resultOptions .= "<option value='{$i}' id='{$target}_options'>$options[$i]{$staffUnit}</option>";
        }
    };
};

function getPriceSelectorScript() {
    echo "
        <script>
            var changePriceMoney = (function () {
                      
                var plusSelectorTarget;
                var viewPlusText;
                var autoSelectorTarget;
                var	viewAutoText;
                var plusPriceArr;
                var autoPriceArr;
                var PRICE_P = 'plus';
                var PRICE_A = 'auto';
                
                var tar;
                var vie;
                                             

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
                    setT: function(tar, vie) {
                      tar = tar;
                      vie = vie;
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
}

function getPricingOptions( $params ) {
    $i = 1;
    $MAX = $params['option-count'];
    $resultArr = array();
    for ($i; $i < $MAX + 1; $i++) {
        $quarterPricingPoint;
        $beforeOption;

        if ($i == $MAX) {
            array_push($resultArr, $quarterPricingPoint + 1);
            return $resultArr;
        } else {
            $quarterPricingPoint = $params['option-count-quarter'] * $i;

            if ($i == 1) {
                array_push($resultArr, "1 - {$quarterPricingPoint}");
            } else {
                array_push( $resultArr, "{$beforeOption} - {$quarterPricingPoint}");
            }
        }
        $beforeOption = 1 + $quarterPricingPoint;
    }
}
?>

<?php
$pricingPlusMoneyArr;
$pricingAutoMoneyArr;

function selectorTypeIsPlus( $atts, $content = null ) {
	$params = shortcode_atts( array(
		'unit' => '명',
		'lastUnit' => '명 이상',
        'moneys' => "1 | 2 | 3 | 4 | 5",
        'option-count' => (int)6,
        'option-count-quarter' => (int)20,
     	), $atts );
    getPriceSelectorScript();
    global $pricingPlusMoneyArr;
    $TYPE = 'plus';
    $quarterText = '|';
    $pricingPlusMoneyArr = explode($quarterText, $params['moneys']);
    $optionsArr = getPricingOptions( $params );
	$options = getOptions( $TYPE, $optionsArr, $params);
?>
<script>
    <?php
        global $pricingPlusMoneyArr;
    ?>
    var plusPricingMoneyArr = <?php echo json_encode($pricingPlusMoneyArr); ?>;
    changePriceMoney.setPlusPricings(plusPricingMoneyArr);
</script>
<?php
    return "<select class='plus_selector_box' id='plus_selector'>{$options}</select>";
};
?>

<?php
function selectorTypeIsAuto( $atts, $content = null ) {
    $params = shortcode_atts( array(
        'unit' => '명',
        'lastUnit' => '명 이상',
        'moneys' => "1 | 2 | 3 | 4 | 5",
        'option-count' => (int)6,
        'option-count-quarter' => (int)20,
    ), $atts );
    global $pricingAutoMoneyArr;
    $TYPE = 'auto';
    $pricingAutoMoneyArr = explode("|", $params['moneys']);
    $optionsArr = getPricingOptions( $params );
    $options = getOptions( $TYPE, $optionsArr, $params);
    ?>
    <script>
        <?php global $pricingAutoMoneyArr; ?>
        var autoPricingMoneyArr = <?php echo json_encode($pricingAutoMoneyArr); ?>;
        changePriceMoney.setAutoPricings(autoPricingMoneyArr);
    </script>
    <?php
    return "<select class='auto_selector_box' id='auto_selector'>{$options}</select>";
};
?>

<script>

</script>


