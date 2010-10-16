<h1>Groups Edit</h1>
<form method="POST" action="<?php echo site_url();?>/kontak/edit_handler/<?php echo $result[0]->kontak_id;?>">
    <input type="hidden" name="id" value="<?php echo $result[0]->kontak_id;?>" />
    <table border="0">
        <tbody>
            <tr>
                <td>Instansi</td>
                <td> : </td>
                <td><input type="text" name="instansi" value="<?php echo $result[0]->instansi;?>" /></td>
            </tr>
            <tr>
                <td>Gelar Depan</td>
                <td> : </td>
                <td><input type="text" name="gelar_depan" value="<?php echo $result[0]->gelar_depan;?>" /></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td> : </td>
                <td><input type="text" name="nama" value="<?php echo $result[0]->nama;?>" /></td>
            </tr>
            <tr>
                <td>Gelar Belakang</td>
                <td> : </td>
                <td><input type="text" name="gelar_belakang" value="<?php echo $result[0]->gelar_belakang;?>" /></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td> : </td>
                <td><input type="text" name="jabatan" value="<?php echo $result[0]->jabatan;?>" /></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td> : </td>
                <td><input type="text" name="alamat" value="<?php echo $result[0]->alamat;?>" /></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td> : </td>
                <td><input type="text" name="telp" value="<?php echo $result[0]->telp;?>" /></td>
            </tr>
            <tr>
                <td>Faks</td>
                <td> : </td>
                <td><input type="text" name="faks" value="<?php echo $result[0]->faks;?>" /></td>
            </tr>
            <tr>
                <td>Handphone</td>
                <td> : </td>
                <td><input type="text" name="handphone" value="<?php echo $result[0]->handphone;?>" /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td> : </td>
                <td><input type="text" name="email" value="<?php echo $result[0]->email;?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Edit" /></td>
            </tr>
        </tbody>
    </table>
</form>