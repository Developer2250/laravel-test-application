<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function program1()
    {
        $inputArray = [
            "English" => "Subject",
            "India" => "Country",
            "Maths" => "Subject",
            "USA" => "Country",
            "Canada" => "Country",
            "Pen" => "Stationary",
        ];

        $outputArray = [];
        foreach ($inputArray as $key => $value) {
            $outputArray[$value][] = $key;
        }

        echo "<pre>";
        print_r($outputArray);
    }

    public function program2(Request $request)
    {
        $input = "aabbbccaaaac";
        $output = $this->encodeString($input);

        return response()->json([
            'input' => $input,
            'output' => $output,
        ]);
    }

    private function encodeString($input)
    {
        $output = "";
        $count = 1;

        for ($i = 0; $i < strlen($input); $i++) {
            if ($i + 1 < strlen($input) && $input[$i] == $input[$i + 1]) {
                $count++;
            } else {
                $output .= $count . $input[$i];
                $count = 1;
            }
        }

        return $output;
    }
}
