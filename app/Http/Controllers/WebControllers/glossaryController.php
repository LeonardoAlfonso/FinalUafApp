<?php

namespace App\Http\Controllers\WebControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Glossary;
use Response;

class glossaryController extends Controller
{

    //First view show
    public function getGlossary()
    {
      //Buttons
        $letters = Glossary::distinct()->select('group')->orderBy('group','asc')->get();

      //Words
        $index = $letters->first();
        $words = Glossary::select('idWord','word','definition')->where('group', $index->group)->orderBy('word','asc')->get();

      //Definitions

        $def = Glossary::select('idWord','word','definition')->where('idWord', $index->idWord)->orderBy('word','asc')->get();

      //View
        return view('web.glossary')
                ->with('letters',$letters)
                ->with('words',$words)
                ->with('wordDef',$def);
    }


    //Search the word of a $id letter
    public function searchWords(Request $request, $id)
    {
        // Searching words
        $words = Glossary::select('idWord','word','definition')->where('group', $id)->orderBy('word','asc')->get();

        //Ajax Handler
        if($request->ajax())
        {
            $view = view('web.partials.glossary.words')->with('words',$words);
            $newWords = $view->render();
            return response()->json(['html'=>$newWords]);
        }
    }

    //Search the word of a $idWord
    public function searchDefinition(Request $request, $id)
    {
        // Searching word with $idWord
        $words = Glossary::select('idWord','word','definition')->where('idWord', $id)->orderBy('word','asc')->get();

        //Ajax Handler
        if($request->ajax())
        {
            $view = view('web.partials.glossary.definitions')->with('wordDef',$words);
            $newWords = $view->render();
            return response()->json(['html'=>$newWords]);
        }
    }
}
