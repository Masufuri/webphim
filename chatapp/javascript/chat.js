const form=document.querySelector('.chat-area .typing-area'),
btngui=form.querySelector('button'),
inputField=form.querySelector('.input-field'),
chatBox=document.querySelector('.chat-box');

form.onsubmit=(e)=>{
    e.preventDefault();
}

document.onload=refresh();
/* Notification.requestPermission().then(perm=>{
    if(perm==="granted"){
        new Notification("Hello");
    }
}) */

btngui.onclick=()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("POST","php/insert-chat.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                inputField.value="";
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    let formdata=new FormData(form); //tạo một đối tượng form data mới
    xhr.send(formdata);
}

setInterval(()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("GET","php/check-chat.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                if(data==="refresh"){refresh();suarefresh();}
                    //location.href="user.php";
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    let formdata=new FormData(form); //tạo một đối tượng form data mới
    xhr.send(formdata);
},500); //function này sẽ tự chạy mỗi 500 mili giây

function refresh(){
    let xhr=new XMLHttpRequest();
    xhr.open("POST","php/get-chat.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                chatBox.innerHTML = data;
                chatBox.lastChild.scrollIntoView();
                    //new Notification("Hello");
                    //location.href="user.php";
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    let formdata=new FormData(form); //tạo một đối tượng form data mới
    xhr.send(formdata);
}

function suarefresh(){
    let xhr=new XMLHttpRequest();
    xhr.open("GET","php/suarefresh.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                    //new Notification("Hello");
                    //location.href="user.php";
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    //let formdata=new FormData(form); //tạo một đối tượng form data mới
    xhr.send();
}



/* setInterval(()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("POST","php/get-chat.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                chatBox.innerHTML = data;
                    //location.href="user.php";
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    let formdata=new FormData(form); //tạo một đối tượng form data mới
    xhr.send(formdata);
},500); //function này sẽ tự chạy mỗi 500 mili giây */

//chatBox.scrollTop=chatBox.scrollHeight;