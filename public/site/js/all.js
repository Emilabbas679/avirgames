$(document).ready(function () {
    // $('.without-registration-btn').click(function () {
    //     $('.personal-information-box').slideDown(1000);

    // });

    // $('.with-registration-btn').click(function () {
    //     $('.personal-information-box').slideUp(1000);
    // });

    if($(".sale-checkbox").prop('checked') == true){
        $('.sales-information').css({
            "display": "block"
        });
    }else {
        $('.sales-information').css({
            "display": "none"
        });
        $('.sales-information__input').val('');
    }
    if($(".rental-checkbox").prop('checked') == true){
        $('.rental-information').css({
            "display": "block"
        });
    }else {
        $('.rental-information').css({
            "display": "none"
        });
        $('.rental-information__input').val('');
    }
    if($(".barter-checkbox").prop('checked') == true){
        $('.barter-information').css({
            "display": "block"
        });
    }else {
        $('.barter-information').css({
            "display": "none"
        });
        $('.barter-information__input').val('');
    }

    $(".sale-checkbox").on('change', function () {
        if ($(this).is(':checked')) {
           
            $('.sales-information').css({
                "display": "block"
            });
        } else {
           
            $('.sales-information').css({
                "display": "none"
            });

            $('.sales-information__input').val('');
        }
    });
    $(".rental-checkbox").on('change', function () {
        if ($(this).is(':checked')) {
           
            $('.rental-information').css({
                "display": "block"
            });
        } else {
          
            $('.rental-information').css({
                "display": "none"
            });
            $('.rental-information__input').val('');
        }
    });

    $(".barter-checkbox").on('change', function () {
        if ($(this).is(':checked')) {
          
            $('.barter-information').css({
                "display": "block"
            });
        } else {
           
            $('.barter-information').css({
                "display": "none"
            });
            $('.barter-information__input').val('');
            $('.barter-information').find('input:radio').prop('checked', false);
        }
    });

    $("input[type='radio'][name='radio']").on('change', function () {
       let barterDataID = $(this).attr('data-id');
        if ($(this).is(':checked') && barterDataID == 'on-equal-terms') {
            $('.barter-information__input').css({
                "display": "none"
            });
        } else if ($(this).is(':checked') && barterDataID == 'on-money-terms') {
            $('.barter-information__input').css({
                "display": "block"
            });
        }
    });

    $(document).ready(function () {
        $('.advert-platform').select2({
            placeholder: "Platforma",
        });

        $('.advert-platform').on('change', function () {
            $('.advert-platform-hidden').val($(this).val());
        });

        $('.advert-category').select2({
            placeholder: "Kateqoriya",

        });
        $('.advert-category').on('change', function () {
            $('.advert-category-hidden').val($(this).val());
        });
        $('.advert-city').select2({
            placeholder: "Şəhər",

        });
        $('.advert-city').on('change', function () {
            $('.advert-city-hidden').val($(this).val());
        });
        $('.advert-rental-time').select2({
            placeholder: "İcarə müddəti",

        });
        $('.advert-rental-time').on('change', function () {
            $('.advert-rental-time-hidden').val($(this).val());
        });

        $('.discussion__category').select2({
            placeholder: "Kateqoriya seçin",

        });
        $('.discussion__category').on('change', function () {
            $('.discussion__category-hidden').val($(this).val());
        });
    });



});
$('.category-genre').on('change', function () {
    $('.category-genre-hidden').val($(this).val());
});

$('.category-genre').select2({
    placeholder: "JANR SEÇİN",

});
$('.category-platform').on('change', function () {
    $('.category-platform-hidden').val($(this).val());
});

$('.category-platform').select2({
    placeholder: "PLATFORMA SEÇİN",

});
$('.category-sort').on('change', function () {
    $('.category-sort-hidden').val($(this).val());
});

$('.category-sort').select2({
    placeholder: "SIRALAMA",

});
// $('.select2-selection').addClass('myDrop--2');
CKEDITOR.replace( 'discussionEditor' );
// Start upload preview image

var $uploadCrop,
	tempFilename,
	rawImg,
	imageId;

function readFile1(input5) {
	if (input5.files && input5.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('.upload-demo').addClass('ready');
			$('#cropImagePop').modal('show');
			rawImg = e.target.result;
		}
		reader.readAsDataURL(input5.files[0]);
	} else {
		swal("Sorry - you're browser doesn't support the FileReader API");
	}
}

$uploadCrop = $('#upload-demo').croppie({
	viewport: {
		width: 128,
		height: 128,
		borderRadius: '50%'
	},
	enforceBoundary: false,
	enableExif: true
});
$('#cropImagePop').on('shown.bs.modal', function () {
	// alert('Shown pop');
	$uploadCrop.croppie('bind', {
		url: rawImg
	}).then(function () {
		console.log('jQuery bind complete');
	});
});

