<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Orders</title>     

        <link href="{{ asset('css/fonts.googleapis.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet"> 
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">  
        <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script> 


        <style>
            body{background-color:#eae8e9;}
            .padding-15{padding:0 15px;}
            .checkbox + .checkbox, .radio + .radio{margin-top:10px;}
            .table .form-start-here .form-group .for-arrow::after{border-color: #fff transparent transparent transparent;}
            .table .delete .fa{background-color:red; color#fff; height:30px; width:30px; border-radius:100%; line-height:30px; text-align:center; color:#fff;}
            .table .form-start-here .form-control.selectpicker{width:120px; color:#fff;}
            .mapView .lh_con input[type="checkbox"], .mapView .lh_con input[type="radio"] {position:absolute; left:0; top:2px;}
            .table .form-start-here .form-control.selectpicker.pending{background-color:#050f05;}
            .table .form-start-here .form-control.selectpicker.done{background-color:#59ba58;}
            .table .form-start-here .form-control.selectpicker.onroute{background-color:#efad4d;}
            .table .form-start-here .form-control.selectpicker.assigned{background-color:#357ab7;}
            .table .form-start-here .form-control.selectpicker.cancelled{background-color:#d6524f;}
            .table .form-start-here{border:none; padding:0;}
            .tr_highlight td {font-weight: normal !important;}
            .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{vertical-align: middle;}
            .table .form-start-here .form-group{margin:0;}
            label.error{color:red; font-weight:400; font-size:12px; position:absolute;}
            .form-start-here .form-group{margin-bottom:25px;}
            label#scheduled_date-error.error{position:absolute; left: 0;top: auto;bottom: -24px;}
            .btn-group-sm > .btn, .btn-sm{border-radius:3px !important; }
            .form-start-here + .form-start-here{margin-top:15px;}
            .d-flex{display:-webkit-box:-ms-flexbox;display:flex}
            .justify-content-between{-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;}
            .align-items-center{-webkit-box-align:center;-ms-flex-align:center;align-items:center}
            .for-some-padding{padding:50px;}
            .ui-block-title{position:relative; margin-bottom:30px;}
            .ui-block-title::after{position:absolute; width:calc(100% + 60px); content:""; border-bottom:1px solid #ccc; left:-30px; bottom:-15px; top:auto;}
            .ui-block-title .fa{color:#6d90ef; font-size:18px;}
            .ui-block-title .heading{font-size:18px; color:#767883; margin:0;} 
            .form-start-here{background-color:#fff; padding-top:20px; padding-bottom:20px; border:1px solid #ccc; border-radius:5px;}
            .form-start-here .form-control{border-radius:4px;}
            .form-start-here .form-control.selectpicker {-webkit-appearance: none; -moz-appearance: none; -ms-appearance: none; appearance: none;}
            .form-start-here .form-group .for-arrow{position:relative;}
            .form-start-here .form-group .for-arrow::after{position:absolute;content: "";display: inline-block; width: 0;  height: 0; border-style: solid;border-width:8px 3px 0 3px; border-color: #555 transparent transparent transparent; left:auto; right:8px; top:0; bottom:0; margin:auto; }
            .form-start-here .input-group-addon{background-color:#eee; border-radius:4px 0 0 4px; border-style:solid; border-width:1px 0 1px 1px; border-color:#ccc;}
            .list-of-data{margin-top:20px;}
            .mapView .lh_con .TabbedPanelsContent ul li{display:flex; display:-moz-flex; display:-ms-flex; display:-webkit-flex; -webkit-align-items:center; -moz-align-items:center; -ms-align-items:center; align-items:center;}
            .mapView .lh_con input[type="checkbox"],
            .mapView .lh_con input[type="radio"]{margin:0px; outline:none !important;}
            .mapView .lh_con .cat_list_name{width:100%; font-weight:400; font-size:14px; line-height:30px; color:#404040; text-align:left;}
            .mapView .TabbedPanelsContentGroup{padding:0px;}
            .mapView .lh_con .TabbedPanelsContent ul li input:checked + label{background:none; border:none;}
            .mapView .lh_con .TabbedPanelsContent ul li label{padding:0px;}
            .mapView .forDisFlexMapView{display:flex; display:-moz-flex; display:-ms-flex; display:-webkit-flex; padding:0 0 20px 0;}
            .mapView .forDisFlexMapView .lh_con{ padding:0px; !important; overflow:auto; }
            .mapView .forDisFlexMapView .map_div{height:500px !important; width:100%;}
            .mapView #activmap-wrapper{height:1200px !important;}
            .mapView h4.activmap-title{color:#444444 !important; text-transform:none !important;}
            .mapView .partnerFor{}
            .mapView .partnerFor .lh_con .TabbedPanelsContent ul li{height:44px;}
            .mapView .partnerFor .lh_con .TabbedPanelsContent ul li label{display:flex; display:-moz-flex; display:-ms-flex; display:-webkit-flex; -webkit-align-items:center; -moz-align-items:center; -ms-align-items:center; align-items:center; margin:0 0 0 10px;}
            .mapView .partnerFor .lh_con .cat_list_name{line-height:22px;}
            .mapView .partnerFor .lh_con .sub_cat_icon{width:30px; height:30px; background:none;}
            .mapView .partnerFor .lh_con .cat_list_name{-webkit-width:calc(100% - 30px); -ms-width:calc(100% - 30px); -moz-width:calc(100% - 30px); width:calc(100% - 30px);}
            .checkbox.li_4:last-child{margin-bottom:0px;}
            .flexWrap{-webkit-flex-wrap:wrap; -moz-flex-wrap:wrap; -ms-flex-wrap:wrap; flex-wrap:wrap;}
            .w-100{width:100%;}
            
            @media (max-width: 991px) {
                .mapView .forDisFlexMapView .lh_con{display:block !important; opacity:1 !important; visibility:visible;}        
            }
            @media screen and (max-width:1023px){
                .mapView .forDisFlexMapView .lh_con{display:none !important;}
                .mapView .forDisFlexMapView .map_div{width:100%;}
                .flexWrap1023{-webkit-flex-wrap:wrap; -moz-flex-wrap:wrap; -ms-flex-wrap:wrap; flex-wrap:wrap;}
            }
            @media screen and (max-width: 568px) {  
                .mapView .forDisFlexMapView{-webkit-flex-wrap:wrap; -moz-flex-wrap:wrap; -ms-flex-wrap:wrap; flex-wrap:wrap;}
                .mapView .forDisFlexMapView .lh_con{width:100%; height:300px !important;}
                .mapView .forDisFlexMapView .map_div{width:100%;}
                .mapView #activmap-wrapper{height:400px !important;}
            }
            .row {margin-left: 0px; margin-right: 0px;}
            .colorRed {color: red}
            .tr_highlight td{
                color:blue;
                font-weight: 700;
            }
        </style>
    </head>
<body>
<section id="orderFormSection" class="for-some-padding">    
    <div class="row">
        <div class="container">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12 col-md-12 col-xl-12 form-start-here">
                        <div class="AddOrders">
                        <div class="row">
                          <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            @if ($errors->any())
                                <div class="alert text-white bg-danger" style="padding-bottom: 0">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (\Session::get('success'))
                               <div class="alert alert-success" role="alert">
                                  {{ \Session::get('success') }}
                                </div>
                            @endif
                            <div class="ui-block">
                              <div class="ui-block-title d-flex justify-content-between align-items-center">
                                <h5 class="heading">Add an Order</h5>
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="hr"> </div>
                        <div class="row"> 
                            <form id="order_form" name="order_form" class="text-left" enctype="multipart/form-data" method="post" action="{{route('store')}}">
                              {{ csrf_field() }}
                              <div class="row">
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group label-floating">
                                        <label class="control-label">First Name<span class="colorRed">*</span></label>
                                        <input type="text" class="form-control"  maxlength="70" id="firstname" name="firstname" required="required" placeholder="First Name">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group label-floating">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" class="form-control"  maxlength="70" id="lastname" name="lastname" placeholder="Last Name">
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group label-floating">
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control"  id="email" name="email" placeholder="you@sample.com">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group label-floating">
                                        <label class="control-label">Phone Number<span class="colorRed">*</span></label>
                                        <input type="text" class="form-control number" value="" id="phone_number" name="phone_number" required="required" maxlength="15" placeholder="+1 (888) 123-4567">
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group label-floating ">
                                        <label class="control-label">Order Type<span class="colorRed">*</span></label>
                                        <div class="for-arrow">
                                            <select name="order_type"  id="order_type" class="selectpicker form-control"   required>
                                              <option value="Delivery"> Delivery</option>
                                              <option value="Servicing"> Servicing</option>
                                              <option value="Installation"> Installation</option>
                                            </select>    
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group label-floating">
                                        <label class="control-label">Order Value</label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                          <input type="text" class="form-control number" value="" id="order_value" name="order_value" maxlength="15" placeholder="Amount">
                                        </div>
                                        
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                      <div class="form-group label-floating">
                                        <label class="control-label"> Scheduled Date <span class="colorRed">*</span></label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                          <input type="date" class="form-control"  id="scheduled_date" placeholder="abc" required name="scheduled_date" >
                                        </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group label-floating ">
                                        <label class="control-label">Street Address<span class="colorRed">*</span></label>
                                        <input type="text" class="form-control"  id="street_address" placeholder="" required name="street_address" >
                                      </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group label-floating ">
                                        <label class="control-label">City<span class="colorRed">*</span></label>
                                        <input type="text" class="form-control"  id="city" placeholder="" required name="city" >
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group label-floating ">
                                        <label class="control-label">State/Province<span class="colorRed">*</span></label>
                                        <input type="text" class="form-control"  id="state" placeholder="" required name="state" >
                                      </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group label-floating ">
                                        <label class="control-label">Postal/Zip Code</label>
                                        <input type="text" class="form-control"  id="postal_zipcode" placeholder="" name="postal_zipcode" >
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group label-floating is-select">
                                        <label class="control-label"> Country <span class="colorRed">*</span></label>
                                         <div class="for-arrow">
                                        <select name="country"  id="country" class="selectpicker form-control"   required>
                                          <option value="India"> India</option>
                                          <option value="Canada"> Canada</option>
                                          <option value="United states"> United states</option>
                                        </select>
                                        </div>
                                      </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                   <div class="text-right">
                                    <button type="button" class="btn  btn-blue btn-sm marBoZero pull-left" name="" >Preview Location</button>
                                    <a class="btn btn-danger btn-sm btn-close" href="{{ route('test') }}">Cancel</a>
                                    <button type="submit" class="btn  btn-success btn-sm marBoZero" name="" >Submit</button>
                                  </div>
                                 </div>
                              </div>
                            </form>    
                        </div>
                    </div>    
                    </div>
                    <div class="col-12 col-md-12 col-xl-12 form-start-here">
                        @if($OrderList->count())
                        <div class="padding-15">
                            <div class="ui-block">
                              <div class="ui-block-title d-flex justify-content-between align-items-center">
                                <h5 class="heading">Existing Orders</h5>
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                              </div>
                            </div>
                                    <table id="orderDisplay" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Date</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i=1; @endphp
                                @foreach($OrderList as $ol)
                                  <tr id="customId_{{$ol->id}}" data-custom-id="{{$ol->id}}">
                                    <td class="showMarkerPopup">{{$ol->firstname}}</td>
                                    <td>{{$ol->lastname}}</td>
                                    <td>{{$ol->scheduled_date}}</td>
                                    <td >
                                        <div class="form-start-here">
                                            <div class="d-flex justify-content-between align-items-center form-group">
                                                <div class="for-arrow" id=<?php echo $ol->id; ?>>
                                                <select name="status" id="status" class="status selectpicker form-control {{strtolower($ol->status)}}">
                                                  <option value="Pending" @if(isset($ol->status) && ($ol->status == 'Pending')) selected @endif> Pending</option>
                                                  <option value="Assigned"  @if(isset($ol->status) && ($ol->status == 'Assigned')) selected @endif> Assigned</option>
                                                  <option value="OnRoute" @if(isset($ol->status) && ($ol->status == 'OnRoute')) selected @endif> OnRoute</option>
                                                  <option value="Done" @if(isset($ol->status) && ($ol->status == 'Done')) selected @endif> Done</option>
                                                  <option value="Cancelled" @if(isset($ol->status) && ($ol->status == 'Cancelled')) selected @endif> Cancelled</option>
                                                </select>
                                                </div>
                                                <div class="" id=<?php echo $ol->id; ?>>
                                                    @if(isset($ol->status) && ($ol->status == 'Pending' || $ol->status == 'Assigned'))
                                                    <a href="#" class="delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                  </tr>
                                @php $i++; @endphp
                                @endforeach 
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="padding-15">
                            <div class="ui-block">
                                <div class="ui-block-content">
                                    No Data Found
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
</div>
                
            </div>
            @php
            $statusList = General::statusList();
            @endphp
            <div class="col-md-6">
                @if(count($statusList))
                <div class="mapView" id="mapDiv">
                    <div class="">
                        <div class="forDisFlexMapView flexWrap1023 flexWrap">
                            <div class="lh_con w-100">
                                <div id="TabbedPanels1" class="TabbedPanels TabbedPanels_lh_con ui-block">
                                    <div class="TabbedPanelsContentGroup">
                                        <div class="TabbedPanelsContent ui-block-content d-flex justify-content-between align-items-center">                                
                                            @php $i=1; @endphp
                                            @foreach($statusList as $key=>$value)
                                                 <div class="checkbox li_{{$i}}">                                       
                                                    <label for="thing{{$i}}" class="label-{{strtolower($value)}}">
                                                        <input type="checkbox" class="thingCheckbox" name="marker_type[]" id="thing{{$i}}" value="{{$value}}"  checked >
                                                        {{$value}}
                                                    </label>
                                                </div>
                                                 @php $i++; @endphp
                                            @endforeach                                 
                                        </div>
                                    </div>
                                </div>      
                            </div>
                            <div class="map_div w-100">
                                <div id="activmap-wrapper">             
                                    <div id="activmap-canvas"></div>
                                </div>
                            </div>                  
                        </div>
                    </div>
                </div>          
                @else
                <div class="indivisionServiec">
                    <div class="ui-block">
                        <div class="ui-block-content">
                            No Data Found
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<script language="javascript" type="application/javascript">
    $( function () {
        <?php
        $data = array();
        foreach ( $OrderList as $ls ) { 
        if($ls->status == 'Pending') {
            $image = 'pending.png';
        } else if($ls->status == 'Assigned') {
            $image = 'assigned.png';
        } else if($ls->status == 'OnRoute') {
            $image = 'on_route.png';
        } else if($ls->status == 'Done') {
            $image = 'done.png';
        } else if($ls->status == 'Cancelled') {
            $image = 'cancelled.png';
        } else {
            $image = 'onlineshopping.png';
        }
        $marker = config( 'app.url' ).'images/'.$image; 
            $firstname = $ls->firstname;
            $customId = $ls->id;
            $location = $ls->city . "," . $ls->state . "," . $ls->country;
            $name = $ls->firstname ."-".$ls->order_type . "-" . $ls->status;            
            $status =  str_replace("'", "`", $ls->status);
            $location =  str_replace("'", "`", $location);
            $firstname =  str_replace("'", "`",$firstname); 
            $data[] = "{title: '".trim("$name")."', status: '".trim("$status")."', address: '".trim("$location")."', lat:'$ls->latitude', lng:'$ls->longitude', tags:['$ls->status'], icon:'$marker', clientType:'$firstname', customId:'$customId'}";
        }
        $datap = implode( ",", $data ); 
        ?>
    } ); 
</script>
    
<!-- Activ'Map plugin -->
<link rel="stylesheet" href="{{asset('jquery-activmap-marketplace/css/style.css')}}">
<link rel="stylesheet" href="{{asset('jquery-activmap-marketplace/css/jquery-activmap.css')}}">
<script src="{{asset('jquery-activmap-marketplace/js/jquery-activmap.js')}}"></script> 
<script src="{{asset('jquery-activmap-marketplace/js/markercluster.min.js')}}"></script> 
<script src="{{asset('jquery-activmap-marketplace/js/SpryTabbedPanels.js')}}" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function(e) {
        $('#activmap-wrapper').activmap({
            places: [<?php echo $datap; ?>],
            icon: 'images/onlineshopping.png',
            zoom: 2,
            posPanel: 'left',
            showPanel: true,
            radius: 0,
            cluster: false,
            mapType: 'roadmap',
            request: 'large',
            allowMultiSelect: false,
        });
    });
</script>
<script src="{{asset('js/validate.min.js')}}"></script>
<script language="javascript" type="application/javascript">
    var orderTable;
    $( '#filterForm' ).validate();
    $(document).ready(function(){
        $(".clickToOpenFilter").on('click',function(){
            $(".mobClickFilter").removeClass("displayBlock768Fi");
        });
        $(".mobClickclose").on('click',function(){
            $(".mobClickFilter").addClass("displayBlock768Fi");
        });
        orderTable = $('#orderDisplay').DataTable( {
            "order": [[ 3, "desc" ]]
        } );

    });

    $('body').on('change', '.status', function (e) {
        e.preventDefault();
        var thisElement = $(this);
        var newStatus = this.value;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "status",
            data: {
            "status":this.value,
            "id": $(this).parent()[0].id
            },
            success:function(){
                thisElement.removeClass('onroute pending assigned done cancelled');
                var newStatusLowerCase = thisElement.val().toLowerCase();
                thisElement.addClass(newStatusLowerCase);
            }
            });
    });
    $('body').on('click', '.delete', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to Delete ?')) {
            var id = $(this).parent()[0].id;
            $("#customId_"+id).hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "post",
                url: "delete/"+id,
                });
        } else {
            return false;
        }
    });

</script>           
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAzHs4vcqexf73dHTV-F6qHCBBRg8XYd0A&libraries=places&language=en-US"></script> 
</script> 
<script language="javascript" type="application/javascript">
    var autocomplete = new google.maps.places.Autocomplete($("#street_address")[0], {});
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        console.log(place.address_components);
    });
    $( '#order_form' ).validate({
        submitHandler:function(form){
            var data = $(form).serialize();
            $.ajax({
                 type: "POST",
                 url: '<?php echo route('storeAjax');?>',
                 data: data,
                 success: function (data) {
                    if(data.success){   
                     $("#order_form")[0].reset();
                     var tempRow = [
                        data.order_data.firstname,
                        data.order_data.lastname,
                        data.order_data.scheduled_date,
                        '<div class="form-start-here">'+
                            '<div class="d-flex justify-content-between align-items-center form-group">'+
                                '<div class="for-arrow" id="'+ data.order_data.id +'">'+
                                    '<select name="status" id="status" class="status selectpicker form-control pending">'+
                                        '<option value="Pending">Pending</option>'+
                                        '<option value="Assigned" >Assigned</option>'+
                                        '<option value="OnRoute">OnRoute</option>'+
                                        '<option value="Done">Done</option>'+
                                        '<option value="Cancelled">Cancelled</option>'+
                                    '</select>'+
                                '</div>'+
                                '<div class="" d="'+ data.order_data.id +'">'+
                                    '<a href="#" class="delete"><i class="fa fa-times" aria-hidden="true"></i></a>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                     ]
                     var addedNode = orderTable.row.add(tempRow).node();
                     $(addedNode).attr('id','customId_'+data.order_data.id);
                     $(addedNode).attr('data-custom-id',data.order_data.id);
                     orderTable.draw(false);
                     alert('Form is Submitted successfully');
                    } else {
                        alert(data.message);
                    }
                 }
             });
             return false; 
        }
    });
</script> 
</div>
</body>
</html>