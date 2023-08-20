var check = false;

function changeVal(el) {
  var qt = parseFloat(el.parent().children(".qt").html());
  var price = parseFloat(el.parent().children(".price").html());
  var eq = Math.round(price * qt * 100) / 100;

  el.parent()
    .children(".full-price")
    .html(eq + " JOD");

  changeTotal();
}

function changeTotal() {
  var price = 0;
  $(".full-price").each(function (index) {
    price += parseFloat(parseInt($(".full-price").eq(index).html()));

  });

  price = Math.round(price * 100) / 100;
  $(".sub").val(price);
  console.log($(".sub").val());
  console.log($(".full").val());
  var tax = Math.round(price * 0.16 * 100) / 100;
  var shipping = parseFloat($(".shipping span").html());
  var fullPrice = Math.round((price + tax + shipping) * 100) / 100;

  $(".full").val(fullPrice);
  $(".shipping").val(shipping);
  if (price == 0) {
    fullPrice = 0;
  }
console.log(price)
  $(".subtotal span").html(price);
  
  $(".tax span").html(tax);
  $(".total span").html(fullPrice);
}
changeTotal();

$(document).ready(function () {
  $(".remove").click(function () {
    var el = $(this);
    el.parent().parent().addClass("removed");
    window.setTimeout(function () {
      el.parent()
        .parent()
        .slideUp("fast", function () {
          el.parent().parent().remove();
          if ($(".product").length == 0) {
            if (check) {
              $("#cart").html(
                "<h1>The shop does not function, yet!</h1><p>If you liked my shopping cart, please take a second and heart this Pen on <a href='https://codepen.io/ziga-miklic/pen/xhpob'>CodePen</a>. Thank you!</p>"
              );
            } else {
              $("#cart").html("<h1>No products!</h1>");
            }
          }
          changeTotal();
        });
    }, 200);
  });
  $(".qt-plus").click(function () {
    $(this)
      .parent()
      .children(".qt")
      .html(parseInt($(this).parent().children(".qt").html()) + 1);

    var hiElement = $(this).siblings(".hi");
    // console.log(hiElement.value);
    console.log(hiElement.val());
    console.log;
    var currentQt = parseInt(hiElement.val());
    var newQt = currentQt + 1;
    hiElement.val(newQt);

    $(this).parent().children(".full-price").addClass("added");

    var el = $(this);
    window.setTimeout(function () {
      el.parent().children(".full-price").removeClass("added");
      changeVal(el);
    }, 150);
  });
  $(this).parent().children(".full-price").addClass("added");

  var el = $(this);
  window.setTimeout(function () {
    el.parent().children(".full-price").removeClass("added");
    changeVal(el);
  }, 150);
  $(".qt-minus").click(function () {
    child = $(this).parent().children(".qt");
    var hiElement = $(this).siblings(".hi");
    // console.log(hiElement.value);
    console.log(hiElement.val());
    console.log;
    var currentQt = parseInt(hiElement.val());
    var newQt = currentQt;
    hiElement.val(newQt);
    if (parseInt(child.html()) > 1) {
      var newQt = currentQt - 1;
      hiElement.val(newQt);
      child.html(parseInt(child.html()) - 1);
    }

    $(this).parent().children(".full-price").addClass("minused");

    var el = $(this);
    window.setTimeout(function () {
      el.parent().children(".full-price").removeClass("minused");
      changeVal(el);
    }, 150);
  });

  window.setTimeout(function () {
    $(".is-open").removeClass("is-open");
  }, 1200);

  $(".btn").click(function () {
    check = true;
    $(".remove").click();
  });
});
