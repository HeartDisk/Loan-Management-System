<div class="checkout-wrap">
  <ul class="checkout-bar">
  <?PHP
  	$array = array('1'=>'مراجع','2'=>'تسجيل الطلب','3'=>'بيانات المشروع','4'=>'القرض المطلوب','5'=>'دراسه وتحليل الطلب','6'=>'قرار اللجنة','7'=>'موافقة أولية');
	$html = '';
	$step++;
	foreach($array as $barkey => $bardata)
	{
		if($barkey=='1')
		{
			$html .= '<li class="visited first"> <a href="#">'.$bardata.'</a> </li>';
		}
		else
		{		
			$html .= '<li class="';
			if($barkey < $step)
			{	$html .= ' previous visited ';	}
			
			if($step==$barkey)
			{	$html .= ' active ';	}		
			
			if($barkey > $step)
			{	$html .= ' next ';	}
			
			$html .= '"> <a href="#">'.$bardata.'</a> </li>';
		}
	}
	echo $html;
  ?>
    <!--<li class="visited first <?PHP echo $active; ?>"> <a href="#">مراجع</a> </li>
    <li class="previous visited <?PHP if($step=='2') { ?>active<?PHP } ?>">تسجيل الطلب</li>
    <li class=" <?PHP if($step=='3') { ?>active<?PHP } ?>">بيانات المشروع</li>
    <li class="next  <?PHP if($step=='4') { ?>active<?PHP } ?>">القرض المطلوب</li>
    <li class="  <?PHP if($step=='5') { ?>active<?PHP } ?>" >دراسه وتحليل الطلب</li>-->
  </ul>
</div>
