function clock() {
    var today=new Date();
    var h=today.getHours();
    
    var ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12;
    h = h ? h : 12;
    
    
    var m=checktime(today.getMinutes());
    var s=checktime(today.getSeconds());
    document.getElementById('time').innerHTML=h+":"+m+":"+s+" "+ ampm;
    var t=setTimeout(clock,500);
}
function checktime(i) {
    if(i<10) i="0"+i;
    return i;
}

function action(evt, tab) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tab).style.display = "block";
    evt.currentTarget.className += " active";
}