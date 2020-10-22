<?php
    $cart = Session::get('cart');
    $totalItems = 0;
    $booksOrder = 0;
    if (!empty($cart)) {
        $totalItems = array_sum($cart['quantity']);
        $booksOrder = $totalItems;
    }


?>

<div>
    <div class="icon-nav">
        <ul>
            <li class="onhover-div mobile-search">
                <div>
                    <img src="<?php echo $imageURL; ?>/search.png" onclick="openSearch()" class="img-fluid blur-up lazyload" alt="">
                    <i class="ti-search" onclick="openSearch()"></i>
                </div>
                <div id="search-overlay" class="search-overlay">
                    <div>
                        <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                        <div class="overlay-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12">

                                        <?php
                                            $linkSearch = URL::createLink('frontend', 'book', 'list', ['search' => $this->arrParam['search']]);
                                        ?>

                                        <form action="book.html" method="GET">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="search" id="search-input" placeholder="Tìm kiếm sách..." value="<?php echo $this->arrParam['search']; ?>">

                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="onhover-div mobile-cart">
                <div>
                    <a href="<?php echo $linkCart; ?>" id="cart" class="position-relative">
                        <img src="<?php echo $imageURL; ?>/cart.png" class="img-fluid blur-up lazyload" alt="cart">
                        <i class="ti-shopping-cart"></i>
                        <span class="badge badge-warning"><?php echo $booksOrder; ?></span>
                    </a>
                </div>
            </li>

        </ul>
    </div>
</div>

