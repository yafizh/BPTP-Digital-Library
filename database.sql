    CREATE TABLE user_table (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        user_username VARCHAR(255),
        user_password VARCHAR(255)
    );

    INSERT INTO user_table VALUES (null, 'admin', 'admin');

    CREATE TABLE book_category_table (
        book_category_id INT NOT NULL AUTO_INCREMENT,
        book_category VARCHAR(255),
        PRIMARY KEY (book_category_id)
    );

    CREATE TABLE book_language_table (
        book_language_id INT NOT NULL AUTO_INCREMENT,
        book_language VARCHAR(255),
        PRIMARY KEY (book_language_id)
    );

    CREATE TABLE book_table (
        book_id INT NOT NULL AUTO_INCREMENT,
        book_category_id INT NOT NULL,
        book_language_id INT NOT NULL,
        book_title VARCHAR(255) NOT NULL,
        book_sub_title VARCHAR(255) NULL,
        book_classification_number VARCHAR(255) NULL, -- Tipe Data Masih Belum Tepat
        book_isbn VARCHAR(13) NULL,
        book_publisher VARCHAR(255) NULL,
        book_publish_place VARCHAR(255) NULL,
        book_publish_date DATE NULL,
        book_author VARCHAR(255) NULL,
        book_illustration TINYINT(1) NOT NULL,
        book_width SMALLINT NULL,
        book_height SMALLINT NULL,
        book_page SMALLINT,
        book_stock INT NULL,
        book_cover_uri VARCHAR(30) NULL,
        book_file_uri VARCHAR(30) NULL,
        book_description TEXT,
        PRIMARY KEY (book_id),
        FOREIGN KEY (book_category_id) REFERENCES book_category_table (book_category_id) ON DELETE CASCADE,
        FOREIGN KEY (book_language_id) REFERENCES book_language_table (book_language_id) ON DELETE CASCADE
    );

    CREATE TABLE guest_table (
        guest_id INT NOT NULL AUTO_INCREMENT,
        book_category_id INT NOT NULL,
        guest_full_name VARCHAR(255) NOT NULL,
        guest_come_date_time DATETIME NOT NULL,
        guest_come_reason TEXT NULL,
        guest_profession TEXT NOT NULL,
        PRIMARY KEY (guest_id),
        FOREIGN KEY (book_category_id) REFERENCES book_category_table (book_category_id)
    );

    CREATE TABLE book_new_collection_table (
        book_new_collection_id INT NOT NULL AUTO_INCREMENT,
        book_id INT NOT NULL,
        book_new_collection_timestamp DATETIME NOT NULL,
        PRIMARY KEY (book_new_collection_id),
        FOREIGN KEY (book_id) REFERENCES book_table (book_id)
    );

    CREATE TABLE book_new_publish_table (
        book_new_publish_id INT NOT NULL AUTO_INCREMENT,
        book_id INT NOT NULL,
        book_new_publish_timestamp DATETIME NOT NULL,
        PRIMARY KEY (book_new_publish_id),
        FOREIGN KEY (book_id) REFERENCES book_table (book_id)
    );

    CREATE TABLE website_guest_table (
        website_guest_id INT NOT NULL AUTO_INCREMENT,
        website_guest_ip_public VARCHAR(255), -- Tipe Data Masih Belum Tepat
        website_guest_date_time_enter DATETIME NOT NULL,
        PRIMARY KEY (website_guest_id)
    );

    CREATE TABLE website_book_views_table (
        website_book_views_id INT NOT NULL AUTO_INCREMENT,
        book_id INT NOT NULL,
        website_guest_id INT NOT NULL,
        website_book_views_date_time_reading DATETIME NOT NULL,
        PRIMARY KEY (website_book_views_id),
        FOREIGN KEY (book_id) REFERENCES book_table (book_id),
        FOREIGN KEY (website_guest_id) REFERENCES website_guest_table (website_guest_id)
    );

    CREATE TABLE android_guest_table (
        android_guest_id INT NOT NULL AUTO_INCREMENT,
        android_guest_ip_public VARCHAR(255), -- Tipe Data Masih Belum Tepat
        android_guest_date_time_enter DATETIME,
        PRIMARY KEY (android_guest_id)
    );

    CREATE TABLE android_book_views_table (
        android_book_views_id INT NOT NULL AUTO_INCREMENT,
        book_id INT NOT NULL,
        android_guest_id INT NOT NULL,
        android_book_views_date_time_reading DATETIME NOT NULL,
        PRIMARY KEY (android_book_views_id),
        FOREIGN KEY (book_id) REFERENCES book_table (book_id),
        FOREIGN KEY (android_guest_id) REFERENCES android_guest_table (android_guest_id)
    );

    CREATE VIEW book_view AS 
    SELECT 
        book_table.*, 
        book_category_table.book_category, 
        book_language_table.book_language, 
        book_new_collection_table.book_new_collection_id,
        book_new_publish_table.book_new_publish_id FROM `book_table` 
    INNER JOIN `book_category_table` ON book_table.book_category_id = book_category_table.book_category_id
    INNER JOIN `book_language_table` ON book_table.book_language_id = book_language_table.book_language_id 
    LEFT JOIN `book_new_collection_table` ON book_table.book_id = book_new_collection_table.book_id 
    LEFT JOIN `book_new_publish_table` ON book_table.book_id = book_new_publish_table.book_id;

    CREATE VIEW new_book_collection_view AS 
    SELECT book_table.*, book_language_table.book_language FROM `book_new_collection_table` 
    INNER JOIN `book_table` ON book_table.book_id = book_new_collection_table.book_id 
    INNER JOIN `book_language_table` ON book_table.book_language_id = book_language_table.book_language_id;

    CREATE VIEW book_new_publish_view AS 
    SELECT book_table.*, book_language_table.book_language FROM `book_new_publish_table` 
    INNER JOIN `book_table` ON book_table.book_id = book_new_publish_table.book_id 
    INNER JOIN `book_language_table` ON book_table.book_language_id = book_language_table.book_language_id;

    -- Dummies Data
    INSERT INTO 
        book_category_table (book_category) 
    VALUES 
        ('UMUM'),
        ('FILSAFAT'),
        ('ILMU PENGETAHUAN MASYARAKAT'),
        ('BAHASA'),
        ('MATEMATIKA'),
        ('ILMU PENGETAHUAN TERAPAN'),
        ('KESENIAN'),
        ('LITERATUR'),
        ('SEJARAH');

    INSERT INTO 
        book_language_table (book_language) 
    VALUES 
        ('INDONESIA'),
        ('INGGRIS');

    INSERT INTO 
        book_table (
            book_category_id, 
            book_language_id, 
            book_title, 
            book_sub_title, 
            book_classification_number, 
            book_isbn, 
            book_publisher,
            book_publish_place,
            book_publish_date,
            book_author,
            book_illustration,
            book_width,
            book_height,
            book_page,
            book_stock,
            book_cover_uri,
            book_file_uri,
            book_description
        ) 
    VALUES 
        (2,1,'Homo Deus','Masa Depan Umat Manusia', '555', '9781910701874', 'PT Gramedia', 'Martapura', '2000-05-10', 'Yuval Noah Harari', 1, 10, 5, 100, 2, 'homo-deus.jpg', null, 'Menceritakan tentang masa depan umat manusia'),
        (9,1,'Sapiens','Riwayat Singkat Umat Manusia', '555', '9780062316097', 'PT Gramedia', 'Martapura', '2000-05-10', 'Yuval Noah Harari', 1, 10, 5, 100, 2, 'sapiens.jpg', null, 'Menceritakan tentang peradaban singkat manusia'),
        (6,1,'A Whole New Mind','', '555', '9781101157909', 'PT Gramedia', 'Martapura', '2000-05-10', 'Daniel H. Pink', 1, 10, 5, 100, 2, 'a-whole-new-mind.jpg', null, ''),
        (7,1,'Buku Panduan Matematika Terapan','', '555', '9786020383323', 'PT Gramedia', 'Martapura', '2000-05-10', 'Triskaidekaman', 1, 10, 5, 100, 2, 'buku-panduan-matematika.jpg', null, ''),
        (2,1,'Dunia Sophie','Sebuah Novel Filsafat', '555', '9780374530716', 'PT Gramedia', 'Martapura', '2000-05-10', 'Jostein Gaarder', 1, 10, 5, 100, 2, 'dunia-sophie.jpg', null, ''),
        (6,1,'Evolusi','Dari Teori ke Fakta', '555', '9786024810016', 'PT Gramedia', 'Martapura', '2000-05-10', 'Ernst Mayr', 1, 10, 5, 100, 2, 'evolusi.jpg', null, ''),
        (8,1,'How to be a Brilliant Thinker','Latih pikiran Anda dan temukan solusi-solusi kreatif', '555', '9780749455064', 'PT Gramedia', 'Martapura', '2000-05-10', 'Paul Sloane', 1, 10, 5, 100, 2, 'ho-to-be.jpg', null, ''),
        (2,1,'How To Die','Sebuah Panduan Klasik Menjelang Ajal', '555', '9781684412297', 'PT Gramedia', 'Martapura', '2000-05-10', 'Seneca', 1, 10, 5, 100, 2, 'how-to-die.jpg', null, ''),
        (7,1,'I Want to Die but I Want to Eat Tteokpokki','', '555', '9781526650863', 'PT Gramedia', 'Martapura', '2000-05-10', 'Baek Se Hee', 1, 10, 5, 100, 2, 'i-want-to-die.jpg', null, ''),
        (6,1,'Sebuah Seni Untuk Bersikap Bodo Amat','', '555', '9780062641540', 'PT Gramedia', 'Martapura', '2000-05-10', 'Mark Manson', 1, 10, 5, 100, 2, 'sebuah-seni.jpg', null, ''),
        (6,1,'Madilog','Materialisme, Dialektika, dan Logika', '555', '9789791683319', 'PT Gramedia', 'Martapura', '2000-05-10', 'Tan Malaka', 1, 10, 5, 100, 2, 'tan-malaka.jpg', null, ''),
        (6,1,'Underground A Novel','', '555', '9786020319469', 'PT Gramedia', 'Martapura', '2000-05-10', 'Ika Natassa', 1, 10, 5, 100, 2, 'undergroud.jpg', null, '');

    INSERT INTO 
        guest_table (
            book_category_id,
            guest_full_name,
            guest_come_date_time,
            guest_come_reason,
            guest_profession
        )
    VALUES 
        (1, "Nursahid Arya Suyudi", CURRENT_TIMESTAMP(), "Mengunjungi mahasiswa magang", '{"guest-profession":"STUDENT","guest-university":"Universital Islam Kalimantan","guest-study-program":"Teknologi Informasi"}'),
        (2, "Nurcholis", CURRENT_TIMESTAMP(), "Magang", '{"guest-profession":"STUDENT","guest-university":"Universital Islam Kalimantan","guest-study-program":"Teknologi Informasi"}'),
        (3, "Diki Suti Prasetya", CURRENT_TIMESTAMP(), "Magang", '{"guest-profession":"STUDENT","guest-university":"Universital Islam Kalimantan","guest-study-program":"Teknologi Informasi"}'),
        (4, "Rania Nor Aida", CURRENT_TIMESTAMP(), "Mengunjungi mahasiswa magang", '{"guest-profession":"STUDENT","guest-university":"Universital Islam Kalimantan","guest-study-program":"Teknologi Informasi"}'),
        (5, "Harun", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 1 DAY), "Mengunjungi mahasiswa magang", '{"guest-profession":"BPTP_EMPLOYEE","guest-division":"Peneliti"}'),
        (3, "Odiah Permata Sari", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 2 DAY), "Magang", '{"guest-profession":"STUDENT","guest-university":"Universital Lambung Mangkurat","guest-study-program":"Agronomi"}'),
        (2, "Tiara Mayasari", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 2 DAY), "Magang", '{"guest-profession":"STUDENT","guest-university":"Universital Lambung Mangkurat","guest-study-program":"Agronomi"}'),
        (3, "Ahmad Fahrudin", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 2 DAY), "Magang", '{"guest-profession":"STUDENT","guest-university":"Universital Lambung Mangkurat","guest-study-program":"Agronomi"}'),
        (3, "Ahmad Ibrahim", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 2 DAY), "Magang", '{"guest-profession":"STUDENT","guest-university":"Universital Lambung Mangkurat","guest-study-program":"Agronomi"}'),
        (3, "Agus Setiawan", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 3 DAY), "Kunjungan", '{"guest-profession":"GENERAL"}'),
        (3, "Yogi", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 3 DAY), "Kunjungan", '{"guest-profession":"GENERAL"}'),
        (3, "Aulia Rahman", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 4 DAY), "Kunjungan", '{"guest-profession":"GENERAL"}'),
        (3, "Eko", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 4 DAY), "Kerja", '{"guest-profession":"BPTP_EMPLOYEE"}'),
        (3, "Tya", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 5 DAY), "Kerja", '{"guest-profession":"BPTP_EMPLOYEE"}')