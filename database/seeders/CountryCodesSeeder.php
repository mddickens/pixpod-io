<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryCodesSeeder extends Seeder
{
	protected $countryCodes = [
		[
			'name' => 'Afghanistan',
			'iso_2' => 'AF',
			'iso_3' => 'AFG',
		],
		[
			'name' => 'Albania',
			'iso_2' => 'AL',
			'iso_3' => 'ALB',
		],
		[
			'name' => 'Algeria',
			'iso_2' => 'DZ',
			'iso_3' => 'DZA',
		],
		[
			'name' => 'American Samoa',
			'iso_2' => 'AS',
			'iso_3' => 'ASM',
		],
		[
			'name' => 'Andorra',
			'iso_2' => 'AD',
			'iso_3' => 'AND',
		],
		[
			'name' => 'Angola',
			'iso_2' => 'AO',
			'iso_3' => 'AGO',
		],
		[
			'name' => 'Anguilla',
			'iso_2' => 'AI',
			'iso_3' => 'AIA',
		],
		[
			'name' => 'Antarctica',
			'iso_2' => 'AQ',
			'iso_3' => 'ATA',
		],
		[
			'name' => 'Antigua and Barbuda',
			'iso_2' => 'AG',
			'iso_3' => 'ATG',
		],
		[
			'name' => 'Argentina',
			'iso_2' => 'AR',
			'iso_3' => 'ARG',
		],
		[
			'name' => 'Armenia',
			'iso_2' => 'AM',
			'iso_3' => 'ARM',
		],
		[
			'name' => 'Aruba',
			'iso_2' => 'AW',
			'iso_3' => 'ABW',
		],
		[
			'name' => 'Australia',
			'iso_2' => 'AU',
			'iso_3' => 'AUS',
		],
		[
			'name' => 'Austria',
			'iso_2' => 'AT',
			'iso_3' => 'AUT',
		],
		[
			'name' => 'Azerbaijan',
			'iso_2' => 'AZ',
			'iso_3' => 'AZE',
		],
		[
			'name' => 'Bahamas',
			'iso_2' => 'BS',
			'iso_3' => 'BHS',
		],
		[
			'name' => 'Bahrain',
			'iso_2' => 'BH',
			'iso_3' => 'BHR',
		],
		[
			'name' => 'Bangladesh',
			'iso_2' => 'BD',
			'iso_3' => 'BGD',
		],
		[
			'name' => 'Barbados',
			'iso_2' => 'BB',
			'iso_3' => 'BRB',
		],
		[
			'name' => 'Belarus',
			'iso_2' => 'BY',
			'iso_3' => 'BLR',
		],
		[
			'name' => 'Belgium',
			'iso_2' => 'BE',
			'iso_3' => 'BEL',
		],
		[
			'name' => 'Belize',
			'iso_2' => 'BZ',
			'iso_3' => 'BLZ',
		],
		[
			'name' => 'Benin',
			'iso_2' => 'BJ',
			'iso_3' => 'BEN',
		],
		[
			'name' => 'Bermuda',
			'iso_2' => 'BM',
			'iso_3' => 'BMU',
		],
		[
			'name' => 'Bhutan',
			'iso_2' => 'BT',
			'iso_3' => 'BTN',
		],
		[
			'name' => 'Bolivia',
			'iso_2' => 'BO',
			'iso_3' => 'BOL',
		],
		[
			'name' => 'Botswana',
			'iso_2' => 'BW',
			'iso_3' => 'BWA',
		],
		[
			'name' => 'Bouvet Island',
			'iso_2' => 'BV',
			'iso_3' => 'BVT',
		],
		[
			'name' => 'Brazil',
			'iso_2' => 'BR',
			'iso_3' => 'BRA',
		],
		[
			'name' => 'Brunei Darussalam',
			'iso_2' => 'BN',
			'iso_3' => 'BRN',
		],
		[
			'name' => 'Bulgaria',
			'iso_2' => 'BG',
			'iso_3' => 'BGR',
		],
		[
			'name' => 'Burkina Faso',
			'iso_2' => 'BF',
			'iso_3' => 'BFA',
		],
		[
			'name' => 'Burundi',
			'iso_2' => 'BI',
			'iso_3' => 'BDI',
		],
		[
			'name' => 'Cambodia',
			'iso_2' => 'KH',
			'iso_3' => 'KHM',
		],
		[
			'name' => 'Cameroon',
			'iso_2' => 'CM',
			'iso_3' => 'CMR',
		],
		[
			'name' => 'Canada',
			'iso_2' => 'CA',
			'iso_3' => 'CAN',
		],
		[
			'name' => 'Cape Verde',
			'iso_2' => 'CV',
			'iso_3' => 'CPV',
		],
		[
			'name' => 'Cayman Islands',
			'iso_2' => 'KY',
			'iso_3' => 'CYM',
		],
		[
			'name' => 'Chad',
			'iso_2' => 'TD',
			'iso_3' => 'TCD',
		],
		[
			'name' => 'Chile',
			'iso_2' => 'CL',
			'iso_3' => 'CHL',
		],
		[
			'name' => 'China',
			'iso_2' => 'CN',
			'iso_3' => 'CHN',
		],
		[
			'name' => 'Christmas Island',
			'iso_2' => 'CX',
			'iso_3' => 'CXR',
		],
		[
			'name' => 'Colombia',
			'iso_2' => 'CO',
			'iso_3' => 'COL',
		],
		[
			'name' => 'Comoros',
			'iso_2' => 'KM',
			'iso_3' => 'COM',
		],
		[
			'name' => 'Congo',
			'iso_2' => 'CG',
			'iso_3' => 'COG',
		],
		[
			'name' => 'Cook Islands',
			'iso_2' => 'CK',
			'iso_3' => 'COK',
		],
		[
			'name' => 'Costa Rica',
			'iso_2' => 'CR',
			'iso_3' => 'CRI',
		],
		[
			'name' => "Cote D''Ivoire",
			'iso_2' => 'CI',
			'iso_3' => 'CIV',
		],
		[
			'name' => 'Croatia',
			'iso_2' => 'HR',
			'iso_3' => 'HRV',
		],
		[
			'name' => 'Cuba',
			'iso_2' => 'CU',
			'iso_3' => 'CUB',
		],
		[
			'name' => 'Cyprus',
			'iso_2' => 'CY',
			'iso_3' => 'CYP',
		],
		[
			'name' => 'Czech Republic',
			'iso_2' => 'CZ',
			'iso_3' => 'CZE',
		],
		[
			'name' => 'Denmark',
			'iso_2' => 'DK',
			'iso_3' => 'DNK',
		],
		[
			'name' => 'Djibouti',
			'iso_2' => 'DJ',
			'iso_3' => 'DJI',
		],
		[
			'name' => 'Dominica',
			'iso_2' => 'DM',
			'iso_3' => 'DMA',
		],
		[
			'name' => 'Dominican Republic',
			'iso_2' => 'DO',
			'iso_3' => 'DOM',
		],
		[
			'name' => 'East Timor',
			'iso_2' => 'TP',
			'iso_3' => 'TMP',
		],
		[
			'name' => 'Ecuador',
			'iso_2' => 'EC',
			'iso_3' => 'ECU',
		],
		[
			'name' => 'Egypt',
			'iso_2' => 'EG',
			'iso_3' => 'EGY',
		],
		[
			'name' => 'El Salvador',
			'iso_2' => 'SV',
			'iso_3' => 'SLV',
		],
		[
			'name' => 'Equatorial Guinea',
			'iso_2' => 'GQ',
			'iso_3' => 'GNQ',
		],
		[
			'name' => 'Eritrea',
			'iso_2' => 'ER',
			'iso_3' => 'ERI',
		],
		[
			'name' => 'Estonia',
			'iso_2' => 'EE',
			'iso_3' => 'EST',
		],
		[
			'name' => 'Ethiopia',
			'iso_2' => 'ET',
			'iso_3' => 'ETH',
		],
		[
			'name' => 'Faroe Islands',
			'iso_2' => 'FO',
			'iso_3' => 'FRO',
		],
		[
			'name' => 'Fiji',
			'iso_2' => 'FJ',
			'iso_3' => 'FJI',
		],
		[
			'name' => 'Finland',
			'iso_2' => 'FI',
			'iso_3' => 'FIN',
		],
		[
			'name' => 'France',
			'iso_2' => 'FR',
			'iso_3' => 'FRA',
		],
		[
			'name' => 'France, Metropolitan',
			'iso_2' => 'FX',
			'iso_3' => 'FXX',
		],
		[
			'name' => 'French Guiana',
			'iso_2' => 'GF',
			'iso_3' => 'GUF',
		],
		[
			'name' => 'French Polynesia',
			'iso_2' => 'PF',
			'iso_3' => 'PYF',
		],
		[
			'name' => 'Gabon',
			'iso_2' => 'GA',
			'iso_3' => 'GAB',
		],
		[
			'name' => 'Gambia',
			'iso_2' => 'GM',
			'iso_3' => 'GMB',
		],
		[
			'name' => 'Georgia',
			'iso_2' => 'GE',
			'iso_3' => 'GEO',
		],
		[
			'name' => 'Germany',
			'iso_2' => 'DE',
			'iso_3' => 'DEU',
		],
		[
			'name' => 'Ghana',
			'iso_2' => 'GH',
			'iso_3' => 'GHA',
		],
		[
			'name' => 'Gibraltar',
			'iso_2' => 'GI',
			'iso_3' => 'GIB',
		],
		[
			'name' => 'Greece',
			'iso_2' => 'GR',
			'iso_3' => 'GRC',
		],
		[
			'name' => 'Greenland',
			'iso_2' => 'GL',
			'iso_3' => 'GRL',
		],
		[
			'name' => 'Grenada',
			'iso_2' => 'GD',
			'iso_3' => 'GRD',
		],
		[
			'name' => 'Guadeloupe',
			'iso_2' => 'GP',
			'iso_3' => 'GLP',
		],
		[
			'name' => 'Guam',
			'iso_2' => 'GU',
			'iso_3' => 'GUM',
		],
		[
			'name' => 'Guatemala',
			'iso_2' => 'GT',
			'iso_3' => 'GTM',
		],
		[
			'name' => 'Guinea',
			'iso_2' => 'GN',
			'iso_3' => 'GIN',
		],
		[
			'name' => 'Guinea-bissau',
			'iso_2' => 'GW',
			'iso_3' => 'GNB',
		],
		[
			'name' => 'Guyana',
			'iso_2' => 'GY',
			'iso_3' => 'GUY',
		],
		[
			'name' => 'Haiti',
			'iso_2' => 'HT',
			'iso_3' => 'HTI',
		],
		[
			'name' => 'Honduras',
			'iso_2' => 'HN',
			'iso_3' => 'HND',
		],
		[
			'name' => 'Hong Kong',
			'iso_2' => 'HK',
			'iso_3' => 'HKG',
		],
		[
			'name' => 'Hungary',
			'iso_2' => 'HU',
			'iso_3' => 'HUN',
		],
		[
			'name' => 'Iceland',
			'iso_2' => 'IS',
			'iso_3' => 'ISL',
		],
		[
			'name' => 'India',
			'iso_2' => 'IN',
			'iso_3' => 'IND',
		],
		[
			'name' => 'Indonesia',
			'iso_2' => 'ID',
			'iso_3' => 'IDN',
		],
		[
			'name' => 'Iraq',
			'iso_2' => 'IQ',
			'iso_3' => 'IRQ',
		],
		[
			'name' => 'Ireland',
			'iso_2' => 'IE',
			'iso_3' => 'IRL',
		],
		[
			'name' => 'Israel',
			'iso_2' => 'IL',
			'iso_3' => 'ISR',
		],
		[
			'name' => 'Italy',
			'iso_2' => 'IT',
			'iso_3' => 'ITA',
		],
		[
			'name' => 'Jamaica',
			'iso_2' => 'JM',
			'iso_3' => 'JAM',
		],
		[
			'name' => 'Japan',
			'iso_2' => 'JP',
			'iso_3' => 'JPN',
		],
		[
			'name' => 'Jordan',
			'iso_2' => 'JO',
			'iso_3' => 'JOR',
		],
		[
			'name' => 'Kazakhstan',
			'iso_2' => 'KZ',
			'iso_3' => 'KAZ',
		],
		[
			'name' => 'Kenya',
			'iso_2' => 'KE',
			'iso_3' => 'KEN',
		],
		[
			'name' => 'Kiribati',
			'iso_2' => 'KI',
			'iso_3' => 'KIR',
		],
		[
			'name' => 'Korea, Republic of',
			'iso_2' => 'KR',
			'iso_3' => 'KOR',
		],
		[
			'name' => 'Kuwait',
			'iso_2' => 'KW',
			'iso_3' => 'KWT',
		],
		[
			'name' => 'Kyrgyzstan',
			'iso_2' => 'KG',
			'iso_3' => 'KGZ',
		],
		[
			'name' => 'Latvia',
			'iso_2' => 'LV',
			'iso_3' => 'LVA',
		],
		[
			'name' => 'Lebanon',
			'iso_2' => 'LB',
			'iso_3' => 'LBN',
		],
		[
			'name' => 'Lesotho',
			'iso_2' => 'LS',
			'iso_3' => 'LSO',
		],
		[
			'name' => 'Liberia',
			'iso_2' => 'LR',
			'iso_3' => 'LBR',
		],
		[
			'name' => 'Liechtenstein',
			'iso_2' => 'LI',
			'iso_3' => 'LIE',
		],
		[
			'name' => 'Lithuania',
			'iso_2' => 'LT',
			'iso_3' => 'LTU',
		],
		[
			'name' => 'Luxembourg',
			'iso_2' => 'LU',
			'iso_3' => 'LUX',
		],
		[
			'name' => 'Macau',
			'iso_2' => 'MO',
			'iso_3' => 'MAC',
		],
		[
			'name' => 'Madagascar',
			'iso_2' => 'MG',
			'iso_3' => 'MDG',
		],
		[
			'name' => 'Malawi',
			'iso_2' => 'MW',
			'iso_3' => 'MWI',
		],
		[
			'name' => 'Malaysia',
			'iso_2' => 'MY',
			'iso_3' => 'MYS',
		],
		[
			'name' => 'Maldives',
			'iso_2' => 'MV',
			'iso_3' => 'MDV',
		],
		[
			'name' => 'Mali',
			'iso_2' => 'ML',
			'iso_3' => 'MLI',
		],
		[
			'name' => 'Malta',
			'iso_2' => 'MT',
			'iso_3' => 'MLT',
		],
		[
			'name' => 'Marshall Islands',
			'iso_2' => 'MH',
			'iso_3' => 'MHL',
		],
		[
			'name' => 'Martinique',
			'iso_2' => 'MQ',
			'iso_3' => 'MTQ',
		],
		[
			'name' => 'Mauritania',
			'iso_2' => 'MR',
			'iso_3' => 'MRT',
		],
		[
			'name' => 'Mauritius',
			'iso_2' => 'MU',
			'iso_3' => 'MUS',
		],
		[
			'name' => 'Mayotte',
			'iso_2' => 'YT',
			'iso_3' => 'MYT',
		],
		[
			'name' => 'Mexico',
			'iso_2' => 'MX',
			'iso_3' => 'MEX',
		],
		[
			'name' => 'Monaco',
			'iso_2' => 'MC',
			'iso_3' => 'MCO',
		],
		[
			'name' => 'Mongolia',
			'iso_2' => 'MN',
			'iso_3' => 'MNG',
		],
		[
			'name' => 'Montserrat',
			'iso_2' => 'MS',
			'iso_3' => 'MSR',
		],
		[
			'name' => 'Morocco',
			'iso_2' => 'MA',
			'iso_3' => 'MAR',
		],
		[
			'name' => 'Mozambique',
			'iso_2' => 'MZ',
			'iso_3' => 'MOZ',
		],
		[
			'name' => 'Myanmar',
			'iso_2' => 'MM',
			'iso_3' => 'MMR',
		],
		[
			'name' => 'Namibia',
			'iso_2' => 'NA',
			'iso_3' => 'NAM',
		],
		[
			'name' => 'Nauru',
			'iso_2' => 'NR',
			'iso_3' => 'NRU',
		],
		[
			'name' => 'Nepal',
			'iso_2' => 'NP',
			'iso_3' => 'NPL',
		],
		[
			'name' => 'Netherlands',
			'iso_2' => 'NL',
			'iso_3' => 'NLD',
		],
		[
			'name' => 'Netherlands Antilles',
			'iso_2' => 'AN',
			'iso_3' => 'ANT',
		],
		[
			'name' => 'New Caledonia',
			'iso_2' => 'NC',
			'iso_3' => 'NCL',
		],
		[
			'name' => 'New Zealand',
			'iso_2' => 'NZ',
			'iso_3' => 'NZL',
		],
		[
			'name' => 'Nicaragua',
			'iso_2' => 'NI',
			'iso_3' => 'NIC',
		],
		[
			'name' => 'Niger',
			'iso_2' => 'NE',
			'iso_3' => 'NER',
		],
		[
			'name' => 'Nigeria',
			'iso_2' => 'NG',
			'iso_3' => 'NGA',
		],
		[
			'name' => 'Niue',
			'iso_2' => 'NU',
			'iso_3' => 'NIU',
		],
		[
			'name' => 'Norfolk Island',
			'iso_2' => 'NF',
			'iso_3' => 'NFK',
		],
		[
			'name' => 'Norway',
			'iso_2' => 'NO',
			'iso_3' => 'NOR',
		],
		[
			'name' => 'Oman',
			'iso_2' => 'OM',
			'iso_3' => 'OMN',
		],
		[
			'name' => 'Pakistan',
			'iso_2' => 'PK',
			'iso_3' => 'PAK',
		],
		[
			'name' => 'Palau',
			'iso_2' => 'PW',
			'iso_3' => 'PLW',
		],
		[
			'name' => 'Panama',
			'iso_2' => 'PA',
			'iso_3' => 'PAN',
		],
		[
			'name' => 'Papua New Guinea',
			'iso_2' => 'PG',
			'iso_3' => 'PNG',
		],
		[
			'name' => 'Paraguay',
			'iso_2' => 'PY',
			'iso_3' => 'PRY',
		],
		[
			'name' => 'Peru',
			'iso_2' => 'PE',
			'iso_3' => 'PER',
		],
		[
			'name' => 'Philippines',
			'iso_2' => 'PH',
			'iso_3' => 'PHL',
		],
		[
			'name' => 'Pitcairn',
			'iso_2' => 'PN',
			'iso_3' => 'PCN',
		],
		[
			'name' => 'Poland',
			'iso_2' => 'PL',
			'iso_3' => 'POL',
		],
		[
			'name' => 'Portugal',
			'iso_2' => 'PT',
			'iso_3' => 'PRT',
		],
		[
			'name' => 'Puerto Rico',
			'iso_2' => 'PR',
			'iso_3' => 'PRI',
		],
		[
			'name' => 'Qatar',
			'iso_2' => 'QA',
			'iso_3' => 'QAT',
		],
		[
			'name' => 'Reunion',
			'iso_2' => 'RE',
			'iso_3' => 'REU',
		],
		[
			'name' => 'Romania',
			'iso_2' => 'RO',
			'iso_3' => 'ROM',
		],
		[
			'name' => 'Russian Federation',
			'iso_2' => 'RU',
			'iso_3' => 'RUS',
		],
		[
			'name' => 'Rwanda',
			'iso_2' => 'RW',
			'iso_3' => 'RWA',
		],
		[
			'name' => 'Saint Kitts and Nevis',
			'iso_2' => 'KN',
			'iso_3' => 'KNA',
		],
		[
			'name' => 'Saint Lucia',
			'iso_2' => 'LC',
			'iso_3' => 'LCA',
		],
		[
			'name' => 'Samoa',
			'iso_2' => 'WS',
			'iso_3' => 'WSM',
		],
		[
			'name' => 'San Marino',
			'iso_2' => 'SM',
			'iso_3' => 'SMR',
		],
		[
			'name' => 'Sao Tome and Principe',
			'iso_2' => 'ST',
			'iso_3' => 'STP',
		],
		[
			'name' => 'Saudi Arabia',
			'iso_2' => 'SA',
			'iso_3' => 'SAU',
		],
		[
			'name' => 'Senegal',
			'iso_2' => 'SN',
			'iso_3' => 'SEN',
		],
		[
			'name' => 'Seychelles',
			'iso_2' => 'SC',
			'iso_3' => 'SYC',
		],
		[
			'name' => 'Sierra Leone',
			'iso_2' => 'SL',
			'iso_3' => 'SLE',
		],
		[
			'name' => 'Singapore',
			'iso_2' => 'SG',
			'iso_3' => 'SGP',
		],
		[
			'name' => 'Slovenia',
			'iso_2' => 'SI',
			'iso_3' => 'SVN',
		],
		[
			'name' => 'Solomon Islands',
			'iso_2' => 'SB',
			'iso_3' => 'SLB',
		],
		[
			'name' => 'Somalia',
			'iso_2' => 'SO',
			'iso_3' => 'SOM',
		],
		[
			'name' => 'South Africa',
			'iso_2' => 'ZA',
			'iso_3' => 'ZAF',
		],
		[
			'name' => 'Spain',
			'iso_2' => 'ES',
			'iso_3' => 'ESP',
		],
		[
			'name' => 'Sri Lanka',
			'iso_2' => 'LK',
			'iso_3' => 'LKA',
		],
		[
			'name' => 'St. Helena',
			'iso_2' => 'SH',
			'iso_3' => 'SHN',
		],
		[
			'name' => 'St. Pierre and Miquelon',
			'iso_2' => 'PM',
			'iso_3' => 'SPM',
		],
		[
			'name' => 'Sudan',
			'iso_2' => 'SD',
			'iso_3' => 'SDN',
		],
		[
			'name' => 'Suriname',
			'iso_2' => 'SR',
			'iso_3' => 'SUR',
		],
		[
			'name' => 'Swaziland',
			'iso_2' => 'SZ',
			'iso_3' => 'SWZ',
		],
		[
			'name' => 'Sweden',
			'iso_2' => 'SE',
			'iso_3' => 'SWE',
		],
		[
			'name' => 'Switzerland',
			'iso_2' => 'CH',
			'iso_3' => 'CHE',
		],
		[
			'name' => 'Syrian Arab Republic',
			'iso_2' => 'SY',
			'iso_3' => 'SYR',
		],
		[
			'name' => 'Taiwan',
			'iso_2' => 'TW',
			'iso_3' => 'TWN',
		],
		[
			'name' => 'Tajikistan',
			'iso_2' => 'TJ',
			'iso_3' => 'TJK',
		],
		[
			'name' => 'Thailand',
			'iso_2' => 'TH',
			'iso_3' => 'THA',
		],
		[
			'name' => 'Togo',
			'iso_2' => 'TG',
			'iso_3' => 'TGO',
		],
		[
			'name' => 'Tokelau',
			'iso_2' => 'TK',
			'iso_3' => 'TKL',
		],
		[
			'name' => 'Tonga',
			'iso_2' => 'TO',
			'iso_3' => 'TON',
		],
		[
			'name' => 'Trinidad and Tobago',
			'iso_2' => 'TT',
			'iso_3' => 'TTO',
		],
		[
			'name' => 'Tunisia',
			'iso_2' => 'TN',
			'iso_3' => 'TUN',
		],
		[
			'name' => 'Turkey',
			'iso_2' => 'TR',
			'iso_3' => 'TUR',
		],
		[
			'name' => 'Turkmenistan',
			'iso_2' => 'TM',
			'iso_3' => 'TKM',
		],
		[
			'name' => 'Turks and Caicos Islands',
			'iso_2' => 'TC',
			'iso_3' => 'TCA',
		],
		[
			'name' => 'Tuvalu',
			'iso_2' => 'TV',
			'iso_3' => 'TUV',
		],
		[
			'name' => 'Uganda',
			'iso_2' => 'UG',
			'iso_3' => 'UGA',
		],
		[
			'name' => 'Ukraine',
			'iso_2' => 'UA',
			'iso_3' => 'UKR',
		],
		[
			'name' => 'United Arab Emirates',
			'iso_2' => 'AE',
			'iso_3' => 'ARE',
		],
		[
			'name' => 'United Kingdom',
			'iso_2' => 'GB',
			'iso_3' => 'GBR',
		],
		[
			'name' => 'United States',
			'iso_2' => 'US',
			'iso_3' => 'USA',
		],
		[
			'name' => 'US Minor Outlying Islands',
			'iso_2' => 'UM',
			'iso_3' => 'UMI',
		],
		[
			'name' => 'Uruguay',
			'iso_2' => 'UY',
			'iso_3' => 'URY',
		],
		[
			'name' => 'Uzbekistan',
			'iso_2' => 'UZ',
			'iso_3' => 'UZB',
		],
		[
			'name' => 'Vanuatu',
			'iso_2' => 'VU',
			'iso_3' => 'VUT',
		],
		[
			'name' => 'Venezuela',
			'iso_2' => 'VE',
			'iso_3' => 'VEN',
		],
		[
			'name' => 'Viet Nam',
			'iso_2' => 'VN',
			'iso_3' => 'VNM',
		],
		[
			'name' => 'Virgin Islands (British)',
			'iso_2' => 'VG',
			'iso_3' => 'VGB',
		],
		[
			'name' => 'Virgin Islands (U.S.)',
			'iso_2' => 'VI',
			'iso_3' => 'VIR',
		],
		[
			'name' => 'Wallis and Futuna Islands',
			'iso_2' => 'WF',
			'iso_3' => 'WLF',
		],
		[
			'name' => 'Western Sahara',
			'iso_2' => 'EH',
			'iso_3' => 'ESH',
		],
		[
			'name' => 'Yemen',
			'iso_2' => 'YE',
			'iso_3' => 'YEM',
		],
		[
			'name' => 'Yugoslavia',
			'iso_2' => 'YU',
			'iso_3' => 'YUG',
		],
		[
			'name' => 'Zaire',
			'iso_2' => 'ZR',
			'iso_3' => 'ZAR',
		],
		[
			'name' => 'Zambia',
			'iso_2' => 'ZM',
			'iso_3' => 'ZMB',
		],
		[
			'name' => 'Zimbabwe',
			'iso_2' => 'ZW',
			'iso_3' => 'ZWE',
		],
		[
			'name' => 'Slovakia',
			'iso_2' => 'SK',
			'iso_3' => 'SVK',
		],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('country_codes')->insert($this->countryCodes);
		DB::table('country_codes')->where('iso_2', 'CA')->update(['is_active' => true]);
		DB::table('country_codes')->where('iso_2', 'US')->update(['is_default' => true, 'is_active' => true]);
	}
}
