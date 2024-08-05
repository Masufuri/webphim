<?php
	include('control.php');
	$getdata=new data;
	$gettheloai=$getdata->gettheloai();
	include('header.php');
	//session_start();
	include_once "check.php";
	if($kiem_tra_cookie=="sai"){echo "<script>location.href='index.php'</script>";die;}
?>

		<form method="post"  enctype="multipart/form-data" class="form_margin_top_10px">
			<table>
				<tr>
					<td>Tên phim: </td>
					<td><input type="text" name="name"></td>
				</tr>
				<tr>
					<td>File phim: </td>
					<td><input type="text" name="phim"><div><input type="checkbox" id="filesub"><label for="filesub">File sub của m3u8</label></div></td>
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
						<?php foreach($gettheloai as $se){echo "<div style='display:inline-block'><input type='checkbox' id='".$se['matheloai']."' name='theloai[]' value='".$se['theloai']."'><label for='".$se['matheloai']."'>".$se['theloai']."</label>&emsp;</div>";};?>
					</td>
				</tr>
				<tr>
					<td style="width: 130px">Năm sản xuất: </td>
					<td><input type="number" name="namsx" id="innamsx" required></td>
				</tr>
				<tr>
					<!-- <td>Đạo diễn: </td>
					<td><input type="text" name="daodien"></td> -->
					<td><label for="cbdaodien">Đạo diễn:</label></td>
					<td><select name="cbdaodien" id="cars">
						<option value="volvo">Volvo</option>
						<option value="saab">Saab</option>
						<option value="opel">Opel</option>
						<option value="audi">Audi</option>
					</select></td>
				</tr>
				<tr>
					<td>Nội dung: </td>
					<td><textarea name="noidung"></textarea></td>
				</tr>
			</table>
			<input type="submit" value="Thêm" name="sb">
		</form>
		<?php include('footer.php');?>
	</div>

	<?php
		
		//echo $tinhtoansophim;
		if(isset($_POST['sb'])){
			$thumucphim=substr($_POST['phim'],0,strlen($_POST['phim'])-4);
			$tl="";$filephim="";
			$a="";$b="";
			$a=$_FILES['picture']['tmp_name'];
			$b=$_FILES['picture']['name'];
			
			$phimmoinhat=$getdata->phimmoinhat();
            $row = mysqli_fetch_assoc($phimmoinhat);
            $hello=$row['maphim'];
            $inpfilesub=$_FILES['inpfilesub']['tmp_name'];
            //file sub:
            if(!empty($inpfilesub)){
                if (!file_exists("phim/".($hello+1)))mkdir("phim/".($hello+1), 0777, true);
			    $movefilesub=move_uploaded_file($inpfilesub,"phim/".($hello+1)."/".($hello+1).".vtt");
            }
			//end file sub
			if(!empty($a)){
			    
        		$formatimage=substr($b,-5);
                $formatimage1=strstr($formatimage,".");
        		$anhphim='img/'.($hello+1)."".$formatimage1;
			    $c=move_uploaded_file($a,$anhphim);
			}elseif(strstr($_POST['phim'],"<")!=null){
			    $get_id_phim_youtube1=strstr($_POST['phim'],"embed");
                $get_id_phim_youtube2=substr(strstr($get_id_phim_youtube1,"\"",true),6);
                $anhphim="https://i.ytimg.com/vi/".$get_id_phim_youtube2."/hq720.jpg";
			}
			else $anhphim="img/default/REM.png";
			/* $e=$_FILES['phim']['tmp_name'];
			$d=$_FILES['phim']['name']; */
			if(isset($_POST['theloai']))foreach($_POST['theloai'] as $i){$tl.=$i." ";};
			
			if(strstr($_POST['phim'],"http")!=null and strstr($_POST['phim'],"<")==null)$filephim=$_POST['phim'];
            elseif(strstr($_POST['phim'],"<")!=null)$filephim=str_replace("\"","'",$_POST['phim']);
            else $filephim=$_POST['phim'];
//			if($c)echo "xong";
			$themphim=$getdata->themphim($hello+1,$_POST['name'],$anhphim,$tl,$_POST['namsx'],$filephim,$_POST['noidung'],$_POST['daodien']);
			if($themphim){echo "<script>alert('Thêm thành công')</script><script>window.location.href=''</script>";/* header("refresh:0;url="); */}
		}
	?>
	<!--style type="text/css">
	    html{height:100%;}
	    body{
	        height:100%;
	        display:flex;
	        flex-direction:column;
	    }
	    .sum{
	        flex-grow:1;
	    }
	    .footer{
	        min-height:80px;
	    }
	</style-->
	<script>
	    // document.getElementById("innamsx").oninvalid=function(){document.getElementById("innamsx").setCustomValidity('Năm sản xuất không được bỏ trống đâu nhá');}
	    const checkboxsub = document.getElementById('filesub');

        checkboxsub.addEventListener('change', (event) => {
          if (event.currentTarget.checked) {
            document.getElementById('trfilesub').style.display="table-row";
          } else {
            document.getElementById('trfilesub').style.display="none";
          }
        })
	</script>
</body>
</html>