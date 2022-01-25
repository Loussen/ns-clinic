<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!--services-section end-->
<!-- Section: Depertment -->
<section class="z-index-1" data-tm-bg-color="#f0f3f5">
    <div class="container pb-90 pb-lg-60">
        <div class="section-content">
            <div class="row">
                <?php
                $limit = 6;
                if (isset($_GET["page"])) $page = intval($_GET["page"]); else $page = 1;
                $max_data = mysqli_num_rows(mysqli_query($db, "select id from methods where active='1'"));
                $max_page = ceil($max_data / $limit);
                if ($page > $max_page) $page = $max_page;
                if ($page < 1) $page = 1;
                $start = $page * $limit - $limit;

                $sql = mysqli_query($db, "select * from methods where active=1 order by id desc limit $start, $limit");

                while ($row = mysqli_fetch_assoc($sql))
                {
                    ?>
                    <div class="col-md-6 col-lg-4 tm-animation move-up">
                        <div class="tm-sc-iconbox iconbox-style-current-theme mediku-department icon-box animate-icon-on-hover animate-icon-rotate-y mb-30">
                            <div class="icon-wrapper">
                                <div class="icon">
                                    <img class="icon-img" src="<?= SITE_PATH ?>/images/methods/<?= $row['image'] ?>"
                                         alt="<?= $row['name_' . $lang_name] ?>">
                                </div>
                            </div>
                            <div class="content text-center">
                                <h4 class="title"><?= $row['name_' . $lang_name] ?></h4>
                                <p><?= substr_(decode_text($row['short_text_' . $lang_name]), 0, 100, true, true) ?></p>
                                <a class="btn-plain-text-with-arrow" href="<?= $site ?>/genetik-test/<?= slugGenerator($row['name_' . $lang_name]) . '-' . $row["id"] ?>"><?=$lang23?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="pagination-block">
                <?php
                if ($max_data > 6) {
                    $show = 3;
                    if ($page > $show + 1) echo '<a class="next page-numbers" href="?page=' . ($page - 1) . '"><i class="ti ti-arrow-left"></i></a>';
                    for ($i = $page - $show; $i <= $page + $show; $i++) {
                        if ($i > 0 && $i <= $max_page) {
                            if ($i == $page) {
                                echo '<span class="page-numbers current">'.$i.'</span>';
                            } else {
                                $href = '?page=' . $i;
                                echo '<a class="page-numbers" href="'.$href.'">'.$i.'</a>';
                            }
                        }
                    }
                    if ($page < $max_page - $show && $max_page > 1) echo '<a class="next page-numbers" href="?page=' . ($page + 1) . '"><i class="ti ti-arrow-right"></i></a>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="cp-shape layer-shape-style4">
        <div class="layer-shape-one" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/bg-shape2.png"></div>
    </div>
</section>
<!-- End Divider -->