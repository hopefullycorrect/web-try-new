<?php

    echo "<h1>Form Update Data</h1>";
    $hidden = array('old_nis' => $mhs[0]);
    echo form_open('siswa', '', $hidden);
    echo "<pre>";
    $data = array(
            'name'      => 'var[0]',
            'id'        => 'var[0]',
            'value'     => $mhs[0],
            'maxlength' => '10',
            'size'      => '10',
            'style'     => 'color: blue',
    );
    echo "NIS   : " . form_input($data) . "<br />";

    $data = array(
        'name'      => 'var[1]',
        'id'        => 'var[1]',
        'value'     => $mhs[1],
        'maxlength' => '50',
        'size'      => '30',
        'style'     => 'color: blue',
    );
    echo "Nama   : " . form_input($data) . "<br />";

    $data = array(
        'name'      => 'var[2]',
        'id'        => 'var[2]',
        'value'     => $mhs[2],
        'maxlength' => '5',
        'size'      => '30',
        'style'     => 'color: blue',
    );
    echo "Alamat   : " . form_textarea($data) . "<br />";

    echo form_submit('submit', 'Simpan');
    echo "</pre>";
    echo form_close();

    if(isset($submitted)) {
        echo "Data Berhasil diinput <br>";
        header('Location: http://localhost/budluhur/siswa');
    }
?>