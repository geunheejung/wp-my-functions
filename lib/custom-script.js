// / 모바일에서 스크롤 시 하단 버튼 show/hide 기능.
function mobileAppDownloadEvent() {
	var el = document.querySelector('.bottom_btn_wrap');
	if (window.scrollY > 30) {
		el.classList.add('show_selector');
	}
}
window.addEventListener('scroll', mobileAppDownloadEvent());

var changePriceMoney = (function () {
	var plusSelectorTarget,
		viewPlusText,
		autoSelectorTarget,
		viewAutoText;
	var EVENT_TYPE = {
		'CHANGE': 'change'
	};
	var PRICE_P = 'plus';
	var PRICE_A = 'auto';
	function PriceText(type) {
		this.money = type === PRICE_P
			? ['9,900', '27,000', '42,000', '55,000', '67,000', '인당 770']
			: ['17,600', '인당 1,760'];
	}

	function bindPlusEvent(targetEle, viewEle) {
		var priceMoney = new PriceText(PRICE_P);
        targetEle.addEventListener(EVENT_TYPE.CHANGE, function(current) {
			var resultPriceText = priceMoney.money[current.target.options[current.target.selectedIndex].value];
            viewEle.innerHTML = "<span class='before_price_money'>" + resultPriceText + "</span>";
            viewEle.innerHTML += "<span class='after_price_unit'>원/월</span>";

		});
	}

    function bindAutoEvent(targetEle, viewEle) {
        var priceMoney = new PriceText(PRICE_A);
        targetEle.addEventListener(EVENT_TYPE.CHANGE, function(current) {
            var resultPriceText = priceMoney.money[current.target.options[current.target.selectedIndex].value];
            viewEle.innerHTML = resultPriceText + '원/월';
        });
    }

	return {
		bindPlusEvent: function() {
			var plusSelectorTarget = document.getElementById('plus_selector');
        	var viewPlusText = document.getElementById('plus_text');
			bindPlusEvent(plusSelectorTarget, viewPlusText);
		},
		bindAutoEvent: function() {
			var autoSelectorTarget = document.getElementById('auto_selector');
			var viewAutoText = document.getElementById('auto_text');
			bindAutoEvent(autoSelectorTarget, viewAutoText);
		}
	}
})();
changePriceMoney.bindPlusEvent();
changePriceMoney.bindAutoEvent();



