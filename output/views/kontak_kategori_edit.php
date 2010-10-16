<h1>Groups Edit</h1>
<form method="POST" action="<?php echo site_url();?>/kontak_kategori/edit_handler/<?php echo $result[0]->kontak_kategori_id;?>">
    <input type="hidden" name="id" value="<?php echo $result[0]->kontak_kategori_id;?>" />
    <table border="0">
        <tbody>
            <tr>
                <td>Kontak Id</td>
                <td> : </td>
                <td><input type="text" name="kontak_id" value="<?php echo $result[0]->kontak_id;?>" /></td>
            </tr>
            <tr>
                <td>Kategori Id</td>
                <td> : </td>
                <td><input type="text" name="kategori_id" value="<?php echo $result[0]->kategori_id;?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Edit" /></td>
            </tr>
        </tbody>
    </table>
</form>