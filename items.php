<?php
session_start();
session_regenerate_id();

require_once './scripts/db_connect.php';
require_once './scripts/functions.php';

// 初回訪問時間の保存
if (!isset($_SESSION['firstVisit'])) {
    $_SESSION['firstVisit'] = (new DateTime())->format('Y-m-d H:i:s');  // 文字列として保存
}

// 現在時刻と初回訪問時刻の差を計算
$firstVisit = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['firstVisit']);
$now = new DateTime();

$interval = $now->diff($firstVisit);
$elapsedSeconds = $now->getTimestamp() - $firstVisit->getTimestamp();

$remainingSeconds = max(0, 24 * 60 * 60 - $elapsedSeconds);  // 24時間 = 86400秒

// 残り時間を「時:分:秒」で表示するためのフォーマット
$hours = floor($remainingSeconds / 3600);
$minutes = floor(($remainingSeconds % 3600) / 60);
$seconds = $remainingSeconds % 60;

//割引商品を取得する
$disItems = getDiscountedItems($pdo);

//全商品を取得する
$page = 1;
if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <base href="<?= $_SERVER['HTTP_HOST'] === 'localhost' ? '/rosetta/' : '/' ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $SITE_DESC ?>">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <title>ROSETTA TOKYO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Zen+Kaku+Gothic+New&family=Noto+Sans+JP&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/27bfde389a.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'c_header.php'; ?>

    <main>
       
        <section id="top-menu" class="top-menu">
            <a href="./items.php" class="link-img-ct">
                <img src="./res/img/item_img2.png" alt="" class="link-img">
                <div class="overlay">
                    <p>ALL ITEMS</p>
                    <p style="font-size: 1rem;">全商品</p>
                </div>
            </a>
            <a href="./#ingredients" class="link-img-ct scroll-to">
                <img src="./res/img/design.jpg" alt="" class="link-img">
                <div class="overlay">
                    <p>STORY OF ROSETTA</p>
                    <p style="font-size: 1rem;">ブランドストーリー</p>
                </div>
            </a>

            </a>
        </section>
       

        
        <div class="features">
            <div class="f-item">
                <div class="f-title-wp">
                    <img src="./res/img/guarantee.png" alt="" class="f-icon">
                    <h5 class="f-title">品質保証書付き</h5>
                </div>
                <div class="f-desc">
                    全品にROSETTAが発行する品質保証書が付属。<br>
                    贈り物としても、安心してお選びいただけます。
                </div>

            </div>
            <div class="f-item">
                <div class="f-title-wp">
                    <img src="./res/img/send.png" alt="" class="f-icon">
                    <h5 class="f-title">送料無料サービス</h5>
                </div>
                <div class="f-desc">
                    19000円以上のお買い上げで送料無料<br>
                    <span class="kome">※北海道・沖縄は別途送料がかかります</span>
                </div>

            </div>
            <div class="f-item">
                <div class="f-title-wp">
                    <img src="./res/img/card.png" alt="" class="f-icon">
                    <h5 class="f-title">豊富な決済サービス</h5>
                </div>
                <div class="f-desc">
                    セキュアなカード決済、後払い決済にも対応。<br>
                    欲しいものがいつでもすぐに手に入ります。
                </div>

            </div>
        </div>

    </main>

</body>
<script src="./header_margin.js"></script>
<script>
    adjustItemThumbnails();
    window.addEventListener('resize', function() {
        adjustItemThumbnails();
    })
    //商品サムネイルを正方形に
    function adjustItemThumbnails() {
        document.querySelectorAll('.item-img-1').forEach(img => {
            let w = img.getBoundingClientRect().width;
            img.style.height = w + 'px';
        })
    }

    setCarousel('.carousel-wrapper', '.carousel-item', '.carousel-indicators .indi', 'next', 'prev')
    setCarousel('.r-c-wrapper', '.r-c-item', '.r-indicators .indi', 'r-next', 'r-prev')

    document.querySelectorAll('.scroll-to').forEach(elem => {
        elem.addEventListener('click', function(e) {
            e.preventDefault();
            let id = elem.hash.slice(1)
            let target = document.getElementById(id);
            target.scrollIntoView({
                block: "center",
                behavior: "smooth"
            })
        })
    })


    function setCarousel(wrapperClass, itemClass, indiClass, nextId, prevId) {
        //カルーセル
        const carouselWrapper = document.querySelector(wrapperClass);
        let carouselPosition = 0; //初期値は0
        const maxCarouselPosition = document.querySelectorAll(itemClass).length - 1;

        document.getElementById(nextId).addEventListener('click', function() {
            moveCarousel(carouselPosition + 1);
        })
        document.getElementById(prevId).addEventListener('click', function() {
            moveCarousel(carouselPosition - 1);
        })

        carouselWrapper.addEventListener('mousedown', function(e) {
            console.log(e);

        })

        function moveCarousel(newPos) {
            if (newPos < 0) {
                carouselPosition = maxCarouselPosition;
            } else if (newPos > maxCarouselPosition) {
                carouselPosition = 0
            } else {
                carouselPosition = newPos;
            }
            let percent = carouselPosition * 100;
            carouselWrapper.style.transition = "transform 0.7s ease"
            carouselWrapper.style.transform = `translateX(-${percent}%)`

            setActiveIndicator(carouselPosition)

        }
        const indicators = document.querySelectorAll(indiClass);

        const setActiveIndicator = (x) => {
            indicators.forEach((el, idx) => {
                el.classList.toggle('active', idx === x);
            });
        };
        indicators.forEach((indi, index) => {
            indi.addEventListener('click', function() {

                moveCarousel(index)

            })
        })
        let isSwiping = false;

        function startSwipe(event) {
            isTouch = true;
            startX = event.touches[0].clientX;
            moveX = 0;
            isSwiping = true;
            carouselWrapper.style.transition = "none"; // アニメーションを無効化（スワイプ中の動きがスムーズに）
        }

        function moveSwipe(event) {
            if (!isSwiping) return;
            moveX = event.touches[0].clientX - startX;
            const translateX = -carouselPosition * 100 + (moveX / window.innerWidth) * 100; // スワイプの移動に合わせる
            carouselWrapper.style.transform = `translateX(${translateX}%)`;
        }

        function endSwipe() {
            if (!isSwiping) return;
            isSwiping = false;


            // スワイプ距離が一定以上ならスライド移動
            if (moveX > 50) { // 右スワイプ（前の画像）
                moveCarousel(carouselPosition - 1)
            } else if (moveX < -50) { // 左スワイプ（次の画像）
                moveCarousel(carouselPosition + 1)
            } else {
                moveCarousel(carouselPosition)
            }


        }
        // タッチ操作イベント
        carouselWrapper.addEventListener("touchstart", startSwipe);
        carouselWrapper.addEventListener("touchmove", moveSwipe);
        carouselWrapper.addEventListener("touchend", endSwipe);
    }
 
</script>

</html>