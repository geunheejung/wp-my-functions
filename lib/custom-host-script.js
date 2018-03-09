var host = {
    'pricingSelect': function() {
        pricing.setTarget('plus_selector', 'plus_text');
        pricing.bindEvent('plus');
        pricing.setTarget('auto_selector', 'auto_text');
        pricing.bindEvent('auto');
    },
	'mobileAppDownloadBtn': function() {
        var el = document.querySelector('.bottom_btn_wrap');
        if (window.scrollY > 30) el.classList.add('show_selector');
	}
};
// Pricing Selector Host Code
// window.addEventListener('scroll', host.mobileAppDownloadBtn());
window.onload = host.pricingSelect;



