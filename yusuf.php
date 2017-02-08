<?php




$industry_id = 1;
$today = date("d-M-Y");
$dates = array();
$interval = 15;
$previous = date('d-M-Y', strtotime("-$interval day"));
$dates = array();
if ($industry_id > 0) {

    $opeing = 100;
    for ($j = 0; $j <= $interval; $j++) {
        $i = date('d-M-Y', strtotime($previous . "+$j day"));
        $dates[$i]['date'] = date('d-M-Y', strtotime($previous . "+$j day"));
       
        $dates[$i]['consumption'] = isset($waterCOnsup[$i]['consumption']) ? $waterCOnsup[$i]['consumption'] : '0.00';
        $dates[$i]['id_ind_water_reading_log'] = isset($waterCOnsup[$i]['id_ind_water_reading_log']) ? $waterCOnsup[$i]['id_ind_water_reading_log'] : '';
        $dates[$i]['opening'] = $opeing;
        $dates[$i]['closing'] = $opeing = $dates[$i]['opening'] + $dates[$i]['consumption'];
    }
}

?>

<div class="box-header with-border">
    
</div>  
<form role="form"  method="post" id="wmreading"  class="com_from form_post" data-page='wmreading' mode="edit" data-page='wmreading'>

    <div class="box-body">  
        <table class="table table-bordered table-responsive">
              
            <tbody>
<?php $j =1; foreach($dates as $kry => $date_list){  ?>				
                    <tr>
                        <td class="text-center"><?php //echo $date_list['date']; ?></td>
                        <td class="text-right"><span  class="opening_<?php echo $j; ?>" id="opening_<?php echo $j; ?>" ><?php echo $date_list['closing']; ?><span></td>
                        <td>
                 <input type="text" data-row-id="<?php echo $j; ?>" value="<?php echo $date_list['consumption']; ?>"class="form-control digit_number_only consumption_entry text-right"
				 id="consumption_entry_<?php echo $j; ?>" name="consumption_{$datelist_key}_{$datelist_value.id_ind_water_reading_log|default:-1}">
					 
                <input type="hidden"  value="<?php echo $date_list['date']; ?>" class="form-control digit_number_only text-right" id=""
                    name="date_<?php echo $kry;?>_{$datelist_value.id_ind_water_reading_log|default:-1}">
					
                        </td>
                        <td class="text-right"><span class="closing_<?php echo $j; ?>" id="closing_<?php echo $j; ?>" ><?php echo $date_list['closing']; ?><span></td>                    
                    </tr>

<?php $j++;} ?>
            </tbody>
        </table>
    </div>
    <div class="box-footer text-center">                   
        <button type="reset" class="btn btn-warning">Cancel</button>           
        <button type="submit" id="save"
                data-page="wmreading" 
                data-from-name="wmreading" 
                class="btn  btn-info save_button btn-primary">Save</button>        
    </div>
            
            <input type="hidden" data-msg="" name="id_ind_unit_detail"  value="{$industry_id}" id="id_ind_unit_detail"  />
</form>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   
   $(".consumption_entry").keyup(function(){
          var consumption_entry = $(this).val();

		  if(consumption_entry == ''){
			  return false;
		  }
          var consumption_id = consumption_current = $(this).attr('data-row-id');
		  var total_row_count = 15
			
			/* Line to Complete the First row */
			var opeing_amount = $('#opening_'+consumption_current).text();
				consumption_entry = parseFloat(opeing_amount) + parseFloat(consumption_entry);
		  	$('#closing_'+consumption_current).text(consumption_entry.toFixed(2));
			/* Lines Completed */
		  
		  while(consumption_current <= total_row_count){
			   consumption_current++;
			  //Set Opeing balance 
			  
			  $('#opening_'+consumption_current).text(consumption_entry.toFixed(2));
			//  alert('Opening : '+consumption_entry);
			  var filed_value = $('#consumption_entry_'+consumption_current).val();
			  
			  consumption_entry = parseFloat(filed_value) + parseFloat(consumption_entry);
			  
			  $('#closing_'+consumption_current).text(consumption_entry.toFixed(2));
			  
			 // alert('Closing : '+consumption_entry);
			 
		  }
      });
   
});
</script>


