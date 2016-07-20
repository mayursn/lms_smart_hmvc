<?php
$this->load->model('quiz/Quiz_questions_model');
$this->load->model('quiz/Quiz_question_options_model');

//$question = $this->Quiz_questions_model->get($param2);
//$question_option = $this->Quiz_question_options_model->get_many_by(array(
  //  'quiz_question_id' => $question->quiz_question_id
  //      ));
?>

<div class=row>                      
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default">
            <div class="panel-body"> 
                <div class="box-content">  

                    <?php echo form_open(base_url() . 'quiz/create_question/' . $param2, array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'quiz-question-option', 'target' => '_top')); ?>
                    <div class="padded">
                         <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo ucwords("question"); ?><span style="color:red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="question" value=""/>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo ucwords("question type"); ?><span style="color:red">*</span></label>
                                    <div class="col-sm-8">
                                        <select id="" class="form-control" name="question_type">
                                            <option value="SingleAnswer">Single Answer</option>
                                            <option value="MultiAnswer">Multiple Answer</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo ucwords("option1"); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="question_option_1" value=""/>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo ucwords("option2"); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="question_option_2" value=""/>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo ucwords("option3"); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="question_option_3" value=""/>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo ucwords("option4"); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="question_option_4" value=""/>
                                    </div>
                                </div> 
                         <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo ucwords("option5"); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="question_option_5" value=""/>
                                    </div>
                                </div>
                         <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo ucwords("option6"); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="question_option_6" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo ucwords("answer"); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="question_answer" value=""
                                               placeholder="Only enter option number"/>
                                        <span style="font-size: 10px;"> <strong style="color:red">Note :</strong> If you choose question type is Multiple Answer then answer enter like 1,2,3 </span>
                                    </div>
                                </div> 

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-8">
                                <button type="submit" class="btn btn-info">Add</button>
                            </div>
                        </div>
                    </div>    
                    <?php echo form_close(); ?>  
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(document).ready(function () {
           
            
            $("#quiz-question-option").validate({
                rules: {
                    question: "required",
                    question_option_1:"required",
                    question_answer: "required",
                },
                messages: {
                    question: "Enter question",
                    question_option_1:"Enter Option",
                    question_answer: "Enter currect answer",
                }
            });

        });
    </script>
