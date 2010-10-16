<h1>Groups Edit</h1>
<form method="POST" action="<?php echo site_url();?>/kategori/edit_handler/<?php echo $result[0]->kategori_id;?>">
    <input type="hidden" name="id" value="<?php echo $result[0]->kategori_id;?>" />
    <table border="0">
        <tbody>
            <tr>
                <td>Nama</td>
                <td> : </td>
                <td><input type="text" name="nama" value="<?php echo $result[0]->nama;?>" /></td>
            </tr>
            <tr>
                <td>Parent Id</td>
                <td> : </td>
                <td><input type="text" name="parent_id" value="<?php echo $result[0]->parent_id;?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Edit" /></td>
            </tr>
        </tbody>
    </table>
</form>