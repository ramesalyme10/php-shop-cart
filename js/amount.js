$(document).ready(function () {
  $(document).on("click", ".filter-sale li", function (e) {
    e.preventDefault();
    var $grid = $(".grid").isotope({
      itemSelector: ".card",
      layoutMode: "fitRows",
    });
    var self = $(this);
    $(".filter-sale li").removeClass("active");
    self.addClass("active");

    var selector = $(this).attr("data-filter");
    $grid.isotope({ filter: selector });
  });

  // carousel
  $(".responsive").slick({
    dots: true,
    infinite: true,
    centerMode: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $(document).on("submit", "#form", function (e) {
    e.preventDefault();
    $.ajax({
      url: "post.php",
      type: "POST",
      data: new FormData(this),

      contentType: false,
      cache: false,
      processData: false,

      success: function (data) {
        window.location.href = "shop.php";
      },
    });
  });

  //  Add posts

 

  //  single products
  $(document).on("click", "#single_btn", function (e) {
    e.preventDefault();
    var single_id = $(this).attr("rel");

    $.ajax({
      type: "GET",
      url: `single.php`,

      success: function (data) {
        $("#single").append(data);
        window.location.href = `single.php?single_id=${single_id}`;
      },
    });
  });

  //  delete products
  $(document).on("click", "#delete_btn", function (e) {
    e.preventDefault();
    var self = $(this);
    var delete_id = self.attr("rel");

    $.ajax({
      type: "GET",
      url: "shop.php",
      data: {
        delete_id: delete_id,
      },

      success: function (data) {
        if (confirm("Are you sure you want to delete this products?")) {
          self.closest(".card").fadeOut(500);
        }
      },
    });
  });

  // Search Products

  $(document).on("click", "#search_btn", function (e) {
    e.preventDefault();
    var search_name = $("#search").val();
    var action = "search"
    $.ajax({
      type: "POST",
      url: "fetch.php",
      data: {
        search_name:search_name,
        action:action,
      },
      // dataType: "json",
      success: function (data) {
         
         $('#posts').html(data)
      }
    });
   

   
  });

  // update products

  $(document).on("click", "#update_btn", function (e) {
    e.preventDefault();
    var edit_id = $(this).attr("rel");

    $.ajax({
      type: "POST",
      url: `update.php`,

      success: function (data) {
        window.location.href = `update.php?edit_id=${edit_id}`;
      },
    });
  });

  // add to cart
  $(document).on("click", "#save", function (e) {
    e.preventDefault();
    var form = $(this).closest(".card-body-icons");
    let image = $(form).find("#image").val();
    let name = $(form).find("#name").val();
    let description = $(form).find("#description").val();
    let price = $(form).find("#price").val();
    let quantity = $(form).find("#quantity").val();
    let action = "add";

    $.ajax({
      type: "POST",
      url: "shop.php",
      data: {
        image: image,
        name: name,
        description: description,
        price: price,
        quantity: quantity,
        action: action,
      },

      success: function (data) {
        window.location.reload();
        alert("Products  added Successfully to cart?");
      },
    });
  });

  // delete product from carts

  $(document).on("click", "#delete_items", function (e) {
    e.preventDefault();
    let self = $(this);
    let cartsID = self.attr("rel");
    let action = "remove";
    if (confirm("Are you sure you want to remove this product?")) {
      $.ajax({
        method: "POST",
        url: "carts.php",
        data: {
          cartsID: cartsID,
          action: action,
        },

        success: function (data) {
          self.closest("tr").hide(1000);
        },
      });
    }
  });

  //  Remove All

  $(document).on("click", "#Remove_all", function (e) {
    e.preventDefault();

    var self = $(this);
    let action = "clear-all";
    $.ajax({
      type: "POST",
      url: "carts.php",
      data: {
        action: action,
      },
      success: function (data) {
        self.closest(".header-table").fadeOut(500);
        window.location.reload();
      },
    });
  });

  //  Delete Items From Carts

  $(document).on("click", "#del_cart", function (e) {
    e.preventDefault();
    var self = $(this);
    var delete_id = self.attr("rel");
    var action = "delete";

    $.ajax({
      type: "POST",
      url: "carts.php",
      data: {
        delete_id: delete_id,
        action: action,
      },

      success: function (data) {
        if (confirm("Are you sure you want to delete this products?")) {
          self.closest("tr").fadeOut(500);
          window.location.reload();
        }
      },
    });
  });

  //  increment_btn quantity

  $(document).on("click", "#increment_btn", function (e) {
    e.preventDefault();
    let qty = $(this).closest("tr").find("#input_qty").val();
    let value = parseInt(qty, 20);
    value = isNaN(value) ? 0 : value;
    if (value < 20) {
      value++;
      $(this).closest("tr").find("#input_qty").val(value);
    }
  });

  //  decrement_btn quantity

  $(document).on("click", "#decrement_btn ", function (e) {
    e.preventDefault();
    let qty = $(this).closest("tr").find("#input_qty").val();
    let value = parseInt(qty, 20);
    value = isNaN(value) ? 0 : value;
    if (value < 20) {
      value--;
      $(this).closest("tr").find("#input_qty").val(value);
    }
  });

  $(document).on("click", ".updateQty", function (e) {
    e.preventDefault();
      let qty = $(this).closest('tr').find('#input_qty').val()
      let qty_id = $(this).closest('tr').find('#qty_id').val()
      let action = "add_qty"
     
      $.ajax({
        type: "Post",
        url: "carts.php",
        data: {
          qty:qty,
          qty_id:qty_id,
          action:action
        },
       
        success: function (data) {
           alert("Quantity has been added Successfully")
           window.location.reload();
        }
      });
  });



  $(document).on('click', '#bars_btn',function(e){
     e.preventDefault()
     $('#times_btn').removeClass('times')
      $(this).addClass('bars')
      $('#drop').addClass('dropdown-items-active')
    
     
  })


  $(document).on('click', '#times_btn',function(e){
    e.preventDefault()
    $('#bars_btn').removeClass('bars')
     $(this).addClass('times')

     $('#drop').removeClass('dropdown-items-active')
 })





  // Pagination
   showCase()
   function showCase(page){
    
       $.ajax({
        type: "POST",
        url: "pagination.php",
        data:{
          page_num:page,
        },
        success: function (data) {
            $('#posts').html(data)
        }
       });
   }


  $(document).on('click', '.pagination a ', function(e){
      e.preventDefault()
     var page = $(this).attr('id')
     showCase(page)
       
  })


  // single add to cart

  $(document).on('click', '.btn_cart',function(e){
      e.preventDefault()
      var form = $(this).closest('#form')
      var image = form.find('#image').val();
      var name = form.find('#name').val();
      var description = form.find('#description').val();
      var price = form.find('#price').val();
      var quantity = form.find('#quantity').val();
      var action = "single"
      
    $.ajax({
      type: "POST",
      url: "single_add_products.php",
      data: {
        image: image,
        name: name,
        description: description,
        price: price,
        quantity: quantity,
        action: action,
      },

      success: function (data) {
        window.location.reload();
        alert("Products  added Successfully to cart?");
        $('#add-cart').html(data)
      },
    });

     
  })

   


});
