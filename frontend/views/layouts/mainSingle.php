<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\models\Product;
use yii\bootstrap\ActiveForm;

$session = Yii::$app->session;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->head() ?>
        <link rel="shortcut icon" href="images/favicon.ico">
    </head>
    <body>
        <?php $this->beginBody() ?>


        <div class="wrapper">
            <!-- ============================================================= TOP NAVIGATION ============================================================= -->
            <nav class="top-bar animate-dropdown">
                <div class="container">
                    <div class="col-xs-12 col-sm-6 no-margin">
                        <ul>
                            <li><a href="<?= Yii::$app->homeUrl ?>">Home</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('cara-belanja-dan-pembayaran') ?>">Cara Berbelanja</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('syarat-dan-ketentuan') ?>">Syarat & Ketentuan</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('tentang-kami') ?>">Tentang Kami</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('kontak-kami') ?>">Contact</a></li>
                        </ul>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-sm-6 no-margin">
                        <ul class="right">
                            <?php
                            if (!\Yii::$app->user->isGuest) {
                                ?>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('status-order') ?>">Status Order</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('edit-profile/' . Yii::$app->user->identity->id) ?>">Edit Profile</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('logout') ?>">Logout</a></li>
                            <?php } else { ?>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('login') ?>">Login</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('login') ?>">Register</a></li>

                            <?php } ?>
                        </ul>
                    </div><!-- /.col -->
                </div><!-- /.container -->
            </nav><!-- /.top-bar -->
            <!-- ============================================================= TOP NAVIGATION : END ============================================================= -->		<!-- ============================================================= HEADER ============================================================= -->
            <header style="border:none">
                <div class="container no-padding">

                    <div class="col-xs-12 col-sm-12 col-md-4 logo-holder">
                        <!-- ============================================================= LOGO ============================================================= -->
                        <div class="logo">
                            <a href="<?= Yii::$app->homeUrl ?>">
                                <img alt="logo" src="<?= Yii::$app->homeUrl ?>images/logo.png"/>
                            </a>
                        </div><!-- /.logo -->
                        <!-- ============================================================= LOGO : END ============================================================= -->		</div><!-- /.logo-holder -->

                    <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder no-margin">
                        <div class="contact-row">
                            <div class="phone inline">
                                <i class="fa fa-phone"></i> (0341) 355 333
                            </div>
                            <div class="contact inline">
                                <i class="fa fa-envelope"></i> info@<span class="le-color">indomobilecell.com</span>
                            </div>
                        </div><!-- /.contact-row -->
                        <!-- ============================================================= SEARCH AREA ============================================================= -->
                        <div class="search-area">
                            <form method="get" action="<?= Yii::$app->urlManager->createUrl('pencarian') ?>">
                                <div class="control-group">
                                    <input class="search-field" name="name" placeholder="Cari produk yang anda inginkan" required/>

                                    <ul class="categories-filter animate-dropdown">
                                        <li class="dropdown">

                                            <a class="dropdown-toggle"  data-toggle="dropdown" href="#">all categories</a>

                                            <ul class="dropdown-menu" role="menu" >
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= Yii::$app->urlManager->createUrl('cat/accesories') ?>">Accesories</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= Yii::$app->urlManager->createUrl('cat/smartphone') ?>">Smartphone</a></li>
                                                <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="category-grid.html">Laptop</a></li>-->
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= Yii::$app->urlManager->createUrl('cat/tablet') ?>">Tablet</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= Yii::$app->urlManager->createUrl('cat/handphone') ?>">Handphone</a></li>

                                            </ul>
                                        </li>
                                    </ul>

                                    <button class="search-button" type="submit" ></button>    

                                </div>
                            </form>
                        </div><!-- /.search-area -->
                        <!-- ============================================================= SEARCH AREA : END ============================================================= -->		</div><!-- /.top-search-holder -->

                    <div class="col-xs-12 col-sm-12 col-md-2 top-cart-row no-margin">
                        <div class="top-cart-row-container">
                            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
                            <div class="top-cart-holder dropdown animate-dropdown">

                                <div class="basket">
                                    <?php
                                    if (isset($session['cart'])) {
                                        $harga = 0;
                                        $count = 0;
                                        foreach ($session['cart'] as $key => $value) {

                                            $count += $value;
                                            $product = Product::findOne($key);
                                            $harga += ($product->price_sell * $value);
                                        }
                                    }
                                    ?>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <div class="basket-item-count">
                                            <span class="count"><?php echo (!empty($count)) ? $count : '0'; ?></span>
                                            <img src="<?= Yii::$app->homeUrl ?>images/icon-cart.png" alt="" />
                                        </div>

                                        <div class="total-price-basket"> 
                                            <span class="lbl">keranjang anda:</span>
                                            <span class="total-price">
                                                <span class="value"><?php echo (!empty($harga) ? Yii::$app->landa->rp($harga) : 'Rp. 0') ?></span>
                                            </span>
                                        </div>
                                    </a>

                                    <ul class="dropdown-menu cart-list">
                                        <?php
                                        if (isset($session['cart'])) {
                                            foreach ($session['cart'] as $key => $value) {
                                                $list = Product::findOne($key);
//                                                foreach ($product as $a) {


                                                echo '<li>
                                            <div class="basket-item">
                                                <div class="row">
                                                    <div class="col-xs-4 col-sm-4 no-margin text-center">
                                                        <div class="thumb">
                                                            <img alt="" src="' . $list->imgSmall . '" style="width: 60px;" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-8 col-sm-8 no-margin">
                                                        <div class="title">' . $list->name . '</div>
                                                        <div class="price">' . $list->price_sell_rp . '</div>
                                                        <div class="price">Kuantitas : ' . $value . '</div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </li>';
                                            }
//                                            }
                                        }
                                        ?>


                                        <li class="checkout">
                                            <div class="basket-item">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6">
                                                        <a href="<?= Yii::$app->urlManager->createUrl('cart') ?>" class="le-button inverse">View cart</a>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <a href="<?= Yii::$app->urlManager->createUrl('destination') ?>" class="le-button">Checkout</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div><!-- /.basket -->
                            </div><!-- /.top-cart-holder -->
                        </div><!-- /.top-cart-row-container -->
                        <!-- ============================================================= SHOPPING CART DROPDOWN : END ============================================================= -->		</div><!-- /.top-cart-row -->

                </div><!-- /.container -->
                <nav id="top-megamenu-nav" class="megamenu-vertical animate-dropdown">
                    <div class="container">
                        <div class="yamm navbar">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mc-horizontal-menu-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div><!-- /.navbar-header -->
                            <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Accesories</a>
                                        <ul class="dropdown-menu">
                                            <li><div class="yamm-content">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-4">
                                                            <!--<h2>Laptops &amp; Notebooks</h2>-->
                                                            <ul >
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/81/accesories/handsfree') ?>">Handsfree</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/77/accesories/power-bank') ?>">Power Bank</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/75/accesories/bluetooth') ?>">Bluetooth</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/73/accesories/memory') ?>">Memory</a></li>



                                                            </ul>
                                                        </div><!-- /.col -->

                                                        <div class="col-xs-12 col-sm-4">
                                                            <!--<h2>Computers &amp; Laptops</h2>-->
                                                            <ul >
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/66/accesories/casing') ?>">Casing</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/62/accesories/charger') ?>">Charger</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/1/accesories/screen-protector') ?>">Screen Protector</a></li>



                                                            </ul>
                                                        </div><!-- /.col -->
                                                        <div class="col-xs-12 col-sm-4">
                                                            <!--<h2>Computers &amp; Laptops</h2>-->
                                                            <ul >
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/70/accesories/soft-jacket') ?>">Soft Jacket</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/60/accesories/battery') ?>">Battery</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/68/accesories/leather-case') ?>">Letter Case</a></li>
                                                            </ul>
                                                        </div><!-- /.col -->


                                                    </div><!-- /.row -->
                                                </div><!-- /.yamm-content --></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Smartphone</a>
                                        <ul class="dropdown-menu">
                                            <li><div class="yamm-content">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-4">

                                                            <ul>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/37/smartphone/iphone') ?>">Iphone</a></li>

                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/47/smartphone/sony') ?>">Sony</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/46/smartphone/samsung') ?>">Samsung</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/45/smartphone/nokia') ?>">Nokia</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/41/smartphone/motorola') ?>">Motorola</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/39/smartphone/lg') ?>">LG</a></li>
                                                            </ul>
                                                        </div><!-- /.col -->

                                                        <div class="col-xs-12 col-sm-4">

                                                            <ul>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/25/smartphone/asus') ?>">Asus</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/22/smartphone/acer') ?>">Acer</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/23/smartphone/advan') ?>">Advan</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/133/smartphone/smartfren') ?>">Smartfren</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/138/smartphone/evercoss') ?>">Evercoss</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/146/smartphone/oppo') ?>">Oppo</a></li>

                                                            </ul>
                                                        </div><!-- /.col -->
                                                        <div class="col-xs-12 col-sm-4">

                                                            <ul>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/38/smartphone/lenovo') ?>">Lenovo</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/34/smartphone/huawei') ?>">Huawei</a></li>

                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/26/smartphone/blackberry') ?>">Blackberry</a></li>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl('category/153/smartphone/blaupunkt') ?>">Blaupunkt</a></li>
                                                            </ul>
                                                        </div><!-- /.col -->


                                                    </div><!-- /.row -->
                                                </div><!-- /.yamm-content --></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Tablet</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/123/tablet/advan') ?>">Advan</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/125/tablet/lenovo') ?>">Lenovo</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/127/tablet/asus') ?>">Asus</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/128/tablet/ipad') ?>">Ipad</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/129/tablet/samsung') ?>">Samsung</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/142/tablet/hp') ?>">HP</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/145/tablet/acer') ?>">Acer</a></li>

                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Handphone</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/112/handphone/nokia') ?>">Nokia</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/117/handphone/samsung') ?>">Samsung</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/143/handphone/advan') ?>">Advan</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/144/handphone/lg') ?>">LG</a></li>

                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav hidden-xs" style="float: right;">
                                    <li class="" style="border-left: 1px #258cd1 solid;">
                                        <a href="http://www.facebook.com/indomobilecellmalang" target="_blank" class="fa fa-facebook"></a>

                                    </li>
                                    <li class="">
                                        <a href="http://www.facebook.com/indomobilecellmalang" target="_blank" class="fa fa-twitter"></a>

                                    </li>  
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.navbar -->
                    </div><!-- /.container -->
                </nav>
            </header>
            <?= $content ?>
            <footer id="footer" class="color-bg">

                <div class="container">
                    <div class="row no-margin widgets-row">
                        <div class="col-xs-12  col-sm-4 no-margin-left">
                            <!-- ============================================================= FEATURED PRODUCTS ============================================================= -->
                            <div class="widget">
                                <h2>Featured products</h2>
                                <div class="body">
                                    <ul>
                                        <?php
                                        $featured = Product::find()->with(['brand', 'productPhoto', 'productCategory'])->limit(3)->orderBy('RAND()')->all();
                                        $sale = Product::find()->with(['brand', 'productPhoto', 'productCategory'])->limit(3)->orderBy('RAND()')->all();
                                        $rated = Product::find()->with(['brand', 'productPhoto', 'productCategory'])->limit(3)->orderBy('RAND()')->all();
                                        foreach ($featured as $a) {
                                            echo'<li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="' . $a->url . '">' . $a->name . '</a>
                                                    <div class="price">
                                                        
                                                        <div class="price-current">' . $a->price_sell_rp . '</div>
                                                    </div>
                                                </div>  

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="' . Yii::$app->homeUrl . 'images/blank.gif" data-echo="' . $a->imgSmall . '" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>';
                                        }
                                        ?>

                                    </ul>
                                </div><!-- /.body -->
                            </div> <!-- /.widget -->
                            <!-- ============================================================= FEATURED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

                        <div class="col-xs-12 col-sm-4 ">
                            <!-- ============================================================= ON SALE PRODUCTS ============================================================= -->
                            <div class="widget">
                                <h2>On-Sale Products</h2>
                                <div class="body">
                                    <ul>
                                        <?php
                                        foreach ($sale as $a) {
                                            echo'<li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="' . $a->url . '">' . $a->name . '</a>
                                                    <div class="price">
                                                        
                                                        <div class="price-current">' . $a->price_sell_rp . '</div>
                                                    </div>
                                                </div>  

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="' . Yii::$app->homeUrl . 'images/blank.gif" data-echo="' . $a->imgSmall . '" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>';
                                        }
                                        ?>

                                    </ul>
                                </div><!-- /.body -->
                            </div> <!-- /.widget -->
                            <!-- ============================================================= ON SALE PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

                        <div class="col-xs-12 col-sm-4 ">
                            <!-- ============================================================= TOP RATED PRODUCTS ============================================================= -->
                            <div class="widget">
                                <h2>Top Rated Products</h2>
                                <div class="body">
                                    <ul>
                                        <?php
                                        foreach ($rated as $a) {
                                            echo'<li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="' . $a->url . '">' . $a->name . '</a>
                                                    <div class="price">
                                                        
                                                        <div class="price-current">' . $a->price_sell_rp . '</div>
                                                    </div>
                                                </div>  

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="' . Yii::$app->homeUrl . 'images/blank.gif" data-echo="' . $a->imgSmall . '" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>';
                                        }
                                        ?>

                                    </ul>
                                </div><!-- /.body -->
                            </div><!-- /.widget -->
                            <!-- ============================================================= TOP RATED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

                    </div><!-- /.widgets-row-->
                </div><!-- /.container -->

                <div class="sub-form-row">
                    <div class="container">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
                            <script>
                                function cekEmail() {
                                    var cek = $("#email_input").val();
                                    var atpos = cek.indexOf("@");
                                    var dotpos = cek.lastIndexOf(".");
                                    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= cek.length)
                                    {
                                        alert("Alamat Email tidak valid !!!");
                                        return false;
                                    }
                                }
                            </script>
                            <?php
                            $form = ActiveForm::begin([
                                        'id' => 'subcribe-form',
                                        'action' => Yii::$app->urlManager->createUrl('site/subscribe')]);
                            ?> 
                            <input id="email_input" placeholder="Ketik alamat email anda, untuk mendapatkan penawaran terbaik kami setiap harinya" name='email' required>
                            <button class="le-button" name='send' onClick="return cekEmail();">Subscribe</button>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div><!-- /.container -->
                </div><!-- /.sub-form-row -->

                <div class="link-list-row">
                    <div class="container no-padding">
                        <div class="col-xs-12 col-md-4 ">
                            <!-- ============================================================= CONTACT INFO ============================================================= -->
                            <div class="contact-info">
                                <div class="footer-logo">
                                    <img alt="logo" src="<?= Yii::$app->homeUrl ?>images/logo.png" width="233" height="54"/>
                                </div><!-- /.footer-logo -->

                                <p class="regular-bold"> Toko online dengan Garansi Resmi, banyak Penghargaan yang kami dapatkan dan tentunya kami menjual dengan harga paling Murah </p>

                            </div>
                            <!-- ============================================================= CONTACT INFO : END ============================================================= -->            </div>

                        <div class="col-xs-12 col-md-8 no-margin">
                            <!-- ============================================================= LINKS FOOTER ============================================================= -->


                            <div class="link-widget" style="width: 360px">
                                <div class="widget">
                                    <h3>Kunjungi Kami</h3>
                                    <p>
                                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;Jl. Brigjend S.Riadi 10, kota malang, jawa timur<br>
                                        <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>&nbsp;&nbsp;
                                        (0341) 355 333 <br>
                                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;&nbsp; <a href="mailto:info@indomobilecell.com">info@indomobilecell.com</a>
                                    </p>

                                    <div class="social-icons">
                                        <h3>Sosial Media Kami</h3>
                                        <ul>
                                            <li><a href="http://www.facebook.com/indomobilecellmalang" target="_blank" class="fa fa-facebook"></a></li>
                                            <li><a href="http://www.twitter.com/jimmyetmada" target="_blank" class="fa fa-twitter"></a></li>
                                        </ul>
                                    </div><!-- /.social-icons -->

                                </div><!-- /.widget -->
                            </div><!-- /.link-widget -->


                            <div class="link-widget">
                                <div class="widget" id='cek-resi'>

                                    <div id="fb-root"></div>
                                    <script>(function (d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (d.getElementById(id))
                                                return;
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&appId=150291335047586&version=v2.0";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));</script>
                                    <div style="background-color: #ffffff" class="fb-like-box" data-href="https://www.facebook.com/indomobilecell.mlg" data-width="350" data-height="230" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>


                                </div><!-- /.widget -->
                            </div><!-- /.link-widget -->
                            <!-- ============================================================= LINKS FOOTER : END ============================================================= -->            </div>
                    </div><!-- /.container -->
                </div><!-- /.link-list-row -->

                <div class="copyright-bar">
                    <div class="container">
                        <div class="col-xs-12 col-sm-6 no-margin">
                            <div class="copyright">
                                &copy; <a href="index.html">Indomobilecell Online</a> v3 Beta Version - 2015 all rights reserved
                            </div><!-- /.copyright -->
                        </div>
                        <div class="col-xs-12 col-sm-6 no-margin">

                        </div>
                    </div><!-- /.container -->
                </div><!-- /.copyright-bar -->

            </footer><!-- /#footer -->
            <!-- ============================================================= FOOTER : END ============================================================= -->	</div><!-- /.wrapper -->

        <!-- For demo purposes – can be removed on production : End -->
        <?php $this->endBody() ?>
        <!-- JavaScripts placed at the end of the document so the pages load faster -->
    </body>
</html>

<?php $this->endPage() ?>
