const form=document.querySelector('.signup form'),
btndangky=document.querySelector('.signup .submit'),
err=document.querySelector('.signup .error');

form.onsubmit=(e)=>{
    e.preventDefault();
}



btndangky.onclick =()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("POST","php/signup.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                if(data=="success"){
                    err.style.display="none";
                    location.href="user.php";
                }else {
                    err.textContent=data;
                    err.style.display="block";
                }
                
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    let formdata=new FormData(form); //tạo một đối tượng form data mới
    xhr.send(formdata);
}