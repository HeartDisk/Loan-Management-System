<?PHP
//echo $this->uri->segment(3);
//echo $this->uri->segment(4);
	if($this->uri->segment(3) && $this->uri->segment(4)){
		$firstUrl = 'requestphaseOne';
	}
	else{
		$firstUrl = 'newrequest';
	}
	$arMenu = array(
		'1'=>array(arabic_date(1).'. تسجيل ودراسة الطلبات‎',$firstUrl),
		'2'=>array(arabic_date(2).'. بيانات المشروع','requestphasetwo'),
		'3'=>array(arabic_date(3).'. القرض المطلوب','requestphasethree'),
		'4'=>array(arabic_date(4).'. دراسه وتحليل الطلب','requestphasefour'));		
?>
<nav class="steps">
  <ul>
    <?php foreach($arMenu as $key => $data) { ?>
    <li class="nextMove <?php if($s==$key) { ?>stepactive<?php } ?>" data-id="<?PHP echo($temp); ?>" id="<?php echo $data[1]; ?>"><?php echo $data[0]; ?></li>
    <?php } ?>
  </ul>
</nav>
<script type="text/javascript">

</script>
