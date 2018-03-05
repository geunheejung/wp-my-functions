<?php
// function getPriceMoneyText( $atts, $content ) {
// 	$params = shortcode_atts( array(
// 		'price_type' => 'free'
// 	), $atts );
//
// 	return "<span id='{$params['price_type']}_money_zone'>{$content}</span>";
// };

// function priceSelector( $atts, $content = null ) {
//     $params = shortcode_atts( array(
// 			'price_type' => 'free'
//     ), $atts );
// 		$PRICE_FREE = 'free';
// 		$PRICE_PLUS = 'plus';
// 		$PRICE_AUTO = 'auto';
// 		$options = [];
// 		$values = [];
// 		global $selectedPriceType;
// 		$selectedPriceType = $params['price_type'];
//
// 		switch ($params['price_type']) {
// 			case $PRICE_FREE:
// 				return "<span>인원 수 제한없이</span>";
// 			case $PRICE_PLUS:
// 				$options = array( '1-20명', '21-40명', '41-60명', '61-80명', '81-100명', '101명 이상' );
// 				$values = array( '9,900', '27,000', '42,000', '55,000', '67,000', '인당 770' );
// 				break;
// 			case $PRICE_AUTO:
// 				$options = array( '1-10명', '11명 이상' );
// 				$values = array( '17,600', '인당 1,760');
// 				break;
// 			default:
// 				break;
// 		}
//
// 		function getPriceSelectValues( $option, $type ) {
// 			for ($i = 0; $i < count($option); $i++) {
// 				$resultValue .= "<option value='{$i}' name='{$type}'>{$option[$i]}</option>";
// 				if ($i === count($option) - 1) return $resultValue;
// 			}
// 		};
//
// 		echo "
// 			<script>
// 				function changePriceMoney() {
// 					var a = document.getElementById('{$params['price_type']}_money_zone');
// 					// switch('{$params['price_type']}') {
// 					//
// 					// };
// 				}
//
// 			</script>
// 		";
//
// 		$selectOption = getPriceSelectValues( $options, $params['price_type'] );
// 		$ucfirstType = ucfirst($params['price_type']);
//
// 		return "
// 			<select id='{$params['price_type']}_selector' class='price_select_box' onchange='changePriceMoney()'>
// 				{$selectOption}
// 			</select>
// 		";
// };
//
// function getUserQa( $atts, $content ) {
// 	//  각각의 버튼을 누를 때 마다 true false 바뀌
// 		echo '
// 		<style>
// 		.btn-header {
// 			display: table;
// 			width: 100%;
// 		}
// 		.btn-header div {
// 			display: table-cell;
// 			width: 20%;
// 			height: 50px;
// 		}
//
// 		.top-btn {
// 			width: 100%;
// 			height: 100%;
// 			background: none;
// 		}
// 		</style>
// 		';
//
// 	$arr = array(
// 		0 => array(
// 			'main_title' => '이용/서비스문의',
// 			'title' => '고객 센터 운영 시간을 알고 싶어요.',
// 			'content' => '고객센터(1644-3332), 카카오톡 플러스 친구 온라인 상담은 평일 오전 10시부터 19시까지 운영되고 있으며, 주말 및 공휴일에는 고객센터가 운영되지 않음을 알려드립니다. 자주 묻는 질문은 알밤 홈페이지 내 자주 묻는 질문 or 플러스 친구 키워드 안내를 참고 부탁드립니다. ',
// 			'isChecked' => false
// 		),
// 		1 => array(
// 			'main_title' => '관리자용 앱',
// 			'title' => '사업장이 여러 곳인 경우도 모두 관리가 가능한가요?',
// 			'content' => '고객센터(1644-3332), 카카오톡 플러스 친구 온라인 상담은 평일 오전 10시부터 19시까지 운영되고 있으며, 주말 및 공휴일에는 고객센터가 운영되지 않음을 알려드립니다. 자주 묻는 질문은 알밤 홈페이지 내 자주 묻는 질문 or 플러스 친구 키워드 안내를 참고 부탁드립니다. ',
// 			'isChecked' => false
// 		),
// 		2 => array(
// 			'main_title' => '관리자용 웹(PC)',
// 			'title' => '어떻게 로그인 하나요?',
// 			'content' => '고객센터(1644-3332), 카카오톡 플러스 친구 온라인 상담은 평일 오전 10시부터 19시까지 운영되고 있으며, 주말 및 공휴일에는 고객센터가 운영되지 않음을 알려드립니다. 자주 묻는 질문은 알밤 홈페이지 내 자주 묻는 질문 or 플러스 친구 키워드 안내를 참고 부탁드립니다. ',
// 			'isChecked' => false
// 		),
// 		3 => array(
// 			'main_title' => '직원용 앱',
// 			'title' => '꼭 휴대폰 번호로만 가입을 해야 하나요?',
// 			'content' => '고객센터(1644-3332), 카카오톡 플러스 친구 온라인 상담은 평일 오전 10시부터 19시까지 운영되고 있으며, 주말 및 공휴일에는 고객센터가 운영되지 않음을 알려드립니다. 자주 묻는 질문은 알밤 홈페이지 내 자주 묻는 질문 or 플러스 친구 키워드 안내를 참고 부탁드립니다. ',
// 			'isChecked' => false
// 		),
// 	);
//
// 	function qaTitleBtn( $titleBtn ) {
// 		for ($i = 0; $i < count($titleBtn); $i++) {
// 			$resultBtn .= "<div>
// 				<button class='top-btn'>이용</button>
// 			</div>";
// 			if ($i == count($titleBtn) - 1) return $resultBtn;
// 		};
// 	};
//
// 	echo qaTitleBtn( $arr );
// };

 ?>
