<!doctype html>
<html>
<head>
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />

<style>
.english {
	font-family: 'Josefin Sans', sans-serif !important;	
	font-size: 15px;
}

.arabic {
	font-family:'Droid Arabic Kufi', serif !important;	
	font-size: 15px;
}

.nnx { list-style:none !important; border-bottom:1px solid #ddd !important; padding:4px 3px !important; }
</style>
<meta charset="utf-8">
<title></title>
</head>

<body>
<?PHP 
foreach($noor as $nkey => $nvalue) { 
 if($nvalue!='')
 {
	if(is_numeric($nvalue))
	{
		$css = ' english ';
	}
	else if(checkdate($nvalue))
	{
		$css = ' english ';
	}
	else
	{
		$css = ' arabic ';
	}
?>
<li class="<?PHP echo $css; ?> nnx"><?PHP echo $nvalue; ?></li>
<?PHP } }?>
</body>
</html>

