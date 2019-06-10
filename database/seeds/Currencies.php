<?php

use Illuminate\Database\Seeder;

class Currencies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");

        DB::table("countries")->insert([
            [
			    'name' => "Afghanistan",
			    'code' => "AF",
			    'dial_code' => "+93",
			    'currency_name' => "Afghan afghani",
			    'currency_symbol' => "؋",
			    'currency_code' => "AFN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Aland Islands",
			    'code' => "AX",
			    'dial_code' => "+358",
			    'currency_name' =>"Euro",
			    'currency_symbol' =>"€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Albania",
			    'code' => "AL",
			    'dial_code' => "+355",
			    'currency_name' => "Albanian lek",
			    'currency_symbol' => "L",
			    'currency_code' => "ALL",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Algeria",
			    'code' => "DZ",
			    'dial_code' => "+213",
			    'currency_name' => "Algerian dinar",
			    'currency_symbol' => "د.ج",
			    'currency_code' => "DZD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "AmericanSamoa",
			    'code' => "AS",
			    'dial_code' => "+1684",
			    'currency_name' =>" ",
			    'currency_symbol' =>"‎WS$",
			    'currency_code' => "WST",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Andorra",
			    'code' => "AD",
			    'dial_code' => "+376",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Angola",
			    'code' => "AO",
			    'dial_code' => "+244",
			    'currency_name' => "Angolan kwanza",
			    'currency_symbol' => "Kz",
			    'currency_code' => "AOA",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Anguilla",
			    'code' => "AI",
			    'dial_code' => "+1264",
			    'currency_name' => "East Caribbean dolla",
			    'currency_symbol' => "$",
			    'currency_code' => "XCD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Antarctica",
			    'code' => "AQ",
			    'dial_code' => "+672",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Antigua and Barbuda",
			    'code' => "AG",
			    'dial_code' => "+1268",
			    'currency_name' => "East Caribbean dolla",
			    'currency_symbol' => "$",
			    'currency_code' => "XCD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Argentina",
			    'code' => "AR",
			    'dial_code' => "+54",
			    'currency_name' => "Argentine peso",
			    'currency_symbol' => "$",
			    'currency_code' => "ARS",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Armenia",
			    'code' => "AM",
			    'dial_code' => "+374",
			    'currency_name' => "Armenian dram",
			    'currency_symbol' =>" ",
			    'currency_code' => "AMD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Aruba",
			    'code' => "AW",
			    'dial_code' => "+297",
			    'currency_name' => "Aruban florin",
			    'currency_symbol' => "ƒ",
			    'currency_code' => "AWG",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Australia",
			    'code' => "AU",
			    'dial_code' => "+61",
			    'currency_name' => "Australian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "AUD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Austria",
			    'code' => "AT",
			    'dial_code' => "+43",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Azerbaijan",
			    'code' => "AZ",
			    'dial_code' => "+994",
			    'currency_name' => "Azerbaijani manat",
			    'currency_symbol' =>" ",
			    'currency_code' => "AZN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Bahamas",
			    'code' => "BS",
			    'dial_code' => "+1242",
			    'currency_name' =>"Bahamian Dollar",
			    'currency_symbol' =>"B$",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Bahrain",
			    'code' => "BH",
			    'dial_code' => "+973",
			    'currency_name' => "Bahraini dinar",
			    'currency_symbol' => ".د.ب",
			    'currency_code' => "BHD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Bangladesh",
			    'code' => "BD",
			    'dial_code' => "+880",
			    'currency_name' => "Bangladeshi taka",
			    'currency_symbol' => "৳",
			    'currency_code' => "BDT",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Barbados",
			    'code' => "BB",
			    'dial_code' => "+1246",
			    'currency_name' => "Barbadian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "BBD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Belarus",
			    'code' => "BY",
			    'dial_code' => "+375",
			    'currency_name' => "Belarusian ruble",
			    'currency_symbol' => "Br",
			    'currency_code' => "BYR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Belgium",
			    'code' => "BE",
			    'dial_code' => "+32",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Belize",
			    'code' => "BZ",
			    'dial_code' => "+501",
			    'currency_name' => "Belize dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "BZD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Benin",
			    'code' => "BJ",
			    'dial_code' => "+229",
			    'currency_name' => "West African CFA fra",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XOF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Bermuda",
			    'code' => "BM",
			    'dial_code' => "+1441",
			    'currency_name' => "Bermudian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "BMD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Bhutan",
			    'code' => "BT",
			    'dial_code' => "+975",
			    'currency_name' => "Bhutanese ngultrum",
			    'currency_symbol' => "Nu.",
			    'currency_code' => "BTN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Bolivia, Plurination",
			    'code' => "BO",
			    'dial_code' => "+591",
			    'currency_name' =>"Boliviano",
			    'currency_symbol' =>"Bs",
			    'currency_code' => "BOB",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Bosnia and Herzegovi",
			    'code' => "BA",
			    'dial_code' => "+387",
			    'currency_name' =>"BAM",
			    'currency_symbol' =>"KM",
			    'currency_code' => "BAM",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Botswana",
			    'code' => "BW",
			    'dial_code' => "+267",
			    'currency_name' => "Botswana pula",
			    'currency_symbol' => "P",
			    'currency_code' => "BWP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Brazil",
			    'code' => "BR",
			    'dial_code' => "+55",
			    'currency_name' => "Brazilian real",
			    'currency_symbol' => "R$",
			    'currency_code' => "BRL",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "British Indian Ocean",
			    'code' => "IO",
			    'dial_code' => "+246",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Brunei Darussalam",
			    'code' => "BN",
			    'dial_code' => "+673",
			    'currency_name' =>"Brunei dollar",
			    'currency_symbol' =>"B$",
			    'currency_code' => "BND",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Bulgaria",
			    'code' => "BG",
			    'dial_code' => "+359",
			    'currency_name' => "Bulgarian lev",
			    'currency_symbol' => "лв",
			    'currency_code' => "BGN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Burkina Faso",
			    'code' => "BF",
			    'dial_code' => "+226",
			    'currency_name' => "West African CFA fra",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XOF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Burundi",
			    'code' => "BI",
			    'dial_code' => "+257",
			    'currency_name' => "Burundian franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "BIF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Cambodia",
			    'code' => "KH",
			    'dial_code' => "+855",
			    'currency_name' => "Cambodian riel",
			    'currency_symbol' => "៛",
			    'currency_code' => "KHR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Cameroon",
			    'code' => "CM",
			    'dial_code' => "+237",
			    'currency_name' => "Central African CFA ",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XAF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Canada",
			    'code' => "CA",
			    'dial_code' => "+1",
			    'currency_name' => "Canadian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "CAD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Cape Verde",
			    'code' => "CV",
			    'dial_code' => "+238",
			    'currency_name' => "Cape Verdean escudo",
			    'currency_symbol' => "Esc or $",
			    'currency_code' => "CVE",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Cayman Islands",
			    'code' => "KY",
			    'dial_code' => "+ 345",
			    'currency_name' => "Cayman Islands dolla",
			    'currency_symbol' => "$",
			    'currency_code' => "KYD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Central African Repu",
			    'code' => "CF",
			    'dial_code' => "+236",
			    'currency_name' =>"",
			    'currency_symbol' =>"FCFA",
			    'currency_code' => "XAF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Chad",
			    'code' => "TD",
			    'dial_code' => "+235",
			    'currency_name' => "Central African CFA ",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XAF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Chile",
			    'code' => "CL",
			    'dial_code' => "+56",
			    'currency_name' => "Chilean peso",
			    'currency_symbol' => "$",
			    'currency_code' => "CLP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "China",
			    'code' => "CN",
			    'dial_code' => "+86",
			    'currency_name' => "Chinese yuan",
			    'currency_symbol' => "¥ or 元",
			    'currency_code' => "CNY",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Christmas Island",
			    'code' => "CX",
			    'dial_code' => "+61",
			    'currency_name' =>"Australian dollar",
			    'currency_symbol' =>"$",
			    'currency_code' => "AUD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Cocos (Keeling) Isla",
			    'code' => "CC",
			    'dial_code' => "+61",
			    'currency_name' =>"Australian dollar",
			    'currency_symbol' =>"$",
			    'currency_code' => "AUD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Colombia",
			    'code' => "CO",
			    'dial_code' => "+57",
			    'currency_name' => "Colombian peso",
			    'currency_symbol' => "$",
			    'currency_code' => "COP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Comoros",
			    'code' => "KM",
			    'dial_code' => "+269",
			    'currency_name' => "Comorian franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "KMF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Congo",
			    'code' => "CG",
			    'dial_code' => "+242",
			    'currency_name' =>"Congolese franc",
			    'currency_symbol' =>"FC",
			    'currency_code' => "CDF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Congo, The Democrati",
			    'code' => "CD",
			    'dial_code' => "+243",
			    'currency_name' =>"Congolese franc",
			    'currency_symbol' =>"",
			    'currency_code' => "CDF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Cook Islands",
			    'code' => "CK",
			    'dial_code' => "+682",
			    'currency_name' => "New Zealand dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "NZD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Costa Rica",
			    'code' => "CR",
			    'dial_code' => "+506",
			    'currency_name' => "Costa Rican colón",
			    'currency_symbol' => "₡",
			    'currency_code' => "CRC",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Cote d'Ivoire",
			    'code' => "CI",
			    'dial_code' => "+225",
			    'currency_name' => "West African CFA fra",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XOF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Croatia",
			    'code' => "HR",
			    'dial_code' => "+385",
			    'currency_name' => "Croatian kuna",
			    'currency_symbol' => "kn",
			    'currency_code' => "HRK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Cuba",
			    'code' => "CU",
			    'dial_code' => "+53",
			    'currency_name' => "Cuban convertible pe",
			    'currency_symbol' => "$",
			    'currency_code' => "CUC",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Cyprus",
			    'code' => "CY",
			    'dial_code' => "+357",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Czech Republic",
			    'code' => "CZ",
			    'dial_code' => "+420",
			    'currency_name' => "Czech koruna",
			    'currency_symbol' => "Kč",
			    'currency_code' => "CZK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Denmark",
			    'code' => "DK",
			    'dial_code' => "+45",
			    'currency_name' => "Danish krone",
			    'currency_symbol' => "kr",
			    'currency_code' => "DKK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Djibouti",
			    'code' => "DJ",
			    'dial_code' => "+253",
			    'currency_name' => "Djiboutian franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "DJF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Dominica",
			    'code' => "DM",
			    'dial_code' => "+1767",
			    'currency_name' => "East Caribbean dolla",
			    'currency_symbol' => "$",
			    'currency_code' => "XCD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Dominican Republic",
			    'code' => "DO",
			    'dial_code' => "+1849",
			    'currency_name' => "Dominican peso",
			    'currency_symbol' => "$",
			    'currency_code' => "DOP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Ecuador",
			    'code' => "EC",
			    'dial_code' => "+593",
			    'currency_name' => "United States dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "USD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Egypt",
			    'code' => "EG",
			    'dial_code' => "+20",
			    'currency_name' => "Egyptian pound",
			    'currency_symbol' => "£ or ج.م",
			    'currency_code' => "EGP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "El Salvador",
			    'code' => "SV",
			    'dial_code' => "+503",
			    'currency_name' => "United States dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "USD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Equatorial Guinea",
			    'code' => "GQ",
			    'dial_code' => "+240",
			    'currency_name' => "Central African CFA ",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XAF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Eritrea",
			    'code' => "ER",
			    'dial_code' => "+291",
			    'currency_name' => "Eritrean nakfa",
			    'currency_symbol' => "Nfk",
			    'currency_code' => "ERN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Estonia",
			    'code' => "EE",
			    'dial_code' => "+372",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Ethiopia",
			    'code' => "ET",
			    'dial_code' => "+251",
			    'currency_name' => "Ethiopian birr",
			    'currency_symbol' => "Br",
			    'currency_code' => "ETB",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Falkland Islands (Ma",
			    'code' => "FK",
			    'dial_code' => "+500",
			    'currency_name' =>"Pound",
			    'currency_symbol' =>"FK£",
			    'currency_code' => "FKP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Faroe Islands",
			    'code' => "FO",
			    'dial_code' => "+298",
			    'currency_name' => "Danish krone",
			    'currency_symbol' => "kr",
			    'currency_code' => "DKK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Fiji",
			    'code' => "FJ",
			    'dial_code' => "+679",
			    'currency_name' => "Fijian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "FJD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Finland",
			    'code' => "FI",
			    'dial_code' => "+358",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "France",
			    'code' => "FR",
			    'dial_code' => "+33",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "French Guiana",
			    'code' => "GF",
			    'dial_code' => "+594",
			    'currency_name' =>"Euro",
			    'currency_symbol' =>"€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "French Polynesia",
			    'code' => "PF",
			    'dial_code' => "+689",
			    'currency_name' => "CFP franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XPF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Gabon",
			    'code' => "GA",
			    'dial_code' => "+241",
			    'currency_name' => "Central African CFA ",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XAF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Gambia",
			    'code' => "GM",
			    'dial_code' => "+220",
			    'currency_name' =>"Dalasi",
			    'currency_symbol' =>"D",
			    'currency_code' => "GMD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Georgia",
			    'code' => "GE",
			    'dial_code' => "+995",
			    'currency_name' => "Georgian lari",
			    'currency_symbol' => "ლ",
			    'currency_code' => "GEL",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Germany",
			    'code' => "DE",
			    'dial_code' => "+49",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Ghana",
			    'code' => "GH",
			    'dial_code' => "+233",
			    'currency_name' => "Ghana cedi",
			    'currency_symbol' => "₵",
			    'currency_code' => "GHS",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Gibraltar",
			    'code' => "GI",
			    'dial_code' => "+350",
			    'currency_name' => "Gibraltar pound",
			    'currency_symbol' => "£",
			    'currency_code' => "GIP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Greece",
			    'code' => "GR",
			    'dial_code' => "+30",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Greenland",
			    'code' => "GL",
			    'dial_code' => "+299",
			    'currency_name' =>"Krone",
			    'currency_symbol' =>"kr",
			    'currency_code' => "DKK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Grenada",
			    'code' => "GD",
			    'dial_code' => "+1473",
			    'currency_name' => "East Caribbean dolla",
			    'currency_symbol' => "$",
			    'currency_code' => "XCD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Guadeloupe",
			    'code' => "GP",
			    'dial_code' => "+590",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Guam",
			    'code' => "GU",
			    'dial_code' => "+1671",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Guatemala",
			    'code' => "GT",
			    'dial_code' => "+502",
			    'currency_name' => "Guatemalan quetzal",
			    'currency_symbol' => "Q",
			    'currency_code' => "GTQ",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Guernsey",
			    'code' => "GG",
			    'dial_code' => "+44",
			    'currency_name' => "British pound",
			    'currency_symbol' => "£",
			    'currency_code' => "GBP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Guinea",
			    'code' => "GN",
			    'dial_code' => "+224",
			    'currency_name' => "Guinean franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "GNF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Guinea-Bissau",
			    'code' => "GW",
			    'dial_code' => "+245",
			    'currency_name' => "West African CFA fra",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XOF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Guyana",
			    'code' => "GY",
			    'dial_code' => "+595",
			    'currency_name' => "Guyanese dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "GYD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Haiti",
			    'code' => "HT",
			    'dial_code' => "+509",
			    'currency_name' => "Haitian gourde",
			    'currency_symbol' => "G",
			    'currency_code' => "HTG",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Holy See (Vatican Ci",
			    'code' => "VA",
			    'dial_code' => "+379",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Honduras",
			    'code' => "HN",
			    'dial_code' => "+504",
			    'currency_name' => "Honduran lempira",
			    'currency_symbol' => "L",
			    'currency_code' => "HNL",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Hong Kong",
			    'code' => "HK",
			    'dial_code' => "+852",
			    'currency_name' => "Hong Kong dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "HKD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Hungary",
			    'code' => "HU",
			    'dial_code' => "+36",
			    'currency_name' => "Hungarian forint",
			    'currency_symbol' => "Ft",
			    'currency_code' => "HUF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Iceland",
			    'code' => "IS",
			    'dial_code' => "+354",
			    'currency_name' => "Icelandic króna",
			    'currency_symbol' => "kr",
			    'currency_code' => "ISK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "India",
			    'code' => "IN",
			    'dial_code' => "+91",
			    'currency_name' => "Indian rupee",
			    'currency_symbol' => "₹",
			    'currency_code' => "INR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Indonesia",
			    'code' => "ID",
			    'dial_code' => "+62",
			    'currency_name' => "Indonesian rupiah",
			    'currency_symbol' => "Rp",
			    'currency_code' => "IDR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Iran, Islamic Republ",
			    'code' => "IR",
			    'dial_code' => "+98",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Iraq",
			    'code' => "IQ",
			    'dial_code' => "+964",
			    'currency_name' => "Iraqi dinar",
			    'currency_symbol' => "ع.د",
			    'currency_code' => "IQD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Ireland",
			    'code' => "IE",
			    'dial_code' => "+353",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Isle of Man",
			    'code' => "IM",
			    'dial_code' => "+44",
			    'currency_name' => "British pound",
			    'currency_symbol' => "£",
			    'currency_code' => "GBP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Israel",
			    'code' => "IL",
			    'dial_code' => "+972",
			    'currency_name' => "Israeli new shekel",
			    'currency_symbol' => "₪",
			    'currency_code' => "ILS",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Italy",
			    'code' => "IT",
			    'dial_code' => "+39",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Jamaica",
			    'code' => "JM",
			    'dial_code' => "+1876",
			    'currency_name' => "Jamaican dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "JMD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Japan",
			    'code' => "JP",
			    'dial_code' => "+81",
			    'currency_name' => "Japanese yen",
			    'currency_symbol' => "¥",
			    'currency_code' => "JPY",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Jersey",
			    'code' => "JE",
			    'dial_code' => "+44",
			    'currency_name' => "British pound",
			    'currency_symbol' => "£",
			    'currency_code' => "GBP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Jordan",
			    'code' => "JO",
			    'dial_code' => "+962",
			    'currency_name' => "Jordanian dinar",
			    'currency_symbol' => "د.ا",
			    'currency_code' => "JOD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Kazakhstan",
			    'code' => "KZ",
			    'dial_code' => "+7 7",
			    'currency_name' => "Kazakhstani tenge",
			    'currency_symbol' =>" ",
			    'currency_code' => "KZT",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Kenya",
			    'code' => "KE",
			    'dial_code' => "+254",
			    'currency_name' => "Kenyan shilling",
			    'currency_symbol' => "Sh",
			    'currency_code' => "KES",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Kiribati",
			    'code' => "KI",
			    'dial_code' => "+686",
			    'currency_name' => "Australian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "AUD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Korea, Democratic Pe",
			    'code' => "KP",
			    'dial_code' => "+850",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Korea, Republic of S",
			    'code' => "KR",
			    'dial_code' => "+82",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Kuwait",
			    'code' => "KW",
			    'dial_code' => "+965",
			    'currency_name' => "Kuwaiti dinar",
			    'currency_symbol' => "د.ك",
			    'currency_code' => "KWD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Kyrgyzstan",
			    'code' => "KG",
			    'dial_code' => "+996",
			    'currency_name' => "Kyrgyzstani som",
			    'currency_symbol' => "лв",
			    'currency_code' => "KGS",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Laos",
			    'code' => "LA",
			    'dial_code' => "+856",
			    'currency_name' => "Lao kip",
			    'currency_symbol' => "₭",
			    'currency_code' => "LAK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Latvia",
			    'code' => "LV",
			    'dial_code' => "+371",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Lebanon",
			    'code' => "LB",
			    'dial_code' => "+961",
			    'currency_name' => "Lebanese pound",
			    'currency_symbol' => "ل.ل",
			    'currency_code' => "LBP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Lesotho",
			    'code' => "LS",
			    'dial_code' => "+266",
			    'currency_name' => "Lesotho loti",
			    'currency_symbol' => "L",
			    'currency_code' => "LSL",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Liberia",
			    'code' => "LR",
			    'dial_code' => "+231",
			    'currency_name' => "Liberian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "LRD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Libyan Arab Jamahiri",
			    'code' => "LY",
			    'dial_code' => "+218",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Liechtenstein",
			    'code' => "LI",
			    'dial_code' => "+423",
			    'currency_name' => "Swiss franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "CHF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Lithuania",
			    'code' => "LT",
			    'dial_code' => "+370",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Luxembourg",
			    'code' => "LU",
			    'dial_code' => "+352",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Macao",
			    'code' => "MO",
			    'dial_code' => "+853",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Macedonia",
			    'code' => "MK",
			    'dial_code' => "+389",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Madagascar",
			    'code' => "MG",
			    'dial_code' => "+261",
			    'currency_name' => "Malagasy ariary",
			    'currency_symbol' => "Ar",
			    'currency_code' => "MGA",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Malawi",
			    'code' => "MW",
			    'dial_code' => "+265",
			    'currency_name' => "Malawian kwacha",
			    'currency_symbol' => "MK",
			    'currency_code' => "MWK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Malaysia",
			    'code' => "MY",
			    'dial_code' => "+60",
			    'currency_name' => "Malaysian ringgit",
			    'currency_symbol' => "RM",
			    'currency_code' => "MYR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Maldives",
			    'code' => "MV",
			    'dial_code' => "+960",
			    'currency_name' => "Maldivian rufiyaa",
			    'currency_symbol' => ".ރ",
			    'currency_code' => "MVR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Mali",
			    'code' => "ML",
			    'dial_code' => "+223",
			    'currency_name' => "West African CFA fra",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XOF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Malta",
			    'code' => "MT",
			    'dial_code' => "+356",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Marshall Islands",
			    'code' => "MH",
			    'dial_code' => "+692",
			    'currency_name' => "United States dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "USD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Martinique",
			    'code' => "MQ",
			    'dial_code' => "+596",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Mauritania",
			    'code' => "MR",
			    'dial_code' => "+222",
			    'currency_name' => "Mauritanian ouguiya",
			    'currency_symbol' => "UM",
			    'currency_code' => "MRO",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Mauritius",
			    'code' => "MU",
			    'dial_code' => "+230",
			    'currency_name' => "Mauritian rupee",
			    'currency_symbol' => "₨",
			    'currency_code' => "MUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Mayotte",
			    'code' => "YT",
			    'dial_code' => "+262",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Mexico",
			    'code' => "MX",
			    'dial_code' => "+52",
			    'currency_name' => "Mexican peso",
			    'currency_symbol' => "$",
			    'currency_code' => "MXN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Micronesia, Federate",
			    'code' => "FM",
			    'dial_code' => "+691",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Moldova",
			    'code' => "MD",
			    'dial_code' => "+373",
			    'currency_name' => "Moldovan leu",
			    'currency_symbol' => "L",
			    'currency_code' => "MDL",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Monaco",
			    'code' => "MC",
			    'dial_code' => "+377",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Mongolia",
			    'code' => "MN",
			    'dial_code' => "+976",
			    'currency_name' => "Mongolian tögrög",
			    'currency_symbol' => "₮",
			    'currency_code' => "MNT",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Montenegro",
			    'code' => "ME",
			    'dial_code' => "+382",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Montserrat",
			    'code' => "MS",
			    'dial_code' => "+1664",
			    'currency_name' => "East Caribbean dolla",
			    'currency_symbol' => "$",
			    'currency_code' => "XCD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Morocco",
			    'code' => "MA",
			    'dial_code' => "+212",
			    'currency_name' => "Moroccan dirham",
			    'currency_symbol' => "د.م.",
			    'currency_code' => "MAD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Mozambique",
			    'code' => "MZ",
			    'dial_code' => "+258",
			    'currency_name' => "Mozambican metical",
			    'currency_symbol' => "MT",
			    'currency_code' => "MZN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Myanmar",
			    'code' => "MM",
			    'dial_code' => "+95",
			    'currency_name' => "Burmese kyat",
			    'currency_symbol' => "Ks",
			    'currency_code' => "MMK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Namibia",
			    'code' => "NA",
			    'dial_code' => "+264",
			    'currency_name' => "Namibian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "NAD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Nauru",
			    'code' => "NR",
			    'dial_code' => "+674",
			    'currency_name' => "Australian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "AUD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Nepal",
			    'code' => "NP",
			    'dial_code' => "+977",
			    'currency_name' => "Nepalese rupee",
			    'currency_symbol' => "₨",
			    'currency_code' => "NPR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Netherlands",
			    'code' => "NL",
			    'dial_code' => "+31",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Netherlands Antilles",
			    'code' => "AN",
			    'dial_code' => "+599",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "New Caledonia",
			    'code' => "NC",
			    'dial_code' => "+687",
			    'currency_name' => "CFP franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XPF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "New Zealand",
			    'code' => "NZ",
			    'dial_code' => "+64",
			    'currency_name' => "New Zealand dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "NZD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Nicaragua",
			    'code' => "NI",
			    'dial_code' => "+505",
			    'currency_name' => "Nicaraguan córdoba",
			    'currency_symbol' => "C$",
			    'currency_code' => "NIO",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Niger",
			    'code' => "NE",
			    'dial_code' => "+227",
			    'currency_name' => "West African CFA fra",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XOF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Nigeria",
			    'code' => "NG",
			    'dial_code' => "+234",
			    'currency_name' => "Nigerian naira",
			    'currency_symbol' => "₦",
			    'currency_code' => "NGN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Niue",
			    'code' => "NU",
			    'dial_code' => "+683",
			    'currency_name' => "New Zealand dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "NZD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Norfolk Island",
			    'code' => "NF",
			    'dial_code' => "+672",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Northern Mariana Isl",
			    'code' => "MP",
			    'dial_code' => "+1670",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Norway",
			    'code' => "NO",
			    'dial_code' => "+47",
			    'currency_name' => "Norwegian krone",
			    'currency_symbol' => "kr",
			    'currency_code' => "NOK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Oman",
			    'code' => "OM",
			    'dial_code' => "+968",
			    'currency_name' => "Omani rial",
			    'currency_symbol' => "ر.ع.",
			    'currency_code' => "OMR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Pakistan",
			    'code' => "PK",
			    'dial_code' => "+92",
			    'currency_name' => "Pakistani rupee",
			    'currency_symbol' => "₨",
			    'currency_code' => "PKR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Palau",
			    'code' => "PW",
			    'dial_code' => "+680",
			    'currency_name' => "Palauan dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Palestinian Territor",
			    'code' => "PS",
			    'dial_code' => "+970",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Panama",
			    'code' => "PA",
			    'dial_code' => "+507",
			    'currency_name' => "Panamanian balboa",
			    'currency_symbol' => "B/.",
			    'currency_code' => "PAB",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Papua New Guinea",
			    'code' => "PG",
			    'dial_code' => "+675",
			    'currency_name' => "Papua New Guinean ki",
			    'currency_symbol' => "K",
			    'currency_code' => "PGK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Paraguay",
			    'code' => "PY",
			    'dial_code' => "+595",
			    'currency_name' => "Paraguayan guaraní",
			    'currency_symbol' => "₲",
			    'currency_code' => "PYG",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Peru",
			    'code' => "PE",
			    'dial_code' => "+51",
			    'currency_name' => "Peruvian nuevo sol",
			    'currency_symbol' => "S/.",
			    'currency_code' => "PEN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Philippines",
			    'code' => "PH",
			    'dial_code' => "+63",
			    'currency_name' => "Philippine peso",
			    'currency_symbol' => "₱",
			    'currency_code' => "PHP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Pitcairn",
			    'code' => "PN",
			    'dial_code' => "+872",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Poland",
			    'code' => "PL",
			    'dial_code' => "+48",
			    'currency_name' => "Polish z?oty",
			    'currency_symbol' => "zł",
			    'currency_code' => "PLN",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Portugal",
			    'code' => "PT",
			    'dial_code' => "+351",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Puerto Rico",
			    'code' => "PR",
			    'dial_code' => "+1939",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Qatar",
			    'code' => "QA",
			    'dial_code' => "+974",
			    'currency_name' => "Qatari riyal",
			    'currency_symbol' => "ر.ق",
			    'currency_code' => "QAR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Romania",
			    'code' => "RO",
			    'dial_code' => "+40",
			    'currency_name' => "Romanian leu",
			    'currency_symbol' => "lei",
			    'currency_code' => "RON",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Russia",
			    'code' => "RU",
			    'dial_code' => "+7",
			    'currency_name' => "Russian ruble",
			    'currency_symbol' =>" ",
			    'currency_code' => "RUB",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Rwanda",
			    'code' => "RW",
			    'dial_code' => "+250",
			    'currency_name' => "Rwandan franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "RWF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Reunion",
			    'code' => "RE",
			    'dial_code' => "+262",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Saint Barthelemy",
			    'code' => "BL",
			    'dial_code' => "+590",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Saint Helena, Ascens",
			    'code' => "SH",
			    'dial_code' => "+290",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Saint Kitts and Nevi",
			    'code' => "KN",
			    'dial_code' => "+1869",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Saint Lucia",
			    'code' => "LC",
			    'dial_code' => "+1758",
			    'currency_name' => "East Caribbean dolla",
			    'currency_symbol' => "$",
			    'currency_code' => "XCD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Saint Martin",
			    'code' => "MF",
			    'dial_code' => "+590",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Saint Pierre and Miq",
			    'code' => "PM",
			    'dial_code' => "+508",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Saint Vincent and th",
			    'code' => "VC",
			    'dial_code' => "+1784",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Samoa",
			    'code' => "WS",
			    'dial_code' => "+685",
			    'currency_name' => "Samoan t?l?",
			    'currency_symbol' => "T",
			    'currency_code' => "WST",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "San Marino",
			    'code' => "SM",
			    'dial_code' => "+378",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Sao Tome and Princip",
			    'code' => "ST",
			    'dial_code' => "+239",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Saudi Arabia",
			    'code' => "SA",
			    'dial_code' => "+966",
			    'currency_name' => "Saudi riyal",
			    'currency_symbol' => "ر.س",
			    'currency_code' => "SAR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Senegal",
			    'code' => "SN",
			    'dial_code' => "+221",
			    'currency_name' => "West African CFA fra",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XOF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Serbia",
			    'code' => "RS",
			    'dial_code' => "+381",
			    'currency_name' => "Serbian dinar",
			    'currency_symbol' => "дин. or din.",
			    'currency_code' => "RSD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Seychelles",
			    'code' => "SC",
			    'dial_code' => "+248",
			    'currency_name' => "Seychellois rupee",
			    'currency_symbol' => "₨",
			    'currency_code' => "SCR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Sierra Leone",
			    'code' => "SL",
			    'dial_code' => "+232",
			    'currency_name' => "Sierra Leonean leone",
			    'currency_symbol' => "Le",
			    'currency_code' => "SLL",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Singapore",
			    'code' => "SG",
			    'dial_code' => "+65",
			    'currency_name' => "Brunei dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "BND",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Slovakia",
			    'code' => "SK",
			    'dial_code' => "+421",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Slovenia",
			    'code' => "SI",
			    'dial_code' => "+386",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Solomon Islands",
			    'code' => "SB",
			    'dial_code' => "+677",
			    'currency_name' => "Solomon Islands doll",
			    'currency_symbol' => "$",
			    'currency_code' => "SBD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Somalia",
			    'code' => "SO",
			    'dial_code' => "+252",
			    'currency_name' => "Somali shilling",
			    'currency_symbol' => "Sh",
			    'currency_code' => "SOS",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "South Africa",
			    'code' => "ZA",
			    'dial_code' => "+27",
			    'currency_name' => "South African rand",
			    'currency_symbol' => "R",
			    'currency_code' => "ZAR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "South Georgia and th",
			    'code' => "GS",
			    'dial_code' => "+500",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Spain",
			    'code' => "ES",
			    'dial_code' => "+34",
			    'currency_name' => "Euro",
			    'currency_symbol' => "€",
			    'currency_code' => "EUR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Sri Lanka",
			    'code' => "LK",
			    'dial_code' => "+94",
			    'currency_name' => "Sri Lankan rupee",
			    'currency_symbol' => "Rs or රු",
			    'currency_code' => "LKR",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Sudan",
			    'code' => "SD",
			    'dial_code' => "+249",
			    'currency_name' => "Sudanese pound",
			    'currency_symbol' => "ج.س.",
			    'currency_code' => "SDG",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Suriname",
			    'code' => "SR",
			    'dial_code' => "+597",
			    'currency_name' => "Surinamese dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "SRD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Svalbard and Jan May",
			    'code' => "SJ",
			    'dial_code' => "+47",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Swaziland",
			    'code' => "SZ",
			    'dial_code' => "+268",
			    'currency_name' => "Swazi lilangeni",
			    'currency_symbol' => "L",
			    'currency_code' => "SZL",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Sweden",
			    'code' => "SE",
			    'dial_code' => "+46",
			    'currency_name' => "Swedish krona",
			    'currency_symbol' => "kr",
			    'currency_code' => "SEK",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Switzerland",
			    'code' => "CH",
			    'dial_code' => "+41",
			    'currency_name' => "Swiss franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "CHF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Syrian Arab Republic",
			    'code' => "SY",
			    'dial_code' => "+963",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Taiwan",
			    'code' => "TW",
			    'dial_code' => "+886",
			    'currency_name' => "New Taiwan dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "TWD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Tajikistan",
			    'code' => "TJ",
			    'dial_code' => "+992",
			    'currency_name' => "Tajikistani somoni",
			    'currency_symbol' => "ЅМ",
			    'currency_code' => "TJS",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Tanzania, United Rep",
			    'code' => "TZ",
			    'dial_code' => "+255",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Thailand",
			    'code' => "TH",
			    'dial_code' => "+66",
			    'currency_name' => "Thai baht",
			    'currency_symbol' => "฿",
			    'currency_code' => "THB",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Timor-Leste",
			    'code' => "TL",
			    'dial_code' => "+670",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Togo",
			    'code' => "TG",
			    'dial_code' => "+228",
			    'currency_name' => "West African CFA fra",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XOF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Tokelau",
			    'code' => "TK",
			    'dial_code' => "+690",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Tonga",
			    'code' => "TO",
			    'dial_code' => "+676",
			    'currency_name' => "Tongan pa?anga",
			    'currency_symbol' => "T$",
			    'currency_code' => "TOP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Trinidad and Tobago",
			    'code' => "TT",
			    'dial_code' => "+1868",
			    'currency_name' => "Trinidad and Tobago ",
			    'currency_symbol' => "$",
			    'currency_code' => "TTD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Tunisia",
			    'code' => "TN",
			    'dial_code' => "+216",
			    'currency_name' => "Tunisian dinar",
			    'currency_symbol' => "د.ت",
			    'currency_code' => "TND",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Turkey",
			    'code' => "TR",
			    'dial_code' => "+90",
			    'currency_name' => "Turkish lira",
			    'currency_symbol' =>" ",
			    'currency_code' => "TRY",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Turkmenistan",
			    'code' => "TM",
			    'dial_code' => "+993",
			    'currency_name' => "Turkmenistan manat",
			    'currency_symbol' => "m",
			    'currency_code' => "TMT",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Turks and Caicos Isl",
			    'code' => "TC",
			    'dial_code' => "+1649",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Tuvalu",
			    'code' => "TV",
			    'dial_code' => "+688",
			    'currency_name' => "Australian dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "AUD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Uganda",
			    'code' => "UG",
			    'dial_code' => "+256",
			    'currency_name' => "Ugandan shilling",
			    'currency_symbol' => "Sh",
			    'currency_code' => "UGX",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Ukraine",
			    'code' => "UA",
			    'dial_code' => "+380",
			    'currency_name' => "Ukrainian hryvnia",
			    'currency_symbol' => "₴",
			    'currency_code' => "UAH",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "United Arab Emirates",
			    'code' => "AE",
			    'dial_code' => "+971",
			    'currency_name' => "United Arab Emirates",
			    'currency_symbol' => "د.إ",
			    'currency_code' => "AED",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "United Kingdom",
			    'code' => "GB",
			    'dial_code' => "+44",
			    'currency_name' => "British pound",
			    'currency_symbol' => "£",
			    'currency_code' => "GBP",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "United States",
			    'code' => "US",
			    'dial_code' => "+1",
			    'currency_name' => "United States dollar",
			    'currency_symbol' => "$",
			    'currency_code' => "USD",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Uruguay",
			    'code' => "UY",
			    'dial_code' => "+598",
			    'currency_name' => "Uruguayan peso",
			    'currency_symbol' => "$",
			    'currency_code' => "UYU",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Uzbekistan",
			    'code' => "UZ",
			    'dial_code' => "+998",
			    'currency_name' => "Uzbekistani som",
			    'currency_symbol' =>" ",
			    'currency_code' => "UZS",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Vanuatu",
			    'code' => "VU",
			    'dial_code' => "+678",
			    'currency_name' => "Vanuatu vatu",
			    'currency_symbol' => "Vt",
			    'currency_code' => "VUV",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Venezuela, Bolivaria",
			    'code' => "VE",
			    'dial_code' => "+58",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Vietnam",
			    'code' => "VN",
			    'dial_code' => "+84",
			    'currency_name' => "Vietnamese ??ng",
			    'currency_symbol' => "₫",
			    'currency_code' => "VND",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Virgin Islands, Brit",
			    'code' => "VG",
			    'dial_code' => "+1284",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Virgin Islands, U.S.",
			    'code' => "VI",
			    'dial_code' => "+1340",
			    'currency_name' =>" ",
			    'currency_symbol' =>" ",
			    'currency_code' => "",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Wallis and Futuna",
			    'code' => "WF",
			    'dial_code' => "+681",
			    'currency_name' => "CFP franc",
			    'currency_symbol' => "Fr",
			    'currency_code' => "XPF",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Yemen",
			    'code' => "YE",
			    'dial_code' => "+967",
			    'currency_name' => "Yemeni rial",
			    'currency_symbol' => "﷼",
			    'currency_code' => "YER",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Zambia",
			    'code' => "ZM",
			    'dial_code' => "+260",
			    'currency_name' => "Zambian kwacha",
			    'currency_symbol' => "ZK",
			    'currency_code' => "ZMW",
			    'created_at' => $now,
			    'updated_at' => $now
			],
			[
			    'name' => "Zimbabwe",
			    'code' => "ZW",
			    'dial_code' => "+263",
			    'currency_name' => "Botswana pula",
			    'currency_symbol' => "P",
			    'currency_code' => "BWP",
			    'created_at' => $now,
			    'updated_at' => $now
			]
        ]);
    }
}
