const login=document.querySelectorAll('.hien_form'),
background_sum=document.querySelector('.sum'),
div_dang_nhap=document.querySelector('.dangnhap'),
form_dang_nhap=document.querySelector('.dangnhap form'),
err=document.querySelector('.dangnhap .error'),
input_dang_nhap=document.querySelector('.dangnhap input[type=password]'),
//vien_ngoai_form=document.querySelector('.dangnhap div'),
vien_ngoai_form=document.querySelector('.vien_ngoai_form'),
submit_dang_nhap=document.querySelector('.dangnhap input[type=submit]');

//form_dang_nhap.style.opacity=0;
//input_dang_nhap.focus();
function hien_form_dang_nhap(){
        background_sum.classList.toggle('active');
        div_dang_nhap.classList.toggle('active');
        //input_dang_nhap.focus();
}
Array.from(login,ad=>{ad.onclick=hien_form_dang_nhap});
//()=>{login.onclick=hien_form_dang_nhap};

vien_ngoai_form.onclick=()=>{
    background_sum.classList.toggle('active');
    div_dang_nhap.classList.toggle('active');
}
// đăng nhập
form_dang_nhap.onsubmit=(e)=>{
    e.preventDefault();
}

let solanan=0;
let text;
submit_dang_nhap.onclick =()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("POST","dangnhap.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                //console.log(data);
                if(data=="success"){
                    
                    err.style.display="none";
                    
                    location.reload();
                    
                    //location.href="index.php";
                }
                // else {
                //     err.textContent=data;
                //     err.style.display="block";
                // }
                else {
                    switch(solanan){
                        case 0: text="Tài khoản hoặc mật khẩu không đúng...";break;
                        case 1: text="Vẫn không đúng...";break;
                        case 2: text="Cố nhớ lại đi xem nào...";break;
                        case 3: text="Có biết mật khẩu không đấy?!";break;
                        case 4: text="-_-";break;
                        case 6: location.href="https://i.pinimg.com/originals/38/0d/1f/380d1f65a01a42015f6d47711b8a3f39.png";break;
                    }
                    err.textContent=text;
                    err.style.display="block";
                    solanan++;
                }
                
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    let formdata=new FormData(form_dang_nhap); //tạo một đối tượng form data mới
    xhr.send(formdata);
}