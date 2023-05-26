<?php

use common\models\UserProfile;
use yii\db\Migration;

/**
 * Class m230526_151538_create_table_country
 */
class m230526_151538_create_table_country extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(2)->notNull(),
            'title' => $this->string()->notNull(),
            'continent' => $this->string()->notNull(),
            'code_three' => $this->string(3)
        ], $tableOptions);
        $this->createTable('{{%country_stat}}', [
            'user_id' => $this->integer()->notNull(),
            'country_id' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('country_id', '{{%user_profile}}', 'country_id');
        $this->addForeignKey('user_profile_ibfk_1', '{{%user_profile}}', 'country_id', '{{%country}}', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('country_id', '{{%country_stat}}', 'country_id');
        $this->addForeignKey('country_stat_ibfk_1', '{{%country_stat}}', 'country_id', '{{%country}}', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('user_id', '{{%country_stat}}', 'user_id');

        $countries = [
            ['AD', 'Andorra', 'EU', 'AND'],
            ['AE', 'United Arab Emirates', 'AS', 'ARE'],
            ['AF', 'Afghanistan', 'AS', 'AFG'],
            ['AG', 'Antigua and Barbuda', 'NA', 'ATG'],
            ['AI', 'Anguilla', 'NA', 'AIA'],
            ['AL', 'Albania', 'EU', 'ALB'],
            ['AM', 'Armenia', 'AS', 'ARM'],
            ['AN', 'Netherlands Antilles', 'SA', 'ANT'],
            ['AO', 'Angola', 'AF', 'AGO'],
            ['AQ', 'Antarctica', 'AN', 'ATA'],
            ['AR', 'Argentina', 'SA', 'ARG'],
            ['AS', 'American Samoa', 'OC', 'ASM'],
            ['AT', 'Austria', 'EU', 'AUT'],
            ['AU', 'Australia', 'OC', 'AUS'],
            ['AW', 'Aruba', 'NA', 'ABW'],
            ['AX', 'Aland Islands', 'EU', 'ALA'],
            ['AZ', 'Azerbaijan', 'AS', 'AZE'],
            ['BA', 'Bosnia and Herzegovina', 'EU', 'BIH'],
            ['BB', 'Barbados', 'NA', 'BRB'],
            ['BD', 'Bangladesh', 'AS', 'BGD'],
            ['BE', 'Belgium', 'EU', 'BEL'],
            ['BF', 'Burkina Faso', 'AF', 'BFA'],
            ['BG', 'Bulgaria', 'EU', 'BGR'],
            ['BH', 'Bahrain', 'AS', 'BHR'],
            ['BI', 'Burundi', 'AF', 'BDI'],
            ['BJ', 'Benin', 'AF', 'BEN'],
            ['BL', 'Saint Barthélemy', 'NA', 'BLM'],
            ['BM', 'Bermuda', 'NA', 'BMU'],
            ['BN', 'Brunei', 'AS', 'BRN'],
            ['BO', 'Bolivia', 'SA', 'BOL'],
            ['BQ', 'Bonaire, Sint Eustatius and Saba', 'SA', 'BES'],
            ['BR', 'Brazil', 'SA', 'BRA'],
            ['BS', 'Bahamas', 'NA', 'BHS'],
            ['BT', 'Bhutan', 'AS', 'BTN'],
            ['BV', 'Bouvet Island', 'AN', 'BVT'],
            ['BW', 'Botswana', 'AF', 'BWA'],
            ['BY', 'Belarus', 'EU', 'BLR'],
            ['BZ', 'Belize', 'NA', 'BLZ'],
            ['CA', 'Canada', 'NA', 'CAN'],
            ['CC', 'Cocos (Keeling) Islands', 'AS', 'CCK'],
            ['CD', 'Congo (Kinshasa)', 'AF', 'COD'],
            ['CF', 'Central African Republic', 'AF', 'CAF'],
            ['CG', 'Congo (Brazzaville)', 'AF', 'COG'],
            ['CH', 'Switzerland', 'EU', 'CHE'],
            ['CI', 'Ivory Coast', 'AF', 'CIV'],
            ['CK', 'Cook Islands', 'OC', 'COK'],
            ['CL', 'Chile', 'SA', 'CHL'],
            ['CM', 'Cameroon', 'AF', 'CMR'],
            ['CN', 'China', 'AS', 'CHN'],
            ['CO', 'Colombia', 'SA', 'COL'],
            ['CR', 'Costa Rica', 'NA', 'CRI'],
            ['CU', 'Cuba', 'NA', 'CUB'],
            ['CW', 'Curaçao', 'NA', 'CUW'],
            ['CV', 'Cape Verde', 'AF', 'CPV'],
            ['CX', 'Christmas Island', 'AS', 'CXR'],
            ['CY', 'Cyprus', 'EU', 'CYP'],
            ['CZ', 'Czech Republic', 'EU', 'CZE'],
            ['DE', 'Germany', 'EU', 'DEU'],
            ['DJ', 'Djibouti', 'AF', 'DJI'],
            ['DK', 'Denmark', 'EU', 'DNK'],
            ['DM', 'Dominica', 'NA', 'DMA'],
            ['DO', 'Dominican Republic', 'NA', 'DOM'],
            ['DZ', 'Algeria', 'AF', 'DZA'],
            ['EC', 'Ecuador', 'SA', 'ECU'],
            ['EE', 'Estonia', 'EU', 'EST'],
            ['EG', 'Egypt', 'AF', 'EGY'],
            ['EH', 'Western Sahara', 'AF', 'ESH'],
            ['ER', 'Eritrea', 'AF', 'ERI'],
            ['ES', 'Spain', 'EU', 'ESP'],
            ['ET', 'Ethiopia', 'AF', 'ETH'],
            ['FI', 'Finland', 'EU', 'FIN'],
            ['FJ', 'Fiji', 'OC', 'FJI'],
            ['FK', 'Falkland Islands', 'SA', 'FLK'],
            ['FM', 'Micronesia', 'OC', 'FSM'],
            ['FO', 'Faroe Islands', 'EU', 'FRO'],
            ['FR', 'France', 'EU', 'FRA'],
            ['GA', 'Gabon', 'AF', 'GAB'],
            ['GB', 'United Kingdom', 'EU', 'GBR'],
            ['GD', 'Grenada', 'NA', 'GRD'],
            ['GE', 'Georgia', 'AS', 'GEO'],
            ['GF', 'French Guiana', 'SA', 'GUF'],
            ['GG', 'Guernsey', 'EU', 'GGY'],
            ['GH', 'Ghana', 'AF', 'GHA'],
            ['GI', 'Gibraltar', 'EU', 'GIB'],
            ['GL', 'Greenland', 'NA', 'GRL'],
            ['GM', 'Gambia', 'AF', 'GMB'],
            ['GN', 'Guinea', 'AF', 'GIN'],
            ['GP', 'Guadeloupe', 'NA', 'GLP'],
            ['GQ', 'Equatorial Guinea', 'AF', 'GNQ'],
            ['GR', 'Greece', 'EU', 'GRC'],
            ['GS', 'South Georgia and the South Sandwich Islands', 'AN', 'SGS'],
            ['GT', 'Guatemala', 'NA', 'GTM'],
            ['GU', 'Guam', 'OC', 'GUM'],
            ['GW', 'Guinea-Bissau', 'AF', 'GNB'],
            ['GY', 'Guyana', 'SA', 'GUY'],
            ['HK', 'Hong Kong S.A.R., China', 'AS', 'HKG'],
            ['HM', 'Heard Island and McDonald Islands', 'AN', 'HMD'],
            ['HN', 'Honduras', 'NA', 'HND'],
            ['HR', 'Croatia', 'EU', 'HRV'],
            ['HT', 'Haiti', 'NA', 'HTI'],
            ['HU', 'Hungary', 'EU', 'HUN'],
            ['ID', 'Indonesia', 'AS', 'IDN'],
            ['IE', 'Ireland', 'EU', 'IRL'],
            ['IL', 'Israel', 'AS', 'ISR'],
            ['IM', 'Isle of Man', 'EU', 'IMN'],
            ['IN', 'India', 'AS', 'IND'],
            ['IO', 'British Indian Ocean Territory', 'AS', 'IOT'],
            ['IQ', 'Iraq', 'AS', 'IRQ'],
            ['IR', 'Iran', 'AS', 'IRN'],
            ['IS', 'Iceland', 'EU', 'ISL'],
            ['IT', 'Italy', 'EU', 'ITA'],
            ['JE', 'Jersey', 'EU', 'JEY'],
            ['JM', 'Jamaica', 'NA', 'JAM'],
            ['JO', 'Jordan', 'AS', 'JOR'],
            ['JP', 'Japan', 'AS', 'JPN'],
            ['KE', 'Kenya', 'AF', 'KEN'],
            ['KG', 'Kyrgyzstan', 'AS', 'KGZ'],
            ['KH', 'Cambodia', 'AS', 'KHM'],
            ['KI', 'Kiribati', 'OC', 'KIR'],
            ['KM', 'Comoros', 'AF', 'COM'],
            ['KN', 'Saint Kitts and Nevis', 'NA', 'KNA'],
            ['KP', 'North Korea', 'AS', 'PRK'],
            ['KR', 'South Korea', 'AS', 'KOR'],
            ['KW', 'Kuwait', 'AS', 'KWT'],
            ['KY', 'Cayman Islands', 'NA', 'CYM'],
            ['KZ', 'Kazakhstan', 'AS', 'KAZ'],
            ['LA', 'Laos', 'AS', 'LAO'],
            ['LB', 'Lebanon', 'AS', 'LBN'],
            ['LC', 'Saint Lucia', 'NA', 'LCA'],
            ['LI', 'Liechtenstein', 'EU', 'LIE'],
            ['LK', 'Sri Lanka', 'AS', 'LKA'],
            ['LR', 'Liberia', 'AF', 'LBR'],
            ['LS', 'Lesotho', 'AF', 'LSO'],
            ['LT', 'Lithuania', 'EU', 'LTU'],
            ['LU', 'Luxembourg', 'EU', 'LUX'],
            ['LV', 'Latvia', 'EU', 'LVA'],
            ['LY', 'Libya', 'AF', 'LBY'],
            ['MA', 'Morocco', 'AF', 'MAR'],
            ['MC', 'Monaco', 'EU', 'MCO'],
            ['MD', 'Moldova', 'EU', 'MDA'],
            ['ME', 'Montenegro', 'EU', 'MNE'],
            ['MF', 'Saint Martin (French part)', 'NA', 'MAF'],
            ['MG', 'Madagascar', 'AF', 'MDG'],
            ['MH', 'Marshall Islands', 'OC', 'MHL'],
            ['MK', 'Macedonia', 'EU', 'MKD'],
            ['ML', 'Mali', 'AF', 'MLI'],
            ['MM', 'Myanmar', 'AS', 'MMR'],
            ['MN', 'Mongolia', 'AS', 'MNG'],
            ['MO', 'Macao S.A.R., China', 'AS', 'MAC'],
            ['MP', 'Northern Mariana Islands', 'OC', 'MNP'],
            ['MQ', 'Martinique', 'NA', 'MTQ'],
            ['MR', 'Mauritania', 'AF', 'MRT'],
            ['MS', 'Montserrat', 'NA', 'MSR'],
            ['MT', 'Malta', 'EU', 'MLT'],
            ['MU', 'Mauritius', 'AF', 'MUS'],
            ['MV', 'Maldives', 'AS', 'MDV'],
            ['MW', 'Malawi', 'AF', 'MWI'],
            ['MX', 'Mexico', 'NA', 'MEX'],
            ['MY', 'Malaysia', 'AS', 'MYS'],
            ['MZ', 'Mozambique', 'AF', 'MOZ'],
            ['NA', 'Namibia', 'AF', 'NAM'],
            ['NC', 'New Caledonia', 'OC', 'NCL'],
            ['NE', 'Niger', 'AF', 'NER'],
            ['NF', 'Norfolk Island', 'OC', 'NFK'],
            ['NG', 'Nigeria', 'AF', 'NGA'],
            ['NI', 'Nicaragua', 'NA', 'NIC'],
            ['NL', 'Netherlands', 'EU', 'NLD'],
            ['NO', 'Norway', 'EU', 'NOR'],
            ['NP', 'Nepal', 'AS', 'NPL'],
            ['NR', 'Nauru', 'OC', 'NRU'],
            ['NU', 'Niue', 'OC', 'NIU'],
            ['NZ', 'New Zealand', 'OC', 'NZL'],
            ['OM', 'Oman', 'AS', 'OMN'],
            ['PA', 'Panama', 'NA', 'PAN'],
            ['PE', 'Peru', 'SA', 'PER'],
            ['PF', 'French Polynesia', 'OC', 'PYF'],
            ['PG', 'Papua New Guinea', 'OC', 'PNG'],
            ['PH', 'Philippines', 'AS', 'PHL'],
            ['PK', 'Pakistan', 'AS', 'PAK'],
            ['PL', 'Poland', 'EU', 'POL'],
            ['PM', 'Saint Pierre and Miquelon', 'NA', 'SPM'],
            ['PN', 'Pitcairn', 'OC', 'PCN'],
            ['PR', 'Puerto Rico', 'NA', 'PRI'],
            ['PS', 'Palestinian Territory', 'AS', 'PSE'],
            ['PT', 'Portugal', 'EU', 'PRT'],
            ['PW', 'Palau', 'OC', 'PLW'],
            ['PY', 'Paraguay', 'SA', 'PRY'],
            ['QA', 'Qatar', 'AS', 'QAT'],
            ['RE', 'Reunion', 'AF', 'REU'],
            ['RO', 'Romania', 'EU', 'ROU'],
            ['RS', 'Serbia', 'EU', 'SRB'],
            ['RU', 'Russia', 'EU', 'RUS'],
            ['RW', 'Rwanda', 'AF', 'RWA'],
            ['SA', 'Saudi Arabia', 'AS', 'SAU'],
            ['SB', 'Solomon Islands', 'OC', 'SLB'],
            ['SC', 'Seychelles', 'AF', 'SYC'],
            ['SD', 'Sudan', 'AF', 'SDN'],
            ['SE', 'Sweden', 'EU', 'SWE'],
            ['SG', 'Singapore', 'AS', 'SGP'],
            ['SH', 'Saint Helena', 'AF', 'SHN'],
            ['SI', 'Slovenia', 'EU', 'SVN'],
            ['SJ', 'Svalbard and Jan Mayen', 'EU', 'SJM'],
            ['SK', 'Slovakia', 'EU', 'SVK'],
            ['SL', 'Sierra Leone', 'AF', 'SLE'],
            ['SM', 'San Marino', 'EU', 'SMR'],
            ['SN', 'Senegal', 'AF', 'SEN'],
            ['SO', 'Somalia', 'AF', 'SOM'],
            ['SR', 'Suriname', 'SA', 'SUR'],
            ['SS', 'South Sudan', 'AF', 'SSD'],
            ['ST', 'Sao Tome and Principe', 'AF', 'STP'],
            ['SV', 'El Salvador', 'NA', 'SLV'],
            ['SX', 'Sint Maarten (Dutch part)', 'NA', 'SXM'],
            ['SY', 'Syria', 'AS', 'SYR'],
            ['SZ', 'Swaziland', 'AF', 'SWZ'],
            ['TC', 'Turks and Caicos Islands', 'NA', 'TCA'],
            ['TD', 'Chad', 'AF', 'TCD'],
            ['TF', 'French Southern Territories', 'AN', 'ATF'],
            ['TG', 'Togo', 'AF', 'TGO'],
            ['TH', 'Thailand', 'AS', 'THA'],
            ['TJ', 'Tajikistan', 'AS', 'TJK'],
            ['TK', 'Tokelau', 'OC', 'TKL'],
            ['TL', 'Timor-Leste', 'OC', 'TLS'],
            ['TM', 'Turkmenistan', 'AS', 'TKM'],
            ['TN', 'Tunisia', 'AF', 'TUN'],
            ['TO', 'Tonga', 'OC', 'TON'],
            ['TR', 'Turkey', 'AS', 'TUR'],
            ['TT', 'Trinidad and Tobago', 'NA', 'TTO'],
            ['TV', 'Tuvalu', 'OC', 'TUV'],
            ['TW', 'Taiwan', 'AS', 'TWN'],
            ['TZ', 'Tanzania', 'AF', 'TZA'],
            ['UA', 'Ukraine', 'EU', 'UKR'],
            ['UG', 'Uganda', 'AF', 'UGA'],
            ['UM', 'United States Minor Outlying Islands', 'OC', 'UMI'],
            ['US', 'United States', 'NA', 'USA'],
            ['UY', 'Uruguay', 'SA', 'URY'],
            ['UZ', 'Uzbekistan', 'AS', 'UZB'],
            ['VA', 'Vatican', 'EU', 'VAT'],
            ['VC', 'Saint Vincent and the Grenadines', 'NA', 'VCT'],
            ['VE', 'Venezuela', 'SA', 'VEN'],
            ['VG', 'British Virgin Islands', 'NA', 'VGB'],
            ['VI', 'U.S. Virgin Islands', 'NA', 'VIR'],
            ['VN', 'Vietnam', 'AS', 'VNM'],
            ['VU', 'Vanuatu', 'OC', 'VUT'],
            ['WF', 'Wallis and Futuna', 'OC', 'WLF'],
            ['WS', 'Samoa', 'OC', 'WSM'],
            ['YE', 'Yemen', 'AS', 'YEM'],
            ['YT', 'Mayotte', 'AF', 'MYT'],
            ['ZA', 'South Africa', 'AF', 'ZAF'],
            ['ZM', 'Zambia', 'AF', 'ZMB'],
            ['ZW', 'Zimbabwe', 'AF', 'ZWE']
        ];

        $this->batchInsert('{{%country}}', ['code', 'title', 'continent', 'code_three'], $countries);

        $profiles = UserProfile::find()->all();

        foreach($profiles AS $profile) {

            $countryCode = explode('-', $profile->locale)[1];

            $filter = array_filter($countries, function($val, $key) use ($countryCode)  {
                return $countryCode == $val[0];
            }, ARRAY_FILTER_USE_BOTH);

            $countryId = array_keys($filter)[0] + 1;

            $profile->country_id = $countryId;
            $profile->save();
        }
    }

    public function safeDown()
    {
        $this->dropForeignKey('user_profile_ibfk_1', '{{%user_profile}}');
        $this->dropIndex('country_id', '{{%user_profile}}');

        $this->dropForeignKey('country_stat_ibfk_1', '{{%country_stat}}');
        $this->dropIndex('country_id', '{{%country_stat}}');

        $this->dropTable('{{%country_stat}}');
        $this->dropTable('{{%country}}');

        $profiles = UserProfile::find()->all();

        foreach($profiles AS $profile) {
            $profile->country_id = null;
            $profile->save();
        }
    }
}
