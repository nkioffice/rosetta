<header>
    <div class="notice">

        <p style="font-size: small;"><button id="close-notice" style="margin-right: 10px;">x</button>
            日本特別先行販売クーポン有効期限<span id="count-down"></span></p>
    </div>

    <div class="nav-header">
        <button class="nav-btn">≡</button>
        <div class="h-logo-ct">
            <a href="./index.php" class="logo-ct">
                <img src="./res/img/wlogo.png" alt="" class="h-logo-icon">
                <img src="./res/img/wlogo_y.png" alt="ROSETTA" class="h-logo">
            </a>
        </div>
        <nav>

            <a href="./cart.php">Cart</a>
            <a href="./items">Items</a>

        </nav>
    </div>


</header>


<nav class="nav-window" style="display: none;">
    <div class="nav-ct">
        <div class="nav-title">
            <h4 style="font-weight: 400;">メインメニュー</h4>
            <button>Close</button>
        </div>

        <ul>
            <li><a href="">セール</a></li>
            <hr>
            <li><a href="">ROSETTAについて知る</a></li>

            <li><a href="">全商品一覧</a></li>
            <li><a href="">ネックレス</a></li>
            <li><a href="">ブレスレット</a></li>
            <li><a href="">その他</a></li>
        </ul>
    </div>


</nav>
<div class="nav-overlay" style="display: none;"></div>

<script src="./handle_notice.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const countElm = document.getElementById('count-down');

        // PHPで残り秒数を埋め込む（例：86400 など）
        let remaining = <?php echo $remainingSeconds; ?>;

        function updateDisplay() {
            if (remaining <= 0) {
                countElm.textContent = "時間切れです";
                return;
            }

            const hours = Math.floor(remaining / 3600);
            const minutes = Math.floor((remaining % 3600) / 60);
            const seconds = remaining % 60;

            countElm.textContent = `${hours}時間 ${minutes}分 ${seconds}秒`;
            remaining--;
        }

        // 初回表示
        updateDisplay();

        // 1秒ごとに更新
        const timer = setInterval(function() {
            if (remaining <= 0) {
                clearInterval(timer);
            } else {
                updateDisplay();
            }
        }, 1000);
    });
</script>