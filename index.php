<?php
session_start();
session_regenerate_id();

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
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/27bfde389a.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'c_header.php'; ?>

    <main>
        <!-- ヘッダー-->
        <header class="hero">
            <video class="hero_bg"
                autoplay muted loop playsinline preload="auto"
                poster="./res/img/placeholder.jpg">
                <source src="./res/mov/header.mp4" type="video/mp4">
            </video>

            <div class="hero_overlay"></div>

            <div class="hero_content">

                <a class="cta-btn" href="./items.php">
                    今すぐ購入
                </a>
                <a href="./story.php" style="color: white;font-size:small;margin-top:20px;">ROSETTA - 世界レベルの品質</a>
            </div>
        </header>
        <!-- ヘッダー-->
        <section id="senko" class="sect">
            <div class="title-ct">
                <img src="./res/img/logo.png" alt="" class="icon">
                <h3>NEW ARRIVAL</h3>
                <h2 style="font-size:x-small;">先行販売対象商品</h2>
            </div>
            <div class="items-ct">
                <div class="items">
                    <a href="./item.php" class="item-card">
                        <div class="item-ct">
                            <div class="item-img-ct">
                                <img src="./items/item1.jpg" alt="" class="item-img-1">
                            </div>
                            <div class="item-info">
                                <p class="item-comment">特別先行販売</p>
                                <h3 class="item-name-1">Classe-S 1.2mm snakechain SU316L</h3>
                                <p class="item-price-1 strike">¥219,000</p>
                                <p class="item-price-dis">¥25,800</p>
                                <p class="sp-label">24時間限定価格</p>
                            </div>
                            <div class="item-btns">
                                <button class="purchase-now">後払いで翌日発送</button>
                                <button class="add-cart">カートに追加</button>

                            </div>

                        </div>
                    </a>
                    <a href="./item.php" class="item-card">
                        <div class="item-ct">
                            <div class="item-img-ct">
                                <img src="./items/item1.jpg" alt="" class="item-img-1">
                            </div>
                            <div class="item-info">
                                <p class="item-comment">特別先行販売</p>
                                <h3 class="item-name-1">Classe-A 1.2mm snakechain SU316L</h3>
                                <p class="item-price-1 strike">¥185,000</p>
                                <p class="item-price-dis">¥19,800</p>
                                <p class="sp-label">24時間限定価格</p>
                            </div>
                            <div class="item-btns">
                                <button class="purchase-now">後払いで翌日発送</button>
                                <button class="add-cart">カートに追加</button>

                            </div>

                        </div>
                    </a>
                    <a href="./item.php" class="item-card">
                        <div class="item-ct">
                            <div class="item-img-ct">
                                <img src="./items/item1.jpg" alt="" class="item-img-1">
                            </div>
                            <div class="item-info">
                                <p class="item-comment">特別先行販売</p>
                                <h3 class="item-name-1">Classe-N 1.2mm snakechain SU316L</h3>
                                <p class="item-price-1 strike">¥103,000</p>
                                <p class="item-price-dis">¥15,800</p>
                                <p class="sp-label">24時間限定価格</p>
                            </div>
                            <div class="item-btns">
                                <button class="purchase-now">後払いで翌日発送</button>
                                <button class="add-cart">カートに追加</button>

                            </div>

                        </div>
                    </a>

                </div>
            </div>

        </section>
        <section id="story" class="sect">
            <div class="title-ct">
                <img src="./res/img/logo.png" alt="" class="icon">
                <h3>STORY</h3>
                <h2 style="font-size: x-small;">ブランドストーリー</h2>
            </div>

            <div style="position: relative;height:100vw;overflow: hidden;">
                <video class="story-video"
                    autoplay muted loop playsinline preload="auto"
                    poster="./res/img/placeholder.jpg">
                    <source src="./res/mov/story.mp4" type="video/mp4">
                </video>
                <div class="overlay">
                    <a href="./story.php">ブランドストーリーを詳しく学ぶ</a>
                </div>

            </div>
            <div class="desc-ct">
                <h4 style="text-align: center;padding: 20px;">ROSETTA-職人の魂が宿るスキンジュエリー</h4>
                <p class="desc">
                    ヴェネツィア発のブランドROSETTAからTOKYOを拠点としたニューライン発足。
                    ROSETTAのスキンジュエリーは、理論上10万年以上の耐久性を誇る最高品質のSU316L鋼を使用しています。
                    オーストラリア・ピルバラから取り寄せた鉱石を使用し、選び抜かれた日本の職人によって加工されています。
                    一生使えるスキンジュエリーは、世代を超えて受け継ぐことができます。
                    固い決意を込めたお守りとして、プレゼントにもオススメです。
                </p>

            </div>

        </section>
    </main>

</body>
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
</script>

</html>