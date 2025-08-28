/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

function message(x){bo = document.getElementsByTagName('body');bo[0].style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=40)";bo[0].style.opacity = "0.4";if (confirm(x)){document.dolog.submit();return true;}else{bo[0].style.filter = "";bo[0].style.opacity = "";return false;}}

function relext(s){top.location.href = s.options[s.selectedIndex].value + "&re=" + escape(location.href);return 1;}

function getst(s){top.location.href = s.options[s.selectedIndex].value;return 1;}

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

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/