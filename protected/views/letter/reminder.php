<div class="container" style="margin-top: 25px;margin-left: 3%;">
      <form>

    
      <div class="py-2 ">
       <div class="row">
            <div class="col-2">
             <b><img src="<?php echo Yii::app()->baseUrl?>/images/logo1.jpg" style="max-width: 130%;margin-top: -15px;"></b>
            </div>
            <div class="col-9" style="margin-left: 5%">
              <div class="row">
                <div class="col-md-12" style="border-bottom: 3px solid black"><b style="    font-size: 25px;">Kainat City</b></div>
                <div class="col-md-12"><p>Office No. C-4, First Floor Block-7, Saadi Town, Scheme 33, Karachi</p></div> 
              </div>
            </div>
      </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
        <div class="row">
          <div class="col-4 text-center border border-secondary bg-light" ><b>CUSTOMER INFORMATION</b></div>
          <div class="col-4 text-center border border-secondary bg-light" ><b>PLOT INFORMATION</b></div>
          <div class="col-4 text-center border border-secondary bg-light" ><b>COST INFORMATION</b></div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="row">
          <table class="col-md-4 table table-responsive" style="font-size: 19px;border:2px solid;">
            <tbody>
                <tr>
                    <td class="tbBold">File ID: </td>
                    <td><?php echo @'ARC-'.$letter->booking->plot->block_number.'-'.$letter->booking->plot->plot_number?></td>
                </tr>
                <tr>
                    <td class="tbBold">Name: </td>
                    <td><?php echo @$letter->booking->customer->name?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">S/o, W/o, D/o: </td>
                    <td><?php echo @$letter->booking->customer->father_husband_name?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Address: </td>
                    <td><?php echo @$letter->booking->customer->address?></td>
                </tr>
                <tr>
                    <td class="tbBold">Mobile: </td>
                    <td><?php echo @$letter->booking->customer->mobile?></td>
                </tr>
                
                <tr>
                    <td class="tbBold">CNIC: </td>
                    <td><?php echo @$letter->booking->customer->cnic?></td>
                </tr>
            </tbody>
          </table>
          <table class="table table-responsive col-md-4" style="font-size: 19px;border:2px solid;    overflow: hidden;"> 
            <tbody>
                <tr>
                    <td class="tbBold">Computer ID: </td>
                    <td><?php echo @'ARC-'.$letter->booking->plot->block_number.'-'.$letter->booking->plot->plot_number?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Block: </td>
                    <td><?php echo @$letter->booking->plot->block_number?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Plot No. : </td>
                    <td><?php echo @$letter->booking->plot->plot_number?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Category: </td>
                    <td><?php echo @$letter->booking->plot->category->name?></td>
                </tr>
                <tr>
                    <td class="tbBold">Plot Size : </td>
                    <td><?php echo @$letter->booking->plot->size->size?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Booking Date: </td>
                    <td><?php echo date('d M,Y', strtotime(@$letter->booking->createdOn))?></td>
                </tr>
                <tr>
                    <td class="tbBold">File Status: </td>
                    <td><span class="bookingStatus"><?php echo (@$letter->booking->status==1)?'Booked':'Pending'?></span></td>
                </tr>
                
            </tbody>
          </table>
          <table class="table table-responsive col-md-4" style="font-size: 19px;border:2px solid;">
            <tbody>
                <tr>
                    <td class="tbBold">Plot Amount: </td>
                    <td><?php echo 'Rs. '.@number_format($letter->booking->plot->total)?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Dev. Amount: </td>
                    <td>0<?php //echo @$letter->booking->plot->plot_number?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Extra Amount: <br/><span style="font-size:10px">
                        <?php echo ($letter->booking->plot->is_road_facing==1)?'Road Facing, ':''?>
                        <?php echo ($letter->booking->plot->is_corner==1)?'Corner, ':''?>
                        <?php echo ($letter->booking->plot->is_park_facing==1)?'Park Facing, ':''?>
                        <?php echo ($letter->booking->plot->is_west_open==1)?'West Open, ':''?>
                    </span></td>
                    <td><?php echo 'Rs. '.@$this->plotTotal(@$letter->booking->plot->id,true,false)?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Transfer Charges: </td>
                    <td>0<?php //echo @$letter->booking->plot->plot_number?></td>
                </tr>
                <tr>
                    <td class="tbBold">Size Difference: </td>
                    <td>0<?php //echo @$letter->booking->plot->plot_number?></td>
                </tr>
                <tr>
                    <td class="tbBold">Less Discount: </td>
                    <td>0<?php //echo @$letter->booking->plot->plot_number?></td>
                </tr>
                <tr>
                    <td class="tbBold">Total: </td>
                    <td><?php echo 'Rs. '.@$this->plotTotal($letter->booking->plot->id,true,true)?></td>
                </tr>
            </tbody>
          </table>
        </div>
        <?php
          if($letter->reminder == 1){
            $reminder = 'First';  
            $days = @$letter->days.' days of receipt of this letter otherwise late payment penalty shall be charged at the prevailing rate.';
          }
          if($letter->reminder == 2){
            $reminder = 'Second';  
            $days = @$letter->days.' days of receipt of this letter otherwise late payment penalty shall be charged at the prevailing rate.';
          }
          if($letter->reminder == 3){
            $reminder = 'Final';  
            $days = @$letter->days.' days of receipt of this letter otherwise we will cancel your plot.';
          }


          $penalty = '';
          if($letter->penalty !=''){
            $penalty = ' and your penality amount Rs.'.$letter->penalty.'/- ';
          }
          
        ?>
        <div class="col-md-12 text-center py-3"><b style="    font-size: 25px;"><?php echo @$reminder?> Reminder for the Payment of Outstanding Dues</b></div>
        </div>
     
     <div class="col" style="font-size:23px!important;">
      <br>
    <label for="staticEmail" class=" col-form-label">Date : <?php echo date('d M, Y')?></label>
    <br>
    <label for="staticEmail" class=" col-form-label">Respected <b><?php echo @$letter->booking->customer->name?></b>,</label>
    <p><label for="staticEmail" class=" col-form-label"><b><?php echo @$letter->booking->customer->mobile?></label></b></p>
    <p><label for="staticEmail" class=" col-form-label" style="width: 50%;"><?php echo @$letter->booking->customer->address?></label></p>
    <br>
    <label for="staticEmail" class=" col-form-label">Assalam o Alaikum </label>
    <br>
    <label for="staticEmail" class=" col-form-label ">This letter is to formally notify you that the outstanding payment Rs. <?php echo @$letter->amount?>/- <?php echo @$penalty?> onwed by against above mentioned Plot is past due. Kindly make payment of above mentioned amount within <?php echo @$days ?></label><br>
    <label for="staticEmail" class=" col-form-label ">If your payment has already been made, please disregard this letter. However, if you have not made payment, kindly do so immediately.</label>
    <br>
    <label for="staticEmail" class="col-form-label"><br>Thankyou for attending to this matter as soon as possible.<br></label>
  </div>
</div> 
    <div class="col">
    
    
    <div class="form-group row">
     <div class="col-md-12">
       <div class="row">
         <div class="col-md-4">
           <div class="form-group row">
             
              <div class="col-sm-8">
                <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid black;margin-left: -5%;" >
              </div>
    <label for="staticEmail" class=" col-form-label"><b>Kainat City & Developers</b></label>
           </div>
         </div>
        </div>
     </div>
     <label for="staticEmail" class=" col-form-label py-5">If your payment has already been made, please disregard this letter and send the copies of payment receipts for updating of our record.</label>
    <label for="staticEmail" class=" col-form-label text-center" style="font-size: 14px">This is system generated letter and does not require signature.</label>
    </div>
    </div>
    </div>

    </form>
    
    </div>