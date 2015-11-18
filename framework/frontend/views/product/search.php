<?php

use yii\widgets\LinkPager;
$session = Yii::$app->session;
?>

<style>
    .cc{
        background-color: #fff;
        border: 1px solid #ececec;
        padding: 5px 16px 7px 5px;
        color: #3d3d3d;
        width: 100%;
        font-size: 13px;
        width: auto;
        position: relative;
        display: inline-block;
        vertical-align: top;

    }
    .cc select{
        background-color: #fff;
        border: none;
    }
</style>
<section id="category-grid">
    <div class="container">
        <!-- ========================================= SIDEBAR ========================================= -->
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">
            <!-- ========================================= PRODUCT FILTER ========================================= -->
            <?php
                        if(!isset($_GET['name'])){
                        ?>
            <form method="get" action="<?= Yii::$app->urlManager->createUrl('pencarian') ?>">
                <div class="widget">
                    <h1>Product Filters</h1>
                    <div class="body bordered">
                        
                        <div class="category-filter">
                            <h2>Brands</h2>
                            <input name="cat_id" value="<?php echo $cat_id ?>" type="hidden">
                            <hr>
                            <ul>
                                 <?php
                                    if (isset($_GET['brand']))
                                        $key = $_GET['brand'];
                                    else
                                        $key = array();

                                    foreach ($modelCat as $arr) {
                                        $chk = (in_array($arr->id, $key)) ? 'checked="checked"' : '';
                                        echo '<li><input ' . $chk . ' class="le-checkbox" name="brand[]" type="checkbox" value="' . $arr->id . '"  /> <label>' . $arr->name . '</label> <span class="pull-right">(' . count($arr->product) . ')</span></li>';
                                    }
                                    ?>
                            </ul>
                        </div><!-- /.category-filter -->
                        
                        <div class="price-filter">
                            <h2>Price Range</h2>
                            <hr>
                            <div class="price-range-holder">

                                <input type="text" class="price-slider" value="" name="price">

                                <span class="min-max">

                                </span>
                                <span class="filter-button">
                                    <button type="submit" class="le-button">Filter</button>
                                </span>
                            </div>
                        </div><!-- /.price-filter -->
                       
                    </div><!-- /.body -->
                </div><!-- /.widget -->
            </form>
             <?php } ?>
            <!-- ========================================= PRODUCT FILTER : END ========================================= -->
            <!-- ========================================= CATEGORY TREE ========================================= -->
            <div class="widget accordion-widget category-accordions">
                <h1 class="border">Category Product</h1>
                <div class="accordion">


                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseOne">
                                Smartphone
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <ul>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/37/smartphone/iphone') ?>">Iphone</a></li>

                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/46/smartphone/samsung') ?>">Samsung</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/45/smartphone/nokia') ?>">Nokia</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/41/smartphone/motorola') ?>">Motorola</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/39/smartphone/lg') ?>">LG</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/38/smartphone/lenovo') ?>">Lenovo</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/34/smartphone/huawei') ?>">Huawei</a></li>

                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/26/smartphone/blackberry') ?>">Blackberry</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/25/smartphone/asus') ?>">Asus</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/22/smartphone/acer') ?>">Acer</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/23/smartphone/advan') ?>">Advan</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/133/smartphone/smartfren') ?>">Smartfren</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/138/smartphone/evercoss') ?>">Evercoss</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/146/smartphone/oppo') ?>">Oppo</a></li>

                                </ul>
                            </div>
                        </div>
                    </div><!-- /.accordion-group -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseTwo">
                                Tablet
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <ul>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/123/tablet/advan') ?>">Advan</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/125/tablet/lenovo') ?>">Lenovo</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/127/tablet/asus') ?>">Asus</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/128/tablet/ipad') ?>">Ipad</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/129/tablet/samsung') ?>">Samsung</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/142/tablet/hp') ?>">HP</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/145/tablet/acer') ?>">Acer</a></li>

                                </ul>
                            </div>
                        </div>
                    </div><!-- /.accordion-group -->


                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse"  href="#collapse3">
                                Handphone
                            </a>
                        </div>
                        <div id="collapse3" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <ul>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/112/handphone/nokia') ?>">Nokia</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/117/handphone/samsung') ?>">Samsung</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/143/handphone/advan') ?>">Advan</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/144/handphone/lg') ?>">LG</a></li>

                                </ul>
                            </div>
                        </div>
                    </div><!-- /.accordion-group -->


                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse"  href="#collapse4">
                                Accesories
                            </a>
                        </div>
                        <div id="collapse4" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <ul>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/81/accesories/handsfree') ?>">Handsfree</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/77/accesories/power-bank') ?>">Power Bank</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/75/accesories/bluetooth') ?>">Bluetooth</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/73/accesories/memory') ?>">Memory</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/68/accesories/leather-case') ?>">Letter Case</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/66/accesories/casing') ?>">Casing</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/62/accesories/charger') ?>">Charger</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/1/accesories/screen-protector') ?>">Screen Protector</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/70/accesories/soft-jacket') ?>">Soft Jacket</a></li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl('category/60/accesories/battery') ?>">Battery</a></li>

                                </ul>
                            </div>
                        </div>
                    </div><!-- /.accordion-group -->

                </div><!-- /.accordion -->
            </div><!-- /.category-accordions -->
            <!-- ========================================= LINKS : END ========================================= -->
            <div class="widget">
                <div class="simple-banner">
                    <a href="#"><img alt="" class="img-responsive" src="<?= Yii::$app->homeUrl ?>images/blank.gif" data-echo="<?= Yii::$app->homeUrl ?>images/awas-penipuan.jpg" /></a>
                </div>
            </div>
            <!-- ========================================= FEATURED PRODUCTS ========================================= -->
            <div class="widget">
                <h1 class="border">Featured Products</h1>
                <ul class="product-list">
                    <?php
                    foreach ($featured as $arr) {
                        echo '<li class="sidebar-product-list-item">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 no-margin">
                                            <a href="#" class="thumb-holder">
                                                <img alt="" src="' . Yii::$app->homeUrl . 'images/blank.gif" data-echo="' . $arr->imgSmall . '" style="width: 73px;height:73px;"/>
                                            </a>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 no-margin">
                                            <a href="' . $arr->url . '">' . $arr->name . '</a>
                                            <div class="price">
                                                <div class="price-prev">' . $arr->discount_rp . '</div>
                                                <div class="price-current">' . $arr->price_sell_rp . '</div>
                                            </div>
                                        </div>  
                                    </div>
                                </li>';
                    }
                    ?>

                </ul><!-- /.product-list -->
            </div><!-- /.widget -->
            <!-- ========================================= FEATURED PRODUCTS : END ========================================= -->
        </div>
        <!-- ========================================= SIDEBAR : END ========================================= -->

        <!-- ========================================= CONTENT ========================================= -->

        <div class="col-xs-12 col-sm-9 no-margin wide sidebar">

            <section id="gaming">
                <div class="grid-list-products">
                    
                    <div class="control-bar">
                        <div id="item-count" class="cc">
                            <select name="filter" id="sort">
                                <option value="last" <?=($session['sorting']=="last") ? 'selected' : ''?>>Latest Product</option>
                                <option value="old" <?=($session['sorting']=="old") ? 'selected' : ''?>>Old Product</option>
                                <option value="nameAsc" <?=($session['sorting']=="nameAsc") ? 'selected' : ''?>>Name (A-Z)</option>
                                <option value="nameDesc" <?=($session['sorting']=="nameDesc") ? 'selected' : ''?>>Name (Z-A)</option>
                                <option value="priceAsc" <?=($session['sorting']=="priceAsc") ? 'selected' : ''?>>Price (Low-Hight)</option>
                                <option value="priceDesc" <?=($session['sorting']=="priceDesc") ? 'selected' : ''?>>Price (Hight-Low)</option>
                                <option value="latest" <?=($session['sorting']=="latest") ? 'selected' : ''?>>Latest items</option>
                            </select>
                        </div>
                        <div id="item-count" class="cc">
                            <select name="pagination" id="show">
                                <option value="show18" <?=($session['showing']=="show18") ? 'selected' : ''?>>18 per page</option>
                                <option value="show24" <?=($session['showing']=="show24") ? 'selected' : ''?>>24 per page</option>
                                <option value="show32" <?=($session['showing']=="show32") ? 'selected' : ''?>>32 per page</option>
                            </select>
                        </div>
                        <div class="grid-list-buttons">
                            <ul>
                                <li class="grid-list-button-item active"><a data-toggle="tab" href="#grid-view"><i class="fa fa-th-large"></i> Grid</a></li>
                                <li class="grid-list-button-item "><a data-toggle="tab" href="#list-view"><i class="fa fa-th-list"></i> List</a></li>
                            </ul>
                        </div>
                    </div><!-- /.control-bar -->

                    <div class="tab-content">
                        <div id="grid-view" class="products-grid fade tab-pane in active">

                            <div class="product-grid-holder">
                                <div class="row no-margin">
                                    <?php
                                    foreach ($modelProduct as $arr) {
                                        $new = ($arr->isNew) ? '<div class="ribbon blue"><span>new</span></div>' : '';
//                                        $stock = ProductStock::departement($arr->stock, 1);
                                        echo '<div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                <div class="product-item">
                                                    <div class="ribbon red"><span>sale</span></div> 
                                                    ' . $new . '
                                                    <div class="image">
                                                        <img alt="" src="' . Yii::$app->homeUrl . 'images/blank.gif" data-echo="' . $arr->imgSmall . '" />
                                                    </div>
                                                    <div class="body">
                                                        <div class="label-discount green"></div>
                                                        <div class="title">
                                                            <a href="' . $arr->url . '">' . $arr->name . '</a>
                                                        </div>
                                                        <div class="brand">' . $arr->brand_name . '</div>
                                                    </div>
                                                    <div class="prices">
                                                        <div class="price-prev">' . $arr->discount_rp . '</div>
                                                        <div class="price-current pull-right">' . $arr->price_sell_rp . '</div>
                                                    </div>
                                                    <div class="hover-area">';
                                        if ($arr->stock == 0) {
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
                            </div><!-- /.product-grid-holder -->
                            <?= LinkPager::widget(['pagination' => $pagination]) ?>
                        </div><!-- /.products-grid #grid-view -->

                        <div id="list-view" class="products-grid fade tab-pane ">
                            <div class="products-list">
                                <?php
                                foreach ($modelProduct as $arr) {
//                                    $stock = ProductStock::departement($arr->stock, 1);
                                    $new = ($arr->isNew) ? '<div class="ribbon blue"><span>new</span></div>' : '';
                                    echo '<div class="product-item product-item-holder">
                                        <div class="ribbon red"><span>sale</span></div> 
                                        ' . $new . '
                                        <div class="row">
                                            <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                                <div class="image">
                                                    <img alt="" src="' . Yii::$app->homeUrl . 'images/blank.gif" data-echo="' . $arr->imgSmall . '" />
                                                </div>
                                            </div><!-- /.image-holder -->
                                            <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                                <div class="body">
                                                    <div class="label-discount green"></div>
                                                    <div class="title">
                                                        <a href="' . $arr->url . '">' . $arr->name . '</a>
                                                    </div>
                                                    <div class="brand">' . $arr->brand_name . '</div>
                                                    <div class="excerpt">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="no-margin col-xs-12 col-sm-3 price-area">
                                                <div class="right-clmn">
                                                    <div class="price-current">' . $arr->price_sell_rp . '</div>
                                                    <div class="price-prev">' . $arr->discount_rp . '</div>';
                                    if ($arr->stock == 0) {
                                        echo' <div class="availability"><label>availability:</label><span class="available">  out of stock</span></div>
                                                    <a class="le-button" style="background-color: crimson;" href="#">Habis</a>';
                                    } else {
                                        echo' <div class="availability"><label>availability:</label><span class="available">  in stock</span></div>
                                                    <a href="#" id="' . $arr->id . '"  class="le-button beli">Beli</a>';
                                    }
                                    echo'</div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div><!-- /.products-list -->
                            <?= LinkPager::widget(['pagination' => $pagination]) ?>
                        </div><!-- /.products-grid #list-view -->

                    </div><!-- /.tab-content -->
                </div><!-- /.grid-list-products -->

            </section><!-- /#gaming -->                        
        </div><!-- /.col -->
        <!-- ========================================= CONTENT : END ========================================= -->    
    </div><!-- /.container -->
</section><!-- /#category-grid -->		<!-- ============================================================= FOOTER ============================================================= -->

<script type="text/javascript">
    //sorting
    $("body").on("change", "#sort", function () {
        var sort = $(this).val();
        $.ajax({
            type: 'GET',
            data: {sort: sort},
            url: "<?= Yii::$app->urlManager->createUrl('product/sorting') ?>",
            success: function (data) {
                location.reload();
            },
        });
    });
    // showing
    $("body").on("change", "#show", function () {
        var show = $(this).val();
        $.ajax({
            type: 'GET',
            data: {show: show},
            url: "<?= Yii::$app->urlManager->createUrl('product/showing') ?>",
            success: function (data) {
                location.reload();
            },
        });
    });
    
     //cart
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
                window.location.replace("<?= Yii::$app->urlManager->createUrl('cart') ?>");
//                    alert(data);
            },
        });
    });
</script>