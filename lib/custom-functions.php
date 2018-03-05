<?php
function getOptions( $target, $optionsArr ) {
    $i = 0;
    $options = $optionsArr;
    $MAX = count($options);
    for ($i; $i < $MAX; $i++) {
        $resultOptions .= "<option value='{$i}' id='{$target}_options'>$options[$i]</option>";
        if ($i == $MAX - 1) return $resultOptions;
    };
};

function selectorTypeIsPlus( $atts, $content = null ) {
	$options = getOptions( 'plus', array( '1-20명', '21-40명', '41-60명', '61-80명', '81-100명', '101명 이상' ) );

    return "<select class='plus_selector_box' id='plus_selector'>{$options}</select>";
};

function selectorTypeIsAuto( $atts, $content = null ) {
    $options = $options = getOptions( 'plus', array( '1-10명', '11명 이상' ) );

    return "<select class='auto_selector_box' id='auto_selector'>{$options}</select>";
};


