<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>文件上传</title>
<!-- <script src="http://libs.baidu.com/jquery/2.1.1/jquery.js"></script>
<link href="http://libs.baidu.com/bootstrap/3.3.4/css/bootstrap.css" rel="stylesheet">
<script src="http://libs.baidu.com/bootstrap/3.3.4/js/bootstrap.js"></script>
   鼠标经过下拉标签时，自动显示标签
 <link href="/hstcesys/Public/Css/fileinput.css">
 <script type="text/javascript" src="/hstcesys/Public/Js/fileinput.js" rel="stylesheet"></script>
<script type="text/javascript" src="/hstcesys/Public/Js/fileinput_locale_zh.js"></script> -->
 <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<!-- <link href="/hstcesys/Public/Css/bootstrap.css" rel="stylesheet"> -->
<link href="/hstcesys/Public/Css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script src="/hstcesys/Public/Js/fileinput.js" type="text/javascript"></script>
<script src="/hstcesys/Public/Js/fileinput_locale_zh.js" type="text/javascript"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js" type="text/javascript"></script>

</head>
<body>
<div class="container kv-main">
            <div class="page-header">
            <h1>测试 <small><a href="https://github.com/kartik-v/bootstrap-fileinput-samples"><i class="glyphicon glyphicon-download"></i>下载</a></small></h1>
            </div>
         

            
            <hr>
            <form enctype="multipart/form-data">
                <hr style="border: 2px dotted">
                <label>上传</label>
                <input id="excelData" name="excelData" type="file" multiple style="width: 100px">
            </form>
            <hr>
            <br>
        </div>

<script>
    $('#excelData').fileinput({
        language: 'zh',
        uploadUrl: "<?php echo U("admin/questions/upload");?>",
        maxFileCount: 1,
        allowedFileExtensions : ['xlsx', 'xls'],
    });
    $("#excelData").on("fileuploaded", function (event, data, previewId, index) {
    	if(data.response.info == "ok"){
    			if(confirm("上传成功！是否跳转到试题列表")){
    				window.location.href=data.response.url;
    			}
    	}else{
    		alert("上传失败！请重试");
    	}
    });
	</script>

</body>
</html>