$(document).ready(function () {

    // datatable 
    var t = $('#datatable-list').DataTable({
        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
        "order": [[1, 'asc']],
        "language": {
            "emptyTable": "No data available"
        }
    });

    t.on('order.dt search.dt', function () {
        t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();   

});


$(function () {
    "use strict";
    $('#checkbox-0').click(function () {
        if ($(this).is(':checked'))
            $('.checkbox-group').prop('checked', true).closest("tr").addClass('row-warning');
        else
            $('.checkbox-group').prop('checked', false).closest("tr").removeClass('row-warning');
    });

    $('.checkbox-group').click(function () {
        if ($(this).is(':checked'))
            $(this).closest("tr").addClass('row-warning');
        else
            $(this).closest("tr").removeClass('row-warning')
    });
});
$('#summernote').summernote({
    height: 200
});

$('.select2').select2();
$('.form-select').select2();
$('.select3').select2();


//custom datatable filtering
$(document).ready(function () {

    $('.filter-rows').on('change', function () {
        var data_type = $(this).attr('data-type');
        var data_id = $('option:selected', this).attr('data-id');

        switch (data_type) {
            case 'course':
                //find branch of courses
                all_data();
                $.ajax({
                    url: base_url + 'admin/course_list_from_degree/' + data_id,
                    type: 'get',
                    success: function (content) {
                        //get the course elemt id and append course list
                        $('.filter-rows').each(function (index) {
                            var custom_data_type = $(this).attr('data-type');

                            if (custom_data_type == 'branch') {
                                //$('#batch').append('<option value="">Select</option>');
                                var branch_id = $(this).attr('id');
                                $('#' + branch_id).find('option').remove().end();
                                $('#' + branch_id).append('<option value="">All</option>');
                                var branch = jQuery.parseJSON(content);
                                $.each(branch, function (key, value) {
                                    $('#' + branch_id).append('<option data-id=' + value.course_id + ' value=' + value.c_name + '>' + value.c_name + '</option>');
                                });
                            }
                        });
                    }
                });
                break;
            case 'branch':
                var course_id = '';
                var branch_id = '';
                $('.filter-rows').each(function (index) {
                    var custom_data_type = $(this).attr('data-type');
                    if (custom_data_type == 'course') {
                        course_id = $('option:selected', this).attr('data-id');
                    } else if (custom_data_type == 'branch') {
                        branch_id = $('option:selected', this).attr('data-id');
                    }
                })
                $.ajax({
                    url: base_url + 'admin/batch_list_from_degree_and_course/' + course_id + '/' + branch_id,
                    type: 'get',
                    success: function (content) {
                        //get the course elemt id and append course list
                        $('.filter-rows').each(function (index) {
                            var custom_data_type = $(this).attr('data-type');
                            if (custom_data_type == 'batch') {
                                //$('#batch').append('<option value="">Select</option>');
                                var batch = $(this).attr('id');
                                var batch_id = '#' + batch;
                                $(batch_id).find('option').remove().end();
                                $(batch_id).append('<option value="">All</option>');
                                var batch = jQuery.parseJSON(content);
                                $.each(batch, function (key, value) {
                                    $(batch_id).append('<option data-id=' + value.b_id + ' value=' + value.b_name + '>' + value.b_name + '</option>');
                                });
                            }
                        });
                    }
                    //get_semesters_of_branch(branch_id);
                });
                get_semesters_of_branch(branch_id);
                break;
        }
    });

    function get_semesters_of_branch(branch_id) {
        $.ajax({
            url: base_url + 'admin/get_semesters_of_branch/' + branch_id,
            type: 'get',
            success: function (content) {
                $('.filter-rows').each(function (index) {
                    var custom_data_type = $(this).attr('data-type');
                    if (custom_data_type == 'semester') {
                        //$('#batch').append('<option value="">Select</option>');
                        var semester = $(this).attr('id');
                        var semester_id = '#' + semester;
                        $(semester_id).find('option').remove().end();
                        $(semester_id).append('<option value="">All</option>');
                        var semester = jQuery.parseJSON(content);
                        $.each(semester, function (key, value) {
                            $(semester_id).append('<option data-id=' + value.s_id + ' value=' + value.s_name + '>' + value.s_name + '</option>');
                        });
                    }
                });
            }
        });
    }

    function all_data() {
        $('.filter-rows').each(function (index) {
            var custom_data_type = $(this).attr('data-type');
            if (custom_data_type == 'course')
                var course_id = '#' + $(this).attr('id');
            else if (custom_data_type == 'branch')
                var branch_id = '#' + $(this).attr('id');
            else if (custom_data_type == 'batch')
                var batch_id = '#' + $(this).attr('id');
            else if (custom_data_type == 'semester')
                var semester_id = '#' + $(this).attr('id');

            if ($(course_id).val() == '') {
                location.reload();
            }
        });
    }

//    $(".vd_menu > ul >li > a").hover(function() {        
//              $(this).next('div').stop(true, true).slideDown("slow");
//              
//
//      // $(".vd_menu > ul >li > div").hide();    
//        //   $(this).toggleClass('closed');
//             // $(this).next('div').slideDown();    
//              //  $(this).find('ul').toggle();
//          //      $(this).siblings('li').find('ul').hide();
//              $(this).next('div > ul').slideDown();    
//              //$(this).next('div ul').slideToggle();
//              
//                 
//      //  $(this).parent().find('.child-menu').css({"display":"none"});
//  // $(this).parent().find('.child-menu').css({"display":"block"});
//},function(){
//     $(this).next('div').slideUp();   
//});

    $(".nav li.dropdown").click(function (e) {
        $(this).toggleClass("open");
    });
    $(".search_box .category").click(function (e) {
        $(this).toggleClass("open");
    });

    $(".bootstrap-timepicker-hour").prop("readonly", true);
    $(".bootstrap-timepicker-minute").prop("readonly", true);
    $(".bootstrap-timepicker-meridian").prop("readonly", true);

    $(".pace.pace-active").click(function (e) {
        $(this).hide();
    });

     $(".trigger").click(function(){
          $(".trigger").not(this).next(".toggle").slideUp("slow");
          $(this).next(".toggle").slideToggle("slow");
        });  

});

function isEmpty(str) {
    return str.toString().replace(/^\s+|\s+$/gm, '').length == 0;
}
