<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="layui/css/layui.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
          
<blockquote class="layui-elem-quote layui-text">
  鉴于小伙伴的普遍反馈，先温馨提醒两个常见“问题”：1. <a href="/doc/base/faq.html#form" target="_blank">为什么select/checkbox/radio没显示？</a> 2. <a href="/doc/modules/form.html#render" target="_blank">动态添加的表单元素如何更新？</a>
</blockquote>
              
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>表单集合演示</legend>
</fieldset>
 
<?php  ActiveForm::begin(['action'=>['qq/weather']]); ?>
  <div class="layui-form-item">
    <label class="layui-form-label">输入地址查看天气</label>
    <div class="layui-input-block">
      <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
    </div>
  </div>
 
  
  
  <div class="layui-form-item">
    <button class="layui-btn" lay-submit="" lay-filter="demo1">跳转式提交</button>
  </div>
<?php ActiveForm::end(); ?>  
<script src="layui/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
layui.use(['form', 'layedit', 'laydate'], function(){
  var form = layui.form
  ,layer = layui.layer
  ,layedit = layui.layedit
  ,laydate = layui.laydate;
  
  //日期
  laydate.render({
    elem: '#date'
  });
  laydate.render({
    elem: '#date1'
  });
  
  //创建一个编辑器
  var editIndex = layedit.build('LAY_demo_editor');
 
  //自定义验证规则
  form.verify({
    title: function(value){
      if(value.length >30 ){
        return '标题不得大于30个字符啊';
      }

    }
    
    ,content: function(value){
      layedit.sync(editIndex);
    }
  });
  
  
  
  //监听提交
  form.on('submit(demo1)', function(data){

  	var title = $(".layui-input").val();

  	if (title.length == 0) {
  		layer.alert('文本框不能为空');

  		return false;
  	};
  	if (title.length > 30) {
  		layer.alert('标题不得大于30个字符啊');

  		return false;
  	};

  /*	$.ajax({
  		type:'post',
  		url:"http://localhost/month/basic/web/index.php?r=qq/weather",
  		data:{
  			address:title
  		},
  		success:function  (res) {
  			
  			location.href="http://localhost/month/basic/web/index.php?r=qq/weado"

  				
  			
  		}
  	})*/
    /*layer.alert(JSON.stringify(data.field), {
      title: '最终的提交信息'
    })*/
    //return false;
  });
 
 /* //表单初始赋值
  form.val('example', {
    "username": "贤心" // "name": "value"
    ,"password": "123456"
    ,"interest": 1
    ,"like[write]": true //复选框选中状态
    ,"close": true //开关状态
    ,"sex": "女"
    ,"desc": "我爱 layui"
  })*/
  
  
});
</script>

</body>
</html>