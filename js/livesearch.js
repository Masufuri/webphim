function showResult(str) {
    if (str.length==0) {
      document.getElementById("livesearch").innerHTML="";
      document.getElementById("livesearch").style.border="0px";
      return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch").innerHTML=this.responseText;
        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
      }
    }
    let url=window.location.href;
    let checkurl=url.indexOf("admin");
    if(checkurl==-1)xmlhttp.open("GET","livesearch.php?q="+str,true);
    else xmlhttp.open("GET","../livesearch.php?q="+str+"&a=hello",true);
    xmlhttp.send();
  }
  function hello(){
    alert("alo");
  }