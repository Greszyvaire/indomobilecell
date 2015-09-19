<?php
/* @var $this yii\web\View */
$this->title = 'INDOMOBILECELL - toko GROSIR HANDPHONE terlaris, termurah, dan terpercaya';

use common\models\ProductStock;
use common\models\Product;

$session = Yii::$app->session;

?>

<div class="container">
    <div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder">
        <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu animate-dropdown">
            <div class="head"><i class="fa fa-list"></i>Belanja Sekarang Juga</div>        
            <nav class="yamm megamenu-horizontal" role="navigation">
                <ul class="nav">
                    <li class="dropdown menu-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Accesories</a>
                        <ul class="dropdown-menu mega-menu">
                            <li class="yamm-content">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-4">
                                        <ul >
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/81/accesories/handsfree') ?>">Handsfree</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/77/accesories/power-bank') ?>">Power Bank</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/75/accesories/bluetooth') ?>">Bluetooth</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/73/accesories/memory') ?>">Memory</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/68/accesories/leather-case') ?>">Letter Case</a></li>


                                        </ul>
                                    </div>
                                    <div class="col-xs-12 col-lg-4">
                                        <ul >
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/66/accesories/casing') ?>">Casing</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/62/accesories/charger') ?>">Charger</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/1/accesories/screen-protector') ?>">Screen Protector</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/70/accesories/soft-jacket') ?>">Soft Jacket</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/60/accesories/battery') ?>">Battery</a></li>

                                        </ul>
                                    </div>

                                    <div class="dropdown-banner-holder">
                                        <a href="#"><img alt="" src="images/banners/accesories.png" /></a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </li><!-- /.menu-item -->
                    <li class="dropdown menu-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Smartphone</a>
                        <ul class="dropdown-menu mega-menu">
                            <li class="yamm-content">
                                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                                <div class="row">
                                    <div class="col-xs-12 col-lg-4">
                                        <ul>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/37/smartphone/iphone') ?>">Iphone</a></li>

                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/47/smartphone/sony') ?>">Sony</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/46/smartphone/samsung') ?>">Samsung</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/45/smartphone/nokia') ?>">Nokia</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/41/smartphone/motorola') ?>">Motorola</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/39/smartphone/lg') ?>">LG</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/38/smartphone/lenovo') ?>">Lenovo</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/34/smartphone/huawei') ?>">Huawei</a></li>

                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/26/smartphone/blackberry') ?>">Blackberry</a></li>
                                        </ul>
                                    </div>

                                    <div class="col-xs-12 col-lg-4">
                                        <ul>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/25/smartphone/asus') ?>">Asus</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/22/smartphone/acer') ?>">Acer</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/23/smartphone/advan') ?>">Advan</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/133/smartphone/smartfren') ?>">Smartfren</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/138/smartphone/evercoss') ?>">Evercoss</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/146/smartphone/oppo') ?>">Oppo</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/153/smartphone/blaupunkt') ?>">Blaupunkt</a></li>
                                        </ul>
                                    </div>

                                    <div class="dropdown-banner-holder">
                                        <a href="#"><img alt="" src="images/banners/smartphone.png" /></a>
                                    </div>
                                </div>
                                <!-- ================================== MEGAMENU VERTICAL ================================== -->                        
                            </li>
                        </ul>
                    </li><!-- /.menu-item -->

                    <li class="dropdown menu-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tablet</a>
                        <ul class="dropdown-menu mega-menu">
                            <li class="yamm-content">
                                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                                <div class="row">
                                    <div class="col-xs-12 col-lg-4">
                                        <ul>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/123/tablet/advan') ?>">Advan</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/125/tablet/lenovo') ?>">Lenovo</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/127/tablet/asus') ?>">Asus</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/128/tablet/ipad') ?>">Ipad</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/129/tablet/samsung') ?>">Samsung</a></li>

                                        </ul>
                                    </div>
                                    <div class="col-xs-12 col-lg-4">
                                        <ul>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/142/tablet/hp') ?>">HP</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/145/tablet/acer') ?>">Acer</a></li>
                                        </ul>
                                    </div>




                                    <div class="dropdown-banner-holder">
                                        <a href="#"><img alt="" src="images/banners/tablet.png" /></a>
                                    </div>
                                </div>
                                <!-- ================================== MEGAMENU VERTICAL ================================== -->                    </li>
                        </ul>
                    </li><!-- /.menu-item -->
                    <li class="dropdown menu-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Handphone</a>
                        <ul class="dropdown-menu mega-menu">
                            <li class="yamm-content">
                                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                                <div class="row">
                                    <div class="col-xs-12 col-lg-4">
                                        <ul>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/112/handphone/nokia') ?>">Nokia</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/117/handphone/samsung') ?>">Samsung</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/143/handphone/advan') ?>">Advan</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('category/144/handphone/lg') ?>">LG</a></li>
                                        </ul>
                                    </div>


                                    <div class="dropdown-banner-holder">
                                        <a href="#"><img alt="" src="images/banners/handphone.png" /></a>
                                    </div>
                                </div>
                                <!-- ================================== MEGAMENU VERTICAL ================================== -->    
                            </li>
                        </ul>
                    </li><!-- /.menu-item -->
                </ul><!-- /.nav -->
            </nav><!-- /.megamenu-horizontal -->
        </div><!-- /.side-menu -->
        <!-- ================================== TOP NAVIGATION : END ================================== -->		</div><!-- /.sidemenu-holder -->

    <div class="col-xs-12 col-sm-8 col-md-9 homebanner-holder hidden-xs">
        <!-- ========================================== SECTION – HERO ========================================= -->

        <div id="hero">
            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

                <div class="item" style="background-image: url(http://app.indomobilecell.com/images/file/slider/slider1.jpg);  background-size: 876px 325px;">
                </div><!-- /.item -->
                <div class="item" style="background-image: url(http://app.indomobilecell.com/images/file/slider/slider2.jpg); background-size: 876px 325px;">
                </div><!-- /.item -->
                <div class="item" style="background-image: url(http://app.indomobilecell.com/images/file/slider/slider3.jpg); background-size: 876px 325px;">
                </div><!-- /.item -->

            </div><!-- /.owl-carousel -->
        </div>

        <!-- ========================================= SECTION – HERO : END ========================================= -->			
    </div><!-- /.homebanner-holder -->

