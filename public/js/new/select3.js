function selector() {
  var kec_url = $("#kec_url").val();
  var kel_url = $("#kel_url").val();
  $("#selector1").change(function (e) {
    $.ajax({
      type: "post",
      url: kec_url,
      data: {
        kab: $(this).val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.data) {
          $("#selector2").html(response.data);
          $("#selector2").select2({
            placeholder: "Pilih salah satu...",
          });
          $("#selector3").html(
            "<option value='' hidden>Pilih salah satu ...</option>"
          );
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

  $("#selector2").change(function (e) {
    $.ajax({
      type: "post",
      url: kel_url,
      data: {
        kec: $(this).val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.data) {
          $("#selector3").html(response.data);
          $("#selector3").select2({
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
