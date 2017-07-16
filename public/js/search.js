	function searchToggle(obj, evt){
		var container = $(obj).closest('.search-wrapper');
		if(!container.hasClass('active')){
			  container.addClass('active');
			  evt.preventDefault();
		}
		else if(container.hasClass('active') && $(obj).closest('.input-holder').length == 0){
			  container.removeClass('active');
			  // clear input
			  container.find('.search-input').val('');
			  // clear and hide result container when we press close
			  container.find('.result-container').fadeOut(100, function(){$(this).empty();});
		}
	}
	function submitFn(obj, evt){
		value = $(obj).find('.search-input').val().trim();
		_html = "请填写关键词";
		if(!value.length){
                        $(obj).find('.result-container').html('<span>' + _html + '</span>');
                        $(obj).find('.result-container').fadeIn(100);
		}
		else{
                    key = value;
                    location.href='./index.php?keywords='+key;
		}
		evt.preventDefault();
	}