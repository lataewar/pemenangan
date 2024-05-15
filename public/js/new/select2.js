function dataKec() {
  var kec_url = $("#kec_url").val();
  $("#selector2").change(function (e) {
    $.ajax({
      type: "post",
      url: kec_url,
      data: {
        kab: $(this).val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.data) {
          $("#selector1").html(response.data);
          $("#selector1").select2({
            placeholder: "Pilih salah satu...",
          });
        }
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      error: function (xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    });
  });
}

const getSelected = function (routeX) {
  const selector = $("#selector1").val();
  if (selector) {
    location.href = routeX + "/" + selector;
  }
};
