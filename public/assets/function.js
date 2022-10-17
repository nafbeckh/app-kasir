function indo_date(x) {
    let bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
    let a = moment(x).format("DD")
    let b = moment(x).format("M")
    let c = moment(x).format("YYYY")
    return a + ' ' + bulan[b - 1] + ' ' + c
}

function indo_date_new(x) {
    let bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
    let a = moment(x).format("DD")
    let b = moment(x).format("M")
    let c = moment(x).format("YYYY")
    return a + ' ' + bulan[b - 1] + ' ' + c
}

function harga(x) {
    return parseInt(x).toLocaleString('en-US')
}

function terbilang(bilangan) {

    bilangan = String(bilangan);
    var angka = new Array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
    var kata = new Array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
    var tingkat = new Array('', 'Ribu', 'Juta', 'Milyar', 'Triliun');

    var panjang_bilangan = bilangan.length;

    /* pengujian panjang bilangan */
    if (panjang_bilangan > 15) {
        kaLimat = "Diluar Batas";
        return kaLimat;
    }

    /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
    for (i = 1; i <= panjang_bilangan; i++) {
        angka[i] = bilangan.substr(-(i), 1);
    }

    i = 1;
    j = 0;
    kaLimat = "";


    /* mulai proses iterasi terhadap array angka */
    while (i <= panjang_bilangan) {

        subkaLimat = "";
        kata1 = "";
        kata2 = "";
        kata3 = "";

        /* untuk Ratusan */
        if (angka[i + 2] != "0") {
            if (angka[i + 2] == "1") {
                kata1 = "Seratus";
            } else {
                kata1 = kata[angka[i + 2]] + " Ratus";
            }
        }

        /* untuk Puluhan atau Belasan */
        if (angka[i + 1] != "0") {
            if (angka[i + 1] == "1") {
                if (angka[i] == "0") {
                    kata2 = "Sepuluh";
                } else if (angka[i] == "1") {
                    kata2 = "Sebelas";
                } else {
                    kata2 = kata[angka[i]] + " Belas";
                }
            } else {
                kata2 = kata[angka[i + 1]] + " Puluh";
            }
        }

        /* untuk Satuan */
        if (angka[i] != "0") {
            if (angka[i + 1] != "1") {
                kata3 = kata[angka[i]];
            }
        }

        /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
        if ((angka[i] != "0") || (angka[i + 1] != "0") || (angka[i + 2] != "0")) {
            subkaLimat = kata1 + " " + kata2 + " " + kata3 + " " + tingkat[j] + " ";
        }

        /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
        kaLimat = subkaLimat + kaLimat;
        i = i + 3;
        j = j + 1;

    }

    /* mengganti Satu Ribu jadi Seribu jika diperlukan */
    if ((angka[5] == "0") && (angka[6] == "0")) {
        kaLimat = kaLimat.replace("Satu Ribu", "Seribu");
    }

    return kaLimat + "Rupiah";
}
