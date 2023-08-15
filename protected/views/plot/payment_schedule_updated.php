<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Schedule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .main {
            /*width: 595px;*/
            width: 710px;
            height: 842px;
            /* border: 2px solid black; */
            padding-top: 200px;
            font-size: 13px;
        }
        .content {
            text-align: justify;
            line-height: 30px;
        }
        span {
            display: inline-block;
            width: 10%;
            /*border-bottom: 1px solid black;*/
            text-decoration: underline;
            text-align: center;
            font-weight: bold;

            /*padding-left: 20px;
            padding-right: 20px;*/
        }
        span.customSpan{
            width: auto!important;
            text-transform: uppercase;
            padding-left: 8px;
            padding-right: 8px;
        }

        span.calc{
            width: auto!important;
            text-transform: uppercase;
            border-bottom: 0;
            text-decoration: none;
        }

        /*td {
            padding: 3px 15px;
            border: 1px solid black;
        }*/
        .right {
            text-align: right;
        }
        .center h6 {
            text-align: center;
        }
        .pagebreak { 
            page-break-before: always; 
        } /* page-break-after works, as well */
    </style>
</head>
<body>

    
        <?php 
            $cornerCharger = 0;
            $parkFacing = 0;
            $westOpen = 0;
            $extraCharge = 0;
            $plotTotal = $plot->total;
            $plotTotalExtra = $plotTotal;
            $extraCost = 0;
            if($plot->discount > 0) {
                $plotTotal = $plotTotalExtra = $plotTotal - $plot->discount;
            }

            if($plot->is_corner == 1){
                $cornerCharger = $this->Percentage($plotTotal,$plot->is_corner_amount,0);
                $plotTotalExtra = $plotTotal + $cornerCharger;
                $extraCost = $extraCost + $cornerCharger;
            }

            if($plot->is_park_facing == 1){
                $parkFacing = $this->Percentage($plotTotalExtra,$plot->is_park_facing_amount,0);
                $plotTotalExtra = $plotTotalExtra + $parkFacing;
                $extraCost = $extraCost + $parkFacing;
            }

            if($plot->is_west_open == 1){
                $westOpen = $this->Percentage($plotTotalExtra,$plot->is_west_open_amount,0);
                $plotTotalExtra = $plotTotalExtra + $westOpen;
                $extraCost = $extraCost + $westOpen;
            }

            //if($plot->is_road_facing == 1){
            $extraCharge = 'PKR '.number_format(@$plotTotalExtra/(str_replace(' SQ Yrd','',$plot->size->size))).' per SQ Yrd';
            //}
        ?>
    
