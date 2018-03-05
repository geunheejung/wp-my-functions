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

	function bindPlusEvent() {
		var priceMoney = new PriceText(PRICE_P);
        plusSelectorTarget.addEventListener(EVENT_TYPE.CHANGE, function(current) {
			var resultPriceText = priceMoney.money[current.target.options[current.target.selectedIndex].value];
            viewPlusText.innerHTML = "<span class='before_plus_money'>" + resultPriceText + "</span>";
            viewPlusText.innerHTML += "<span class='after_plus_unit'>원/월</span>";

		});
	}

    function bindAutoEvent() {
        var priceMoney = new PriceText(PRICE_A);
        autoSelectorTarget.addEventListener(EVENT_TYPE.CHANGE, function(current) {
            var resultPriceText = priceMoney.money[current.target.options[current.target.selectedIndex].value];
			viewAutoText.innerHTML = resultPriceText + '원/월';
			viewPlusText.innerHTML = "<span class='before_auto_money'>" + resultPriceText + "</span>";
            viewPlusText.innerHTML += "<span class='after_auto_unit'>원/월</span>";
        });
    }

	return {
		bindPlusEvent: function() {
			plusSelectorTarget = document.getElementById('plus_selector');
        	viewPlusText = document.getElementById('plus_text');
			bindPlusEvent();
		},
		bindAutoEvent: function() {
			autoSelectorTarget = document.getElementById('auto_selector');
			viewAutoText = document.getElementById('auto_text');
			bindAutoEvent();
		}
	}
})();
changePriceMoney.bindPlusEvent();
changePriceMoney.bindAutoEvent();



