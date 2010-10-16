<h1>{view_name}</h1>
<a href="{php_open} echo site_url(){php_close}/{table_name}/add_provider/"><img src="{php_open} echo base_url();{php_close}images/add.gif" alt=""/>Add {view_name}</a>
<form action="{php_open} echo site_url();{php_close}/{table_name}/grid_provider/" method="POST">
    Criteria : 
    <select name="criteria">
        <option value="">None</option>
        {php_open} foreach($field_data as $item):{php_close}
        <option value="{php_open} echo $item->name;{php_close}">{php_open} echo humanize($item->name);{php_close}</option>
        {php_open} endforeach;{php_close}
    </select>
    Key : 
    <input type="text" name="key" value="" />
    <input type="submit" value="search" />
</form>
{php_open} echo $pagination;{php_close}
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>{primary_key}</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        {php_open} $i = 1;{php_close}
        {php_open} foreach($result as $item):{php_close}
        <tr>
            <td>{php_open} echo $i++;{php_close}</td>
            <td>{php_open} echo $item->{primary_key};{php_close}</td>
            <td align="center"><a href="{php_open} echo site_url(){php_close}/{table_name}/edit_provider/{php_open} echo $item->{primary_key};{php_close}"><img src="{php_open} echo base_url();{php_close}images/edit.gif" alt="edit"/></a></td>
            <td align="center"><a href="{php_open} echo site_url(){php_close}/{table_name}/delete_handler/{php_open} echo $item->{primary_key};{php_close}" onclick="return confirm('yakin untuk menghapus?')" ><img src="{php_open} echo base_url();{php_close}images/delete.gif" alt="delete"/></a></td>
        </tr>
        {php_open} endforeach;{php_close}
    </tbody>
</table>
{php_open} echo $pagination;{php_close}