$('.item-img').on('change', function () {
	imageId = $(this).data('id');
	tempFilename = $(this).val();
	$('#cancelCropBtn').data('id', imageId);
	readFile1(this);
});
$('#cropImageBtn').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'base64',
		format: 'jpeg',
		size: {
			width: 150,
			height: 200
		}
	}).then(function (resp) {
		$('#item-img-output').attr('src', resp);
		$('#cropImagePop').modal('hide');
	});
});
// End upload preview image


// CROP BACKGROUND IMAGE

// Start upload preview image

var $uploadCropBG,
	tempFilenameBG,
	rawImgBG,
	imageIdBG;

function readFile2(input6) {
	if (input6.files && input6.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('.upload-demoBG').addClass('ready');
			$('#cropImagePopBG').modal('show');
			rawImgBG = e.target.result;
		}
		reader.readAsDataURL(input6.files[0]);
	} else {
		swal("Sorry - you're browser doesn't support the FileReader API");
	}
}

$uploadCropBG = $('#upload-demoBG').croppie({
	viewport: {
		width: '100%',
		height: 300,
	
	},
	enforceBoundary: false,
	enableExif: true
});
$('#cropImagePopBG').on('shown.bs.modal', function () {
	// alert('Shown pop');
	$uploadCropBG.croppie('bind', {
		url: rawImgBG
	}).then(function () {
		console.log('jQuery bind complete');
	});
});

$('.item-imgBG').on('change', function () {
	imageIdBG = $(this).data('id');
	tempFilenameBG = $(this).val();
	$('#cancelCropBtn').data('id', imageIdBG);
	readFile2(this);
});
$('#cropImageBtnBG').on('click', function (ev) {
	$uploadCropBG.croppie('result', {
		type: 'base64',
		format: 'jpeg',
		size: {
			width: 553,
			height: 150
		}
	}).then(function (respBG) {
		$('#item-img-outputBG').attr('src', respBG);
		$('#cropImagePopBG').modal('hide');
	});
});
// End upload preview image
$(document).ready(function(){        
    //для контейнера с id #IDhtmlcont - 
    Dropzone.options.IDhtmlcont = {
      paramName: "file", // имя переменной, используемой для передачи файлов
      maxFilesize: 2, // лимит размера файла в МБ
      parallelUploads: 1, //кол-во параллельных обращений к серверу
      maxFiles: 10, //макс. число файлов в данном контейнере
      accept: function(file, done) {
        //произвольная функция проверки загружаемых файлов
        if (file.type == "image/png") {
          //сообщение без ошибки, если файл забракован
          done("I don`t accept PNGs.");
        }
        //чтобы файл был принят, нужно вызвать done без параметров
        else { done(); }
      }
    };
});



$( document ).ready(function() {
    $("#bd").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        disableMobile: "true"
    });
});
$( ".forum-inner__btn" ).click(function() {
    $( ".forum-inner__discuss" ).slideToggle( "slow", function() {
      // Animation complete.
    });
  });
$(document).ready(function () {
    $("#forumDiscussInput").bind("keyup", function() {
        var text = $(this).val().toLowerCase();
        var items = $(".forum__discuss--topic");
    
        //first, hide all:
        items.parent().parent().hide();
    
        //show only those matching user input:
        items.filter(function () {
            return $(this).text().toLowerCase().indexOf(text) > -1;
        }).parent().parent().show();
    });
});


