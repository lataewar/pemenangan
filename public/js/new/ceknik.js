$("#ceknik").on("click", function (e) {
  e.preventDefault();

  const url = $("#ceknik_url").val();
  const nik = $("#nik").val();

  if (nik) ajax_call(url, nik);
});

const ajax_call = function (url, nik) {
  // show spinner in button
  $("#ikon").hide();
  $("#ceknik").addClass("spinner spinner-white spinner-left");

  $.ajax({
    type: "post",
    url: url,
    data: {
      nik,
    },
    dataType: "json",
    success: function (response) {
      dataAlert(response);
    },
    error: function (xhr, thrownError) {
      loader("hide", 400);
      if (xhr.status === 422) {
        sweetAlert(
          "Validasi gagal",
          JSON.parse(xhr.responseText).message,
          "error"
        );
      } else if (xhr.status === 404) {
        sweetAlert(
          "Tidak ditemukan",
          "NIK tersebut tidak ditemukan.",
          "warning"
        );
      } else {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    },
    complete: function () {
      // remove spinner in button
      $("#ikon").show();
      $("#ceknik").removeClass("spinner spinner-white spinner-left");
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
};

const dataAlert = function (response) {
  Swal.fire({
    icon: "success",
    title: response.data.nama,
    html: "Apakah anda yakin akan menggunakan data ini?",
    showCancelButton: true,
    confirmButtonText: "Gunakan",
    cancelButtonText: "Batal",
    customClass: {
      confirmButton: "btn btn-primary",
      cancelButton: "btn btn-danger",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      $("#nama").val(response.data.nama);
      $("#desc").val(response.data.alamat_tps);

      if (response.locs.kabupatens) {
        $("#selector1").html(response.locs.kabupatens);

        if (response.locs.kecamatans) {
          $("#selector2").html(response.locs.kecamatans);

          if (response.locs.kelurahans) {
            $("#selector3").html(response.locs.kelurahans);

            if (response.locs.tpss) {
              $("#selector4").html(response.locs.tpss);
            }
          }
        }
      }
    }
  });
};
