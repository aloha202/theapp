/**
 * Created by alexradyuk on 12/7/19.
 */

// $content.append('hello');

var recognition = null;
var RECOGNITION_STARTED = false;
try {
    if(window.speechSynthesis.getVoices().length == 0) {
        window.speechSynthesis.addEventListener('voiceschanged', function() {

        });
    }

    var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    recognition = new SpeechRecognition();
    recognition.onresult = function (event) {

        var current = event.resultIndex;

        // Get a transcript of what was said.
        var transcript = event.results[current][0].transcript;

        $('.dw-sbi').val(transcript);
        $('.dw-sbi').focus();
        $('.dw-sbi').css('background-color', 'white');
    };

    recognition.onstart = function () {
        $('.dw-sbi').css('background-color', 'lightgrey');
    };
} catch(e) {
    console.error(e);

}

// $('.vmod span').css('border', 'solid 1px red');

function textToSpeech(message) {
    // get all voices that browser offers
    var available_voices = window.speechSynthesis.getVoices();

    // this will hold an english voice

    var    english_voice = available_voices[29];

    // new SpeechSynthesisUtterance object
    var utter = new SpeechSynthesisUtterance();
    utter.rate = 1;
    utter.pitch = 1;
    utter.text = message;
    utter.voice = english_voice;

    // event after text has been spoken
    utter.onend = function() {
        // alert('Speech has finished');
    }

    // speak
    window.speechSynthesis.speak(utter);
}


function readAll() {
    $(theActiveSpans).each(function () {
       textToSpeech(this.innerText);
        textPause();
    });
}

function selectText(node) {

    if (document.body.createTextRange) {
        const range = document.body.createTextRange();
        range.moveToElementText(node);
        range.select();
    } else if (window.getSelection) {
        const selection = window.getSelection();
        const range = document.createRange();
        range.selectNodeContents(node);
        selection.removeAllRanges();
        selection.addRange(range);
    } else {
        console.warn("Could not select text in node: Unsupported browser.");
    }
}

function highlightSpan(span, e) {
    if(!span){
        console.log('the Span is undefined');
        return;
    }
    $(theActiveSpans).each(function () {
        this._selected = false;
    });
    span._selected = true;
    selectText(span.firstChild);
    if(e){
        e.preventDefault();
    }
}

var theSpans = [];
var theActiveSpans = [];
setInterval(function () {

    theSpans = [];
    $('.XpoqFe span').each(function () {
       if($(this).parent().data('dobid') == 'dfn'){
           if(!$(this).hasClass('span-initialized')) {
               $(this).addClass('span-initialized');
               theSpans.push(this);

               if(this.parentNode.nextSibling){
                   if(this.parentNode.nextSibling.className == 'vmod'){
                       if($(this.parentNode.nextSibling).find('.vk_gy').length){
                           var regex = /(<([^>]+)>)/ig;
                           var div = $(this.parentNode.nextSibling).find('.vk_gy').get(0);
                           div.innerHTML = div.innerHTML.replace(regex, "");
                           theSpans.push(div);
                       }
                   }
               }
           }
       }
    });

    if(theSpans.length) {
        theActiveSpans = [];
        $(theSpans).each(function () {
           // $(this).css('border', 'solid 1px red');
            $(this).click(function () {
                highlightSpan(this);
            });
            theActiveSpans.push(this);
        });
    }


}, 1000);


$(document).keyup(function (e) {

    if(e.keyCode == 18){
      //  readAll();
    }
});

$(document).keydown(function (e) {


    if(e.keyCode == 17){//ctrl key
        if(!RECOGNITION_STARTED){
            recognition.start();
            RECOGNITION_STARTED = true;
            e.preventDefault();
        }
    }
    if(e.keyCode == 32) {//space key
        if(RECOGNITION_STARTED){
            recognition.stop();
            RECOGNITION_STARTED = false;
            e.preventDefault();
        }
    }

    if(e.keyCode == 40){//down
        var next = false;
        var found = false;
        $(theActiveSpans).each(function () {
            if(this._selected){
                next = true;
            }else{
                if(next) {
                    found = true;
                    highlightSpan(this, e);
                    next = false;
                }
            }
        });
        if(!found){
            if(theActiveSpans.length) {
                highlightSpan(theActiveSpans[0], e);
            }
        }
    }else if(e.keyCode == 38){//up
        var previous = false;
        $(theActiveSpans).each(function () {
            if(this._selected){
                if(previous){
                    highlightSpan(previous, e);
                }
            }else{
                previous = this;
            }
        })
    }


});

