var host = {
    'pricingSelect': function() {
        var PLUS = 'plus';
        var PLUS_SELECTOR = 'plus_selector';
        var PLUS_TEXT = 'plus_text';
        var AUTO = 'auto';
        var AUTO_SELECTOR = 'auto_selector';
        var AUTO_TEXT = 'auto_text';
        pricing.setTarget(PLUS_SELECTOR, PLUS_TEXT);
        pricing.bindEvent(PLUS);
        pricing.setTarget(AUTO_SELECTOR, AUTO_TEXT);
        pricing.bindEvent(AUTO);
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



