// Class definition
var KTSelect2 = (function () {
  // Private functions
  var demos = function () {
    // loading remote data
    var tps_url = $("#tps_url").val();

    function formatRepo(repo) {
      var kels = repo.skel == "Desa" ? repo.skel : "Kel.";
      var kabs = repo.skab == "Kota" ? repo.skab : "Kab.";
      if (repo.loading) return repo.text;
      var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='font-weight-bold text-primary mb-1'>" +
        "TPS " +
        repo.name +
        "</div>";
      markup += "<div class='select2-result-repository__statistics'>";
      if (repo.alamat) {
        markup +=
          "<div class='select2-result-repository__description'>&nbsp;<i class='fas fa-map-marker-alt'></i>&nbsp; " +
          repo.alamat +
          "</div>";
      }
      markup +=
        "<div class='ml-7 text-muted'> " +
        kels +
        " " +
        repo.kelurahan +
        " - Kec. " +
        repo.kecamatan +
        " - " +
        kabs +
        " " +
        repo.kabupaten +
        " </div>" +
        "</div>" +
        "</div></div>";
      return markup;
    }

    function formatRepoSelection(repo) {
      return repo.name || repo.text;
    }

    $("#kt_select2_6").select2({
      placeholder: "Pilih TPS",
      allowClear: true,
      ajax: {
        // url: "https://api.github.com/search/repositories",
        url: tps_url,
        dataType: "json",
        delay: 350,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page,
          };
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;

          return {
            results: data.items,
            pagination: {
              more: params.page * 15 < data.total_count,
            },
          };
        },
        cache: true,
      },
      escapeMarkup: function (markup) {
        return markup;
      }, // let our custom formatter work
      minimumInputLength: 2,
      templateResult: formatRepo, // omitted for brevity, see the source of this page
      templateSelection: formatRepoSelection, // omitted for brevity, see the source of this page
    });
  };

  // Public functions
  return {
    init: function () {
      demos();
    },
  };
})();

// Initialization
jQuery(document).ready(function () {
  KTSelect2.init();
});
