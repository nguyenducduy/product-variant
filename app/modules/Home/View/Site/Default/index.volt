{% extends "../../Core/View/Layout/Default/site-main.volt" %}

{% block content %}
<div id="content">
    <div class="banner-advert">
        <div class="wrap-item">
            {% if hot|length > 0 %}
                {% for h in hot %}
                    <div class="item">
                        <div class="container">
                            <div class="content-banner-advert">
                                <div class="advert-image">
                                    <img src="{{ static_url(h.getMediumImage()) }}" alt="" />
                                </div>
                                <div class="advert-text">
                                    <span>{{ h.name }}</span>
                                    <h3>Chỉ còn <strong>{{ number_format(h.sellprice) }} &#8363;</strong></h3>
                                    <a href="{{ url('san-pham/' ~ h.slug) }}" class="shop-now">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                {% endfor %}
            {% endif %}
        </div>
    </div>
    <!-- End Banner Advert -->
    <div class="product-tab-slider">
        <div class="container">
            <div class="title-tab-slider">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="aothai" href="#aothai">Áo thái</a></li>
                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="hangxuatkhau" href="#hangxuatkhau">Hàng xuất khẩu</a></li>
                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="hangquangchau" href="#hangquangchau">Hàng Quảng Châu</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="aothai">
                    <div class="content-tab-product single-arrow">
                        <div class="wrap-item">
                            {% if aothai|length > 0 %}
                                {% for thai in aothai %}
                                <div class="item">
                                    <div class="item-product product-lower">
                                        <div class="item-product-thumb item-thumb-product">
                                            <a href="#"><img alt="" src="{{ static_url(thai.getThumbnailImage()) }}"></a>
                                            <div class="info-product-cart">
                                                <div class="inner-info-product-cart">
                                                    <ul>
                                                        <li><a href="#" class="link-wishlist"><i class="fa fa-camera"></i></a></li>
                                                        <li><a href="#" class="link-quick-view"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="#" class="link-compare"><i class="fa fa-facebook"></i></a></li>
                                                    </ul>
                                                    <a href="#" class="link-product-add-cart">Thêm vào giỏ</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-product-info">
                                            <h3 class="title-product"><a href="{{ url('san-pham/' ~ thai.slug) }}">{{ thai.name }}</a></h3>
                                            <div class="info-product-price">
                                                <span>{{ number_format(thai.sellprice) }} &#8363;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {% endfor %}
                            {% else %}
                                Data not found
                            {% endif %}
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ url('danh-muc/ao-thai') }}" style="margin: 0 10px;padding-top:10px;display:block;">Xem tất cả &nbsp;<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="hangxuatkhau">
                    <div class="content-tab-product single-arrow">
                        <div class="wrap-item">
                            {% for xuatkhau in hangxuatkhau %}
                            <div class="item">
                                <div class="item-product product-lower">
                                    <div class="item-product-thumb item-thumb-product">
                                        <a href="#"><img alt="" src="{{ static_url(xuatkhau.getThumbnailImage()) }}"></a>
                                        <div class="info-product-cart">
                                            <div class="inner-info-product-cart">
                                                <ul>
                                                    <li><a href="#" class="link-wishlist"><i class="fa fa-camera"></i></a></li>
                                                    <li><a href="#" class="link-quick-view"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="#" class="link-compare"><i class="fa fa-facebook"></i></a></li>
                                                </ul>
                                                <a href="#" class="link-product-add-cart">Thêm vào giỏ</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-product-info">
                                        <h3 class="title-product"><a href="{{ url('san-pham/' ~ xuatkhau.slug) }}">{{ xuatkhau.name }}</a></h3>
                                        <div class="info-product-price">
                                            <span>{{ number_format(xuatkhau.sellprice) }} &#8363;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {% endfor %}
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ url('danh-muc/hang-xuat-khau') }}" style="margin: 0 10px;padding-top:10px;display:block;">Xem tất cả &nbsp;<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="hangquangchau">
                    <div class="content-tab-product single-arrow">
                        <div class="wrap-item">
                            {% if hangquangchau|length > 0 %}
                                {% for quangchau in hangquangchau %}
                                <div class="item">
                                    <div class="item-product product-lower">
                                        <div class="item-product-thumb item-thumb-product">
                                            <a href="#"><img alt="" src="{{ static_url(quangchau.getThumbnailImage()) }}"></a>
                                            <div class="info-product-cart">
                                                <div class="inner-info-product-cart">
                                                    <ul>
                                                        <li><a href="#" class="link-wishlist"><i class="fa fa-camera"></i></a></li>
                                                        <li><a href="#" class="link-quick-view"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="#" class="link-compare"><i class="fa fa-facebook"></i></a></li>
                                                    </ul>
                                                    <a href="#" class="link-product-add-cart">Thêm vào giỏ</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-product-info">
                                            <h3 class="title-product"><a href="{{ url('san-pham/' ~ quangchau.slug) }}">{{ quangchau.name }}</a></h3>
                                            <div class="info-product-price">
                                                <span>{{ number_format(quangchau.sellprice) }} &#8363;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {% endfor %}
                            {% else %}
                                Data not found.
                            {% endif %}
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ url('danh-muc/hang-quang-chau') }}" style="margin: 0 10px;padding-top:10px;display:block;">Xem tất cả &nbsp;<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Tab Slider -->
    <div class="category-tab-slider">
        <div class="container">
            <div class="inner-category-tab-slider">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="sidebar-category-tab">
                            <h2 class="title-category-tab">Thời trang nữ</h2>
                            <div class="clearfix">
                                <div class="list-title-tab-category">
                                    <ul class="nav nav-tabs" role="tablist">
                                        {% if thoitrangnu|length > 0 %}
                                            {% for index,item in thoitrangnu %}
                                                <li role="presentation" {% if index == 0 %}class="active"{% endif %}><a href="#{{ 'thoitrangnu_' ~ item.id }}" aria-controls="{{ 'thoitrangnu_' ~ item.id }}" role="tab" data-toggle="tab">{{ item.name }}</a></li>
                                            {% endfor %}
                                        {% endif %}
                                    </ul>
                                </div>
                                <div class="brand-cat-slider four-item">
                                    <div class="vertical-slider">
                                        <ul>
                                            <li>
                                                <a href="#"><img src="public/assets/default/images/home_3/cate-women.png" alt="" /></a>
                                            </li>
                                            <li>
                                                <a href="#"><img src="public/assets/default/images/home_3/hat.png" alt="" /></a>
                                            </li>
                                            <li>
                                                <a href="#"><img src="public/assets/default/images/home_3/short.png" alt="" /></a>
                                            </li>
                                            <li>
                                                <a href="#"><img src="public/assets/default/images/home_3/shoes.png" alt="" /></a>
                                            </li>
                                            <li>
                                                <a href="#"><img src="public/assets/default/images/home_3/cate-women.png" alt="" /></a>
                                            </li>
                                            <li>
                                                <a href="#"><img src="public/assets/default/images/home_3/hat.png" alt="" /></a>
                                            </li>
                                            <li>
                                                <a href="#"><img src="public/assets/default/images/home_3/short.png" alt="" /></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="jcaroul-control-nav">
                                        <a class="prev" href="#">prev</a>
                                        <a class="next" href="#">next</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="tab-content">
                            {% if thoitrangnu|length > 0 %}
                                {% set ttnImages = [] %}
                                {% for index,item in thoitrangnu %}
                                <div role="tabpanel" class="tab-pane {% if index == 0 %}active{% endif %}" id="{{ 'thoitrangnu_' ~ item.id }}">
                                    <div class="category-tab-content clearfix">
                                        {% for index, p in item.getProduct() %}
                                            {% if index == 0 %}
                                                <div class="category-tab-main">
                                                    <div class="item-product product-lower">
                                                        <div class="item-product-thumb">
                                                            <a href="{{ url('san-pham/' ~ p.slug) }}"><img alt="" src="{{ static_url(p.getMediumImage()) }}"></a>
                                                        </div>
                                                        <div class="item-product-info">
                                                            <h3 class="title-product"><a href="#">{{ p.name }}</a></h3>
                                                            <div class="info-product-price">
                                                                <span>{{ number_format(p.sellprice) }} &#8363;</span>
                                                            </div>
                                                        </div>
                                                        <div class="product-extra-link">
                                                            <a class="link-add-to-cart" href="#">Thêm vào giỏ</a>
                                                            <a class="link-compare" href="#">Xem tất cả</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            {% else %}
                                                <div class="category-tab-single">
                                                    <div class="item-product product-lower">
                                                        <div class="item-product-thumb item-thumb-product">
                                                            <a href="#"><img alt="" src="public/assets/default/images/home_3/p5.png"></a>
                                                            <div class="info-product-cart">
                                                                <div class="inner-info-product-cart">
                                                                    <ul>
                                                                        <li><a class="link-wishlist" href="#"><i class="fa fa-heart"></i></a></li>
                                                                        <li><a class="link-quick-view" href="#"><i class="fa fa-search"></i></a></li>
                                                                        <li><a class="link-compare" href="#"><i class="fa fa-external-link-square"></i></a></li>
                                                                    </ul>
                                                                    <a class="link-product-add-cart" href="#">Add to cart</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-product-info">
                                                            <h3 class="title-product"><a href="#">Chemise SLimFon</a></h3>
                                                            <div class="info-product-price">
                                                                <span>$45.99</span> <del>$69.71</del>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {% endif %}
                                        {% endfor %}
                                    </div>
                                </div>
                                {% endfor %}
                            {% endif %}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Category Tab Slider -->
    <div class="shop-the-look">
        <div class="shop-the-look-banner">
            <div class="container">
                <div class="shop-the-look-banner-text">
                    <h2>Thời trang cặp</h2>
                    <h4>Quần áo nam nữ cho tình nhân</h4>
                    <a href="#" class="shop-here">Xem tất cả</a>
                </div>
            </div>
        </div>
        <div class="shop-the-look-post">
            <div class="container">
                <div class="row">
                    {% if thoitrangcap|length > 0 %}
                        {% for tc in thoitrangcap %}
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="item-shop-the-look-post">
                                    <div class="inner-item-shop-post">
                                        <img src="{{ static_url(tc.getThumbnailImage()) }}" alt="" />
                                        <div class="item-shop-post-text">
                                            <h2><span>{{ number_format(tc.sellprice) }} &#8363;</span></h2>
                                            <a href="#">Mua ngay</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {% endfor %}
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
{% endblock %}
