<h1>Groups Edit</h1>
<form method="POST" action="{php_open} echo site_url();{php_close}/{table_name}/edit_handler/{php_open} echo $result[0]->{primary_key};{php_close}">
    <input type="hidden" name="id" value="{php_open} echo $result[0]->{primary_key};{php_close}" />
    <table border="0">
        <tbody>{fields_data}
            <tr>
                <td>{field_name}</td>
                <td> : </td>
                <td>{field_input}</td>
            </tr>{/fields_data}
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Edit" /></td>
            </tr>
        </tbody>
    </table>
</form>