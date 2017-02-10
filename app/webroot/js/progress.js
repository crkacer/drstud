var currentIndex = -1;// store current pane index displayed
var ePanes = $('#slider .panel'), // store panes collection
    time   = 5000;

function showPane(index){// generic showPane
    // hide current pane
    ePanes.eq(currentIndex).stop(true, true).fadeOut();
    // set current index : check in panes collection length
    currentIndex = index;
    if(currentIndex < 0) currentIndex = ePanes.length-1;
    else if(currentIndex >= ePanes.length) currentIndex = 0;
    // display pane
    ePanes.eq(currentIndex).stop(true, true).fadeIn();
}
function run(){
    if(currentIndex<3)
    {
	ePanes.hide();
	showPane(currentIndex+1);
	setTimeout(function(){run()},time);
	
    }    
}
$(".progress-bar").animate({width: "100%"}, time*4-time);
run();