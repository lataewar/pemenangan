const selectCalon = function (item) {
  const id = item.split("-|-")[0];
  const name = item.split("-|-")[1];
  Swal.fire({
    title: `Konfimasi pilihan anda`,
    text: name,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "##3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Pilih",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      ajaxCall(
        urx + "/pilih/" + id,
        "post",
        { id, name },
        "json",
        function () {
          loader("show");
        },
        function () {
          loader("hide");
        },
        function (response) {
          succeedRes(response, 0);
        }
      );
    }
  });
};
