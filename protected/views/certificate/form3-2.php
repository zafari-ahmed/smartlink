<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocation Letter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .main {
            width: 710px;
            height: 842px;
            /* border: 2px solid black; */
            padding-top: 250px;
        }
        
        .content {
            text-align: justify;
            line-height: 30px;
        }
        span {
            display: inline-block;
            /*width: 80px;*/
            width: auto;
            /*border-bottom: 1px solid black;*/
            text-decoration: underline;
            text-align: center;
            font-weight: bold;
            padding-right: 10px;
            padding-left: 10px;
        }
        td {
            padding: 3px 15px;
            border: 1px solid black;
        }
        .right {
            text-align: right;
        }
        .center h6 {
            text-align: center;
        }
        .pagebreak { 
            page-break-before: always!important; 
        } /* page-break-after works, as well */

        .hide{
            display: none;
        }
/* For Terms And COnditions */
        .mainYY 
        {
            /*width: 820px;*/
            height: 842px;
            font-size: 8px!important;
            font-weight: bold;
            margin: 0px auto;
            /* border: 2px solid black; */
            /* padding-top: 275px; */
        }

        span.terms {
            display: inline-block;
            width: 70px;
            border-bottom: 1px solid #000;
        }
        td.terms {
            padding: 1px 15px;
            border: 1px solid white;
            line-height: 5px;
        }

        .mainYY ol {
            margin-left: 0px;
            padding-left: 30px;
            padding-right: 15px;
        }
        .mainYY p, .mainYY li {
            margin-bottom: 5px!important;
            font-size: 8px!important;
            font-weight: bold;
            line-height: 16px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .abs {
            position: absolute;
            top: 40px;
            right: 30px;
        }
    </style>
</head>
<body>
    <div class="main container">
        <div class="container content" >
            <div style="position: absolute;top: 19%;left: 20%;"><b><?php echo $this->getBookingRegNo($customerPlot->id)?></b></div>
            <div style="position: absolute;top: 19%;left: 76%;"><b><?php echo date('d M, o')?></b></div>
            
            <?php if($duplicate==1){?>
            <div style="text-align: center;border: 2px solid #000;border-radius: 5px;margin-left: 35%;position: absolute;top: 5%;font-size: 30px;padding: 10px;font-weight: bold;">Duplicate</div>
            <?php } ?>
            <br>
            <br>
            We are pleased to reserve Plot No. <span><?php echo $customerPlot->plot->plot_number?></span>, Plot Type <span><?php echo $customerPlot->plot->plot_type?></span>,  of size <span><?php echo $customerPlot->plot->size->size?></span>, in Block <span><?php echo $customerPlot->plot->block_number?></span> against your registration No. <span><?php echo $this->getBookingRegNo($customerPlot->id)?></span> in Kainat City, Scheme-45. 
            <br>
            <br>
            Kindly note, this reservation does not confer any right or title on the side plot it may be changed or
            amended, at any time by the company without assigning any reason thereof. The final plot number
            and title shall only be confirmed, with the execution of the lease deed in the allottee's favour.
            <br>
            <br>
            Furthermore, all conditions outlined in the Application Form and Booking Registration Confirmation
            Letter shall remain in force.
            <br>

            
            <div class="row">
                <div class="col-md-6">Assuring you of our best service</div>
                <div class="col-md-6 right"></div>
            </div>
            <div class="row">
                <div class="col-md-6">Dated: <?php echo date('d M, o')?> </div>
                <div class="col-md-6 right" style="margin-top: 10%">For Essa Housing</div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 right">
                    <br><br>
                    DIRECTOR
                </div>
            </div>
            <div style="margin-top:-20%">
            To,
            <br>
            Mr./Mrs. <span><?php echo ucfirst($customerPlot->customer->name)?></span>
            <br>
            <?php echo @$customerPlot->agent_name?>: <span><?php echo ucfirst($customerPlot->customer->father_husband_name)?></span>
            <br>
            CNIC: <span><?php echo $customerPlot->customer->cnic?></span>
            <br>
            Address: <span style="    width: 30%;display: block;text-decoration: underline;text-align: initial;margin-left: 9%;margin-top: -4%;border-bottom: none;font-size: 15px;line-height: 20px;"><?php echo $customerPlot->customer->address?></span>
            </div>           
        </div>

        <div style="position: absolute;bottom: 0%;left: 55%;">021-37440935</div>
    </div>
    <!-- <div class="pagebreak"> </div> -->
    <div class="container hide">

        <div class="mainYY container">
            <div class="container content" >
                <div class="center"><h6>TERMS AND CONDITIONS</h6></div>
                <p>
                    I/we the undersigned do hereby accept, affirm and agree to abide by all the following Terms and Conditions, in addition to all other Terms and Conditions which are already applicable and/or maybe imposed by the company from time to time. These terms and conditions signed and accepted by me/us herewith will supersede the terms and conditions accepted at the time of booking by me/us and/or my/our predecessor (s) on the booking application form (s) and/or TCR form(s) lease deeds and/or any other documents signed/executed by me/us and/or my/our predecessor (s). However, in case anything is inconsistent in any and/or all previous terms and conditions or in conflict with the present, the present will prevail. It is specifically agreed that these terms and conditions being signed and accepted by me/us herewith will be deemed to be effective from the date of original booking of this plot. I/we fully understand and agree that my/our registration/booking/reservation and allotment/lease (where applicable) is subject to my/our unequivocal and unconditional acceptance of the terms and conditions 
                    herein, therefore I/we hereby waive/surrender my right to challenge these;
                </p>
                <p>
                    <ol>
                        <li>
                            This Allocation Letter is being issued for communicating the particulars of the plot provisionally allocated to me/us. It does not in any way create any right 
                            and/or title in favor of the booking registration holder and can be withdrawn/cancelled by the company in case of failure of the booking registration holder in 
                            complying with the terms and conditions as prescribed by the company from time to time. This allocation letter and its continuous force are always 
                            contingent upon adherence to the terms and conditions of the company as applicable from time to time.
                        </li>
                        <li>
                            That this Allocation Letter or any entitlement thereunder is neither transferable nor assignable without the prior written consent of the company and payment 
                            of transfer fee as fixed, revised, and/or increased by the company from time to time.
                        </li>
                        <li>
                            That the above plot allocated to you is based on the approximate measurement and after the said plot has been measured and the exit area has been 
                            determined you will be paid the difference (if any) for the excess area as fixed by the company from time to time at its sole discretion likewise the company 
                            will refund or adjust the amount paid in excess if the area is decreased and booking registration holder(s) will have no claim whatsoever against the company. 
                            In case the allocation of the plot is changed due to re-planning and/or changes in the layout, a fresh allocation letter will be issued.                        
                        </li>
                        <li>
                            That this Allocation Letter will automatically stand canceled and/or revoked without any Notice to the Booking Registration holder in case of failure to pay 
                            the dues in respect of occupancy value, development charges, and regular periodic charges i.e. township management, maintenance charges, ground rent, 
                            water consumption, administrative charges, security and vigilance, company operations, non-utilization fee, development changes outer development 
                            charges, additional development charges, redevelopment charges, and Other Charges for Special and other services/works, etc. charged/levied and/or 
                            leviable/recoverable at present and/or imposed in future in respect of the said plot and/or to change the frequency, timing, and/or schedule of due dates and 
                            mode of payment. That the company reserves the right to cancel the allocation and resume/take over the said plot in case of non-compliance of any terms and 
                            conditions prescribed by the company from time to time at its sole discretion.
                        </li>
                        <li>
                            That the Booking Registration holder shall be entitled to Demarcation and Physical Possession only after the lease is executed and building plans duly 
                            consented and forwarded by the company have been approved by the MDA, CDGK, and/or any other municipal authority and the booking registration holder 
                            has cleared all the leviable/recoverable dues.
                        </li>
                        <li>
                            The Booking Registration holder hereby confirms, affirm and acknowledge the company's responsibility to carry out developments in Kainat City Scheme 45 
                            is limited to the provision of an internal water supply network, internal sewerage disposal network, and construction of internal roads (excluding footpaths) 
                            within the said Scheme in accordance with approved layout plan. The installation of distribution networks, poles, structures, pipelines, etc., and supply of 
                            Power, Telephone, and/or Gas to consumers is the exclusive domain of duly licensed utility organizations and the company has no role in this regard. 
                            Similarly, although the company has provided a water distribution network in the township as part of the internal development work, the supply of water is 
                            the exclusive domain of KWSB. The Booking Registration holder will not hold the company responsible in any manner whatsoever, if these utility services 
                            i.e. Water, power, and/or gas supply, or any other services by the MDA, KMC, KWSB, KESC, SSGC, or any other Organization Agency/Entity/Authority is 
                            not made available, discontinued, or is inadequate. The booking registration holder hereby waives/relinquish his/her right to protest and/or object against the 
                            company if the power, gas, water, and/or any other utility supply is not made available in the Kainat City Scheme 45 Township at large and/or his/her 
                            individually and jointly by KE, SSGC, KWSB, and any other organization/entity entrusted with this job. The booking registration holder hereby 
                            acknowledges and confirms that provision of these utilities is a matter between his/her and these duly authorized organizations exclusively and therefore, the 
                            company has no responsibility whatsoever in this regard.
                        </li>
                        <li>
                            That the booking registration holder shall pay such taxes, ceases, premiums, and charges that are payable or may be levied in future by any CDGK 
                            /Municipal/ Government or other body or authority or the company. 
                        </li>
                        <li>
                            That in case the housing project of the company is abandoned and/or allocated to higher is deleted due to re-planning and/or revision of Layout Plan Imposed 
                            by the Government and/or any Township regulating authority, and/or for any other reason contained herein, the Allocation Letter holder(s) shall not be 
                            entitled to claim any compensation, alternative plot, or damages and shall only be entitled to receive the refund of the occupancy value paid by him or as is 
                            mentioned in Lease Deed, within such time as fixed by the company.
                        </li>
                        <li>
                            The Booking Registration holder(s) hereby acknowledge that it is his/her sole and critical responsibility, to visit the Project Site and office off the company at least once every quarter to keep himself/herself updated on status/ dues position and changes in the Terms and Conditions. He/she shall keep the company fully indemnified against lack of knowledge on his/her part. He/she will serve a notice in writing duly acknowledged specifically by the company, within three months of any event taking place if the booking registration holder has any objection/plea in respect of the same, failing which it shall be deemed to have been accepted and plea waived by him/her.
                        </li>
                        <li>
                            The Booking Registration holder(s) further acknowledge, confirm and affirm that it is his/her sole responsibility to be aware of the office location of the 
                            company and in case he/she is unable to locate the same, he/she shall at his/her own, contact the Registrar Joint Stock Companies Indoor any other institution 
                            to locate the office of the company. He/she shall keep the Company fully indemnified against any claim, damages, etc for his/her lack of knowledge about 
                            the office location of the company.
                        </li>
                        <li>
                            The booking registration holder hereby confirm to have read and understood the terms and conditions stipulated hereinabove and undertake to abide by the same unconditionally and unequivocally.
                        </li>
                    </ol>
                </p>
                <div style="padding-top: 8%">
                <table style="width: 100%;" border="0">
                    <tr>
                        <td class="terms" style="text-align: left; width: 25%;padding-bottom: 10px;font-weight: bold;font-size: 13px;">
                            Date : <span class="terms"></span>
                        </td>
                        <td class="terms" style="text-align: center;font-weight: bold; width: 75%;padding-bottom: 10px;font-weight: bold;font-size: 10px;line-height: 7px; padding-left: 35%;">
                            <br>
                            
                            <span class="terms"></span><span class="terms"></span><span class="terms"></span> <br><br>
                            Signature & Thumb Impression <br><br>of Booking Registration Holder
                        </td>
                    </tr>
                </table>
            </div>
            </div>
        </div>
<script type="text/javascript">
    window.print();
</script>
</body>
</html>