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

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $item = getItemById($pdo, $_GET['id']);
    if (!$item) {
        http_response_code(404);
        exit;
    }
    $images = getItemsImages($pdo, $_GET['id']);
} else {
    http_response_code(404);
    exit;
}

//最新レビューを取得する
$reviews = getReviews($pdo, 20);
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
    <link rel="stylesheet" href="./css/item.css">
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
        <section id="item" class="sect">
            <div class="img-carousel">
                <button id="img-prev">＜</button>
                <button id="img-next">＞</button>
                <div class="img-carousel-wrapper">
                    <?php foreach ($images as $image): ?>
                        <div class="img-carousel-item">
                            <img src="./items/<?= $image['filename'] ?>" alt="" class="item-hero">
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="img-indicators" style="display: none;">
                <div class="indi active">
                    <img src="./items/item1.jpg" alt="" class="item-thumbnail">
                    <div class="overlay"></div>
                </div>
                <div class="indi">
                    <img src="./items/item2.jpg" alt="" class="item-thumbnail">
                    <div class="overlay"></div>
                </div>
                <div class="indi">
                    <img src="./items/item3.jpg" alt="" class="item-thumbnail">
                    <div class="overlay"></div>
                </div>
            </div>
            <div class="item-header">
                <h1 class="item-name-2"><?= $item['name'] ?></h1>
                <div class="item-review">
                    <div class="stars">
                        <img src="./res/img/star-f.png" alt="">
                        <img src="./res/img/star-f.png" alt="">
                        <img src="./res/img/star-f.png" alt="">
                        <img src="./res/img/star-f.png" alt="">
                        <img src="./res/img/star-f.png" alt="">

                    </div>
                    <div class="item-r-count">(5.0) 188reviews</div>
                </div>

            </div>
            <div class="price-ct">
                <div class="price">
                    <p class="item-price-2
                <?php if ($item['discounted_price']): ?>
                    strike
                <?php endif; ?>
                ">¥<?= number_format($item['price']) ?></p>
                </div>
                <?php if ($item['discounted_price']): ?>
                    <div class="discount-ct">
                        <p class="item-price-dis2" style="font-weight: bold;">¥<?= number_format($item['discounted_price']) ?></p>
                        <p class="item-price-dis2" style="font-size: small;">日本特別先行販売クーポン適用
                            <i class="fa-solid fa-arrow-trend-down"></i> －¥<?= number_format(abs($item['discounted_price'] - $item['price'])) ?>
                        </p>
                        <div class="less-stock">
                            <i class="fa-solid fa-clock" style="margin-right: 5px;"></i>在庫残りわずか
                        </div>
                    </div>



                <?php endif; ?>
            </div>
            <div class="description-ct">
                <p class="desc">
                    <?= $item['description'] ?>
                </p>
            </div>
            <div class="purchase-btn-ct">
                <button class="purchase-now2">後払いで今すぐ注文</button>
                <button class="add-cart2"><i class="fa-solid fa-plus"></i>カートに追加する</button>
            </div>


        </section>
        <div class="title-ct">
            <img src="./res/img/logo.png" alt="" class="icon">
            <h3>REVIEWS</h3>
            <h2 style="font-size:x-small;">お客様の声</h2>
        </div>
        <section class="sect" id="reviews">
            <div class="p-review">
                <h4>総評価</h4>
                <div class="review-summary">
                    <div class="stars">
                        <img src="./res/img/star-f.png" alt="" class="star">
                        <img src="./res/img/star-f.png" alt="" class="star">
                        <img src="./res/img/star-f.png" alt="" class="star">
                        <img src="./res/img/star-f.png" alt="" class="star">
                        <img src="./res/img/star-h.png" alt="" class="star">

                    </div>
                    <div>
                        (4.8)
                    </div>
                    <div>
                        118件のレビュー
                    </div>
                </div>

            </div>
            <div class="carousel">
                <button id="r-prev">＜</button>
                <button id="r-next">＞</button>
                <div class="r-c-wrapper">
                    <?php foreach ($reviews as $review):
                         $img = getReviewImage($pdo,$review['review_id']) ?>

                        <div class="r-c-item">
                            <div class="r-card">
                                <div class="stars">
                                    <?= renderStars(intval($review['stars'])) ?>
                                </div>
                                <h5 class="review-title">
                                    <?= $review['title'] ?>
                                    <p class="review-user">✔購入済みのユーザー</p>
                                </h5>
                                <a href="./item.php?id=<?= $review['item_id'] ?>" class="review-item">
                                    <?= getItemById($pdo, $review['item_id'])['name'] ?>
                                </a>
                                <p class="review-desc">
                                    <?= $review['text'] ?>
                                </p>
                                <?php if($img):?>
                                <div>
                                    <img src="./review/<?=$img['filename'] ?>" alt="" class="r-img">
                                </div>
                                <?php endif;?>
                                <p class="review-date">
                                    <?php
                                    $reviewDate = new DateTime($review['created_at']);
                                    echo $reviewDate->format('Y-m-d'); ?>
                                </p>
                            </div>

                        </div>
                    <?php endforeach; ?>


                </div>
            </div>

            <div class="r-indicators" style="display: none;">
                <div class="indi active"></div>
                <div class="indi"></div>


            </div>
        </section>

        <section class="item-features">
            <hr>
            <div class="model-ct">
                <div class="model-header-wp">
                    <h1 class="model-header">コンセプト - A Lifetime Chain</h1>
                    <h2 class="model-sub-header">着用者の魂が宿るチェーンが世代を繋ぐ</h2>
                </div>
                <div class="model-img-ct">
                    <img src="./res/model/sea_male_white2.png" alt="" class="model-img">

                </div>
                <div class="model-caption">
                    ROSETTAのスキンチェーンは、10万年の耐久性<span class="kome">(※)</span>を誇るSUS316L鋼を使用。<br><br>

                    ニュージーランドの先住民族マオリに伝わるネックレスHei Tikiには、肌身離さず付けていることで着用者の魂が宿ると言われています。ROSETTAの
                    スキンチェーンはこのHei Tikiに着想を得ました。<br><br>
                    フォーマル・カジュアル・ビジネスなどのシーンを問わず常に身に付けられるROSETTAのスキンジュエリーは、
                    親から子へ、夫から妻へ受け継ぐことで、魂の連鎖を繋ぐ、唯一無二の特別なスキンチェーンへと成長します。<br><br>

                    <span class="kome">※耐久性は理論値です。適切なお手入れが必要です。</span>

                </div>

                <a href="items.php" class="model-all-item">
                    全商品を見る
                </a>
            </div>

            <div class="hanten">
                <div class="model-header-wp">
                    <h1 class="model-header">耐水性 - Water Proof</h1>
                    <h2 class="model-sub-header">海水・汗にも耐え、身体の一部に</h2>
                </div>
                <div class="model-img-ct">
                    <img src="./res/model/sea_male_white4.png" alt="" class="model-img">

                </div>
                <div class="model-caption">
                    水はもちろん、海水や汗、サウナなどの高温にも対応。<br><br>
                    マリンスポーツ、アウトドア、フィットネス、サウナ、温泉などあらゆる場面で気にする必要はありません。
                    「スキンチェーン」は付けていることを忘れてしまうような着け心地で、
                    文字通り「第二の肌」、身体の一部としてご着用いただけます。<br><br>

                </div>
                <a href="items.php" class="model-all-item">
                    全商品を見る
                </a>
            </div>
            <div class="model-ct">
                <div class="model-header-wp">
                    <h1 class="model-header">東京 - NEW TOKYO</h1>
                    <h2 class="model-sub-header">TOKYOを拠点とした最新ライン</h2>
                </div>
                <div class="model-img-ct">
                    <img src="./res/model/bar_male1.png" alt="" class="model-img">

                </div>
                <div class="model-caption">
                    Venezia発のROSETTAから日本限定ブランドTOKYOライン発足。賑わっているのにどこか寂しさも感じさせる、
                    独特な雰囲気を持つ東京を拠点とするブランドが遂に実現。原料から地元の加工職人まで、
                    ROSETTAの持つ技術を詰め込んだ結晶です。
                </div>
            </div>


        </section>


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
        <div class="title-ct">
            <img src="./res/img/logo.png" alt="" class="icon">
            <h3>Story</h3>
            <h2 style="font-size: x-small;">最高品質のブランド</h2>
        </div>
        <div class="carousel">
            <button id="prev">＜
            </button>
            <button id="next">
                ＞
            </button>
            <div class="carousel-wrapper">
                <section id="ingredients" class="sect carousel-item">

                    <div class="sub-hero">
                        <img src="./res/img/ingredients.jpg" alt="">
                        <div class="overlay">
                            <h3>INGREDIENTS</h3>
                        </div>
                    </div>


                    <div class="desc-ct">
                        <h4 style="text-align: center;padding: 20px;">オーストラリア・ピルバラ鉱山</h4>
                        <p class="desc">
                            ヴェネツィア発のブランドROSETTAからTOKYOを拠点としたニューライン発足。
                            ROSETTAのスキンジュエリーは、理論上10万年以上の耐久性を誇る最高品質のSUS316L鋼を使用しています。
                            オーストラリア・ピルバラから取り寄せた鉱石を使用し、選び抜かれた職人によって加工されています。
                            一生使えるスキンジュエリーは、世代を超えて受け継ぐことができます。
                            固い決意を込めたお守りとして、プレゼントにもオススメです。
                        </p>

                        <a href="" class="link1">詳細を見る</a>

                    </div>

                </section>
                <section id="shop" class="sect carousel-item">

                    <div class="sub-hero">
                        <img src="./res/img/shop.jpg" alt="">
                        <div class="overlay">
                            <h3>SHOP</h3>
                        </div>
                    </div>


                    <div class="desc-ct">
                        <h4 style="text-align: center;padding: 20px;">直営店</h4>
                        <p class="desc">
                            「ROSETTA TOKYO」の直営店情報<br>
                            <span class="kome">※1正規販売店は本公式サイトまたはROSETTA直営店のみ。
                                類似品にご注意ください。
                                ※2特別先行販売クーポンは、先行販売期間中及び本サイトのみ有効です。</span>
                        </p>

                        <a href="" class="link1">詳細を見る</a>

                    </div>

                </section>

                <section id="design" class="sect carousel-item">

                    <div class="sub-hero">
                        <img src="./res/img/design.jpg" alt="">
                        <div class="overlay">
                            <h3>DESIGN</h3>
                        </div>
                    </div>


                    <div class="desc-ct">
                        <h4 style="text-align: center;padding: 20px;">デザイナーFrancesco Gallo氏</h4>
                        <p class="desc">
                            ヴェネツィア発のブランドROSETTAからTOKYOを拠点としたニューライン発足にあたり、
                            Francesco Gallo氏をチーフデザイナーとして起用。<br>
                            シンプルながらも緻密に計算された幾何学的デザインは、ROSETTAらしい洗練された優美さを実現しました。

                        </p>

                        <a href="" class="link1">詳細を見る</a>

                    </div>

                </section>


            </div>


        </div>
        <div class="carousel-indicators">
            <div class="indi active"></div>
            <div class="indi"></div>
            <div class="indi"></div>

        </div>


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
    adjustItemHero();
    adjustItemThumbnail();
    window.addEventListener('resize', function() {
        adjustItemHero();
        adjustItemThumbnail();
    })
    //商品サムネイルを正方形に
    function adjustItemHero() {
        document.querySelectorAll('.item-hero').forEach(img => {
            let w = img.getBoundingClientRect().width;
            img.style.height = w + 'px';
        })
    }

    function adjustItemThumbnail() {
        document.querySelectorAll('.img-indicators .indi').forEach(img => {
            img.style.height = img.getBoundingClientRect().width + 'px'
            console.log(img.style.height);

        })
    }

    setCarousel('.carousel-wrapper', '.carousel-item', '.carousel-indicators .indi', 'next', 'prev')
    setCarousel('.r-c-wrapper', '.r-c-item', '.r-indicators .indi', 'r-next', 'r-prev')
    setCarousel('.img-carousel-wrapper', '.img-carousel-item', '.img-indicators .indi', 'img-next', 'img-prev')

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
        //インジケータークリックでジャンプ
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