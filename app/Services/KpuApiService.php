<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KpuApiService
{
  public function getdata(string $nik)
  {
    // $nik = "7471092308910002";
    // $nik = "7471092308910002";
    // $nik = "7471100106920001";
    $token = "03AFcWeA5J42iK1CDxZsYOmmDH8kx_RE-5TBs3-Vk1o0OHbLBi4TX1h10tntyY-R-HPd2ylLhqOTu5k9FwdLr6V3tL-OCvzXoNZz62Lo0KxHZ7skKGnCWO4wtRqy91XIuqEAx9icVBXhsb02RrNWyrt6KXarGVVKmGzOjbLheyqIyTK_U6CJj5K6HAUPIzBVEN7hkGQR9HTce4n0yUgIyyeOhFOb9uRLlATxEGsQJjm9xfLQT_zSVrkrLeYLDwGmeFbN219yvpmQLbm6cirta_8YW5ntG_z4Z7Kq3RlZsz9OmQzVT62zvxN8ylCjeg1KK5xAR_JHCAk8gK4Had11TwH4lZL5XUQ6UuEtZj4tGcgOPw-TBvF80Mzh0S3DOeeM5aaf0PJUDpfLcf0BKx_wWfz4DpVmQplT3lF2EMdokrWwlddccpjRSZSqVAg-QzP_Cfq-WQtTKs-k5d99vAkPSC_fQEO_wU3qdfoWHHtGJCQG893JC75gWqBTiPC_MJnphsKEdw7plW254hZgUY8Rv-BuEPhzkulvC3mhW3coYA0P2D7RQP7nnsjNiz9SKP2GQ0p5aoZ-qa7zrbyeBiY-LTpjnll3pKpxlzYOSrS0DfJwEwE3Bs1yDcB5Q";
    $body = '{"query":"\n                {\n                  findNikSidalih (\n                      nik:\"' . $nik . '\",\n                      wilayah_id:0,\n                      token:\"' . $token . '\",\n                    ){\n                    nama,\n                    nik,\n                    nkk,\n                    jenis_kelamin,\n                    provinsi,\n                    kabupaten,\n                    kecamatan,\n                    kelurahan,\n                    tps,\n                    alamat,\n                    lat,\n                    lon,\n                    lhp {\n                          nama,\n                          nik,\n                          nkk,\n                          jenis_kelamin,\n                          kecamatan,\n                          kelurahan,\n                          tps,\n                          id,\n                          flag,\n                          source,\n                          alamat,\n                          lat,\n                          lon\n                    }\n                  }\n                }\n              "}';
    $content_type = 'application/json; charset=utf-8';
    $headers = [
      'Content-Type' => $content_type,
      'Cookie' => 'cookiesession1=678B2869UV01234589890124ABCDC5FD',
      'Host' => 'cekdptonline.kpu.go.id',
      'Origin' => 'https://cekdptonline.kpu.go.id',
    ];

    $response = Http::withBody($body, $content_type)
      ->withHeaders($headers)
      ->acceptJson()
      ->post('https://cekdptonline.kpu.go.id/apilhp');

    abort_unless($response->successful(), $response->status(), "Invalid request");
    abort_unless(empty($response->json()['errors']), 404, "Data not found");

    $json = $response->json()['data']['findNikSidalih'];

    return [
      'nama' => $json['nama'],
      'kabupaten' => $json['kabupaten'],
      'kecamatan' => $json['kecamatan'],
      'kelurahan' => $json['kelurahan'],
      'tps' => $json['tps'],
      'alamat_tps' => $json['alamat'],
      'id_tps' => $json['lhp'][0]['id'],
      'lat' => $json['lat'],
      'lon' => $json['lon'],
    ];
  }

  public function removestring(string $string)
  {
    $remove = ['Kota ', 'Kabupaten ', 'KOTA ', 'KABUPATEN ', 'Kecamatan ', 'KECAMATAN ', 'Kelurahan ', 'KELURAHAN ', 'Desa ', 'DESA '];
    return str_replace($remove, "", $string);
  }
}
