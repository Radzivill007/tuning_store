jQuery(document).ready(function () {
  jQuery(".tel-input").inputmask({
    mask: "+7 (999) 999-99-99",
    autoUnmask: true,
    removeMaskOnSubmit: true,
  });
  jQuery("input[type=tel]").inputmask({
    mask: "+7 (999) 999-99-99",
    autoUnmask: true,
    removeMaskOnSubmit: true,
  });

  jQuery("#Slider").slick({
    nextArrow: '<button class="slider-next"></button>',
    prevArrow: '<button class="slider-prev"></button>',
    infinite: true,
    centerMode: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 400,
    arrows: false,
    buttons: false,
    touchThreshold: 50,
    swipeToSlide: true,
    dots: true,
  });

  jQuery(".vk-slider").slick({
    nextArrow: '<button class="slider-next alt"></button>',
      prevArrow: '<button class="slider-prev alt"></button>',
    infinite: true,
    centerMode: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    speed: 400,
    arrows: true,
    buttons: false,
    touchThreshold: 50,
    swipeToSlide: true,
    dots: false,
    responsive: [
      {
        breakpoint: 960,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  if (jQuery(window).width() > 960) {
    jQuery(".slider-alt").slick({
      nextArrow: '<button class="slider-next alt"></button>',
      prevArrow: '<button class="slider-prev alt"></button>',
      infinite: true,
      centerMode: false,
      slidesToShow: 4,
      slidesToScroll: 1,
      speed: 400,
      arrows: true,
      buttons: false,
      touchThreshold: 50,
      swipeToSlide: true,
      centerPadding: "40px",
      responsive: [
        {
          breakpoint: 1281,
          settings: {
            slidesToShow: 3,
          },
        },
      ],
    });
  }

  if (jQuery(window).width() > 960) {
    jQuery(".product__card-slider-big").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: jQuery(".product__card-slider-nav"),
      dots: false,
      arrows: false,
      centerPadding: "20px",
    });
  }
  if (jQuery(window).width() < 960) {
    jQuery(".product__card-slider-big").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      arrows: false,
      centerPadding: "20px",
    });
  }

  if (jQuery(window).width() > 960) {
    jQuery(".product__card-slider-nav").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      variableWidth: true,
      asNavFor: jQuery(".product__card-slider-big"),
      dots: false,
      arrows: false,
      responsive: [
        {
          breakpoint: 767,
          settings: "unslick",
        },
      ],
    });
  }

  jQuery(window).on("resize orientationChange", function (event) {
    jQuery("#Slider").slick("refresh");
    jQuery(".slider-alt").slick("refresh");
    jQuery(".product__card-slider-big").slick("refresh");
    jQuery(".product__card-slider-nav").slick("refresh");
  });

  //ajax изменение количества товара
  function addMinCount(selector, num) {
    var summ = 0;
    summ = parseInt(selector.val()) + num;
    selector.val(summ);
  }

  jQuery(document).on("click", ".input__count-add", function () {
    addMinCount(jQuery(this).siblings(".quantity").find(".qty"), 1);
    changeQty(jQuery(this).siblings(".quantity").find(".qty"));
  });
  jQuery(document).on("click", ".input__count-min", function () {
    addMinCount(jQuery(this).siblings(".quantity").find(".qty"), -1);
    changeQty(jQuery(this).siblings(".quantity").find(".qty"));
  });
  jQuery(document).on("change", ".woocommerce .qty", function () {
    changeQty(jQuery(this));
  });

  function changeQty(th) {
    var cart_item_key = th.attr("name"),
      product_id = th.attr("id");
    jQuery.ajax({
      type: "POST",
      dataType: "json",
      url: wc_add_to_cart_params.ajax_url,
      data: {
        action: "update_my_cart",
        product_id: product_id,
        cart_item_key: cart_item_key,
        quantity: th.val(),
      },
      success: function (response) {
        if (!response || response.error) return;

        var fragments = response.fragments;

        if (fragments) {
          jQuery.each(fragments, function (key, value) {
            jQuery(key).replaceWith(value);
          });
        }
      },
    });
  }

  jQuery(document).on("submit", ".woocommerce-cart-form", function (e) {
    e.preventDefault();
  });

  //ajax удаление товаров из корзины
  jQuery(document).on("click", ".mini-cart-item-remove", function (e) {
    e.preventDefault();

    var product_id = jQuery(this).attr("data-product_id"),
      cart_item_key = jQuery(this).attr("data-cart_item_key"),
      product_container = jQuery(this).parents(".mini-cart-item");

    product_container.block({
      message: null,
      overlayCSS: {
        cursor: "none",
      },
    });

    jQuery.ajax({
      type: "POST",
      dataType: "json",
      url: wc_add_to_cart_params.ajax_url,
      data: {
        action: "product_remove",
        product_id: product_id,
        cart_item_key: cart_item_key,
      },
      success: function (response) {
        if (!response || response.error) return;

        var fragments = response.fragments;

        if (fragments) {
          jQuery.each(fragments, function (key, value) {
            jQuery(key).replaceWith(value);
          });
        }
      },
    });
  });

  // добавление вариативного товара в корзину ajax
  jQuery(document).on("click", ".single_add_to_cart_button", function (e) {
    e.preventDefault();
    var variation_id = jQuery(".single_variation_wrap")
        .find("[name=variation_id]")
        .val(),
      product_id = jQuery(".woocommerce-variation-add-to-cart")
        .find("[name=product_id]")
        .val(),
      data = {
        action: "variable_prod",
        product_id: product_id,
        product_sku: "",
        quantity: 1,
        variation_id: variation_id,
      },
      thisbutton = jQuery(this);
    jQuery(document.body).trigger("adding_to_cart", [thisbutton, data]);
    jQuery.ajax({
      type: "POST",
      dataType: "json",
      url: wc_add_to_cart_params.ajax_url,
      data: data,
      success: function (response) {
        ym(52932514, "reachGoal", "addtocart");
        jQuery(".fix-msg").show();
        setTimeout(function () {
          jQuery(".fix-msg").hide();
        }, 3000);
        if (!response || response.error) return;

        var fragments = response.fragments;

        if (fragments) {
          jQuery.each(fragments, function (key, value) {
            jQuery(key).replaceWith(value);
          });
        }
      },
    });
  });

  function equivalent(elem) {
    var maxH = elem.eq(0).height();
    elem.each(function () {
      if (jQuery(this).height() > maxH) {
        maxH = jQuery(this).height();
      }
    });
    elem.height(maxH);
  }
  equivalent(jQuery(".equivalent"));
  equivalent(jQuery(".equivalent_catalog"));
  equivalent(jQuery(".product-category.product"));
  equivalent(jQuery(".equivalent_advantages"));
  equivalent(jQuery(".equivalent_model"));
  equivalent(jQuery(".my_products").children("li"));
  equivalent(jQuery(".catalog__items.catalog .products").children("li"));
  equivalent(jQuery(".catalog__items.marki .products").children("li"));

  jQuery(window).on("resize orientationChange", function (event) {
    equivalent(jQuery(".equivalent"));
    equivalent(jQuery(".equivalent_catalog"));
    equivalent(jQuery(".product-category.product"));
    equivalent(jQuery(".equivalent_model"));
    equivalent(jQuery(".my_products").children("li"));
    equivalent(jQuery(".catalog__items.catalog .products").children("li"));
    equivalent(jQuery(".catalog__items.marki .products").children("li"));
  });

  var search = jQuery("#NavSearch");
  var navBar = jQuery("#Navigation");
  if (jQuery(window).width() > 960) {
    function addMarginSearch() {
      search.css({ marginTop: `${navBar.outerHeight()}px` });
    }

    addMarginSearch();

    var oldScroll = 0;
    function fixedSearch() {
      if (oldScroll > jQuery(window).scrollTop()) {
        search.css({
          position: "fixed",
          top: `${navBar.outerHeight()}px`,
          marginTop: 0,
        });
        jQuery("main").css({
          marginTop: `${navBar.outerHeight() + search.outerHeight()}px`,
        });
      } else {
        search.css({
          position: "relative",
          top: "unset",
          marginTop: `${navBar.outerHeight()}px`,
        });
        jQuery("main").css({
          marginTop: `0px`,
        });
      }
      oldScroll = jQuery(window).scrollTop();
    }
    window.onscroll = function () {
      fixedSearch();
    };
  }

