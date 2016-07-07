
<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default">
            <div class=panel-body>
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/quiz_create');" data-toggle="modal"><i class="fa fa-plus"></i> Quiz</a>

                <table id="quiz-datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Department</th>                            
                            <th>Branch</th>
                            <th>Batch</th>
                            <th>Semester</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $counter = 0; ?>
                        <?php foreach ($quiz as $row) { ?>
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <td><?php echo $row->title; ?></td>
                                <td><?php echo $row->description; ?></td>
                                <td><?php echo $row->d_name; ?></td>
                                <td><?php echo $row->c_name; ?></td>
                                <td><?php echo $row->b_name; ?></td>
                                <td><?php echo $row->s_name; ?></td>
                                <td><?php echo $row->start_date; ?></td>
                                <td><?php echo $row->end_date; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>quiz/edit/<?php echo $row->quiz_id; ?>">
                                        <span class="label label-success mr6 mb6">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            Edit
                                        </span>
                                    </a>
                                    <a href="<?php echo base_url(); ?>quiz/instruction/<?php echo $row->quiz_id; ?>">
                                        <span class="label label-info mr6 mb6">
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                            Quiz
                                        </span>
                                    </a>
                                    <a href="<?php echo base_url(); ?>quiz/instruction/<?php echo $row->quiz_id; ?>">
                                        <span class="label label-danger mr6 mb6">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Delete
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->

<script>
    $(document).ready(function () {
        $('#quiz-datatable-list').DataTable({});
    })
</script>