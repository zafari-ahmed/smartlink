<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Letter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .main {
            width: 710px;
            height: 842px;
            /* border: 2px solid black; */
            padding-top: 350px;
        }
        .content {
            text-align: justify;
            line-height: 30px;
        }
        span {
            display: inline;
            /*width: 80px;*/
            width: auto;
            border-bottom: 1px solid black;
            text-align: center;
            font-weight: bold;
            padding-right: 10px;
            padding-left: 10px;
        }
        td {
            padding: 5px 15px;
            border: 1px solid black;
        }
        .right {
            text-align: right;
        }
        .pagebreak { 
            page-break-before: always; 
        } /* page-break-after works, as well */
        .hide{
            display: none;
        }
    </style>
</head>
<body>
    <div class="main container hide">
        <?php $cinc = str_split(str_replace('-', '', $customerPlot->customer->cnic));?>
        <div class="container content">
            <?php if($duplicate==1){?>
            <div style="text-align: center;border: 2px solid #000;border-radius: 5px;margin-left: 35%;position: absolute;top: 5%;font-size: 30px;padding: 10px;font-weight: bold;">Duplicate</div>
            <?php } ?>
            The Booking of a <span><?php echo $customerPlot->plot->size->size?></span>, Block: <span><?php echo $customerPlot->plot->block_number?></span>, Plot Type: <span><?php echo $customerPlot->plot->plot_type?></span>,  bearing Plot  No.: <span><?php echo $customerPlot->plot->plot_number?></span>, <br/>Category:
            <b><?php echo ucfirst($customerPlot->plot->category->name)?></b>, made by Mr./Mrs. Miss <span> <?php echo ucfirst($customerPlot->customer->name)?></span>
            <br>
            <?php echo ucfirst($customerPlot->agent_name)?> of <span><?php echo ucfirst($customerPlot->customer->father_husband_name)?></span> having CNIC Number
            <table border="1" style="margin-top:1%">
                <tr>
                    <td><?php echo @$cinc[0]?></td>
                    <td><?php echo @$cinc[1]?></td>
                    <td><?php echo @$cinc[2]?></td>
                    <td><?php echo @$cinc[3]?></td>
                    <td><?php echo @$cinc[4]?></td>
                    <td>-</td>
                    <td><?php echo @$cinc[5]?></td>
                    <td><?php echo @$cinc[6]?></td>
                    <td><?php echo @$cinc[7]?></td>
                    <td><?php echo @$cinc[8]?></td>
                    <td><?php echo @$cinc[9]?></td>
                    <td><?php echo @$cinc[10]?></td>
                    <td><?php echo @$cinc[11]?></td>
                    <td>-</td>
                    <td><?php echo @$cinc[12]?></td>

                </tr>
            </table> 
            Resident of <span> <?php echo $customerPlot->customer->address?></span>, 
            <br>
            <br>
            In <b>Kainat City</b>, Scheme-45 vide Reg.No <span><?php echo $this->getBookingRegNo($customerPlot->id)?></span> hereby confirmed.
            <br>
            <br>
            This booking confirmation Letter is being issued on the terms and conditions mentioned
            herein overleaf, in addition to terms and conditions duly accepted and signed by the
            booking holder above named at the time of booking.
            <br><br><br>
            Karachi
            <br><br>
            <div class="row">
                <div class="col-md-6">Dated: <?php echo date('d M, o')?> </div>
                <div class="col-md-6 right" style="margin-top: -5%">For Essa Housing</div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 right" style="padding-top:12%">
                    DIRECTOR
                </div>
            </div>
            <div style="position: absolute;bottom: 3%;left: 55%;">021-37440935</div>
                                
        </div>
    </div>
    <div class="pagebreak"> </div>
    <style>
        .mainT {
            width: 810px;
            height: 850px;
            /* border: 2px solid black; */
            padding-top: 0px; 
            font-size: 20px!important;
            margin: 0px auto;
        }
        .contentT {
            text-align: justify;
            line-height: 30px;

        }
        span.terms {
            display: inline-block;
            width: 70px;
            border-bottom: 1px solid black;
        }
        td.terms {
            padding: 1px 15px;
            /* border: 1px solid black; */
            line-height: 5px;
            border: 0px solid #fff;
        }
        .rightT {
            text-align: right;
        }
        .centerT h6 {
            text-align: center;
        }
        ol {
            margin-left: 0px;
            padding-left: 35px;
            padding-right: 35px;
        }
        p, li {
            margin-bottom: 15px!important;
            font-size: 11px!important;
            font-weight: bold;
            line-height: 16px;
            font-family: Arial, Helvetica, sans-serif;

        }
        .absT {
            position: absolute;
            top: 40px;
            right: 30px;
        }
    </style>
    <div class="mainT container">
        <div class="container contentT">
            <div class="centerT"><h6>TERMS AND CONDITIONS</h6></div>
            <p>
                I/we, the undersigned do hereby accept, confirm, affirm and agree to abide by all the following Terms and Conditions, in addition to all other Terms and 
                Conditions which are already applicable and/or may be imposed by the company from time to time. These terms and conditions signed and accepted by me/us 
                herewith will supersede the terms and conditions accepted at the time of booking by me/us and/or my/our predecessor(s) on the booking application form(s) and/or 
                TCR form(s), lease deeds and/or any other documents signed/executed by me/us and/or my/our predecessor(s). However, in case anything is inconsistent in any 
                and/or all previous terms and conditions or in conflict with the present, the present will prevail. It is specifically agreed that these terms and conditions being
                signed and accepted by me/us herewith will be deemed to be effective from the date of original booking of this plot. I/we fully understand and agree that my/our 
                registration/booking/reservation and allotment/lease (where applicable) is subject to my/our unequivocal and unconditional acceptance of the terms and conditions 
                herein, therefore I/we hereby waive/surrender my right to challenge these;
            </p>
            <p>
                <ol>
                    <li>
                        This Booking Confirmation Letter is being issued for confirmation of the plot for booking. It does not in any way create any right and/or title in favour of the 
                        booking/reservation holder and can be withdrawn/cancelled by the company in case of failure of the allottee(s) in complying with the terms and conditions as 
                        prescribed by the company from time to time. This Booking Confirmation Letter and its continuance in force are always contingent upon adherence to the 
                        terms and conditions of the company as applicable from time to time.
                    </li>
                    <li>
                        That this Booking Confirmation Letter or any entitlement thereunder is neither transferable nor assignable without the prior written consent of the company 
                        and payment of transfer fee as fixed, revised, and/or increased by the company from time to time.
                    </li>
                    <li>
                        That this Booking Confirmation Letter will automatically stand canceled and/or revoked without any Notice to the Booking holder in case of failure to pay 
                        the dues in respect of occupancy value, development charges, outer development charges, additional development charges, redevelopment charges and Other
                        Charges for Special and other services/works etc. charged levied and/or leviable/recoverable at present and/or imposed in future in respect of the said plot 
                        and/or to change the frequency, timing and/or schedule of due dates and mode of payment. That the company reserves the right to cancel the allotment and 
                        resume/take over the possession of the said plot in case of non-compliance of any terms and conditions prescribed by the company from time to time at its 
                        sole discretion.
                    </li>
                    <li>
                        The Booking holder hereby confirms, affirm and acknowledge that the company's responsibility to carryout developments in Kainat City, Scheme 45, 
                        Karachi is limited to the provision of internal water supply network, internal sewerage disposal network, and construction of internal roads (excluding 
                        footpaths) within the said Scheme in accordance with approved layout plan. The installation of distribution networks, poles, structures, pipelines etc., and 
                        supply of Power, Telephone and/or Gas to consumers is the exclusive domain of duly licensed utility organizations and the company has no role in this 
                        regard. Similarly, although the company has provided water distribution network in the township as part of the internal development work, but supply of 
                        water is the exclusive domain of KWSB. The Booking holder will not hold the company responsible in any manner whatsoever, if these utility services i.e. 
                        water, power and/or gas supply or any other services by the MDA, KWSB, KE, SSGC or any other Organization /Agency /Entity/Authority is not made 
                        available, discontinued or is inadequate. The booking holder hereby waives/relinquish his/her right to protest and/or object against the company if the power, 
                        gas, water and/or any other utility supply is not made available in the Kainat City Township at large and/or his/her individually and jointly by KE, SSGC, 
                        KWSB and any other organization/entity entrusted with this job. The booking holder hereby acknowledges and confirms that provision of these utilities is a 
                        matter between his/her and these duly authorized organizations exclusively and therefore, the company has no responsibility whatsoever in this regard.
                    </li>
                    <li>
                        That the booking holder shall pay such taxes, ceases, premiums and charges that are payable or may be levied in future by any MDA/CDGK 
                        Municipal/Government or any other body or authority or the company.
                    </li>
                    <li>
                        That in case the housing project of the company is abandoned and/or plot booked/reserved/allotted/leased to him/her is deleted due to re-planning and/or revision of Layout Plan imposed by the Government and/or any Township regulating authority, and/or for any other reason contained herein. The booking holder shall not be entitled to claim any compensation, alternative plot, or damages and shall only be entitled to receive the refund of the occupancy value paid by him/her or as is mentioned in Lease Deed, within such time as fixed by the company.
                    </li>
                    <li>
                        The booking holder hereby acknowledges that it is his/her sole and critical responsibility, to visit the Project Site and office of the company at least once 
                        every quarter to keep himself/herself updated on status/ dues position and changes in the Terms and Conditions. He/she shall keep the Company fully 
                        indemnified against lack of knowledge on his/her part. He/she will serve a notice in writing duly acknowledged specifically by the company, within three 
                        months of any event taking place if booking holder has any objection/plea in respect of the same, failing which it shall be deemed to have been accepted and 
                        plea waived by him/her
                    </li>
                    <li>
                        The booking holder further acknowledges, confirm and affirm that it is his/her sole responsibility to be aware of the office location of the company and in 
                        case he/she is unable to locate the same, he/she shall at his/her own, contact the Registrar Joint Stock Companies and or any other institution to locate the 
                        office of the company. He/she shall keep the company fully indemnified against any claim, damages, etc for his/her lack of knowledge about the office 
                        location of the company
                    </li>
                    <li>
                        The booking holder hereby confirms to have read and understood the terms and conditions stipulated hereinabove and undertake to abide by the same unconditionally and unequivocally.
                    </li>
                </ol>
            </p>
            <div style="padding-top: 10%;">
                <table style="width: 100%;" border="0">
                    <tr>
                        <td class="terms" style="text-align: left; width: 25%;padding-bottom: 10px;font-weight: bold;font-size: 13px;">
                            Date : <span class="terms"></span>
                        </td>
                        <td class="terms" style="text-align: center;font-weight: bold; width: 75%;padding-bottom: 10px;font-weight: bold;font-size: 10px;line-height: 7px; padding-left: 45%;">
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