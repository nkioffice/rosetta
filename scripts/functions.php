<?php

function getDiscountedItems($pdo){
    $stmt = $pdo->prepare('SELECT * FROM items WHERE discounted_price > 0');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getItemById($pdo,$id){
    $stmt = $pdo->prepare('SELECT * FROM items WHERE item_id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getItemsImages($pdo,$id){
    $stmt = $pdo->prepare('SELECT filename FROM item_images WHERE item_id = ? ORDER BY num ASC');
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}