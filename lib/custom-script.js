// / 모바일에서 스크롤 시 하단 버튼 show/hide 기능.
function mobileAppDownloadEvent() {
	var el = document.querySelector('.bottom_btn_wrap');
	if (window.scrollY > 30) {
		el.classList.add('show_selector');
	}
}
// window.addEventListener('scroll', mobileAppDownloadEvent());

// Pricing Selector Host Code
window.onload = function() {
    changePriceMoney.bindPlusEvent();
    changePriceMoney.bindAutoEvent();
}


