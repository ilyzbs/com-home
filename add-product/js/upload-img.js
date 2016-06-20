//    用于压缩图片的canvas 
var canvas = document.createElement("canvas"); 
var ctx = canvas.getContext('2d'); 

 //    瓦片canvas 
var tCanvas = document.createElement("canvas"); 

var tctx = tCanvas.getContext("2d"); 
var maxsize = 100 * 1024;
var imgCount = 0;
$(function(){
	$('#upload-img').change(function(){
		var files = document.getElementById('upload-img').files;
		var file;
		var dataUrl;
		for(var i=0;i<files.length;i++){
			file = files[i];
			//console.log(file);
			var reader  = new FileReader();
			reader.onload = function(e) {
				dataUrl = e.target.result
				//console.log(dataUrl);
				var tempImg = new Image(); 
        		tempImg.src = dataUrl;
				checkCompress(file,tempImg);
			}
			reader.readAsDataURL(file);
		}
	})
    //删除图片
    $('.del-img').click(function(){
        var imgObj = $(this).parent('.show-img').children('.img-list');
        var imgSrc = imgObj.attr('src');
        imgObj.attr('src',"");
    })
})
//检查图片信息
function checkImgInfo(file){
    var rFilter = /^(image\/jpg|image\/jpeg|image\/png|image\/bmp|image\/gif)$/i;
    if (! rFilter.test(file.type)) {
        alert('不支持图片格式');
        return;
    }
}
function checkCompress(file,tempImg){
    var src = "";
    //如果图片大小小于100kb，则直接上传 
     if (file.size <= maxsize) {
         src = tempImg.src;
     }else{
         // 图片加载完毕之后进行压缩，然后上传 
         if (tempImg.complete) {
             src = compress(tempImg);

         } else {
             tempImg.onload = compress(tempImg);
         } 
     }
     $.post(uploadUrl,{imgData:src},function(data){
        alert(data);
        $('.img-list').each(function(){
            if("" == $(this).attr('src')){
                $(this).attr('src',data);
                imgCount++;
                return false;
            }
            if(data != "" && imgCount == $('.img-list').length){
                var html = '<div class="del-img"><div class="yh"></div></div>';
                    html+= '<img class="img-list" src="'+data+'">';
                $('.up-img a .show-img').html(html);
            }
        })
   	},'json');
}
function compress(img) { 
    var initSize = img.src.length; 
    var height = img.naturalHeight; 
    var width = img.naturalWidth; 
    //alert(width);
    //alert(height);

    //如果图片大于四百万像素，计算压缩比并将大小压至400万以下 
    var ratio; 
    if ((ratio = width * height / 4000000)>1) { 
     ratio = Math.sqrt(ratio); 
     width /= ratio; 
     height /= ratio; 
    }else { 
     ratio = 1; 
    } 

    canvas.width = width; 
    canvas.height = height; 

    //        铺底色 
    ctx.fillStyle = "#fff"; 
    ctx.fillRect(0, 0, canvas.width, canvas.height); 

    //如果图片像素大于100万则使用瓦片绘制 
    var count; 
    if ((count = width * height / 1000000) > 1) { 
     count = ~~(Math.sqrt(count)+1); //计算要分成多少块瓦片 

    //            计算每块瓦片的宽和高 
     var nw = ~~(width / count); 
     var nh = ~~(height / count); 

     tCanvas.width = nw; 
     tCanvas.height = nh; 

     for (var i = 0; i < count; i++) { 
         for (var j = 0; j < count; j++) { 
             tctx.drawImage(img, i * nw * ratio, j * nh * ratio, nw * ratio, nh * ratio, 0, 0, nw, nh); 

             ctx.drawImage(tCanvas, i * nw, j * nh, nw, nh); 
         } 
     } 
    } else { 
     ctx.drawImage(img, 0, 0, width, height); 
    } 

    //进行最小压缩 
    var ndata = canvas.toDataURL('image/jpeg', 0.6); 

    /*console.log('压缩前：' + initSize); 
    console.log('压缩后：' + ndata.length); 
    console.log('压缩率：' + ~~(100 * (initSize - ndata.length) / initSize) + "%"); */

    tCanvas.width = tCanvas.height = canvas.width = canvas.height = 0; 

    return ndata; 
}