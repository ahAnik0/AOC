@extends('frontend.home.app')
@section('title','About Us')
{{-- @push('css')
@endpush --}}
<style  nonce="{{ csp_nonce() }}">
    .css1{
        margin:0cm;font-size:13px;font-family:"Times New Roman",serif;
    }
    .css2{
        font-size:17px;font-family:"Calibri",sans-serif;
    }
    .css3{
        margin:0cm;font-size:13px;font-family:"Times New Roman",serif;margin-left:36.0pt;text-align:justify;
    }
    .css4{
        font-size:15px;font-family:"Calibri",sans-serif;
    }
    .css5{
        margin:0cm;font-size:13px;font-family:"Times New Roman",serif;margin-left:36.0pt;
    }
    .css6{
        font-size:11px;font-family:"Calibri",sans-serif;
    }
    .css7{
        margin:0cm;font-size:13px;font-family:"Times New Roman",serif;text-align:justify;
    }
    .css8{
        font-size:12px;font-family:"Calibri",sans-serif;
    }
    .css9{
        margin:0cm;font-size:13px;font-family:"Times New Roman",serif;margin-left:72.0pt;text-align:justify;
    }
    .css10{
        margin:0cm;font-size:13px;font-family:"Times New Roman",serif;margin-left:72.0pt;text-align:justify;
    }

