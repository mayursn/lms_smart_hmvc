<!-- Start .row -->
<?php
$create = create_permission($permission, 'Exam_Marks');
$read = read_permission($permission, 'Exam_Marks');
$update = update_permisssion($permission, 'Exam_Marks');
$delete = delete_permission($permission, 'Exam_Marks');
?>
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle">
            <div class=panel-body>
                <?php if($create || $read || $update || $delete){ ?>
                <form class="form-groups-bordered validate">
                    <div class="col-md-12">
                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 validating">
                            <label><?php echo ucwords("department"); ?></label>
                            <select id="degree" name="degree" class="form-control">
                                <option value="">Select</option>
                                <?php foreach ($degree as $row) { ?>
                                    <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 col-xs-12 validating">
                            <label><?php echo ucwords("Branch"); ?></label>
                            <select id="course" name="course" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 validating">
                            <label><?php echo ucwords("Batch"); ?></label>
                            <select id="batch" name="batch" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 validating">
                            <label><?php echo ucwords("Semester"); ?></label>
                            <select id="semester" name="semester" class="form-control">
                                <option value="">Select</option>                                                    
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 validating">
                            <label><?php echo ucwords("Exam"); ?></label>
                            <select id="exam" name="exam" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 validating">
                            <label><?php echo ucwords("Students"); ?></label>
                            <select id="student" name="student" class="form-control">
                                <option value="">All</option>
                                <?php foreach ($student_list as $exam_student) { ?>
                                    <option value="<?php echo $exam_student->std_id; ?>"
                                            <?php if ($student_id == $exam_student->std_id) echo 'selected'; ?>><?php echo $exam_student->std_first_name . ' ' . $exam_student->std_last_name; ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                </form>
                <?php } ?>
                <?php if($create || $read || $update || $delete){ ?>
                <?php
                $show_exam_details = $this->db->select('exam_manager.*, exam_type.*, course.*, batch.*, semester.*, degree.*')
                        ->from('exam_manager')
                        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('degree', 'degree.d_id = exam_manager.degree_id')
                        ->join('batch', 'batch.b_id = exam_manager.batch_id')
                        ->where('exam_manager.em_id', $exam_id)
                        ->get()
                        ->row();
                ?>

                <?php if ($this->uri->total_segments() >= 7) { ?>
                    <?php if (count($show_exam_details)) { ?>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">Exam Details</div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th><?php echo ucwords("Exam Name"); ?></th>
                                            <th><?php echo ucwords("Course"); ?></th>
                                            <th><?php echo ucwords("Branch"); ?></th>
                                            <th><?php echo ucwords("Batch"); ?></th>
                                            <th><?php echo ucwords("Semester"); ?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo $show_exam_details->em_name; ?></td>
                                            <td><?php echo $show_exam_details->d_name; ?></td>
                                            <td><?php echo $show_exam_details->c_name; ?></td>
                                            <td><?php echo $show_exam_details->b_name; ?></td>
                                            <td><?php echo $show_exam_details->s_name; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <div id="gridview" class="col-sm-12">
                            <div style="" id="entermarks" class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title" style="color:#000;"><?php echo ucwords("Enter Marks"); ?></h4>
                                </div>
                                <form class="form-horizontal" action="" method="post">
                                    <div class="table-responsive">                                    
                                        <table data-filter="#filter" id="marklist" class="table table-bordered table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th width="5%" rowspan="2">#</th>
                                                    <th colspan="2"><strong>Student Details</strong></th>
                                                    <th colspan="<?php echo count($subject_details); ?>"><strong>Subjects</strong></th>
                                                    <th width="15%" rowspan="2"><?php echo ucwords("Remarks"); ?></th>
                                                </tr>
                                                <tr>                                                
                                                    <th>Roll No</th>
                                                    <th width="10%"><?php echo ucwords("Student Name"); ?></th>
                                                    <?php foreach ($subject_details as $subject) { ?>
                                                        <th><?php echo $subject->subject_name; ?></th>
                                                    <?php } ?>                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <input type="hidden" name="total_student" value="<?php echo count($student_list); ?>"/>
                                            <?php
                                            if (count($subject_details)) {
                                                $counter = 1;
                                                ?>
                                                <?php if (count($student_list)) { ?>
                                                    <?php
                                                    $student_count = 1;
                                                    foreach ($student_list as $student) {
                                                        if ($student_id != '') {
                                                            if ($student_id != $student->std_id) {
                                                                continue;
                                                            }
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $student_count++; ?></td>
                                                            <td><?php echo $student->std_roll; ?></td>
                                                            <td data-id="63"><?php echo $student->std_first_name . ' ' . $student->std_last_name; ?></td>

                                                            <?php foreach ($subject_details as $subject) { ?>
                                                                <?php
                                                                $where = array(
                                                                    'mm_std_id' => $student->std_id,
                                                                    'mm_subject_id' => $subject->sm_id,
                                                                    'mm_exam_id' => $exam_detail[0]->em_id,
                                                                );
                                                                $marks = $this->Crud_model->student_exam_mark($where);
                                                                ?>
                                                                <td><input type="number" class="form-control" placeholder="Obtained Marks / <?php echo $exam_detail[0]->total_marks; ?>"
                                                                           min="0" max="<?php echo $exam_detail[0]->total_marks; ?>"
                                                                           name="mark_<?php echo $counter; ?>_<?php echo $student->std_id; ?>_<?php echo $exam_detail[0]->em_id; ?>_<?php echo $subject->sm_id; ?>"
                                                                           value="<?php if (count($marks)) echo $marks->mark_obtained; ?>"/></td>
                                                                <?php } ?>

                                                            <td><input type="text" class="form-control" 
                                                                       value="<?php if (count($marks)) echo $marks->mm_remarks; ?>"
                                                                       name="remark_<?php echo $counter; ?>_<?php echo $student->std_id; ?>_<?php echo $exam_detail[0]->em_id; ?>"/></td>
                                                        </tr>
                                                        <?php
                                                        $counter++;
                                                    }
                                                    ?>

                                                    <?php
                                                } else {
                                                    ?>

                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="4" style="text-align: left">Exam schedule not found</td>
                                                </tr>

                                            <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <br/>
                                    <?php if (count($student_list)) { ?>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form_sep">
                                                    &nbsp;<input type="submit" class="btn btn-primary" value="Submit"/> 
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </form>


                            </div>
                        </div>
                    </div>
                <?php } ?>           
                <?php } ?>
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div></di>
<!-- End #content -->

<script>
    function get_exam_list(degree_id, course_id, batch_id, semester_id, exam_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>exam/get_exam_list/' + degree_id + '/' + course_id + '/' + batch_id + '/' + semester_id + '/' + exam_id,
            type: 'get',
            success: function (content) {
                $('#exam').html(content);
            }
        });
    }

    $(document).ready(function () {
        var degree_id = '<?php echo $degree_id; ?>';
        var course_id = '<?php echo $course_id; ?>';
        var batch_id = '<?php echo $batch_id; ?>';
        var semester_id = '<?php echo $semester_id; ?>';
        var exam_id = '<?php echo $exam_id; ?>';
        get_exam_list(degree_id, course_id, batch_id, semester_id, exam_id);

        $('#course').on('change', function () {
            var degree_id = $('#degree').val();
            var course_id = $(this).val();
            var batch_id = $('#batch').val();
            var semester_id = $('#semester').val();
            var exam_id = $('#exam').val();
            get_exam_list(degree_id, course_id, batch_id, semester_id, exam_id);
            //subject_list(course_id, semester_id);
        })

        $('#semester').on('change', function () {
            var degree_id = $('#degree').val();
            var course_id = $('#course').val();
            var batch_id = $('#batch').val();
            var semester_id = $(this).val();
            var exam_id = $('#exam').val();
            get_exam_list(degree_id, course_id, batch_id, semester_id, exam_id);
            //subject_list(course_id, semester_id);
        })

        $('#exam').on('change', function () {
            var degree_id = $('#degree').val();
            var course_id = $('#course').val();
            var batch_id = $('#batch').val();
            var semester_id = $('#semester').val();
            var exam_id = $(this).val();

            if (degree_id && course_id && batch_id && semester_id && exam_id)
                location.href = '<?php echo base_url(); ?>marks/index/' + degree_id + '/' + course_id + '/' + batch_id + '/' + semester_id + '/' + exam_id
        })
    })
</script>

<script>
    $(document).ready(function () {
        //course by degree
        $('#degree').on('change', function () {
            var course_id = $('#course').val();
            var degree_id = $(this).val();

            //remove all present element
            $('#course').find('option').remove().end();
            $('#course').append('<option value="">Select</option>');
            var degree_id = $(this).val();
            $.ajax({
                url: '<?php echo base_url(); ?>branch/department_branch/' + degree_id,
                type: 'get',
                success: function (content) {
                    var course = jQuery.parseJSON(content);
                    $.each(course, function (key, value) {
                        $('#course').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    })
                }
            })
            batch_from_degree_and_course(degree_id, course_id);
        });

        //batch from course and degree
        $('#course').on('change', function () {
            var degree_id = $('#degree').val();
            var course_id = $(this).val();
            batch_from_degree_and_course(degree_id, course_id);
            get_semester_from_branch(course_id);
        })

        //find batch from degree and course
        function batch_from_degree_and_course(degree_id, course_id) {
            //remove all element from batch
            $('#batch').find('option').remove().end();
            $('select#batch').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>batch/department_branch_batch/' + degree_id + '/' + course_id,
                type: 'get',
                success: function (content) {
                    var batch = jQuery.parseJSON(content);
                    console.log(batch);
                    $.each(batch, function (key, value) {
                        $('#batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                    })
                }
            })
        }

        //get semester from brach
        function get_semester_from_branch(branch_id) {
            $('#semester').find('option').remove().end();
            $('select#semester').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>semester/semester_branch/' + branch_id,
                type: 'get',
                success: function (content) {
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    });
                }
            });
        }

        var degree_id = '<?php echo $degree_id; ?>';
        var course_id = '<?php echo $course_id; ?>';
        var batch_id = '<?php echo $batch_id; ?>';
        var semester_id = '<?php echo $semester_id; ?>';
        var exam_id = '<?php echo $exam_id; ?>';

        if (degree_id && course_id && batch_id && semester_id && exam_id) {
            $('select#degree').val(degree_id);
            $('#course').find('option').remove().end();
            $('#course').append('<option value="">Select</option>');
            //brach from degree
            $.ajax({
                url: '<?php echo base_url(); ?>branch/department_branch/' + degree_id,
                type: 'get',
                success: function (content) {
                    var course = jQuery.parseJSON(content);
                    $.each(course, function (key, value) {
                        $('#course').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    });
                    $('select#course').val(course_id);
                }
            });

            //batch from degree and course
            $('#batch').find('option').remove().end();
            $('select#batch').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>batch/department_branch_batch/' + degree_id + '/' + course_id,
                type: 'get',
                success: function (content) {
                    var batch = jQuery.parseJSON(content);
                    $.each(batch, function (key, value) {
                        $('#batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                    });
                    $('select#batch').val(batch_id);
                }
            })


            //get semester
            $('#semester').find('option').remove().end();
            $('select#semester').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>semester/semester_branch/' + course_id,
                type: 'get',
                success: function (content) {
                    var semester = jQuery.parseJSON(content);
                    console.log('hello');
                    console.log(semester);
                    $.each(semester, function (key, value) {
                        $('#semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    });
                    $('select#semester').val(semester_id);
                }
            });


            //get exam 
            var degree_id = '<?php echo $degree_id; ?>';
            var course_id = '<?php echo $course_id; ?>';
            var batch_id = '<?php echo $batch_id; ?>';
            var semester_id = '<?php echo $semester_id; ?>';
            var exam_id = '<?php echo $exam_id; ?>';
            get_exam_list(degree_id, course_id, batch_id, semester_id, exam_id);
            $('select#exam').val(exam_id);

            //single student marks
            $('#student').on('change', function () {
                var student_id = $(this).val();
                var degree = '<?php echo $this->uri->segment(3); ?>';
                var course = '<?php echo $this->uri->segment(4); ?>';
                var batch = '<?php echo $this->uri->segment(5); ?>';
                var semester = '<?php echo $this->uri->segment(6); ?>';
                var exam = '<?php echo $this->uri->segment(7); ?>';


                if (student_id != '') {
                    location.href = '<?php echo base_url(); ?>marks/index/' + degree + '/'
                            + course + '/' + batch + '/' + semester + '/' + exam + '/' + student_id;
                } else {
                    //all students
                    location.href = '<?php echo base_url(); ?>marks/index/' + degree + '/'
                            + course + '/' + batch + '/' + semester + '/' + exam;
                }
            });
        }

    });
</script>