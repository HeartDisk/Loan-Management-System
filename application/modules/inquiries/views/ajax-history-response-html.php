<style>

.center { text-align:center !important; }
.left { text-align:left !important; }
.right { text-align:right !important; }
.bbottom { border-bottom:2px solid #fff; }
</style>
<table class="flatTable">
<?PHP 

foreach($history as $key => $value) { 
?>
  <tr class="titleTr">
    <td width="33%" class="titleTd right hhead"><?PHP echo $value['system_date']?></td>
    <td colspan="4" class="center  hhead"><?PHP echo $value['system_time']?></td>
    <td width="33%" class="plusTd button left  hhead"><?PHP echo $value['admin_name']?></td>
  </tr>
  <?PHP 
 
  if(sizeof($value['inq']) > 0) { ?>
  <tr class="headingTr">
    <td colspan="6">
    	<ul class="inquery_x">
        	<?PHP foreach($value['inq'] as $inqkey => $inqdata) { ?>
            	<li><span class="now_al_mashrow"><?PHP echo $inqdata['name']; ?></span> <span class="now_al_mashrow_date"><?PHP echo $inqdata['date']; ?></span></li>
            <?PHP } ?>
        </ul>
    </td>
  </tr>
  <?PHP } ?>
  <tr class="headingTr">
    <td colspan="6" class="bbottom"><div class="now_notes"><?PHP echo $value['notes']?></div></td>
  </tr>
<?PHP } ?>  
</table>

