<h1>Groups Edit</h1>
<form method="POST" action="<?php echo site_url();?>/property/edit_handler/<?php echo $result[0]->property_id;?>">
    <input type="hidden" name="id" value="<?php echo $result[0]->property_id;?>" />
    <table border="0">
        <tbody>
            <tr>
                <td>Property Id</td>
                <td> : </td>
                <td><input type="text" name="property_id" value="<?php echo $result[0]->property_id;?>" /></td>
            </tr>
            <tr>
                <td>Value</td>
                <td> : </td>
                <td><input type="text" name="value" value="<?php echo $result[0]->value;?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Edit" /></td>
            </tr>
        </tbody>
    </table>
</form>