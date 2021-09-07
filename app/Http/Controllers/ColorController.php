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
        //return $topRepresentativeColor;                   // <<<------

        //return $request->file('image')->getClientOriginalName();
        //return $request->file('image');
        //return $request->input('image');
        //return $request;

        /* Compare the color with the colors provided */

        // https://www.w3schools.com/php/php_arrays_associative.asp

        $colorPalette = array(
            "Aqua"=>"#00FFFF",
            "Black"=>"#000000",
            "Blue"=>"#0000FF",
            "Fuchsia"=>"#FF00FF",
            "Navy"=>"#000080",
            "Olive"=>"#808000",
            "Purple"=>"#800080",
            "Red"=>"#FF0000",
            "Gray"=>"#808080",
            "Green"=>"#008000",
            "Lime"=>"#00FF00",
            "Maroon"=>"#800000",
            "Silver"=>"#C0C0C0",
            "Teal"=>"#008080",
            "White"=>"#FFFFFF",
            "Yellow"=>"#FFFF00"
        );

        // Convert hexadecimal to RGB numbering system
        $r = hexdec( substr($topRepresentativeColor,1,2) );
        $g = hexdec( substr($topRepresentativeColor,3,2) );
        $b = hexdec( substr($topRepresentativeColor,5,2) );

        //return $topRepresentativeColor . ' ' . $r . ' ' . $g . ' ' . $b;

        $colorPaletteDistances = [];
        foreach($colorPalette as $key => $value) {

            $palette_r = hexdec( substr($value,1,2) );
            $palette_g = hexdec( substr($value,3,2) );
            $palette_b = hexdec( substr($value,5,2) );

            // Get the diference of the RGB components of the compared colors
            $distance = abs($r - $palette_r) + abs($g - $palette_g) + abs($b - $palette_b);

            // Mount new array with the distance of every palette color
            $colorPaletteDistances += [$key => $distance];
        }

        //return $colorPaletteDistances;
        //return min($colorPaletteDistances);
        // Takes the minimum value of the color palette distances and returns the key (color name) of the color that has this smallest distance to the compared color
        $closestColor = array_keys($colorPaletteDistances, min($colorPaletteDistances));

        return [ $closestColor[0] => $colorPalette[$closestColor[0]] ];

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
