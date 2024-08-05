<?php
	include('control.php');
	$getdata=new data;
	$gettheloai=$getdata->gettheloai();
	$loi="<script>alert('Có gì đó không ổn, bạn sẽ được đưa về trang chủ');window.location.href='index.php'</script>";
	if(!isset($_GET['id']))echo $loi;
	$infophim=$getdata->infophim($_GET['id']);
	
	set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context)
{
    global $loi;
    echo $loi;
}, E_WARNING);

    if(mysqli_num_rows($infophim)==0)echo $loi;
    restore_error_handler();
    foreach($infophim as $inf);
	include('header.php');
	include_once "check.php";
	if($kiem_tra_cookie=="sai"){echo "<script>location.href='index.php'</script>";die;}
?>

		<style>
			input[type='text']{
				width: 60vw;
			}
		</style>
		<form method="post"  enctype="multipart/form-data" class="form_margin_top_10px">
			<table>
				<tr>
					<td>Tên phim: </td>
					<td><input type="text" name="name" value="<?php echo $inf['name']?>"></td>
				</tr>
				<tr>
					<td>File phim: </td>
					<td><input type="text" name="phim" value="<?php 
					if(strstr($inf['phim'],"http")!=null and strstr($inf['phim'],"<")==null)echo $inf['phim']; 
					elseif(strstr($inf['phim'],"<")==null){
    					$txt=substr(strstr($inf['phim'],'/'),1);
    					echo $filephim=substr(strstr($txt,'/'),1);}
					else echo htmlentities($inf['phim']);
					?>"><div><input type="checkbox" id="filesub"><label for="filesub">File sub của m3u8</label></div></td>
				</tr>
				<tr id="trfilesub" style="display:none;color:red;">
				    <td>File sub:</td>
				    <td><input type="file" accept=".vtt" name="inpfilesub" class="file"></td>
				</tr>
				<tr>
					<td>Ảnh: </td>
					<td><input type="file" accept="image/*" name="picture" class="file"></td>
				</tr>
				<tr>
					<td>Thể loại: </td>
					<td>
						<?php foreach($gettheloai as $se){?>
                            <div style='display:inline-block'><input type='checkbox' id='<?php echo $se['matheloai'];?>' name='theloai[]' value='<?php echo $se['theloai'];?>' <?php if(strstr($inf['theloai'],$se['theloai'])!=null)echo "checked";?>><label for='<?php echo $se['matheloai'];?>'><?php echo $se['theloai'];?></label>&emsp;</div>
                        <?php };?>
					</td>
				</tr>
				<tr>
					<td style="width: 130px">Năm sản xuất: </td>
					<td><input type="number" name="namsx" value="<?php echo $inf['namsx'];?>" id="innamsx" required></td>
				</tr>
				<tr>
					<td>Nội dung: </td>
					<td><textarea name="noidung"><?php echo $inf['noidung']?></textarea></td>
				</tr>
			</table>
			<input type="submit" value="Sửa" name="sb">
			<input type="submit" name="sbxoa" value="Xóa" onclick="return(confirm('Bạn có chắc muốn xóa phim?'))">
		</form>
		
	
	
	
	<a href="https://time.is/Hanoi" id="time_is_link" rel="nofollow" style="font-size:36px">Thời gian ở Hà Nội:</a>
    <span id="Hanoi_z40a" style="font-size:36px"></span>
    <script src="//widget.time.is/t.js"></script>
    <script>
    time_is_widget.init({Hanoi_z40a:{}});
    </script>
    <?php include('footer.php');?>
    </div>
    
	<?php
		if(isset($_POST['sbxoa'])){
		    if(strstr($inf['picture'],"/default")==null)unlink($inf['picture']);
			$xoaphim=$getdata->xoaphim($_GET['id']);
			if($xoaphim)echo "<script>alert('Đã xóa thành công');window.location.href='index.php';</script>";
            function rrmdir($dir) {
                if (is_dir($dir)) {
                    $objects = scandir($dir);
                    foreach ($objects as $object) {
                      if ($object != "." && $object != "..") {
                        if (filetype($dir."/".$object) == "dir") 
                           rrmdir($dir."/".$object); 
                        else unlink   ($dir."/".$object);
                      }
                    }
                    reset($objects);
                    rmdir($dir);
                }
            }
            rrmdir("phim/".$_GET['id']);
		}
		if(isset($_POST['sb'])){
		    $linkphimdathayngoac=str_replace("\"","'",$_POST['phim']);
			$tl="";
			$a="";$b="";$c="";
            $a=$_FILES['picture']['tmp_name'];
            $b=$_FILES['picture']['name'];
            if(!empty($a)){
                if(strstr($inf['picture'],"REM")==null)unlink($inf['picture']);
                $formatimage=substr($b,-5);
                $formatimage1=strstr($formatimage,".");
                $c="img/".$_GET['id']."".$formatimage1;
                $d=move_uploaded_file($a,$c);
            }elseif(strstr($_POST['phim'],"<")!=null){
			    $get_id_phim_youtube1=strstr($linkphimdathayngoac,"embed");
                $get_id_phim_youtube2=substr(strstr($get_id_phim_youtube1,"'",true),6);
                $c="https://i.ytimg.com/vi/".$get_id_phim_youtube2."/hq720.jpg";
			}
			else $c=$inf['picture'];
			//file sub:
			$inpfilesub=$_FILES['inpfilesub']['tmp_name'];
            if(!empty($inpfilesub)){
                if (!file_exists("phim/".($_GET['id'])))mkdir("phim/".($_GET['id']), 0777, true);
			    $movefilesub=move_uploaded_file($inpfilesub,"phim/".($_GET['id'])."/".($_GET['id']).".vtt");
            }
			//end file sub
			if(isset($_POST['theloai']))foreach($_POST['theloai'] as $i){$tl.=$i." ";};
			if(strstr($_POST['phim'],"http")!=null and strstr($_POST['phim'],"<")==null)$linkphim=$linkphimdathayngoac;
			elseif(strstr($_POST['phim'],"<")==null){
			    $thumucphim=substr($filephim,0,strlen($filephim)-4);
			    $linkphim="phim/".$thumucphim."/".$_POST['phim'];
			}
            else $linkphim=$linkphimdathayngoac;
//			if($c)echo "xong";
			$suaphim=$getdata->suaphim($_POST['name'],$c,$tl,$_POST['namsx'],$linkphim,$_POST['noidung'],$inf['maphim']);
			if($suaphim){echo "<script>alert('Sửa thành công')</script><script>window.location.href='infophim.php?id={$_GET['id']}';</script>";/*header("refresh:0;url=");*/}
		}
		
	?>
	<script>
	    document.getElementById("innamsx").oninvalid=function(){document.getElementById("innamsx").setCustomValidity('Năm sản xuất không được bỏ trống đâu nhá');}
	    
	    const checkbox = document.getElementById('filesub')
	    checkbox.addEventListener('change', (event) => {
          if (event.currentTarget.checked) {
            document.getElementById('trfilesub').style.display="table-row";
          } else {
            document.getElementById('trfilesub').style.display="none";
          }
        })
	</script>
</body>
</html>