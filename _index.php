<?php

require_once 'vendor/autoload.php';


use Doctrine\DBAL\DriverManager;


//..
$connectionParams = [
    'dbname' => 'blog',
    'user' => 'root',
    'password' => '',
    'host' => 'MariaDB-11.2',
    'driver' => 'pdo_mysql',
];
$conn = DriverManager::getConnection($connectionParams);

// $sql = "select id from topic";
// // $topics = $conn->executeQuery($sql)->fetchAllAssociative();
// // var_dump(array_values($topics)); 
// $topics = [1, 2, 3];
// // echo "<pre>";
// $i = 1;
// for ($i = 1; $i < 11; $i++) {
//     $conn->insert("artical", [
//         "name" => "text - $i",
//         "content" => "content text - $i",
//         "id_status" => 1
//     ]);

//     // var_dump(array_rand($topics), $conn->lastInsertId());
//     $conn->insert("topic_artical", [
//         "id_topic" => $topics[array_rand($topics)],
//         "id_artical" => $conn->lastInsertId(),        
//     ]);
// }
// die;

// $sql = "select * from artical t1 
// inner join topic_atical t2 on t2.id_artical = t1.id 

// where 

// ";

// echo "<pre>";
// $sql = "SELECT * FROM user INNER JOIN account ON account.id = user.id_account";
// $stmt = $conn->executeQuery($sql);
// print_r($stmt->fetchAllAssociative());

/*
var_dump($conn->delete('user'));
var_dump($conn->delete('account'));

for ($i = 1; $i < 11; $i++) {
    $conn->insert('account', [
        "login" => "user-$i",
        "password" => "123",
        "created_at" => "2025-06-20 20:20:00",
    ]);
    
    $conn->insert('user', [
        "id_account" => $conn->lastInsertId(),
        "name" => "user-name-$i",
        "surname" => "user-surname-$i",
        "bddate" => "2000-01-01",
        "bio" => "sg klsdj lakdjs fljds flkjas dflkjas df",
    ]);
}
*/
$sql = "SELECT * FROM user INNER JOIN account ON account.id = user.id_account";
$stmt = $conn->executeQuery($sql);

$keyOnly = ["name", "surname", "bddate", "sex", "bio"];
?>


<?php foreach ($stmt->fetchAllAssociative() as $val): ?>
    <div style="border: 1px solid navy; margin-bottom: 10px; padding: 5px 15px;">
        <div><?= $val["login"] ?> ( <?= $val["created_at"] ?>)</div>
            <ul>
                <?php foreach (array_keys($val) as $key): ?>
                    <?php if (in_array($key, $keyOnly)): ?>
                        <li><?= $key . ": " . (!empty($val[$key]) ? $val[$key] : "Не установлено")?></li> 
                    <?php endif ?>
                <?php endforeach ?>            
            </ul>
    </div>
<?php endforeach ?>


