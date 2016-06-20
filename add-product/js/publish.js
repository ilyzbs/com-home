$(function(){
	$('#publish').click(function(){
		var store_id = $('select[name=store_id]').val();
		var category_id = $('select[name=category_id]').val();
		var name = $('input[name=name]').val();
		var price = $('input[name=price]').val();
		var postage = $('input[name=postage]').val();
		var images = [];
		$('.show-img .img-list').each(function(i){
            images[i] = $(this).attr('src');
        });
        var img_length =  images.length;
        if(store_id == ""){

        	return false;
        }
        if(category_id == ""){

        	return false;
        }
        if(name == ""){

        	return false;
        }
        if(price == ""){

        	return false;
        }
        if(postage == ""){

        	return false;
        }
        if(img_length <1){

        	return false;
        }
        $.post('',{
        	'store_id':store_id,
        	'category_id':category_id,
        	'name':name,
        	'price':price,
        	'postage':postage,
        	'images':images
        },function(data){
        	
        })
	})
})