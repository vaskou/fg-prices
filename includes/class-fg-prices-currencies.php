<?php

class FG_Prices_Currencies {

	public static function get_current_currency() {

		$currenct_currency = FG_Prices_Settings::instance()->get_default_currency();

		return apply_filters( 'fg_prices_get_current_currency', $currenct_currency );
	}

	public static function get_current_currency_symbol() {
		$currency_symbols  = self::get_currency_symbols();
		$currenct_currency = self::get_current_currency();

		return ! empty( $currency_symbols[ $currenct_currency ] ) ? $currency_symbols[ $currenct_currency ] : '';
	}

	public static function get_european_union_countries() {
		$countries = array( 'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HU', 'HR', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK' );

		return apply_filters( 'fg_prices_european_union_countries', $countries );
	}

	public static function get_currencies() {
		static $currencies;

		if ( ! isset( $currencies ) ) {
			$currencies = array_unique(
				apply_filters(
					'fg_prices_currencies',
					array(
						'AED' => __( 'United Arab Emirates dirham', 'fg-prices' ),
						'AFN' => __( 'Afghan afghani', 'fg-prices' ),
						'ALL' => __( 'Albanian lek', 'fg-prices' ),
						'AMD' => __( 'Armenian dram', 'fg-prices' ),
						'ANG' => __( 'Netherlands Antillean guilder', 'fg-prices' ),
						'AOA' => __( 'Angolan kwanza', 'fg-prices' ),
						'ARS' => __( 'Argentine peso', 'fg-prices' ),
						'AUD' => __( 'Australian dollar', 'fg-prices' ),
						'AWG' => __( 'Aruban florin', 'fg-prices' ),
						'AZN' => __( 'Azerbaijani manat', 'fg-prices' ),
						'BAM' => __( 'Bosnia and Herzegovina convertible mark', 'fg-prices' ),
						'BBD' => __( 'Barbadian dollar', 'fg-prices' ),
						'BDT' => __( 'Bangladeshi taka', 'fg-prices' ),
						'BGN' => __( 'Bulgarian lev', 'fg-prices' ),
						'BHD' => __( 'Bahraini dinar', 'fg-prices' ),
						'BIF' => __( 'Burundian franc', 'fg-prices' ),
						'BMD' => __( 'Bermudian dollar', 'fg-prices' ),
						'BND' => __( 'Brunei dollar', 'fg-prices' ),
						'BOB' => __( 'Bolivian boliviano', 'fg-prices' ),
						'BRL' => __( 'Brazilian real', 'fg-prices' ),
						'BSD' => __( 'Bahamian dollar', 'fg-prices' ),
						'BTC' => __( 'Bitcoin', 'fg-prices' ),
						'BTN' => __( 'Bhutanese ngultrum', 'fg-prices' ),
						'BWP' => __( 'Botswana pula', 'fg-prices' ),
						'BYR' => __( 'Belarusian ruble (old)', 'fg-prices' ),
						'BYN' => __( 'Belarusian ruble', 'fg-prices' ),
						'BZD' => __( 'Belize dollar', 'fg-prices' ),
						'CAD' => __( 'Canadian dollar', 'fg-prices' ),
						'CDF' => __( 'Congolese franc', 'fg-prices' ),
						'CHF' => __( 'Swiss franc', 'fg-prices' ),
						'CLP' => __( 'Chilean peso', 'fg-prices' ),
						'CNY' => __( 'Chinese yuan', 'fg-prices' ),
						'COP' => __( 'Colombian peso', 'fg-prices' ),
						'CRC' => __( 'Costa Rican col&oacute;n', 'fg-prices' ),
						'CUC' => __( 'Cuban convertible peso', 'fg-prices' ),
						'CUP' => __( 'Cuban peso', 'fg-prices' ),
						'CVE' => __( 'Cape Verdean escudo', 'fg-prices' ),
						'CZK' => __( 'Czech koruna', 'fg-prices' ),
						'DJF' => __( 'Djiboutian franc', 'fg-prices' ),
						'DKK' => __( 'Danish krone', 'fg-prices' ),
						'DOP' => __( 'Dominican peso', 'fg-prices' ),
						'DZD' => __( 'Algerian dinar', 'fg-prices' ),
						'EGP' => __( 'Egyptian pound', 'fg-prices' ),
						'ERN' => __( 'Eritrean nakfa', 'fg-prices' ),
						'ETB' => __( 'Ethiopian birr', 'fg-prices' ),
						'EUR' => __( 'Euro', 'fg-prices' ),
						'FJD' => __( 'Fijian dollar', 'fg-prices' ),
						'FKP' => __( 'Falkland Islands pound', 'fg-prices' ),
						'GBP' => __( 'Pound sterling', 'fg-prices' ),
						'GEL' => __( 'Georgian lari', 'fg-prices' ),
						'GGP' => __( 'Guernsey pound', 'fg-prices' ),
						'GHS' => __( 'Ghana cedi', 'fg-prices' ),
						'GIP' => __( 'Gibraltar pound', 'fg-prices' ),
						'GMD' => __( 'Gambian dalasi', 'fg-prices' ),
						'GNF' => __( 'Guinean franc', 'fg-prices' ),
						'GTQ' => __( 'Guatemalan quetzal', 'fg-prices' ),
						'GYD' => __( 'Guyanese dollar', 'fg-prices' ),
						'HKD' => __( 'Hong Kong dollar', 'fg-prices' ),
						'HNL' => __( 'Honduran lempira', 'fg-prices' ),
						'HRK' => __( 'Croatian kuna', 'fg-prices' ),
						'HTG' => __( 'Haitian gourde', 'fg-prices' ),
						'HUF' => __( 'Hungarian forint', 'fg-prices' ),
						'IDR' => __( 'Indonesian rupiah', 'fg-prices' ),
						'ILS' => __( 'Israeli new shekel', 'fg-prices' ),
						'IMP' => __( 'Manx pound', 'fg-prices' ),
						'INR' => __( 'Indian rupee', 'fg-prices' ),
						'IQD' => __( 'Iraqi dinar', 'fg-prices' ),
						'IRR' => __( 'Iranian rial', 'fg-prices' ),
						'IRT' => __( 'Iranian toman', 'fg-prices' ),
						'ISK' => __( 'Icelandic kr&oacute;na', 'fg-prices' ),
						'JEP' => __( 'Jersey pound', 'fg-prices' ),
						'JMD' => __( 'Jamaican dollar', 'fg-prices' ),
						'JOD' => __( 'Jordanian dinar', 'fg-prices' ),
						'JPY' => __( 'Japanese yen', 'fg-prices' ),
						'KES' => __( 'Kenyan shilling', 'fg-prices' ),
						'KGS' => __( 'Kyrgyzstani som', 'fg-prices' ),
						'KHR' => __( 'Cambodian riel', 'fg-prices' ),
						'KMF' => __( 'Comorian franc', 'fg-prices' ),
						'KPW' => __( 'North Korean won', 'fg-prices' ),
						'KRW' => __( 'South Korean won', 'fg-prices' ),
						'KWD' => __( 'Kuwaiti dinar', 'fg-prices' ),
						'KYD' => __( 'Cayman Islands dollar', 'fg-prices' ),
						'KZT' => __( 'Kazakhstani tenge', 'fg-prices' ),
						'LAK' => __( 'Lao kip', 'fg-prices' ),
						'LBP' => __( 'Lebanese pound', 'fg-prices' ),
						'LKR' => __( 'Sri Lankan rupee', 'fg-prices' ),
						'LRD' => __( 'Liberian dollar', 'fg-prices' ),
						'LSL' => __( 'Lesotho loti', 'fg-prices' ),
						'LYD' => __( 'Libyan dinar', 'fg-prices' ),
						'MAD' => __( 'Moroccan dirham', 'fg-prices' ),
						'MDL' => __( 'Moldovan leu', 'fg-prices' ),
						'MGA' => __( 'Malagasy ariary', 'fg-prices' ),
						'MKD' => __( 'Macedonian denar', 'fg-prices' ),
						'MMK' => __( 'Burmese kyat', 'fg-prices' ),
						'MNT' => __( 'Mongolian t&ouml;gr&ouml;g', 'fg-prices' ),
						'MOP' => __( 'Macanese pataca', 'fg-prices' ),
						'MRU' => __( 'Mauritanian ouguiya', 'fg-prices' ),
						'MUR' => __( 'Mauritian rupee', 'fg-prices' ),
						'MVR' => __( 'Maldivian rufiyaa', 'fg-prices' ),
						'MWK' => __( 'Malawian kwacha', 'fg-prices' ),
						'MXN' => __( 'Mexican peso', 'fg-prices' ),
						'MYR' => __( 'Malaysian ringgit', 'fg-prices' ),
						'MZN' => __( 'Mozambican metical', 'fg-prices' ),
						'NAD' => __( 'Namibian dollar', 'fg-prices' ),
						'NGN' => __( 'Nigerian naira', 'fg-prices' ),
						'NIO' => __( 'Nicaraguan c&oacute;rdoba', 'fg-prices' ),
						'NOK' => __( 'Norwegian krone', 'fg-prices' ),
						'NPR' => __( 'Nepalese rupee', 'fg-prices' ),
						'NZD' => __( 'New Zealand dollar', 'fg-prices' ),
						'OMR' => __( 'Omani rial', 'fg-prices' ),
						'PAB' => __( 'Panamanian balboa', 'fg-prices' ),
						'PEN' => __( 'Sol', 'fg-prices' ),
						'PGK' => __( 'Papua New Guinean kina', 'fg-prices' ),
						'PHP' => __( 'Philippine peso', 'fg-prices' ),
						'PKR' => __( 'Pakistani rupee', 'fg-prices' ),
						'PLN' => __( 'Polish z&#x142;oty', 'fg-prices' ),
						'PRB' => __( 'Transnistrian ruble', 'fg-prices' ),
						'PYG' => __( 'Paraguayan guaran&iacute;', 'fg-prices' ),
						'QAR' => __( 'Qatari riyal', 'fg-prices' ),
						'RON' => __( 'Romanian leu', 'fg-prices' ),
						'RSD' => __( 'Serbian dinar', 'fg-prices' ),
						'RUB' => __( 'Russian ruble', 'fg-prices' ),
						'RWF' => __( 'Rwandan franc', 'fg-prices' ),
						'SAR' => __( 'Saudi riyal', 'fg-prices' ),
						'SBD' => __( 'Solomon Islands dollar', 'fg-prices' ),
						'SCR' => __( 'Seychellois rupee', 'fg-prices' ),
						'SDG' => __( 'Sudanese pound', 'fg-prices' ),
						'SEK' => __( 'Swedish krona', 'fg-prices' ),
						'SGD' => __( 'Singapore dollar', 'fg-prices' ),
						'SHP' => __( 'Saint Helena pound', 'fg-prices' ),
						'SLL' => __( 'Sierra Leonean leone', 'fg-prices' ),
						'SOS' => __( 'Somali shilling', 'fg-prices' ),
						'SRD' => __( 'Surinamese dollar', 'fg-prices' ),
						'SSP' => __( 'South Sudanese pound', 'fg-prices' ),
						'STN' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe dobra', 'fg-prices' ),
						'SYP' => __( 'Syrian pound', 'fg-prices' ),
						'SZL' => __( 'Swazi lilangeni', 'fg-prices' ),
						'THB' => __( 'Thai baht', 'fg-prices' ),
						'TJS' => __( 'Tajikistani somoni', 'fg-prices' ),
						'TMT' => __( 'Turkmenistan manat', 'fg-prices' ),
						'TND' => __( 'Tunisian dinar', 'fg-prices' ),
						'TOP' => __( 'Tongan pa&#x2bb;anga', 'fg-prices' ),
						'TRY' => __( 'Turkish lira', 'fg-prices' ),
						'TTD' => __( 'Trinidad and Tobago dollar', 'fg-prices' ),
						'TWD' => __( 'New Taiwan dollar', 'fg-prices' ),
						'TZS' => __( 'Tanzanian shilling', 'fg-prices' ),
						'UAH' => __( 'Ukrainian hryvnia', 'fg-prices' ),
						'UGX' => __( 'Ugandan shilling', 'fg-prices' ),
						'USD' => __( 'United States (US) dollar', 'fg-prices' ),
						'UYU' => __( 'Uruguayan peso', 'fg-prices' ),
						'UZS' => __( 'Uzbekistani som', 'fg-prices' ),
						'VEF' => __( 'Venezuelan bol&iacute;var', 'fg-prices' ),
						'VES' => __( 'Bol&iacute;var soberano', 'fg-prices' ),
						'VND' => __( 'Vietnamese &#x111;&#x1ed3;ng', 'fg-prices' ),
						'VUV' => __( 'Vanuatu vatu', 'fg-prices' ),
						'WST' => __( 'Samoan t&#x101;l&#x101;', 'fg-prices' ),
						'XAF' => __( 'Central African CFA franc', 'fg-prices' ),
						'XCD' => __( 'East Caribbean dollar', 'fg-prices' ),
						'XOF' => __( 'West African CFA franc', 'fg-prices' ),
						'XPF' => __( 'CFP franc', 'fg-prices' ),
						'YER' => __( 'Yemeni rial', 'fg-prices' ),
						'ZAR' => __( 'South African rand', 'fg-prices' ),
						'ZMW' => __( 'Zambian kwacha', 'fg-prices' ),
					)
				)
			);
		}

		return $currencies;
	}

	public static function get_currency_symbols() {

		$symbols = apply_filters(
			'fg_prices_currency_symbols',
			array(
				'AED' => '&#x62f;.&#x625;',
				'AFN' => '&#x60b;',
				'ALL' => 'L',
				'AMD' => 'AMD',
				'ANG' => '&fnof;',
				'AOA' => 'Kz',
				'ARS' => '&#36;',
				'AUD' => '&#36;',
				'AWG' => 'Afl.',
				'AZN' => 'AZN',
				'BAM' => 'KM',
				'BBD' => '&#36;',
				'BDT' => '&#2547;&nbsp;',
				'BGN' => '&#1083;&#1074;.',
				'BHD' => '.&#x62f;.&#x628;',
				'BIF' => 'Fr',
				'BMD' => '&#36;',
				'BND' => '&#36;',
				'BOB' => 'Bs.',
				'BRL' => '&#82;&#36;',
				'BSD' => '&#36;',
				'BTC' => '&#3647;',
				'BTN' => 'Nu.',
				'BWP' => 'P',
				'BYR' => 'Br',
				'BYN' => 'Br',
				'BZD' => '&#36;',
				'CAD' => '&#36;',
				'CDF' => 'Fr',
				'CHF' => '&#67;&#72;&#70;',
				'CLP' => '&#36;',
				'CNY' => '&yen;',
				'COP' => '&#36;',
				'CRC' => '&#x20a1;',
				'CUC' => '&#36;',
				'CUP' => '&#36;',
				'CVE' => '&#36;',
				'CZK' => '&#75;&#269;',
				'DJF' => 'Fr',
				'DKK' => 'DKK',
				'DOP' => 'RD&#36;',
				'DZD' => '&#x62f;.&#x62c;',
				'EGP' => 'EGP',
				'ERN' => 'Nfk',
				'ETB' => 'Br',
				'EUR' => '&euro;',
				'FJD' => '&#36;',
				'FKP' => '&pound;',
				'GBP' => '&pound;',
				'GEL' => '&#x20be;',
				'GGP' => '&pound;',
				'GHS' => '&#x20b5;',
				'GIP' => '&pound;',
				'GMD' => 'D',
				'GNF' => 'Fr',
				'GTQ' => 'Q',
				'GYD' => '&#36;',
				'HKD' => '&#36;',
				'HNL' => 'L',
				'HRK' => 'kn',
				'HTG' => 'G',
				'HUF' => '&#70;&#116;',
				'IDR' => 'Rp',
				'ILS' => '&#8362;',
				'IMP' => '&pound;',
				'INR' => '&#8377;',
				'IQD' => '&#x639;.&#x62f;',
				'IRR' => '&#xfdfc;',
				'IRT' => '&#x062A;&#x0648;&#x0645;&#x0627;&#x0646;',
				'ISK' => 'kr.',
				'JEP' => '&pound;',
				'JMD' => '&#36;',
				'JOD' => '&#x62f;.&#x627;',
				'JPY' => '&yen;',
				'KES' => 'KSh',
				'KGS' => '&#x441;&#x43e;&#x43c;',
				'KHR' => '&#x17db;',
				'KMF' => 'Fr',
				'KPW' => '&#x20a9;',
				'KRW' => '&#8361;',
				'KWD' => '&#x62f;.&#x643;',
				'KYD' => '&#36;',
				'KZT' => '&#8376;',
				'LAK' => '&#8365;',
				'LBP' => '&#x644;.&#x644;',
				'LKR' => '&#xdbb;&#xdd4;',
				'LRD' => '&#36;',
				'LSL' => 'L',
				'LYD' => '&#x644;.&#x62f;',
				'MAD' => '&#x62f;.&#x645;.',
				'MDL' => 'MDL',
				'MGA' => 'Ar',
				'MKD' => '&#x434;&#x435;&#x43d;',
				'MMK' => 'Ks',
				'MNT' => '&#x20ae;',
				'MOP' => 'P',
				'MRU' => 'UM',
				'MUR' => '&#x20a8;',
				'MVR' => '.&#x783;',
				'MWK' => 'MK',
				'MXN' => '&#36;',
				'MYR' => '&#82;&#77;',
				'MZN' => 'MT',
				'NAD' => 'N&#36;',
				'NGN' => '&#8358;',
				'NIO' => 'C&#36;',
				'NOK' => '&#107;&#114;',
				'NPR' => '&#8360;',
				'NZD' => '&#36;',
				'OMR' => '&#x631;.&#x639;.',
				'PAB' => 'B/.',
				'PEN' => 'S/',
				'PGK' => 'K',
				'PHP' => '&#8369;',
				'PKR' => '&#8360;',
				'PLN' => '&#122;&#322;',
				'PRB' => '&#x440;.',
				'PYG' => '&#8370;',
				'QAR' => '&#x631;.&#x642;',
				'RMB' => '&yen;',
				'RON' => 'lei',
				'RSD' => '&#1088;&#1089;&#1076;',
				'RUB' => '&#8381;',
				'RWF' => 'Fr',
				'SAR' => '&#x631;.&#x633;',
				'SBD' => '&#36;',
				'SCR' => '&#x20a8;',
				'SDG' => '&#x62c;.&#x633;.',
				'SEK' => '&#107;&#114;',
				'SGD' => '&#36;',
				'SHP' => '&pound;',
				'SLL' => 'Le',
				'SOS' => 'Sh',
				'SRD' => '&#36;',
				'SSP' => '&pound;',
				'STN' => 'Db',
				'SYP' => '&#x644;.&#x633;',
				'SZL' => 'L',
				'THB' => '&#3647;',
				'TJS' => '&#x405;&#x41c;',
				'TMT' => 'm',
				'TND' => '&#x62f;.&#x62a;',
				'TOP' => 'T&#36;',
				'TRY' => '&#8378;',
				'TTD' => '&#36;',
				'TWD' => '&#78;&#84;&#36;',
				'TZS' => 'Sh',
				'UAH' => '&#8372;',
				'UGX' => 'UGX',
				'USD' => '&#36;',
				'UYU' => '&#36;',
				'UZS' => 'UZS',
				'VEF' => 'Bs F',
				'VES' => 'Bs.S',
				'VND' => '&#8363;',
				'VUV' => 'Vt',
				'WST' => 'T',
				'XAF' => 'CFA',
				'XCD' => '&#36;',
				'XOF' => 'CFA',
				'XPF' => 'Fr',
				'YER' => '&#xfdfc;',
				'ZAR' => '&#82;',
				'ZMW' => 'ZK',
			)
		);

		return $symbols;
	}

}