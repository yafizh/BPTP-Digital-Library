CREATE TABLE books (
	book_id INT NOT NULL AUTO_INCREMENT,
	book_name VARCHAR(255) NOT NULL,
	img_location VARCHAR(100) NOT NULL,
	available TINYINT NOT NULL,
	PRIMARY KEY (book_id)
);

INSERT INTO books(book_name, img_location, available) VALUES
("Homo Deus","book-1.jpg", 1),
("Sapiens","book-2.jpg", 1),
("How to be a Brilliant Thinker","book-3.jpg", 1),
("Sebuah Seni Untuk Bersikap Bodo Amat","book-4.jpg", 1),
("Evolusi: Dari Teori ke Fakta","book-5.jpg", 1),
("Madilog: Tan Malaka","book-6.jpg", 1),
("A Whole New Mind","book-7.jpg", 1),
("I Want to Die But I Want to Eat Tteokpokki","book-8.jpg", 1),
("How To Die: Sebuah Panduan Klasis Menjelang Ajal","book-9.jpg", 1),
("Dunia Sophie","book-10.jpg", 0),
("Buku Panduan Matematika Terapan","book-11.jpg", 0),
("Underground","book-12.jpg", 0);