$(document).ready(function(){
    $('.main__carousel').owlCarousel({
        loop:true,
        dotsContainer: '#carousel-custom-dots',
        navContainer:'#carousel-custom-nav',
        navText : ['ƏVVƏLKİ','SONRAKI'],
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            768:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
  });

  $(document).ready(function() {
    $(".myOwl__dot").click(function () {
        $(".myOwl__dot").removeClass("myOwl__dot--active");
        $(this).addClass("myOwl__dot--active");   
    });
 });

// $(document).ready(function () {
//     $('.registr-form').parsley().on('field:validated', function () {
//             var ok = $('.parsley-error').length === 0;
//             $('.bs-callout-info').toggleClass('hidden', !ok);
//             $('.bs-callout-warning').toggleClass('hidden', ok);
//         })
//         .on('form:submit', function () {
//             return false; // Don't submit form for this demo
//         });
// });
$( document ).ready(function() {
   // Ripple-effect animation
(function($) {
    $(".ripple-effect").click(function(e){
        var rippler = $(this);

        // create .ink element if it doesn't exist
        if(rippler.find(".ink").length == 0) {
            rippler.append("<span class='ink'></span>");
        }

        var ink = rippler.find(".ink");

        // prevent quick double clicks
        ink.removeClass("animate");

        // set .ink diametr
        if(!ink.height() && !ink.width())
        {
            var d = Math.max(rippler.outerWidth(), rippler.outerHeight());
            ink.css({height: d, width: d});
        }

        // get click coordinates
        var x = e.pageX - rippler.offset().left - ink.width()/2;
        var y = e.pageY - rippler.offset().top - ink.height()/2;

        // set .ink position and add class .animate
        ink.css({
          top: y+'px',
          left:x+'px'
        }).addClass("animate");
    })
})(jQuery);
});

 $(document).ready(function() {
    //  MY PROFİLE .HTML
        
        var readURL3 = function(input3) {
            if (input3.files && input3.files[0]) {
                var reader3 = new FileReader();
    
                reader3.onload = function (e) {
                    $('.profile-pic').attr('src', e.target.result);
                }
        
                reader3.readAsDataURL(input3.files[0]);
            }
        }
        
    
        $(".file-upload").on('change', function(){
            readURL3(this);
        });
        
        $(".upload-button").on('click', function() {
           $(".file-upload").click();
        });
    
        var readURL = function(input4) {
            if (input4.files && input4.files[0]) {
                var reader4 = new FileReader();
    
                reader4.onload = function (e) {
                    $('.bg-pic').attr('src', e.target.result);
                }
        
                reader4.readAsDataURL(input4.files[0]);
            }
        }
        
    
        $(".file-upload-1").on('change', function(){
            readURL(this);
        });
        
        $(".upload-button-1").on('click', function() {
           $(".file-upload-1").click();
        });
        
    
    });
$(document).ready(function() {
    function readURL(input1) {

        if (input1.files && input1.files[0]) {

            var reader = new FileReader();
            reader.onload = function (e) {
                $('.myFileInp__img-1').attr('src', e.target.result);
                $(".myFileInp__img-1").css("opacity", "1");
                $(".myFileInp__img-1").prev().css("opacity", "0");
            }

            reader.readAsDataURL(input1.files[0]);

        }

    }
    $("#profile-img-1").change(function(){
        readURL(this);
    });

    function readURL2(input2) {

        if (input2.files && input2.files[0]) {

            var reader2 = new FileReader();
            reader2.onload = function (e) {
                $('.myFileInp__img-2').attr('src', e.target.result);
                $(".myFileInp__img-2").css("opacity", "1");
                $(".myFileInp__img-2").prev().css("opacity", "0");
            }

            reader2.readAsDataURL(input2.files[0]);

        }

    }
    $("#profile-img-2").change(function(){
        readURL2(this);
    });

   


 });
$(document).ready(function () {
    // $('.without-registration-btn').click(function () {
    //     $('.personal-information-box').slideDown(1000);

    // });

    // $('.with-registration-btn').click(function () {
    //     $('.personal-information-box').slideUp(1000);
    // });

    if($(".user-sale-checkbox").prop('checked') == true){
        $('.sales-information').css({
            "display": "block"
        });
    }else {
        $('.user-sales-information').css({
            "display": "none"
        });
       
    }
    if($(".user-rental-checkbox").prop('checked') == true){
        $('.user-rental-information').css({
            "display": "block"
        });
    }else {
        $('.user-rental-information').css({
            "display": "none"
        });
      
    }
    if($(".user-barter-checkbox").prop('checked') == true){
        $('.barter-information').css({
            "display": "block"
        });
    }else {
        $('.user-barter-information').css({
            "display": "none"
        });
    }

    $(".user-sale-checkbox").on('change', function () {
        if ($(this).is(':checked')) {
           
            $('.user-sales-information').css({
                "display": "block"
            });
        } else {
           
            $('.user-sales-information').css({
                "display": "none"
            });

          
        }
    });
    $(".user-rental-checkbox").on('change', function () {
        if ($(this).is(':checked')) {
           
            $('.user-rental-information').css({
                "display": "block"
            });
        } else {
          
            $('.user-rental-information').css({
                "display": "none"
            });
         
        }
    });

    $(".user-barter-checkbox").on('change', function () {
        if ($(this).is(':checked')) {
          
            $('.user-barter-information').css({
                "display": "block"
            });
        } else {
           
            $('.user-barter-information').css({
                "display": "none"
            });
            // $('.user-barter-information').find('input:radio').prop('checked', false);
        }
    });

    // var radios = document.getElementsByName("barter-radio");
    // var val = localStorage.getItem('barter-radio');
    // for(var i=0;i<radios.length;i++){
    //   if(radios[i].value == val){
    //     radios[i].checked = true;
    //   }
    // }

    $("input[type='radio'][name='barter-radio']").on('change', function () {
       let barterDataID = $(this).attr('data-id');
        if ($(this).is(':checked') && barterDataID == 'on-equal-terms') {
            $('.user-barter-information__input').css({
                "display": "none"
            });
        } else if ($(this).is(':checked') && barterDataID == 'on-money-terms') {
            $('.user-barter-information__input').css({
                "display": "block"
            });
        }

       
    });
  

  


});
