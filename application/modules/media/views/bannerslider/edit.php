<?php 
$edit_data		=	$this->db->get_where('banner_slider' , array('banner_id' => $param2) )->result_array();

foreach ( $edit_data as $row):

?>
    <script language="javascript" type="text/javascript">
   
        $(document).ready(function($){
	images = new Array();
	$(document).on('change','.coverimage2',function(){
		 files = this.files;
               
		 $.each( files, function(){
			 file = $(this)[0];
			 if (!!file.type.match(/image.*/)) {
	        	 var reader = new FileReader();
	             reader.readAsDataURL(file);
	             reader.onloadend = function(e) {
	            	img_src = e.target.result; 
	            	html = "<img class='img-thumbnail' style='width:300px;margin:20px;' src='"+img_src+"'>";
	            	$('#image_container1').html( html );
	             };
        	 } 
		});
	});
});
    </script>
<div class=row>                      
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->

			<div class="panel-body">
				 <div class="">
                                    <span style="color:red">* <?php echo "is ".ucwords("mandatory field");?></span> 
                                    
                                                                    
<?php echo form_open(base_url() . 'media/banner_slider/update/'.$row['banner_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmgallery2', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                                    <div class="padded">											
                                        
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Title </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="title" value="<?php echo $row['banner_title']; ?>" id="title" />
                                            </div>
                                        </div>
                               

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Description </label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="description" id="description"><?php echo $row['banner_desc']; ?></textarea>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-4 control-label">Slider Image <span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input id="main_img" class="form-control coverimage2" type="file" name="main_img" />
                                            </div>
                                            

                        <div class="form-group">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-8">
                              <div id="image_container1"><img class='img-thumbnail' style='width:300px;margin:20px;' src='<?php echo base_url()."uploads/bannerimg/".$row['banner_img']; ?>' ></div>
                            </div>
                           
                        </div>                                                                               
 
                                        </div>             
                                         <div class="form-group">
                                                    <label class="col-sm-4 control-label">Slide</label>
                                                    <div class="col-sm-8">
                                                        <select name="slide_option" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="slideInLeft" <?php if($row['slide_option']=="slideInLeft"){ echo "selected=selected"; } ?>>Left</option>
                                                            <option value="slideInRight" <?php if($row['slide_option']=="slideInRight"){ echo "selected=selected"; } ?> >Right</option>
                                                            <option value="sliceDown" <?php if($row['slide_option']=="sliceDown"){ echo "selected=selected"; } ?>>sliceDown</option>
                                                            <option value="sliceDownLeft" <?php if($row['slide_option']=="sliceDownLeft"){ echo "selected=selected"; } ?>>sliceDownLeft</option>
                                                            <option value="sliceUp" <?php if($row['slide_option']=="sliceUp"){ echo "selected=selected"; } ?>>sliceUp</option>
                                                            <option value="sliceUpLeft" <?php if($row['slide_option']=="sliceUpLeft"){ echo "selected=selected"; } ?>>sliceUpLeft</option>
                                                            <option value="sliceUpDown" <?php if($row['slide_option']=="sliceUpDown"){ echo "selected=selected"; } ?>>sliceUpDown</option>
                                                            <option value="sliceUpDownLeft" <?php if($row['slide_option']=="sliceUpDownLeft"){ echo "selected=selected"; } ?>>sliceUpDownLeft</option>
                                                            <option value="fold" <?php if($row['slide_option']=="fold"){ echo "selected=selected"; } ?>>fold</option>
                                                            <option value="fade" <?php if($row['slide_option']=="fade"){ echo "selected=selected"; } ?>>fade</option>
                                                            <option value="random" <?php if($row['slide_option']=="random"){ echo "selected=selected"; } ?>>random</option>
                                                            <option value="boxRandom" <?php if($row['slide_option']=="boxRandom"){ echo "selected=selected"; } ?>>boxRandom</option>
                                                            <option value="boxRain" <?php if($row['slide_option']=="boxRain"){ echo "selected=selected"; } ?>>boxRain</option>
                                                            <option value="boxRainReverse" <?php if($row['slide_option']=="boxRainReverse"){ echo "selected=selected"; } ?>>boxRainReverse</option>
                                                            <option value="boxRainGrow" <?php if($row['slide_option']=="boxRainGrow"){ echo "selected=selected"; } ?>>boxRainGrow</option>
                                                            <option value="boxRainGrowReverse" <?php if($row['slide_option']=="boxRainGrowReverse"){ echo "selected=selected"; } ?>>boxRainGrowReverse</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Status  <span style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <select name="status" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="1" <?php if($row['banner_status']=="1"){ echo "selected=selected"; } ?>>Active</option>
                                                            <option value="0" <?php if($row['banner_status']=="0"){ echo "selected=selected"; } ?>>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" class="btn btn-info vd_bg-green"> Update Banner Slider</button>
                                            </div>
                                        </div>
                                        </form>               
                                    </div> 
                                    <div id="dvPreview3">
                                  </div>
                                     
                                    
                                </div>
            </div>
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

        $().ready(function () {

            $("#frmgallery2").validate({
                rules: {
                   
                    main_img:{
                        extension:'gif|jpg|png|jpeg', 
                    },                    
                    status:"required",
                    
                },
                messages: {
                    main_img:{
                        extension:'Upload valid file!',  
                    },
                    status:"Select Status",                         
                    
                },
            });
        });
    </script>
