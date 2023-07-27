<?php
// Deklrasi Konstants
const API_KEY = "6edba2b89e47f51daa4712c6187e4124";
const KOTA = "Jakarta";
const UNIT = "metric"; // nampilin suhu dalam satuan derajat celcius
const END_POINT = "https://api.openweathermap.org/data/2.5/forecast?q=" . KOTA . "&appid=" . API_KEY . "&units=" . UNIT;

// Main Proccess
echo "Weather Forecast: \n";
foreach (solveCuaca() as $s) {
    echo "$s \n";
}

function solveCuaca()
{
    // Http GET Content
    $response = file_get_contents(END_POINT);

    // Ubah Object Response Jadi Assosiative Array
    $data = json_decode($response, true);
    // Var Penampung Return Fiks
    $result = array();
    // Var Penampung Tanggal (Agar tidak duplikat)
    $processedDates = array();

    // if http code 200 OK
    if ($data['cod'] == 200) {

        $dataCuaca = $data['list'];

        // Foreach Result data
        foreach ($dataCuaca as $d) {

            // Ubah Format Date
            $dateFormat = date('d-M-Y', $d['dt']);

            // If date format ada pada pada arr 5 hari kedepan && tidak ada pada $processedDates (tidak ada duplikasi tanggal)
            if (in_array($dateFormat, getNextFiveDayFromNow()) && !in_array($dateFormat, $processedDates)) {
                $day = date('D', strtotime($dateFormat));
                $suhu = $d['main']['temp'];
                // Format Jawaban
                array_push($result, "$day, $dateFormat: $suhu °C");

                // Tandai tanggal ini sebagai telah diproses
                array_push($processedDates, $dateFormat);
            }
        }
    }

    // Return
    return $result;
}

// Fungsi untuk mereturn array 5 hari kedepan dari sekarang
function getNextFiveDayFromNow(): array
{
    $today = date('d-M-Y');
    $result = array();

    for ($i = 1; $i <= 5; $i++) {
        $nextDate = date('d-M-Y', strtotime("$today +$i days"));
        array_push($result, $nextDate);
    }

    return $result;
}
