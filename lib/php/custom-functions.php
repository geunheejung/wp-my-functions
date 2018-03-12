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
        var Price = (function () {      
            var Price = function() {
                 this._target = null;
                 this._viewTarget = null;
                 this._pricings = [];
            }, fn = Price.prototype;
                                    
            fn.setTarget = function(target) {
                this._target = document.querySelector(target);
            };
        
            fn.setViewTarget = function(view) {
                this._viewTarget = document.querySelector(view);
            };
            
            fn.setPricings = function(pricings) {
                if (!(Array.isArray(pricings))) return;
                this._pricings = pricings;
            };
        
            fn.bindChangeEvent = function() {        
                var self = this;
                
                this._target.addEventListener('change', function(current) {
                    var option = current.target.option;                    
                    var resultPriceText = self._pricings[current.target.options[current.target.selectedIndex].value];       
                    self._viewTarget.innerHTML = \"<span>\" + resultPriceText + \"</span>\";                    
                });
            };                                                                                     
                    
            return Price;                        
        })();
        
        var plus = new Price();
        var auto = new Price();
        </script>
    ";
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
        plus.setPricings(plusPricingMoneyArr);
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
        auto.setPricings(autoPricingMoneyArr);
    </script>
    <?php
    return "<select class='auto_selector_box' id='auto_selector'>{$options}</select>";
};
?>


