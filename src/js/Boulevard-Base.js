var IMAGES = "wp-content/themes/Boulevard/src/images";
var THEMEROOT = "/wp-content/themes/Boulevard";
var joinUsUrl = THEMEROOT + '/JoinUs.php';
var requestProjUrl = THEMEROOT + '/RequestProject.php';

//Sidr hook-ups
$(document).ready(function () {
    window.onscroll = function(){
        var navBar = document.getElementById('header-nav');
        if(navBar != undefined || navBar != null) {
            navBar.style.top = $(window).scrollTop() + 'px';
        }
    }

    $('#sideMenuButton, #headerMenuButton').sidr({ // The main sidr button on every page
        name: 'sideMenu',
        source: '#navigation',
        side: 'right'
    });

    $('#sidr-id-exitButton').sidr({ // Exit button on every sidr panel
        name: 'sideMenu',
        side: 'right',
        openType: 'custom'
    });

    $('#sidr-id-careersMenuButton, #join-team-link').sidr({ // Hookup for the careers panel
        name: 'careersMenu',
        secondaryMenuName: 'careersMenu',
        source: joinUsUrl,
        renaming: false,
        side: 'right'
    });

    $('#sidr-id-requestMenuButton, #project-request-forward, #request-proj-menu').sidr({ // Hookup for the request panel from sidr, forward button on projects page and request from index front page
        name: 'requestMenu',
        secondaryMenuName: 'careersMenu',
        source: requestProjUrl,
        renaming: false,
        side: 'right'
    });

    //Social Icon fade effects
    //Set the anchor link opacity to 0 and begin hover function
    $("#sidr-id-content #sidr-id-socialIcons li a, .contact-us li a").css({ "opacity": 0 }).hover(function () {

        //Fade to an opacity of 1 at a speed of 200ms
        $(this).stop().animate({ "opacity": 1 }, 200);

        //On mouse-off
    }, function () {

        //Fade to an opacity of 0 at a speed of 100ms
        $(this).stop().animate({ "opacity": 0 }, 100);
    });

    //Social icon fade effect for page footers
    $("footer #socialIcons li a").css({ "opacity": 0 }).hover(function () {

        //Fade to an opacity of 1 at a speed of 200ms
        $(this).stop().animate({ "opacity": 1 }, 200);

    //On mouse-off
    }, function () {

        //Fade to an opacity of 0 at a speed of 100ms
        $(this).stop().animate({ "opacity": 0 }, 100);

    });

    //Social icon fade effect for the drop down header
    $("#header-nav #socialIcons li a").css({ "opacity": 0 }).hover(function () {

        //Fade to an opacity of 1 at a speed of 200ms
        $(this).stop().animate({ "opacity": 1 }, 200);

    //On mouse-off
    }, function () {

        //Fade to an opacity of 0 at a speed of 100ms
        $(this).stop().animate({ "opacity": 0 }, 100);

    });

    // Shows correct checkmark icon on request projects page *** Now inlined on the RequestProject.php page ***
    /*function ShowCheck(object) {
        if (object.checked) {
            var label = object.parentNode;
            $(label).css("background-position", "0px -48px");
        }
        else {
            var label = object.parentNode;
            $(label).css("background-position", "0px 0px");
        }
    }*/

    //INDEX PAGE

    //This is now in the index page in order to take advantage of php variables
    /*$(".link-with-icon").mouseover(function () {
        var img = this.getElementsByTagName("img")[0]; // Get child img element of the object that triggered the event (using the 'this' keyword)
        img.setAttribute("src", IMAGES + "/ArrowGlyphWhite.png");       
    });
    $(".link-with-icon").mouseout(function () {
        var img = this.getElementsByTagName("img")[0]; // Get child img element of the object that triggered the event (using the 'this' keyword)
        img.setAttribute("src", IMAGES + "/ArrowGlyph.png");
    });*/

    //PROJECTS PAGE 
    
    $(window).resize(function () {
        //var elementWidth = $(".resize").width();
        //var elementWidth = document.getElementsByClassName(".resize")[0].clientWidth;
        //$(".resize").css("height", elementWidth);
        //console.log("Width: " + elementWidth);
        });
        $(window).load(function (e) {
            $(window).trigger('resize');
            console.log("Resizing");
    });

    $('.image').hover(function () {
        $(this).find('.decZ-index').css("z-index", "0");
        $(this).find('.border').css("z-index", "1");
        $(this).find('.border').stop().animate({ 
            opacity: 1,
            top: '0px',
            left: '0px',
            bottom: '0px',
            right: '0px'

    })
    }, function () {
        $('.border').stop().animate({
            opacity: 0,
            top: '-10px',
            left: '-10px',
            right: '-10px',
            bottom: '-10px'
    }, function () {
        //Complete
        });
    });

    //Header drop down nav bar hide/show script
    $("#header-nav").hide();
        $(window).scroll(function () {
        if ($(window).scrollTop() > $("#header").height()) { /* - $(".sectionFooter").height()*/
            $("#header-nav").slideDown("slow");
        }
        else {
            $("#header-nav").fadeOut("slow");
        }
    });

    // Page fade to colour on scroll effect

    $(window).scroll(function () {
        if(document.getElementById('downArrowPos')) { // Check to see if this page has a slide that fades out on scroll
            var opacity = $(document).scrollTop() / $("#downArrowPos").offset().top;
            $(".slide-fade-effect").css("opacity", opacity);
            var textOpacity = $("#downArrowPos").offset().top / (630 + ($(document).scrollTop() * 6));
            $(".down-arrow").css("opacity", textOpacity);
        }
    });

});

