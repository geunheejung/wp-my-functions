<?php
function getOptions( $type, $optionsArr, $params ) {
    $options = $optionsArr;
    $unit = $params['unit'];
    $lastUnit = $params['lastUnit'];
    $i = 0;
    $MAX = count($options);
    $resultOptions;

    for ($i; $i < $MAX; $i++) {

        if ($i == $MAX - 1) {
            $resultOptions.= "<option value='{$i}' id='{$type}_options'>$options[$i]$lastUnit</option>";
            return $resultOptions;
        } else {
            $resultOptions.= "<option value='{$i}' id='{$type}_options'>$options[$i]$unit</option>";
        }

    };
};

function getPriceSelectorScript() {
    echo "
        <script>                           
            var pricing = (function () {                                                                                 
                var targetSelector;
                var changedView;
                var plusPriceArr;
                var autoPriceArr;
                                            
                function PriceText(pricng) {
                    this.money = pricng;
                    this.target = targetSelector;
                    this.view = changedView;
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
                
                var bindPricingEvent = function(type) {                    
                    var PRICE_TYPE = ['plus', 'auto'];
                    var isType = PRICE_TYPE.some(function(index) {                        
                       return index === type; 
                    });              
                    console.log(isType);
                    if (!isType) alert('Price Type is Not (plus, auto)');                                                                             
                    var pricingInfo; 
                    
                    switch (type) {
                        case PRICE_TYPE[0]:
                            pricingInfo = new PriceText(plusPriceArr);                            
                            break;
                        case PRICE_TYPE[1]:
                            pricingInfo = new PriceText(autoPriceArr);                            
                            break;
                        default:
                            break;
                    }
                    
                    bindChangePriceEvent(pricingInfo);
                    
                };
                                                                                                                                                                                                        
                return {
                    setPlusPricings: function(priArr) {                        
                        plusPriceArr = priArr;
                    },
                    setAutoPricings: function(priArr) {
                        autoPriceArr = priArr;
                    },
                    setTarget: function(target, view) {
                        targetSelector = document.getElementById(target);
                        changedView = document.getElementById(view);
                    },
                    bindEvent: bindPricingEvent                   
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
    global $pricingPlusMoneyArr;

	$params = shortcode_atts( array(
		'unit' => '명',
		'lastUnit' => '명 이상',
        'moneys' => "1 | 2 | 3 | 4 | 5",
        'option-count' => (int)6,
        'option-count-quarter' => (int)20,
     	), $atts );
    getPriceSelectorScript();
    $TYPE = 'plus';
    $quarterText = '|';
    $pricingPlusMoneyArr = explode($quarterText, $params['moneys']);
    $optionsArr = getPricingOptions( $params );
	$options = getOptions( $TYPE, $optionsArr, $params);

?>
<script>
    var plusPricingMoneyArr = <?php echo json_encode($pricingPlusMoneyArr); ?>;
    pricing.setPlusPricings(plusPricingMoneyArr);
</script>
<?php
    return "<select class='plus_selector_box' id='plus_selector'>{$options}</select>";
};

function selectorTypeIsAuto( $atts, $content = null ) {
    global $pricingAutoMoneyArr;

    $params = shortcode_atts( array(
        'unit' => '명',
        'lastUnit' => '명 이상',
        'moneys' => "1 | 2 | 3 | 4 | 5",
        'option-count' => (int)6,
        'option-count-quarter' => (int)20,
    ), $atts );
    $TYPE = 'auto';
    $pricingAutoMoneyArr = explode("|", $params['moneys']);
    $optionsArr = getPricingOptions( $params );
    $options = getOptions( $TYPE, $optionsArr, $params);
    ?>
    <script>
        var autoPricingMoneyArr = <?php echo json_encode($pricingAutoMoneyArr); ?>;
        pricing.setAutoPricings(autoPricingMoneyArr);
    </script>
    <?php
    return "<select class='auto_selector_box' id='auto_selector'>{$options}</select>";
};
?>


