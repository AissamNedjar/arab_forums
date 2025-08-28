/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

function showTextLength(frm){
	if(DMEditor.setting.editorMode!="HTML"){
		var c=updateTextLength(frm,1),txt="حجم النص الحالي: "+DMEditor.getContent(true);
		if(maxSize>0) txt+="\r\n\r\nالحجم الأقصى المسموح بك‌: "+maxSize;
		if(DMEditor.getContent(true)>maxSize) txt+="\r\n\r\nحجم النص أكبر من المساحة المخصصة لك - الرجاء التقليل من النص";
		confirm(txt);
	}
}
function updateTextLength(frm,mode){
	var status=$I('#status'),result=0,hide=false;
	if(DMEditor.setting.editorMode=="HTML"){
		status.value="H T M L";
	}
	else{
		var c=DMEditor.getContent();
		result=c;
		if(mode==0&&hide) return -1;
		if(c>=0){
			status.value='حجم النص الحالي';
			hide=true;
			return c;
		}
		else if(maxSize==0){
			status.value="حجم النص الحالي: "+DMEditor.getContent(true);
		}
		else{
			status.value=DMEditor.getContent(true)+" / "+maxSize;
		}
	}
	var tmr=600;
	if(result<1000) tmr=1000;
	else if(result<2000) tmr=2000;
	else if(result<5000) tmr=3500;
	setTimeout('updateTextLength(0,0)',tmr);
	return result;
}
function setContent(frm){
 	if(DMEditor){
		var message = DMEditor.getContent(), types = ['newtopic' , 'edittopic' , 'sendmsg' , 'replymsg'];
		if(DMEditor.setting.editorMode == "HTML"){
			alert("HTML الرجاء الغاء خاصية اظهار");
		}
		else if(types.inArray(type) && frm.title.value.trim().length == 0){
			alert("لا يمكنك إدخال الموضوع بدون عنوان");
		}
		else if(message == '' || message.toLowerCase() == '<p>&nbsp;</p>' || message.toLowerCase() == '<p></p>'){
			alert("لا يمكنك إدخال النص بدون محتويات");
		}
		else if(message.length > maxSize){
			alert("حجم النص أكبر من المساحة المخصصة لك - الرجاء التقليل من النص");
		}
		else{
			if(confirm("هل أنت متأكد من أنك تريد إدخال النص‌ ؟")){
				frm.message.value = message;
				exitPage = true;
				frm.submit();
			}
		}
	}
}

function beforeUnload(e){
 	e = e || window.event;
	if(!exitPage && DMEditor && DMEditor.getContent().length > 0){
		e.returnValue="الذهاب الى صفحة أخرى سيخسر النص الجديد الذي ادخلته\r\n\r\n هل أنت متأكد من رغبتك في الذهاب الى صفحة أخرى ؟";
	}
}
function chkReset(url){
	if(confirm("هل أنت متأكد أنك تريد إعادة النص الأصلي ؟")){
		exitPage = true;
		window.location=url;
	}
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/