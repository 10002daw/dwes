<?php
    $usuarios = [
        [
            "nombre" => "Pepe",
            "apellido1" => "García",
            "apellido2" => "López",
            "usuario" => "pepegl",
            "password" => '$2y$10$3aEEZMEGVbioGC3JUcf21ePDJT3ErnXRbQRrpmsxWKnrlESTIK8g6',
            "email" => "pepegl@email.com",
        ],
        [
            "nombre" => "Paco",
            "apellido1" => "González",
            "apellido2" => "Ramírez",
            "usuario" => "pacogr",
            "password" => '$2y$10$dGK5tkWGrNZBWGpCcGDDeua9UXwF1Dw7JIVe4hpzd2uPcAool9/Ey',
            "email" => "pepegl@email.com",
        ]
    ];
    
    $json = json_encode($usuarios, JSON_UNESCAPED_UNICODE);

    if ( !$handle = fopen("usuarios.json","w") ) {
        echo "No se ha podido abrir el archivo";
    }

    fwrite($handle,$json);