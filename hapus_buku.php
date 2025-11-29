<?php

require("function.php");

$id = $_GET['id'];

    if(hapus_buku($id) > 0){
        echo "
            <script>
                alert('Data Buku berhasil dihapus dari database!');
                document.location.href = 'index.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data Buku gagal dihapus dari database!');
                document.location.href = 'index.php';
            </script>
        ";
    }

?>