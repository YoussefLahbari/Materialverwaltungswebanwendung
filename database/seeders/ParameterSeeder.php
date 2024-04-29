<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parameter;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Insert bureau and site values
$bureauValues = [
    'Cercle Bour' => [
        'caidat bour',
        'CAIDAT HARBIL',
        'CAIDAT OLD DLIM',
        'CERCLE EL BOUR',
    ],
    'Cercle Loudaya' => [
        'CAIDAT AGAFAY',
        'caidat ait imour',
        'caidat Loudaya',
        'caidat sid zouin',
        'cercle loudaya',
    ],
    'Cercle Louidane' => [
        'Caidat AL OUIDANE',
        'Caidat OLD HASSOUN',
        'Caidat OOHT SIDI BRAHIM',
        'CERCLE OUIDANE',
    ],
    'Cercle Saada' => [
        'Caidat SAADA',
        'Caidat SOUIHLA',
        'CERCLE SAADA',
    ],
    'District Hay Hassani' => [
        'AA HAY HASSANI',
        'AA INARA',
        'AA MASSIRA',
        'AA Sidi Ghanem',
        'District Hay Hassani',
    ],
    'District hay Mohamadi' => [
        'AA Amerchich',
        'AA Daoudiat',
        'AA ISSIL',
        'AA Izdihar',
        'AA Riad salam',
        'District hay Mohamadi',
    ],
    'District Hivernage' => [
        'AA GUELIZ',
        'AA HIVERNAGE',
        'AA Q MILITAIRE',
        'DISTRICT HIVERNAGE',
    ],
    'District Jamaa Lafna' => [
        'AA BAB DOUKALA',
        'AA BAHIA',
        'AA JAMAA LAFNA',
        'DistRICT JAMMA FNA',
    ],
    'District Kechich' => [
        'AA BAB DBAGH',
        'AA BAB GHMAT',
        'AA BAB TAGHZOUT',
        'DistRICT KECHICH',
    ],
    'District Menara' => [
        'AA AZLI',
        'AA IZIKI',
        'AA Maatallah',
        'District Menara',
    ],
    'District Mhamid' => [
        'AA Askejour',
        'AA Bouakkaz',
        'AA Chrifia',
        'AA Mhamid',
        'District mhamid',
    ],
    'District Nakhil' => [
        'AA Nakhil nord',
        'AA Nakhil sud',
        'District nakhil',
    ],
    'District syba' => [
        'AA HAY JADID',
        'AA SYBA Center',
        'AA SYBA NORD',
        'AA SYBA Sud',
        'District SYBA',
    ],
    'District Tamansourt' => [
        'AA ATLAS',
        'AA FATH',
        'DISTRICT TAMANSSOURT',
    ],
    'Pachalik Mechouar Kasbah' => [
        'AA KASBAH',
        'Annexe MECHOUAR',
        'Pachalik MECHOUAR KASBAH',
    ],
    'Pachalik Tassoultant' => [
        'AA Tassoultant',
        'AA Chrifia',
        'Pachalik Tassoultant',
    ],
    'SECRETARIAT GENERAL' => [
        'CABINET',
        'SGP',
        'DAI',
        'DBM',
        'DSICG',
        'DCL',
        'DE',
        'DUE',
        'DDR',
        'DAEC',
        'DRHMG',
        'SAJC',
    ],
];


        // Loop through each site and its bureaux
        foreach ($bureauValues as $site => $bureaux) {
            // Create a parameter entry for the site
            $siteParameter = Parameter::create([
                'name' => 'site',
                'value' => $site,
            ]);

            // Associate each bureau with the corresponding site
            foreach ($bureaux as $bureau) {
                Parameter::create([
                    'name' => 'bureau',
                    'value' => $bureau,
                    'site' => $siteParameter->id,
                ]);
            }
        }
    }
}

