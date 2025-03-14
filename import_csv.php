<?php


require __DIR__.'/vendor/autoload.php';  
require __DIR__ ."/pdo_db.php";

use League\Csv\Reader;


$filePath = 'customers.csv';

try {
    if (!file_exists($filePath)) {
        throw new Exception("File not found: $filePath");
    }

    $startTime = microtime(true);

    $pdo->beginTransaction();

    $sql = "
        INSERT INTO customers (customer_id, first_name, last_name, company, city, country, phone1, phone2, email, subscription_date, website)
        VALUES (:customer_id, :first_name, :last_name, :company, :city, :country, :phone1, :phone2, :email, :subscription_date, :website)
    ";

    $stmt = $pdo->prepare($sql);

    $csv = Reader::createFromPath($filePath, 'r');
    $csv->setHeaderOffset(0);  

    # get all lines
    $records = $csv->getRecords();  

    foreach ($records as $record) {
        $stmt->bindValue(':customer_id', $record['Customer Id']);
        $stmt->bindValue(':first_name', $record['First Name']);
        $stmt->bindValue(':last_name', $record['Last Name']);
        $stmt->bindValue(':company', $record['Company']);
        $stmt->bindValue(':city', $record['City']);
        $stmt->bindValue(':country', $record['Country']);
        $stmt->bindValue(':phone1', trim( $record['Phone 1']));
        $stmt->bindValue(':phone2', $record['Phone 2']);
        $stmt->bindValue(':email', $record['Email']);
        $stmt->bindValue(':subscription_date', $record['Subscription Date']);
        $stmt->bindValue(':website', $record['Website']);
        
        $stmt->execute();
    }

    $pdo->commit();
    $endTime = microtime(true);

    $executionTime = $endTime - $startTime;

    echo "CSV data inserted successfully!\n";
    echo "Time taken to insert rows: " . number_format($executionTime, 4) . " seconds\n";

} catch (\PDOException $e) {
    $pdo->rollBack();
    echo "Database error: " . $e->getMessage();
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