</style>
@section('content')
    <section class="inn-banner-section contact-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{asset("assets/frontend/img/Contact_icon.png")}}">
                <h1>TERMS & CONDITION</h1>
            </div>
        </div>
    </section>
    
    
    <section class="space-ptb course-list bg-light">
        
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    
                    <p class="css1"><strong><span
                                    class="css2">Army Officers Club Membership Policy:</span></strong></p>
                    <p class="css1"><span class="css4">&nbsp;</span></p>
                    <p class="css1"><span class="css2">1. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Membership of Serving Army Officers</u>.</span>
                    </p>
                    <p class="css1"><span class="css6">&nbsp;</span></p>
                    <p class="css3"><span
                                class="css2">a. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;All officers working in Bangladesh Army can be members of this club. In case of membership, all should fill up the specific application form mentioned by the Army Officers Club and attach the necessary documents.</span>
                    </p>
                    <p class="css5"><span class="css10">&nbsp;</span></p>
                    <p class="css3"><span
                                class="css2">b.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Spouse or dependent children (below 25 years) before marriage who want to enjoy the benefits of Officers Club should also send application form in the same manner. In this case the spouse and children of the officer will be considered as family members and monthly membership fee will not be applicable in their case. However, other fees or utility charges will be applicable as per rules.</span>
                    </p>
                    <p class="css1"><span class="css2">&nbsp;</span></p>
                    <p class="css7"><span class="css2">2. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Membership of Retired Army Officers</u>.</span>
                    </p>
                    <p class="css7"><span class="css8">&nbsp;</span>
                    </p>
                    <p class="css3"><span
                                class="css2">a. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;LPR and retired officers of Bangladesh Army can be members of this club. In case of membership, all should fill up the prescribed application form and attach the necessary documents as mentioned by the Army Officers Club; President, Board of Directors, Army Officers Club through the Army Headquarters, CORO. In this case the following principles should be followed:</span>
                    </p>
                    <p class="css3"><span
                                class="css8">&nbsp;</span></p>
                    <p class="css9"><span
                                class="css2">(1) &nbsp; &nbsp; &nbsp;&nbsp;In the case of retired officers and their families, they will submit the application form to the Army Headquarters CORO as per the instructions of the Army Headquarters. The official process will be started after receiving the security clearance and application form from the AHQ CORO office.</span>
                    </p>
                    <p class="css9"><span
                                class="css8">&nbsp;</span></p>
                    <p class="css9"><span
                                class="css2">(2) &nbsp; &nbsp; &nbsp;&nbsp;In filling up the application form, all information and documents must be recorded or attached in accurate and detailed form. Any requested information or document recorded in incomplete or partial form in the form will not be accepted.</span>
                    </p>
                    <p class="css9"><span
                                class="css10">&nbsp;</span></p>
                    <p class="css9"><span
                                class="css2">(3) &nbsp; &nbsp; &nbsp;&nbsp;The contact address and personal mobile number mentioned in the application form must be correct and functional. Any change in contact address or mobile number should be immediately informed to the Officers Club Management Office.</span>
                    </p>
                    <p class="css9"><span
                                class="css10">&nbsp;</span></p>
                    <p class="css9"><span
                                class="css2">(4) &nbsp; &nbsp; &nbsp;&nbsp;Spouse or dependent children (above 25 years) before marriage who want to enjoy the facilities of Officers Club should send application form in the same manner. In this case the spouse and children of the officer will be considered as family members and monthly membership fee will not be applicable in their case. However, other fees or utility charges will be applicable as per rules.</span>
                    </p>
                    <p class="css1"><span class="css2">&nbsp;</span></p>
                    <p class="css7"><span class="css2">3. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Membership of Class-I Civil Officers serving in Bangladesh Army</u>. &nbsp; &nbsp; &nbsp;&nbsp;All 1st Class Civilian Officers serving in the Bangladesh Army and receiving salary from the Army Budget (including DW&amp;CE Budget) and their family members (similar to para 1b) may take membership of the Officers&apos; Club upon application through the appropriate authority for using the facilities of the said complex. After membership a civilian officer&apos;s membership shall automatically stand canceled on transfer from the army or in case of PRL/retirement.</span>
                    </p>
                    <p class="css7"><span class="css2">&nbsp;</span>
                    </p>
                    <p class="css7"><span class="css2">4. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Membership of families of officers who died/martyred while serving in the Army</u>. &nbsp;&nbsp; &nbsp; If an officer dies/martyred while serving in the army, the family members of that officer should become members of the club. In that case the membership will be granted subject to the approval of the appropriate authorities in view of the application through the Army Headquarters CORO.</span>
                    </p>
                    <p class="css7"><span class="css2">&nbsp;</span>
                    </p>
                    <p class="css7"><span class="css2">5. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Requirement of Membership for availing various facilities of Officers Club Complex</u>. Serving and retired army officers or their family members will not be able to use the establishment/ facilities of the Club Complex or be entitled to services at reduced rates without taking membership. However, for commercial sale of goods/services in existing shops/establishments such as beauty parlour, barber shop and men&apos;s grooming zone, rental shops and cafeterias, membership shall not be required by the persons coming to the local officer community or club complex.</span>
                    </p>
                    <p class="css7"><span class="css2">&nbsp;</span>
                    </p>
                    <p class="css7"><strong><span class="css2">6. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Cancellation Policy of Membership</u>.</span></strong>
                    </p>
                    <p class="css7"><span class="css10">&nbsp;</span></p>
                    <p class="css3"><span
                                class="css2">a. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;The serving members of the army are transferred from Dhaka station to elsewhere is optional of canceling the membership of Army Officers Club. If an officer wants to cancel his membership, he submits the card through official correspondence along with a copy of the no-claims certificate and copy of movement order membership should be cancelled.</span>
                    </p>
                    <p class="css3"><span
                                class="css2">&nbsp;</span></p>
                    <p class="css3"><span
                                class="css2">b. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Membership will be canceled at any time on application of retired members of the Army or due to unavoidable/justifiable reasons by the authorities.</span>
                    </p>
                    <p class="css3"><span
                                class="css2">&nbsp;</span></p>
                    <p class="css3"><span
                                class="css2">c. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;1000/- should be deposited in advance as security money for initial membership. Later, if the monthly subscription is not paid for three consecutive months, the security money will be adjusted.</span>
                    </p>
                    <p class="css3"><span
                                class="css2">&nbsp;</span></p>
                    <p class="css3"><span
                                class="css2">d. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Apart from this the Officers Club Board of Directors reserves the right to cancel/suspend membership at any time on application or for unavoidable/justifiable reasons by the authorities.</span>
                    </p>
                    <p class="css3"><span
                                class="css2">&nbsp;</span></p>
                    <p class="css3"><span
                                class="css2">e. &nbsp; &nbsp; &nbsp; &nbsp; If the membership is canceled for any of the reasons mentioned, the application procedure for re-membership should be followed: Apply for re-membership.</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
@endpush
