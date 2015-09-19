<?php
foreach ($modelProductPhoto as $arr) {
    $ogImg = $arr->imgSmall;
    break;
}

$this->title = $model->name . ' | Indomobilecell.com';
$this->registerMetaTag(['property' => 'type', 'content' => 'article']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => 'Toko Online dengan Garansi Resmi, banyak Penghargaan yang kami dapatkan dan tentunya kami menjual dengan harga paling murah']);
$this->registerMetaTag(['property' => 'og:url', 'content' => "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"]);
$this->registerMetaTag(['property' => 'og:image', 'content' => $ogImg]);
?>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.3&appId=825402027535189";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div id="single-product">
    <div class="container">

        <div class="no-margin col-xs-12 col-sm-6 col-md-5 gallery-holder">
            <div class="product-item-holder size-big single-product-gallery small-gallery">

                <div id="owl-single-product">
                    <?php
                    foreach ($modelProductPhoto as $arr) {
                        echo '<div class="single-product-gallery-item" id="slide' . $arr->id . '">
                                    <img class="img-responsive" alt="" src="' . Yii::$app->homeUrl . 'images/blank.gif" data-echo="' . $arr->imgMedium . '" />
                            </div>';
                    }
                    ?>
                </div>
                <div class="single-product-gallery-thumbs gallery-thumbs">
                    <div id="owl-single-product-thumbnails">
                        <?php
                        $no = 0;
                        foreach ($modelProductPhoto as $arr) {
                            echo '<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="' . $no . '" href="#slide' . $arr->id . '">
                                    <img width="67" alt="" src="' . Yii::$app->homeUrl . 'images/blank.gif" data-echo="' . $arr->imgSmall . '" />
                                </a>';
                            $no++;
                        }
                        ?>
                    </div><!-- /#owl-single-product-thumbnails -->

                    <div class="nav-holder left hidden-xs">
                        <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
                    </div><!-- /.nav-holder -->

                    <div class="nav-holder right hidden-xs">
                        <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
                    </div><!-- /.nav-holder -->

                </div><!-- /.gallery-thumbs -->

            </div><!-- /.single-product-gallery -->
        </div><!-- /.gallery-holder -->        
        <div class="no-margin col-xs-12 col-sm-7 body-holder">
            <div class="body">

                <div class="title"><a href="<?= $model->url ?>"><?= $model->name ?></a></div>
                <div class="brand">
                    <?= $model->brand_name ?>
                    <div class="availability pull-right"><label>Availability:</label>
                        <?php
                        if ($model->realStock == 0) {
                            echo'<span class="not-available">  kosong</span>';
                        } else {
                            echo'<span class="available">  in stock</span>';
                        }
                        ?>
                    </div>
                </div>

                <div class="social-row">


                    <div style="float:left;">
                        <table>
                            <tr>
                                <td style="padding: 10px">
                                    <div class="fb-share-button" data-href="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" data-layout="box_count"></div>
                                </td>
                                <td style="padding-top: 6px;">
                                    <a class="twitter-share-button"
                                       href="https://twitter.com/share"
                                       data-url="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
                                       data-text="<?= $model->name . ' - Indomobilecell.com' ?>"
                                       data-count="vertical">
                                        Tweet
                                    </a>
                                    <script>
                                        window.twttr = (function (d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0], t = window.twttr || {};
                                            if (d.getElementById(id))
                                                return;
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = "https://platform.twitter.com/widgets.js";
                                            fjs.parentNode.insertBefore(js, fjs);
                                            t._e = [];
                                            t.ready = function (f) {
                                                t._e.push(f);
                                            };
                                            return t;
                                        }(document, "script", "twitter-wjs"));
                                    </script>
                                </td>
                            </tr>
                        </table>


                    </div>

                </div>

                <div class="excerpt">

                </div>

                <div class="prices">
                    <div class="price-current"><?= $model->price_sell_rp ?></div>
                    <div class="price-prev"><?= $model->discount_rp ?></div>
                </div>

                <div class="qnt-holder">
                    <div class="le-quantity">
                        <form>
                            <a class="minus" href="#reduce"></a>
                            <input name="quantity" readonly="readonly" type="text" value="1" />
                            <a class="plus" href="#add"></a>
                        </form>
                    </div>
                    <?php
                    if ($model->realStock == 0) {
                        echo'<a href="#" style="background-color: crimson;" class="le-button huge">Stock Habis</a>';
                    } else {
                        echo'<a href="#" id="' . $model->id . '"  class="le-button huge beli">Beli</a>';
                    }
                    ?>


                </div><!-- /.qnt-holder -->
            </div><!-- /.body -->

        </div><!-- /.body-holder -->
    </div><!-- /.container -->
</div><!-- /.single-product -->

<!-- ========================================= SINGLE PRODUCT TAB ========================================= -->
<section id="single-product-tab">
    <div class="container">
        <div class="tab-holder">

            <ul class="nav nav-tabs simple" >
                <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#additional-info" data-toggle="tab">Additional Information</a></li>
                <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
            </ul><!-- /.nav-tabs -->

            <div class="tab-content">
                <div class="tab-pane active" id="description">
                    <?= $model->description ?>
                </div>
                <div class="tab-pane" id="additional-info">
                    <ul class="tabled-data">
                        <li>
                            <label>weight</label>
                            <div class="value"><?= $model->weight ?> kg</div>
                        </li>
                        <li>
                            <label>dimensions</label>
                            <div class="value"><?= $model->width . ' x ' . $model->height . ' x ' . $model->length ?> cm</div>
                        </li>
                    </ul><!-- /.tabled-data -->

                    <div class="meta-row">
                        <div class="inline">
                            <label>Kode Barang:</label>
                            <span><?= $model->code ?></span>
                        </div><!-- /.inline -->

                        <span class="seperator">/</span>

                        <div class="inline">
                            <label>categories:</label>
                            <span><a href="#"><?= ($_GET['cat1']) ? $_GET['cat1'] : '' ?></a>,</span>
                            <span><a href="#"><?= ($_GET['cat2']) ? $_GET['cat2'] : '' ?></a></span>
                        </div><!-- /.inline -->

                    </div><!-- /.meta-row -->
                </div><!-- /.tab-pane #additional-info -->
                <div class="tab-pane" id="reviews">
                    <div class="fb-comments" data-href="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" data-numposts="10" data-colorscheme="light" width="100%"></div>
                </div><!-- /.tab-pane #reviews -->
            </div><!-- /.tab-content -->

        </div><!-- /.tab-holder -->
    </div><!-- /.container -->
</section>


<script>
    $("body").on("click", ".beli", function () {
        var id = $(this).attr("id");
        var isi_cart = $(".cart-list").html();
        $.ajax({
            type: 'POST',
            data: {id: id},
            url: "<?php echo Yii::$app->urlManager->createUrl('product/addcart') ?>",
            success: function (data) {
                window.location.replace("<?= Yii::$app->urlManager->createUrl('cart') ?>");
            },
        });
    });
</script>

