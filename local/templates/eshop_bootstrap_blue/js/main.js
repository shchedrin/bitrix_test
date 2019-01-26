var ErrorText = {'start':'','text':'','end':''};
var BeforeChars = 50;
var AfterChars = 50;

function getSelectedText(){
    var str_select,text_end,_end,_start,text_start;
    if(window.getSelection){
        str_select=window.getSelection();
    }
    else if (document.getSelection){
        str_select=document.getSelection();
    }
    else if(document.selection){
        str_select=document.selection;
    }

    if(str_select.getRangeAt){
        if(document.getSelection()){
            _select=document.getSelection();
        }
        else if (window.getSelection()){
            _select=window.getSelection();
        }
        _select=_select.toString();
        _start=document.createRange();
        _start.setStartBefore(str_select.getRangeAt(0).startContainer);
        _start.setEnd(str_select.getRangeAt(0).startContainer,str_select.getRangeAt(0).startOffset);
        text_start=_start.toString();

        //end text
        _end=str_select.getRangeAt(0).cloneRange();
        _end.setStart(str_select.getRangeAt(0).endContainer,str_select.getRangeAt(0).endOffset);
        _end.setEndAfter(str_select.getRangeAt(0).endContainer);
        text_end=_end.toString();
        text_start=text_start.substr(text_start.length-BeforeChars,text_start.length);
        text_end=text_end.substr(0,AfterChars);
        //start text
    }

    if(str_select.createRange){
        _select=str_select.createRange().text;
        //start text
        _start=str_select.createRange();
        _start.moveStart("character",-BeforeChars);
        _start.moveEnd("character",-_select.length);
        text_start=_start.text;

        //end test
        _end=str_select.createRange();
        _end.moveStart("character",_select.length);
        _end.moveEnd("character",AfterChars);
        text_end=_end.text;
        document.selection.empty();
    }

    if(!_select.length){
        return false;
    }
    if(_select.length>250){
        return false;
    }
    ErrorText.start=text_start;
    ErrorText.text=_select;
    ErrorText.end=text_end;

}
$(document).keypress(function (e) {
    if ((e.ctrlKey || e.metaKey) && (e.keyCode == 13 || e.keyCode == 10)){
        if(getSelectedText() !== false){
            $('#error-modal .success').fadeOut();
            $('#error-modal .form').fadeIn();

            $('#error-modal #error-text').val(ErrorText.text);
            $('#error-modal #error-body').val(ErrorText.start+ErrorText.text+ErrorText.end);
            $('#error-modal p.error-body').html(ErrorText.start+'<span class="red">'+ErrorText.text+'</span>'+ErrorText.end);
            $('#error-modal').modal();
        }
    }
});
$(document).on('click', 'button#send-error', function () {
    $.ajax({
       type: 'post',
       url: '/find-error.php',
       data: $('#find-error-form').serialize(),
            success: function (msg) {
                // alert(msg)
                $('#error-modal .success').fadeIn();
                $('#error-modal .form').fadeOut();
            }
    });
});