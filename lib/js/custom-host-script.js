var host = {
    'pricingSelect': function() {
        var PLUS_SELECTOR = '#plus_selector';
        var PLUS_TEXT = '#plus_text';
        var AUTO_SELECTOR = '#auto_selector';
        var AUTO_TEXT = '#auto_text';
        plus.setTarget(PLUS_SELECTOR);
        plus.setViewTarget(PLUS_TEXT);
        plus.bindChangeEvent();
        auto.setTarget(AUTO_SELECTOR);
        auto.setViewTarget(AUTO_TEXT);
        auto.bindChangeEvent();
    },
	'mobileAppDownloadBtn': function() {
        var el = document.querySelector('.bottom_btn_wrap');
        var quarterScrollPoint = 30;
        if (window.scrollY > quarterScrollPoint) el.classList.add('show_selector');
	}
};
// Pricing Selector Host Code
// window.addEventListener('scroll', host.mobileAppDownloadBtn());
window.onload = host.pricingSelect;



