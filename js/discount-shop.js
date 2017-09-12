jQuery(function ($) {
	var discount=$("#product_discount_id").val();
	var currency_symbol=$("#currency_symbol").val();


	if(discount=="" || discount==undefined ){
		$("#discount_table").hide();
		return false;
	}


	var fixed_disc_chk;

	if (discount.indexOf('#') > -1)
	{
		fixed_disc_chk=1;
	}

	else{
		fixed_disc_chk=0;
	}

	var cnt=(discount.split("|").length - 1);

	if(fixed_disc_chk==0){
		for(var i=0;i<=cnt;i++){
				var discount_cnt=discount.split('|');
				var quantity=discount_cnt[i];
				quantity=quantity.split('*');
				var discount_rate=quantity[1];
				discount_rate=discount_rate+".00";
				quantity=quantity[0];			
				$('#prod_qua').append($('<td>').append(quantity));
				if(i==0){
					$('#prod_disc').append($('<td>').append('Discount'));
				}
				$('#prod_disc').append($('<td>').append(discount_rate+"%"));   		
		}
	}

	else{
		var regular_price=$("#regular_price").val();

		if (discount.indexOf('+') > -1) {
				var discount_cnt=discount.split('-');
				var prod_quantity=discount_cnt[0];
				var discount_rate=discount.split('*');
				discount_rate=discount_rate[1];
				discount_rate=discount_rate.split('#');
				discount_rate=discount_rate[0];

				
				$('#prod_qua').append($('<td>').append(prod_quantity+"+"));
				$('#prod_disc').append($('<td>').append('Price'));
				//$('#prod_disc').append($('<td>').append(regular_price));
				discount_rate=(regular_price-discount_rate);
				$('#prod_disc').append($('<td>').append("<strike>"+currency_symbol+regular_price+"</strike>"+"<br>"+currency_symbol+discount_rate));
			

		}
		else{

			for(var i=0;i<=cnt;i++){
				var discount_cnt=discount.split('|');
				var quantity=discount_cnt[i];
				quantity=quantity.split('*');
				var product_quantity=quantity[0];
				var discount_rate=quantity[1];
				discount_rate=discount_rate.split("#");
				discount_rate=discount_rate[0];
				$('#prod_qua').append($('<td>').append(product_quantity));
				if(i==0){
					$('#prod_disc').append($('<td>').append('Price'));
				}
				discount_rate=(regular_price-discount_rate);
				$('#prod_disc').append($('<td>').append("<strike>"+currency_symbol+regular_price+"</strike>"+"<br>"+currency_symbol+discount_rate));


			}
		}
	
	}


})