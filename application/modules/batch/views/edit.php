<?php
$edit_data = $this->db->get_where('batch', array('b_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>
    <div class=row>                      

        <div class=col-lg-12>
            <!-- col-lg-12 start here -->
            <div class="panel-default toggle panelMove panelClose panelRefresh">
                <!-- Start .panel -->
                <!--                <div class=panel-heading>
                                    <h4 class=panel-title>  <?php echo ucwords("Update Batch"); ?></h4>                
                                </div>-->


                <div class="panel-body">
                    <div class="tab-pane box" id="add" style="padding: 5px">
                        <div class="box-content">  
                            <div class="">
                                <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                            </div>
                            <?php echo form_open(base_url() . 'batch/update/' . $row['b_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'batchformedit', 'target' => '_top')); ?>
                            <input type="hidden" name="courseid" id="courseid" value="<?php echo $row['course_id'] ?>">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Batch Name"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="b_name" id="b_name" value="<?php echo $row['b_name']; ?>"   />
                                </div>
                            </div>   
                            <div class="form-group">                        
                                <?php
                                $degree = $this->db->get('degree')->result_array();
                                $course = $this->db->get('course')->result_array();
                                ?>
                                <label class="col-sm-4 control-label"><?php echo ucwords("department"); ?> <span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select id="degree1" name="degree1[]" class="form-control" multiple>
                                                                         
                                        <?php
                                        $d = explode(',', $row['degree_id']);
                                        foreach ($degree as $srow) {
                                            if (in_array($srow['d_id'], $d)) {
                                                ?>
                                                <option value="<?php echo $srow['d_id']; ?>" selected><?php echo $srow['d_name']; ?>
                                                </option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $srow['d_id']; ?>"><?php echo $srow['d_name']; ?>
                                                </option>   
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>	
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select id="course1" name="course1[]" class="form-control" multiple>

                                        <?php
                                        $c = explode(',', $row['course_id']);
                                        foreach ($course as $crow) {
                                            if (in_array($crow['course_id'], $c)) {
                                                ?>
                                                <option value="<?php echo $crow['course_id']; ?>" selected><?php echo $crow['c_name']; ?>
                                                </option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $crow['course_id']; ?>"><?php echo $crow['c_name']; ?>
                                                </option>  
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>	
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Status"); ?></label>
                                <div class="col-sm-8">
                                    <select name="batch_status" class="form-control">
                                        <option value="1" <?php
                                        if ($row['b_status'] == '1') {
                                            echo "selected";
                                        }
                                        ?>>Active</option>
                                        <option value="0" <?php
                                        if ($row['b_status'] == '0') {
                                            echo "selected";
                                        }
                                        ?>>Inactive</option>	
                                    </select>	
                                </div>	
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" class="submit btn btn-info vd_bg-green"><?php echo ucwords("Update"); ?></button>
                                </div>
                            </div>
                        </div> </div> </div>
            </div>
        </div>
    </div>

    <?php
endforeach;
?>

<script type="text/javascript">

    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("#degree1").change(function () {
        var degree = $(this).val();
        if (degree != "")
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'batch/get_cource_multiple/'; ?>",
                data:
                        {
                            'degree': degree,
                            'courseid': $("#courseid").val(),
                        },
                success: function (response) {
                    $("#course1").html(response);
                }
            });
        }
    });

    $.validator.addMethod("valueNotEquals", function (value, element, arg) {
        return arg != value;
    }, "Value must not equal arg.");
    $("#batchformedit").validate({
        rules: {
            b_name: "required",
            'degree1[]':
                    {
                        //valueNotEquals: "default",
                        required: true,
                    },
            'course1[]':
                    {
                       // valueNotEquals: "default",
                        required: true,
                    },
            batch_status: "required",
        },
        messages: {
            b_name: "Please enter batch Name",
            'degree1[]':
                    {
                        //valueNotEquals: "Select department",
                        required: "Select department",
                    },
            'course1[]':
                    {
                        //valueNotEquals: "Select branch",
                        required: "Select branch",
                    },
            batch_status: "Select status",
        }
    });
</script>



