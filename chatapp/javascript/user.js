const form=document.querySelector('.signin form'),
btntimkiem=document.querySelector('.search button'),
searchbar=document.querySelector('.search input'),
users=document.querySelector('.user .user-list');

/* form.onsubmit=(e)=>{
    e.preventDefault();
} */

btntimkiem.onclick=()=>{
    searchbar.classList.toggle("active");
}

searchbar.onkeyup=()=>{
    let searchTerm=searchbar.value;
    let xhr=new XMLHttpRequest();
    xhr.open("POST","php/search.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                users.innerHTML = data;
                //users.innerHTML = data;
                    //location.href="user.php";
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}


setInterval(()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("GET","php/user.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                if(!searchbar.classList.contains('active'))users.innerHTML = data;
                    //location.href="user.php";
            }
        }
    }
    //gửi dữ liệu từ form đến php qua ajax
    xhr.send();
},500); //function này sẽ tự chạy mỗi 500 mili giây