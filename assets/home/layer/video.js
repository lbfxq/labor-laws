$(function () {
  $('.pay_require').click(function () {
    var obj = this
    layer.open({
      type: 0 //此处以iframe举例
      ,
      title: '提示信息',
      shade: 0.3 //遮罩
      ,
      content: '请购买该视屏',
      btn: ['购买', '关闭'] //只是为了演示
      ,
      yes: function () {
        var url = $('#base_uri').val()
        var vid = $(obj).attr('data-vid')
        url = url + '/order/index?vid=' + vid
        location.href = url
      },
      no: function () {
        layer.closeAll()
      },
      success: function (layero) {
        console.log('success')
      },
    })

  })
  $('.login_require').click(function () {
    layer.open({
      type: 0 //此处以iframe举例
      ,
      title: '提示信息',
      shade: 0.3 //遮罩
      ,
      content: '请登录系统',
      btn: ['登录', '关闭'] //只是为了演示
      ,
      yes: function () {
        var url = $('#base_uri').val()
        url = url + '/login/index'
        location.href = url
      },
      no: function () {
        layer.closeAll()
      },
      success: function (layero) {
        console.log('success')
      },
    })
  })
  $('.myleft').css({minHeight:$('header').height()+$('#footer').height()+$('#myAffix').height()})
  $(window).resize(function(){
    $('.myleft').css({minHeight:$('header').height()+$('#footer').height()+$('#myAffix').height()})
  })
  if ($(document).height() - $(window).height() - $('footer').height() < $(window).scrollTop()) {
    $('footer').css({'position': 'fixed'})
    if(!$('#myAffix').hasClass('_affixed')){
      $('#myAffix').addClass('_affixed')
    }
  } else {
    $('footer').css({'position': 'relative'})
    if($('#myAffix').hasClass('_affixed')){
      $('#myAffix').removeClass('_affixed')
    }
  }
  $('#myAffix').addClass('affix')

  function reset () {
    $('._affixedbottom').removeClass('_affixedbottom')
    $('#myAffix').removeClass('_affixedtop')
    $('._affix').css({top:'auto'})
  }
  $(document).on('scroll', function () {

    // if( $(window).scrollTop()<=40){
    //   $('#myAffix').css({position:'fixed',bottom:40})
    // }else{
    //   $('#myAffix').css({position:'relative'})
    // }

    if ($(document).height() - $(window).height() - $('footer').height() < $(window).scrollTop()) {
      $('footer').css({'position': 'fixed'})
      // if(!$('#myAffix').hasClass('_affixed')){
      //   $('#myAffix').addClass('_affixed')
      // }
    } else {
      $('footer').css({'position': 'relative'})
      // if($('#myAffix').hasClass('_affixed')){
      //   $('#myAffix').removeClass('_affixed')
      // }
    }



    if($(window).scrollTop() > $('.container.mb10')[0].offsetTop){
      $('._affixedtop').css({top:$('.container.mb10')[0].offsetTop})
      if($(window).scrollTop() + $('.container.mb10')[0].offsetTop  + $('#footer').height() > $('#myAffix').height()){
        reset()
        // if(!$('#myAffix').hasClass('_affixedbottom')){
          $('#myAffix').addClass('_affixedbottom')
        //   $('#myAffix').removeClass('_affixedtop')
        // }
      }else{
        reset()
          // $('#myAffix').addClass('_affixedtop')
      }
    }else{
      reset()
    }
  })
  // $('#myAffix').affix({
  //   offset: {
  //     // top: 140,
  //     bottom: function(){
  //       return 36
  //     },
  //   },
  // })

  // $('#myAffix').on('affix.bs.affix', function () {
  //   console.log('1')
  // })
  // $('#myAffix').on('affixed.bs.affix', function () {
  //   $('#myAffix').css({
  //     position: 'fixed',
  //     bottom: 'auto',
  //     top: 232,
  //   })
  // })
  // $('#myAffix').on('affix-top.bs.affix', function () {
  //   console.log('3')
  // })
  // $('#myAffix').on('affixed-top.bs.affix', function () {
  //   $('#myAffix').css({
  //     position: 'relative',
  //     bottom: 'auto',
  //     top: 0,
  //   })
  // })
  // $('#myAffix').on('affix-bottom.bs.affix', function () {
  //   console.log('5')
  // })
  // $('#myAffix').on('affix-bottom.bs.affix', function () {
  //   // $('#myAffix').css({position:'fixed',bottom:36,top:'auto'})
  // })

  $(document).on('click', '.js-show-menu', function (e) {
    // e.preventDefault()
    $('.dropdown-menu').css('visibility', 'hidden')
    $(this).next().css('visibility', 'visible')

  })
  var isLoading = true
  window.onload = function () {
    isLoading = false
  }

  layui.use('element', function () {
    var element = layui.element //Tab的切换功能，切换事件监听等，需要依赖element模块

    //触发事件
    var active = {
      loading: function () {
        //模拟loading
        var n = 0, timer = setInterval(function () {
          n = n + Math.random() * 10 | 0
          if (n > 100 || !isLoading) {
            n = 100
            clearInterval(timer)
            $('#progress').animate({opacity: 0}, 1000, function () {
              $(this).hide()
            })
          }
          element.progress('demo', n + '%')
        }, 300 + Math.random() * 1000)

      },
    }
    active['loading'].call(this, $(this))
  })

})
