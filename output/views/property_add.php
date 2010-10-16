<h1>Property Add</h1>
<form method="POST" action="<?php echo site_url();?>/property/add_handler/">
    <table border="0">
        <tbody>
            <tr>
                <td>Property Id</td>
                <td> : </td>
                <td><input type="text" name="property_id" value=""/></td>
            </tr>
            <tr>
                <td>Value</td>
                <td> : </td>
                <td><input type="text" name="value" value=""/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Add" /></td>
            </tr>
        </tbody>
    </table>
</form>
