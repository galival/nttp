/*
* main.js for newtothepublic
*
*/


/*
	NO LONGER USED: function to change color of each letter in h1 headers. 


(function(){
var headers = document.getElementsByTagName("h1");
for(var i = 0; i<headers.length;i++){
	var ref_text = headers[i].innerHTML;//just a reference copy to get indexOf

  //alert(ref_text); //check

	var new_html = headers[i].innerHTML.split('').map(function(el){
		return '<span class="letter-'+ref_text.indexOf(el)%4+'">'+el+"</span>";
		}).join('');

	headers[i].innerHTML = new_html;

	//alert(headers[i].outerHTML); //check

	}
})();

*/



/* FOR TESTING & COURSERA CLASS

var myHeading = document.querySelector('h1');
myHeading.textContent = "Hello";


var headerImage = document.querySelector('img');

headerImage.onclick = function() {
    var mySrc = headerImage.getAttribute('src');
    if(mySrc === 'images/header1.jpg') {
      headerImage.setAttribute ('src','images/header2.JPG');
    } else {
      headerImage.setAttribute ('src','images/header1.jpg');
    }
}

var myBut = document.querySelector('button');
var myHead = document.querySelector('h1');
var motto = null;

function setName() {
	motto = prompt("what's your motto?");
	localStorage.setItem('name', motto);
	myHead.textContent = "Take your own advice for once : " + motto;
}

if(!localStorage.getItem('name')) {
	setName();
} else {
	var storedName = localStorage.getItem('name');
	myHead.textContent = "Take your own advice for once : " + motto;
}

myBut.onclick = function(){
	setName();
}

*/


/* DEPRECATED RESPONSIVE FUNCTION

$(document).ready(function(){

	$(window).resize(function(){
 		if($(window).width()<479){
  		$('.left').removeClass('left');
 		}
	});

	$(window).resize(function(){
	 	if($(window).width()<479){
	  	$('.right').removeClass('right');
	 	}
	});

});

*/

 $(document).ready(function() {
        $(".fancybox").fancybox();
 });

 $(function(){
 	//auto

 });


