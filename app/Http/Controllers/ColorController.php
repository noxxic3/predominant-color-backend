<?php

namespace App\Http\Controllers;

//use App\Models\Color;   // Can't repeat this name if I use  League\ColorExtractor\Color;
use Illuminate\Http\Request;

//ColorExtractor plugin
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;


class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function index()
    {
        //
        return "Hola Controller Index AAA";
    }
    */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function create()
    {
        //
    }
    */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Calculate the predominant color in the image (with the ColorExtractor library) */
        $palette = Palette::fromFilename(  $request->file('image')  );       // $palette is an iterator on colors sorted by pixel count
        // The most used colors are not what we visually perceive as the most used (the most “representative” colors).
        //$topUsedColors = $palette->getMostUsedColors(3);
        //return $topUsedColors;
        /*
        // If there is more than one color, the array is traversed with the integer color codes to assemble another array with the codes in hexadecimal
        $c = [];
        foreach($topUsedColors as $value) {
            //$c[] = $value;
            $c[] = Color::fromIntToHex($value);                            // Colors are represented by integers (I think this numeral system is proper to the library), they must be transformed to hexadecimal
        }
        return $c;
        */

        // An extractor is built from a palette
        $extractor = new ColorExtractor($palette);

        // An extractor defines an extract method which return the most “representative” colors
        $topRepresentativeColors = $extractor->extract(3);
        //return $topRepresentativeColors;
        /*
        // If there is more than one color, the array is traversed with the integer color codes to assemble another array with the codes in hexadecimal
        $c = [];
        foreach($topRepresentativeColors as $value) {
            //$c[] = $value;
            $c[] = Color::fromIntToHex($value);
        }
        return $c;
        */
        $topRepresentativeColor = Color::fromIntToHex( $topRepresentativeColors[0] );
        //return gettype( $topRepresentativeColor );       // String
        return $topRepresentativeColor;                   // <<<------

        //return $request->file('image')->getClientOriginalName();
        //return $request->file('image');
        //return $request->input('image');
        //return $request;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function show($id)
    {
        //
    }
    */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit($id)
    {
        //
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function update(Request $request, $id)
    {
        //
    }
    */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function destroy($id)
    {
        //
    }
    */
}
