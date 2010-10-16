<h1>Kategori</h1>
<a href="<?php echo site_url()?>/kategori/add_provider/"><img src="<?php echo base_url();?>images/add.gif" alt=""/>Add Kategori</a>
<form action="<?php echo site_url();?>/kategori/grid_provider/" method="POST">
    Criteria : 
    <select name="criteria">
        <option value="">None</option>
        <?php foreach($field_data as $item):?>
        <option value="<?php echo $item->name;?>"><?php echo humanize($item->name);?></option>
        <?php endforeach;?>
    </select>
    Key : 
    <input type="text" name="key" value="" />
    <input type="submit" value="search" />
</form>
<?php echo $pagination;?>
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>kategori_id</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;?>
        <?php foreach($result as $item):?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $item->kategori_id;?></td>
            <td align="center"><a href="<?php echo site_url()?>/kategori/edit_provider/<?php echo $item->kategori_id;?>"><img src="<?php echo base_url();?>images/edit.gif" alt="edit"/></a></td>
            <td align="center"><a href="<?php echo site_url()?>/kategori/delete_handler/<?php echo $item->kategori_id;?>" onclick="return confirm('yakin untuk menghapus?')" ><img src="<?php echo base_url();?>images/delete.gif" alt="delete"/></a></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php echo $pagination;?>