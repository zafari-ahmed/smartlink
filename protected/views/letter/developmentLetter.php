<div class="container" style="margin-top: 25px;margin-left: 5%;">
  <img src="<?php echo Yii::app()->baseUrl?>/images/logo2.png" style="    position: absolute;z-index: 999;width: 80%;margin-top: 10%;margin-left:1.5%;opacity: 0.3;">
      <form>

    
      <div class="py-2 ">
       <div class="row">
            <div class="col-2">
             <b><img src="<?php echo Yii::app()->baseUrl?>/images/logo1.png" style="max-width: 130%;margin-top: -15px;"></b>
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
        <?php /*?>
        <div class="col-md-12">
        <div class="row">
          <div class="col-4 text-center border border-secondary bg-light" ><b>CUSTOMER INFORMATION</b></div>
          <div class="col-4 text-center border border-secondary bg-light" ><b>PLOT INFORMATION</b></div>
          <div class="col-4 text-center border border-secondary bg-light" ><b>COST INFORMATION</b></div>
        </div>
        </div>
        <?php */?>
        <div class="col-md-12">
        <?php /*?>
        <div class="row">
          <table class="col-md-4 table table-responsive" style="font-size: 19px;border:2px solid;">
            <tbody>
                <tr>
                    <td class="tbBold">File ID: </td>
                    <td><?php echo @'ARC-'.$booking->plot->block_number.'-'.$booking->plot->plot_number?></td>
                </tr>
                <tr>
                    <td class="tbBold">Name: </td>
                    <td><?php echo @$booking->customer->name?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">S/o, W/o, D/o: </td>
                    <td><?php echo @$booking->customer->father_husband_name?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Address: </td>
                    <td><?php echo @$booking->customer->address?></td>
                </tr>
                <tr>
                    <td class="tbBold">Mobile: </td>
                    <td><?php echo @$booking->customer->mobile?></td>
                </tr>
                
                <tr>
                    <td class="tbBold">CNIC: </td>
                    <td><?php echo @$booking->customer->cnic?></td>
                </tr>
            </tbody>
          </table>
          <table class="table table-responsive col-md-4" style="font-size: 19px;border:2px solid;    overflow: hidden;"> 
            <tbody>
                <tr>
                    <td class="tbBold">Computer ID: </td>
                    <td><?php echo @'ARC-'.$booking->plot->block_number.'-'.$booking->plot->plot_number?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Block: </td>
                    <td><?php echo @$booking->plot->block_number?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Plot No. : </td>
                    <td><?php echo @$booking->plot->plot_number?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Category: </td>
                    <td><?php echo @$booking->plot->category->name?></td>
                </tr>
                <tr>
                    <td class="tbBold">Plot Size : </td>
                    <td><?php echo @$booking->plot->size->size?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Booking Date: </td>
                    <td><?php echo date('d M,Y', strtotime(@$booking->createdOn))?></td>
                </tr>
                <tr>
                    <td class="tbBold">File Status: </td>
                    <td><span class="bookingStatus"><?php echo (@$booking->status==1)?'Booked':'Pending'?></span></td>
                </tr>
                
            </tbody>
          </table>
          <table class="table table-responsive col-md-4" style="font-size: 19px;border:2px solid;">
            <tbody>
                <tr>
                    <td class="tbBold">Plot Amount: </td>
                    <td><?php echo 'Rs. '.@number_format($booking->plot->total)?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Dev. Amount: </td>
                    <td>0<?php //echo @$booking->plot->plot_number?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Extra Amount: <br/><span style="font-size:10px">
                        <?php echo ($booking->plot->is_road_facing==1)?'Road Facing, ':''?>
                        <?php echo ($booking->plot->is_corner==1)?'Corner, ':''?>
                        <?php echo ($booking->plot->is_park_facing==1)?'Park Facing, ':''?>
                        <?php echo ($booking->plot->is_west_open==1)?'West Open, ':''?>
                    </span></td>
                    <td><?php echo 'Rs. '.@$this->plotTotal(@$booking->plot->id,true,false)?></td>
                    
                </tr>
                <tr>
                    <td class="tbBold">Transfer Charges: </td>
                    <td>0<?php //echo @$booking->plot->plot_number?></td>
                </tr>
                <tr>
                    <td class="tbBold">Size Difference: </td>
                    <td>0<?php //echo @$booking->plot->plot_number?></td>
                </tr>
                <tr>
                    <td class="tbBold">Less Discount: </td>
                    <td>0<?php //echo @$booking->plot->plot_number?></td>
                </tr>
                <tr>
                    <td class="tbBold">Total: </td>
                    <td><?php echo 'Rs. '.@$this->plotTotal($booking->plot->id,true,true)?></td>
                </tr>
            </tbody>
          </table>
        </div>
        <?php */?>
        <div class="col-md-12 text-center py-3"><b style="    font-size: 45px">DEVELOPMENT LETTER</b></div>
        </div>
     
     <div class="col" style="font-size:25px!important;">
      <br>
    <p style="clear: both;float: left;"><label for="staticEmail" class=" col-form-label">Date : <?php echo date('d M, Y')?></label></p>
    <p style="clear: both;float: left;"><label for="staticEmail" class=" col-form-label">Plot # : <?php echo @$booking->plot->block_number.' / '.@$booking->plot->plot_number?></label></p>
    <p style="clear: both;float: left;"><label for="staticEmail" class=" col-form-label">Respected <b><?php echo @$booking->customer->name?></b>,</label></p>
    <p style="clear: both;float: left;"><label for="staticEmail" class=" col-form-label">Ph #: <?php echo @$booking->customer->mobile?></label></p>
    <p style="clear: both;float: left;width: 100%;"><label for="staticEmail" class=" col-form-label" style="width: 40%;font-weight: bold"><?php echo @$booking->customer->address?></label></p>
    <br>
    
    <br>
    
    <br>
    <br/>
  </div>
</div> 
    <div class="col">
    
    
    <div class="form-group row" dir="rtl">
     
     <br/><br/>
     <div class="col-md-12">
       <div class="row">
         <div class="col-md-4">

           <div class="form-group row">
            
              <div class="col-sm-8">
                <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid black;margin-left: -5%;" >
              </div>
    
           </div>
         </div>
        </div>
     </div>
    </div>
    </div>
    </div>

    </form>
    
    </div>

