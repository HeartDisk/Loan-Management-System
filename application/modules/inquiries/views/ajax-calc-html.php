<table width="650" border="1">
<tr style="background:#69F;"><td>التسلسل‬‎</td><td>‫مبلغ القائم‬‎‬‎</td><td>‫التاريخ‬‎‬‎‬‎</td><td>‫‫مبلغ القسط‬‎‬‎‬‎</td><td>‫الرسوم</td><td>‫نوع الحركة‬‎</td></tr> 
       
  <?php
  	//if()
	$paid= $post_data['paid_instalment'];
	$unpaid = $post_data['leave_installmment'];
	$amount = $post_data['loan_amount'];
   $instalment_amount = $post_data['instalment_amount'];
  
	$type_installment = $post_data['type_installment'];
	$percenatage = $post_data['loan_percentage'];
	$start_date = $post_data['start_date'];
	//$unpaid = date(''$post_data['start_date'];
	//$purchase_date = "2010-02-09 19:17:04";
//$purchase_date_timestamp = strtotime($purchase_date);
//$purchase_date_3months = strtotime("+3 months", $purchase_date_timestamp);

//echo "Purchase date + 3months = ".date("Y-m-d h:i:s", $purchase_date_3months);
	$total = $paid+$unpaid;
	$remaining_amount = '';
	$remaining_date = '';
	if($type_installment == '3'){
				$type_installment =3;
			}else{
					$type_installment =1;
			}
	$counter = 0;
	for($a=0;$a<$total;$a++){
	
		if($remaining_date!=""){
			//echo "if";
			$purchase_date_timestamp = strtotime($remaining_date);
			$purchase_date_3months = strtotime("+".$type_installment." months", $purchase_date_timestamp);
			$rem = date("m/d/Y", $purchase_date_3months);
			
		}
		else{
				//echo "else";
			$purchase_date_timestamp = strtotime($start_date);
			$purchase_date_3months = strtotime("+".$type_installment." months", $purchase_date_timestamp);
			$rem = date("m/d/Y", $purchase_date_3months);
			
		}
		$remaining_date = $rem;
		
		if($a<=$unpaid){
			$total_percentage = '00.00';
			$type= "سماح";
			$remaining_amount = $amount;
			$remaining_amount = number_format($remaining_amount, 2, '.', '');
			$instalment_amount = '00.00';
		}
		else{
			$type = "قسط";
			
			$instalment_amount = $post_data['instalment_amount'];
			if($remaining_amount!= ""){
			 $remaining_amount = $remaining_amount-$instalment_amount;
				//echo $instalment_amount;
				$remaining_amount = number_format($remaining_amount, 2, '.', '');
				$instalment_amount = number_format($instalment_amount, 2, '.', '');
			}
			//echo $instalment_amount;
			$percent_val = $percenatage*0.01;
			$total_percentage = $percent_val*$remaining_amount;
			$total_percentage = number_format($total_percentage, 2, '.', '');
			
		}
		$counter++;
		?>
        <tr><td><?php echo $counter; ?></td><td><?php echo $remaining_amount; ?></td><td><?php echo $rem; ?></td><td><?php echo $instalment_amount; ?></td><td><?php echo $total_percentage; ?></td><td><?php echo $type; ?></td></tr>
        <?php
	}
  ?>
</table>