<h1>{view_name} Add</h1>
<form method="POST" action="{php_open} echo site_url();{php_close}/{table_name}/add_handler/">
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
                <td><input type="submit" value="Add" /></td>
            </tr>
        </tbody>
    </table>
</form>
