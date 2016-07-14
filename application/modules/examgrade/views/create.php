<div class="row">
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title>Add Exam Grade</h4>
                        </div>-->
            <div class=panel-body>
                <?php echo form_open(base_url() . 'examgrade/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'gradeform', 'target' => '_top')); ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Grade Name"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <input id="grade_name" class="form-control" type="text" name="grade_name"/>
                    </div>	
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("From Percentage"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="from_marks" id="from_marks" min="0"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("To Percentage"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="to_marks" id="to_marks"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Description"); ?></label>
                    <div class="col-sm-8">	
                        <div class="chat-message-box">
                            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("Add"); ?></button>
                    </div>
                </div> 
                <?php echo form_close(); ?>
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>

 <script type="text/javascript">

    $(document).ready(function () {
        $("#gradeform").validate({
            rules: {
                grade_name: "required",
                from_marks: "required",
                to_marks: "required"
            },
            messages: {
                grade_name: "Enter grade name",
                from_marks: "Enter valid grade number percentage",
                to_marks: "Enter valid grade number percentage"
            },
        });
    });
    </script>

    <script>
        $(document).ready(function () {
            $('#from_marks').on('blur', function () {
                $('#to_marks').attr('min', $(this).val());
                $('#to_marks').attr('required', 'required');
            });
        })
    </script>