//  jQuery(window).on("resize orientationChange", function (event) {
  //  addMarginSearch();
    //fixedSearch();
  //});

  jQuery(".mobile_search").on("click", function () {
    jQuery("#NavSearch").slideToggle();
  });

  var catalog = jQuery(".catalog");
  if (jQuery(window).width() < 959) {
    catalog.find(".custom-btn").addClass("open");
    catalog.find(".catalog_inner").show();
  }
  // Открываем каталог
  catalog.on("click", function () {
    jQuery(this).find(".catalog_inner").slideToggle(250);
    //jQuery(this).find('button').toggleClass('open')
    jQuery(this).find(".toggler").toggleClass("open");
    if (jQuery(this).find(".toggler").hasClass("open")) {
      setTimeout(() => {
        jQuery(this).find("button").removeClass("open");
      }, 250);
    } else {
      jQuery(this).find("button").addClass("open");
    }
    setTimeout(() => {
      if (
        jQuery("#Menu").outerHeight() >
        jQuery(window).height() - jQuery("#Navigation").outerHeight()
      ) {
        jQuery("#Menu").addClass("height");
      } else jQuery("#Menu").removeClass("height");
    }, 251);
  });

  // Закрываем каталог при клике вне
  if (jQuery(window).width > 960) {
    jQuery(document).on("mouseup", function (e) {
      if (!catalog.is(e.target) && catalog.has(e.target).length === 0) {
        catalog.find(".catalog_inner").fadeOut(250);
        catalog.find("button").removeClass("open");
        catalog.find(".toggler").removeClass("open");
      }
    });
  }

  // На десктопе открываем всплывашку покупателю по наведению
  if (jQuery(window).width() > 960) {
    jQuery(".with_dropdown").hover(
      function () {
        jQuery(this)
          .addClass("open")
          .find(".dropdown")
          .stop(true, true)
          .fadeIn();
      },
      function () {
        jQuery(this)
          .removeClass("open")
          .find(".dropdown")
          .stop(true, true)
          .fadeOut();
      }
    );
  }

  if (jQuery(window).width() < 959) {
    jQuery(".with_dropdown").find(".dropdown").hide();
    jQuery(".with_dropdown").on("click", function () {
      jQuery(this)
        .toggleClass("open")
        .find(".dropdown")
        .stop(true, true)
        .slideToggle();
    });
  }

  jQuery(".with_dropdown_alt").find(".dropdown").hide();
  jQuery(".with_dropdown_alt").on("click", function () {
    jQuery(this)
      .toggleClass("open")
      .find(".dropdown")
      .stop(true, true)
      .slideToggle();
  });

  // Тогглер на мобиле
  if (jQuery(window).width() < 960) {
    jQuery("#Toggler").on("click", function () {
      jQuery("#Menu").slideToggle(250);
      jQuery(this).toggleClass("open");
    });
    setTimeout(() => {
      if (
        jQuery("#Menu").outerHeight() >
        jQuery(window).height() - jQuery("#Navigation").outerHeight()
      ) {
        jQuery("#Menu").addClass("height");
      } else jQuery("#Menu").removeClass("height");
    }, 251);
  }

  function animateTo(block) {
    var navHeight = jQuery("#Navigation").outerHeight();
    var searchHeight = jQuery("#NavSearch").outerHeight();
    jQuery("html, body").animate(
      {
        scrollTop: jQuery(block).offset().top - (navHeight + searchHeight),
      },
      500
    );
  }

  function showHide(
    block,
    btn,
    countDisplay,
    textToShow,
    textToHide,
    blockToScroll
  ) {
    jQuery(block)
      .children()
      .filter((i) => i + 1 > countDisplay)
      .hide();

    jQuery(btn).on("click", function () {
      if (jQuery(block).hasClass("all")) {
        jQuery(block)
          .removeClass("all")
          .children()
          .filter((i) => i + 1 > countDisplay)
          .fadeOut();
        jQuery(this).text(textToShow);
        animateTo(jQuery(blockToScroll));
      } else {
        jQuery(block).addClass("all").children().fadeIn();
        jQuery(this).text(textToHide);
      }
    });
  }

  // скрыть / показать категории
  var countCategoryDisplay = jQuery(window).width() < 960 ? 3 : 6;

  showHide(
    jQuery("#index_catalog").find(".row"),
    jQuery(".popular_section").find("button"),
    countCategoryDisplay,
    "Все категории",
    "Скрыть",
    jQuery(".popular_section")
  );

  // создаем список с табами из дефолтной таблицы вукомерса
  jQuery("table.variations tbody tr").each(function () {
    var label = jQuery(this).find("label")[0];
    jQuery(".wc_products_vatiants").append(`
    <ul class='${label.getAttribute("for")}'>
      <p class="title">${label.innerHTML}</p>
    </ul>
   `);
    jQuery(this)
      .find("select")
      .children()
      .filter((i) => i > 0)
      .map((i, item) => {
        jQuery(`.${label.getAttribute("for")}`).append(
          `<li class='${item.selected ? "active" : ""}'>${item.innerHTML}</li>`
        );
      });
  });

  // добавляем цену дефолтной вариации
  setTimeout(() => {
    jQuery(".wc_price")
      .children()
      .each(function () {
        if (
          jQuery(".single_variation_wrap").find("[name=variation_id]")[0]
            .defaultValue == jQuery(this).attr("data_id")
        ) {
          jQuery(this).show();
          jQuery(this).addClass("active");
        }
      });
  }, 1000);

  function checkStock () {
    const h1 = jQuery('h1')[0].innerHTML
    jQuery('.product-name').val(h1)
    if(jQuery('.stock.out-of-stock').length > 0) {
      jQuery('.product__card-btn-wrap').css('display', 'none')
      jQuery('.woocommerce-variation-add-to-cart')
        .append(`
          <div class="callback-button-wrap">
            <a 
              data-fancybox="" 
              href="#callback_with_product" 
              class="callback custom-btn"
            >
              Узнать о наличии
            </a>
          </div>
        `)
      jQuery('.product__card-instock span').map((i,item)=>{
        item.innerHTML = 'Нет в наличии'
      })
    }
    else {
      jQuery('.product__card-btn-wrap').css('display', 'flex')
      jQuery('.woocommerce-variation-add-to-cart').children().remove('.callback-button-wrap')
      jQuery('.product__card-instock span').map((i,item)=>{
        item.innerHTML = 'В наличии'
      })
    }
  }
  setTimeout(()=>{
    checkStock()
  },500)
  // переключаем таб по клику и меняем цену
  jQuery(document).on("click", ".wc_products_vatiants ul li", function () {
    setTimeout(()=>{
      checkStock()
    },100)
    jQuery(this).siblings().removeClass("active");
    jQuery(this).addClass("active");

    var text = jQuery(this).text();

    jQuery(".variations")
      .find("option")
      .each(function () {
        text == jQuery(this)[0].innerHTML &&
          (jQuery(this).prop("selected", !0), jQuery(this).trigger("change"));
      });
    jQuery(".wc_price")
      .children()
      .each(function () {
        jQuery(this).hide();
        jQuery(this).removeClass("active");
        if (
          jQuery(".single_variation_wrap").find("[name=variation_id]")[0]
            .defaultValue == jQuery(this).attr("data_id")
        ) {
          jQuery(this).show();
          jQuery(this).addClass("active");
        }
      });
  });

  jQuery(".single_add_to_cart_button").on("click", offerOrder);
  jQuery(".add_to_cart_button").on("click", offerOrder);
  function offerOrder() {
    jQuery("#offer-buy .btn").on("click", function () {
      jQuery.fancybox.close();
    });
    jQuery.fancybox.open({ src: "#offer-buy" });
    setTimeout(function () {
      jQuery.fancybox.close();
    }, 3000);
  }

  jQuery("#car-brand-search").on("input", function () {
    jQuery(".brands")
      .children()
      .each(function () {
        if (
          jQuery(this)
            .find("p")
            .text()
            .toLowerCase()
            .indexOf(jQuery("#car-brand-search").val().toLowerCase()) > -1
        ) {
          jQuery(this).css({ display: "flex" });
        } else {
          jQuery(this).css({ display: "none" });
        }
      });
  });

  jQuery(document).on("click", ".catalog__filter-btn", function () {
    jQuery(this).toggleClass("active");
    jQuery(this)
      .closest(".catalog__filter-item")
      .find(".catalog__filter-list")
      .slideToggle();
  });

  jQuery(document).on("click", ".catalog__filter-mob-btn", function () {
    jQuery(this).toggleClass("active");
    jQuery(".catalog__filter-item").slideToggle();
  });

  // if(jQuery(window).width() < 959) {
  //   jQuery('.catalog__filter-list').hide()
  //   jQuery('.catalog__filter-item').hide()
  // }

  jQuery(document).on("click", ".product__card-tab", function () {
    jQuery(".product__card-tab").removeClass("active");
    jQuery(this).toggleClass("active");
    jQuery(".product__card-tab-content").fadeOut();
    jQuery(".product__card-tab-content").eq(jQuery(this).index()).fadeIn();
  });
});
