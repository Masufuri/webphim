const signup=document.querySelectorAll('.a_dang_ky'),
//background_sum=document.querySelector('.sum'),
div_dang_nhap_tu_dang_ky=document.querySelector('.dangnhap'),
div_dang_ky=document.querySelector('.dangky'),
form_dang_ky=document.querySelector('.dangky form'),
//err=document.querySelector('.dangnhap form span'),
input_dang_ky=document.querySelector('.dangky input[type=password]'),
vien_ngoai_form_dang_ky=document.querySelector('.dangky > .vien_ngoai_form'),
submit_dang_ky=document.querySelector('.dangky input[type=submit]');
//form_dang_nhap.style.opacity=0;
//input_dang_nhap.focus();
function hien_form_dang_ky(){
        //background_sum.classList.toggle('active');
        div_dang_ky.classList.toggle('active');
        //input_dang_ky.focus();
}
Array.from(signup,ad=>{ad.onclick=hien_form_dang_ky});
//()=>{login.onclick=hien_form_dang_nhap};

vien_ngoai_form_dang_ky.onclick=()=>{
    background_sum.classList.toggle('active');
    div_dang_ky.classList.toggle('active');
    div_dang_nhap_tu_dang_ky.classList.toggle('active');
}
// đăng nhập
form_dang_ky.onsubmit=(e)=>{
    e.preventDefault();
}

//let solanan=0;
//let text;
submit_dang_ky.onclick =()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("POST","dangky.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data1=xhr.response;
                //console.log(data);
                if(data1=="success"){
                    err.style.display="none";
                    location.reload();
                    //location.href="index.php";
                }else {
                    console.log(data1);
                    /*switch(solanan){
                        case 0: text="Sai òi...";break;
                        case 1: text="Lại sai òi...";break;
                        case 2: text="Lại sai nữa òi...";break;
                        case 3: text="Có biết mật khẩu không đấy?!";break;
                        case 4: text="-_-";break;
                        case 6: location.href="https://i.pinimg.com/originals/38/0d/1f/380d1f65a01a42015f6d47711b8a3f39.png";break;
                    }
                    err.textContent=data1;
                    err.style.display="block";
                    solanan++;*/
                }
                
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    let formdata=new FormData(form_dang_ky); //tạo một đối tượng form data mới
    xhr.send(formdata);
}