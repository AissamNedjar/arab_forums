/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  Mobile : +213771381373                                               |

|  skype phone : attaf.algeria                                          |

|  facebook : facebook.com/aissam.nedjar.43                             |

|  site : www.prince-algeria.com  || www.arab-forums-sc.com             |

|            آخر تعديل : 18-03-2016 بواسطة : Aissam Nedjar              |

|*#####################################################################*/

function message(x){bo = document.getElementsByTagName('body');bo[0].style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=40)";bo[0].style.opacity = "0.4";if (confirm(x)){document.dolog.submit();return true;}else{bo[0].style.filter = "";bo[0].style.opacity = "";return false;}}

function montre(id){var d = document.getElementById(id);if(d.style.display=='none'){d.style.display = '';}else{d.style.display = 'none';}}

function relext(s){top.location.href = s.options[s.selectedIndex].value + "&re=" + escape(location.href);return 1;}

function getst(s){top.location.href = s.options[s.selectedIndex].value;return 1;}

function check1(s , id , name , tit1 , stylel){var tr = document.getElementById('tr_'+id);var frm = s.form;var el = frm.elements;var y = 0;var x = 0;while(x < el.length){if (el[x].type == "checkbox" && el[x].name != "chk_all" && el[x].checked){y = y + 1;}++x;}if(s.checked == true){tr.className = ""+stylel+"";s.title = "إلغاء تحديد "+tit1+"";}else{tr.className = name;s.title = "تحديد "+tit1+"";}return;}

var check = false;function check2(frm , s , tit1 , tit2 , tit3 , tit4 , tit5 , stylel){var el = frm.elements;if (!check){var y = 0;for(x = 0; x < el.length; ++x){el[x].checked = true;if(el[x].type == "checkbox" && el[x].name != "chk_all"){y = y + 1;var name = document.getElementById("bg_"+el[x].value).value;check1(el[x], el[x].value, name , tit5 , stylel);}}check = true;if (y > 0){alert(""+tit4+" "+y+"");}else{alert(""+tit3+"");}s.title=tit2;return;}else{for(x = 0; x < el.length; ++x){el[x].checked = false;if (el[x].type == "checkbox" && el[x].name != "chk_all"){var name = document.getElementById("bg_"+el[x].value).value;check1(el[x], el[x].value, name , tit5 , stylel);}}check = false;s.title=tit1;return;}}

this.title = function(){
		xOffset = 60;
		yOffset = -40;
	$(".title").hover(function(e){
		this.t = this.title;
		this.title = "";
		$("body").append("<p id='title'>"+ this.t +"</p>");
		$("#title")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");
    },
	function(){
		this.title = this.t;
		$("#title").remove();
    });
	$(".title").mousemove(function(e){
		$("#title")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});
};
$(document).ready(function(){
	title();
});

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  Mobile : +213771381373                                               |

|  skype phone : attaf.algeria                                          |

|  facebook : facebook.com/aissam.nedjar.43                             |

|  site : www.prince-algeria.com  || www.arab-forums-sc.com             |

|            آخر تعديل : 18-03-2016 بواسطة : Aissam Nedjar              |

|*#####################################################################*/