<div class="pagebreak"> </div>
<style>
    .mainT {
        width: 800px;
        height: 842px;
        /* border: 2px solid black; */
        /* padding-top: 200px; */
        font-size: 10px!important;
        margin: 0px auto;
    }
    .contentT {
        text-align: justify;
        line-height: 30px;
    }
    
    .right {
        text-align: right;
    }
    .center h6 {
        text-align: center;
    }
    ol {
        margin-left: 0px;
        padding-left: 0px;
    }
    p, li {
        margin-bottom: 5px!important;
        font-size: 10px!important;
        line-height: 16px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .abs {
        position: absolute;
        top: 40px;
        right: 10px;
    }
</style>
<div class="mainT container">
            <div class="container contentT">
                <div class="center"><h6>TERMS AND CONDITIONS PAYMENT SCHEDULE</h6></div>
                <p>
                    I/we, the undersigned do hereby accept, confirm, affirm and agree to abide by all the following Terms and Conditions, in addition to all other Terms and 
                    Conditions which are already applicable and/or may be imposed by the company from time to time. These terms and conditions signed and accepted by me/us 
                    herewith will supersede the terms and conditions accepted at the time of booking by me/us and/or my/our predecessor(s) on the booking application form(s) and/or 
                    TCR form(s), lease deeds and/or any other documents signed/executed by me/us and/or my/our predecessor(s). However, in case anything is inconsistent in any 
                    and/or all previous terms and conditions or in conflict with the present, the present will prevail. It is specifically agreed that these terms and conditions being
                    signed and accepted by me/us herewith will be deemed to be effective from the date of original booking of this plot. I/we fully understand and agree that my/our 
                    registration/booking/reservation and allotment/lease (where applicable) is subject to my/our unequivocal and unconditional acceptance of the terms and conditions 
                    herein, therefore I/we hereby waive/surrender my right to challenge these
                </p>
                <p>
                    <ol>
                        <li>
                            I shall abide by all the national and intentional by-laws otherwise the Company has the right to cancel my registration.
                        </li>
                        <li>
                            Lease, development, documentation and all other Extra charges will be paid by me on the demand of the Company.
                        </li>
                        <li>
                            I hereby agree to pay charges for the conservancy, water consumption, electric for street light and water pumps, charges for maintenance and running of 
    roads, amenities in " KAINAT CITY" from the date specified in the booking form until the formation of the Company of the residents/allottees
                        </li>
                        <li>
                            Although, the Company would make every effort to obtain water supply, sewerage, and gas supply at the earliest. Yet the Company accepts no 
    responsibility if the supply of any above-mentioned services is delayed.
                        </li>
                        <li>
                            The allottee will pay taxes etc. Levied by Federal/ Provincial Government, local bodies and municipal bodies or any other authorities, including those 
                            existing at present and those which may be levied by the above mentioned and/ or other authorities in future
                        </li>
                        <li>
                            The construction on the plot shall be strictly in accordance with applicable town planning and architecture (control) Rules and Regulations of the 
                            concerned authorities, A No Objection Certificate (NOC) will have to be obtained from Company before submitting the building plans for the approval 
                            of the authorities. The Company will give its No Objection Certificate (NOC) after clearance of all dues of the Company and payment by the allottee of 
                            NOC fee prescribed by the Company No construction on the plot shall be carried out with due approval by the authorities and animation of such 
                            approval to the Company.
                        </li>
                        <li>
                            All correspondence by the company including notice of payment, shall be posted at the given address of the applicant, as per record of the Company. 
                            The Company shall however not be responsible for non-delivery of Demand Notices and other correspondence due to any reason including change of 
                            address of the applicant.
                            
                        </li>
                        <li>
                            The minor changes in the designing or lay-out of " KAINAT CITY" may be made by the Company subject to approval from the authorities.
                        </li>
                        <li>
                            The Allocation of plot/ plots shall remain provisional until the full payment is received by the Company.
                        </li>
                        <li>
                            The allottee may cancel or withdraw from this booking in writing only after 2 years and the amount will be refunded after the project completion of 
                            Kainat City, Scheme 45, Karachi on the terms and conditions mentioned below
                        </li>
                        <li>
                            If the allottee wants to cancel the plot or wants to withdraw then 20% of the total cost of land will be deducted from total paid amount and will be 
                            refunded after receiving cancelation or with draw request from allottee in writing
                        </li>
                        <li>
                            The areas of plots mentioned are approximate, Upon actual measurement, if the area is found more or less. The buyers shall be charged on the actual 
    area on a proportionate basis. There will be no objection from the member (allottee) if Plot No. is changed due to any frictional reason.
                        </li>
                        <li>
                            The allottee shall take over the possession of the plot within 30 days of the receipt of intimation from the Company. In case of delay in taking 
                            possession, the company shall charge Rs. 500/- per month for the first 12 months from the notified date. If the allottee fails to take possession of the 
                            plot beyond 12 months of the notified date, he/she will be liable to pay the Company Rs. 1500/- per month till such time possession of the plot is taken 
                            over. After handing over of the plot/plots of land to the allottees., the allottees shall be responsible for the safety of their respective plots and the 
                            company shall in no way be responsible for the safety of allottees’ plot/ plots. Both at the time or receiving possession order as well as act the time of 
                            taking physical possession of the plot at the site. The allottee will have to identify himself/ herself at least by means of a Citizen National Identity Card
                            (CNIC).
                        </li>
                        <li>
                            In case of non-payment installments for three intervals of the month (3 months defaulter member) the process of cancellation will be instituted and the 
                            plot will be canceled after two notices given by the company
                        </li>
                        <li>
                            Extra charges for a corner, West open Park Facing, and extra land will be paid in full by the allottee on company demand.

                        </li>
                        <li>
                            The booking holder hereby confirms to have read and understood the terms and conditions stipulated hereinabove and undertake to abide by the same 
    unconditionally and unequivocally.
                        </li>
                    </ol>
                </p>
                <div style="padding-top: 20px;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="text-align: left; width: 50%;">
                                Date : <span></span><span></span>
                            </td>
                            <td style="text-align: right; width: 50%;">
                                <br>
                                <br>
                                <br>
                                <span></span><span></span><span></span> <br><br><br>
                                Signature & Thumb Impression <br><br><br>
    of Booking Registration Holder
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
</body>
</html>