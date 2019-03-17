/*
 *
 *   start Poolad project
 *   data 03/01/2014
 *   ui : omid khosrojerdi
 *
 */
$(document).ready(function(){
    var vazn = '';


// Decimal round
    function decimalAdjust(type, value, exp) {
        // If the exp is undefined or zero...
        if (typeof exp === 'undefined' || +exp === 0) {
            return Math[type](value);
        }
        value = +value;
        exp = +exp;
        // If the value is not a number or the exp is not an integer...
        if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
            return NaN;
        }
        // Shift
        value = value.toString().split('e');
        value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
        // Shift back
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
    }
    if (!Math.round10) {
        Math.round10 = function(value, exp) {
            return decimalAdjust('round', value, exp);
        };
    }

    coun = 0;
    for(p=1;p<=15;p++)
    {
        //console.log($('#row1').val());
        if($('#row'+p).val() == ''){
            coun++;
        }
    }





    $('#nextForm4').click(function () {
        coun = 0;
       for(p=1;p<=15;p++)
       {
           console.log($('#row1').val());
           if($('#row'+p).val() == ''){
               coun++;
           }
       }
       if(coun !=15){
           $('.hiddenForm,.btn').show();
           $('#nextForm4').hide();
       }
       else {
           alert('می بایست حداقل یکی از موارد بالا را پر نمایید.')
       }
    });

    if($('#form1').height() > 0) {
//  get all vazn

        $.ajax({
            url: '?component=vazn',
            type: "post",
            data: {
                action: 'getAllVaznJson',
                exportType: 'json',
                semat: $('#semat').val()
            },
            success: function (data, status, xhr) {


                vazn = $.parseJSON(data);

                var j = 1;
                var reserve1, reserve2;
                $('select').each(function (e) {
                    if ($(this).val() == 0) {
                        if (j == 1) {
                            reserve1 = $(this).attr('id').replace('menu', '');
                        }
                        else {
                            reserve2 = $(this).attr('id').replace('menu', '');
                        }
                        j++;
                    }

                });
                vazn['vazn26'] = vazn['vazn' + (reserve1)];
                vazn['vazn27'] = vazn['vazn' + (reserve2)];


                for ($k = 1; $k <= 27; $k++) {
                    vazn['vazn' + ($k + 27)] = vazn['vazn' + $k];
                    vazn['vazn' + ($k + (27*2))] = vazn['vazn' + $k];
                }

                //console.log(vazn);
                //var vazn = data;


                return false;
                // if (result['result'] == -1) {
                //     var msg = result['msg'];
                //     $('#alertMessage').remove();
                //     $('#showError ').html("<div id='alertMessage'><div class='alert alert-danger'>Error: " + msg + "</div></div>");
                //     return false;
                // }
            }
        });
    }
    /*$('select').click(function (e) {
        var count = 1;
        $('select').each(function (e) {
            if($(this).val() != 0)
            {
                count++;
            }
        });
        if(count > 25){
            e.preventDefault();
            //console.log(count);
        }
    });*/

    //if($('#menu26').val()>0){ $('#menu26').parent("td").prev().html(Math.round10(vazn['vazn26']*$('#menu26').val(), -2)); }

    $('select3').change(function (e) {
        var j = 1;
        var count=0;
        var sum1 =0;
        var sum =0;
        var reserve1=0;
        var reserve2 =0 ;

        //console.log(position);
        var menuNumber2 = 0;
        //var sumRow   = 0;
        var position = $(this).parent("td").prev().attr('class');

        $('select').each(function (e,elem) {

                menuNumber2 = e+1;

                $s1 = menuNumber2;
                //$s2 = menuNumber2 + 27;
                //$s3 = menuNumber2 + 54;

                if($(this).val() == 0 &&  menuNumber2 <= (27))
                {

                    if(j == 1)
                    {
                        reserve1 = menuNumber2;
                    }
                    else if (j==2)
                    {
                        reserve2 = menuNumber2;
                    }
                    j++;

                }

                if($(this).val() == 4 || $(this).val() == 3.2 || $(this).val() == 2.4 || $(this).val() == 1.6 || $(this).val() == 0.8)
                {
                    count += 1;
                }

                vazn['vazn26'] = vazn['vazn'+reserve1];
                vazn['vazn27'] = vazn['vazn'+reserve2];

                vazn['vazn53'] = vazn['vazn'+reserve2];
                vazn['vazn54'] = vazn['vazn'+reserve2];

                vazn['vazn80'] = vazn['vazn'+reserve2];
                vazn['vazn81'] = vazn['vazn'+reserve2];

            // console.log(menuNumber2);
                if(reserve1 == 0){vazn['vazn26'] = vazn['vazn53'] = vazn['vazn80'] = 0;}
                if(reserve2 == 0){vazn['vazn27'] = vazn['vazn54'] = vazn['vazn81'] = 0;}


                if(position == 's1' &&  menuNumber2 <= (27)){

                    var sumRow1 = Math.round10(vazn['vazn'+menuNumber2]*$('select#menu'+menuNumber2).val(), -2);
                    sum1 += sumRow1;
                    //console.log(reserve1+' - '+reserve2);
                    console.log(position+ ' = '+menuNumber2 + ' - '+$('select#menu'+menuNumber2).val()+'*'+vazn['vazn'+menuNumber2]+'='+sumRow1+' sum='+sum1);

                    $('select#menu'+menuNumber2).parent("td").prev('.'+position).html(sumRow1);
                }
            var sumRow = Math.round10(vazn['vazn'+menuNumber2]*$(this).val(), -2);
            sum += sumRow;
            //console.log(reserve1+' - '+reserve2);
            console.log(position+ ' = '+menuNumber2 + ' - '+$(this).val()+'*'+vazn['vazn'+menuNumber2]+'='+sumRow+' sum='+sum);

            $(this).parent("td").prev('.'+position).html(sumRow);




        });

        if(position == 's1') {
            console.log(sum1);
            console.log(vazn['vazn26'] + '-' + vazn['vazn27']);
        }

        console.log(sum);
        console.log(vazn['vazn26'] + '-' + vazn['vazn27']);
        /*if(position == 's2') {
            console.log(sum);
            console.log(vazn['vazn53'] + '-' + vazn['vazn54']);
        }
        if(position == 's3') {
            console.log(sum);
            console.log(vazn['vazn80'] + '-' + vazn['vazn81']);
        }*/


        if(count > 25){

            $(this).css('border','red');
            alert('شاخص های انتخاب شده بیشتر از ۲۵ مورد می باشد');
        }
        else{

        }
        //position = $(this).parent("td").prev().attr('class');

        //$(this).parent("td").prev().html(0);
        menuNumber = $(this).attr('id').replace('menu', '');

        //res = vazn['vazn'+menuNumber]*$(this).val();

        //$(this).parent("td").prev('.'+position).html(Math.round10(res, -2));
        if(position == 's1'){
            $('#s1').html(Math.round10(sum1, -2));
        }
        else if(position == 's2'){
            $('#s2').html(Math.round10(sum, -2));
        }
        else {
            $('#s3').html(Math.round10(sum, -2));
        }






        if($('#menu26').val() >0 && menuNumber != 26 && menuNumber != 27) {
            $('#menu26').parent("td").prev().html(Math.round10(vazn['vazn26']*$('#menu26').val(),-2));
        }

        if($('#menu27').val() >0 && menuNumber != 27 && menuNumber != 26) {
            $('#menu27').parent("td").prev().html(Math.round10(vazn['vazn27']*$('#menu27').val(),-2));
        }






        console.log(vazn);
    });

    //
    var accessSubmit = 0;
    var count = 0;
    /*$('.mostanadat').submit(function (e) {
        console.log(accessSubmit);
        if(accessSubmit == 1){  return true;}

        e.preventDefault();
        $('input[type="file"]').each(function() {

            var $this = $(this);
            if ($this.val() == '' ) {
                count ++ ;
            }

        });
        //console.log(count);
        //console.log('1'+$(this).data('type'));
        //console.log('2'+$(this).data('type'));

        if((count == 6 && $(this).data('type') == 'mostanadat2') || (count ==10 && $(this).data('type') == 'mostanadat1') ){
            if(prompt('کاربر گرامی مستندات شاخص های ستاره دار ضمیمه نگردیده است که در این صورت امتیاز بخش مستندات برای شما لحاظ نمیگردد.')){
                accessSubmit =1 ;
                console.log(accessSubmit);

            }
            return false;
        }

    });*/






    $('ul.sidebar li  a').click(function (e) {
        //$(this).parent().find('.sidebar-child').css({"display":"block"});
        $(this).parent().find('.sidebar-child').toggle();
    });


    var $body            = $('body'),
        windowWidth      = $(window).width(),
        windowHeight     = $(window).height(),
        $toggleSideBar   = $('#toggleSideBar'),
        $datePicker      = $('.date'),
        $sideBar         = $('.side-left');

    /* ------ Responsive Menu ------*/
    $toggleSideBar.bind('click',function(){
            $sideBar.toggleClass('active');
    });

    // change input date to persian date picker
    if($datePicker.length)
    {
        $datePicker.persianDatepicker({
            calendarPosition: {
                x: -25,
                y: 0
            },
            selectableYears: [1399,1398,1397,1396,1395,1394,1393,1392,1391,1390,1389,1388,1387,1386,1385,1384,1383,1382,1381,1380,1379,1378,1377,1376,1375,1374,1373,1372,1371,1370,1369,1368,1367,1366,1365,1364,1363,1362,1361,1360,1359,1358,1357,1356,1355,1354,1353,1352,1351,1350,1349,1348,1347,1346,1345,1344,1343,1342,1341,1340,1339,1338,1337,1336,1335,1334,1333,1332,1331,1330,1329,1328,1327,1326,1325,1324,1323,1322,1321,1320,1319,1318,1317,1316,1315,1314,1313,1312,1311,1310,1309,1308,1307,1306,1305,1304,1303,1302,1301,1300]
        });
    }

    $(window).resize(function(){

        if(windowWidth < 801)
        {
            $sideBar.find('li').has('ul').each(function(){
                $(this).find('a:eq(0)').addClass('hasMenu');
                $(this).find('ul').removeClass('animated fadeInRight');
            });

            $body.on('click','.hasMenu',function(){
                $(this).parent().find('ul').toggleClass('active');
            });
        }
        else
        {
            $sideBar.find('li').has('ul').each(function(){
                $(this).find('a:eq(0)').removeClass('hasMenu');
                $(this).find('ul').addClass('animated fadeInRight');
            });
        }
    });

    /* ------ Check All ------*/
    $('label[for="checkAll"]').bind('click',function(){
        var input = $(this).find('input[id="checkAll"]');

        if(input.prop("checked")) {
            input.prop("checked",true);

            $('.companyTable tbody tr td:first-child input[type="checkbox"]').each(function(){
                $(this).prop("checked",true);
            });
        }else{
            input.prop("checked",false);

            $('.companyTable tbody tr td:first-child input[type="checkbox"]').each(function(){
                $(this).prop("checked",false);
            });
        }
    });

    $('select').select2();

     /* ------ Recorder------*/
    // Utility method that will give audio formatted time
    getAudioTimeByDec = function(cTime,duration)
    {
        var duration = parseInt(duration),
            currentTime = parseInt(cTime),
            left = duration - currentTime, second, minute;
        second = (left % 60);
        minute = Math.floor(left / 60) % 60;
        second = second < 10 ? "0"+second : second;
        minute = minute < 10 ? "0"+minute : minute;
        return minute+":"+second;
    };

// Custom Audio Control using Jquery
    $("body").on("click",".audioControl", function(e)
    {
        var ID=$(this).attr("id");
        var progressArea = $("#audioProgress"+ID);
        var audioTimer = $("#audioTime"+ID);
        var audio = $("#audio"+ID);
        var audioCtrl = $(this);
        e.preventDefault();
        var R=$(this).attr('rel');
        if(R=='play')
        {
            $(this).removeClass('audioPlay').addClass('audioPause').attr("rel","pause");
            audio.trigger('play');
        }
        else
        {
            $(this).removeClass('audioPause').addClass('audioPlay').attr("rel","play");
            audio.trigger('pause');
        }

// Audio Event listener, its listens audio time update events and updates Progress area and Timer area
        audio.bind("timeupdate", function(e)
        {
            var audioDOM = audio.get(0);
            audioTimer.text(getAudioTimeByDec(audioDOM.currentTime,audioDOM.duration));
            var audioPos = (audioDOM.currentTime / audioDOM.duration) * 100;
            progressArea.css('width',audioPos+"%");
            if(audioPos=="100")
            {
                $("#"+ID).removeClass('audioPause').addClass('audioPlay').attr("rel","play");
                audio.trigger('pause');
            }
        });
// Custom Audio Control End
    });

    $("body").on('click','.recordOn',function()
    {
        $("#recordContainer").toggle();
    });
//Record Button
    $("#recordCircle").mousedown(function()
    {
        $(this).removeClass('startRecord').addClass('stopRecord');
        $("#recordContainer").removeClass('startContainer').addClass('stopContainer');
        $("#recordText").html("Stop");
        $.stopwatch.startTimer('sw'); // Stopwatch Start
        startRecording(this); // Audio Recording Start
    }).mouseup(function()
    {
        $.stopwatch.resetTimer(); // Stopwatch Reset
        $(this).removeClass('stopRecord').addClass('startRecord');
        $("#recordContainer").removeClass('stopContainer').addClass('startContainer');
        $("#recordText").html("Record");
        stopRecording(this); // Audio Recording Stop
    });

    // vaziry -> add phone numbers,emails,addresses to compony
    // phone
    $('#btn-add-phone-container').on('click',function(e){
        e.preventDefault();
        var row =   '<div class="row bordered-box">' +
                        '<div class="col-xs-12 col-sm-6 col-md-3">' +
                            '<div class="form-group">' +
                                '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">موضوع:</label>' +
                                '<div class="col-xs-12 col-sm-8 pull-right">' +
                                    '<input type="text" class="form-control" name="company_phone[subject][]" id="phone_subject" value="">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-3">' +
                            '<div class="form-group">' +
                                '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">شماره تلفن</label>' +
                                '<div class="col-xs-12 col-sm-8 pull-right">' +
                                    '<div class="input-group">' +
                                        '<input type="text" class="form-control" id="phone_number" name="company_phone[number][]" value="">' +
                                        '<div class="input-group-addon">+98</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-3">' +
                            '<div class="form-group">' +
                                '<div class="col-xs-12 col-sm-8 pull-right">' +
                                    '<select name="company_phone[state][]" class="select-phone-state">' +
                                        '<option value="داخلی">داخلی</option>' +
                                        '<option value="الی">الی</option>' +
                                        '<option value="سایر">سایر</option>' +
                                    '</select>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-2">' +
                            '<div class="form-group">' +
                                '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">مقدار</label>' +
                                '<div class="col-xs-12 col-sm-8 pull-right">' +
                                    '<input type="text" class="form-control" id="phone_value" name="company_phone[value][]" value="">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-1">' +
                            '<div class="form-group">' +
                                '<div class="col-xs-12 col-sm-12 pull-right">' +
                                    '<a href="#" class="btn btn-sm btn-block btn-danger btn-remove-phone-container">' +
                                        '<i class="fa fa-trash"></i>' +
                                    '</a>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

        $('#phone-container').append(row);
        $('select').select2();
    });
    $('#phone-container').on('click','.btn-remove-phone-container',function(e){
        e.preventDefault();
        if($('#phone-container .row').length > 0)
            $(this).parent().parent().parent().parent('.row').remove();
    });
    // email
    $('#btn-add-email-container').on('click',function(e){
        e.preventDefault();
        var row =   '<div class="row bordered-box">' +
                        '<div class="col-xs-12 col-sm-6 col-md-3">' +
                            '<div class="form-group">' +
                                '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">موضوع:</label>' +
                                '<div class="col-xs-12 col-sm-8 pull-right">' +
                                    '<input type="text" class="form-control" name="company_email[subject][]" id="email_subject" value="">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-8">' +
                            '<div class="form-group">' +
                                '<label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="">آدرس ایمیل</label>' +
                                '<div class="col-xs-12 col-sm-9 pull-right">' +
                                    '<input type="email" class="form-control" id="email_email" name="company_email[email][]" value="">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-1">' +
                            '<div class="form-group">' +
                                '<div class="col-xs-12 col-sm-12 pull-right">' +
                                    '<a href="#" class="btn btn-sm btn-block btn-danger btn-remove-email-container">' +
                                        '<i class="fa fa-trash"></i>' +
                                    '</a>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

        $('#email-container').append(row);
    });
    $('#email-container').on('click','.btn-remove-email-container',function(e){
        e.preventDefault();
        if($('#email-container .row').length > 0)
            $(this).parent().parent().parent().parent('.row').remove();
    });
    // address
    $('#btn-add-address-container').on('click',function(e){
        e.preventDefault();
        var row =   '<div class="row bordered-box">' +
                        '<div class="col-xs-12 col-sm-6 col-md-3">' +
                            '<div class="form-group">' +
                                '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">موضوع:</label>' +
                                '<div class="col-xs-12 col-sm-8 pull-right">' +
                                    '<input type="text" class="form-control" name="company_address[subject][]" id="address_subject" value="">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-8">' +
                            '<div class="form-group">' +
                                '<label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="">آدرس</label>' +
                                '<div class="col-xs-12 col-sm-9 pull-right">' +
                                    '<textarea class="form-control valid" id="address_address" name="company_address[address][]" rows="3"></textarea>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-1">' +
                            '<div class="form-group">' +
                                '<div class="col-xs-12 col-sm-12 pull-right">' +
                                    '<a href="#" class="btn btn-sm btn-block btn-danger btn-remove-address-container">' +
                                        '<i class="fa fa-trash"></i>' +
                                    '</a>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

        $('#address-container').append(row);
    });
    $('#address-container').on('click','.btn-remove-address-container',function(e){
        e.preventDefault();
        if($('#address-container .row').length > 0)
            $(this).parent().parent().parent().parent('.row').remove();
    });
    // website
    $('#btn-add-website-container').on('click',function(e){
        e.preventDefault();
        var row =   '<div class="row bordered-box">' +
                        '<div class="col-xs-12 col-sm-6 col-md-3">' +
                            '<div class="form-group">' +
                                '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">موضوع:</label>' +
                                '<div class="col-xs-12 col-sm-8 pull-right">' +
                                    '<input type="text" class="form-control" name="company_website[subject][]" id="website_subject" value="">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-8">' +
                            '<div class="form-group">' +
                                '<label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="">آدرس وب سایت</label>' +
                                '<div class="col-xs-12 col-sm-9 pull-right">' +
                                    '<input type="text" class="form-control valid" id="website_url" name="company_website[url][]">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-6 col-md-1">' +
                            '<div class="form-group">' +
                                '<div class="col-xs-12 col-sm-12 pull-right">' +
                                    '<a href="#" class="btn btn-sm btn-block btn-danger btn-remove-website-container">' +
                                        '<i class="fa fa-trash"></i>' +
                                    '</a>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

        $('#website-container').append(row);
    });
    $('#website-container').on('click','.btn-remove-website-container',function(e){
        e.preventDefault();
        if($('#website-container .row').length > 0)
            $(this).parent().parent().parent().parent('.row').remove();
    });
    $('[data-toggle="popover"]').popover({
      html : true,
    });
    // end vaziry

});
