<?php

    echo "<h1>Form Tambah Data</h1>";
    echo form_open('mahasiswa/submit');
    echo "<pre>";
    $data = array(
            'name'      => 'var[0]',
            'id'        => 'var[0]',
            'value'     => '1311500123',
            'maxlength' => '10',
            'size'      => '10',
            'style'     => 'color: blue'
    );
    echo "NIS   : " . form_input($data) . "<br />";

    $data = array(
        'name'      => 'var[1]',
        'id'        => 'var[1]',
        'value'     => 'budi luhur',
        'maxlength' => '50',
        'size'      => '30',
        'style'     => 'color: blue'
    );
    echo "Nama   : " . form_input($data) . "<br />";

    $data = array(
        'name'      => 'var[2]',
        'id'        => 'var[2]',
        'value'     => 'Jl. Ciledug Raya',
        'maxlength' => '5',
        'size'      => '30',
        'style'     => 'color: blue'
    );
    echo "Alamat   : " . form_textarea($data) . "<br />";

    echo form_submit('submit', 'Simpan');
    echo "</pre>";
    echo form_close();

    if(isset($submitted)) {
        echo "Data Berhasil diinput <br>";
        echo "<a href= '".base_url()."siswa'>Kembali</a>";
    }
?>