<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <title>upload class </title>
    <meta charset='utf-8'/>
</head>
<body>
<?php
include_once 'upload.php';
?>
                        <?php
                            $up=new up();
                            $up->mime=array('image/png','image/x-png','image/pjpeg','image/jpg','image/jpeg','image/gif'); // mime types
                            $up->ext=array('png','jpg','jpeg','gif'); // extention allowed
                            $up->up_folder=('up'); // dir to upload
                            $up->upl=(__DIR__.'/'.$up->up_folder); // dont edit this
                            $up->file_name = 'img'; // name of file upload
                            $up->max_size="1024000"; // 1 Mb
                            if(!is_dir($up->upl)){
                                exit(" مجلد الرفع ".$up->upl." غير موجود");
                            }
                            if(!is_writable($up->upl)){
                                exit(" مجلد الرفع ".$up->upl." غير قابل للكتابة الرجاء إعطاءه التصريح 777");
                            }
                            if(isset($_POST['add']))
                            {
                                $isup=$up->upload();
                                if($isup === TRUE){
                                    $img = $up->url;
                                    $imag=$up->upl."/$img";
                                    chmod($imag, 0644);
                                    ?>
                                    <img src="<?php echo $up->up_folder.'/'.$img; ?>">
                                    <?php
                                }else
                                {
                                    echo $isup;
                                }
                            }
                         ?>
						<form method="post" action="" enctype="multipart/form-data">
                            <label>إختار الصورة من جهازك : </label>
                            <input type="file" name="img" >
                            <input type="submit" value="رفع" name="add">
                        </form>


</body>
</html>