//Create an http request object for ajax
function CreateRequest() {
    try {
        request = new XMLHttpRequest();
    } catch (tryMS) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (otherMS) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (failed) {
                request = null;
            }
        }
    }
    return request;
}

var requestObject;
var fileUploadComplete = false;
function ShowSendStatusMessage(){
    console.log("Ready state: " + requestObject.readyState);
    console.log("Status: " + requestObject.status);
    if (requestObject.readyState == 4) {
        if (requestObject.status == 200) {
            if(fileUploadComplete){
                console.log("Thank you for submitting your application");
                document.getElementById(globalUniqueName + '-name').value = '';
                document.getElementById(globalUniqueName + '-email').value = '';
                document.getElementById(globalUniqueName + '-phone').value = '';
                document.getElementById(globalUniqueName + '-message').value = '';
                document.getElementById(globalUniqueName + '-upload').value = '';
                ClearFormErrors();
                var pElement = document.createElement("p");
                var pText = document.createTextNode("Thank you, we have received your application and will be in touch.");
                pElement.appendChild(pText);
                pElement.setAttribute('style', 'color: green;');
                document.getElementById(globalUniqueName + '-thankyou-message').appendChild(pElement);
            }
        }
    }
}

function ClearFormErrors(){
    var parent = document.getElementById(globalUniqueName + '-thankyou-message');
    var childNodes = parent.childNodes;
    for(var i = 0; i < childNodes.length; i++){
        parent.removeChild(childNodes[i]);
    }
}

function RequestClearFormErrors(){
    var parent = document.getElementById('request-thankyou');
    var childNodes = parent.childNodes;
    for(var i = 0; i < childNodes.length; i++){
        parent.removeChild(childNodes[i]);
    }
    var parent = document.getElementById('request-thankyou-bottom');
    var childNodes = parent.childNodes;
    for(var i = 0; i < childNodes.length; i++){
        parent.removeChild(childNodes[i]);
    }
}

function ContactClearFormErrors(){
    var parent = document.getElementById('contact-thankyou');
    var childNodes = parent.childNodes;
    for(var i = 0; i < childNodes.length; i++){
        parent.removeChild(childNodes[i]);
    }
}

function PostFormError(message){
    ClearFormErrors();
    var pElement = document.createElement("p");
    var pText = document.createTextNode(message);
    pElement.appendChild(pText);
    pElement.setAttribute('style', 'color: yellow;');
    document.getElementById(globalUniqueName + '-thankyou-message').appendChild(pElement);
}

function RequestPostFormError(message){
    RequestClearFormErrors();
    var pElement = document.createElement("p");
    var pText = document.createTextNode(message);
    pElement.appendChild(pText);
    pElement.setAttribute('style', 'color: yellow;');
    document.getElementById('request-thankyou').appendChild(pElement);
    var pElement2 = document.createElement("p");
    var pText2 = document.createTextNode(message);
    pElement2.appendChild(pText2);
    pElement2.setAttribute('style', 'color: yellow;');
    document.getElementById('request-thankyou-bottom').appendChild(pElement2);
}

function ContactPostFormErros(message){
    ContactClearFormErrors();
    var pElement = document.createElement("p");
    var pText = document.createTextNode(message);
    pElement.appendChild(pText);
    pElement.setAttribute('style', 'color: red');
    document.getElementById('contact-thankyou').appendChild(pElement);
}

function CleanString(string){ //Original regex /[^\w\s]/gi
    return string.replace(/[^\w\s\.@_:/-]/gi, '');
}

