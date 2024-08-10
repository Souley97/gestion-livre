<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivreRequest;
use App\Http\Requests\UpdateLivreRequest;
use App\Models\Livre;

class LivreController extends Controller {

    public function index() {
        $livres = Livre::all();
        return response()->json( [
            'message' => 'Liste des livres recuperer avec succés ',
            'livres' => $livres,
        ], 200 );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( StoreLivreRequest $request ) {
        $livre = new Livre();

        $livre->fill( $request->validated() );
        if ( $request->hasFile( 'image' ) ) {
            $image = $request->file( 'image' );
            $livre->image = $image->store( 'images', 'public' );
        }
        $livre->save();
        return response()->json( [
            'message' => 'Livre ajouté avec succès ',
            'livre' => $livre,
        ], 201 );
    }

    /**
    * Display the specified resource.
    */

    public function show( Livre $livre ) {
        return response()->json( [
            'message' => 'Livre récupéré avec succès ',
            'livre' => $livre,
        ], 200 );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( UpdateLivreRequest $request, Livre $livre ) {
        $livre->fill( $request->validated() );
        if ( $request->file( 'image' ) ) {

            if ( File::exists( storage_path( $livre->image ) ) ) {
                File::delete( storage_path( $livre->image ) );
            }
            $image = $request->file( 'image' );
            $livre->image = $image->store( 'images', 'public' );
        }
        $livre->update();
        return response()->json( [
            'message' => 'Livre modifié avec succès ',
            'livre' => $livre,
        ], 200 );
    }

    public function destroy( Livre $livre ) {
        $livre->delete();
        return response()->json( [
            'message' => 'Livre supprimé avec succès ',
        ], 200 );
    }

    // Restore
    public function restore( Livre $livre ) {
        $livre->restore();
        return response()->json( [
            'message' => 'Livre restauré avec succès ',
            'livre' => $livre,
        ], 200 );
    }
    // Permanently delete
    public function forceDelete( Livre $livre ) {
        $livre->forceDelete();
        return response()->json( [
           'message' => 'Livre supprimé définitivement ',
        ], 200 );
    }
    // Soft delete
    public function softDelete( Livre $livre ) {
        $livre->delete();
        return response()->json( [
           'message' => 'Livre supprimé avec succès (soft delete)',
            'livre' => $livre,
        ], 200 );
    }
    // trashed
    public function trashed() {
        $livres = Livre::onlyTrashed()->get();
        return response()->json( [
           'message' => 'Liste des livres supprimés avec succès ',
            'livres' => $livres,
        ], 200 );
    }


    // Only restore soft deleted records

}