</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<!-- ========================================= HOME BANNERS ========================================= -->
<section id="banner-holder" class="wow fadeInUp">
    <div class="container">
        <div class="col-xs-12 col-lg-6 no-margin banner">
           
                <img class="banner-image" alt="" src="images/blank.gif" data-echo="http://app.indomobilecell.com/images/file/banner1.png" />
            
        </div>
        <div class="col-xs-12 col-lg-6 no-margin text-right banner">
            
              
                <img class="banner-image" alt="" src="images/blank.gif" data-echo="http://app.indomobilecell.com/images/file/banner2.png" />
            
        </div>
    </div><!-- /.container -->
</section><!-- /#banner-holder -->
<!-- ========================================= HOME BANNERS : END ========================================= -->
<div id="products-tab" class="wow fadeInUp">
    <div class="container">
        <div class="tab-holder">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" >
                <li class="active"><a href="#new-arrivals" data-toggle="tab">New Arrival</a></li>
                <li><a href="#popular" data-toggle="tab">Popular</a></li>
                <li><a href="#featured" data-toggle="tab">Featured</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="new-arrivals">
                    <div class="product-grid-holder">
                        <?php
                         
                        foreach ($arrival as $data) {
                            $sale = (!empty($data->discount)) ? '<div class="ribbon red"><span>sale</span></div>' : '';
                            echo'<div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                            <div class="product-item">
                            ' . $sale . '
                                <div class="ribbon blue"><span>new!</span></div> 
                                <div class="image">
                                    <img alt="" src="images/blank.gif" data-echo="' . $data->imgSmall . '" />
                                </div>
                                <div class="body">
                               
                                    <div class="title">
                                        <a href="' . $data->url . '">' . $data->name . '</a>
                                    </div>
                                    <div class="brand">' . $data->brand_name . '</div>
                                </div>
                                <div class="prices">
                                    <div class="price-prev">' . $data->discount_rp . '</div>
                                    <div class="price-current pull-right">' . $data->price_sell_rp . '</div>
                                </div>

                                <div class="hover-area">';
                            if ($data->realStock == 0) {
                                echo' <div class="add-cart-button">
                                        <a href="#" style="background-color: crimson;" class="le-button">Stock Habis</a>
                                   </div>';
                            } else {
                              
//                                if (in_array($data->id, $items)) {
//                                    echo' <div class="add-cart-button">
//                                        <a href="#"   class="le-button" style="background-color: chocolate;">Terbeli</a>
//                                   </div>';
//                                } else {
                                    echo' <div class="add-cart-button">
                                        <a href="#" id="' . $data->id . '"  class="le-button beli">Beli</a>
                                   </div>';
//                                }
                            }

                            echo' </div>
                            </div>
                        </div>';
                        }
                        ?>




                    </div>

                </div>
                <div class="tab-pane" id="popular">
                    <div class="product-grid-holder">
                        <?php
                        foreach ($popular as $data) {
                            $sale = (!empty($data->discount)) ? '<div class="ribbon red"><span>sale</span></div>' : '';
                            echo'<div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                            <div class="product-item">
                            ' . $sale . '
                                <div class="image">
                                    <img alt="" src="images/blank.gif" data-echo="' . $data->imgSmall . '" />
                                </div>
                                <div class="body">
                               
                                    <div class="title">
                                        <a href="' . $data->url . '">' . $data->name . '</a>
                                    </div>
                                    <div class="brand">' . $data->brand_name . '</div>
                                </div>
                                <div class="prices">
                                    <div class="price-prev">' . $data->discount_rp . '</div>
                                    <div class="price-current pull-right">' . $data->price_sell_rp . '</div>
                                </div>

                                <div class="hover-area">';
                            if ($data->realStock == 0) {
                                echo' <div class="add-cart-button">
                                        <a href="#" style="background-color: crimson;" class="le-button">Stock Habis</a>
                                   </div>';
                            } else {
                                echo' <div class="add-cart-button">
                                        <a href="#" id="' . $data->id . '"  class="le-button beli">Beli</a>
                                   </div>';
                            }

                            echo' </div>
                            </div>
                        </div>';
                        }
                        ?>

                    </div>

                </div>

                <div class="tab-pane" id="featured">
                    <div class="product-grid-holder">


                        <?php
                        foreach ($featured as $data) {
                            $sale = (!empty($data->discount)) ? '<div class="ribbon red"><span>sale</span></div>' : '';

                            echo'<div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                            <div class="product-item">
                                ' . $sale . '
                                <div class="image">
                                    <img alt="" src="images/blank.gif" data-echo="' . $data->imgSmall . '" />
                                </div>
                                <div class="body">
                               
                                    <div class="title">
                                        <a href="' . $data->url . '">' . $data->name . '</a>
                                    </div>
                                    <div class="brand">' . $data->brand_name . '</div>
                                </div>
                                <div class="prices">
                                    <div class="price-prev">' . $data->discount_rp . '</div>
                                    <div class="price-current pull-right">' . $data->price_sell_rp . '</div>
                                </div>

                                <div class="hover-area">';
                            if ($data->realStock == 0) {
                                echo' <div class="add-cart-button">
                                        <a href="#" style="background-color: crimson;" class="le-button">Stock Habis</a>
                                   </div>';
                            } else {
                                echo' <div class="add-cart-button">
                                        <a href="#" id="' . $data->id . '"  class="le-button beli">Beli</a>
                                   </div>';
                            }

                            echo' </div>
                            </div>
                        </div>';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========================================= BEST SELLERS ========================================= -->
<section id="bestsellers" class="color-bg wow fadeInUp">
    <div class="container">
        <h1 class="section-title">Best Sellers</h1>

        <div class="product-grid-holder medium">
            <div class="col-xs-12 col-md-7 no-margin">

                <div class="row no-margin">
                    <?php
                    foreach ($bestSeller1 as $arr) {
                        $sale = (!empty($arr->discount)) ? '<div class="ribbon red"><span>sale</span></div>' : '';
                        echo '<div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                        <div class="product-item">
                            <div class="image">
                                <img alt="" src="images/blank.gif" data-echo="' . $arr->imgSmall . '" style="height: 160px;" />
                            </div>
                            <div class="body">
                                <div class="label-discount clear"></div>
                                <div class="title">
                                    <a href="' . $arr->url . '">' . $arr->name . '</a>
                                </div>
                                <div class="brand">' . $arr->brand_name . '</div>
                            </div>
                            <div class="prices">

                                <div class="price-current text-right">' . $arr->price_sell_rp . '</div>
                            </div>
                            <div class="hover-area">';
                        if ($arr->realStock == 0) {
                            echo' <div class="add-cart-button">
                                        <a href="#" style="background-color: crimson;" class="le-button">Stock Habis</a>
                                   </div>';
                        } else {
                            echo' <div class="add-cart-button">
                                        <a href="#" id="' . $arr->id . '"  class="le-button beli">Beli</a>
                                   </div>';
                        }
                        echo'</div>
                        </div>
                    </div>';
                    }
                    ?>
                </div><!-- /.row -->
                <div class="row no-margin">
                    <?php
                    foreach ($bestSeller2 as $arr) {
//                        $stock = ProductStock::departement($arr->stock, 1);
                        echo '<div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                        <div class="product-item">
                            <div class="image">
                                <img alt="" src="images/blank.gif" data-echo="' . $arr->imgSmall . '" style="height: 160px;" />
                            </div>
                            <div class="body">
                                <div class="label-discount clear"></div>
                                <div class="title">
                                    <a href="' . $arr->url . '">' . $arr->name . '</a>
                                </div>
                                <div class="brand">' . $arr->brand_name . '</div>
                            </div>
                            <div class="prices">

                                <div class="price-current text-right">' . $arr->price_sell_rp . '</div>
                            </div>
                            <div class="hover-area">';
                        if ($arr->realStock == 0) {
                            echo' <div class="add-cart-button">
                                        <a href="#" style="background-color: crimson;" class="le-button">Stock Habis</a>
                                   </div>';
                        } else {
                            echo' <div class="add-cart-button">
                                       <a href="#" id="' . $arr->id . '"  class="le-button beli">Beli</a>
                                   </div>';
                        }
                        echo'</div>
                        </div>
                    </div>';
                    }
                    ?>
                </div><!-- /.row -->


            </div><!-- /.col -->
            <div class="col-xs-12 col-md-5 no-margin">
                <div class="product-item-holder size-big single-product-gallery small-gallery">
                    <div class="product-item-holder size-big single-product-gallery small-gallery">

                        <div id="owl-single-product">
                            <?php
                            foreach ($photoAlone as $arr) {
                                echo '<div class="single-product-gallery-item" id="slide' . $arr->id . '">
                                    <img class="img-responsive" alt="" src="images/blank.gif" data-echo="' . $arr->imgMedium . '" />
                            </div>';
                            }
                            ?>
                        </div><!-- /.single-product-slider -->


                        <div class="single-product-gallery-thumbs gallery-thumbs">

                            <div id="owl-single-product-thumbnails">
                                <?php
                                $no = 0;
                                foreach ($photoAlone as $arr) {
                                    echo '<a class="horizontal-thumb" data-target="#owl-single-product" data-slide="' . $no . '" href="#slide' . $arr->id . '">
                                    <img width="67" alt="" src="images/blank.gif" data-echo="' . $arr->imgSmall . '" />
                                </a>';
                                    $no++;
                                }
                                ?>
                            </div><!-- /#owl-single-product-thumbnails -->



                        </div><!-- /.gallery-thumbs -->

                    </div><!-- /.single-product-gallery -->
                    <div class="body">
                        <div class="label-discount clear"></div>
                        <div class="<?= $alone->url ?>">
                            <a href=><?= $alone->name ?></a>
                        </div>
                        <div class="brand"><?= $alone->brand_name ?></div>
                    </div>
                    <div class="prices text-right">
                        <div class="price-current inline"><?= $alone->price_sell_rp ?></div>
                        <a href="#" class="le-button big inline">Beli</a>
                    </div>
                </div>
            </div>

        </div><!-- /.product-grid-holder -->
    </div><!-- /.container -->
</section><!-- /#bestsellers -->
<!-- ========================================= BEST SELLERS : END ========================================= -->
<!-- ========================================= RECENTLY VIEWED ========================================= -->
<section id="recently-reviewd" class="wow fadeInUp">
    <div class="container">
        <div class="carousel-holder hover">

            <div class="title-nav">
                <h2 class="h1">Recently Viewed</h2>
                <div class="nav-holder">
                    <a href="#prev" data-target="#owl-recently-viewed" class="slider-prev btn-prev fa fa-angle-left"></a>
                    <a href="#next" data-target="#owl-recently-viewed" class="slider-next btn-next fa fa-angle-right"></a>
                </div>
            </div><!-- /.title-nav -->

            <div id="owl-recently-viewed" class="owl-carousel product-grid-holder">
                <?php
                foreach ($recently as $data) {

                    echo'<div class="no-margin carousel-item product-item-holder size-small hover">
                    <div class="product-item">
                        <div class="ribbon red"><span>sale</span></div> 
                        <div class="image">
                            <img alt="" src="images/blank.gif" data-echo="' . $data->imgSmall . '" style="height:160px" />
                        </div>
                        <div class="body">
                            <div class="title">
                                <a href="' . $data->url . '">' . $data->name . '</a>
                            </div>
                            <div class="brand">' . $data->brand_name . '</div>
                        </div>
                        <div class="prices">
                            <div class="price-current text-right">' . $data->price_sell_rp . '</div>
                        </div>
                        <div class="hover-area">';
                    if ($data->realStock == 0) {
                        echo' <div class="add-cart-button">
                                        <a href="#" style="background-color: crimson;" class="le-button">Stock Habis</a>
                                   </div>';
                    } else {
                        echo' <div class="add-cart-button">
                                        <a href="#" id="' . $data->id . '"  class="le-button beli">Beli</a>
                                   </div>';
                    }

                    echo'</div>
                    </div><!-- /.product-item -->
                </div><!-- /.product-item-holder -->';
                }
                ?>







            </div><!-- /#recently-carousel -->

        </div><!-- /.carousel-holder -->
    </div><!-- /.container -->
</section><!-- /#recently-reviewd -->
<!-- ========================================= RECENTLY VIEWED : END ========================================= -->
<!-- ========================================= TOP BRANDS ========================================= -->
<section id="top-brands" class="wow fadeInUp">
    <div class="container">
        <div class="carousel-holder" >

            <div class="title-nav">
                <h1>Top Brands</h1>
                <div class="nav-holder">
                    <a href="#prev" data-target="#owl-brands" class="slider-prev btn-prev fa fa-angle-left"></a>
                    <a href="#next" data-target="#owl-brands" class="slider-next btn-next fa fa-angle-right"></a>
                </div>
            </div><!-- /.title-nav -->

            <div id="owl-brands" class="owl-carousel brands-carousel">

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/apple.png" />
                    </a>
                </div><!-- /.carousel-item -->
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/oppo.png" />
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/samsung.png" />
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/blackberry.png" />
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/motorola.png" />
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/sony.png" />
                    </a>
                </div><!-- /.carousel-item -->



                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/lenovo.png" />
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/huawei.png" />
                    </a>
                </div><!-- /.carousel-item -->
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/lg.png" />
                    </a>
                </div><!-- /.carousel-item -->
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/advan.png" />
                    </a>
                </div><!-- /.carousel-item -->
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/acer.png" />
                    </a>
                </div><!-- /.carousel-item -->
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/asus.png" />
                    </a>
                </div><!-- /.carousel-item -->
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/evercoss.png" />
                    </a>
                </div><!-- /.carousel-item -->
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/nokia.png" />
                    </a>
                </div><!-- /.carousel-item -->
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="images/brands/smartfren.png" />
                    </a>
                </div><!-- /.carousel-item -->


            </div><!-- /.brands-caresoul -->

        </div><!-- /.carousel-holder -->
    </div><!-- /.container -->
</section><!-- /#top-brands -->
<!-- ========================================= TOP BRANDS : END ========================================= -->		<!-- ============================================================= FOOTER ============================================================= -->
<script>

    $("body").on("click", ".beli", function() {
        var id = $(this).attr("id");
        var isi_cart = $(".cart-list").html();
//        var terbeli  = $(this);
        $.ajax({
            type: 'POST',
            data: {id: id},
            url: "<?php echo Yii::$app->urlManager->createUrl('product/addcart') ?>",
            success: function(data) {
//                $('.basket').addClass('open');
//                 terbeli.replaceWith("<a href='#' style='background-color: crimson;' class='le-button'>Stock Habis</a>");
//                $(".cart-list").html(data + isi_cart);
//                location.reload();
                window.location.replace("<?= Yii::$app->urlManager->createUrl('cart') ?>");
//                    alert(data);
            },
        });
    });
</script>