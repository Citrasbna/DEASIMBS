<?php

require("function.php");

$id = $_GET['id'];

    if(hapus_kategori($id) > 0){
        echo "
            <script>
                alert('Data Kategori berhasil dihapus dari database!');
                document.location.href = 'index.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data Kategori gagal dihapus dari database!');
                document.location.href = 'index.php';
            </script>
        ";
    }

?>