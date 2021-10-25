var bAutostart=true;
var autoStart1;
var autoStart3;

function ADTab(num){
	if( !bAutostart)
		{
			clearTimeout(autoStart1);
			clearTimeout(autoStart3);
		}
        var a3 = document.getElementById('AD3');
         var a1 = document.getElementById('AD1');
		var m1 = document.getElementById('M1');
		var m3 = document.getElementById('M3');
			m1.className="adnav1";
			m3.className="adnav3";
		
		if(num==1){
		a1.style.display = "block";
		a3.style.display = "none";
		m1.className="nowLi";
		}
		if(num==3){
		a3.style.display = "block";
		a1.style.display = "none";
		m3.className="nowLi";
		}
}
window.onload=function(){
autoStart3=setTimeout("ADTab(3)", 1500);
autoStart1=setTimeout("ADTab(1)", 3000);
}

