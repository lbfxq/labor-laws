<?php
$assets_url = Yii::$app->params['assets'];
?>
<div class="maincontent tab-content">
<h1><?=@$base->title?></h1>
<form class="form-horizontal" action="" method="post" onsubmit="return checkform()">
		<div class="box clearfix">
			<div class="contentleft">
				<div class="contentbox">
					<h2 class="boxtitle">项目</h2>
					<div class="box">
						
						<div class="items clearfix">
							<div class="title">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格:</div>
							<div class="content"><?=@$data->price?></div>
						</div>
						<div class="items clearfix">
							<div class="title">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;点:</div>
							<div class="content"><?=@$data->areas?></div>
						</div>
						<div class="items clearfix">
							<div class="title">时&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;间:</div>
							<div class="content"><?=@$data->pdate?></div>
						</div>
					</div>
				</div>
				<div class="contentbox">
					<h2 class="boxtitle">主办单位</h2>
					<div class="box">
						<div class="items clearfix">
							<div class="title">单位名称:</div>
							<div class="content"><?=@$base->zbf_name?></div>
						</div>
						<div class="items clearfix">
							<div class="title">联&nbsp;&nbsp;系&nbsp;人:</div>
							<div class="content"><?=@$base->zbf_linker?></div>
						</div>
						<div class="items clearfix">
							<div class="title">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱:</div>
							<div class="content"><?=@$base->zbf_email?></div>
						</div>
						<div class="items clearfix">
							<div class="title">电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话:</div>
							<div class="content"><?=@$base->zbf_tel?></div>
						</div>
					</div>
				</div>
				
				<div class="contentbox">
					<h2 class="boxtitle">报名者信息</h2>
					<div class="box">
						<div class="items clearfix">
							<div class="title">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名:</div>
							<div class="content"><input id="name" type="text" name="parm[name]"></div>
						</div>
						<div class="items clearfix">
							<div class="title">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别:</div>
							<div class="content">
								<label><input type="radio" name="parm[sex]" value="男" checked="checked"> 男</label>&nbsp;&nbsp;
								<label><input type="radio" name="parm[sex]" value="女"> 女</label>
							</div>
						</div>
						<div class="items clearfix">
							<div class="title">联系电话:</div>
							<div class="content"><input id="mobile" type="text" name="parm[mobile]"></div>
						</div>
						<div class="items clearfix">
							<div class="title">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱:</div>
							<div class="content"><input id="email" type="text" name="parm[email]"></div>
						</div>
						<div class="items clearfix">
							<div class="title">是否需要发票:</div>
							<div class="content">
								<label><input type="radio" class="invoiceChange" name="parm[invoice_flag]" value="1" checked="checked"> 否</label>&nbsp;&nbsp;
								<label><input type="radio" class="invoiceChange" name="parm[invoice_flag]" value="2"> 是</label>
							</div>
						</div>
						<div class="hide invoicecontent">
							<div class="items clearfix ">
								<div class="title">公司名称:</div>
								<div class="content"><input id="invoice_title" type="text" name="parm[invoice_title]" style="width:100%"></div>
							</div>
							<div class="items clearfix ">
								<div class="title">公司税号:</div>
								<div class="content"><input id="invoice_no" type="text" name="parm[invoice_no]"  style="width:100%"></div>
							</div>
						</div>
						
					</div>
				</div>
				<div class="contentbox">
					<h2 class="boxtitle">支付信息</h2>
					<div class="box">
						<div class="items clearfix">
							<div class="title">支付方式:</div>
							<div class="content">
								<label><input type="radio" class="payment" name="parm[payment]" value="支付宝" checked="checked"> 支付宝</label>&nbsp;&nbsp;
								<label><input type="radio" class="payment" name="parm[payment]" value="微信"> 微信</label>&nbsp;&nbsp;
								<label><input type="radio" class="payment" name="parm[payment]" value="转账"> 转账</label>
							</div>
						</div>
						<div class="items clearfix">
							<div class="title">收款账号:</div>
							<div class="content">
								<div class="paychannel pay_alipay">
									<img src="<?= $assets_url ?>home/img/alipay.jpg" width="200" >
									<p class="mt10">收款人：张春伟</p>
								</div>
								<div class="paychannel pay_weixin hide">
									<img src="<?= $assets_url ?>home/img/weixin.jpg" width="200" >
									<p class="mt10">收款人：张春伟</p>
								</div>
								<div class="paychannel pay_bank hide">
									<p>待定</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="contentbox">
					<h2 class="boxtitle">其他</h2>
					<div class="box">
						<div class="items clearfix">
							<div class="title">备注:</div>
							<div class="content"><textarea name="parm[note]" style="width: 100%;height:100px;"></textarea></div>
						</div>
					</div>
				</div>
				<div class="submit">
					<input type="submit" value="我要报名">
					<input type="hidden" name="parm[amount]" value="<?=@$data->price?>">
					<input type="hidden" name="project" value="<?=@$data->id?>">
				</div>
			</div>

			<div class="contentright">
				<h3>项目介绍</h3>
				<div>
				<?=@$data->desc;?>
				</div>
			</div>
		</div>
</form>
</div>
<script type="text/javascript">
$(function(){
	//选择是否需要发票
	$(".invoiceChange").click(function(){
		var inflag= $(this).val();
		if(inflag == 2){
			$(".invoicecontent").removeClass("hide");
		}else{
			$(".invoicecontent").addClass("hide");
			$(".invoicecontent .content input").val("");
		}
	});

	$(".payment").click(function(){
		var pay=$(this).val();
		var prex=$(".payimg").attr("data-prefix");
		$(".paychannel").addClass("hide");
		if(pay=="微信"){
			$(".pay_weixin").removeClass("hide");
		}else if(pay=="支付宝"){
			$(".pay_alipay").removeClass("hide");
		}else{
			$(".pay_bank").removeClass("hide");
		}
	});
});

function checkform(){
	var num =$(".project_item:checked").length;
	var msg="";
	
	var name= $("#name").val();
	if(name ==""){
		msg+=msg==""?"名称不能为空":"\n名称不能为空";
	}
	var mobile= $("#mobile").val();
	if(mobile ==""){
		msg+=msg==""?"联系电话不能为空":"\n联系电话不能为空";
	}
	var email= $("#email").val();
	if(email ==""){
		msg+=msg==""?"邮箱不能为空":"\n邮箱不能为空";
	}
	var invflag =$(".invoiceChange:checked").val();
	if(invflag==2){
		var invoice_title= $("#invoice_title").val();
		if(invoice_title ==""){
			msg+=msg==""?"公司名称不能为空":"\n公司名称不能为空";
		}
		var invoice_no= $("#invoice_no").val();
		if(invoice_no ==""){
			msg+=msg==""?"公司税号不能为空":"\n公司税号不能为空";
		}
	}

	if(msg != ""){
		alert(msg);
		return false;
	}
}

</script>