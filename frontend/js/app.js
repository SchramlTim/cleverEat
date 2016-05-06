

$( document ).ready(function() {

	$('.sliderWeight').slider({
		tooltip: 'always',
		formatter: function(value) {
			return value + ' kg';
		}
	});
	$('.sliderHeight').slider({
		tooltip: 'always',
		formatter: function(value) {
			return value + ' cm';
		}
	});
	$('.sliderAge').slider({
		tooltip: 'always',
		formatter: function(value) {
			return value + ' Jahre';
		}
	});
	
	$(".fa-smile-o").click(function(){
	     $(this).prev().attr('checked',true);
	     $('.fa-meh-o').prev().attr('checked',false);
	 })
	 $(".fa-meh-o").click(function(){
	     $(this).prev().attr('checked',true);
	     $('.fa-smile-o').prev().attr('checked',false);
	 })
	 $(".fa-male").click(function(){
	     $(this).prev().attr('checked',true);
	     $('.fa-female').prev().attr('checked',false);
	 })
	 $(".fa-female").click(function(){
	     $(this).prev().attr('checked',true);
	     $('.fa-male').prev().attr('checked',false);
	 })


});