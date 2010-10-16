<h1>Kategori Add</h1>
<form method="POST" action="<?php echo site_url();?>/kategori/add_handler/">
    <table border="0">
        <tbody>
            <tr>
                <td>Nama</td>
                <td> : </td>
                <td><input type="text" name="nama" value=""/></td>
            </tr>
            <tr>
                <td>Parent Id</td>
                <td> : </td>
                <td><input type="text" name="parent_id" value=""/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Add" /></td>
            </tr>
        </tbody>
    </table>
</form>
