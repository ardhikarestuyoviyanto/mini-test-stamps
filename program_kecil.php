<?php

echo solve();

function solve(): string
{
    // init array
    $data = array();

    // loop 100 s.d 1
    for ($i = 100; $i >= 1; $i--) {
        // if is prime maka diizinkan
        if (!isPrime($i)) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                // Ganti angka yang dapat dibagi dengan angka 3 dan 5 dengan text "FooBar".
                array_push($data, "FooBar");
            } elseif ($i % 3 == 0) {
                // Ganti angka yang dapat dibagi dengan angka 3 dengan text "Foo".
                array_push($data, "Foo");
            } elseif ($i % 5 == 0) {
                // Ganti angka yang dapat dibagi dengan angka 5 dengan text "Bar".
                array_push($data, "Bar");
            } else {
                // Else Apppend Value
                array_push($data, $i);
            }
        }
    }

    // Init String Return
    $result = "";

    // Loop Hasil Var $data
    for ($i = 0; $i < count($data); $i++) {
        // Gabungkan String
        $result .= $data[$i];
        // Cek Kondisi Setelah Gabungkan String
        // Tambahkan String ,
        if ($i != count($data) - 1) {
            // Jika Berada di index terakhir
            // Abaikan String ,
            $result .= ", ";
        }
    }

    // Return Hasil
    return $result;
}

// Cek Bilangan Prima (Bool Return)
function isPrime($number): bool
{
    // < 1 bukan prima
    if ($number <= 1) {
        return false;
    }

    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }

    return true;
}
