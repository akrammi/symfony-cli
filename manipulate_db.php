<?php

require __DIR__ ."/pdo_db.php";

try {

    $pdo->beginTransaction();

    $query = "
        INSERT INTO customers (customer_id, first_name, last_name, company, city, country, phone1, phone2, email, subscription_date, website)
        VALUES (:customer_id, :first_name, :last_name, :company, :city, :country, :phone1, :phone2, :email, :subscription_date, :website)
    ";

    // prepare statement
    $stmt = $pdo->prepare($query);

    $stmt->bindValue(':customer_id', 'C0099');
    $stmt->bindValue(':first_name', 'akram');
    $stmt->bindValue(':last_name', 'idrissi');
    $stmt->bindValue(':company', 'Void');
    $stmt->bindValue(':city', 'casa');
    $stmt->bindValue(':country', 'MA');
    $stmt->bindValue(':phone1', '234-567-8901');
    $stmt->bindValue(':phone2', '321-654-9870');
    $stmt->bindValue(':email', 'akram@gmail.com');
    $stmt->bindValue(':subscription_date', date('Y-m-d H:i:s'));
    $stmt->bindValue(':website', 'http://void.fr');
    $stmt->execute();  

    $pdo->commit();

    echo "inserted successfully!";
} catch (\PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
?>


