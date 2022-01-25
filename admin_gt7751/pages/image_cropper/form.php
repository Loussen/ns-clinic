<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="tab-content">

		<div class="form-group row">
			<div class="col-md-12 docs-buttons">
				<div class="btn-group">
					<button type="button" class="btn btn-info" data-method="setDragMode" data-option="move" title="Move"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)"> <span class="fa fa-arrows"></span> </span>
					</button>
					<button type="button" class="btn btn-info" data-method="setDragMode" data-option="crop" title="Crop"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)"> <span class="fa fa-crop"></span> </span>
					</button>
				</div>
				<div class="btn-group">
					<?php if($zoom_out>=1) $z=$zoom_out+0.5; else $z=$zoom_out+0.1; ?>
					<a href="<?=addFullUrl( array('zoom_out'=>$z) )?>" style="color:#fff;">
					<button type="button" class="btn btn-success" title="Zoom In">
							<span class="docs-tooltip" data-toggle="tooltip_no" title="Zoom in"> <span class="fa fa-search-plus"></span></span>
					</button>
					</a>
					
					<?php if($zoom_out>1) $z=$zoom_out-0.5; else $z=$zoom_out-0.1; ?>
					<a href="<?=addFullUrl( array('zoom_out'=>($z)) )?>" style="color:#fff;">
					<button type="button" class="btn btn-success" title="Zoom Out">
						<span class="docs-tooltip" data-toggle="tooltip_no" title="Zoom out"> <span class="fa fa-search-minus"></span></span>
					</button>
					</a>
				</div>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-outline" data-method="move" data-option="-10" data-second-option="0" title="Move Left"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;move&quot;, -10, 0)"> <span class="fa fa-arrow-left"></span> </span>
					</button>
					<button type="button" class="btn btn-default btn-outline" data-method="move" data-option="10" data-second-option="0" title="Move Right"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;move&quot;, 10, 0)"> <span class="fa fa-arrow-right"></span> </span>
					</button>
					<button type="button" class="btn btn-default btn-outline" data-method="move" data-option="0" data-second-option="-10" title="Move Up"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;move&quot;, 0, -10)"> <span class="fa fa-arrow-up"></span> </span>
					</button>
					<button type="button" class="btn btn-default btn-outline" data-method="move" data-option="0" data-second-option="10" title="Move Down"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;move&quot;, 0, 10)"> <span class="fa fa-arrow-down"></span> </span>
					</button>
				</div>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-outline" data-method="rotate" data-option="-45" title="Rotate Left"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;rotate&quot;, -45)"> <span class="fa fa-rotate-left"></span> </span>
					</button>
					<button type="button" class="btn btn-default btn-outline" data-method="rotate" data-option="45" title="Rotate Right"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;rotate&quot;, 45)"> <span class="fa fa-rotate-right"></span> </span>
					</button>
				</div>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-outline" data-method="scaleX" data-option="-1" title="Flip Horizontal"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;scaleX&quot;, -1)"> <span class="fa fa-arrows-h"></span> </span>
					</button>
					<button type="button" class="btn btn-default btn-outline" data-method="scaleY" data-option="-1" title="Flip Vertical"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;scaleY&quot;, -1)"> <span class="fa fa-arrows-v"></span> </span>
					</button>
				</div>
				<div class="btn-group">
					<label class="btn btn-default btn-outline btn-upload" for="inputImage" title="Upload image file">
						<input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
						<span class="docs-tooltip" data-toggle="tooltip_no" title="Import image with Blob URLs"> <span class="fa fa-upload"></span> </span>
					</label>
					<button type="button" class="btn btn-default btn-outline" data-method="destroy" title="Destroy"> <span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;destroy&quot;)"> <span class="fa fa-power-off"></span> </span>
					</button>
				</div>
				<div class="btn-group btn-group-crop">
					<button type="button" class="btn btn-danger" data-method="getCroppedCanvas"><span class="docs-tooltip" data-toggle="tooltip_no" title="$().cropper(&quot;getCroppedCanvas&quot;)"> Seçilmiş kimi kəs </span></button>
				</div>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-outline" data-method="setData" data-target="#putData" data-option="{ &quot;width&quot;: 200, &quot;height&quot;: 210 }"> <span class="docs-tooltip"> <span class="fa fa-crop"></span> 200 x 210 </span> </button>
				</div>
				
				<div class="modal docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="getCroppedCanvasTitle">Kəsilmiş şəkil</h4>
							</div>
							<div class="modal-body"></div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Bağla</button>
								<?php
								if($return_url!=''){
									$type_selected_image=explode(".",$image_src); $type_selected_image=end($type_selected_image);
									echo '<a class="btn btn-success data_save" id="download" image_name="'.md5($image_src).'" type_selected_image="'.strtolower($type_selected_image).'" href="'.addFullUrl(array('save'=>md5($image_src))).'">Save</a>';
								}
								else echo '<a class="btn btn-primary data_download" id="download" href="javascript:void(0);" download="cropped.jpg">Yüklə</a>';
								?>
								
							</div>
						</div>
					</div>
				</div>

			</div>
							
			
			<div class="col-md-9 p-20">
				<div class="img-container"><img id="image" src="<?=decode_text($image_src)?>" class="img-responsive" alt="Picture"></div>
			</div>

			<div class="col-md-3 p-20 docs-toggles">
				<div class="btn-group btn-group-justified" data-toggle="buttons">
					<label class="btn btn-default btn-outline">
						<input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
						<span class="docs-tooltip" data-toggle="tooltip_no" title="aspectRatio: 16 / 9"> 16:9 </span> </label>
					<label class="btn btn-default btn-outline">
						<input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
						<span class="docs-tooltip" data-toggle="tooltip_no" title="aspectRatio: 4 / 3"> 4:3 </span> </label>
					<label class="btn btn-default btn-outline">
						<input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
						<span class="docs-tooltip" data-toggle="tooltip_no" title="aspectRatio: 1 / 1"> 1:1 </span> </label>
					<label class="btn btn-default btn-outline">
							<input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
							<span class="docs-tooltip" data-toggle="tooltip_no" title="aspectRatio: 2 / 3"> 2:3 </span> </label>
					<label class="btn btn-default btn-outline active">
						<input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
						<span class="docs-tooltip" data-toggle="tooltip_no" title="aspectRatio: NaN"> Any </span> </label>
				</div>
				<br />
				<div class="docs-preview clearfix">
					<div class="img-preview preview-lg"></div>
					<div class="img-preview preview-md"></div>
					<div class="img-preview preview-sm"></div>
					<div class="img-preview preview-xs"></div>
				</div>

				<div class="docs-data">
					<div class="input-group input-group-sm">
						<label class="input-group-addon" for="dataX">X</label>
						<input type="text" class="form-control" id="dataX" placeholder="x">
						<span class="input-group-addon">px</span> </div>
					<div class="input-group input-group-sm">
						<label class="input-group-addon" for="dataY">Y</label>
						<input type="text" class="form-control" id="dataY" placeholder="y">
						<span class="input-group-addon">px</span> </div>
					<div class="input-group input-group-sm">
						<label class="input-group-addon" for="dataWidth">Width</label>
						<input type="text" class="form-control" id="dataWidth" placeholder="width">
						<span class="input-group-addon">px</span> </div>
					<div class="input-group input-group-sm">
						<label class="input-group-addon" for="dataHeight">Height</label>
						<input type="text" class="form-control" id="dataHeight" placeholder="height">
						<span class="input-group-addon">px</span> </div>
					<div class="input-group input-group-sm">
						<label class="input-group-addon" for="dataRotate">Rotate</label>
						<input type="text" class="form-control" id="dataRotate" placeholder="rotate">
						<span class="input-group-addon">deg</span> </div>
				</div>
			</div>
			
		</div>
		
	</div>
</form>