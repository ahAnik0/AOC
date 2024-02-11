@extends('frontend.home.app')
@section('title', 'Refund Policy')
{{-- @push('css')
@endpush --}}
<style nonce="{{ csp_nonce() }}">
    .css1 {
        margin: 0cm;
        font-size: 13px;
        font-family: "Times New Roman", serif;
    }

    .css2 {
        font-size: 17px;
        font-family: "Calibri", sans-serif;
    }

    .css3 {
        list-style-type: decimal;
        margin-left: 12.5px;
    }

    .css4 {
        font-family: "Calibri";
    }

    .css5 {
        font-size: 13.0pt;
    }

    .css6 {
        list-style-type: lower-roman;
    }

    .css7 {
        margin: 0cm;
        font-size: 15px;
        font-family: "Calibri", sans-serif;
        text-align: justify;
    }

    .css8 {
        font-size: 17px;
    }

    .css9 {
        list-style-type: decimal;
    }

    .css10 {
        margin-bottom: 0cm;
        list-style-type: decimal;
    }
</style>
@section('content')
    <section class="inn-banner-section contact-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{ asset('assets/frontend/img/Contact_icon.png') }}">
                <h1>Refund Policy</h1>
            </div>
        </div>
    </section>


    <section class="space-ptb course-list bg-light">

        <div class="container ">
            <div class="row">
                <div class="col-md-12">

                    <p class="css1"><span class="css2">Army Officers Club is a social establishment. So Army Officers
                            Club have not provided anything return or refund. It is a non-return &amp; non-refundable
                            establishment. &nbsp;&nbsp;</span>
                    </p>
                    <ol class="decimal_type" class="css3">
                        <li><strong><span class="css4">RETURN/ REFUND POLICY TO CUSTOMERS</span></strong>
                            <ol class="decimal_type" class="css9">
                                <li>
                                    <span class="css5">In the event of a Customer making a purchase by using a Valid Card
                                        or through Net-Banking or otherwise through any mode of payment mechanism and upon
                                        the Customer or Issuing Bank / institution with whom the Customer has taken the card
                                        or the Payment Gateway Facilitator through whom the customer has utilized any mode
                                        of payment mechanism requesting SSL, the Facility Providers or the Banks or the
                                        Payment Gateway Facilitator for a refund on any grounds whatsoever within a period
                                        of 15 days from the actual delivery of the Products, then SSL, the Banks or the
                                        Payment Gateway Facilitator shall be entitled to cancel Authorization and refuse to
                                        make any payments to Army Officers&rsquo; Club Dhaka and/or enforce a refund from
                                        Army Officers&rsquo; Club Dhaka. SSL shall forthwith inform Army Officers&rsquo;
                                        Club Dhaka of the same and shall debit the payment to be made to Army
                                        Officers&rsquo; Club Dhaka&rsquo;s Account and make an intermediate credit in SSL
                                        Account, irrespective of any dispute that Army Officers&rsquo; Club Dhaka may have
                                        pertaining to such debit. If Army Officers&rsquo; Club Dhaka and the Customer are
                                        unable to arrive at a satisfactory resolution of the problem within a period of
                                        fourteen days thereafter, SSL shall be entitled to make a direct credit to the
                                        disputing Customer&rsquo;s Account for the disputed amount. Such a debit to Army
                                        Officers&rsquo; Club Dhaka&rsquo;s Account and the direct credit to the disputing
                                        Customer&rsquo;s Account shall not be disputed by Army Officers&rsquo; Club Dhaka in
                                        any manner whatsoever. In the event of the Customer and Army Officers&rsquo; Club
                                        Dhaka arriving at a settlement within the said fourteen day period, SSL shall deal
                                        with the said moneys in accordance with the terms of the settlement arrived at. If
                                        there is insufficient credit balance of Army Officers&rsquo; Club Dhaka with SSL;
                                        Army Officers&rsquo; Club Dhaka, shall on receipt of the claim from SSL, undertakes
                                        to forthwith pay to SSL the amount of the refund within 48 hours of such
                                        demand.</span>
                                </li>
                                <li>
                                    <span class="css5">In the event Army Officers&rsquo; Club Dhaka accepts a customer
                                        order/agrees to provide the service to the customer but however subsequently
                                        notifies to SSL about Army Officers&rsquo; Club Dhaka&rsquo;s inability to comply
                                        with a customer order/service Army Officers&rsquo; Club Dhaka shall forthwith make a
                                        proper cancellation for giving effect to the same as well as provide the funds in
                                        their account to facilitate a refund of the entire amount due to the customer. Any
                                        deductions made by SSL from Army Officers&rsquo; Club Dhaka shall not be challenged
                                        by Army Officers&rsquo; Club Dhaka for any reason whatsoever.</span>
                                </li>
                                <li>
                                    <span class="css5">In the event of a refund to a cardholder in respect of any
                                        transaction of any goods/ services that are not received as ordered by the
                                        Cardholder or are lawfully rejected or accepted for or services are not performed or
                                        partly performed or cancelled or price is lawfully disputed by the Cardholder or
                                        price adjustment is allowed or for any other reason whatsoever, Army Officers&rsquo;
                                        Club Dhaka shall not process a refund transaction and/or make a cash refund directly
                                        to the cardholder. Army Officers&rsquo; Club Dhaka must not process a refund
                                        transaction, unless there is a preceding corresponding debit on a card account. Army
                                        Officers&rsquo; Club Dhaka must present to SSL a credit slip/credit process/ refund
                                        letter on headed stationary and signed by authorized signatory/ies which will
                                        include details of a brief description of the items concerned upon which SSL is
                                        authorized to deduct from Army Officers&rsquo; Club Dhakas account the total
                                        refund(s) due to the cardholder(s) and in the event of there being a shortfall in
                                        the account of Army Officers&rsquo; Club Dhaka to provide for the said amount then
                                        Army Officers&rsquo; Club Dhaka shall forthwith make provisions for the same failing
                                        which Army Officers&rsquo; Club Dhaka shall be liable to pay interest at the rate
                                        then currently charged to cardholders in respect of their indebtedness from the due
                                        date until the date of payment (as well as after and before any demand made or
                                        judgment obtained). A true and completed copy of the credit slip must be delivered
                                        or forwarded to the Cardholder.</span>
                                </li>
                                <li>
                                    <span class="css5">In the event of a refund being agreed to be made by Army
                                        Officers&rsquo; Club Dhaka to the cardholder, a valid credit slip shall be issued by
                                        Army Officers&rsquo; Club Dhaka to SSL or Army Officers&rsquo; Club Dhaka shall
                                        initiate refund request via SSL web panel (as the case may be) within seven to nine
                                        working days after the refund has been agreed between Army Officers&rsquo; Club
                                        Dhaka and the Customer. SSL, within 07 working days of refund initiation by Army
                                        Officers&rsquo; Club Dhaka, shall convey such refund request to the Bank and/or
                                        other facilitator for necessary refund processing. Furthermore, SSL shall:
                                        &nbsp;&nbsp;</span>
                                    <ol class="css6">
                                        <li><span class="css5">Debit Army Officers&rsquo; Club Dhaka&apos;s account
                                                forthwith; and/or</span></li>
                                        <li>
                                            <span class="css5">Deduct the outstanding amount from subsequent credits to
                                                Army Officers&rsquo; Club Dhaka&apos;s account; and/ or</span>
                                        </li>
                                        <li>
                                            <span class="css5">If there is no credit amount with SSL, or insufficient
                                                funds available therein, claim from Army Officers&rsquo; Club Dhaka the
                                                amount credited to the account in respect of the relative transaction/s
                                                along with interest thereon.</span>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                    </ol>
                    <p class="css7"><span class="css8">&nbsp;</span></p>
                    <p class="css7"><span class="css8">Provided that, if it appears before SSL that there is a concern
                            regarding the legitimacy of the customers/Army Officers&rsquo; Club Dhaka transaction and/or
                            dispute/fraud is involved and/or Customers/Army Officers&rsquo; Club Dhaka&rsquo;s transaction
                            is suspicious in nature and/or there is an insufficient fund of Army Officers&rsquo; Club Dhaka
                            for refund settlement or other reasonable grounds, SSL shall have the right to hold such refund
                            for the period as may be determined reasonable by SSL and Army Officers&rsquo; Club Dhaka will
                            be notified by SSL regarding as such action accordingly.&nbsp;</span>
                    </p>
                    <p class="css7"><span class="css8">&nbsp;</span></p>
                    <div class="css1">
                        <ol class="css10">
                            <li class="css1"><span class="css5">All the refund related charges and/or or reversal of TDR
                                    shall be applicable as per prevailing policy of the concerned payment channel in
                                    relation to the refund processing.</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
@endpush