var globalUniqueName;
function SendApplication(unformattedName){
    var uniqueName = unformattedName.replace(" ", "");
    globalUniqueName = uniqueName;

    if(document.getElementById(uniqueName + '-name').value == ''){
        PostFormError("Please fill out the name field");
        return;
    }else if(document.getElementById(uniqueName + '-email').value == ''){
        PostFormError("Please fill out the email field");
        return;
    }else if(document.getElementById(uniqueName + '-phone').value == ''){
        PostFormError("Please fill out the phone number field");
        return;
    }else if(document.getElementById(uniqueName +'-upload').value == ''){
        PostFormError("Please upload your resume");
        return;
    }

    requestObject = CreateRequest();
    var url = "JoinUs.php";
    var file = document.getElementById(uniqueName + '-upload').files[0];

    /*var requestData = "applicantName=" +
        encodeURI(CleanString(document.getElementById(uniqueName + '-name').value)) + "&applicantE-mail=" +
        encodeURI(CleanString(document.getElementById(uniqueName + '-email').value)) + "&applicantPhoneNumber=" +
        encodeURI(CleanString(document.getElementById(uniqueName + '-phone').value)) + "&applicantMessage="+
        encodeURI(CleanString(document.getElementById(uniqueName + '-message').value)) + "&JobTitle=" +
        encodeURI(CleanString(document.getElementById(uniqueName + '-position').value)) + "&submitButton=true" +
        "&honeypotValue=";*/

    //Send an AJAX request to upload the users resume
    var formData = new FormData();
    formData.append('applicantName', CleanString(document.getElementById(uniqueName + '-name').value));
    formData.append('applicantE-mail', CleanString(document.getElementById(uniqueName + '-email').value));
    formData.append('applicantPhoneNumber', CleanString(document.getElementById(uniqueName + '-phone').value));
    formData.append('applicantMessage', CleanString(document.getElementById(uniqueName + '-message').value));
    formData.append('JobTitle', CleanString(document.getElementById(uniqueName + '-position').value));
    formData.append('submitButton', 'true');
    formData.append('honeypotValue', '')
    formData.append('applicantResume', file, document.getElementById(uniqueName +'-upload').files[0].name);
    formData.append('application', 'true');
    $.ajax({
        url: joinUsUrl, //upload.php
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            fileUploadComplete = parseInt(res);
            console.log('PHP upload response: ' + res);
            document.getElementById(globalUniqueName + '-name').value = '';
            document.getElementById(globalUniqueName + '-email').value = '';
            document.getElementById(globalUniqueName + '-phone').value = '';
            document.getElementById(globalUniqueName + '-message').value = '';
            document.getElementById(globalUniqueName + '-upload').value = '';
            ClearFormErrors();
            var pElement = document.createElement("p");
            var pText = document.createTextNode("Thank you, we have received your application and will be in touch.");
            pElement.appendChild(pText);
            pElement.setAttribute('style', 'color: green;');
            document.getElementById(globalUniqueName + '-thankyou-message').appendChild(pElement);
        }
    });

    //Send an AJAX request to send an email to BLVD and to the user
    /*requestObject.onreadystatechange = ShowSendStatusMessage;
    requestObject.open("POST", url, true);
    requestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requestObject.send(requestData);*/
}

function ShowRequestStatus(){
    if(requestObject.readyState == 4){
        if(requestObject.status == 200){
            RequestClearFormErrors();
            document.getElementById('request-name').value = '';
            document.getElementById('request-organization').value = '';
            document.getElementById('request-email').checked = '';
            document.getElementById('request-phone').value = '';
            document.getElementById('request-url').value = '';
            document.getElementById('empRec').checked = false;
            document.getElementById('golfTourn').checked = false;
            document.getElementById('staffUni').checked = false;
            document.getElementById('holEvent').checked = false;
            document.getElementById('tradeGive').checked = false;
            document.getElementById('recruit').checked = false;
            document.getElementById('eventProg').checked = false;
            document.getElementById('wellPromo').checked = false;
            document.getElementById('safeProg').checked = false;
            document.getElementById('teamBuild').checked = false;
            ShowCheck(document.getElementById('empRec'));
            ShowCheck(document.getElementById('golfTourn'));
            ShowCheck(document.getElementById('staffUni'));
            ShowCheck(document.getElementById('holEvent'));
            ShowCheck(document.getElementById('tradeGive'));
            ShowCheck(document.getElementById('recruit'));
            ShowCheck(document.getElementById('eventProg'));
            ShowCheck(document.getElementById('wellPromo'));
            ShowCheck(document.getElementById('safeProg'));
            ShowCheck(document.getElementById('teamBuild'));
            document.getElementById('request-objective-msg').value = '';
            document.getElementById('request-budget').options[0].selected = 'selected';
            document.getElementById('request-timeline').options[0].selected = 'selected';
            var pElement = document.createElement("p");
            var pText = document.createTextNode("Thank you, we have received you request and will get back to you as soon as possible.");
            pElement.appendChild(pText);
            pElement.setAttribute('style', 'color: green;');
            document.getElementById('request-thankyou').appendChild(pElement);
            document.getElementById('request-thankyou-bottom').appendChild(pElement);
        }
    }
}

