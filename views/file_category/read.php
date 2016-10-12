<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-bars text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open('file_category/delete');?>
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
                <?php if(count($query) > 0) { ?>
                    <button onClick="return confirm('Apakah anda yakin data akan dihapus ?')" type="submit" name="delete" class="btn btn-sm bg-red btn-flat"><i class="glyphicon glyphicon-trash"></i> HAPUS ITEM TERPILIH</button>
                <?php } ?>
                <a href="<?=site_url('file_category/create');?>" class="btn btn-sm bg-green btn-flat"><i class="glyphicon glyphicon-plus"></i> TAMBAH KATEGORI FILE</a>
            </div>
            <div class="box-body">
                <?php if (count($query) > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px"><input type="checkbox" id="check-all"/></th>
                        <th>KATEGORI FILE</th>
                        <th style="width:85px;">&nbsp;</th>
                    </tr>
                    <?php
                    foreach ($query as $row) { ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="category_id[]" value="<?=$row['category_id'];?>" /></td>
                        <td><?=$row['category'];?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?=site_url('file_category/update/'.$row['category_id']);?>" class="btn btn-sm bg-teal btn-flat" data-toggle="tooltip" data-original-title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                <a onClick="return confirm('Apakah anda yakin data akan dihapus ?')" href="<?=site_url('file_category/delete/'.$row['category_id']);?>" class="btn btn-sm bg-red btn-flat" data-toggle="tooltip" data-original-title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                    $sub_category = $this->m_global->get_parent_table($row['category_id']);
                    if ($sub_category != '')
                    {
                        echo recursive_table($row['child']);  
                    }
                    }
                    ?>
                </table>
                <?php } else { ?>
                <br>
                <div class="alert alert-info">
                    <i class="fa fa-info"></i>
                    Data tidak ditemukan !
                </div>
                <?php } ?>
            </div>
        </div>
        </form>
    </div>
</section>