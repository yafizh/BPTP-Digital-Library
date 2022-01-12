    CREATE DATABASE `db_sistem_informasi_perpustakaan`;
    USE `db_sistem_informasi_perpustakaan`;
    CREATE TABLE `user_table` (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        user_username VARCHAR(255),
        user_password VARCHAR(255)
    );

    INSERT INTO `user_table` VALUES (null, 'admin', 'admin');

    CREATE TABLE `book_category_table` (
        book_category_id INT NOT NULL AUTO_INCREMENT,
        book_category VARCHAR(255),
        PRIMARY KEY (book_category_id)
    );

    CREATE TABLE `book_language_table` (
        book_language_id INT NOT NULL AUTO_INCREMENT,
        book_language VARCHAR(255),
        PRIMARY KEY (book_language_id)
    );

    CREATE TABLE `book_table` (
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

    CREATE TABLE `book_new_collection_table` (
        book_new_collection_id INT NOT NULL AUTO_INCREMENT,
        book_id INT NOT NULL,
        book_new_collection_timestamp DATETIME NOT NULL,
        PRIMARY KEY (book_new_collection_id),
        FOREIGN KEY (book_id) REFERENCES book_table (book_id)
    );

    CREATE TABLE `book_new_publish_table` (
        book_new_publish_id INT NOT NULL AUTO_INCREMENT,
        book_id INT NOT NULL,
        book_new_publish_timestamp DATETIME NOT NULL,
        PRIMARY KEY (book_new_publish_id),
        FOREIGN KEY (book_id) REFERENCES book_table (book_id)
    );

    CREATE TABLE `book_popular_table` (
        book_popular_id INT NOT NULL AUTO_INCREMENT,
        book_id INT NOT NULL,
        book_popular_timestamp DATETIME NOT NULL,
        PRIMARY KEY (book_popular_id),
        FOREIGN KEY (book_id) REFERENCES book_table (book_id)
    );

    CREATE VIEW `book_view` AS 
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

    CREATE VIEW `new_book_collection_view` AS 
    SELECT book_table.*, book_language_table.book_language FROM `book_new_collection_table` 
    INNER JOIN `book_table` ON book_table.book_id = book_new_collection_table.book_id 
    INNER JOIN `book_language_table` ON book_table.book_language_id = book_language_table.book_language_id;

    CREATE VIEW `book_new_publish_view` AS 
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
        (2,1,'Homo Deus','Masa Depan Umat Manusia', '555', '9781910701874', 'PT Gramedia', 'Martapura', '2000-05-10', 'Yuval Noah Harari', 1, 10, 5, 100, 2, 'homo-deus.jpg', null, 'Homo Deus: A Brief History of Tomorrow is a book written by Israeli author Yuval Noah Harari, professor at the Hebrew University in Jerusalem. The book was first published in Hebrew in 2015 by Dvir publishing; the English-language version was published in September 2016 in the United Kingdom and in February 2017 in the United States.'),
        (9,1,'Sapiens','Riwayat Singkat Umat Manusia', '555', '9780062316097', 'PT Gramedia', 'Martapura', '2000-05-10', 'Yuval Noah Harari', 1, 10, 5, 100, 2, 'sapiens.jpg', null, 'Sapiens: A Brief History of Humankind is a book by Yuval Noah Harari, first published in Hebrew in Israel in 2011 based on a series of lectures Harari taught at The Hebrew University of Jerusalem, and in English in 2014. The book, focusing on Homo sapiens, surveys the history of humankind, starting from the Stone Age, and going up to the twenty-first century. The account is situated within a framework that intersects the natural sciences with the social sciences.'),
        (6,1,'A Whole New Mind','', '555', '9781101157909', 'PT Gramedia', 'Martapura', '2000-05-10', 'Daniel H. Pink', 1, 10, 5, 100, 2, 'a-whole-new-mind.jpg', null, 'The future belongs to a different kind of person with a different kind of mind: artists, inventors, storytellers-creative and holistic "right-brain" thinkers whose abilities mark the fault line between who gets ahead and who doesnt.'),
        (7,1,'Buku Panduan Matematika Terapan','', '555', '9786020383323', 'PT Gramedia', 'Martapura', '2000-05-10', 'Triskaidekaman', 1, 10, 5, 100, 2, 'buku-panduan-matematika.jpg', null, 'Pertanyaan P-NP (sesuatu yang bisa diperhitungkan-sesuatu yang tidak bisa diperhitungkan) muncul setelah Prima didatangi oleh hantu yang mengajarinya cara berhitung dan berbagai teori matematika di dalam mimpi. Teka-teki itu semakin mengusiknya ketika ia bertemu Tarsa—si cerdas yang juga memiliki pertanyaan sama tentang P-NP. Namun, meski telah mencurahkan seluruh hidupnya, Prima tak juga mampu menemukan jawabannya. Tentu. Karena, siapa pula manusia di dunia ini yang bisa menjawab kapan ia akan dimatikan?'),
        (2,1,'Dunia Sophie','Sebuah Novel Filsafat', '555', '9780374530716', 'PT Gramedia', 'Martapura', '2000-05-10', 'Jostein Gaarder', 1, 10, 5, 100, 2, 'dunia-sophie.jpg', null, 'Sophie"s World (Norwegian: Sofies verden) is a 1991 novel by Norwegian writer Jostein Gaarder. It follows Sophie Amundsen, a Norwegian teenager, who is introduced to the history of philosophy as she is asked "Who are you?" in a letter from an unknown philosopher.'),
        (6,1,'Evolusi','Dari Teori ke Fakta', '555', '9786024810016', 'PT Gramedia', 'Martapura', '2000-05-10', 'Ernst Mayr', 1, 10, 5, 100, 2, 'evolusi.jpg', null, 'Many scientists and philosophers of science have described evolution as fact and theory, a phrase which was used as the title of an article by paleontologist Stephen Jay Gould in 1981. He describes fact in science as meaning data, not known with absolute certainty but "confirmed to such a degree that it would be perverse to withhold provisional assent"'),
        (8,1,'How to be a Brilliant Thinker','Latih pikiran Anda dan temukan solusi-solusi kreatif', '555', '9780749455064', 'PT Gramedia', 'Martapura', '2000-05-10', 'Paul Sloane', 1, 10, 5, 100, 2, 'ho-to-be.jpg', null, 'Do you want to have great ideas? Do you want to break out of the rut of conventional thinking? Would you like to be a genius? Would presenting brilliant ideas help in your job, career and social life?How to be a Brilliant Thinker will help you to achieve all these ideals, by helping you to think in powerful new ways.'),
        (2,1,'How To Die','Sebuah Panduan Klasik Menjelang Ajal', '555', '9781684412297', 'PT Gramedia', 'Martapura', '2000-05-10', 'Seneca', 1, 10, 5, 100, 2, 'how-to-die.jpg', null, 'Timeless wisdom on death and dying from the celebrated Stoic philosopher Seneca"It takes an entire lifetime to learn how to die," wrote the Roman Stoic philosopher Seneca.'),
        (7,1,'I Want to Die but I Want to Eat Tteokpokki','', '555', '9781526650863', 'PT Gramedia', 'Martapura', '2000-05-10', 'Baek Se Hee', 1, 10, 5, 100, 2, 'i-want-to-die.jpg', null, 'I Want to Die but I Want to Eat Tteokpokki is a book originally written in Korean, about a woman diagnosed with dysthymia. Baek Se-hee wrote the dialogues during her sessions with a psychiatrist, and included her inner thoughts on how she wants to love herself better.'),
        (6,1,'Sebuah Seni Untuk Bersikap Bodo Amat','', '555', '9780062641540', 'PT Gramedia', 'Martapura', '2000-05-10', 'Mark Manson', 1, 10, 5, 100, 2, 'sebuah-seni.jpg', null, 'The Subtle Art of Not Giving a Fuck: A Counterintuitive Approach to Living a Good Life is the second book by blogger and author Mark Manson. In it Manson argues that life"s struggles give it meaning, and that the mindless positivity of typical self-help books is neither practical nor helpful.'),
        (6,1,'Madilog','Materialisme, Dialektika, dan Logika', '555', '9789791683319', 'PT Gramedia', 'Martapura', '2000-05-10', 'Tan Malaka', 1, 10, 5, 100, 2, 'tan-malaka.jpg', null, 'The Madilog by Iljas Hussein, first published in 1943, official first edition 1951, is the magnum opus of Tan Malaka, the Indonesian national hero and is the most influential work in the history of modern Indonesian philosophy. Madilog is an Indonesian acronym that stands for Materialisme Dialektika Logika.'),
        (6,1,'The Power of Habit','', '555', 'ISBN', 'PT Gramedia', 'Martapura', '2000-05-10', 'Charles Duhigg', 1, 10, 5, 100, 2, 'power-of-habbit.jpg', null, 'The Power of Habit: Why We Do What We Do in Life and Business is a book by Charles Duhigg, a New York Times reporter, published in February 2012 by Random House. It explores the science behind habit creation and reformation.'),
        (6,1,'Teori Kritis Sekolah Frankfurt','', '555', 'ISBN', 'PT Gramedia', 'Martapura', '2000-05-10', 'Sindhunata', 1, 10, 5, 100, 2, 'teori-kritis.jpg', null, 'Buku Teori Kritis Sekolah Frankfurt memperkenalkan pemikiran filsuf Max Horkheimer dan Theodor W. Adorno dalam dua pokok pemikiran. Pertama, konsep tentang teori kritis. Kedua, kritik terhadap usaha manusia rasional yang terlihat macet dan gagal.'),
        (6,1,'Soe Hok-Gie...Sekali Lagi','Buku Pesta dan Cinta di Alam Bangsanya', '555', 'ISBN', 'PT Gramedia', 'Martapura', '2000-05-10', 'Sindhunata', 1, 10, 5, 100, 2, 'soe-hok.jpg', null, 'Dari sisa ingatan dan catatan minim, mantan enam rekan (Freddy Lasut sudah almarhum) perjalanan Soe Hok-gie (27 tahun) dan Idhan Dhanvantari Lubis (20), berusaha menulis ulang kesaksian sebenarnya tragedi perjalanan pendakian ke Gunung Semeru, nun 40 tahun lalu.'),
        (6,1,'Mindset','Mengubah Pola Berpikir untuk Perubahan Besar dalam Hidup Anda', '555', 'ISBN', 'PT Gramedia', 'Martapura', '2000-05-10', 'Sindhunata', 1, 10, 5, 100, 2, 'mindset.jpg', null, 'After decades of research, world-renowned Stanford University psychologist Carol S. Dweck, Ph.D., discovered a simple but groundbreaking idea: the power of mindset. In this brilliant book, she shows how success in school, work, sports, the arts, and almost every area of human endeavor can be dramatically influenced by how we think about our talents and abilities.'),
        (6,1,'Life Will Never be The Same','Tidak Ada Kehidupan Tanpa Perubahan', '555', 'ISBN', 'PT Gramedia', 'Martapura', '2000-05-10', 'Sindhunata', 1, 10, 5, 100, 2, 'life-will.jpg', null, 'Life Will Never Be The Same yang ditulis David Setiawan mengajak kita untuk memahami bahwa tidak ada kehidupan tanpa perubahan. Orang-orang yang berhenti belajar akan menjadi pemilik masa lalu. Orang-orang yang masih terus belajar, akan menjadi pemilik masa depan. Perubahan menjanjikan kesempatan dan kekuatan baru. Tinggalkanlah kesenangan yang menghalangi pencapaian kecermelangan hidup yang didambakan. Dan berhati-hatilah karena beberapa kesenangan adalah cara gembira dan termudah menuju kegagalan.'),
        (6,1,'Filosofi Teras','', '555', 'ISBN', 'PT Gramedia', 'Martapura', '2000-05-10', 'Sindhunata', 1, 10, 5, 100, 2, 'filosofi-teras.jpg', null, 'Lebih dari 2.000 tahun lalu, sebuah mazhab filsafat menemukan akar masalah dan juga solusi dari banyak emosi negatif. Stoisisme, atau Filosofi Teras, adalah filsafat Yunani-Romawi kuno yang bisa membantu kita mengatasi emosi negatif dan menghasilkan mental yang tangguh dalam menghadapi naik-turunnya kehidupan.'),
        (6,1,'Master Your Time, Master Your Life','', '555', 'ISBN', 'PT Gramedia', 'Martapura', '2000-05-10', 'Sindhunata', 1, 10, 5, 100, 2, 'master.jpg', null, '“Time is money,” as the saying goes, but most of us never feel we have enough of either. In Master Your Time, Master Your Life, internationally acclaimed productivity expert and bestselling author Brian Tracy presents a brilliant new approach to time management that will help you gain control of your time and accomplish far more, faster and more easily than you ever thought possible.'),
        (1,1,'Tinjauan Kinerja','', '555', 'ISBN', 'PT Gramedia', 'Martapura', '2000-05-10', 'Sholih Nugroho Hadi, S.ST', 1, 10, 5, 100, 2, 'cover-bk56.jpg', "bk56_kalsel.pdf", 'Dewasa ini sudah dikembangkan system integrasi sapi dan kelapa sawit (SISKA). Berbagai kajian menunjukkan bahwa pelaksanaan SISKA mampu memberikan peningkatan produksi baik bagi perkebunan kelapa sawit maupun peningkatan produksi ternak sapi.'),
        (1,1,'Prosiding','', '555', '9789793112541', 'PT Gramedia', 'Martapura', '2000-05-10', 'Muhammad Yasin', 1, 10, 5, 100, 2, 'cover-bk57.jpg', "bk57_kalsel.pdf", 'Sejauh ini, belum ada evaluasi kinerja dari pola integrasi sawit-sapi. Tulisan ini bertujuan untuk melihat kinerja pengelolaan sapi potong pada program integrasi sapi potong sawit.'),
        (3,1,'Budidaya Tanaman Padi dan Hortikultura','', '555', '9789793112572', 'PT Gramedia', 'Martapura', '2000-05-10', 'Aidi Noor', 1, 10, 5, 100, 2, 'cover-bk58.jpg', "bk58_kalsel.pdf", 'lama dilaksanakan oleh petani peternak yang memiliki perkebunan kelapa sawit di Indonesia. Secara nasional perkembangan jumlah kelompok yang terlibat dalam program integrasi tanaman ternak terus mengalami pertumbuhan.'),
        (3,1,'Pengolahan Hasil Pertanian dan Limbahnya','', '555', '9789793112565', 'PT Gramedia', 'Martapura', '2000-05-10', 'Susi Lesmani', 1, 10, 5, 100, 2, 'cover-bk59.jpg', "bk59_kalsel.pdf", 'Kinerja program integrasi tanaman ternak menunjukkan keberhasilan yang bervariasi. Pakan ternak sapi potong yang berasal dari limbah sawit terutama dalam bentuk hasil fermentasi bungkil sawit dilengkapi dengan pelepah kelapa sawit merupakan sumber.'),
        (1,1,'Pengelolaan Tanaman Terpadu Kedelai','', '555', '9789793112282', 'PT Gramedia', 'Martapura', '2000-05-10', 'Susi', 1, 10, 5, 100, 2, 'cover-bk60.jpg', "bk60.pdf", 'serat pakan yang baik untuk menambah kenaikan bobot ternak sapi hidup. Solid atau lumpur sawit limbah dari industri kelapa sawit masih mengandung CPO sebesar 1,50%,'),
        (6,1,'Underground A Novel','', '555', '9786020319469', 'PT Gramedia', 'Martapura', '2000-05-10', 'Ika Natassa', 1, 10, 5, 100, 2, 'undergroud.jpg', null, 'Selamat datang di Underground, stasiun televisi musik terbesar di Amerika Serikat, tempat para entertainer muda dan VJ, icon kehidupan metropolis, menjalani hari-hari normal mereka, itu jika anda bisa bilang bahwa hidup 10 jam sehari dalam sorotan lampu studio, terbang bolak balik dengan Marquis Jet meliput AmsterJam dan Live 8, dan berpose untuk cover Rolling Stone biasa-biasa saja.');

    INSERT INTO 
        book_new_publish_table (
            book_id,
            book_new_publish_timestamp
        )
    VALUES 
        (19, CURRENT_TIMESTAMP()),
        (20, CURRENT_TIMESTAMP()),
        (21, CURRENT_TIMESTAMP()),
        (22, CURRENT_TIMESTAMP()),
        (23, CURRENT_TIMESTAMP());

    INSERT INTO 
        book_new_collection_table (
            book_id,
            book_new_collection_timestamp
        )
    VALUES
        (10, CURRENT_TIMESTAMP()),
        (11, CURRENT_TIMESTAMP()),
        (12, CURRENT_TIMESTAMP()),
        (13, CURRENT_TIMESTAMP()),
        (14, CURRENT_TIMESTAMP());