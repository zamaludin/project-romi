<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content" class="home">
	<div class="widget-title">
		<h4><?=$title;?> <i class="fa fa-throphy"></i></h4>
	</div>
	<div class="widget">
		<?php if ($query->num_rows() > 0) {?>
		<table class="table">
			<thead>
				<th>NO</th>
				<th>PRESTASI YANG DIRAIH</th>
				<th>&nbsp;</th>
			</thead>
			<tbody>
				<?php $no = 1;foreach ($query->result() as $row) {?>
				<tr>
					<td><?=$no;?></td>
					<td><?=$row->post_title;?></td>
					<td>
						<a href="" data-toggle="modal" data-target="#<?=$row->post_id;?>"><i class="icon-zoom-in"></i></a>
					</td>
				</tr>
				<div class="modal fade" id="<?=$row->post_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h3 style="padding-left:10px;font-weight:bold;"><?=$title;?></h3>
				      </div>
				      <div class="modal-body">
			      			<ul class="post-list">
					        	<li class="clearfix">
					        		<div class="left-columns" style="min-height:150px;width: 35%;">
						      			<?php if ($row->post_image != NULL && file_exists('./assets/post/thumb/' . $row->post_image)) {?>
				                        <img style="margin-top:3px;" src="<?=base_url('assets/post/thumb/' . $row->post_image);?>">
				                        <?php } else {?>
				                        <img style="margin-top:3px;" src="<?=base_url('assets/190x190.gif');?>">
				                        <?php } ?>
						      		</div>
						      		<div class="right-columns">
					        		<p>
					        			<b><?=$row->post_title;?></b>
					        			<br>
					        			<?=$row->post_content;?>
					        		</p>
					        		</div>
					        	</li>
					        </ul>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
				      </div>
				    </div>
				  </div>
				</div>
				<?php $no++; } ?>
			</tbody>
		</table>

		<?php if ($total_rows > 20) {?>
		<div class="pagination">
			<ul class="clearfix" style="float:left">
				<?=$pagination;?>
			</ul>
		</div>
		<?php } ?>
		<?php } else {?>
			<div class="alert alert-info">
				Data prestasi tidak ditemukan !
			</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>