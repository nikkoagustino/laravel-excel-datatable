<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Storage;

class FileExplorerController extends Controller
{
    function showExplorer() {
        $path = 'data';
        $dirs = Storage::allDirectories($path);
        $file_tree = [];
        foreach ($dirs as $dir) {
            $files = Storage::allFiles($dir); 
            foreach ($files as $file_path) {
                $file_tree[$dir][] = explode('/', $file_path)[2];
            }
        }
        $data = [
            'file_tree' => $file_tree
        ];
        return view('ads.files')->with($data);
        dd($file_tree);
    }

    public function readExcel(Request $request)
    {
        // Scan dirs
        $path = 'data';
        $dirs = Storage::allDirectories($path);
        $file_tree = [];
        foreach ($dirs as $dir) {
            $files = Storage::allFiles($dir); 
            foreach ($files as $file_path) {
                $file_tree[$dir][] = explode('/', $file_path)[2];
            }
        }

        if (!$request->file_dir) {
            $resp_data = [
                'file_tree' => $file_tree,
                'contents' => [],
            ];
            return view('ads/reader')->with($resp_data);
        }

        $filePath = Storage::path($request->file_dir);

        // Load the Excel file
        $spreadsheet = IOFactory::load($filePath);
        
        // Get the first worksheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Get the highest row and column indexes
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        // Iterate through each row
        for ($row = 1; $row <= $highestRow; $row++) {
            // Iterate through each column
            for ($column = 'A'; $column <= $highestColumn; $column++) {
                // Get the cell value
                $cellValue = $worksheet->getCell($column . $row)->getValue();

                // Process the cell value as needed
                $data[$row][$column] = $cellValue;
            }
        }

        $resp_data = [
            'file_tree' => $file_tree,
            'contents' => $data,
        ];

        return view('ads/reader')->with($resp_data);
    }

}
