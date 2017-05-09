jQuery(document).ready(function() {
if( ! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
var contentHeight = jQuery('.site-inner').height();
var sidebarHeight = jQuery('.qcontainer').height();
//var innerHeight = jQuery('.qcontainer').innerHeight();
if (contentHeight > innerHeight) {
jQuery('.qcontainer').height(contentHeight);
jQuery(".qcontainer .questions").stick_in_parent({offset_top: 100});
}}});


