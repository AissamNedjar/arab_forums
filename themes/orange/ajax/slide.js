/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

$(document).ready(function() {

$("#foo4").carouFredSel({
	circular	: false,
	infinite	: true,
    auto: {pauseDuration: 3000, delay: 750},
    scroll: {fx: "fade"},
	items: { pauseOnHover: true },
	prev : {
		button		: "#foo4_prev",
		key			: "left",
		items		: 4,
		easing		: "easeInOutCubic",
		duration	: 2500,
		pauseOnHover: true
	},
	next : {
		button		: "#foo4_next",
		key			: "right",
		items		: 4,
		easing		: "easeInQuart",
		duration	: 1500,
		pauseOnHover: true
	},
	pagination : {
		container	: "#foo4_pag",
		keys		: true,
		easing		: "easeOutBounce",
		duration	: 3000,
		pauseOnHover: true
	}
});
            $('.preview-fade').each(function() {
                $(this).hover(
                    function() {
                        $(this).stop().animate({ opacity: 0.5 }, 400);
                    },
                   function() {
                       $(this).stop().animate({ opacity: 1.0 }, 400);
                   })
            });



	
});

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/