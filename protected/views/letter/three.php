    <?php $userModel = Yii::app()->session->get('userModel');?>
    <style type="text/css">
      .text-center {
          margin-bottom: 1%;
      }
      .form-control-plaintext{
        text-align: center;
      }
      .text-light {
          color: #f8f9fa!important;
          font-size: 27px;
          padding: 5px;
      }
    </style>
    <div class="" style="padding-top: 10px; padding-bottom: 10px;">
      <form>   
      <div class="py-2 ">
      <div class="col align-self-center text-center"><h2>Transfer Certificate of Title</h2></div>
      <!-- <div class="col align-self-center text-center"><h2>Transfer Certificate of Title</h2></div> -->
       <div class="row ">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
             <h4>Kainat City & Developers</h4>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-12">
             <div class="row">
               <div class="col-md-3">
                 <div class="form-group row">
              <label for="staticEmail" class="px-3 col-form-label">S.No:</label>
              <div class="col-sm-6">
                <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->id?>">
              </div>
            </div>
               </div>
             </div>
            </div>
      </div>
      </div>
      <div class="row">
       <div class="col align-self-center text-center"><p class="text-light bg-dark">Unit Information</p></div>
       <div class="col-md-12" >
         <div class="form-group row ">
            <label for="staticEmail" class="col-sm-2 col-form-label px-3"><b>Project :</b></label>
            <div class="col-sm-5">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="Kainat City">
            </div>
           </div>
           <div class="form-group row ">
             <label for="staticEmail" class="col-sm-2 col-form-label px-3"><b>City :</b></label>
              <div class="col-sm-5">
                <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="Karachi">
              </div>
           </div>
           <div class="form-group row ">
            <label for="staticEmail" class="col-sm-2 col-form-label px-3"><b>Plot No:</b></label>
            <div class="col-sm-4">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->booking->plot_number?>">
            </div>
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>Block:</b></label>
            <div class="col-sm-2">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->booking->block_number?>">
            </div>
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>Size:</b></label>
            <div class="col-sm-2">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->booking->size->size?>">
            </div>
           </div>
           <div class="form-group row ">
          <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>Category:</b></label>
          <div class="col-sm-4">
            <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->booking->category->name?>">
          </div>
          <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>File Id:</b></label>
          <div class="col-sm-4">
            <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->booking->id?>">
          </div>
          </div>
          </div>
       </div>
       <div class="row">
       <div class="col align-self-center text-center"><p class="text-light bg-dark">Seller's Information</p></div>
       <div class="col-md-12" >
         <div class="form-group row ">
            <label for="staticEmail" class="col-sm-2 col-form-label px-3"><b>Seller's Name :</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->oldCustomer->name?>">
            </div>
           </div>
           <div class="form-group row ">
            <label for="staticEmail" class="col-sm-2 col-form-label px-3"><b>S/o , D/o , W/o :</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->oldCustomer->father_husband_name?>">
            </div>
           </div>
           <div class="form-group row ">
            <label for="staticEmail" class="col-sm-2 col-form-label px-3"><b>Seller's CNIC No :</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->oldCustomer->cnic?>">
            </div>
           </div>
           <div class="form-group row ">
            <label for="staticEmail" class="col-sm-2 col-form-label px-3"><b>Address :</b></label>
            <div class="col-sm-9">
            <textarea class="form-control-plaintext" rows="2" style="border-bottom: 1px solid lightgray;"><?php echo $transfered->oldCustomer->address?></textarea>
              <!-- <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->booking->category->name?>"> -->
            </div>
           </div>
           <!-- <div class="form-group row ">
            <label for="staticEmail" class="col-sm-2 col-form-label px-3"><b>File Status:</b></label>
            <div class="col-sm-5">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->booking->category->name?>">
            </div>
             <label for="staticEmail" class="col-sm-2 col-form-label px-3"><b>Regular:</b></label>
            <div class="col-sm-5">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->booking->category->name?>">
            </div>
           </div> -->
          </div>
       </div>
        <div class="row">
       <div class="col align-self-center text-center"><p class="text-light bg-dark">Details of Dues & Amount Received</p></div>
       <div class="col-md-12" >
         <div class="form-group row ">
            <label for="staticEmail" class="col-sm-3 col-form-label px-3"><b>Total Dues Regular Amount :</b></label>
            <div class="col-sm-5">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo ucwords($this->getIndianCurrency($this->plotTotal($transfered->booking->id,false)))?>">
            </div>
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>PKR :</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo 'Rs. '.$this->plotTotal($transfered->booking->id)?>">
            </div>
           </div>
           <div class="form-group row ">
            <label for="staticEmail" class="col-sm-3 col-form-label px-3"><b>Total Received Amount :</b></label>
            <div class="col-sm-5">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo ucwords($this->getIndianCurrency($netTotal))?>">
            </div>
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>PKR :</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo 'Rs. '.number_format($netTotal)?>">
            </div>
           </div>
          <div class="form-group row ">
            <label for="staticEmail" class="col-sm-3 col-form-label px-3"><b>Balance Dues Amount :</b></label>
            <div class="col-sm-5">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo ucwords($this->getIndianCurrency($this->plotTotal($transfered->booking->id,false) - $netTotal))?>">
            </div>
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>PKR :</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo 'Rs. '.number_format($this->plotTotal($transfered->booking->id,false) - $netTotal)?>">
            </div>
           </div>
           <!-- <div class="form-group row ">
            <label for="staticEmail" class=" col-form-label px-3"><b>Comments :</b></label>
            <div class="col-sm-10">
            <textarea class="form-control-plaintext" rows="2" style="border-bottom: 1px solid lightgray;"><?php echo $this->plotTotal($transfered->booking->id)?></textarea>
            </div>
           </div> -->
          </div>
       </div>
         <div class="row">
       <div class="col align-self-center text-center"><p class="text-light bg-dark">Buyer's Information</p></div>
       <div class="col-md-12" >
         <div class="form-group row ">
            <label for="staticEmail" class="col-md-2 col-form-label px-3"><b>Buyer's Name :</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->newCustomer->name?>">
            </div>
           </div>
           <div class="form-group row ">
            <label for="staticEmail" class="col-md-2 col-form-label px-3"><b>S/o , D/o , W/o :</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->newCustomer->father_husband_name?>">
            </div>
           </div>
           <div class="form-group row ">
            <label for="staticEmail" class="col-md-2 col-form-label px-3"><b>Buyer's CNIC No :</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo $transfered->newCustomer->cnic?>">
            </div>
           </div>
           <div class="form-group row ">
            <label for="staticEmail" class="col-md-2 col-form-label px-3"><b>Buyer's Address :</b></label>
            <div class="col-sm-9">
            <textarea class="form-control-plaintext" rows="2" style="border-bottom: 1px solid lightgray;"><?php echo $transfered->newCustomer->address?></textarea>
              <!-- <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" > -->
            </div>
           </div>
           
          </div>
       </div> 
        <div class="row">
       <div class="col align-self-center text-center"><p class="text-light bg-dark">Clearance For Departments</p></div>
       
       <div class="col-md-12" >
       <h5>Recovery</h5>
         <div class="form-group row ">
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>Name :</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo ucwords($userModel['first_name'].' '.$userModel['last_name'])?>">
            </div>
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>Sign :</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" >
            </div>
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>Date :</b></label>
            <div class="col-sm-3">
              <input type="date" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo date('Y-m-d')?>">
            </div>
           </div>
           <!-- <h5>Accounts & Date</h5>
         <div class="form-group row ">
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>Name :</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" >
            </div>
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>Sign :</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" >
            </div>
            <label for="staticEmail" class="col-sm-1 col-form-label px-3"><b>Date :</b></label>
            <div class="col-sm-3">
              <input type="date" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo date('Y-m-d')?>">
            </div>
           </div> -->
          </div>
       </div> 
     <div class="row">
       <div class="col align-self-center text-center"><p class="text-light bg-dark">Approval Granted</p></div>
       <div class="col-md-12">
       <h5>Higher Management</h5>
         <div class="row">
           <div class="col-md-4">
           <div class="form-group row" >
          <label for="staticEmail" class="col-sm-3 col-form-label px-3"><b>Sign :</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" >
            </div>
          </div>
         </div>
         <div class="col-md-4"></div>
         <div class="col-md-4">
           <div class="form-group row">
             <label for="staticEmail" class="col-sm-3 col-form-label px-3"><b>Date :</b></label>
            <div class="col-sm-9">
              <input type="date" class="form-control-plaintext" style="border-bottom: 1px solid lightgray;" value="<?php echo date('Y-m-d')?>">
            </div>
           </div>
         </div>
         </div>
       </div>
       </div>           
    </form>
    </div>
