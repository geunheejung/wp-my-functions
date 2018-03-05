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
	function PriceText(type) {
		this.money = type === 'plus'
			? ['9,900', '27,000', '42,000', '55,000', '67,000', '인당 770']
			: ['17,600', '인당 1,760'];
	}

    function setPlusEle() {
        plusSelectorTarget = document.getElementById('plus_selector');
        viewPlusText = document.getElementById('plus_text');
    }

	function setAutoEle() {
        autoSelectorTarget = document.getElementById('auto_selector');
        viewAutoText = document.getElementById('auto_text');
	}

	function bindPlusEvent() {
		var priceMoney = new PriceText('plus');

        plusSelectorTarget.addEventListener(EVENT_TYPE.CHANGE, function(x) {
			var resultPriceText = priceMoney.money[x.target.options[x.target.selectedIndex].value];
            viewPlusText.innerHTML = "<span class='before_price_money'>" + resultPriceText + "</span>";
            viewPlusText.innerHTML += "<span class='after_price_unit'>원/월</span>";

		});
	}

    function bindAutoEvent() {
        var priceMoney = new PriceText('auto');
        autoSelectorTarget.addEventListener(EVENT_TYPE.CHANGE, function(x) {
            var resultPriceText = priceMoney.money[x.target.options[x.target.selectedIndex].value];
            viewAutoText.innerHTML = resultPriceText + '원/월';
        });
    }

	return {
		setPlusEle: setPlusEle,
        setAutoEle: setAutoEle,
        bindPlusEvent: bindPlusEvent,
		bindAutoEvent: bindAutoEvent
	}
})();
changePriceMoney.setPlusEle();
changePriceMoney.setAutoEle();
changePriceMoney.bindPlusEvent();
changePriceMoney.bindAutoEvent();



