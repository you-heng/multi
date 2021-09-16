/**

 @Name：layuiAdmin 用户登入和注册等
 @Author：贤心
 @Site：http://www.layui.com/admin/
 @License: LPPL
    
 */
 
layui.define('form', function(exports){
  var $ = layui.$;

  var $body = $('body');

  //更换图形验证码
  $body.on('click', '#LAY-user-get-vercode', function(){
    var othis = $(this);
    this.src = 'https://www.oschina.net/action/user/captcha?t='+ new Date().getTime()
  });
  
  //对外暴露的接口
  exports('user', {});
});