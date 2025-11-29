<?php

//Fungsi Memanggil Data Base
$conn = mysqli_connect("localhost", "root", "", "simbas");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

//Fungsi Ubah Kategori
function ubah_kategori($data){
    global $conn;

    $id = $data['id_kategori'];         
    $nama_kategori = htmlspecialchars($data['nama_kategori']);

    $query = "UPDATE kategori SET
                nama_kategori = '$nama_kategori'
              WHERE id_kategori = $id";

    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn); 
}

// Fungsi Hapus Kategori
function hapus_kategori($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori=$id");
    return mysqli_affected_rows($conn);
}

// Fungsi Upload Gambar
function upload_gambar() {
    if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== 0) {
        return "default.png"; 
    }

    $namaFile = $_FILES['gambar']['name'];
    $tmp      = $_FILES['gambar']['tmp_name'];
    $ukuran   = $_FILES['gambar']['size'];
    $ext      = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    $allowed  = ['jpg','jpeg','png','gif'];

    if (!in_array($ext, $allowed)) return false; 
    if ($ukuran > 2 * 1024 * 1024) return false; 
    $namaFileBaru = uniqid() . '.' . $ext;
    if (!move_uploaded_file($tmp, 'dist/assets/img/' . $namaFileBaru)) return false;

    return $namaFileBaru;
}

//Fungsi Tambah Buku
function tambah_buku($data) {
    global $conn;

    $judul       = mysqli_real_escape_string($conn, trim($data['judul']));
    $penulis     = mysqli_real_escape_string($conn, trim($data['penulis']));
    $deskripsi   = mysqli_real_escape_string($conn, trim($data['deskripsi']));
    $id_kategori = (int)$data['id_kategori'];

    $upload = upload_gambar();
    if ($upload === false) return -1; 
    $gambar = $upload ? $upload : "";

    $sql = "INSERT INTO buku (judul_buku, penulis, deskripsi, id_kategori, gambar) 
            VALUES ('$judul', '$penulis', '$deskripsi', $id_kategori, '$gambar')";

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
}

//Fungsi Hapus Buku
function hapus_buku($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM buku WHERE id_buku=$id");
    return mysqli_affected_rows($conn);
}

//Fungsi Ubah Data
function ubah_buku($data){
    global $conn;

    $id        = $data['id_buku'];
    $judul     = htmlspecialchars($data['judul_buku']);
    $penulis   = htmlspecialchars($data['penulis']);
    $kategori  = $data['id_kategori'];
    $tanggal   = $data['tanggal_input'];
    $gambar    = $data['gambar'];

    $query = "UPDATE buku SET
        judul_buku='$judul',
        penulis='$penulis',
        kategori='$kategori',
        tanggal_input='$tanggal',
        gambar='$gambar'
        WHERE id_buku=$id";

    return mysqli_affected_rows($conn);
}

// Fungsi Search
function cari_buku($keyword){
    $query = "SELECT * FROM buku WHERE judul_buku LIKE '%$keyword%' OR penulis LIKE '%$keyword%'";
	return query($query);
}

//Fungsi Registrasi
function register_user($data) {
    global $conn;
    $username = strtolower(mysqli_real_escape_string($conn, trim($data['username'])));
    $email = strtolower(mysqli_real_escape_string($conn, trim($data['email'])));
    $password = $data['password'];

    // cek exist
    $cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' OR email='$email'");
    if (mysqli_fetch_assoc($cek)) return "exist";
    if (strlen($password) < 8) return "short";

    $hash = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO user (username,email,password) VALUES ('$username','$email','$hash')");
    return mysqli_affected_rows($conn);
}

//Fungsi login
function login($data){
    global $conn;

    $username = $data['username'];
    $password = $data['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' OR email='$username'");

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $_SESSION['login'] = true;
            return 1;
        } else {
            return "Password salah!";
        }
    }

    return "Akun tidak ditemukan!";
}
?>
