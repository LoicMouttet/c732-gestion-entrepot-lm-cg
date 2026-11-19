<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('collaborateurs', function (Blueprint $table) {
            $table->string('nomuser')->nullable()->unique()->after('prenom');
        });

        // Remplissage automatique pour les collaborateurs existants
        $collaborateurs = DB::table('collaborateurs')->get();

        foreach ($collaborateurs as $collab) {
            $nomClean = Str::lower(Str::ascii(preg_replace('/[^a-zA-Z]/', '', $collab->nom)));
            $prenomClean = Str::lower(Str::ascii(preg_replace('/[^a-zA-Z]/', '', $collab->prenom)));

            $baseNomUser = substr($nomClean, 0, 3) . substr($prenomClean, 0, 2);
            $nomUser = $baseNomUser;
            $compteur = 1;

            // Sécurité anti-doublon si 2 personnes ont les mêmes initiales (ex: stajo1)
            while (DB::table('collaborateurs')->where('nomuser', $nomUser)->where('id', '!=', $collab->id)->exists()) {
                $nomUser = $baseNomUser . $compteur;
                $compteur++;
            }

            DB::table('collaborateurs')
                ->where('id', $collab->id)
                ->update(['nomuser' => $nomUser]);
        }
    }

    public function down(): void
    {
        Schema::table('collaborateurs', function (Blueprint $table) {
            $table->dropColumn('nomuser');
        });
    }
};
