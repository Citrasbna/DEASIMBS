CREATE TABLE user (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(225) NOT NULL,
    PRIMARY KEY (id)
);


CREATE TABLE kategori (
    id_kategori INT(11) NOT NULL AUTO_INCREMENT,
    nama_kategori VARCHAR(100) NOT NULL,
    tanggal_input TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_kategori)
);

CREATE TABLE buku (
    id_buku INT(11) NOT NULL AUTO_INCREMENT,
    id_kategori INT(11) NOT NULL,
    judul_buku VARCHAR(200) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    gambar VARCHAR(225) NOT NULL,
    deskripsi TEXT NOT NULL,
    tanggal_input TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_buku),
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
        ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO buku (judul, penulis, deskripsi, kategori, gambar) VALUES
('Sejarah Publik', 'Faye Sayer', 'Sejarah Publik: Satu Pedoman Praktis membahas cara menerapkan sejarah di ruang publik melalui museum, arsip, media, dan komunitas, serta memberikan panduan praktis bagi pembaca untuk memahami keterampilan dan peluang profesi dalam bidang sejarah publik.',
'Sejarah',  'publik.jpg'),

('Sejarah Indonesia', 'DRS Djakariyah, M.Pd',
'Buku ini membahas sejarah Nusantara dari runtuhnya Majapahit hingga bubarnya VOC, mulai dari perkembangan Islam, munculnya kerajaan-kerajaan Islam, masuknya bangsa Barat, hingga perlawanan rakyat Indonesia. Isi buku ini menjadi bekal penting bagi mahasiswa sejarah tentang peristiwa Indonesia abad ke-15 sampai ke-18.',
'Sejarah','sejarah.jpg'),

('Pendidikan di Era Digital', 'Pratiwi Bernadetta Purba',
'Buku ini membahas dampak teknologi pada pendidikan Generasi Z dan menjadi panduan bagi pendidik serta orang tua dalam menghadapi tantangan era digital.',
'Pendidikan', 'digital.jpg'),

('Laskar Pelangi', 'Andrea Hirata',
'Laskar Pelangi adalah novel karya Andrea Hirata yang menceritakan perjuangan sekelompok anak di Belitung yang bersekolah di tempat sederhana namun memiliki semangat belajar tinggi. Kisah ini penuh inspirasi tentang persahabatan, harapan, dan mimpi besar meski hidup dalam keterbatasan.',
'Novel', 'laskar.jpg');
