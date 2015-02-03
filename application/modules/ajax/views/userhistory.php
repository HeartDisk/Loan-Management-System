
<style>
.alertx {
	padding: 11px;
	margin-bottom: 5px;
	border-radius: 4px;
}
.alertx-red {
	color: white;
	background-color: #DA4453;
}
.alertx-green {
	color: white;
	background-color: #37BC9B;
}
.alertx-blue {
	color: white;
	background-color: #4A89DC;
}
.alertx-yellow {
	color: white;
	background-color: #F6BB42;
}
.alertx-orange {
	color: white;
	background-color: #E9573F;
}
.ipbox {
	font-family: 'Josefin Sans', sans-serif !important;
	color: #FFF;
	float: left;
	font-size: 15px;
	cursor:pointer;
}
#tooltipContent { font-family: 'Josefin Sans', sans-serif !important; font-size: 15px; font-weight:bold;}
.ipdata{margin-left: 9px;}

</style>
<div class="alertx" id="alog" style="display:none;">
  <center>
    <img src="../images/ajaxloader.gif">
  </center>
</div>
<?PHP
	foreach($dd as $log)
	{
		if($log->activitytype=='I')
		{	$div = 'alertx-green';	
			$title = 'سجل المضافة في'; }
		else if($log->activitytype=='U')
		{	$div = 'alertx-yellow';	
			$title = 'سجل تحديثها في'; }
		else
		{	$div = 'alertx-red';	
			$title = 'سجل محذوف من'; }
			
		if($log->activityip=='::1')
		{
			$ip = 'Testing';
		}
		else
		{
			$ip = $log->activityip;
		}
?>
<div  class="alertx <?PHP echo $div;?>"> <strong><?PHP echo $log->firstname; ?> <?PHP echo $log->lastname; ?></strong> <?PHP echo $title; ?> <strong id="logbox<?PHP echo $log->activityid; ?>" data-id="<?PHP echo $log->activityid; ?>" class="tablenames"><?PHP echo showtable_names($log->datatable); ?></strong> في <?PHP echo show_date($log->activitytime,3); ?> 
<span id="isi<?PHP echo $log->activityid; ?>" data-id="<?PHP echo $ip; ?>" class="ipbox"><?PHP echo $ip; ?></span> </div>
<?PHP 
	}?>