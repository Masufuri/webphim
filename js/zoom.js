function zoom(player){
    var dimension=1;
    var per=1;

    var zoominbutton=createbutton('&#8635;');

    var video=document.getElementById("my-video_html5_api");
    


    zoominbutton.onclick=function(){
        var widthvideo=video.videoWidth;
        var heightvideo=video.videoHeight;
        var widthvideotag=video.offsetWidth;
        var heightvideotag=video.offsetHeight;
        var pervideo=widthvideo/heightvideo;
        var pervideotag=widthvideotag/heightvideotag;
        
        if(per==pervideotag/pervideo)per=1;
        else{
        per=pervideotag/pervideo;
        }
        
        /* if(dimension==1)dimension=1.18;
        else if(dimension==1.18) dimension=1.312;
        else if(dimension==1.312) dimension=1; */
        player.zoomrotate({zoom:per});
    }

    var playbackRate=document.querySelector('.vjs-playback-rate');
    insertAfter(zoominbutton,playbackRate);

    function createbutton(icon){
        var button =document.createElement('button');
        button.classList.add('vjs-menu-button');
        button.innerHTML=icon;
        button.style.fontSize='1rem';
        return button;
    };
    function insertAfter(newel,element){
        element.parentNode.insertBefore(newel,element.nextSibling);
    };
};
videojs.registerPlugin('zoom',zoom);