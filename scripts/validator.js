function htmlfilenamecheck(ele){
	if(ele.value.indexOf(' ') >= 0 || emptycheck(ele)){
		errorclass(ele, 'add', 'error');
	}else if(ele.value.charAt(0) >=0 && ele.value.charAt(0) <= 9){
		errorclass(ele, 'add', 'error');
	}else{
		errorclass(ele, 'remove', 'error');
	}
}

function csscolorhexcheck(ele){
	if(ele.value.indexOf('#') >= 0){
		errorclass(ele, 'add', 'error');
	}else if(ele.value.length > 6){
		errorclass(ele, 'add', 'error');
	}else if (!/^([A-G0-9])/.test(ele.value)) {
		errorclass(ele, 'add', 'error');
	}else{
		errorclass(ele, 'remove', 'error');
	}
}

function emptycheck(ele){
	if(ele.value.length>0){
		errorclass(ele, 'remove', 'error');
		return false;
	}else{
		errorclass(ele, 'add', 'error');
		return true;
	}
}

function errorclass(ele, val, class_){
	if(val=='add'){
		if(!ele.classList.contains(class_)){
			ele.classList.add(class_);
		}
	}else{
		if(ele.classList.contains(class_)){
			ele.classList.remove(class_);
		}
	}
}
/*
document.getElementById("MyElement").classList.add('MyClass');

document.getElementById("MyElement").classList.remove('MyClass');

if ( document.getElementById("MyElement").classList.contains('MyClass') )

document.getElementById("MyElement").classList.toggle('MyClass');
*/