function SendProjectRequest(){
    if(document.getElementById('request-name').value == ''){
        RequestPostFormError('Please fill out the name field');
        return;
    }else if(document.getElementById('request-organization').value == ''){
        RequestPostFormError('Please fill out the organization field');
        return;
    }else if(document.getElementById('request-email').value == ''){
        RequestPostFormError('Please fill out the email field');
        return;
    }else if(document.getElementById('request-phone').value == ''){
        RequestPostFormError('Please fill out the phone number field');
        return;
    }

    requestObject = CreateRequest();
    var requestUrl = requestProjUrl;
    var requestData = "name=" +
        encodeURI(CleanString(document.getElementById('request-name').value)) + "&organization=" +
        encodeURI(CleanString(document.getElementById('request-organization').value)) + "&e-mail=" +
        encodeURI(CleanString(document.getElementById('request-email').value)) + "&phoneNumber=" +
        encodeURI(CleanString(document.getElementById('request-phone').value)) + "&url=" +
        encodeURI(CleanString(document.getElementById('request-url').value)) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('empRec').checked == true ? document.getElementById('empRec').value : '')) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('golfTourn').checked == true ? document.getElementById('empRec').value : '')) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('staffUni').checked == true ? document.getElementById('staffUni').value : '')) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('holEvent').checked == true ? document.getElementById('holEvent').value : '')) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('tradeGive').checked == true ? document.getElementById('tradeGive').value : '')) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('recruit').checked == true ? document.getElementById('recruit').value : '')) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('eventProg').checked == true ? document.getElementById('eventProg').value : '')) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('wellPromo').checked == true ? document.getElementById('wellPromo').value : '')) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('safeProg').checked == true ? document.getElementById('safeProg').value : '')) + "&services[]=" +
        encodeURI(CleanString(document.getElementById('teamBuild').checked == true ? document.getElementById('teamBuild').value : '')) + "&objective=" +
        encodeURI(CleanString(document.getElementById('request-objective-msg').value)) + "&budget=" +
        encodeURI(CleanString(document.getElementById('request-budget').value)) + "&timeline=" +
        encodeURI(CleanString(document.getElementById('request-timeline').value)) + "&submit=true";
    requestObject.onreadystatechange = ShowRequestStatus;
    requestObject.open("POST", requestUrl, true);
    requestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requestObject.send(requestData);
}

function ShowContactStatus(){
    if(requestObject.readyState == 4){
        if(requestObject.status == 200){
            document.getElementById('contact-name').value = '';
            document.getElementById('contact-email').value = '';
            document.getElementById('contact-phone').value = '';
            document.getElementById('contact-message').value = '';
            ContactClearFormErrors();
            var pElement = document.createElement("p");
            var pText = document.createTextNode("Thank you, we have received your message.");
            pElement.appendChild(pText);
            pElement.setAttribute('style', 'color: green;');
            document.getElementById('contact-thankyou').appendChild(pElement);
        }
    }
}

function SendContactMessage(){
    if(document.getElementById('contact-name').value == ''){
        ContactPostFormErros("Please fill out the name field");
        return;
    }else if(document.getElementById('contact-email').value == ''){
        ContactPostFormErros("Please fill out the email field");
        return;
    }else if(document.getElementById('contact-phone').value == ''){
        ContactPostFormErros("Please fill out the phone number field");
        return;
    }

    console.log("Sending contact message");
    requestObject = CreateRequest();
    var contactUrl = THEMEROOT + '/Contact.php';
    var requestData = "name=" +
        encodeURI(CleanString(document.getElementById('contact-name').value)) + "&e-mail=" +
        encodeURI(CleanString(document.getElementById('contact-email').value)) + "&phoneNumber=" +
        encodeURI(CleanString(document.getElementById('contact-phone').value)) + "&message=" +
        encodeURI(CleanString(document.getElementById('contact-message').value)) + "&submit=true";
    requestObject.onreadystatechange = ShowContactStatus;
    requestObject.open("POST", contactUrl, true);
    requestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requestObject.send(requestData);

}

function ValidateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

// Used on multiple pages, must be places outside of document.ready to allow access from other pages
function MoveSlide() {
    var destTag = $(".destinationSlide");
    $('html,body').animate({ scrollTop: destTag.offset().top }, 'slow');
}

function ShowCheck(object) {
    if (object.checked) {
        var label = object.parentNode;
        $(label).css("background-position", "0px -48px");
    }
    else {
        var label = object.parentNode;
        $(label).css("background-position", "0px 0px");
    }
}