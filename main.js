$(document).ready(function () {
    var imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);
});

var canvas = new fabric.Canvas('photo');

// var clippingRect = new fabric.Rect({
//     left: 0,
//     top: 0,
//     width: 625,
//     height: 650,
//     fill: 'tran',
//     opacity: 1
// });

// canvas.add(clippingRect);
canvas.setOverlayImage('pass_empty.png', canvas.renderAll.bind(canvas), {
            originX: 'left',
            originY: 'top'
        })
var activeImg, scale;
function handleImage(e) {
    var reader = new FileReader();
    reader.onload = function (event) {
        var img = new Image();
        img.onload = function () {
        	$('.canvas').show();
        	var objects = canvas.getObjects();

        	if(objects.length) {
        		console.log(objects.length)
        		canvas.remove(canvas.remove(objects[0]));
        	}
            var instanceWidth, instanceHeight;
            instanceWidth = img.width;
            instanceHeight = img.height;
            scale =  canvas.getWidth() / instanceWidth
            // console.log(canvas.height / instanceHeight, canvas.width / instanceWidth)
            var imgInstance = new fabric.Image(img, {
                width: instanceWidth,
                height: instanceHeight,
                top: 20,
                left: 20,
                scaleY: canvas.getWidth() / instanceWidth,
                scaleX: canvas.getWidth() / instanceWidth,
                originX: 'left',
                originY: 'top'
            });
            imgInstance.set({
			    borderColor: 'white',
			    cornerColor: 'white',
			    cornerSize: 20,
			    transparentCorners: false
			  });
            $('#range_wrap').show();
            canvas.add(imgInstance);
            activeImg = imgInstance;
            imgInstance.clipTo = function (ctx) {
			  ctx.save();

			  ctx.setTransform(1, 0, 0, 1, 0, 0);
			  ctx.rect(
			    20, 20,
			    600, 630
			  );
  				ctx.restore();
            };
            canvas.renderAll();
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(e.target.files[0]);
}
$('.canvas').hide();
$('form').submit(function(event) {
	activeImg  ? $('#img').val(canvas.toDataURL('image/png')) : ''
});
$('#range').on("change", function() {
	var size = $(this).val();
   	activeImg.set({
            scaleY: scale * size / 100,
            scaleX: scale * size / 100,
      });
   	canvas.renderAll();
});