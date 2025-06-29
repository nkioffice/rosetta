<?php

function getDiscountedItems($pdo)
{
    $stmt = $pdo->prepare('SELECT * FROM items WHERE discounted_price > 0');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getItemById($pdo, $id)
{
    $stmt = $pdo->prepare('SELECT * FROM items WHERE item_id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getItemsImages($pdo, $id)
{
    $stmt = $pdo->prepare('SELECT filename FROM item_images WHERE item_id = ? ORDER BY num ASC');
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getReviews($pdo, $limit, $offset = 0)
{
    $stmt = $pdo->prepare('SELECT * FROM item_reviews ORDER BY created_at DESC LIMIT :lim OFFSET :off');
    $stmt->bindParam(':lim', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':off', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function renderStars($star)
{
    if (is_int($star) && $star > 0 && $star <= 5) {
        
        for ($i = 0; $i < $star; $i++) {
            echo '<img src="./res/img/star-f.png" alt="" class="star">';
        }
        for ($i=0; $i < 5-$star; $i++) { 
            echo '<img src="./res/img/star-e.png" alt="" class="star">';
        }
    }
}
function getReviewImage($pdo,$id){
    $stmt =$pdo->prepare('SELECT * FROM review_images WHERE review_id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}