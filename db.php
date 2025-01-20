<?php



try {
    $conn = new PDO("mysql:host=localhost;dbname=news;port=3306","root","");
    /*echo "Bazaga muvaffaqiyatli ulandi!";*/
}

catch (PDOException $e) {
    echo "Bazaga ulanishda xatolik: " . $e->getMessage();
}
