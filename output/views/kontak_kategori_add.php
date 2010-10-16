<h1>Kontak Kategori Add</h1>
<form method="POST" action="<?php echo site_url();?>/kontak_kategori/add_handler/">
    <table border="0">
        <tbody>
            <tr>
                <td>Kontak Id</td>
                <td> : </td>
                <td><input type="text" name="kontak_id" value=""/></td>
            </tr>
            <tr>
                <td>Kategori Id</td>
                <td> : </td>
                <td><input type="text" name="kategori_id" value=""/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Add" /></td>
            </tr>
        </tbody>
    </table>
</form>
