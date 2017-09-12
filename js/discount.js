jQuery(function ($) {

		var disc_sku=$("#disc_sku").val();

		if(disc_sku!=""){
			$("#product_discount").val(disc_sku);
		}

        $(".add_more").on('click', function(e){
	  		var clone = $(".form_fields").eq(0).clone();
	  		clone.find("input").val("");
	  		$(".dynamic_field").append('<hr>');
	  		$(".dynamic_field").append(clone);     
	   	});

        $(".form_fields").hide();
        $(".add_more").hide();

        $(".fixed_discount_field").hide();
        $(".fixed_add_more").hide();


        $('.percent_discount').click(function(){
          if ($(this).is(':checked')){
           		$(".form_fields").show();
        		$(".add_more").show();
        		$('.dynamic_field hr').show();
        		$(".fixed_discount").prop("disabled",true);

          }
          else{
            $(".form_fields").hide();
        	$(".add_more").hide();
        	$('.dynamic_field hr').hide();

        	$(".fixed_discount").prop("disabled",false);

          }
        });

        var fixed_key="";
        $('.fixed_discount').click(function(){
          if ($(this).is(':checked')){
           		$(".fixed_discount_field").show();
       			$(".fixed_add_more").show();
       			$('.fixed_dynamic_field hr').show();
       			$(".percent_discount").prop("disabled",true);
       			fixed_key=0;
          }
          else{
            $(".fixed_discount_field").hide();
       		$(".fixed_add_more").hide();
       		$('.fixed_dynamic_field hr').hide();
       		$(".percent_discount").prop("disabled",false);
       		fixed_key="";
          }
        });


		 var discount=$("#product_discount").val();
		 if(discount!=""){

		 	if(discount.indexOf("#")> -1 ==true){
		 		$('.fixed_discount').prop("checked",true);
		 		$('.percent_discount').prop("disabled",true);
	    		$(".fixed_discount_field").show();
				$(".fixed_add_more").show();
				$('.fixed_dynamic_field hr').show();


		 	}
		 	else{
		 		$('.fixed_discount').prop("disabled",true);
		 		$('.percent_discount').prop("checked",true);
		 		$(".form_fields").show();
        		$(".add_more").show();
        		$('.dynamic_field hr').show();
		 	}

		 }

        $("#discount_rate,#max_count,#min_count").on('keyup',function(){
        	var total_discount="";
	        var min_count = document.querySelectorAll('.min_count'), i;
		  	var max_count = document.querySelectorAll('.max_count'), i;
		  	var discount_rate = document.querySelectorAll('.discount_rate'), i;
		  	for (i = 0; i < min_count.length; i++) {
	  		    var min = parseFloat(min_count[i].value || 0);
	  		    var max = parseFloat(max_count[i].value || 0);
	  		    var discount = parseFloat(discount_rate[i].value || 0);

	  		    if(min_count.length==1){
	  		    	total_discount=min+"-"+max+"*"+discount;
	  		    }
	  		    else{
	  		    	total_discount+=min+"-"+max+"*"+discount+"|";
	  		    }
				$(".min_count").val(min);
				$(".max_count").val(max);
	  		    $("#product_discount").val(total_discount);	  
	  		}
        });

     
		 $(document).on('keyup', '#discount_rate,#max_count,#min_count', function() {
			var min_count = document.querySelectorAll('.min_count'), i;
	  		var max_count = document.querySelectorAll('.max_count'), i;

	  		var discount_rate = document.querySelectorAll('.discount_rate'), i;
	  		var total_discount="";

	  		for (i = 0; i < min_count.length; i++) {
	  		    var min = parseFloat(min_count[i].value || 0);
	  		    var max = parseFloat(max_count[i].value || 0);
	  		    var discount = parseFloat(discount_rate[i].value || 0);

	  		    if(min_count.length==1){
	  		    	total_discount=min+"-"+max+"*"+discount;
	  		    }
	  		    else{
	  		    	total_discount+=min+"-"+max+"*"+discount+"|";
	  		    }
	  		  
	  		    $("#product_discount").val(total_discount);	 	
	  		}
	    });

		$('#product_discount').prop('readonly', true);


		var product_discount=$("#product_discount").val();
		var cnt=(product_discount.split("|").length - 1)   ;//3); //logs 3
		
		if(product_discount !="" && product_discount.indexOf("#")> -1 !=true){

			for(var i=0;i<=cnt;i++){

			 	 var product_val=$("#product_discount").val();
			 	 product_val = product_val.split('|');
			 	
			 	 for(var i=0;i<product_val.length;i++){
			 	 
			 	     if(i!=0){
			 	     	 var clone = $(".form_fields").eq(0).clone();
		 	 	 		  /* clone.find("input").val("");*/
		 	 	 		  $(".dynamic_field").append('<hr>');
		 	 	 	 	  $(".dynamic_field").append(clone);
			 	     	
						}		 	 		

		 	 	 	var min_count = document.querySelectorAll('.min_count'), i;
					var max_count = document.querySelectorAll('.max_count'), i;
		 	 	 	var discount_rate = document.querySelectorAll('.discount_rate'), i;

			 	 	var min=product_val[i];
			 	 	min=min.split('-');
			 	 	min=min[0];
			 	 	min_count[i].value=min;

			 		var max=product_val[i];
			 		max=max.split('*');
			 		max=max[0];
			 		max=max.split('-');
			 	    max=max[1];
			 	    max_count[i].value=max;

			 	 	var discount=product_val[i];
			 		discount=discount.split('*');
			 		discount=discount[1];
			 		discount_rate[i].value=discount;

			 	 }
			 	 
			}
	
		}	

		// Code Start for the fixed Discount

		 $(".fixed_add_more").on('click', function(e){
	  		var clone = $(".fixed_discount_field").eq(0).clone();
	  		clone.find("input").val("");
	  		$(".fixed_dynamic_field").append('<hr>');
	  		$(".fixed_dynamic_field").append(clone);     
	   	});

		 $("#fixed_min_count,#fixed_max_count,#fixed_discount_rate").on('keyup',function(){
        	var fixed_discount="";
	        var min_count = document.querySelectorAll('.fixed_min_count'), i;
		  	var max_count = document.querySelectorAll('.fixed_max_count'), i;

		  	var discount_rate = document.querySelectorAll('.fixed_discount_rate'), i;
		  	var total_discount="";

		  	for (i = 0; i < min_count.length; i++) {
	  		    var min = parseFloat(min_count[i].value || 0);
	  		    var max = parseFloat(max_count[i].value || 0);
	  		    var discount = parseFloat(discount_rate[i].value || 0);

	  		    if(max="NaN"){
	  		    	max="+";
	  		    }

	  		    if(min_count.length==1){
	  		    	total_discount=min+"-"+max+"*"+discount+"#"+fixed_key;
	  		    }
	  		    else{
	  		    	total_discount+=min+"-"+max+"*"+discount+"#"+fixed_key+"|";
	  		    }
	  		    $("#product_discount").val(total_discount);	  
	  		}


		 });

	 	 $(document).on('keyup', '#fixed_min_count,#fixed_max_count,#fixed_discount_rate', function() {
	 		var min_count = document.querySelectorAll('.fixed_min_count'), i;
	   		var max_count = document.querySelectorAll('.fixed_max_count'), i;
	   		var discount_rate = document.querySelectorAll('.fixed_discount_rate'), i;
	   		var total_discount="";

	   		for (i = 0; i < min_count.length; i++) {
	   		    var min = parseFloat(min_count[i].value || 0);
	   		    var max = parseFloat(max_count[i].value || 0);
	   		    var discount = parseFloat(discount_rate[i].value || 0);

	   		     if(max="NaN"){
	  		    	max="+";
	  		    	
	  		    }

	   		    if(min_count.length==1){
	   		    	total_discount=min+"-"+max+"*"+discount+"#"+fixed_key;;
	   		    }
	   		    else{
	   		    	total_discount+=min+"-"+max+"*"+discount+"#"+fixed_key+"|";
	   		    }
	   		  
	   		    $("#product_discount").val(total_discount);	 	
	   		}
	     });


	 	 var product_discount=$("#product_discount").val();

		 var cnt=(product_discount.split("|").length - 1)   ;

	 	 if(product_discount !="" &&  product_discount.indexOf("#")> -1 ==true ){

	 	 	for(var i=0;i<=cnt;i++){

	 	 	 	 var product_val=$("#product_discount").val();
	 	 	 	 product_val = product_val.split('|');
	 	 	 	
	 	 	 	 for(var i=0;i<product_val.length;i++){
	 	 	 	 
	 	 	 	     if(i!=0){
	 	 	 	     	 var clone = $(".fixed_discount_field").eq(0).clone();
	 	  	 	 		  /* clone.find("input").val("");*/
	 	  	 	 		  $(".fixed_dynamic_field").append('<hr>');
	 	  	 	 	 	  $(".fixed_dynamic_field").append(clone);
	 	 	 	     	
	 	 				}		 	 		

	 	  	 	 	var min_count = document.querySelectorAll('.fixed_min_count'), i;
	 	  	 	 	var max_count = document.querySelectorAll('.fixed_max_count'), i;
	 	  	 	 	var discount_rate = document.querySelectorAll('.fixed_discount_rate'), i;

	 	 	 	 	var min=product_val[i];
	 	 	 	 	min=min.split('-');
	 	 	 	 	min=min[0];
	 	 	 	 	min_count[i].value=min;

	 	 	 		var max=product_val[i];
	 	 	 		max=max.split('*');
	 	 	 		max=max[0];
	 	 	 		max=max.split('-');
	 	 	 	    max=max[1];
	 	 	 	    max_count[i].value=max;

	 	 	 	 	var discount=product_val[i];
	 	 	 		discount=discount.split('*');
	 	 	 		discount=discount[1];
	 	 	 		discount=discount.split("#");
	 	 	 		discount=discount[0];
	 	 	 		discount_rate[i].value=discount;

	 	 	 	 }
	 	 	 	 
	 	 	}
	 	 
	 	 }


	 	 //Discount Column on shop Page code start



})
