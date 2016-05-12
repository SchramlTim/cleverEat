function changeHeightOfFormitem(){
	var cw = $('.formitem').width();
	//console.log(cw);
	cw = cw / 2;
	$('.formitem').css({'height':cw+'px'});
}
function setBackgroundOnSections(){
	$('.personalform .formitem').each(function( index ) {
		  if((index%2) != 0){
			  $(this).css({'background':'#e5e5e5'});
		  }else{
			  $(this).css({'background':'#f5f5f5'});
		  }
	});
	$('.nutritionform .formitem').each(function( index ) {
		  if((index%2) != 0){
			  $(this).css({'background':'#e5e5e5'});
		  }else{
			  $(this).css({'background':'#f5f5f5'});
		  }
	});
}
function sendFrontendData(){
	firstname = $("#firstname").val(); 
	lastname = $("#lastname").val(); 
	weight = $("#weight").val(); 
	height = $("#height").val(); 
	sex = $('input[name=sex]:checked', '#sex').val();
	age = $("#age").val(); 
	email = $("#email").val(); 
	negativfood = $("#negativfood").val();
	nutritionalform='';
	radio_buttons = $("input[name='nutritionalform']");
	if( radio_buttons.filter(':checked').length == 0){
		console.log('nicht checked');
		nutritionalform = 'keine';
	} else {
	  nutritionalform = radio_buttons.val();
	}
	
	//nutritionalform = $('input[name=nutritionalform]:checked', '#nutritionalform').val();
	lactoseintolerant = $('input[name=lactoseintolerant]:checked', '#lactoseintolerant').val();
	goal = $( "#goal option:selected" ).val();
	activity = $( "#activity option:selected" ).val();
	
	//alert(goal);
	//console.log('sdfsdrgd');
	$.ajax({
		type: 'POST',
		url: 'dataFrontend.php',
		data:{	firstname:firstname, 
				lastname: lastname,
				weight: weight,
				height: height,
				sex: sex,
				age: age,
				email: email,
				negativfood: negativfood,
				nutritionalform: nutritionalform,
				lactoseintolerant: lactoseintolerant,
				goal: goal,
				activity: activity
				
				
		},
		success: function(data){
			console.log('successful!');
			$('.content').html(data);
		}
	});
	console.log('DFGJKSADLJFAS');
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