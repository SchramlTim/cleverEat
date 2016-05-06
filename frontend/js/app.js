function changeHeightOfFormitem(){
	var cw = $('.formitem').width();
	//console.log(cw);
	cw = cw / 2;
	$('.formitem').css({'height':cw+'px'});
}
function setBackgroundOnSections(){
	$('.personalform .formitem').each(function( index ) {
		  if((index%2) != 0){
			  $(this).css({'background':'#e8ffe8'});
		  }else{
			  $(this).css({'background':'#ceffce'});
		  }
	});
	$('.nutritionform .formitem').each(function( index ) {
		  if((index%2) != 0){
			  $(this).css({'background':'#e8ffe8'});
		  }else{
			  $(this).css({'background':'#ceffce'});
		  }
	});
}

$( document ).ready(function() {
	changeHeightOfFormitem();
	
	setBackgroundOnSections();
	
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